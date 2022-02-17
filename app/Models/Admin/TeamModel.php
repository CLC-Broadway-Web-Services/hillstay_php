<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TeamModel extends Model
{
	protected $table = 'team_members';
	protected $primaryKey = 'member_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'member_name',
		'member_email',
		'member_mobile',
		'member_image',
		'member_postition',
		'member_facebook',
		'member_linkedin',
		'member_twitter',
		'member_about',
		'member_home_view',
		'member_status',
	];
	protected $createdField  = 'member_created_at';
	protected $updatedField  = 'member_updated_at';
}
