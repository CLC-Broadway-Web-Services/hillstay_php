<?php

namespace App\Controllers\Frontend\Hosting;

use App\Controllers\BaseController;
use App\Models\Admin\BookingsModel;
use App\Models\Admin\ListingModel;

class Dashboard extends BaseController
{
	private $data;
	private $listingDb;
	private $bookingDb;

	public function __construct()
	{
		$this->data = array();
		$this->data['user_name'] = session()->get('firstName');
		$this->listingDb = new ListingModel();
		$this->bookingDb = new BookingsModel();
	}
	public function index()
	{
		$userId = session()->get('uid');
		// total listings
		$totalListings = $this->listingDb->where(['uid' => $userId])->countAllResults();
		// active listings
		$activeListings = $this->listingDb->where(['uid' => $userId, 'status' => 1, 'published' => 1])->countAllResults();
		// total bookings
		// $totalReservations = $this->bookingDb->where(['host_id' => $userId, 'payment_status' => 1])->countAllResults();
		// total reviews
		

		// new requests with all listings dropdown
		// $booking = $this->bookingDb->where(['requested' => 1, 'cancelled' => 0, 'approved' => 0, 'completed' => 0, 'host_id' => $userId])->orderBy('id', 'desc')->first();
		// foreach ($bookings_data as $key => $booking) {
		// $listingId = $booking['listing_id'];
		// $booking['listing'] = $this->listingDb->select('listing_id, title')->find($listingId);
		// }
		// current reservations
		$this->data['totalListings'] = $totalListings;
		$this->data['activeListings'] = $activeListings;
		// $this->data['totalReservations'] = $totalReservations;
		// $this->data['booking'] = $booking;

		return view('Frontend/host/dashboard/index', $this->data);
	}
}
