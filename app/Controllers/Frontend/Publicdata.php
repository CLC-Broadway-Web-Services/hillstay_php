<?php

namespace App\Controllers\Frontend;

use App\Models\Admin\UsermedicalModel;
use App\Models\Admin\UserModel;
use App\Controllers\BaseController;

class Publicdata extends BaseController
{
	public function profile($userId)
	{
		$userMD = new UserModel();
		$medicalMd = new UsermedicalModel();
		$currentid = base64_decode(base64_decode(base64_decode($userId)));
		$userData = $userMD->find($currentid);
		$languages = array();
		if ($userData['languages']) {
			$languages = json_decode($userData['languages']);
		}
		$userData['languages'] = $languages;
		$this->data['user'] = $userData;
		if ($userData['medical_history_id']) {
			$medicalData = $medicalMd->find($userData['medical_history_id']);
			$this->data['medical'] = $medicalData;
		}
		// return print_r($this->data);
		$this->data['pageJS'] = '<script>const body = document.getElementsByTagName("body")[0];body.classList.remove("transparent-header");</script>';
		return view('Frontend/public/profile', $this->data);
	}
}
