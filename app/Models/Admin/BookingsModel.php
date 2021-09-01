<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class BookingsModel extends Model
{
	// protected $DBGroup              = 'default';
	protected $table                = 'bookings';
	protected $primaryKey           = 'id';
	// protected $useAutoIncrement     = true;
	// protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	// protected $protectFields        = true;
	protected $allowedFields        = [
		'staff_id',
		'listing_id',
		'user_id',
		'host_id',
		'payment_id',
		'payment_status',
		'payment_max_time',
		'transaction_status',
		'payment_id',
		'notify_web',	
		'status',
		'status_name',
		'completed',
		'cancelled',
		'requested',
		'approved',
		'check_in',
		'check_out',
		'total_nights',	
		'price_per_night',
		'price_total',
		'price_breakdown',	
		'guest_adults',
		'guest_chldren',
		'guest_infants',
		'guests',
		'guest_details',	
		'discount_amount',
		'discount_weekly',
		'discount_monthly',
		'discount_welcome',
		'discount_type',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// // Validation
	// protected $validationRules      = [];
	// protected $validationMessages   = [];
	// protected $skipValidation       = false;
	// protected $cleanValidationRules = true;

	// // Callbacks
	// protected $allowCallbacks       = true;
	// protected $beforeInsert         = [];
	// protected $afterInsert          = [];
	// protected $beforeUpdate         = [];
	// protected $afterUpdate          = [];
	// protected $beforeFind           = [];
	// protected $afterFind            = [];
	// protected $beforeDelete         = [];
	// protected $afterDelete          = [];
}
