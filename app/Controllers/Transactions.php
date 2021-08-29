<?php

namespace App\Controllers;

use App\Models\Admin\BookingGuestModel;
use App\Models\Admin\BookingsModel;
use App\Models\Admin\InboxModel;
use App\Models\Admin\ListingModel;
use App\Models\Admin\TransactionModel;
use App\Models\Admin\UserModel;
use App\Models\Globals\FunctionsModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use Razorpay\Api\Api;

class Transactions extends Controller
{
	private $data;
	private $listing_m;
	private $bookings_m;
	private $booking_guests_m;
	private $inbox_m;
	private $user_m;
	private $session;
	private $transaction_m;
	private $functions;
	private $razorpay;

	public function __construct()
	{
		$this->data = array();
		$this->session = session();
		$this->data['pageJS'] = '<script>const body = document.getElementsByTagName("body")[0];body.classList.remove("transparent-header");</script>';
		$this->data['user_name'] = $this->session->get('firstName');
		$this->data['user_id'] = $this->session->get('uid');
		$this->data['razorKey'] = env('razorKey');
		$this->listing_m = new ListingModel();
		$this->bookings_m = new BookingsModel();
		$this->booking_guests_m = new BookingGuestModel();
		$this->inbox_m = new InboxModel();
		$this->user_m = new UserModel();
		$this->transaction_m = new TransactionModel();
		$this->functions = new FunctionsModel();
		$this->razorpay = new Api(env('razorKey'), env('razorSecret'));
		helper('file');
	}
	public function index()
	{
		//
	}
	public function processPayment()
	{
		//Input items of form
		$input = $this->request->getVar();
		// return json_encode($input);

		$myTime = new Time('now');
		$unixTime = Time::parse($myTime)->getTimestamp();
		// // first create order
		if (isset($input['create_order'])) {
			$orderData = [
				'receipt'		=> 'RCPT_' . $unixTime,
				'amount'		=> $input['amount'] * 100,
				'notes'			=> json_decode($input['notes']),
				'currency'		=> 'INR'
			];

			$razorpayOrder = $this->razorpay->order->create($orderData);
			if ($razorpayOrder) {
				$order_data['order_id'] = $razorpayOrder['id'];
				$order_data['amount'] = $razorpayOrder['amount'] / 100;
				$order_data['amount_paid'] = $razorpayOrder['amount_paid'];
				$order_data['receipt'] = $razorpayOrder['receipt'];
				$order_data['attempts'] = $razorpayOrder['attempts'];
				$order_data['attempts'] = $razorpayOrder['attempts'];
				$order_data['user_name'] = $input['user_name'];
				$order_data['user_email'] = $input['user_email'];
				$order_data['user_contact'] = $input['user_contact'];
				$order_data['notes'] = $input['notes'];
				$order_data['order_created_at'] = $razorpayOrder['created_at'];
				$createOrderLocally = $this->transaction_m->save($order_data);
				if ($createOrderLocally) {
					return json_encode(['success' => true, 'data' => $order_data]);
				} else {
					return json_encode(['success' => false, 'data' => $createOrderLocally]);
				}
			} else {
				return json_encode(['success' => false, 'data' => $razorpayOrder]);
			}
		}

		// them make payment
		if (isset($input['payment_done'])) {
			// update transaction
			$orderId = $input['payment_id'];
			$order_data['status'] = $input['status'];
			if (isset($input['amount_paid'])) {
				$order_data['amount_paid'] = $input['amount_paid'];
			}
			if (isset($input['payment_id'])) {
				$order_data['payment_id'] = $input['payment_id'];
			}
			$createOrderLocally = $this->transaction_m->where('order_id', $orderId)->save($order_data);
			if ($createOrderLocally) {
				return json_encode(['success' => true]);
			} else {
				return json_encode(['success' => false]);
			}
		} else {
			return json_encode(['success' => false]);
		}
	}
}
