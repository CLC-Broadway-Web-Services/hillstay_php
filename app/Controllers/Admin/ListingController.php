<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Admin\ListingModel;

class ListingController extends Controller
{
	protected $data;
	protected $admin;
	protected $listing_m;

	public function __construct()
	{
		$this->data = array();
		$this->admin = session()->get('admin');
		$this->listing_m = new ListingModel();
	}
	public function index()
	{
		$listings = $this->listing_m
		->select('listing_id, title, status, finished, published, placekind, guests, propertytype, location, price')
		->orderBy('listing_id', 'DESC')->findAll();

		$this->data['listing'] = $listings;

		return print_r($this->data);

	}
	public function save($listing_id = null)
	{
	}
	public function activate($listing_id = null)
	{
	}
	public function reject($listing_id = null)
	{
	}
	public function homeStatus($listing_id = null)
	{
	}
}
