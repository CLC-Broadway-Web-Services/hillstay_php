<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ListingGalleryModel extends Model
{
	protected $table = 'listings_gallery';
	protected $primaryKey = 'gid ';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'listing_id',
		'image',
		'caption',
		'isCover',
	];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
}
