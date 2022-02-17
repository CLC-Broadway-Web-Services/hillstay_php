<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
class UserverifyModel extends Model
{
	protected $table = 'userverification';
	protected $primaryKey = 'vid';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'uid',
		'type',
		'code',
		'status',
		'completed_at',
	];
    // protected $useSoftDeletes = true;
    protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
}
