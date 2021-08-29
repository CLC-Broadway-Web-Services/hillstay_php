<?php

namespace App\Controllers\Frontend\Hosting;

use App\Models\Admin\BookingGuestModel;
use App\Models\Admin\BookingsModel;
use App\Models\Admin\Chatsystem;
use App\Models\Admin\InboxModel;
use App\Models\Admin\ListingModel;
use App\Models\Admin\UserModel;
use CodeIgniter\Controller;

class Reservations extends Controller
{
	private $data;
	private $listing_m;
	private $bookings_m;
	private $booking_guests_m;
	private $inbox_m;
	private $user_m;
	private $session;

	public function __construct()
	{
		$this->data = array();
		$this->session = session();
		$this->data['user_name'] = $this->session->get('firstName');
		$this->data['user_id'] = $this->session->get('uid');
		$this->listing_m = new ListingModel();
		$this->bookings_m = new BookingsModel();
		$this->booking_guests_m = new BookingGuestModel();
		$this->inbox_m = new InboxModel();
		$this->user_m = new UserModel();
		helper('file');
	}
	public function index()
	{
		$host_id = $this->data['user_id'];
		$getParam = '';
		if ($this->request->getMethod() == 'get' && $this->request->getVar('type')) {
			$getParam = $this->request->getGet('type');
			if ($getParam == 'completed') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'completed' => 1, 'approved' => 1, 'host_id' => $host_id])->findAll();
			} else if ($getParam == 'approved') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'cancelled' => 0, 'approved' => 1, 'completed' => 0, 'host_id' => $host_id])->findAll();
			} else if ($getParam == 'rejected') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'cancelled' => 1, 'approved' => 0, 'completed' => 0, 'host_id' => $host_id])->findAll();
			} else if ($getParam == 'new') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'cancelled' => 0, 'approved' => 0, 'completed' => 0, 'host_id' => $host_id])->findAll();
			} else {
				$bookings_data = $this->bookings_m->where(['host_id' => $host_id])->findAll();
			}
		} else {
			$bookings_data = $this->bookings_m->where(['host_id' => $host_id])->findAll();
		}
		foreach ($bookings_data as $key => $booking) {
			$decoded = json_decode($booking['price_breakdown']);
			// $data_to_encode = json_encode($decoded);
			$bookings_data[$key]['price_breakdown'] = $decoded;
		}
		foreach ($bookings_data as $key => $booking) {
			$booking_id = $booking['id'];
			$bookings_data[$key]['guest_details'] = $this->booking_guests_m->where(['booking_id' => $booking_id])->findAll();
			$bookings_data[$key]['user_id_64'] = base64_encode(base64_encode(base64_encode($booking['user_id'])));
			$userid = $booking['user_id'];
			$hostid = $booking['host_id'];
			$inbox = $this->inbox_m->where(['guest_id' => $userid, 'host_id' => $hostid])->first();
			if ($inbox) {
				$bookings_data[$key]['guest_chat_id'] = $inbox['id'];
			} else {
				$guest_data = $this->user_m->select('firstName, lastname')->find($userid);
				$host_data = $this->user_m->select('firstName, lastname')->find($hostid);
				$inboxData = [
					'guest_id' => $userid,
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
		return view('Frontend/host/reservation/index', $this->data);
	}

	public function approve()
	{
		$id = $this->request->getPost('id');
		$data = [
			'id' => $id,
			'status_name' => 'approved',
			'approved' => 1,
			'completed' => 0,
			'cancelled' => 0
		];
		if ($this->bookings_m->save($data)) {
			return json_encode(['success' => true]);
		} else {
			return json_encode(['success' => false]);
		}
	}
	public function reject()
	{
		$id = $this->request->getPost('id');
		$data = [
			'id' => $id,
			'status_name' => 'cancelled',
			'approved' => 0,
			'completed' => 0,
			'cancelled' => 1
		];
		if ($this->bookings_m->save($data)) {
			return json_encode(['success' => true]);
		} else {
			return json_encode(['success' => false]);
		}
	}
}
