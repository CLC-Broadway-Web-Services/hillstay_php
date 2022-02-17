<?php

namespace App\Models\Globals;

use CodeIgniter\Model;

class UserVerificationModel extends Model
{
	protected $table = 'user_verification';
	protected $primaryKey = 'id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'user_id',
		'aadhaar_front',
		'aadhaar_back',
		'aadhaar_id',
		'aadhaar_name',
		'aadhaar_address',
		'aadhaar_dob',
		'aadhaar_gender',
		'aadhaar_status',
		'aadhaar_message',
		'pancard_file',
		'pancard_id',
		'pancard_name',
		'pancard_dob',
		'pancard_status',
		'pancard_message',
	];
	// protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
}
