<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Admin\UserModel;
use App\Models\Admin\UserverifyModel;

class Auth extends BaseController
{
    public $data;
    public $userMd;
    public function __construct()
    {
        $this->data = array();
        $this->userMd = new UserModel();
        $this->data['pageJS'] = '<script>
		const body = document.getElementsByTagName("body")[0];
		body.classList.remove("transparent-header");</script>';
    }
    public function login()
    {
        if(session()->get('isUserLoggedIn')) {
            return redirect('account_profile');
        }
        $client = new \Google_Client();
        $client->setClientId(CLIENT_ID);
        $client->setClientSecret(CLIENT_SECRET);

        $client->setRedirectUri(base_url() . '/login');
        $client->addScope('email');
        $client->addScope('profile');

        if ($this->request->getVar('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
            if (!isset($token['error'])) {
                $client->setAccessToken($token['access_token']);
                session()->set('access_token', $token['access_token']);

                $google_service = new \Google_Service_Oauth2($client);

                $gData = $google_service->userinfo->get();
                // print_r($gData['email']);
                // return;
                $g_oauth_id =  $gData['id'];
                $googleEmail = $gData['email'];

                if ($this->userMd->checkEmailExist($googleEmail)) {
                    if ($this->userMd->checkGoogleExist($g_oauth_id)) {
                        $userData = $this->userMd->where('email', $googleEmail)->first();
                        unset($userData['usr_password']);
                        session()->set($userData);

                        $this->data = [
                            'isUserLoggedIn' => true,
                        ];
                        session()->set($this->data);

                        $this->setUserMethod($this->data);
                        return redirect('account_profile');
                    } else {

                        $data2 = [
                            'emailVerified' => $gData['verified_email'],
                            'g_oauth_id' => $g_oauth_id
                        ];
                        $update = $this->userMd->set($data2)->where(['email' => $googleEmail])->update();
                        $userData = $this->userMd->where(['email' => $googleEmail])->first();
                        unset($userData['usr_password']);
                        session()->set($userData);

                        $this->data = [
                            'isUserLoggedIn' => true,
                        ];
                        session()->set($this->data);

                        $this->setUserMethod($this->data);
                        return redirect('account_profile');
                    }
                } else {
                    $google_data = [
                        'firstName' => $gData['given_name'],
                        'lastname' => $gData['family_name'],
                        'photoURL' => $gData['picture'],
                        'email' => $googleEmail,
                        'emailVerified' => $gData['verified_email'],
                        'g_oauth_id' => $g_oauth_id,
                    ];

                    $registerUser = $this->userMd->insertId($this->userMd->insert($google_data));

                    $userData = $this->userMd->find($registerUser);
                    unset($userData['usr_password']);
                    session()->set($userData);

                    $this->data = [
                        'isUserLoggedIn' => true,
                    ];
                    session()->set($this->data);

                    $this->setUserMethod($this->data);
                    return redirect('account_profile');
                    //create user here
                }
            }
        }

        if ($this->request->getMethod() == 'post' && $this->request->getPost('username')) {
            // return print_r($_POST);

            $currentUrl = null;
            if($this->request->getPost('currentUrl')) {
                $currentUrl = $this->request->getPost('currentUrl');
            };

            $email = $this->request->getPost('username');
            $usr_password = sha1(sha1(sha1($this->request->getPost('password'))));

            $userData = $this->userMd->where('email', $email)->first();

            if ($userData != null) {
                if ($usr_password !== $userData['usr_password']) {
                    $this->data['response'] =  array(
                        'response' => 'failed',
                        'type' => 'password',
                        'value' => 'Credentials not matched.'
                    );
                } else {
                    unset($userData['usr_password']);
                    session()->set($userData);

                    $this->data = [
                        'isUserLoggedIn' => true,
                    ];
                    session()->set($this->data);

                    $this->setUserMethod($this->data);
                    // return redirect()->to('/account/profile');
                    // if($currentUrl !== null) {
                    //     return redirect()->to('/'.$currentUrl);
                    // };
                    // return redirect('account_profile');
                    return redirect()->back();
                }
            } else {
                $this->data['response'] = array(
                    'response' => 'failed',
                    'type' => 'notfound',
                    'value' => 'User Not Found.'
                );
            }
        }

        // if (!session()->get('access_token')) {
        $this->data['googleLogin'] = $client->createAuthUrl();
        // }

        return view('Frontend/auth/login', $this->data);
    }
    public function login_plain()
    {
        helper(['form']);

        $this->userMd = new UserModel();

        if ($this->request->getMethod() == 'post') {
            // return print_r($_POST);

            $email = $this->request->getPost('username');
            $usr_password = sha1(sha1(sha1($this->request->getPost('password'))));

            $userData = $this->userMd->where('email', $email)->first();


            if ($userData != null) {
                if ($usr_password !== $userData['usr_password']) {
                    $this->data['response'] =  array(
                        'response' => 'failed',
                        'type' => 'password',
                        'value' => 'Credentials not matched.'
                    );
                } else {
                    unset($userData['usr_password']);
                    session()->set($userData);

                    $this->data = [
                        'isUserLoggedIn' => true,
                    ];
                    session()->set($this->data);

                    $this->setUserMethod($this->data);
                    // return redirect()->to('/account/profile');
                    return redirect('account_profile');
                }
            } else {
                $this->data['response'] = array(
                    'response' => 'failed',
                    'type' => 'notfound',
                    'value' => 'User Not Found.'
                );
            }
        }
        return view('Frontend/auth/login', $this->data);
    }
    public function register()
    {
        helper(['form']);

        $this->userMd = new UserModel();

        if ($this->request->getMethod() == 'post') {
            // return print_r($_POST);

            $firstName = $this->request->getPost('firstName');
            $lastname = $this->request->getPost('lastname');
            $email = $this->request->getPost('email');
            $usr_password = sha1(sha1(sha1($this->request->getPost('usr_password'))));
            $usr_password_confirm = sha1(sha1(sha1($this->request->getPost('usr_password_confirm'))));

            if ($usr_password !== $usr_password_confirm) {
                $this->data['response'] =  array(
                    'response' => 'failed',
                    'type' => 'password',
                    'value' => 'Password not matched.'
                );
            } else {
                $duplicate = $this->userMd->select('uid')->where('email', $email)->first();

                if ($duplicate != null) {
                    $this->data['response'] = array(
                        'response' => 'failed',
                        'type' => 'duplicate',
                        'value' => 'User already exist.'
                    );
                } else {
                    $userData = [
                        'firstName' => $firstName,
                        'lastname' => $lastname,
                        'email' => $email,
                        'usr_password' => $usr_password,
                    ];

                    $registerUser = $this->userMd->insertId($this->userMd->insert($userData));

                    if ($registerUser) {
                        $userData['uid'] = $registerUser;
                        if ($this->sendVerificationEmail($userData)) {
                            $this->data['response'] =  array(
                                'response' => 'success',
                                'value' => $userData
                            );
                        } else {
                            $this->data['response'] =  array(
                                'response' => 'failed',
                                'type' => 'server',
                                'value' => 'Server error happened.'
                            );
                        }
                    } else {
                        $this->data['response'] =  array(
                            'response' => 'failed',
                            'type' => 'server',
                            'value' => 'Server error happened.'
                        );
                    }
                    // return print_r($this->data);
                }
            }

            // return print_r($this->data);

            $response = $this->data['response'];
            return view('Frontend/auth/login', $this->data);
        }
        return view('Frontend/auth/register', $this->data);
    }
    public function recover()
    {

        if ($this->request->getMethod() == 'get') {
            return view('Frontend/auth/recover', $this->data);
        }
    }
    public function logOut()
    {

        // $this->data = ['adminid', 'firstname', 'lastname', 'email', 'country_code', 'type', 'isAdminLoggedIn'];
        // session()->remove($this->data);
        session()->destroy();
        // echo json_encode(true);
        return redirect()->to(base_url() . '/');
        // return view('admin/auth/login');
    }
    private function sendVerificationEmail($userData)
    {
        $email = \Config\Services::email();
        $userVerifyMd = new UserverifyModel();

        $subject = 'Hillstay Verification';

        $verifyCode = rand(1000000, 9999999);

        $message = 'Your verification code is ' . $verifyCode;

        $verifyData = [
            'uid' => $userData['uid'],
            'type' => 'email',
            'code' => $verifyCode,
        ];

        $userVerifyMd->insert($verifyData);

        $config['charset']  = 'iso-8859-1';
        $config['mailType'] = 'html';
        $email->initialize($config);

        $email->setFrom(APP_NAME, NO_REPLY_EMAIL);
        $email->setTo($userData['email']);

        $email->setSubject($subject);
        $email->setMessage($message);

        return $email->send();
    }
    public function setUserMethod($user)
    {
        $user['isUserLoggedIn'] = true;
        // $this->data = [
        //     'user' => $user,
        //     'isUserLoggedIn' => true,
        // ];
        session()->set($user);
        return true;
    }
    // private function uniqidReal($lenght = 13) {
    //     // uniqid gives 13 chars, but you could adjust it to your needs.
    //     if (function_exists("random_bytes")) {
    //         $bytes = random_bytes(ceil($lenght / 2));
    //     } elseif (function_exists("openssl_random_pseudo_bytes")) {
    //         $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
    //     } else {
    //         throw new \Exception("no cryptographically secure random function available");
    //     }
    //     return substr(bin2hex($bytes), 0, $lenght);
    // }

    // public function forgetPassword()
    // {
    //     
    //     $admin = new AdminModel();
    //     helper(['form']);

    //     if ($this->request->getGet('resetcode')) {
    //         $this->data['pageJS'] = '<script src="/public/custom/assets/js/adminResetPassword.js"></script>';
    //         if ($this->request->getMethod() == 'post') {
    //             if ($this->request->getPost('user_email1')) {
    //                 $user_email = $this->request->getPost('user_email1');
    //                 $reset_code = $this->request->getPost('reset_code1');

    //                 $resetVerify = $admin->verifyCode($user_email, $reset_code);
    //                 if ($resetVerify['response'] == 'success') {
    //                     $this->data['passwordVerified'] = session()->getFlashdata('passwordVerified');
    //                     $this->data['reset_code'] = session()->getFlashdata('reset_code');
    //                     $this->data['user_email'] = session()->getFlashdata('user_email');
    //                 } else {
    //                     $this->data['errorMessage'] = session()->getFlashdata('errorMessage');
    //                 }
    //             }
    //             if ($this->request->getPost('user_email')) {
    //                 $user_email = $this->request->getPost('user_email');
    //                 $reset_code = $this->request->getPost('reset_code');
    //                 $new_password = $this->request->getPost('new_password');

    //                 $chagePassword = $admin->resetPassword($user_email, $reset_code, $new_password);
    //                 if ($chagePassword['response'] == 'success') {
    //                     return redirect()->to('/administrator/login');
    //                 } else {
    //                     $this->data['errorMessage'] = session()->getFlashdata('errorMessage');
    //                 }
    //             }
    //         }
    //         return view('Administrator/Auth/resetpassword', $this->data);
    //     }

    //     if ($this->request->getMethod() == 'post' && !$this->request->getGet('resetcode')) {

    //         $email = $this->request->getVar('adminEmail');

    //         $this->data = $admin->forgetPassword($email);
    //         if ($this->data['response'] == 'success') {
    //             $this->data['successMessage'] = session()->getFlashdata('successMessage');
    //             return redirect()->to('/administrator/forgetpassword?resetcode='.$email);
    //         } else {
    //             $this->data['errorMessage'] = session()->getFlashdata('errorMessage');
    //         }
    //     }
    //     return view('Administrator/Auth/forgetpassword', $this->data);
    // }
}
