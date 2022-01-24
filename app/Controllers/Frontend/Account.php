<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Admin\BookingGuestModel;
use App\Models\Admin\BookingsModel;
use App\Models\Admin\Chatsystem;
use App\Models\Admin\InboxModel;
use App\Models\Admin\ListingModel;
use App\Models\Admin\UsermedicalModel;
use App\Models\Admin\UserModel;
use App\Models\Admin\UserverifyModel;
use App\Models\Globals\Rtpcrrequest;
use App\Models\Globals\UserVerificationModel;
use CodeIgniter\I18n\Time;

class Account extends BaseController
{
	private $data;
	private $listing_m;
	private $bookings_m;
	private $booking_guests_m;
	private $inbox_m;
	private $chat_m;
	private $user_m;
	private $razorpay;

	public function __construct()
	{
		$this->data = array();
		$this->data['pageJS'] = '<script>const body = document.getElementsByTagName("body")[0];body.classList.remove("transparent-header");</script>';
		$this->data['user_data'] = [
			'id' => session()->get('uid'),
			'firstName' => session()->get('firstName'),
			'lastname' => session()->get('lastname'),
			'email' => session()->get('email'),
			'medical_history_id	' => session()->get('medical_history_id	'),
			'aboutuser' => session()->get('aboutuser'),
			'emailVerified' => session()->get('emailVerified'),
			'phone' => session()->get('phone'),
			'phoneVerified' => session()->get('phoneVerified'),
			'photoURL' => session()->get('photoURL'),
			'languages' => session()->get('languages'),
			'gender' => session()->get('gender'),
			'addressLine1' => session()->get('addressLine1'),
			'addressLine2' => session()->get('addressLine2'),
			'state' => session()->get('state'),
			'city' => session()->get('city'),
			'country' => session()->get('country'),
		];
		$this->data['razorKey'] = env('razorKey');
		$this->listing_m = new ListingModel();
		$this->bookings_m = new BookingsModel();
		$this->booking_guests_m = new BookingGuestModel();
		$this->inbox_m = new InboxModel();
		$this->chat_m = new Chatsystem();
		$this->user_m = new UserModel();
		$this->data['time'] = new Time;
		helper('file');
		helper('number');
		helper('form');
	}
	public function account_profile()
	{
		// return print_r(session()->get());
		$medical = new UsermedicalModel();

		$currentid = session()->get('uid');
		$userData = $this->user_m->find($currentid);
		$languages = array();
		if ($userData['languages']) {
			$languages = json_decode($userData['languages']);
		}
		$userData['languages'] = $languages;
		$this->data['user'] = $userData;

		$this->data['medical'] = [
			"flu_fever" => 0,
			"flu_cough" => 0,
			"flu_sore_throat" => 0,
			"flu_runny_nose" => 0,
			"flu_shortness_of_breath" => 0,
			"flu_others" => '',
			"chronic_specify" => '',
			"medication_specify" => '',
			"covid_19" => 0,
			"covid_19_first_dose" => '',
			"covid_19_second_dose" => '',
			"above_60_specify" => '',
			"living_with_specify" => '',
			"insurance_data" => ''
		];
		if ($userData['medical_history_id']) {
			$medicalData = $medical->find($userData['medical_history_id']);
			$this->data['medical'] = $medicalData;
		}
		if ($this->request->getMethod() == 'post') {
			$formName = $this->request->getVar('form_name');
			$postData = $this->request->getVar();
			unset($postData['form_name']);
			if ($formName == 'send_email_verification') {
				$userData = [
					"uid" => session()->get('uid'),
					"email" => session()->get('email')
				];
				if ($this->sendVerificationEmail($userData)) {
					return json_encode(true);
				}
				return json_encode(false);
			}
			if ($formName == 'medical_data') {
				// return print_r($_POST);
				$dataToSubmit = array();
				if (isset($postData['umid'])) {
					$dataToSubmit['umid'] = $postData['umid'];
				}
				if (intval($postData['above_60'])) {
					$dataToSubmit['above_60_specify'] = $postData['above_60_specify'];
				} else {
					$dataToSubmit['above_60_specify'] = null;
				}
				if (intval($postData['chronic'])) {
					$dataToSubmit['chronic_specify'] = $postData['chronic_specify'];
				} else {
					$dataToSubmit['chronic_specify'] = null;
				}
				if (intval($postData['insurance'])) {
					$dataToSubmit['insurance_data'] = $postData['insurance_data'];
				} else {
					$dataToSubmit['insurance_data'] = null;
				}
				if (intval($postData['living_with'])) {
					$dataToSubmit['living_with_specify'] = $postData['living_with_specify'];
				} else {
					$dataToSubmit['living_with_specify'] = null;
				}
				if (intval($postData['medication'])) {
					$dataToSubmit['medication_specify'] = $postData['medication_specify'];
				} else {
					$dataToSubmit['medication_specify'] = null;
				}
				$dataToSubmit['covid_19'] = $postData['covid_19'];
				if (intval($postData['covid_19'])) {
					$files = 0;
					if ($first = $this->request->getFile('covid_19_first_dose')) {
						if ($first->isValid() && !$first->hasMoved()) {
							$files += 1;
							$newName = $first->getRandomName();
							$first->move('uploads/covid19/' . $currentid . '/first', $newName);
							$dataToSubmit['covid_19_first_dose'] = 'uploads/covid19/' . $currentid . '/first/' . $newName;
						}
					}
					if ($second = $this->request->getFile('covid_19_second_dose')) {
						if ($second->isValid() && !$second->hasMoved()) {
							$files += 1;
							$newName = $first->getRandomName();
							$first->move('uploads/covid19/' . $currentid . '/second', $newName);
							$dataToSubmit['covid_19_second_dose'] = 'uploads/covid19/' . $currentid . '/second/' . $newName;
						}
					}
				} else {
					$postData['covid_19_first_dose'] = null;
					$postData['covid_19_second_dose'] = null;
				}
				if (isset($postData['flu_fever']) && $postData['flu_fever'] == 'on') {
					$dataToSubmit['flu_fever'] = 1;
				} else {
					$dataToSubmit['flu_fever'] = 0;
				}
				if (isset($postData['flu_cough']) && $postData['flu_cough'] == 'on') {
					$dataToSubmit['flu_cough'] = 1;
				} else {
					$dataToSubmit['flu_cough'] = 0;
				}
				if (isset($postData['flu_sore_throat']) && $postData['flu_sore_throat'] == 'on') {
					$dataToSubmit['flu_sore_throat'] = 1;
				} else {
					$dataToSubmit['flu_sore_throat'] = 0;
				}
				if (isset($postData['flu_runny_nose']) && $postData['flu_runny_nose'] == 'on') {
					$dataToSubmit['flu_runny_nose'] = 1;
				} else {
					$dataToSubmit['flu_runny_nose'] = 0;
				}
				if (isset($postData['flu_shortness_of_breath']) && $postData['flu_shortness_of_breath'] == 'on') {
					$dataToSubmit['flu_shortness_of_breath'] = 1;
				} else {
					$dataToSubmit['flu_shortness_of_breath'] = 0;
				}
				if ($postData['flu_others'] !== '') {
					$dataToSubmit['flu_others'] = $postData['flu_others'];
				} else {
					$dataToSubmit['flu_others'] = null;
				}
				$dataToSubmit['uid'] = session()->get('uid');
				$query = false;
				if (!isset($postData['umid'])) {
					$query = $medical->insertID($medical->save($dataToSubmit));
					$userData = [
						'uid' => session()->get('uid'),
						'medical_history_id' => $query
					];
					$this->user_m->save($userData);
				} else {
					$query = $medical->save($dataToSubmit);
				}
				if ($query) {
					return json_encode($query);
				}

				return json_encode(false);
			}
		}
		// return print_r($this->data);
		return view('Frontend/account/profile', $this->data);
	}
	public function account_profile_edit()
	{
		// $userCIdb = new UserContactInfoModel();
		// $userPMdb = new UserPaymentMethodModel();

		$this->data['languageSelection'] = [
			"Assamese",
			"Bengali (Bangla)",
			"Bodo",
			"Dogri",
			"Gujarati",
			"Hindi",
			"Kannada",
			"Kashmiri",
			"Konkani",
			"Maithili",
			"Malayalam",
			"Meitei (Manipuri)",
			"Marathi",
			"Nepali",
			"Odia",
			"Punjabi",
			"Sanskrit",
			"Santali",
			"Sindhi",
			"Tamil",
			"Telugu",
			"Urdu",
			"English",
			"Mandarin",
			"Spanish",
			"French",
			"Arabic",
			"Russian",
			"Portuguese",
			"Indonesian",
			"German",
			"Others"
		];
		$this->data['countries'] = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

		$currentid = session()->get('uid');
		$userData = $this->user_m->find($currentid);
		$languages = array();
		if ($userData['languages']) {
			$languages = json_decode($userData['languages']);
		}
		$userData['languages'] = $languages;
		$this->data['user'] = $userData;
		// $this->data['user']['contact_info'] = $userCIdb->where(['user_id' => $currentid])->first(); // user_id
		// $this->data['user']['payment_methods'] = $userPMdb->where(['user_id' => $currentid])->findAll(); // user_id
		// $this->data['user_medical_data'] = $userData; // uid

		if ($this->request->getMethod() == 'post') {
			$postFields = $this->request->getVar();
			$response = [
				'success' => false,
				'message' => 'Unable to complete request this time, please contact support.'
			];
			if ($postFields['form_name'] == 'profile_image') {
				if ($this->request->getFile('photoURL')) {
					$img = $this->request->getFile('photoURL');
					$imagePath = $this->uploadProfileImage($img);
					if ($imagePath) {
						$thisData = [
							'photoURL' => $imagePath,
							'uid' => $currentid
						];
						$query = $this->user_m->save($thisData);
						if ($query) {
							$response['success'] = true;
							$response['message'] = 'Image successfully uploaded.';
							session()->set(['photoURL' => $imagePath]);
						} else {
							$response['message'] = 'Server Error. ERROR CODE:- ERR-SQL-PR-036';
						}
					} else {
						$response['message'] = 'Server Error. ERROR CODE:- ERR-UPL-PR-036';
					}
				}
			} elseif ($postFields['form_name'] == 'profile_edit') {
				unset($postFields['form_name']);
				$postFields['uid'] = $currentid;
				if ($postFields['languages']) {
					$postFields['languages'] = json_encode($postFields['languages']);
				}
				$query = $this->user_m->save($postFields);
				if ($query) {
					$response['success'] = true;
					$response['message'] = 'Profile updates successfully.';
					session()->set($postFields);
				} else {
					$response['message'] = 'Server Error. ERROR CODE:- ERR-UPD-PR-026';
				}
			} elseif ($postFields['form_name'] == 'profile_image_remove') {
				$userImage = session()->get('photoURL');
				$userImage = substr($userImage, 1);
				if (file_exists($userImage)) {
					$thisData = [
						'photoURL' => NULL,
						'uid' => $currentid
					];
					$query = $this->user_m->save($thisData);
					if ($query) {
						unlink($userImage);
						$response['success'] = true;
						$response['message'] = 'Image Removed Successfully.';
						session()->set(['photoURL' => '']);
					} else {
						$response['message'] = 'Server Error. ERROR CODE:- ERR-SQL-PR-026';
					}
				} else {
					$response['message'] = 'Server Error. ERROR CODE:- ERR-IMG-NA-026';
				}
			} else {
				$response['message'] = 'Server Error. ERROR CODE:- ERR-FRM-PR-045';
			}
			return json_encode($response);
		}

		// return print_r($this->data);

		return view('Frontend/account/profile-edit', $this->data);
	}
	public function user_verification()
	{
		$currentid = session()->get('uid');
		$userData = $this->user_m->find($currentid);
		$languages = array();
		if ($userData['languages']) {
			$languages = json_decode($userData['languages']);
		}
		$userData['languages'] = $languages;
		$this->data['user'] = $userData;
		$verifyDb = new UserVerificationModel();
		$this->data['verification'] = $verifyDb->where('user_id', $currentid)->first();
		return view('Frontend/account/user_verification', $this->data);
	}
	public function account_inbox($hostId = null)
	{
		$this->data['pageJS'] = '<script>
		const body = document.getElementsByTagName("body")[0];
		body.classList.remove("transparent-header");</script>';

		if ($hostId == null) {
			$inboxes = $this->inbox_m->getAllGuestInboxes();
			$this->data['inboxes'] = $inboxes;
		} else {
			$inboxes = $this->inbox_m->getAllGuestInboxes();
			$this->data['inboxes'] = $inboxes;
			$HOSTID = base64_decode(base64_decode(base64_decode($hostId)));
			$this->data['current_host'] = $hostId;
			$inbox = $this->inbox_m->where(['guest_id' => $this->data['user_data']['id'], 'host_id' => $HOSTID])->first();
			$HOST = $this->user_m->getGuestDetails($HOSTID);
			if (!$inbox) {
				$newInboxData = [
					'guest_id' =>  $this->data['user_data']['id'],
					'guest_name' =>  $this->data['user_data']['firstName'] . ' ' . $this->data['user_data']['lastname'],
					'host_id' => $HOSTID,
					'host_name' => $HOST['firstName'] . ' ' . $HOST['lastname']
				];
				$lastId = $this->inbox_m->insertID($this->inbox_m->save($newInboxData));
				$inbox = $this->inbox_m->find($lastId);
			}
			$this->data['inbox'] = $inbox;
			$this->data['host'] = $HOST;
			// $chats = $this->chat_m->where(['userid' => $inbox["guest_id"], 'hostid' => $inbox["host_id"]])->orderBy('created_at', 'asc')->findAll();
			$chats = $this->chat_m->where(['inbox' => $inbox["id"]])->orderBy('mid', 'asc')->findAll();
			$this->data['chats'] = $chats;
			$bookings = $this->bookings_m->where(['user_id' => $inbox["guest_id"], 'host_id' => $inbox["host_id"]])->orderBy('created_at', 'desc')->findAll();
			$this->data['bookings'] = $bookings;
			$lastBooking = null;
			if ($this->request->getMethod() == 'post') {
				if ($this->request->getVar('rtcprForm') && $this->request->getFile('rtpcr_certificate')) {
					// return json_encode($_POST);
					$file = $this->request->getFile('rtpcr_certificate');
					$userId = $this->data['user_data']['id'];
					if ($file->isValid() && !$file->hasMoved()) {
						$newName = $file->getRandomName();
						$file->move('uploads/' . $userId . '/rtpcr', $newName);
						$fileName = 'uploads/' . $userId . '/rtpcr/' . $newName;
						$formData = $this->request->getVar();
						$chatId = $this->request->getVar('chat_id');
						unset($formData['rtcprForm']);
						unset($formData['chat_id']);
						$formData['rtpcr_certificate'] = $fileName;
						$rtpcrDb = new Rtpcrrequest();
						$rtpcrLastId = $rtpcrDb->insertId($rtpcrDb->save($formData));
						$chatData = [
							'inbox' => $inbox['id'],
							'userid' =>  $this->data['user_data']['id'],
							'userName' =>  $this->data['user_data']['firstName'] . ' ' . $this->data['user_data']['lastname'],
							'hostid' => $HOST['uid'],
							'hostName' => $HOST['firstName'] . ' ' . $HOST['lastname'],
							'message' => $rtpcrLastId,
							'messagebyuser' => 1,
							'notifyUserWeb' => 1,
							'isNotification' => 1,
							'notificationType' => 'rtpcr_uploaded'
						];
						$this->chat_m->set(['message' => 'uploaded'])->where('mid', $chatId)->update();
						$this->chat_m->save($chatData);
						// return json_encode(true);
					}
				}

				if ($this->request->getVar('message')) {
					$chatMessage = $this->request->getVar('message', FILTER_SANITIZE_STRIPPED);
					$chatData = [
						'inbox' => $inbox['id'],
						'userid' =>  $this->data['user_data']['id'],
						'userName' =>  $this->data['user_data']['firstName'] . ' ' . $this->data['user_data']['lastname'],
						'hostid' => $HOST['uid'],
						'hostName' => $HOST['firstName'] . ' ' . $HOST['lastname'],
						'message' => $chatMessage,
						'messagebyuser' => 1,
						'notifyUserWeb' => 1,
					];
					$this->chat_m->save($chatData);
					// return redirect()->route('account_inbox_chat', [$hostId]);
				}
				return redirect()->route('account_inbox_chat', [$hostId]);
			}

			if (count($bookings) > 0) {
				$lastBooking = $bookings[0];
			}
			$this->data['lastBooking'] = $lastBooking;
			$this->data['chatBox'] = true;
		}
		// return print_r($this->data);
		return view('Frontend/account/inbox', $this->data);
	}
	public function account_alerts()
	{
		$this->data['pageJS'] = '<script>
		const body = document.getElementsByTagName("body")[0];
		body.classList.remove("transparent-header");</script>';

		return view('Frontend/account/index', $this->data);
	}
	public function account_trips()
	{
		$user_id = $this->data['user_data']['id'];
		$getParam = '';
		if ($this->request->getMethod() == 'get' && $this->request->getVar('type')) {
			$getParam = $this->request->getGet('type');
			if ($getParam == 'completed') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'completed' => 1, 'approved' => 1, 'user_id' => $user_id])->findAll();
			} else if ($getParam == 'approved') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'cancelled' => 0, 'approved' => 1, 'completed' => 0, 'user_id' => $user_id])->findAll();
			} else if ($getParam == 'rejected') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'cancelled' => 1, 'approved' => 0, 'completed' => 0, 'user_id' => $user_id])->findAll();
			} else if ($getParam == 'new') {
				$bookings_data = $this->bookings_m->where(['requested' => 1, 'cancelled' => 0, 'approved' => 0, 'completed' => 0, 'user_id' => $user_id])->findAll();
			} else {
				$bookings_data = $this->bookings_m->where(['user_id' => $user_id])->findAll();
			}
		} else {
			$bookings_data = $this->bookings_m->where(['user_id' => $user_id])->findAll();
		}

		foreach ($bookings_data as $key => $booking) {
			$decoded = json_decode($booking['price_breakdown']);
			// $data_to_encode = json_encode($decoded);
			$bookings_data[$key]['price_breakdown'] = $decoded;

			$booking_id = $booking['id'];
			$bookings_data[$key]['guest_details'] = $this->booking_guests_m->where(['booking_id' => $booking_id])->findAll();
			$bookings_data[$key]['user_id_64'] = base64_encode(base64_encode(base64_encode($booking['host_id'])));
			$hostid = $booking['host_id'];
			$inbox = $this->inbox_m->where(['guest_id' => $user_id, 'host_id' => $hostid])->first();
			if ($inbox) {
				$bookings_data[$key]['guest_chat_id'] = $inbox['id'];
			} else {
				$guest_data = $this->user_m->select('firstName, lastname')->find($user_id);
				$host_data = $this->user_m->select('firstName, lastname')->find($hostid);
				$inboxData = [
					'guest_id' => $user_id,
					'guest_name' => $guest_data["firstName"] . ' ' . $guest_data["lastname"],
					'host_id' => $hostid,
					'host_name' => $host_data["firstName"] . ' ' . $host_data["lastname"],
				];
				$last_id = $this->inbox_m->insertID($this->inbox_m->save($inboxData));
				$bookings_data[$key]['guest_chat_id'] = $last_id;
			}
		}
		$this->data['bookings_data'] = $bookings_data;

		// return print_r($this->data);
		return view('Frontend/account/account_trips', $this->data);
	}
	public function account_wishlist()
	{
		$this->data['pageJS'] = '<script>
		const body = document.getElementsByTagName("body")[0];
		body.classList.remove("transparent-header");</script>';

		return view('Frontend/account/index', $this->data);
	}
	public function account_settings()
	{
		$this->data['pageJS'] = '<script>
		const body = document.getElementsByTagName("body")[0];
		body.classList.remove("transparent-header");</script>';

		return view('Frontend/account/index', $this->data);
	}
	private function uploadProfileImage($file)
	{
		$currentid = session()->get('uid');
		$img = $file;
		if ($img->isValid() && !$img->hasMoved()) {
			$newName = $img->getRandomName();
			$imageLocation = 'public/user/' . $currentid . '/avatar';
			$img->move($imageLocation, $newName);
			return '/' . $imageLocation . '/' . $newName;
		}
		return false;
	}
	private function sendVerificationEmail($userData)
	{
		$email = \Config\Services::email();
		$userVerifyMd = new UserverifyModel();

		$subject = 'Hillstay Verification';

		$verifyCode = rand(1000000, 9999999);

		$verifyLink = route_to('verify_user_email');
		$verifyLink = base_url() . $verifyLink . '?uid=' . $userData['uid'] . '&code=' . $verifyCode;
		// $message = '<p>Your verification code is ' . $verifyCode . '</p><p>Click below link to verify your email</p>';
		$message = '<p>Click below link to verify your email<br><a href="' . $verifyLink . '">' . $verifyLink . '</a></p>';

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
}
