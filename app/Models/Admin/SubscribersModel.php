<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class SubscribersModel extends Model
{
	protected $table = 'subscribers';
	protected $primaryKey = 'subscriber_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'subscriber_name',
		'subscriber_email',
		'subscriber_for', // 1=blognewsletter,2=blogpublish
		'subscriber_status',
	];
	protected $createdField  = 'subscriber_created_at';
	protected $updatedField  = 'subscriber_updated_at';
}
