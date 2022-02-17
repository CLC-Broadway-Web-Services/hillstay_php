<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\CitiesModel;
use App\Models\Admin\ListingGalleryModel;
use App\Models\Admin\ListingModel;
use App\Models\Admin\ListingSleepingArrangementModel;
use App\Models\Admin\ListingSteps;
use App\Models\Admin\StatesModel;

class ListingController extends BaseController
{
	protected $data;
	protected $admin;
	protected $listing_m;
	private $listing_sleep_m;
	private $listing_gallery_m;
	private $listing_steps_m;
	protected $states_m;
	protected $cities_m;

	public function __construct()
	{
		$this->data = array();
		$this->admin = session()->get('admin');
	
		$this->listing_m = new ListingModel();
		$this->listing_sleep_m = new ListingSleepingArrangementModel();
		$this->listing_gallery_m = new ListingGalleryModel();
		$this->listing_steps_m = new ListingSteps();
		$this->states_m = new StatesModel();
		$this->cities_m = new CitiesModel();
		helper('file');
	}
	public function index()
	{
		$listings = $this->listing_m
			->select('listing_id, title, status, finished, published, placekind, guests, propertytype, location, price, created_at, updated_at')
			->orderBy('listing_id', 'DESC')->findAll();

		$this->data['listings'] = $listings;

		// return print_r($this->data);
		return view('Administrator/Dashboard/listings/index', $this->data);
	}
	// public function save($listing_id = null)
	// {
	// 	return view('Administrator/Dashboard/listings/edit_listing');
	// }
	public function save($listing_id = null)
	{
		// $additionalRules = ["rule no 1", "rule no 2", "rule no 3", "rule no 4"];
		// $listing['listing_id'] = 16;
		// $listing['additoinal_rules'] = json_encode($additionalRules);
		// $this->listing_m->save($listing);


		$listing = $this->listing_m->find($listing_id);
		$sleep_arrangements = $this->listing_sleep_m->where('listing_id', $listing_id)->findAll();
		$this->data['listing'] = $listing;
		$this->data['listing']['gallery'] = [];
		if ($this->data['listing']['additoinal_rules']) {
			$this->data['listing']['additoinal_rules'] = json_decode($this->data['listing']['additoinal_rules']);
		} else {
			$this->data['listing']['additoinal_rules'] = [];
		}
		$this->data['sleep_arrangements'] = $sleep_arrangements;
		$gallery = $this->listing_gallery_m->where('listing_id', $listing_id)->findAll();
		$this->data['listing']['gallery'] = $gallery;

		// DATA FOR FORMS
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

		$states_m = new StatesModel();
		$cities_m = new CitiesModel();
		$states = $states_m->getStates();

		usort($states, function ($a, $b) {
			return strnatcmp($a['name'], $b['name']);
		});

		$this->data['states'] = $states;
		$this->data['cities'] = $cities_m->getCities();
		$this->data['form_name'] = '';
		if (isset($_GET['tab'])) {
			$this->data['form_name'] = $_GET['tab'];
		}

		if ($this->request->getMethod() == 'post') {
			$returnResponse = [
				'success' => false,
				'message' => 'Error updating data, please try again later.',
				'form_name' => ''
			];
			$formData = $this->request->getVar();
			$form_name = $formData['form_name'];
			unset($formData['form_name']);
			if ($form_name == 'basic_information') {
				foreach ($formData as $key => $value) {
					if (
						isset($formData['offbeat']) && $key == 'offbeat'
						|| isset($formData['offbeatonroad']) && $key == 'offbeatonroad'
						|| isset($formData['entire']) && $key == 'entire'
						|| isset($formData['private']) && $key == 'private'
						|| isset($formData['shared']) && $key == 'shared'
					) {
						if ($value == 'on') {
							$formData[$key] = 1;
						} else {
							$formData[$key] = 1;
						}
					}
				}
				if (!isset($formData['offbeat'])) {
					$formData['offbeat'] = 0;
					$formData['offbeatonroad'] = 0;
					$formData['offbeat_busstation'] = 0;
					$formData['offbeat_market'] = 0;
					$formData['offbeat_medical'] = 0;
					$formData['offbeat_town'] = 0;
					$formData['offbeat_walking'] = 0;
				}
				if (isset($formData['offbeatonroad'])) {
					$formData['offbeat_walking'] = 0;
				}
				return print_r($formData);
				$query = $this->listing_m->set($formData)->where("listing_id", $listing_id)->update();
				if ($query) {
					$returnResponse['success'] = true;
				}
			}
			if ($form_name == 'accomodation') {
				// return json_encode(count($sleep_arrangements));
				$accomodations = $formData['accomodation'];
				return json_encode($formData);

				// delete an sleet arrangement if deleted from form
				if ($sleep_arrangements > $formData['accomodation']) {
					$oldSleepIds = [];
					foreach ($sleep_arrangements as $key => $sleepArrangement) {
						$oldSleepIds[] = $sleepArrangement['lsaid'];
					}
					foreach ($accomodations as $key => $accomodation) {
						if (isset($accomodation['lsaid']) && !in_array($accomodation['lsaid'], $oldSleepIds)) {
							$this->listing_sleep_m->delete($accomodation['lsaid']);
						}
					}
				}
				foreach ($accomodations as $key => $accomodation) {
					$returnResponse['message'] = '';
					$query = $this->listing_sleep_m->save($accomodation);
					if ($query) {
						$returnResponse['success'] = true;
					} else {
						$returnResponse['message'] .= 'Room ' . ($key + 1) . ' Unable to update. ';
						$returnResponse['room_error'] = true;
					}
				}
				if (!isset($returnResponse['room_error'])) {
					$returnResponse['message'] = 'All rooms updated successfully.';
				}
				// save data to listing
				$listingData = [
					'bedrooms' => $this->request->getVar('bedrooms'),
					'bathrooms' => $this->request->getVar('bathrooms')
				];
				$query = $this->listing_m->set($listingData)->where("listing_id", $listing_id)->update();
			}
			if ($form_name == 'location') {
				$formData['status'] == 0;
				$formData['status2'] == 'In Review';
				$query = $this->listing_m->set($formData)->where("listing_id", $listing_id)->update();
				if ($query) {
					$returnResponse['success'] = true;
				}
			}
			if ($form_name == 'amenities_rules') {
				$amenities = [
					'amenity_essentials',
					'amenity_wifi',
					'amenity_tv',
					'amenity_heating',
					'amenity_ac',
					'amenity_iron',
					'amenity_shampoo',
					'amenity_hairdryer',
					'amenity_breakfast_coffee_tea',
					'amenity_desk_workspace',
					'amenity_fireplace',
					'amenity_wardrobe_drawers',
					'amenity_private_entrance',
					'amenity_sanitization_kit',
					'safety_smoke_detector',
					'safety_carbon_monoxide_detector',
					'safety_first_aid_kit',
					'safety_fire_extinguisher',
					'safety_lock_on_bedroom_door',
					'guestspace_kitchen',
					'guestspace_laundry_washing_machine_dryer',
					'guestspace_parking',
					'guestspace_gym',
					'guestspace_pool',
					'guestspace_hottub',
					'guestspace_prayer_room',
					'guestspace_garden',
					'guestspace_patio',
					'guestspace_balcony',
					'guestspace_lobby',
					'guestspace_terrace',
				];
				foreach ($amenities as $amenity) {
					if (isset($formData[$amenity]) && $formData[$amenity] == 'on') {
						$formData[$amenity] = 1;
					} else {
						$formData[$amenity] = 0;
					}
				}
				$rules = [
					'housedetails_climbstairs',
					'housedetails_noisepotential',
					'housedetails_petsonproperty',
					'housedetails_noparking',
					'housedetails_sharedspace',
					'housedetails_amenitylimitaion',
					'housedetails_surveillance',
					'housedetails_weapons',
					'housedetails_dangerousaminals'
				];
				foreach ($rules as $rule) {
					if (!isset($formData[$rule])) {
						$formData[$rule] = 0;
						$formData[$rule . '_desc'] = '';
					} else {
						$formData[$rule] = 1;
					}
				}
				$formData['additoinal_rules'] = json_encode($formData['additoinal_rules']);
				$query = $this->listing_m->set($formData)->where("listing_id", $listing_id)->update();
				if ($query) {
					$returnResponse['success'] = true;
				}
				// return json_encode($formData);
			}
			if ($form_name == 'gallery') {
				if ($img = $this->request->getFile('image')) {
					if ($img->isValid() && !$img->hasMoved()) {
						$newName = $img->getRandomName();
						$img->move(LISTING_IMAGES_FOLDER . $formData['listing_id'], $newName);
						$formData['image'] = LISTING_IMAGES_FOLDER . $formData['listing_id'] . '/' . $newName;
					}
				} else {
					unset($formData['image']);
				}
				$gid = intval($formData['gid']);
				unset($formData['gid']);
				if ($gid) {
					$query = $this->listing_gallery_m->set($formData)->where('gid', $gid)->update();
				} else {
					$query = $this->listing_gallery_m->save($formData);
				}
				if ($query) {
					$listingG = [
						'status' => 0,
						'status2' => 'In Review'
					];
					$query = $this->listing_m->set($listingG)->where("listing_id", $formData['listing_id'])->update();
					$returnResponse['success'] = true;
				}
			}
			if ($form_name == 'booking_settings') {
				$checkBoxes = [
					'requirementsgovtid',
					'requirementspositiveguest',
				];
				foreach ($checkBoxes as $box) {
					if (isset($formData[$box]) && $formData[$box] == 'on') {
						$formData[$box] = 1;
					} else {
						$formData[$box] = 0;
					}
				}
				if ($formData['instantbooking'] == '1') {
					$formData['reviewedbooking_onedayresponse'] == 0;
					$formData['reviewedbooking_ranklower'] == 0;
					$formData['reviewedbooking_nohostprotection'] == 0;
				} else {
					$formData['reviewedbooking'] == '1';
				}
				$query = $this->listing_m->set($formData)->where("listing_id", $listing_id)->update();
				if ($query) {
					$returnResponse['success'] = true;
				}
			}
			if ($form_name == 'pricing') {
				if (isset($formData['cleaningFeeRequired']) && $formData['cleaningFeeRequired'] == 'on') {
					$formData['cleaningFeeRequired'] = 1;
				} else {
					$formData['cleaningFeeRequired'] = 0;
					$formData['cleaning_fee'] = '';
				}
				$query = $this->listing_m->set($formData)->where("listing_id", $listing_id)->update();
				if ($query) {
					$returnResponse['success'] = true;
				}
			}
			if ($form_name == 'delete_gallery') {
				helper('filesystem');
				// return json_encode($formData);
				$gid = $formData['gid'];
				$image = './' . $formData['image'];
				if (@unlink($image)) {
					$this->listing_gallery_m->delete($gid);
					return json_encode(true);
				}
				return json_encode(false);
			}
			$returnResponse['form_name'] = $form_name;
			return json_encode($returnResponse);
		}

		// $method_m = new UserPaymentMethodModel();
		// $this->data['payment_methods'] = $method_m->getUserMethods($this->data['user_id']);

		// if ($this->request->getVar('default_method')) {
		// 	$method_m->changeDefaultMethod($this->data['user_id'], $this->request->getVar('default_method'));
		// 	return json_encode(true);
		// };

		// $info_m = new UserContactInfoModel();
		// $this->data['contact_info'] = $info_m->getUserMethods($this->data['user_id']);

		// if ($this->request->getVar('default_contact_info')) {
		// 	$info_m->changeDefaultMethod($this->data['user_id'], $this->request->getVar('default_contact_info'));
		// 	return json_encode(true);
		// }


		// return print_r($this->data);
		$this->data['pageCSS'] = '<link rel="stylesheet" href="/public/custom/assets/css/edit_listing.css">';
		$this->data['pageJS'] = '<script src="/public/assets/scripts/extensions/tinymce/tinymce.min.js"></script>
		<script src="/public/custom/assets/js/edit_listing.js"></script>';

		return view('Administrator/Dashboard/listings/edit_listing', $this->data);
	}

	public function show($listing_id = null)
	{
	}
	public function activate($listing_id = null)
	{
		$listing = $this->listing_m->where(['listing_id' => $listing_id])->first();
		if ($listing != null) {
			if ($listing['status'] == 1) {
				$query = $this->listing_m->set(['status' => 0])->where(['listing_id' => $listing_id])->update();
				if ($query) {
					// $respose = array(
					// 	'status' => 'success',
					// );
					// return $respose;
				} else {
					$message = array(
						'serviceStatusMessage' => $this->listing_m->error()
					);
					session()->setFlashdata($message);
				}
			} else {
				$query = $this->listing_m->set(['status' => 1, 'finished' => 1, 'published' => 1])->where(['listing_id' => $listing_id])->update();
				if ($query) {
					// $respose = array(
					// 	'status' => 'success',
					// );
					// return $respose;
				} else {
					// $respose = array(
					// 	'status' => 'failed',
					// 	'message' => 'Failed to change status, please contact support.',
					// );
					$message = array(
						'serviceStatusMessage' => 'Failed to change status, please contact support.'
					);
					session()->setFlashdata($message);
					// return $respose;
				}
			}
		} else {
			$message = array(
				'serviceStatusMessage' => 'No faq found for this request.'
			);
			session()->setFlashdata($message);
			// $respose = array(
			// 	'status' => 'failed',
			// 	'message' => 'No faq found for this request.',
			// );
			// return $respose;
		}
		return redirect()->route('admin_all_listing');
	}
	public function reject($listing_id = null)
	{
	}
	public function homeStatus($listing_id = null)
	{
	}
	public function delete($listing_id = null)
	{
		$this->listing_m->delete($listing_id);
		return redirect()->route('admin_all_listing');
	}
}
