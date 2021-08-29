<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class BookingGuestModel extends Model
{
	// protected $DBGroup              = 'default';
	protected $table                = 'bookings_guests';
	protected $primaryKey           = 'id';
	// protected $useAutoIncrement     = true;
	// protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	// protected $protectFields        = true;
	protected $allowedFields        = [
		'user_id',
		'host_id',
		'booking_id',
		'listing_id',
		'notify_web',
		'name',
		'age',
		'gender',
		'flu_symptoms',
		'chronic_medical_condition',
		'on_medication',
		'health_insurance',
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
