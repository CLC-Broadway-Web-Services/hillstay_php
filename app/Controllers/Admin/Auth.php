<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AdminModel;

class Auth extends BaseController
{
    public function index()
    {
        if ($this->request->getMethod() == 'get') {
            return view('Administrator/Auth/login');
        }
        if ($this->request->getMethod() == 'post') {
            helper(['form']);

            $admin = new AdminModel();

            $email = $this->request->getVar('adminEmail');
            $password = sha1(sha1(sha1($this->request->getVar('adminPassword'))));

            $data = $admin->authenticateAdmin($email, $password);
            if ($data['response'] == 'success') {
                if ($admin->setUserMethod($data['value']) == true) {
                    return redirect()->to('/administrator');
                }
            } else {
                $data['errorMessage'] = session()->getFlashdata('errorMessage');
                return view('Administrator/Auth/login', $data);
            }
        }
    }
    public function logOut()
    {

        // $data = ['adminid', 'firstname', 'lastname', 'email', 'country_code', 'type', 'isAdminLoggedIn'];
        // session()->remove($data);
        session()->destroy();
        // echo json_encode(true);
        return redirect()->to(base_url() . '/administrator/login');
        // return view('admin/auth/login');
    }
    public function forgetPassword()
    {
        $data = array();
        $admin = new AdminModel();
        helper(['form']);

        if ($this->request->getGet('resetcode')) {
            $data['pageJS'] = '<script src="/public/custom/assets/js/adminResetPassword.js"></script>';
            if ($this->request->getMethod() == 'post') {
                if ($this->request->getPost('user_email1')) {
                    $user_email = $this->request->getPost('user_email1');
                    $reset_code = $this->request->getPost('reset_code1');

                    $resetVerify = $admin->verifyCode($user_email, $reset_code);
                    if ($resetVerify['response'] == 'success') {
                        $data['passwordVerified'] = session()->getFlashdata('passwordVerified');
                        $data['reset_code'] = session()->getFlashdata('reset_code');
                        $data['user_email'] = session()->getFlashdata('user_email');
                    } else {
                        $data['errorMessage'] = session()->getFlashdata('errorMessage');
                    }
                }
                if ($this->request->getPost('user_email')) {
                    $user_email = $this->request->getPost('user_email');
                    $reset_code = $this->request->getPost('reset_code');
                    $new_password = $this->request->getPost('new_password');

                    $chagePassword = $admin->resetPassword($user_email, $reset_code, $new_password);
                    if ($chagePassword['response'] == 'success') {
                        return redirect()->to('/administrator/login');
                    } else {
                        $data['errorMessage'] = session()->getFlashdata('errorMessage');
                    }
                }
            }
            return view('Administrator/Auth/resetpassword', $data);
        }

        if ($this->request->getMethod() == 'post' && !$this->request->getGet('resetcode')) {

            $email = $this->request->getVar('adminEmail');

            $data = $admin->forgetPassword($email);
            if ($data['response'] == 'success') {
                $data['successMessage'] = session()->getFlashdata('successMessage');
                return redirect()->to('/administrator/forgetpassword?resetcode='.$email);
            } else {
                $data['errorMessage'] = session()->getFlashdata('errorMessage');
            }
        }
        return view('Administrator/Auth/forgetpassword', $data);
    }
}
