<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BookingsModel;
use App\Models\Admin\ListingModel;
use App\Models\Admin\UserContactInfoModel;
use App\Models\Admin\UserModel;
use App\Models\Admin\UserPaymentMethodModel;

class UsersController extends BaseController
{
	protected $userModel;
	protected $listingModel;
	protected $bookingDb;
	protected $data;
	protected $session;

	public function __construct()
	{
		$this->data = array();
		$this->session = session();
		$this->userModel = new UserModel();
		$this->listingModel = new ListingModel();
		$this->bookingDb = new BookingsModel();
	}
	public function user_list()
	{
		$this->data['userdata'] = $this->userModel->orderBy('uid', 'DESC')->findAll();
		return view('Administrator/Dashboard/users/user-list', $this->data);
	}
	public function user_view($id = null)
	{
		$method_m = new UserPaymentMethodModel();
		$info_m = new UserContactInfoModel();
		$this->data['payment_methods'] = $method_m->getUserMethods($id);
		$this->data['contact_info'] = $info_m->getUserMethods($id);
        // return print_r($this->data);
		$this->data['userView'] = $this->userModel->orderBy('uid', 'DESC')->where('uid', $id)->first();
		
		$this->data['userDataCount'] = $this->listingModel->where('uid', $id)->countAllResults();
		$this->data['activeDataCount'] = $this->listingModel->where(['uid' => $id, 'status' => 1, 'published' => 1])->countAllResults();
		$this->data['pendingBooking'] = $this->bookingDb->where(['host_id' => $id, 'status_name' => 'requested'])->countAllResults();
		$this->data['totalBookingCount'] = $this->bookingDb->where('host_id', $id)->countAllResults();
		$this->data['bookingReject'] = $this->bookingDb->where(['host_id' => $id, 'status_name' => 'cancelled'])->countAllResults();

		// return print_r($this->data);
		return view('Administrator/Dashboard/users/user-view', $this->data);
	}
}
