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
			->select('listing_id, title, status, finished, published, placekind, guests, propertytype, location, price, created_at, updated_at')
			->orderBy('listing_id', 'DESC')->findAll();

		$this->data['listings'] = $listings;

		// return print_r($this->data);
		return view('Administrator/Dashboard/listings/index', $this->data);
	}
	public function save($listing_id = null)
	{
	}
	public function show($listing_id = null)
	{
	}
	public function activate($listing_id = null)
	{
		$listing = $this->listing_m->where(['listing_id' => $listing_id])->first();
		if ($listing != null) {
			if ($listing['status'] == 1) {
				$query = $this->listing_m->set(['status' => 0])->where(['listing_id' => $listing_id])->update();
				if ($query) {
					// $respose = array(
					// 	'status' => 'success',
					// );
					// return $respose;
				} else {
					$message = array(
						'serviceStatusMessage' => $this->listing_m->error()
					);
					session()->setFlashdata($message);
				}
			} else {
				$query = $this->listing_m->set(['status' => 1, 'finished' => 1, 'published' => 1])->where(['listing_id' => $listing_id])->update();
				if ($query) {
					// $respose = array(
					// 	'status' => 'success',
					// );
					// return $respose;
				} else {
					// $respose = array(
					// 	'status' => 'failed',
					// 	'message' => 'Failed to change status, please contact support.',
					// );
					$message = array(
						'serviceStatusMessage' => 'Failed to change status, please contact support.'
					);
					session()->setFlashdata($message);
					// return $respose;
				}
			}
		} else {
			$message = array(
				'serviceStatusMessage' => 'No faq found for this request.'
			);
			session()->setFlashdata($message);
			// $respose = array(
			// 	'status' => 'failed',
			// 	'message' => 'No faq found for this request.',
			// );
			// return $respose;
		}
		return redirect()->route('admin_all_listing');
	}
	public function reject($listing_id = null)
	{
	}
	public function homeStatus($listing_id = null)
	{
	}
	public function delete($listing_id = null)
	{
		$this->listing_m->delete($listing_id);
		return redirect()->route('admin_all_listing');
	}
}
