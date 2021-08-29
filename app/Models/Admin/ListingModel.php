<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ListingModel extends Model
{
	protected $table = 'listings';
	protected $primaryKey = 'listing_id';
	protected $returnType = 'array';
	protected $allowedFields = [
		// MAIN DATA
		'uid',
		'status',
		'status2',
		'finished',
		'published',
		// STEP 1
		'placekind',
		'guests',
		'location',
		// STEP 2
		'propertytype',
		'propertytypespecial',
		'propertytyperooms',
		'offbeat',
		'offbeatonroad',
		'offbeat_walking',
		'offbeat_market',
		'offbeat_medical',
		'offbeat_town',
		'offbeat_busstation',
		'entire',
		'private',
		'shared',
		// STEP 3
		'bedrooms',
		// listings_sleeping_arrangements from different table
		// STEP 4
		'bathrooms',
		// STEP 5
		'address_full',
		'flat_no',
		'state',
		'district',
		'town',
		'postcode',
		// STEP 6
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
		// STEP 7
		'safety_smoke_detector',
		'safety_carbon_monoxide_detector',
		'safety_first_aid_kit',
		'safety_fire_extinguisher',
		'safety_lock_on_bedroom_door',
		// STEP 8
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

		'coverimage',

		// STEP 10
		'description',
		'yourspace',
		'yourinteraction',
		'yourneighbourhood',
		'gettingaround',
		// STEP 11
		'title',
		// STEP 12
		'requirementsgovtid',
		'requirementspositiveguest',
		// STEP 13
		'houserules_forchildren',
		'houserules_forinfants',
		'houserules_forpets',
		'houserules_smokingallowed',
		'houserules_partiesallowed',
		// additionalrules from different table if there is any
		'housedetails_climbstairs',
		'housedetails_climbstairs_desc',
		'housedetails_noisepotential',
		'housedetails_noisepotential_desc',
		'housedetails_petsonproperty',
		'housedetails_petsonproperty_desc',
		'housedetails_noparking',
		'housedetails_noparking_desc',
		'housedetails_sharedspace',
		'housedetails_sharedspace_desc',
		'housedetails_amenitylimitaion',
		'housedetails_amenitylimitaion_desc',
		'housedetails_surveillance',
		'housedetails_surveillance_desc',
		'housedetails_weapons',
		'housedetails_weapons_desc',
		'housedetails_dangerousaminals',
		'housedetails_dangerousaminals_desc',
		// STEP 14
		'instantbooking',
		'reviewedbooking',
		'reviewedbooking_onedayresponse',
		'reviewedbooking_ranklower',
		'reviewedbooking_nohostprotection',
		// STEP 15
		'rentedbefore',
		'neededguests',
		// STEP 16
		'availabilitydays',
		'bookbefore',
		'checkintiming_from',
		'checkintiming_to',
		// STEP 17
		'advancebooking',
		// STEP 18
		'nightsmin',
		'nightsmax',
		'calendardatesblock',
		'is_disabled',
		'disabled_dates',
		'enabled_dates',
		// STEP 19
		'price',
		'cleaningFeeRequired',
		'cleaning_fee',
		// STEP 20
		'welcomeoffer',
		// STEP 21
		'weeklydiscount',
		'monthlydiscount',
		'is_sanitized',
		'sanitisation_data',
	];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	function getHostListings($user_id)
	{
		// $sleepArrang_m = new ListingSleepingArrangementModel();
		// $gallery_m = new ListingGalleryModel();
		// $addtionalRules_m = new ListingAdditionalRuleModel();
		$listings = $this->select('listing_id, uid, status, status2, published, guests, location, bedrooms, bathrooms, coverimage, title, updated_at')->where(['uid' => $user_id])->findAll();
		// $fullListing = array();
		// if($listings) {
		// 	foreach($listings as $key => $isting) {
		// 		$fullListing[$key] = $isting;
		// 		$fullListing[$key]['sleeping_arrangements'] = $sleepArrang_m->where('listing_id', $isting['listing_id'])->findAll();
		// 		$fullListing[$key]['gallery'] = $gallery_m->where('listing_id', $isting['listing_id'])->findAll();
		// 		$fullListing[$key]['addtional_rules'] = $addtionalRules_m->where('listing_id', $isting['listing_id'])->findAll();
		// 	}
		// }
		// return $fullListing;
		return $listings;
	}
	function getHostListing($listing_id)
	{
		$sleepArrang_m = new ListingSleepingArrangementModel();
		$gallery_m = new ListingGalleryModel();
		$addtionalRules_m = new ListingAdditionalRuleModel();
		$listing = $this->select('listing_id, uid, status, status2, published, guests, location, bedrooms, bathrooms, coverimage, title, updated_at')->find($listing_id);
		if ($listing) {
			$listing['sleeping_arrangements'] = $sleepArrang_m->where('listing_id', $listing['listing_id'])->findAll();
			$listing['gallery'] = $gallery_m->where('listing_id', $listing['listing_id'])->findAll();
			$listing['addtional_rules'] = $addtionalRules_m->where('listing_id', $listing['listing_id'])->findAll();
		}
		return $listing;
	}
}
