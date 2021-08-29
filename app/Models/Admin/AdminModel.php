<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use App\Models\Globals\PasswordresetModel;

class AdminModel extends Model
{
	protected $table = 'administrators';
	protected $primaryKey = 'adm_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'adm_name',
		'adm_email',
		'adm_password',
		'adm_mobile',
		'adm_role', // 1=superadmin, 2=admin, 3=manager
		'adm_type', // superadmin / admin / manager
		'adm_status',
		'adm_picture',
		'adm_last_login'
	];
	protected $createdField  = 'adm_created_at';
	protected $updatedField  = 'adm_updated_at';
	public function authenticateAdmin($email, $password)
	{
		$session = session();
		$data = $this->where(['adm_email' => $email])->first();

		if ($data != null) {
			if ($data['adm_password'] == $password) {
				$this->setUserMethod($data);
				// last login update
				$data2 = [
					'adm_last_login' => date('Y-m-d H:i:s')
				];
				$this->set($data2)->where(['adm_id' => $data['adm_id']])->update();

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
	public function setUserMethod($user)
	{
		$admin = [
			'adm_id' => $user['adm_id'],
			'adm_name' => $user['adm_name'],
			'adm_email' => $user['adm_email'],
			'adm_mobile' => $user['adm_mobile'],
			'adm_role' => $user['adm_role'],
			'adm_type' => $user['adm_type'],
			'adm_status' => $user['adm_status'],
			'adm_picture' => $user['adm_picture'],
			'adm_last_login' => $user['adm_last_login'],
			'adm_created_at' => $user['adm_created_at'],
			'adm_updated_at' => $user['adm_updated_at'],
		];
		$data = [
			'admin' => $admin,
			'isAdminLoggedIn' => true,
		];
		session()->set($data);
		return true;
	}
	public function getAdminDetails()
	{
		return session()->get('admin');
	}
	public function checkUser()
	{
		if (session()->get('isAdminLoggedIn')) {
			return json_encode(true);
		}
		return json_encode(false);
	}
	public function getAdminRole()
	{
		return json_encode(session()->get('adm_role'));
	}
	public function forgetPassword($email)
	{
		$session = session();
		$data = $this->where(['adm_email' => $email])->first();
		$prModel = new PasswordresetModel();
		if ($data != null) {

			$reset_code = round(microtime(true));

			$dataToUpload = [
				'reset_code' => $reset_code,
				'reset_email' => $data['adm_email'],
				'reset_user_id' => $data['adm_id'],
				'reset_user_table' => 'administrators',
			];

			$resetQuery = $prModel->insert($dataToUpload);

			if ($resetQuery) {
				$subject = 'Password Reset Request.';
				$user_email = $data['adm_email'];
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

		$resetData = $prModel->where(['reset_email' => $email, 'reset_user_table' => 'administrators', 'reset_code' => $resetCode, 'reset_status' => 0])->first();

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

		$resetData = $prModel->where(['reset_email' => $email, 'reset_user_table' => 'administrators', 'reset_code' => $resetCode, 'reset_status' => 1])->first();
		if ($resetData != null) {
			$userData = $this->where(['adm_id' => $resetData['reset_user_id']])->first();
			if ($userData != null) {

				$password2 = sha1(sha1(sha1($password)));
				$query = $this->set(['adm_password' => $password2])->where(['adm_id' => $userData['adm_id']])->update();
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
}
