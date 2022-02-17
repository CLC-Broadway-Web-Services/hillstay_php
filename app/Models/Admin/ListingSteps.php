<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ListingSteps extends Model
{
	protected $table = 'listings_steps';
	protected $primaryKey = 'lsid ';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'listing_id',
		'user_id',
		'step_0',
		'step_1',
		'step_2',
		'step_3',
		'step_4',
		'step_5',
		'step_6',
		'step_7',
		'step_8',
		'step_9',
		'step_10',
		'step_11',
		'step_12',
		'step_13',
		'step_14',
		'step_15',
		'step_16',
		'step_17',
		'step_18',
		'step_19',
		'step_20',
		'step_21',
		'step_22',
		'step_23',
		'last_step',
	];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

}
