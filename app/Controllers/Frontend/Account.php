<?php

namespace App\Controllers\Frontend;

use App\Models\Admin\BookingGuestModel;
use App\Models\Admin\BookingsModel;
use App\Models\Admin\InboxModel;
use App\Models\Admin\ListingModel;
use App\Models\Admin\UsermedicalModel;
use CodeIgniter\Controller;
use App\Models\Admin\UserModel;
use CodeIgniter\I18n\Time;

class Account extends Controller
{
	private $data;
	private $listing_m;
	private $bookings_m;
	private $booking_guests_m;
	private $inbox_m;
	private $user_m;
	private $session;
	private $razorpay;

	public function __construct()
	{
		$this->data = array();
		$this->session = session();
		$this->data['pageJS'] = '<script>const body = document.getElementsByTagName("body")[0];body.classList.remove("transparent-header");</script>';
		$this->data['user_data'] = [
			'id' => $this->session->get('uid'),
			'firstName' => $this->session->get('firstName'),
			'lastname' => $this->session->get('lastname'),
			'email' => $this->session->get('email'),
			'medical_history_id	' => $this->session->get('medical_history_id	'),
			'aboutuser' => $this->session->get('aboutuser'),
			'emailVerified' => $this->session->get('emailVerified'),
			'phone' => $this->session->get('phone'),
			'phoneVerified' => $this->session->get('phoneVerified'),			
			'photoURL' => $this->session->get('photoURL'),
			'govID' => $this->session->get('govID'),
			'govIDverified' => $this->session->get('govIDverified'),
			'languages' => $this->session->get('languages'),
			'gender' => $this->session->get('gender'),
			'addressLine1' => $this->session->get('addressLine1'),
			'addressLine2' => $this->session->get('addressLine2'),
			'state' => $this->session->get('state'),
			'city' => $this->session->get('city'),
			'country' => $this->session->get('country'),
		];
		$this->data['razorKey'] = env('razorKey');
		$this->listing_m = new ListingModel();
		$this->bookings_m = new BookingsModel();
		$this->booking_guests_m = new BookingGuestModel();
		$this->inbox_m = new InboxModel();
		$this->user_m = new UserModel();
		helper('file');
	}
	public function account_profile()
	{
		$userMD = new UserModel();
		$medical = new UsermedicalModel();

		$currentid = session()->get('uid');
		$userData = $userMD->find($currentid);
		$this->data['user'] = $userData;

		if ($userData['medical_history_id']) {
			$medicalData = $medical->find($userData['medical_history_id']);
			$this->data['medical'] = $medicalData;
		}

		// return print_r($this->data);

		return view('Frontend/account/profile', $this->data);
	}
	public function account_inbox()
	{
		$this->data['pageJS'] = '<script>
		const body = document.getElementsByTagName("body")[0];
		body.classList.remove("transparent-header");</script>';

		return view('Frontend/account/index', $this->data);
	}
	public function account_alerts()
	{
		$this->data['pageJS'] = '<script>
		const body = document.getElementsByTagName("body")[0];
		body.classList.remove("transparent-header");</script>';

		return view('Frontend/account/index', $this->data);
	}
	public function account_trips()
	{
		$user_id = $this->data['user_data']['id'];
		$getParam = '';
		if ($this->request->getMethod() == 'get' && $this->request->getVar('type')) {
			$getParam = $this->request->getGet('type');
			if ($getParam == 'completed') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'completed' => 1, 'approved' => 1, 'user_id' => $user_id])->findAll();
			} else if ($getParam == 'approved') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'cancelled' => 0, 'approved' => 1, 'completed' => 0, 'user_id' => $user_id])->findAll();
			} else if ($getParam == 'rejected') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'cancelled' => 1, 'approved' => 0, 'completed' => 0, 'user_id' => $user_id])->findAll();
			} else if ($getParam == 'new') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'cancelled' => 0, 'approved' => 0, 'completed' => 0, 'user_id' => $user_id])->findAll();
			} else {
				$bookings_data = $this->bookings_m->where(['user_id' => $user_id])->findAll();
			}
		} else {
			$bookings_data = $this->bookings_m->where(['user_id' => $user_id])->findAll();
		}

		foreach ($bookings_data as $key => $booking) {
			$decoded = json_decode($booking['price_breakdown']);
			// $data_to_encode = json_encode($decoded);
			$bookings_data[$key]['price_breakdown'] = $decoded;

			$booking_id = $booking['id'];
			$bookings_data[$key]['guest_details'] = $this->booking_guests_m->where(['booking_id' => $booking_id])->findAll();
			$bookings_data[$key]['user_id_64'] = base64_encode(base64_encode(base64_encode($booking['host_id'])));
			$hostid = $booking['host_id'];
			$inbox = $this->inbox_m->where(['guest_id' => $user_id, 'host_id' => $hostid])->first();
			if ($inbox) {
				$bookings_data[$key]['guest_chat_id'] = $inbox['id'];
			} else {
				$guest_data = $this->user_m->select('firstName, lastname')->find($user_id);
				$host_data = $this->user_m->select('firstName, lastname')->find($hostid);
				$inboxData = [
					'guest_id' => $user_id,
					'guest_name' => $guest_data["firstName"] . ' ' . $guest_data["lastname"],
					'host_id' => $hostid,
					'host_name' => $host_data["firstName"] . ' ' . $host_data["lastname"],
				];
				$last_id = $this->inbox_m->insertID($this->inbox_m->save($inboxData));
				$bookings_data[$key]['guest_chat_id'] = $last_id;
			}
		}
		$this->data['bookings_data'] = $bookings_data;

		// return print_r($this->data);
		return view('Frontend/account/account_trips', $this->data);
	}
	public function account_wishlist()
	{
		$this->data['pageJS'] = '<script>
		const body = document.getElementsByTagName("body")[0];
		body.classList.remove("transparent-header");</script>';

		return view('Frontend/account/index', $this->data);
	}
	public function account_settings()
	{
		$this->data['pageJS'] = '<script>
		const body = document.getElementsByTagName("body")[0];
		body.classList.remove("transparent-header");</script>';

		return view('Frontend/account/index', $this->data);
	}
}
