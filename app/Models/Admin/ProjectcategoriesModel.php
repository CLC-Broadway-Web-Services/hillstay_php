<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use App\Models\Globals\FunctionsModel;

class ProjectcategoriesModel extends Model
{
	protected $table = 'project_category';
	protected $primaryKey = 'cat_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'cat_name',
		'cat_slug',
	];
	protected $createdField  = 'cat_created_at';
	protected $updatedField  = 'cat_updated_at';

	public function getCategoryNamebyID($cat_id) {
		return $this->select('cat_name')->find($cat_id);
	}
	public function getAllCategoriesAdmin()
	{
		return $this->orderBy('cat_id', 'desc')->findAll();
	}
	public function getCategoryByID($cat_id)
	{
		return $this->find($cat_id);
	}
	public function addEditCategory($category)
	{
		$session = session();
		helper('form');
		$cat_id = intval($category['cat_id']);
		$slugify = new FunctionsModel();
		$data = [
			'cat_name' => $category['cat_name'],
		];
		if ($cat_id == 0) {
			$slug = $slugify->slugify($category['cat_name']);
			$correctSlug = $this->checkSlugDuplicacy($slug);
			$data['cat_slug'] = esc($correctSlug);
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
			$query = $this->set($data)->where(['cat_id' => $cat_id])->update();
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
		$data = $this->where(['cat_slug' => $slug])->countAll();

		if ($data > 0) {
			$slug2 = $slug . '-' . $data;
			return $slug2;
		} else {
			return $slug;
		}
	}
	public function deleteCategory($cat_id)
	{
		return $this->delete($cat_id);
	}
}
