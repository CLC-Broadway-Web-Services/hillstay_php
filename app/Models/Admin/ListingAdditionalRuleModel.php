<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ListingAdditionalRuleModel extends Model
{
	protected $table = 'listings_additionalrules';
	protected $primaryKey = 'rule_id ';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'listing_id',
		'rule',
	];
}
