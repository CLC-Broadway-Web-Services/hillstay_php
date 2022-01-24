<?php

if (!function_exists('currentUserAadhaarVerify')) {
    function currentUserAadhaarVerify()
    {
        $data = session()->get('user_verification');
        if ($data && $data['aadhaar_status'] == '1') {
            return true;
        }
        return false;
    }
}

if (!function_exists('currentUserPancardVerify')) {
    function currentUserPancardVerify()
    {
        $data = session()->get('user_verification');
        if ($data && $data['pancard_status'] == '1') {
            return true;
        }
        return false;
    }
}

if (!function_exists('currentUserVerification')) {
    function currentUserVerification()
    {
        $verified = [];
        if (currentUserAadhaarVerify()) {
            $verified = ['pancard'];
        }
        if (currentUserPancardVerify()) {
            $verified = ['aadhaar_status'];
        }
        return $verified;
    }
}
