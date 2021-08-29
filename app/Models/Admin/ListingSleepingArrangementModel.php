<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ListingSleepingArrangementModel extends Model
{
	protected $table = 'listings_sleeping_arrangements';
	protected $primaryKey = 'lsaid';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'listing_id',
		'user_id',
		'total_beds',
		'double_bed',
		'king_bed',
		'queen_bed',
		'single_bed',
		'floormat_bed',
		'sofa_bed',
		'bunk_bed',
		'hammock_bed',
	];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
}
