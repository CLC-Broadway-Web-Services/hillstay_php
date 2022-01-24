<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Team extends BaseController
{
    public function index()
    {
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/dashboard', $data);
    }
    public function addEditMember()
    {
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/dashboard', $data);
    }
}
