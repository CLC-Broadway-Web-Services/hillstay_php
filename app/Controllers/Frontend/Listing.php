<?php

namespace App\Controllers\Frontend;

use App\Models\Admin\BookingGuestModel;
use App\Models\Admin\Chatsystem;
use App\Models\Admin\ListingAdditionalRuleModel;
use App\Models\Admin\ListingGalleryModel;
use App\Models\Admin\ListingModel;
use App\Models\Admin\ListingSleepingArrangementModel;
use App\Models\Admin\UserModel;
use App\Models\Admin\BookingsModel;
use CodeIgniter\Controller;

class Listing extends Controller
{
	private $data;
	private $listing_m;
	private $user_m;
	private $listing_sleep_m;
	private $listing_gallery_m;
	private $listing_aditional_rules_m;
	private $session;

	public function __construct()
	{
		$this->session = session();
		$this->data = array();
		$this->data['user_name'] = null;
		$this->data['user_id'] = null;
		if ($this->session->get('isUserLoggedIn')) {
			$this->data['user_name'] = $this->session->get('firstName');
			$this->data['user_id'] = $this->session->get('uid');
		}
		$this->listing_m = new ListingModel();
		$this->listing_sleep_m = new ListingSleepingArrangementModel();
		$this->listing_gallery_m = new ListingGalleryModel();
		$this->listing_aditional_rules_m = new ListingAdditionalRuleModel();
		$this->user_m = new UserModel();
		helper('file');
	}
	public function index($listing_id = null)
	{
		$decodedId = base64_decode(base64_decode(base64_decode($listing_id)));
		$booking_m = new BookingsModel();

		if ($this->request->getMethod() == 'post') {
			// $guests = [];
			// foreach ($this->request->getPost('guest') as $guest) {
			// 	$guests[] = $guest;
			// }
			// return json_encode($guests);
			$dataForForm = array();
			foreach (json_decode($this->request->getPost('dataForForm')) as $key => $data) {
				$dataForForm[$key] = $data;
			}

			$bookingDate = explode(" ", $this->request->getPost('bookingdate'));

			$breakDown = [
				'servicePrices' => $dataForForm['servicePrices'],
				'lodgingPrices' => $dataForForm['lodgingPrices'],
			];
			$dataToInsert = [
				'check_in' => $bookingDate[0],
				'check_out' => $bookingDate[2],
				'discount_type' => $dataForForm['discountApplied'],
				'discount_amount' => $dataForForm['discountPerNight'] * $dataForForm['totalNights'],
				'price_per_night' => $dataForForm['discountedPricePerNight'],
				'discount_monthly' => $dataForForm['monthlyDiscountPrice'],
				'total_nights' => $dataForForm['totalNights'],
				'price_total' => $dataForForm['totalPricingAmount'],
				'discount_weekly' => $dataForForm['weeklyDiscountPrice'],
				'discount_welcome' => $dataForForm['discountApplied'],
				'host_id' => intval($this->request->getPost('host_id')),
				'listing_id' => intval($this->request->getPost('listing_id')),
				'guest_adults' => intval($this->request->getPost('qtyInputAdult')),
				'guests' => intval($this->request->getPost('qtyInputTotal')),
				'status_name' => 'requested',
				'user_id' => intval($this->data['user_id']),
				'notify_web' => 1,
				'requested' => 1,
				'price_breakdown' => json_encode($breakDown)
			];

			// return json_encode($dataToInsert);
			// first save booking
			$bookingId = $booking_m->insertId($booking_m->insert($dataToInsert));
			// get booking id
			// set Booking id into guest object
			// then save guests
			// then show thank you for booking request
			$booking_guest_m = new BookingGuestModel();
			// $guests = [];
			foreach ($this->request->getPost('guest') as $guest) {
				// $guest = json_encode($guest);
				// $guest = json_decode($guest);
				// $guest = json_encode($guest);
				// $guests[] = $guest;
				// $gest = $guest;
				// $thisGuest
				$gest['name'] = $guest["'name'"];
				// return json_encode($gest);
				$gest['age'] = $guest["'age'"];
				$gest['chronic_medical_condition'] = $guest["'chronic_medical_condition'"] ? $guest["'chronic_medical_condition'"] : null;
				$gest['flu_symptoms'] = $guest["'flu_symptoms'"] ? $guest["'flu_symptoms'"] : null;
				$gest['gender'] = $guest["'gender'"] ? $guest["'gender'"] : null;
				$gest['health_insurance'] = $guest["'health_insurance'"] ? $guest["'health_insurance'"] : null;
				$gest['on_medication'] = $guest["'on_medication'"] ? $guest["'on_medication'"] : null;

				$gest['user_id'] = intval($this->data['user_id']);
				$gest['host_id'] = intval($this->request->getPost('host_id'));
				$gest['booking_id'] = $bookingId;
				$gest['listing_id'] = intval($this->request->getPost('listing_id'));
				$gest['notify_web'] = 1;
				$booking_guest_m->insert($gest);
			}

			$response = [
				'success' => true,
				'message' => 'Your booking request has been submitted succesfully. Host will contact you soon.',
			];
			return json_encode($response);
		}

		$this->data['listing'] = $this->listing_m->find($decodedId);
		$this->data['listing']['sleeping_arrangement'] = $this->listing_sleep_m->where('listing_id', $decodedId)->findAll();
		$this->data['listing']['gallery'] = $this->listing_gallery_m->where('listing_id', $decodedId)->findAll();
		$this->data['listing']['additional_rules'] = $this->listing_aditional_rules_m->where('listing_id', $decodedId)->findAll();
		$this->data['listing']['host'] = $this->user_m->select('uid, firstName, lastname, aboutuser, photoURL')->find($this->data['listing']['uid']);
		$this->data['listing']['rating'] = false;

		if (!$this->data['listing']['host']['photoURL']) {
			$this->data['listing']['host']['photoURL'] = DEFAULT_AVATAR;
		}

		// total beds
		$totalbeds = 0;
		foreach ($this->data['listing']['sleeping_arrangement'] as $sleeps) {
			$totalbeds += intval($sleeps['total_beds']);
		}
		// custom data
		// $this->data['listing']['discountedPriceNight'] = false;
		$this->data['listing']['totalbeds'] = $totalbeds;
		// $this->data['listing']['rating'] = false;
		// $this->data['listing']['rating'] = false;
		// return print_r($this->data);
		$propertyType = array(
			array(
				'name' =>  'Flat',
				"value" =>  'flat',
				"description" =>
				'Flats (sometimes referred to as apartments) are typically located in multi-unit residential buildings or complexes where other people live.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Serviced apartment',
				"value" =>  'serviced_apartment',
				"description" =>
				'Serviced apartments are furnished and serviced by professional management companies. They offer hotel-like amenities such as daily cleaning, laundry service, a concierge and a front desk, making them popular choices for corporate housing and guests staying longer than 30 days.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  true,
			),
			array(
				'name' =>  'House',
				"value" =>  'house',
				"description" =>
				'Houses are residential buildings that are often standalone structures. Some houses, like semi-detached properties, may share walls or outdoor areas with other houses.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Bungalow',
				"value" =>  'bungalow',
				"description" =>
				'Bungalows are houses with architectural features like a wide front porch and a sloping roof. They’re usually single-storey homes.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Cabin',
				"value" =>  'cabin',
				"description" =>
				'Cabins are houses built with natural materials like logs and wood. They’re often located in natural settings like forests and mountains.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Chalet',
				"value" =>  'chalet',
				"description" =>
				'Chalets are houses that are usually made of wood and have a sloping roof. Many are holiday homes in locations popular for skiing or summer homes.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Cottage',
				"value" =>  'cottage',
				"description" =>
				'Cottages are cosy homes. They’re often located in rural areas or near a lake or beach.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Farm stay',
				"value" =>  'farm_stay',
				"description" =>
				'Farm stays are professionally managed accommodation facilities in agricultural settings where guests may interact with animals or enjoy recreational activities like hiking or arts and crafts.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Houseboat',
				"value" =>  'houseboat',
				"description" =>
				'Houseboats are boats that are more like homes and are often set up as a primary residence. Choose “houseboat” if you have a floating home.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  false,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Hut',
				"value" =>  'hut',
				"description" =>
				'Huts are made from simple materials like wood or mud and often have thatched roofs made of straw.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Tiny house',
				"value" =>  'tiny_house',
				"description" =>
				'Tiny houses are standalone houses that are very small in size and have compact interior living spaces. They’re usually less than 400 square feet or 37 square metres.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Villa',
				"value" =>  'villa',
				"description" =>
				'Villas are luxurious homes that tend to have outdoor-indoor spaces and large paved outdoor areas, gardens or pools.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Guest house',
				"value" =>  'guest_house',
				"description" =>
				'A guest house is a detached building that shares a property with another standalone structure like a house. Sometimes these are called carriage houses or coach houses.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Campsite',
				"value" =>  'campsite',
				"description" =>
				'A campsite is an area of land where guests can set up their own tent, yurt, campervan/motorhome, or tiny house. Let guests know what they can set up on your campsite.',
				"haveRooms" =>  [],
				"guestOptions" =>  [array("entire" => true), array("private" => false), array("shared" => false)],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Treehouse',
				"value" =>  'treehouse',
				"description" =>
				'Treehouses are built into the trunks or branches of trees. Nature-loving guests may climb a ladder or stairs to enjoy beautiful views.',
				"haveRooms" =>  [],
				"guestOptions" =>  [],
				"offbeat" =>  true,
				"infoModal" =>  false,
			),
			array(
				'name' =>  'Boutique Hotel',
				"value" =>  'boutique_hotel',
				"description" =>
				'Boutique hotels are professional hospitality businesses that usually have a unique style or theme defining their brand and decor.',
				"haveRooms" =>  [
					array('name' =>  '2-5', "value" =>  5),
					array('name' =>  '6-10', "value" =>  10),
					array('name' =>  '11-20', "value" =>  20),
					array('name' =>  '21-30', "value" =>  30),
					array('name' =>  '31-40', "value" =>  40),
					array('name' =>  '41-50', "value" =>  50),
					array('name' =>  '50+', "value" =>  51),
				],
				"guestOptions" =>  [array("entire" => true), array("private" => true), array("shared" => true)],
				"offbeat" =>  true,
				"infoModal" =>  true,
			),
			array(
				'name' =>  'Resort',
				"value" =>  'resort',
				"description" =>
				'Resorts are professional hospitality businesses with guest accommodation ranging from hotel rooms to private rentals. They may offer more amenities and services than other hotels.',
				"haveRooms" =>  [
					array('name' =>  '2-5', "value" =>  5),
					array('name' =>  '6-10', "value" =>  10),
					array('name' =>  '11-20', "value" =>  20),
					array('name' =>  '21-30', "value" =>  30),
					array('name' =>  '31-40', "value" =>  40),
					array('name' =>  '41-50', "value" =>  50),
					array('name' =>  '50+', "value" =>  51),
				],
				"guestOptions" =>  [array("entire" => true), array("private" => true), array("shared" => true)],
				"offbeat" =>  true,
				"infoModal" =>  true,
			)
		);

		$placeKind = array(
			array(
				'name' => 'Entire Space',
				'value' => 'entire',
				'description' =>
				'Guests have the whole place to themselves. This usually includes a bedroom, a bathroom, and a kitchen.',
			),
			array(
				'name' => 'Private Room',
				'value' => 'private',
				'description' =>
				'Guests have their own private room for sleeping. Other areas could be shared.',
			),
			array(
				'name' => 'Shared Space',
				'value' => 'shared',
				'description' =>
				'Guests sleep in a bedroom or a common area that could be shared with others.',
			),
		);

		$propertyTypeKey = intval(array_search($this->data['listing']['propertytype'], array_column($propertyType, 'value')));
		$placeKindKey = intval(array_search($this->data['listing']['placekind'], array_column($placeKind, 'value')));

		$oldBookingsCount = $booking_m->where(['listing_id' => $decodedId, 'payment_status' => 1, 'status' => 1])->countAll();
		$nowTime = date('Y-m-d');
		$oldBookingDates = $booking_m->where(['listing_id' => $decodedId, 'payment_status' => 1, 'status' => 1, 'check_in >' => $nowTime, 'check_out >' => $nowTime])->findAll();

		$this->data['listing']['oldBookingsCount'] = $oldBookingsCount;
		$this->data['listing']['oldBookingDates'] = $oldBookingDates;

		$this->data['propertyType'] = $propertyType[$propertyTypeKey];
		$this->data['placeKind'] = $placeKind[$placeKindKey];

		$this->data['noStickyHeader'] = true;
		$this->data['noFixedHeader'] = true;

		// return print_r($this->data);


		$this->data['svgBedIcon'] = '<span class="svgBed"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 24px; width: 24px; fill: currentcolor;"><path d="M24 4a2 2 0 0 1 1.995 1.85L26 6v7.839l1.846 5.537a3 3 0 0 1 .115.468l.03.24.009.24V30h-2v-2H6v2H4v-9.675a3 3 0 0 1 .087-.717l.067-.232L6 13.836V6a2 2 0 0 1 1.697-1.977l.154-.018L8 4zm2 18H6v4h20zm-1.388-6H7.387l-1.333 4h19.891zM24 6H8v8h3v-4a2 2 0 0 1 1.85-1.995L13 8h6a2 2 0 0 1 1.995 1.85L21 10v4h3zm-5 4h-6v4h6z"></path></svg></span>';

		$this->data['pageJS'] = "<script src='/public/custom/assets/js/listingDetails.js'></script>";

		return view('Frontend/listing/details', $this->data);
	}
	public function sendMessageToHost()
	{

		// return json_encode($_POST);
		$request = $this->request;
		$response = [
			'status' => 'failed',
			'code' => 200,
			'message' => 'There is error in the request, please try after some time.',
		];
		if ($request->getVar('hostid') && $request->getVar('listing_id') && $request->getVar('message') && $request->getVar('hostName') && $request->getVar('listing_name')) {
			$dataToSave = array();
			$dataToSave['hostid'] = $request->getVar('hostid');
			$dataToSave['hostName'] = $request->getVar('hostName');
			$dataToSave['listing_id'] = $request->getVar('listing_id');
			$dataToSave['message'] = $request->getVar('message');
			$dataToSave['userid'] = $this->data['user_id'];
			$dataToSave['userName'] = $this->session->get('firstName') . ' ' . $this->session->get('lastname');
			$dataToSave['messagebyuser'] = '1';
			$dataToSave['listing_name'] = $request->getVar('listing_name');

			if ($dataToSave['userid'] != null) {
				if ($dataToSave['hostid'] == $dataToSave['userid']) {
					$response['message'] = 'You cannot send yourself a message.';
				} else {
					$message_m = new Chatsystem();
					if ($message_m->save($dataToSave)) {
						$response['status'] = 'success';
						$response['message'] = 'Succesfully send message, please wait host will contact you back soon.';
					} else {
						$response['message'] = 'Host is not available to recieve messages for now';
					}
				}
			} else {
				$response['message'] = 'User not logged in, Please refresh and login to continue.';
			}
		}
		return json_encode($response);
	}
	public function getCurrentListingBookings($listing_id = null)
	{
		if ($listing_id != null) {
			$booking_m = new BookingsModel();
			$all_booking = $booking_m->select('id')->where(['listing_id' => $listing_id, 'payment_status => 1'])->findAll();
			$count = count($all_booking);
			return json_encode($count);
		} else {
			return json_encode(0);
		}
	}
}
