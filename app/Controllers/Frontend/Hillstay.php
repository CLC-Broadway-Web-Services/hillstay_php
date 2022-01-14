<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;

class Hillstay extends BaseController
{
    public $data;
    public $userMd;
    public function __construct()
    {
    }
    public function contact_us()
    {
        return view('Frontend/hillstay/contact_us');
    }
    public function about_us()
    {
        return view('Frontend/hillstay/about_us');
    }
    public function faq()
    {
        return view('Frontend/hillstay/faq');
    }
    public function pricing()
    {
        return view('Frontend/hillstay/pricing');
    }
    public function how_it_works()
    {
        return view('Frontend/hillstay/how_it_works');
    }
}
