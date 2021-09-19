<?php

namespace App\Controllers\Frontend\Hosting;

use App\Models\Admin\CitiesModel;
use App\Models\Admin\ListingAdditionalRuleModel;
use App\Models\Admin\ListingGalleryModel;
use App\Models\Admin\ListingModel;
use App\Models\Admin\ListingSleepingArrangementModel;
use App\Models\Admin\ListingSteps;
use App\Models\Admin\StatesModel;
use App\Models\Admin\UserContactInfoModel;
use App\Models\Admin\UserPaymentMethodModel;
use CodeIgniter\Controller;

class Listing extends Controller
{
	private $data;
	private $listing_m;
	private $listing_sleep_m;
	private $listing_gallery_m;
	private $listing_aditional_rules_m;
	private $listing_steps_m;
	private $session;

	public function __construct()
	{
		$this->session = session();
		$this->data = array();
		$this->data['user_name'] = $this->session->get('firstName');
		$this->data['user_id'] = $this->session->get('uid');
		$this->listing_m = new ListingModel();
		$this->listing_sleep_m = new ListingSleepingArrangementModel();
		$this->listing_gallery_m = new ListingGalleryModel();
		$this->listing_aditional_rules_m = new ListingAdditionalRuleModel();
		$this->listing_steps_m = new ListingSteps();
		helper('file');
	}
	public function index()
	{
		$this->data['listings'] = $this->listing_m->getHostListings($this->data['user_id']);
		// return print_r($this->data);

		return view('Frontend/host/listing/index', $this->data);
	}
	public function add_new($mode = 'new')
	{
		helper('file');
		$_steps = intval(1);
		$lastid = intval(0);
		$this->data['_lastid'] = $lastid;
		$request_type = 'direct';
		$this->data['_steps'] = $_steps;
		$this->data['mode'] = $mode;

		$_totalFormSteps = 23;
		$this->data['_totalFormSteps'] = $_totalFormSteps;

		$_formProgressDefault = intval(100 / $_totalFormSteps);
		$_formProgress = $_formProgressDefault;
		$this->data['_formProgressDefault'] = $_formProgressDefault;


		if (isset($_GET['step'])) {
			$_steps = intval($_GET['step']);
			$this->data['_steps'] = $_steps;
			$lastid = intval($this->session->get('last_id'));
			$this->data['_lastid'] = $lastid;

			if ($lastid > 0) {
				$listing_data = $this->listing_m->find($lastid);
				$this->data['listing_data'] = $listing_data;
				if ($listing_data == null) {
					return redirect('hosting_listing_add_new');
				}
			} else {
				return redirect('hosting_listing_add_new');
			}
			$_formProgress = ($_formProgressDefault * $_steps);
		}

		$this->data['_formProgress'] = $_formProgress;

		// return print_r($this->data);

		// STEPS WISE DATA FOR FORM
		if ($_steps == 1) {
			$this->data['selectPlaces'] = array(
				array('name' => 'Entire Place', 'value' => 'entire'),
				array('name' => 'Private Room', 'value' => 'private'),
				array('name' => 'Shared space', 'value' => 'shared'),
			);
			$this->data['selectGuests'] = array(
				array('name' => '1', 'value' => 1),
				array('name' => '2', 'value' => 2),
				array('name' => '3', 'value' => 3),
				array('name' => '4', 'value' => 4),
				array('name' => '5', 'value' => 5),
				array('name' => '6', 'value' => 6),
				array('name' => '7', 'value' => 7),
				array('name' => '8', 'value' => 8),
				array('name' => '9', 'value' => 9),
				array('name' => '10', 'value' => 10),
				array('name' => '11', 'value' => 11),
				array('name' => '12', 'value' => 12),
				array('name' => '13', 'value' => 13),
				array('name' => '14', 'value' => 14),
				array('name' => '15', 'value' => 15),
				array('name' => '16', 'value' => 16),
				array('name' => '17', 'value' => 17),
				array('name' => '18', 'value' => 18),
				array('name' => '19', 'value' => 19),
				array('name' => '20', 'value' => 20),
				array('name' => '21', 'value' => 21),
				array('name' => '22', 'value' => 22),
				array('name' => '23', 'value' => 23),
				array('name' => '24', 'value' => 24),
				array('name' => '25', 'value' => 25),
			);
		}
		if ($_steps == 2) {
			$this->data['guestsHaveradioList'] = array(
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
			$this->data['propertyType'] = array(
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
		}
		if ($_steps == 3) {
			$this->data['bedrooms'] = array(
				array('name' => '1', 'value' => 1),
				array('name' => '2', 'value' => 2),
				array('name' => '3', 'value' => 3),
				array('name' => '4', 'value' => 4),
				array('name' => '5', 'value' => 5),
				array('name' => '6', 'value' => 6),
				array('name' => '7', 'value' => 7),
				array('name' => '8', 'value' => 8),
				array('name' => '9', 'value' => 9),
				array('name' => '10', 'value' => 10),
				array('name' => '11', 'value' => 11),
				array('name' => '12', 'value' => 12),
				array('name' => '13', 'value' => 13),
				array('name' => '14', 'value' => 14),
				array('name' => '15', 'value' => 15),
				array('name' => '16', 'value' => 16),
				array('name' => '17', 'value' => 17),
				array('name' => '18', 'value' => 18),
				array('name' => '19', 'value' => 19),
				array('name' => '20', 'value' => 20),
				array('name' => '21', 'value' => 21),
				array('name' => '22', 'value' => 22),
				array('name' => '23', 'value' => 23),
				array('name' => '24', 'value' => 24),
				array('name' => '25', 'value' => 25),
				array('name' => '26', 'value' => 26),
				array('name' => '27', 'value' => 27),
				array('name' => '28', 'value' => 28),
				array('name' => '29', 'value' => 29),
				array('name' => '30', 'value' => 30),
				array('name' => '31', 'value' => 31),
				array('name' => '32', 'value' => 32),
				array('name' => '33', 'value' => 33),
				array('name' => '34', 'value' => 34),
				array('name' => '35', 'value' => 35),
				array('name' => '36', 'value' => 36),
				array('name' => '37', 'value' => 37),
				array('name' => '38', 'value' => 38),
				array('name' => '39', 'value' => 39),
				array('name' => '40', 'value' => 40),
				array('name' => '41', 'value' => 41),
				array('name' => '42', 'value' => 42),
				array('name' => '43', 'value' => 43),
				array('name' => '44', 'value' => 44),
				array('name' => '45', 'value' => 45),
				array('name' => '46', 'value' => 46),
				array('name' => '47', 'value' => 47),
				array('name' => '48', 'value' => 48),
				array('name' => '49', 'value' => 49),
				array('name' => '50', 'value' => 50),
			);
		}
		if ($_steps == 5) {
			$states_m = new StatesModel();
			$cities_m = new CitiesModel();
			// $this->data['states'] = $states_m->getStates();
			$states = $states_m->getStates();
			usort($states, function ($a, $b) { return strnatcmp($a['name'], $b['name']); });
			$this->data['states'] = $states;

			// return print_r($states);

			$this->data['cities'] = $cities_m->getCities();
		}
		if ($_steps == 22) {
			$method_m = new UserPaymentMethodModel();
			$this->data['payment_methods'] = $method_m->getUserMethods($this->data['user_id']);

			if ($this->request->getVar('default_method')) {
				$method_m->changeDefaultMethod($this->data['user_id'], $this->request->getVar('default_method'));
				return json_encode(true);
			};
			$info_m = new UserContactInfoModel();
			$this->data['contact_info'] = $info_m->getUserMethods($this->data['user_id']);

			if ($this->request->getVar('default_contact_info')) {
				$info_m->changeDefaultMethod($this->data['user_id'], $this->request->getVar('default_contact_info'));
				return json_encode(true);
			}
		}

		// return print_r($this->data);
		// FORM SUBMITION
		if ($this->request->getVar('method')) {
			// return print_r($_SERVER['REQUEST_URI'] );
			$method_m = new UserPaymentMethodModel();
			$methodData['method'] = $this->request->getVar('method');
			$methodData['user_id'] = $this->data['user_id'];
			$methodData['status'] = 1;
			if ($this->request->getVar('method') == 'BANK') {
				$methodData['bank_user_name'] = $this->request->getVar('bank_user_name');
				$methodData['bank_acc_number'] = $this->request->getVar('bank_acc_number');
				$methodData['bank_name'] = $this->request->getVar('bank_name');
				$methodData['bank_branch'] = $this->request->getVar('bank_branch');
				$methodData['bank_ifsc'] = $this->request->getVar('bank_ifsc');
			} else {
				$methodData['upi_number'] = $this->request->getVar('upi_number');
			}

			$method_m->save($methodData);

			$current = $_SERVER['REQUEST_URI'];
			return redirect()->to($current);
		}
		if ($this->request->getVar('contact_add')) {
			// return print_r($_SERVER['REQUEST_URI'] );
			$info_m = new UserContactInfoModel();
			$methodData['user_id'] = $this->data['user_id'];
			$methodData['contact_person'] = $this->request->getVar('contact_person');
			$methodData['primary_number'] = $this->request->getVar('primary_number');
			$methodData['alternate_number'] = $this->request->getVar('alternate_number');

			$info_m->save($methodData);

			$current = $_SERVER['REQUEST_URI'];
			return redirect()->to($current);
		}
		if ($this->request->getMethod() == 'post') {
			$post_data = $_POST;

			foreach ($post_data as $key => $postItem) {
				if ($postItem == null) {
					unset($post_data[$key]);
				}
			}
			// return json_encode($post_data);

			if ($this->request->getPost('request_type')) {
				$request_type = $this->request->getPost('request_type');
			}
			$thisSaveStep = 'saveStep' . $_steps;

			unset($post_data['_step']);
			unset($post_data['request_type']);


			if ($_steps == 9) {
				if ($this->request->getFileMultiple('galleryImages')) {
					$gallery = array();
					$galleryI = 0;
					foreach ($this->request->getFileMultiple('galleryImages') as $img) {
						$galleryI++;
						$index = $galleryI - 1;
						// return json_encode($index);
						// if ($img->isValid() && !$img->hasMoved()) {
						// return json_encode($img);
						$newName = $img->getRandomName();
						// return json_encode($newName);
						$img->move(LISTING_IMAGES_FOLDER . $lastid, $newName);
						$gallery[$index]['image'] = LISTING_IMAGES_FOLDER . $lastid . '/' . $newName;
						$captionName = 'caption[' . $index . ']';
						// return json_encode($captionName);
						if ($this->request->getVar($captionName) != '') {
							$gallery[$index]['caption'] = esc(trim($this->request->getVar($captionName)));
						}
						$gallery[$index]['listing_id'] =  $lastid;
						if ($this->request->getVar('cover') == $index) {
							$gallery[$index]['isCover'] = 1;
							$listing['coverimage'] = LISTING_IMAGES_FOLDER . $lastid . '/' . $newName;
						}
						// }
					}
					$dataToSave['gallery'] = $gallery;
					$dataToSave['listing'] = $listing;
					$dataToSave['listing_id'] = $lastid;
				}
				$submitListingData = $this->$thisSaveStep($dataToSave);
			} else {
				$submitListingData = $this->$thisSaveStep($post_data);
			}

			return $submitListingData;
			if ($submitListingData) {
				if ($request_type == 'ajax') {
					return $submitListingData;
				} else {
					return redirect()->to('/hosting/listing/addnew?step=' . (intval($_steps) + 1));
				}
			} else {
				if ($request_type == 'ajax') {
					return json_encode(0);
				} else {
					return redirect()->to('/hosting/listing/addnew');
				}
			}
		}

		// return print_r($this->data);
		// $this->session->set(['last_id'  => 16]);
		$this->data['pageJS'] = '<script>const _step = parseInt($("#_step").val());</script>';
		$this->data['pageJS'] .= '<script>const _mode = $("#_mode").val();</script>';
		$this->data['pageJS'] .= '<script>var _listingForm = $("#_listingForm");</script>';
		$this->data['pageJS'] .= '<script>var formNextButton = $("#formNextButton");</script>';
		// if ($_steps == 22) {
			$this->data['pageJS'] .= '<script src="/public/assets/scripts/extensions/jquery.validate.min.js"></script>';
		// }
		if ($_steps == 10) {
			$this->data['pageJS'] .= '<script src="/public/assets/scripts/extensions/tinymce/tinymce.min.js"></script>';
		}
		// $this->data['pageJS'] .= '<script src="/public/custom/assets/js/scripts/dropzone.js"></script>';
		$this->data['pageJS'] .= '<script src="/public/custom/assets/js/host_listing_steps/' . $_steps . '.js"></script>';
		$this->data['pageJS'] .= '<script src="/public/custom/assets/js/host_listing_steps/host_add_listing_form_validations.js"></script>';
		$this->data['pageJS'] .= '<script src="/public/custom/assets/js/host_listing_steps/host_add_listing_form_core.js"></script>';

		$this->data['leafletScripts'] = true;
		return view('Frontend/host/listing/addnew', $this->data);
	}
	public function editListing($listing_id) {
		return view('Frontend/host/listing/editListing', $this->data);
	}
	private function saveStep1($data)
	{
		// return json_encode($data);
		unset($data['mode']);
		$userid = $data['user_id'];
		$data['uid'] = $userid;
		unset($data['user_id']);
		// return json_encode($data);
		$lastid = $this->listing_m->getInsertID($this->listing_m->save($data));
		$this->listing_steps_m->save(['listing_id' => $lastid, 'step_0' => 1, 'step_1' => 1, 'user_id' => $userid]);
		$this->session->set(['last_id'  => $lastid]);
		return json_encode($lastid);
	}
	private function saveStep2($data)
	{
		unset($data['mode']);
		unset($data['user_id']);
		if (isset($data['entire'])) {
			$data['entire'] = 1;
		}
		if (isset($data['private'])) {
			$data['private'] = 1;
		}
		if (isset($data['shared'])) {
			$data['shared'] = 1;
		}
		if (isset($data['offbeat'])) {
			$data['offbeat'] = 1;
		}
		if (isset($data['offbeatonroad'])) {
			$data['offbeatonroad'] = 1;
			unset($data['offbeat_walking']);
		}
		// return json_encode($data);
		$lastid = intval($data['listing_id']);
		$data['listing_id'] = intval($data['listing_id']);
		// unset($data['listing_id']);
		// return json_encode($lastid);
		// return json_encode($this->listing_m->save($data));
		$this->listing_steps_m->set(['step_2' => 1])->where('listing_id', $lastid)->update();
		$query = $this->listing_m->save($data);
		// return json_encode($this->listing_m->where('listing_id', $lastid)->update($data));
		// $query = $this->listing_m->where('listing_id', $lastid)->update($data);
		$this->session->set(['last_id'  => $lastid]);
		if ($query) {
			return json_encode($lastid);
		} else {
			return false;
		}
	}
	private function saveStep3($data)
	{
		// return json_encode($data);
		$lastid = intval($data['listing_id']);

		$data2 = [
			'listing_id' => intval($data['listing_id']),
			'bedrooms' => intval($data['bedrooms']),
		];

		$totalbeds = $data['sleepbeds_x'];
		$double_x = $data['double_x'];
		$king_x = $data['king_x'];
		$queen_x = $data['queen_x'];
		$single_x = $data['single_x'];
		$sofabed_x = $data['sofabed_x'];
		$bunkbed_x = $data['bunkbed_x'];
		$hammock_x = $data['hammock_x'];
		$floormat_x = $data['floormat_x'];

		foreach ($totalbeds as $key => $value) {
			$data_sleep[$key]['total_beds'] = intval($value);
		}
		foreach ($double_x as $key => $value) {
			$data_sleep[$key]['double_bed'] = intval($value);
		}
		foreach ($king_x as $key => $value) {
			$data_sleep[$key]['king_bed'] = intval($value);
		}
		foreach ($queen_x as $key => $value) {
			$data_sleep[$key]['queen_bed'] = intval($value);
		}
		foreach ($single_x as $key => $value) {
			$data_sleep[$key]['single_bed'] = intval($value);
		}
		foreach ($floormat_x as $key => $value) {
			$data_sleep[$key]['floormat_bed'] = intval($value);
		}
		foreach ($sofabed_x as $key => $value) {
			$data_sleep[$key]['sofa_bed'] = intval($value);
		}
		foreach ($bunkbed_x as $key => $value) {
			$data_sleep[$key]['bunk_bed'] = intval($value);
		}
		foreach ($hammock_x as $key => $value) {
			$data_sleep[$key]['hammock_bed'] = intval($value);
		}

		foreach ($data_sleep as $sleep_beds_data) {
			$sleep_beds_data['user_id'] = intval($data['user_id']);
			$sleep_beds_data['listing_id'] = $lastid;
			$query = $this->listing_sleep_m->save($sleep_beds_data);
		}

		// return json_encode($data2);
		// return json_encode($data_sleep);

		$query = $this->listing_m->save($data2);

		$this->listing_steps_m->set(['step_3' => 1])->where('listing_id', $lastid)->update();
		$this->session->set(['last_id'  => $lastid]);
		if ($query) {
			return json_encode($lastid);
		} else {
			return false;
		}
	}
	private function saveStep4($data)
	{
		// return json_encode($data);
		$lastid = intval($data['listing_id']);
		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		$data['listing_id'] = intval($lastid);
		$this->listing_steps_m->set(['step_4' => 1])->where('listing_id', $lastid)->update();
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		return json_encode($lastid);
	}
	private function saveStep5($data)
	{
		// return json_encode($data);
		$lastid = intval($data['listing_id']);
		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		$data['listing_id'] = intval($lastid);
		$this->listing_steps_m->set(['step_5' => 1])->where('listing_id', $lastid)->update();
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		return json_encode($lastid);
	}
	private function saveStep6($data)
	{
		// return json_encode($data);

		$lastid = intval($data['listing_id']);
		unset($data['mode']);
		unset($data['user_id']);
		unset($data['listing_id']);
		// return json_encode($data);
		if (count($data) > 0) {
			foreach ($data as $key => $value) {
				if ($value == "on") {
					$data2[$key] = '1';
				}
			}
			$data2['listing_id'] = intval($lastid);
			// return json_encode($data2);
			$data['listing_id'] = intval($lastid);
			$query = $this->listing_m->save($data2);
			$this->session->set(['last_id'  => $lastid]);
		}
		$this->listing_steps_m->set(['step_6' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
	}
	public function saveStep7($data)
	{
		// return json_encode($data);

		$lastid = intval($data['listing_id']);
		unset($data['mode']);
		unset($data['user_id']);
		unset($data['listing_id']);
		// return json_encode($data);
		if (count($data) > 0) {
			foreach ($data as $key => $value) {
				if ($value == "on") {
					$data2[$key] = intval(1);
				}
			}
			$data2['listing_id'] = intval($lastid);
			$data['listing_id'] = intval($lastid);
			// return json_encode($data2);
			$query = $this->listing_m->save($data2);
			$this->session->set(['last_id'  => $lastid]);
		}
		$this->listing_steps_m->set(['step_7' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
	}
	private function saveStep8($data)
	{
		// return json_encode($data);

		$lastid = intval($data['listing_id']);
		unset($data['mode']);
		unset($data['user_id']);
		unset($data['listing_id']);
		// return json_encode($data);
		if (count($data) > 0) {
			foreach ($data as $key => $value) {
				if ($value == "on") {
					$data2[$key] = intval(1);
				}
			}
			$data2['listing_id'] = intval($lastid);
			$data['listing_id'] = intval($lastid);
			// return json_encode($data2);
			$query = $this->listing_m->save($data2);
			$this->session->set(['last_id'  => $lastid]);
		}
		$this->listing_steps_m->set(['step_8' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
	}
	private function saveStep9($data)
	{
		helper('file');
		// return json_encode($data);
		$lastid = intval($data['listing_id']);
		// return json_encode($data);

		$listing = $data['listing'];
		$gallery = $data['gallery'];
		// return json_encode($gallery);

		foreach ($gallery as $images) {
			$this->listing_gallery_m->save($images);
		}
		// return json_encode($data);
		$listing['listing_id'] = intval($lastid);
		$query = $this->listing_m->save($listing);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_9' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
	}
	private function saveStep10($data)
	{
		// return json_encode($data);
		$lastid = intval($data['listing_id']);
		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		$data['listing_id'] = intval($lastid);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_10' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
	}
	private function saveStep11($data)
	{
		// return json_encode($data);
		$lastid = intval($data['listing_id']);
		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		$data['listing_id'] = intval($lastid);
		$query = $this->listing_m->save($data);
		$this->listing_steps_m->set(['step_11' => 1])->where('listing_id', $lastid)->update();
		$this->session->set(['last_id'  => $lastid]);
		return json_encode($lastid);
	}
	private function saveStep12($data)
	{
		// return json_encode($data);
		$lastid = intval($data['listing_id']);
		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		if (isset($data['requirementsgovtid'])) {
			if ($data['requirementsgovtid'] == 'on') {
				$data['requirementsgovtid'] = 1;
			} else {
				$data['requirementsgovtid'] = 0;
			}
		}
		if (isset($data['requirementspositiveguest'])) {
			if ($data['requirementspositiveguest'] == 'on') {
				$data['requirementspositiveguest'] = 1;
			} else {
				$data['requirementspositiveguest'] = 0;
			}
		}
		$data['listing_id'] = intval($lastid);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_12' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
	}
	private function saveStep13($data)
	{
		$lastid = intval($data['listing_id']);
		foreach ($data as $key => $value) {
			if ($value === "on") {
				$data[$key] = intval(1);
			}
		}
		if (isset($data['additoinal_rules'])) {
			$adtionalRules = $data['additoinal_rules'];
			foreach ($adtionalRules as $key => $rule) {
				$thisrule = [
					'listing_id' => $lastid,
					'rule' => $rule
				];
				$this->listing_aditional_rules_m->insert($thisrule);
				// $data[$key.'x'] = $rule;
			}
		}

		unset($data['additoinal_rules']);
		unset($data['mode']);
		unset($data['user_id']);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_13' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep14($data)
	{
		$lastid = intval($data['listing_id']);
		foreach ($data as $key => $value) {
			if ($value === "on") {
				$data[$key] = intval(1);
			}
		}
		if ($data['instantbooking'] == 0) {
			$data['reviewedbooking'] = 1;
		} else {
			$data['reviewedbooking'] = 0;
		}

		unset($data['mode']);
		unset($data['user_id']);
		// return print_r($data);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_14' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep15($data)
	{
		$lastid = intval($data['listing_id']);

		unset($data['mode']);
		unset($data['user_id']);
		// return print_r($data);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_15' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep16($data)
	{
		$lastid = intval($data['listing_id']);

		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_16' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep17($data)
	{
		$lastid = intval($data['listing_id']);

		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_17' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep18($data)
	{
		$lastid = intval($data['listing_id']);

		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_18' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep19($data)
	{
		$lastid = intval($data['listing_id']);
		foreach ($data as $key => $value) {
			if ($value === "on") {
				$data[$key] = intval(1);
			}
		}
		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_19' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep20($data)
	{
		$lastid = intval($data['listing_id']);
		foreach ($data as $key => $value) {
			if ($value === "on") {
				$data[$key] = intval(1);
			}
		}
		unset($data['mode']);
		unset($data['user_id']);
		// return json_encode($data);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_20' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep21($data)
	{
		$lastid = intval($data['listing_id']);
		foreach ($data as $key => $value) {
			if ($value === "on") {
				$data[$key] = intval(1);
			}
		}
		unset($data['mode']);
		unset($data['user_id']);
		$data['finished'] = 1;
		// return json_encode($data);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_21' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep22($data)
	{
		$lastid = intval($data['listing_id']);
		foreach ($data as $key => $value) {
			if ($value === "on") {
				$data[$key] = intval(1);
			}
		}
		unset($data['mode']);
		unset($data['user_id']);
		$data['finished'] = 1;
		// return json_encode($data);
		$query = $this->listing_m->save($data);
		$this->session->set(['last_id'  => $lastid]);
		$this->listing_steps_m->set(['step_22' => 1, 'step_23' => 1, 'last_step' => 1])->where('listing_id', $lastid)->update();
		return json_encode($lastid);
		// return print_r($data);
	}
	private function saveStep23($data)
	{
	}
}
