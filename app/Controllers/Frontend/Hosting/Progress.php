<?php

namespace App\Controllers\Frontend\Hosting;

use App\Controllers\BaseController;

class Progress extends BaseController
{
	private $data;

	public function __construct()
	{
		$this->data = array();
		$this->data['user_name'] = session()->get('firstName');
	}
	public function index()
	{
		return view('Frontend/host/progress/index', $this->data);
	}
}
