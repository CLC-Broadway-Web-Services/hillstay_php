<?php

namespace App\Controllers\Frontend\Hosting;

use App\Models\Admin\BookingGuestModel;
use App\Models\Admin\BookingsModel;
use App\Models\Admin\Chatsystem;
use App\Models\Admin\InboxModel;
use App\Models\Admin\ListingModel;
use App\Models\Admin\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Inbox extends Controller
{
	private $data;
	private $listing_m;
	private $bookings_m;
	private $booking_guests_m;
	private $inbox_m;
	private $chat_m;
	private $user_m;
	private $session;


	public function __construct()
	{
		$this->data = array();
		$this->session = session();
		$this->data['user_name'] = $this->session->get('firstName') . ' ' . $this->session->get('lastname');
		$this->data['user_id'] = $this->session->get('uid');
		$this->data['host_image'] = $this->session->get('photoURL');
		$this->data['time'] = new Time;
		$this->listing_m = new ListingModel();
		$this->bookings_m = new BookingsModel();
		$this->booking_guests_m = new BookingGuestModel();
		$this->inbox_m = new InboxModel();
		$this->chat_m = new Chatsystem();
		$this->user_m = new UserModel();
		helper('file');
		helper('number');
	}
	public function index()
	{
		$inboxes = $this->inbox_m->getAllHostInboxes();
		$this->data['inboxes'] = $inboxes;
		// return print_r($this->data);
		return view('Frontend/host/inbox/index', $this->data);
	}
	public function chat($guestid)
	{
		$inboxes = $this->inbox_m->getAllHostInboxes();
		$this->data['inboxes'] = $inboxes;
		$guestId = base64_decode(base64_decode(base64_decode($guestid)));
		$this->data['current_guest'] = $guestid;
		$inbox = $this->inbox_m->where(['guest_id' => $guestId, 'host_id' => $this->data['user_id']])->first();
		$guest = $this->user_m->getGuestDetails($guestId);
		if (!$inbox) {
			$newInboxData = [
				'guest_id' => $guestId,
				'guest_name' => $guest['firstName'] . ' ' . $guest['lastname'],
				'host_id' => $this->data['user_id'],
				'host_name' => $this->data['user_name']
			];
			$lastId = $this->inbox_m->insertID($this->inbox_m->save($newInboxData));
			$inbox = $this->inbox_m->find($lastId);
		}
		$this->data['inbox'] = $inbox;
		$this->data['guest'] = $guest;
		// $chats = $this->chat_m->where(['userid' => $inbox["guest_id"], 'hostid' => $inbox["host_id"]])->orderBy('created_at', 'asc')->findAll();
		$chats = $this->chat_m->where(['inbox' => $inbox["id"]])->orderBy('mid', 'asc')->findAll();
		$this->data['chats'] = $chats;
		$bookings = $this->bookings_m->where(['user_id' => $inbox["guest_id"], 'host_id' => $inbox["host_id"]])->orderBy('created_at', 'desc')->findAll();
		$this->data['bookings'] = $bookings;
		$lastBooking = null;
		if ($this->request->getMethod() == 'post' && $this->request->getVar('message')) {
			$chatMessage = $this->request->getVar('message', FILTER_SANITIZE_STRIPPED);
			$chatData = [
				'inbox' => $inbox['id'],
				'userid' => $guest['uid'],
				'userName' => $guest['firstName'] . ' ' . $guest['lastname'],
				'hostid' => $this->data['user_id'],
				'hostName' => $this->data['user_name'],
				'message' => $chatMessage,
				'messagebyuser' => 0,
				'notifyUserWeb' => 1,
			];
			$this->chat_m->save($chatData);
			return redirect()->route('hosting_inbox_chat', [$guestid]);
			// echo '<pre>';
			// print_r($chatData);
			// echo '</pre>';
			// return;
		}

		if (count($bookings) > 0) {
			$lastBooking = $bookings[0];
		}
		$this->data['lastBooking'] = $lastBooking;
		$this->data['chatBox'] = true;

		// return print_r($this->data);
		return view('Frontend/host/inbox/index', $this->data);
	}
}
