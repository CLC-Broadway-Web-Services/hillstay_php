<?php

namespace App\Models\Globals;

use CodeIgniter\Model;

class PasswordresetModel extends Model
{
	protected $table = 'password_resets';
	protected $primaryKey = 'reset_id ';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'reset_code', // numeric
		'reset_email',
		'reset_user_id',
		'reset_user_table',
		'reset_status',
	];
	protected $createdField  = 'reset_created_at';
	protected $updatedField  = 'reset_updated_at';
}
