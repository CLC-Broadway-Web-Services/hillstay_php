<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class Chatsystem extends Model
{
	// protected $DBGroup              = 'default';
	protected $table                = 'messages';
	protected $primaryKey           = 'mid';
	// protected $useAutoIncrement     = true;
	// protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'inbox',
		'userid',
		'userName',
		'hostid',
		'hostName',
		'message',
		'messagebyuser',
		'notifyUserWeb',
		'isBookingNotification',
		'bookingStatus',
		'checkin',
		'checkout',
		'guests',
		'price_total',
		'total_nights',
		'listing_name',
		'listing_id'
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

	public function insertChat($payload)
	{
		$inboxId = $payload['inbox'];
		// $chatInsert = $this->save($payload);
		$inboxDb = new InboxModel();
		// $data = ['total_chats' => '`total_chats` + 1', 'id' => $inboxId];
		// return $data;
		$inboxDb->set('total_chats', 'total_chats+1', false)->where('id', $inboxId);
		return $inboxDb->update();
		// $inboxDb->where('id', $inboxId);
		// $inboxDb->set('total_chats', 'total_chats+1');
		// $inboxDb->update('users');
	}
}
