<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ProjectgalleryModel extends Model
{
	protected $table = 'project_gallery';
	protected $primaryKey = 'image_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'image_link',
		'project_id',
		'image_status',
	];
	protected $createdField  = 'image_created_at';
	protected $updatedField  = 'image_updated_at';
}