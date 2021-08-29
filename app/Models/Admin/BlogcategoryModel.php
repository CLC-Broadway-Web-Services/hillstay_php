<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use App\Models\Globals\FunctionsModel;

class BlogcategoryModel extends Model
{
	protected $table = 'blog_category';
	protected $primaryKey = 'post_cat_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'post_cat_name',
		'post_cat_slug',
	];
    protected $useTimestamps = true;
	protected $createdField  = 'post_cat_created_at';
	protected $updatedField  = 'post_cat_updated_at';

	public function getAllCategoriesAdmin()
	{
		return $this->orderBy('post_cat_id', 'desc')->findAll();
	}
	public function getCategoryNamebyID($cat_id) {
		return $this->select('post_cat_name')->find($cat_id);
	}
	public function getCategoryByID($post_cat_id)
	{
		return $this->find($post_cat_id);
	}
	public function addEditCategory($category)
	{
		$session = session();
		helper('form');
		$post_cat_id = intval($category['post_cat_id']);
		$slugify = new FunctionsModel();
		$data = [
			'post_cat_name' => $category['post_cat_name'],
		];
		if ($post_cat_id == 0) {
			$slug = $slugify->slugify($category['post_cat_name']);
			$correctSlug = $this->checkSlugDuplicacy($slug);
			$data['post_cat_slug'] = esc($correctSlug);
			$query = $this->insert($data);
			if ($query) {
				$respose = array(
					'status' => 'success',
				);
				$session->setFlashdata($respose);
				return $respose;
			} else {
				$respose = array(
					'status' => 'failed',
					'message' => $this->error(),
				);
				$session->setFlashdata($respose);
				return $respose;
			}
		} else {
			$query = $this->set($data)->where(['post_cat_id' => $post_cat_id])->update();
			if ($query) {
				$respose = array(
					'status' => 'success',
				);
				$session->setFlashdata($respose);
				return $respose;
			} else {
				$respose = array(
					'status' => 'failed',
					'message' => $this->error(),
				);
				$session->setFlashdata($respose);
				return $respose;
			}
		}
	}
	public function checkSlugDuplicacy($slug)
	{
		$data = $this->where(['post_cat_slug' => $slug])->countAll();

		if ($data > 0) {
			$slug2 = $slug . '-' . $data;
			return $slug2;
		} else {
			return $slug;
		}
	}
	public function deleteCategory($post_cat_id) {
		return $this->delete($post_cat_id);
	}
}
