<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
class UserreviewsModel extends Model
{
	protected $table = 'user_reviews';
	protected $primaryKey = 'id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'review',
		'reviewTo', // user id
		'reviewFrom', // user id
		'review_status', // boolean
	];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	// protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
