<?php

namespace App\Controllers;

use App\Models\Admin\ListingModel;
use App\Models\Admin\ListingSleepingArrangementModel;

class Home extends BaseController
{
	private $data;

	public function __construct()
	{
		$this->data = array();
		$this->data['user_name'] = session()->get('firstName');
	}
	public function index()
	{
		$listing_m = new ListingModel();
		$sleep_m = new ListingSleepingArrangementModel();

		// $exams_papers = $this->model->distinct()
		//     ->select('exam_paper.*, exam_category.category as category_name')
		//     ->orderBy('exam_paper.exam_id', 'DESC')
		//     ->join('exam_category', 'exam_category.ex_cat_id=exam_paper.exam_category')
		//     ->findAll();
		$homepageListings = $listing_m
			->select('listing_id, coverimage, placekind, title, location, price, status, finished, published')
			->where(['status' => 1, 'finished' => 1, 'published' => 1])
			->orderBy('listing_id', 'DESC')
			// ->select('listings.listing_id, listings.coverimage, listings.placekind, listings.title, listings.location, listings.price, listings.status, listings.finished, listings.published, listings_sleeping_arrangements.total_beds')
			// ->where(['listings.status' => 1, 'listings.finished' => 1, 'listings.published' => 1])
			// ->orderBy('listings.listing_id', 'DESC')
			// ->join('listings_sleeping_arrangements', 'listings_sleeping_arrangements.listing_id=listings.listing_id')
			->findAll();
		
		$finalListings = [];
		foreach($homepageListings as $key => $homeListing) {
			$listingId = $homeListing['listing_id'];
			$sleeps = $sleep_m->select('total_beds')->where('listing_id', $listingId)->findAll();
			$totalBeds = 0;
			foreach($sleeps as $beds) {
				$totalBeds += intval($beds['total_beds']);
			}
			$homeListing['totalBeds'] = $totalBeds;
			$finalListings[] = $homeListing;
		}

		$this->data['listings'] = $finalListings;

		// return print_r($this->data);

		$this->data['leafletScripts'] = true;
		$this->data['pageJS'] = '<script src="/public/custom/assets/js/homepage.js"></script>';

		return view('Frontend/pages/homepage', $this->data);
	}
}
