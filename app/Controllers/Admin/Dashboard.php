<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $data;
    protected $admin;

    public function __construct()
    {
        $this->data = array();  
        $this->admin = session()->get('admin');      
    }
    public function index()
    {
        $this->data['admin'] =  $this->admin;
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        // return print_r($this->data);
        return view('Administrator/Dashboard/dashboard', $this->data);
    }
}
