<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use App\Models\Globals\PasswordresetModel;

class UserModel extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'uid';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'firstName',
		'lastname',
		'email',
		'usr_password',
		'medical_history_id',
		'aboutuser',
		'emailVerified',
		'g_oauth_id',
		'phone',
		'phoneVerified',
		'photoURL',
		'govID',
		'govIDverified',
		'languages',
		'gender',
		'addressLine1',
		'addressLine2',
		'state',
		'city',
		'country',
		'lastLogin',
		'isHost',
	];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $createdField  = 'registered';
	protected $updatedField  = 'updated_time';
	protected $deletedField  = 'deleted_at';

	public function authenticateUser($email, $password)
	{
		$session = session();
		$data = $this->where(['email' => $email])->first();

		if ($data != null) {
			if ($data['usr_password'] == $password) {
				$this->setUserMethod($data);
				// last login update
				$data2 = [
					'lastLogin' => date('Y-m-d H:i:s')
				];
				$this->set($data2)->where(['uid' => $data['uid']])->update();

				return array(
					'response' => 'success',
					'value' => $data
				);
				// return redirect()->to('/');
			} else {
				$error = array(
					'response' => 'failed',
					'errorMessage' => 'Password not matched'
				);
				$session->setFlashdata($error);
				return $error;
			}
		} else {
			$error = array(
				'response' => 'failed',
				'errorMessage' => 'User not found'
			);
			$session->setFlashdata($error);
			return $error;
		}
	}
	public function userRegistration($userData)
	{
	}
	public function setUserMethod($user)
	{
		$user = [
			'uid' => $user['uid'],
			'firstName' => $user['firstName'],
			'lastname' => $user['lastname'],
			'email' => $user['email'],
			'phone' => $user['phone'],
			'photoURL' => $user['photoURL'],
			'lastLogin' => $user['lastLogin'],
			'registered' => $user['registered'],
			'updated_time' => $user['updated_time'],
		];
		$data = [
			'user' => $user,
			'isUserLoggedIn' => true,
		];
		session()->set($data);
		return true;
	}
	public function getAdminDetails()
	{
		return session()->get('user');
	}
	public function checkUser()
	{
		if (session()->get('isUserLoggedIn')) {
			return true;
		}
		return false;
	}
	public function forgetPassword($email)
	{
		$session = session();
		$data = $this->where(['email' => $email])->first();
		$prModel = new PasswordresetModel();
		if ($data != null) {

			$reset_code = round(microtime(true));

			$dataToUpload = [
				'reset_code' => $reset_code,
				'reset_email' => $data['email'],
				'reset_user_id' => $data['uid'],
				'reset_user_table' => 'users',
			];

			$resetQuery = $prModel->insert($dataToUpload);

			if ($resetQuery) {
				$subject = 'Password Reset Request.';
				$user_email = $data['email'];
				$message = 'Your password reset code is <h4>' . $reset_code . '</h4> please use this link "<a href="' . base_url() . '/administrator/forgetpassword?resetcode=' . $user_email . '">' . base_url() . '/administrator/forgetpassword?resetcode=' . $user_email . '</a>" to reset your password.';
				$sendemail = $this->sendAutoEmail($user_email, $message, $subject);
				if ($sendemail) {
					$data = array(
						'response' => 'success',
						'successMessage' => 'Please check your email for further intruction to verify your password.'
					);
					$session->setFlashdata($data);
					return $data;
				} else {
					$error = array(
						'response' => 'failed',
						'errorMessage' => 'Some error happened, try after some time. Or contact support.'
					);
					$session->setFlashdata($error);
					return $error;
				}
			} else {
				$error = array(
					'response' => 'failed',
					'errorMessage' => 'Some error happened, try after some time. Or contact support.'
				);
				$session->setFlashdata($error);
				return $error;
			}
		} else {
			$error = array(
				'response' => 'failed',
				'errorMessage' => 'User not found'
			);
			$session->setFlashdata($error);
			return $error;
		}
	}
	public function verifyCode($email, $resetCode)
	{
		$session = session();
		$prModel = new PasswordresetModel();

		$resetData = $prModel->where(['reset_email' => $email, 'reset_user_table' => 'users', 'reset_code' => $resetCode, 'reset_status' => 0])->first();

		if ($resetData != null) {

			$message = array(
				'response' => 'success',
				'passwordVerified' => true,
				'reset_code' => $resetData['reset_code'],
				'user_email' => $resetData['reset_email'],
			);
			$data = [
				'reset_status' => 1
			];

			$session->setFlashdata($message);

			$prModel->set($data)->where('reset_id', $resetData['reset_id'])->update();

			return $message;
		} else {
			$error = array(
				'response' => 'failed',
				'errorMessage' => 'Reset Code Invalid.'
			);

			$session->setFlashdata($error);

			return $error;
		}
	}
	public function resetPassword($email, $resetCode, $password)
	{
		$prModel = new PasswordresetModel();

		$resetData = $prModel->where(['reset_email' => $email, 'reset_user_table' => 'users', 'reset_code' => $resetCode, 'reset_status' => 1])->first();
		if ($resetData != null) {
			$userData = $this->where(['uid' => $resetData['reset_user_id']])->first();
			if ($userData != null) {

				$password2 = sha1(sha1(sha1($password)));
				$query = $this->set(['usr_password' => $password2])->where(['uid' => $userData['uid']])->update();
				$query2 = $prModel->set(['reset_code' => ''])->where(['reset_code' => $resetCode])->update();

				if ($query) {
					$message = array(
						'response' => 'success',
						'passwordChanged' => true
					);
					return $message;
				} else {
					$error = array(
						'response' => 'failed',
						'errorMessage' => 'There is some problem happened, please contact support.'
					);
					return $error;
				}
			} else {
				$error = array(
					'response' => 'failed',
					'errorMessage' => 'User Not Found.'
				);
				return $error;
			}
		} else {
			$error = array(
				'response' => 'failed',
				'errorMessage' => 'Reset Request not good, please reset again.'
			);
			return $error;
		}
	}
	public function sendAutoEmail($user_email, $message, $subject)
	{
		$email = \Config\Services::email();

		$config['charset']  = 'iso-8859-1';
		$config['mailType'] = 'html';
		$email->initialize($config);

		$email->setFrom(APP_NAME, NO_REPLY_EMAIL);
		$email->setTo($user_email);

		$email->setSubject($subject);
		$email->setMessage($message);

		return $email->send();
	}
	public function checkGoogleExist($g_oauth_id)
	{
		$data = $this->where('g_oauth_id', $g_oauth_id)->findAll();
		if ($data) {
			return true;
		}
		return false;
	}
	public function checkEmailExist($email)
	{
		$data = $this->where('email', $email)->findAll();
		if ($data) {
			return true;
		}
		return false;
	}

	public function getGuestDetails($uid){
		$guest = $this->select('uid, firstName, lastname, email, emailVerified, medical_history_id, aboutuser, phone, emailVerified, photoURL, govID, govIDverified, gender, addressLine1, addressLine2, state, city, country')->find($uid);
		$medicalDB = new UsermedicalModel();
		$guest['medial_data'] = $medicalDB->find($guest['medical_history_id']);
		return $guest;
	}
}
