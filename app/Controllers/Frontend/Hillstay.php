<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Admin\ContactusModel;

class Hillstay extends BaseController
{
    public $data;
    public $userMd;
    public $contactModel;
    public function __construct()
    {
        $this->session = session();
        $this->contactModel = new ContactusModel();
        
    }
    public function contact_us()
    {
        if ($this->request->getMethod() == 'post') {

            $name = $this->request->getVar('name');
            $email = $this->request->getVar('email');
            $mobile = $this->request->getVar('mobile');
            $subject = $this->request->getVar('subject');
            $comments = $this->request->getVar('comments');

            $contactData = [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'subject' => $subject,
                'comments' => $comments,
            ];

            //   return print_r($_POST);
              $saveContactData = $this->contactModel->insert($contactData);
              if ($saveContactData) {
                $email = \Config\Services::email();
                $email->setFrom('abu06021995@gmail.com', 'Your Name');
                $email->setTo('abu06021995@gmail.com');
                $email->setCC('another@another-example.com');
                $email->setBCC('them@their-example.com');
                
                $email->setSubject('Email Test');
                $email->setMessage('Testing the email class.');
                
                $email->send();
                  $this->session->setFlashdata("contact", "Data Saved");
                  return redirect()->route('contact_us');
              } else {
                  $response['message'] = 'User not found';
              }
        }
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
    public function privacy_policy()
    {
        return view('Frontend/pages/privacy_policy');
    }
}
