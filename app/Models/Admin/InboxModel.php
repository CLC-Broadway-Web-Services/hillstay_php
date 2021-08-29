<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class InboxModel extends Model
{
	// protected $DBGroup              = 'default';
	protected $table                = 'inbox';
	protected $primaryKey           = 'id';
	// protected $useAutoIncrement     = true;
	// protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'guest_id',
		'guest_name',
		'host_id',
		'host_name',
		'total_chats',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	// protected $validationRules      = [];
	// protected $validationMessages   = [];
	// protected $skipValidation       = false;
	// protected $cleanValidationRules = true;

	// Callbacks
	// protected $allowCallbacks       = true;
	// protected $beforeInsert         = [];
	// protected $afterInsert          = [];
	// protected $beforeUpdate         = [];
	// protected $afterUpdate          = [];
	// protected $beforeFind           = [];
	// protected $afterFind            = [];
	// protected $beforeDelete         = [];
	// protected $afterDelete          = [];

	public function getAllHostInboxes()
	{
		$host_id = session()->get('uid');
		$inboxes = $this->where(['host_id' => $host_id])->orderBy('updated_at', 'desc')->findAll();
		foreach ($inboxes as $key => $inbox) {
			$user_m = new UserModel();
			$userData = $user_m->select('photoURL')->find($inbox['guest_id']);
			$inboxes[$key]['guest_image'] = $userData['photoURL'];
			$inboxes[$key]['guest_id_64'] = base64_encode(base64_encode(base64_encode($inbox['guest_id'])));
		}
		return $inboxes;
	}
}
