<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Models\Admin\ListingModel;
use App\Models\Admin\ListingSleepingArrangementModel;

class SearchController extends BaseController
{
	private $data;
	protected $listingModel;
	public function __construct()
	{
		$this->data = array();
		$schedule2 = array();
		$this->data['user_name'] = null;
		$this->data['user_id'] = null;
		$this->listingModel = new ListingModel();
		if (!session()->get('isUserLoggedIn')) {
			$this->data['user_name'] = session()->get('firstName');
			$this->data['user_id'] = session()->get('uid');
		}
	}
	public function index($list = 'no')
	{
		// return print_r($this->request->getVar('date'));
		$this->data['leafletScripts'] = true;
		// $this->data['pageJS'] = '<script src="/public/custom/assets/js/homepage.js"></script>';
		$this->data['noStickyHeader'] = true;

		$date = $this->request->getVar('date');
		$form_name = $this->request->getVar('form_name');

		// return print_r($amenities_rules);
		$propertytype = $this->request->getVar('propertytype');
		$location = $this->request->getVar('location');
		$guests = $this->request->getVar('qtyInputTotal')?$this->request->getVar('qtyInputTotal'):0;
		$qtyInputInfant = $this->request->getVar('qtyInputInfant');

		$guestsNumber = $guests - $qtyInputInfant;
		// return print_r($propertytype);
		// return print_r($location);

		if ($list == 'list') {
			$this->data['noFooter'] = true;
			return view('Frontend/pages/Search/indexList', $this->data);
		} 
		elseif($guestsNumber > 1 || $location == true || $propertytype == true || $form_name == 'amenities_rules') {
			if ($guestsNumber > 1) {
				$this->data['searchList'] = $this->listingModel
					->select('listing_id, coverimage, placekind, title, location, price, status, finished, published')
					->where(['status' => 1, 'finished' => 1, 'published' => 1, 'houserules_forchildren' => 'yes', 'houserules_forinfants' => 'yes'])
					->where( 'guests >=', $guestsNumber)
					->orderBy('listing_id', 'DESC')->findAll();
			}
			if ($location == true) {
				$this->data['searchList'] = $this->listingModel
					->select('listing_id, coverimage, placekind, title, location, price, status, finished, published')
					->where(['status' => 1, 'finished' => 1, 'published' => 1, 'guests' => $guestsNumber])
					->like('location', $location)->orLike('town', $location)->orLike('address_full', $location)->orLike('address_full', $location)
					->orderBy('listing_id', 'DESC')->findAll();
			}
			if ($propertytype == true) {
				$this->data['searchList'] = $this->listingModel
					->select('listing_id, coverimage, placekind, title, location, price, status, finished, published')
					->where(['status' => 1, 'finished' => 1, 'published' => 1, 'propertytype' => $propertytype])
					->like('propertytype', $propertytype)
					->orderBy('listing_id', 'DESC')->findAll();
			}
			if ($form_name == 'amenities_rules') {

				$amenities_rules = [
					'status' => 1,
					'finished' => 1,
					'published' => 1,
				];

				$amenities_rules['amenity_wifi'] = $this->request->getVar('amenity_wifi') ? 1 : '';
				$amenities_rules['amenity_tv'] = $this->request->getVar('amenity_tv') ? 1 : '';
				$amenities_rules['amenity_heating'] = $this->request->getVar('amenity_heating') ? 1 : '';
				$amenities_rules['amenity_ac'] = $this->request->getVar('amenity_ac') ? 1 : '';
				$amenities_rules['amenity_iron'] = $this->request->getVar('amenity_iron') ? 1 : '';
				$amenities_rules['amenity_shampoo'] = $this->request->getVar('amenity_shampoo') ? 1 : '';
				$amenities_rules['amenity_hairdryer'] = $this->request->getVar('amenity_hairdryer') ? 1 : '';
				$amenities_rules['amenity_breakfast_coffee_tea'] = $this->request->getVar('amenity_breakfast_coffee_tea') ? 1 : '';
				$amenities_rules['amenity_desk_workspace'] = $this->request->getVar('amenity_desk_workspace') ? 1 : '';
				$amenities_rules['amenity_fireplace'] = $this->request->getVar('amenity_fireplace') ? 1 : '';
				$amenities_rules['amenity_wardrobe_drawers'] = $this->request->getVar('amenity_wardrobe_drawers') ? 1 : '';
				$amenities_rules['amenity_private_entrance'] = $this->request->getVar('amenity_private_entrance') ? 1 : '';
				$amenities_rules['amenity_sanitization_kit'] = $this->request->getVar('amenity_sanitization_kit') ? 1 : '';
				$amenities_rules['guestspace_kitchen'] = $this->request->getVar('guestspace_kitchen') ? 1 : '';
				$amenities_rules['guestspace_laundry_washing_machine_dryer'] = $this->request->getVar('guestspace_laundry_washing_machine_dryer') ? 1 : '';
				$amenities_rules['guestspace_parking'] = $this->request->getVar('guestspace_parking') ? 1 : '';
				$amenities_rules['guestspace_gym'] = $this->request->getVar('guestspace_gym') ? 1 : '';
				$amenities_rules['guestspace_pool'] = $this->request->getVar('guestspace_pool') ? 1 : '';
				$amenities_rules['guestspace_hottub'] = $this->request->getVar('guestspace_hottub') ? 1 : '';
				$amenities_rules['guestspace_prayer_room'] = $this->request->getVar('guestspace_prayer_room') ? 1 : '';
				$amenities_rules['guestspace_garden'] = $this->request->getVar('guestspace_garden') ? 1 : '';
				$amenities_rules['guestspace_patio'] = $this->request->getVar('guestspace_patio') ? 1 : '';
				$amenities_rules['guestspace_balcony'] = $this->request->getVar('guestspace_balcony') ? 1 : '';
				$amenities_rules['guestspace_lobby'] = $this->request->getVar('guestspace_lobby') ? 1 : '';
				$amenities_rules['guestspace_terrace'] = $this->request->getVar('guestspace_terrace') ? 1 : '';

				foreach ($amenities_rules as $key => $value) {
					if ($value == 0) {
						unset($amenities_rules[$key]);
					}
				}
				// return print_r($amenities_rules);
				$this->data['searchList'] = $this->listingModel
					->select('listing_id, coverimage, placekind, title, location, price, status, finished, published')
					->where($amenities_rules)
					->orderBy('listing_id', 'DESC')->findAll();
			}
			if ($date == true) {
				$this->data['searchList'] = $this->listingModel
					->select('listing_id, coverimage, placekind, title, location, price, status, finished, published')
					->where(['status' => 1, 'finished' => 1, 'published' => 1, 'propertytype' => $propertytype])
					->like('propertytype', $propertytype)
					->orderBy('listing_id', 'DESC')->findAll();
			}


			$this->data['searchList'] = $this->listingBeds($this->data['searchList']);
			// return print_r($this->data['searchList']);
			return view('Frontend/pages/Search/index', $this->data);
		}
		else{
			$this->data['searchList'] = $this->listingModel
					->select('listing_id, coverimage, placekind, title, location, price, status, finished, published')
					->where(['status' => 1, 'finished' => 1, 'published' => 1])
					->orderBy('listing_id', 'DESC')->findAll();

					$this->data['searchList'] = $this->listingBeds($this->data['searchList']);
					// return print_r($this->data['searchList']);
					return view('Frontend/pages/Search/index', $this->data);
		}
		
	}

	private function listingBeds($homepageListings)
	{
		$sleep_m = new ListingSleepingArrangementModel();
		$finalListings = [];
		foreach ($homepageListings as $key => $homeListing) {
			$listingId = $homeListing['listing_id'];
			$sleeps = $sleep_m->select('total_beds')->where('listing_id', $listingId)->findAll();
			$totalBeds = 0;
			foreach ($sleeps as $beds) {
				$totalBeds += intval($beds['total_beds']);
			}
			$homeListing['totalBeds'] = $totalBeds;
			$finalListings[] = $homeListing;
		}

		return $finalListings;
	}
}
