<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BookingsModel;
use App\Models\Admin\ListingModel;

class Dashboard extends BaseController
{
    protected $data;
    protected $admin;
    protected $bookingDb;
    protected $listingModel;


    public function __construct()
    {
        $this->data = array();  
        $this->listingModel = new ListingModel();
        $this->bookingDb = new BookingsModel();
        $this->admin = session()->get('admin');      
    }
    public function index()
    {
        $this->data['admin'] =  $this->admin;
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        // return print_r($this->data);
        $this->data['totalListing'] = $this->listingModel->countAllResults();
		$this->data['activeListing'] = $this->listingModel->where(['status' => 1, 'published' => 1])->countAllResults();
        $this->data['pendingBooking'] = $this->bookingDb->where( 'status_name' , 'requested')->countAllResults();
		$this->data['totalBookingCount'] = $this->bookingDb->countAllResults();
		$this->data['bookingReject'] = $this->bookingDb->where( 'status_name' , 'cancelled')->countAllResults();
		$this->data['bookingAccepted'] = $this->bookingDb->where( 'status_name' , 'completed')->countAllResults();
        return view('Administrator/Dashboard/dashboard', $this->data);
    }
}
