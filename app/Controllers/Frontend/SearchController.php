<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Admin\ListingModel;

class SearchController extends BaseController
{
	private $data;
	protected $listingModel;
	public function __construct()
	{
		$this->data = array();
		$this->data['user_name'] = null;
		$this->data['user_id'] = null;
		$this->listingModel = new ListingModel();
		if (!session()->get('isUserLoggedIn')) {
			$this->data['user_name'] = session()->get('firstName');
			$this->data['user_id'] = session()->get('uid');
		}
	}
	public function index($list = 'no')
	{
		// return print_r($this->request->getVar('location'));
		$this->data['leafletScripts'] = true;
		// $this->data['pageJS'] = '<script src="/public/custom/assets/js/homepage.js"></script>';
		$this->data['noStickyHeader'] = true;

		// return print_r($this->data);
		$location = $this->request->getVar('location');

		if ($list == 'list') {
			$this->data['noFooter'] = true;
			return view('Frontend/pages/Search/indexList', $this->data);
		} else {
			$this->data['searchList'] = $this->listingModel->where(['status' => 1, 'location' => $location, 'published' => 1])
			->select('location, title, coverimage, price')->findAll();
			return view('Frontend/pages/Search/index', $this->data);
		}
	}
}
