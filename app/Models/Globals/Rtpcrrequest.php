<?php

namespace App\Models\Globals;

use CodeIgniter\Model;

class Rtpcrrequest extends Model
{
	protected $table                = 'rtpcrrequests';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'user_id',
		'user_name',
		'host_id',
		'host_name',
		'booking_id',
		'listing_id',
		'inbox_id',
		'rtpcr_certificate',
		'status', // uploaded / rejected
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
