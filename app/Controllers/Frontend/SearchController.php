<?php

namespace App\Controllers\Frontend;
use App\Controllers\BaseController;

class SearchController extends BaseController
{
	private $data;

	public function __construct()
	{
		$this->data = array();
		$this->data['user_name'] = null;
		$this->data['user_id'] = null;
		if (!session()->get('isUserLoggedIn')) {
			$this->data['user_name'] = session()->get('firstName');
			$this->data['user_id'] = session()->get('uid');
		}
	}
	public function index($list = 'bo')
	{
		$this->data['leafletScripts'] = true;
		// $this->data['pageJS'] = '<script src="/public/custom/assets/js/homepage.js"></script>';

		$this->data['noStickyHeader'] = true;
		if($list == 'list') {
			$this->data['noFooter'] = true;
			return view('Frontend/pages/Search/indexList', $this->data);
		} else {
			return view('Frontend/pages/Search/index', $this->data);
		}
	}
}
