<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TransactionModel extends Model
{
	protected $table                = 'transactions';
	protected $primaryKey           = 'id';
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"receipt",
		"amount",
		"amount_paid",
		"amount_due",
		"attempts",
		"notes",
		"order_created_at",
		"payment_id",
		"signature",
		"description",
		"user_name",
		"user_email",
		"user_contact",
		"address",
		"merchant_order_id",
		"order_id",
		"card_id",
		"status",
		"other_info"
	];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';
}
