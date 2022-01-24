<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ContactsModel extends Model
{
	protected $table = 'contact_forms';
	protected $primaryKey = 'id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'user_name',
		'user_email',
		'user_mobile',
		'user_subject',
		'user_message',
	];
    protected $useTimestamps = true;
	protected $createdField  = 'created_updated';
	protected $updatedField  = 'created_updated';
}
