<?php

namespace App\Controllers\Frontend\Hosting;

use CodeIgniter\Controller;

class Calendar extends Controller
{
	private $data;

	public function __construct()
	{
		$this->data = array();
		$this->data['user_name'] = session()->get('firstName');
	}
	public function index()
	{
		return view('Frontend/host/calendar/index', $this->data);
	}
}
