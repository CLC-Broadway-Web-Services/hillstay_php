<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// FRONTEND ROUTES ONLY
$routes->group('/', function ($routes) {
	$routes->get('', 'Home::index', ['as' => 'home_page']);
	$routes->match(['get', 'post'], 'login', 'Frontend\Auth::login', ['as' => 'login_page']);
	$routes->match(['get', 'post'], 'register', 'Frontend\Auth::register', ['as' => 'register_page']);
	$routes->match(['get', 'post'], 'recover', 'Frontend\Auth::recover', ['as' => 'recover_page']);

	// $routes->post('get_city_by_state/(:num)', 'Global::get_city_by_state/$1');

	$routes->match(['get', 'post'], 'help', 'Frontend\Common::help', ['as' => 'help_page']);
	$routes->get('user/profile/(:segment)', 'Frontend\Public\User::profile', ['as' => 'public_profile_page']); // unique id

	$routes->group('account', ['filter' => 'auth'], function ($routes) {
		$routes->match(['get', 'post'], 'profile', 'Frontend\Account::account_profile', ['as' => 'account_profile']);
		$routes->match(['get', 'post'], 'inbox', 'Frontend\Account::account_inbox', ['as' => 'account_inbox']);
		$routes->match(['get', 'post'], 'inbox/(:segment)', 'Frontend\Account::account_inbox/$1', ['as' => 'account_inbox_chat']);
		$routes->match(['get', 'post'], 'alerts', 'Frontend\Account::account_alerts', ['as' => 'account_alerts']);
		$routes->match(['get', 'post'], 'trips', 'Frontend\Account::account_trips', ['as' => 'account_trips']);
		$routes->match(['get', 'post'], 'wishlist', 'Frontend\Account::account_wishlist', ['as' => 'account_wishlist']);
		$routes->match(['get', 'post'], 'settings', 'Frontend\Account::account_settings', ['as' => 'account_settings']);
		$routes->match(['get', 'post'], 'transactions-history', 'Frontend\Transactions::index', ['as' => 'account_transaction_history']);

		$routes->match(['get', 'post'], 'help', 'Frontend\Account::account_settings', ['as' => 'account_help']);

		$routes->match(['get', 'post'], 'logout', 'Frontend\Auth::logOut', ['as' => 'logout_user']);
		// payment post routes
		$routes->match(['post'], 'makepayment', 'Transactions::processPayment', ['as' => 'account_make_payment']);
	});

	$routes->group('hosting', ['filter' => 'auth'], function ($routes) {
		$routes->match(['get', 'post'], '/', 'Frontend\Hosting\Dashboard::index', ['as' => 'hosting_dashboard_index']);
		$routes->match(['get', 'post'], 'reservations', 'Frontend\Hosting\Reservations::index', ['as' => 'hosting_dashboard_reservations']);
		$routes->group('reservations', function ($routes) {
			$routes->match(['get', 'post'], '/', 'Frontend\Hosting\Reservations::index', ['as' => 'hosting_dashboard_reservations']);
			$routes->match(['post'], 'approve', 'Frontend\Hosting\Reservations::approve', ['as' => 'hosting_dashboard_reservations_approve']);
			$routes->match(['post'], 'reject', 'Frontend\Hosting\Reservations::reject', ['as' => 'hosting_dashboard_reservations_reject']);
		});
		$routes->match(['get', 'post'], 'calendar', 'Frontend\Hosting\Calendar::index', ['as' => 'hosting_dashboard_calendar']);
		$routes->match(['get', 'post'], 'stats', 'Frontend\Hosting\Progress::index', ['as' => 'hosting_dashboard_stats']);

		$routes->group('inbox', function ($routes) {
			$routes->match(['get', 'post'], '/', 'Frontend\Hosting\Inbox::index', ['as' => 'hosting_inbox_index']);
			$routes->match(['get', 'post'], '(:segment)', 'Frontend\Hosting\Inbox::chat/$1', ['as' => 'hosting_inbox_chat']);
		});

		$routes->group('listing', function ($routes) {
			$routes->match(['get', 'post'], 'addnew', 'Frontend\Hosting\Listing::add_new', ['as' => 'hosting_listing_add_new']);
			$routes->match(['get', 'post'], 'edit/(:num)', 'Frontend\Hosting\Listing::add_new', ['as' => 'hosting_listing_edit']);
			$routes->match(['get', 'post'], '(:num)', 'Frontend\Hosting\Listing::listing/$id', ['as' => 'hosting_listing_listing']);
		});
		$routes->group('listings', function ($routes) {
			$routes->match(['get', 'post'], '/', 'Frontend\Hosting\Listing::index', ['as' => 'hosting_listings_all']);
			$routes->match(['get', 'post'], 'edit/(:num)', 'Frontend\Hosting\Listing::edit/$1', ['as' => 'hosting_listing_edit']);
			$routes->match(['get', 'post'], 'preview/(:num)', 'Frontend\Hosting\Listing::preview/$1', ['as' => 'hosting_listing_preview']);
		});
	});

	$routes->group('place', function ($routes) {
		$routes->add('(:segment)', 'Frontend\Listing::index/$1', ['as' => 'listingDetailsPage']);
		$routes->post('', 'Frontend\Listing::sendMessageToHost', ['as' => 'messageToHost']);
		$routes->post('(:segment)/bookings', 'Frontend\Listing::getCurrentListingBookings/$1');
	});

	$routes->group('hosting', function ($routes) {
		// $routes->get('(:segment)', 'Frontend\Services::singleService/$1');
	});

	$routes->group('f', function ($routes) {
		$routes->get('/', 'Frontend\SearchController::index', ['as' => 'searchPage']);
		$routes->get('(:segment)', 'Frontend\SearchController::index/$1', ['as' => 'searchPageList']);
	});

	$routes->group('stories', function ($routes) {
		// $routes->get('(:segment)', 'Frontend\Services::singleService/$1');
	});

	$routes->group('place', function ($routes) {
		// $routes->get('(:segment)', 'Frontend\Services::singleService/$1');
	});
});

// $routes->group('/', function ($routes) {
// 	$routes->get('/', 'Home::index', ['as' => 'home_page']);
// 	$routes->get('initiatives', 'Frontend\Pages::initiatives', ['as' => 'initiatives_page']);
// 	$routes->get('about-us', 'Frontend\Pages::aboutus', ['as' => 'about_us_page']);
// 	$routes->match(['get', 'post'], 'contact-us', 'Frontend\Pages::contact_us', ['as' => 'contact_us_page']);
// 	$routes->get('terms-of-use', 'Frontend\Pages::terms_of_use', ['as' => 'terms_page']);
// 	$routes->get('privacy-policy', 'Frontend\Pages::privacy_policy', ['as' => 'privacy_page']);

// 	$routes->get('clients', 'Frontend\Clients::index', ['as' => 'clients_page']);
// 	$routes->get('client/(:segment)', 'Frontend\Clients::single/$1', ['as' => 'single_client_page']);

// 	$routes->get('blogs', 'Frontend\Blogs::index', ['as' => 'blogs_page']);
// 	$routes->get('blog/(:segment)', 'Frontend\Blogs::single/$1', ['as' => 'single_post_page']);

// 	$routes->addRedirect('blog', 'blogs_page');
// 	$routes->addRedirect('client', 'clients_page');
// 	$routes->group('service', function ($routes) {
// 		$routes->get('(:segment)', 'Frontend\Services::singleService/$1');
// 		$routes->get('(:segment)/packages', 'Frontend\Services::singleServicePackages/$1');
// 		$routes->match(['get', 'post'], '(:segment)/packages/(:num)', 'Frontend\Services::serviceSelectedPackage/$1/$2');
// 	});
// });



// $routes->group('/', function ($routes) {
// 	$routes->get('/', 'Home::index');
// 	$routes->group('service', function ($routes) {
// 		$routes->get('(:segment)', 'Frontend\Services::singleService/$1');
// 		$routes->get('(:segment)/packages', 'Frontend\Services::singleServicePackages/$1');
// 		$routes->match(['get', 'post'], '(:segment)/packages/(:num)', 'Frontend\Services::serviceSelectedPackage/$1/$2');
// 	});
// });

// ADMIN ROUTES ONLY
$routes->group('administrator', function ($routes) {
	$routes->match(['get', 'post'], 'login', 'Admin\Auth::index');
	$routes->match(['get', 'post'], 'logout', 'Admin\Auth::logOut');
	$routes->match(['get', 'post'], 'forgetpassword', 'Admin\Auth::forgetPassword');
	$routes->get('/', 'Admin\Dashboard::index', ['filter' => 'adminauth']);

	// ADMIN LISTING ROUTES
	$routes->group('listing', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], '/', 'Admin\ListingController::index', ['as' => 'admin_all_listing']);
		$routes->match(['get', 'post'], 'add', 'Admin\ListingController::save', ['as' => 'admin_save_listing']);
		$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\ListingController::save/$1', ['as' => 'admin_update_listing']);
		$routes->match(['get', 'post'], 'status/(:num)', 'Admin\ListingController::activate/$1', ['as' => 'admin_activate_listing']);
		$routes->match(['get', 'post'], 'reject/(:num)', 'Admin\ListingController::reject/$1', ['as' => 'admin_reject_listing']);
		$routes->match(['get', 'post'], 'homestatus/(:num)', 'Admin\ListingController::homeStatus/$1', ['as' => 'admin_home_show']);
	});

	// ADMIN SERVICE ROUTES
	$routes->group('services', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], '/', 'Admin\Services::index');
		$routes->match(['get', 'post'], 'queries', 'Admin\Services::queries');
		$routes->match(['get', 'post'], 'testimonials', 'Admin\Services::testimonials');
	});
	$routes->group('service', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], 'add', 'Admin\Services::addEditService');
		$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\Services::addEditService/$1');
		$routes->match(['get', 'post'], 'status/(:num)', 'Admin\Services::serviceStatusChange/$1');
		$routes->match(['get', 'post'], 'homestatus/(:num)', 'Admin\Services::serviceHomeStatusChange/$1');
		$routes->group('forms', function ($routes) {
			$routes->get('/', 'Admin\Serviceforms::index');
			$routes->match(['get', 'post'], 'add', 'Admin\Serviceforms::addEditForm');
			$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\Serviceforms::addEditForm/$1');
			$routes->match(['get', 'post'], 'status/(:num)', 'Admin\Serviceforms::formStatusChange/$1');
		});
		$routes->group('documents', function ($routes) {
			$routes->get('/', 'Admin\Services::serviceDocuments');
			$routes->match(['get', 'post'], 'add', 'Admin\Services::addEditServiceDocument');
			$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\Services::addEditServiceDocument/$1');
			$routes->match(['get', 'post'], 'status/(:num)', 'Admin\Services::serviceDocumentStatusChange/$1');
		});
		$routes->group('faqs', function ($routes) {
			$routes->get('/', 'Admin\Services::serviceFaqs');
			$routes->match(['get', 'post'], 'add', 'Admin\Services::addEditServiceFaq');
			$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\Services::addEditServiceFaq/$1');
			$routes->match(['get', 'post'], 'status/(:num)', 'Admin\Services::serviceFaqStatusChange/$1');
		});
		$routes->group('packages', function ($routes) {
			$routes->get('/', 'Admin\Services::servicePackages');
			$routes->match(['get', 'post'], 'add', 'Admin\Services::addEditServicePackage');
			$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\Services::addEditServicePackage/$1');
			$routes->match(['get', 'post'], 'status/(:num)', 'Admin\Services::servicePackageStatusChange/$1');
		});
	});

	// ADMIN BLOG ROUTES
	$routes->group('blogs', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], '/', 'Admin\Blogs::index');
	});
	$routes->group('blog', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], 'categories', 'Admin\Blogs::categories');
		$routes->match(['get', 'post'], 'categories/(:num)', 'Admin\Blogs::categories/$1');
		$routes->match(['get', 'post'], 'categories/delete/(:num)', 'Admin\Blogs::categoriesDelete/$1');
		$routes->match(['get', 'post'], 'comments', 'Admin\Blogs::comments');

		$routes->match(['get', 'post'], 'add', 'Admin\Blogs::addEditBlogPost');
		$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\Blogs::addEditBlogPost/$1');
		$routes->match(['get', 'post'], 'status/(:num)', 'Admin\Blogs::postStatusChange/$1');
		$routes->match(['get', 'post'], 'homestatus/(:num)', 'Admin\Blogs::postHomeStatusChange/$1');
	});

	// ADMIN PROJECT ROUTES
	$routes->group('projects', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], '/', 'Admin\Projects::index');
	});
	$routes->group('project', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], 'categories', 'Admin\Projects::categories');
		$routes->match(['get', 'post'], 'categories/(:num)', 'Admin\Projects::categories/$1');
		$routes->match(['get', 'post'], 'categories/delete/(:num)', 'Admin\Projects::categoriesDelete/$1');

		$routes->match(['get', 'post'], 'add', 'Admin\Projects::addEditProject');
		$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\Projects::addEditProject/$1/$2');
		$routes->match(['get', 'post'], 'status/(:num)', 'Admin\Projects::statusChange/$1');
		$routes->match(['get', 'post'], 'homestatus/(:num)', 'Admin\Projects::homeStatusChange/$1');
	});

	// ADMIN CLIENTS ROUTES
	$routes->group('clients', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], '/', 'Admin\Clients::index');

		$routes->match(['get', 'post'], 'add', 'Admin\Clients::addEditClients');
		$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\Clients::addEditClients/$1');
	});

	// ADMIN TEAM ROUTES
	$routes->group('team', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], '/', 'Admin\Team::index');

		$routes->match(['get', 'post'], 'add', 'Admin\Team::addEditMember');
		$routes->match(['get', 'post'], 'edit/(:num)', 'Admin\Team::addEditMember/$1/$2');
	});

	// ADMIN OTHERS ROUTES
	$routes->group('other', ['filter' => 'adminauth'], function ($routes) {
		$routes->match(['get', 'post'], 'subscribers', 'Admin\Others::subscribers');
		$routes->match(['get', 'post'], 'contact-submission', 'Admin\Others::contactSubmission');

		$routes->match(['get', 'post'], 'testimonials', 'Admin\Others::testimonials');
		$routes->match(['get', 'post'], 'testimonials/(:num)', 'Admin\Others::testimonials/$1');
		$routes->match(['get', 'post'], 'testimonials/delete/(:num)', 'Admin\Others::testimonialsDelete/$1');
	});
});

// $routes->group('administrator', function ($routes) {
// 	$routes->match(['get', 'post'], 'login', 'Admin\Auth::index');
// 	$routes->match(['get', 'post'], 'logout', 'Admin\Auth::logOut');
// 	$routes->match(['get', 'post'], 'forgetpassword', 'Admin\Auth::forgetPassword');
// 	$routes->get('/', 'Admin\Dashboard::index', ['filter' => 'adminauth']);
// });


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
