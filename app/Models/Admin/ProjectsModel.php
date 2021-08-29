<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use App\Models\Globals\FunctionsModel;

class ProjectsModel extends Model
{
	protected $table = 'projects';
	protected $primaryKey = 'project_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'project_name',
		'project_slug',
		'project_summary',
		'project_image',
		'project_description',
		'project_category',
		'project_tags',
		'project_page_data',
		'project_status',
		'project_home_view',
	];
	protected $useTimestamps = true;
	protected $createdField  = 'project_created_at';
	protected $updatedField  = 'project_updated_at';

	public function getProjectByID($project_id)
	{
		return $this->find($project_id);
	}
	public function getAllProjectsFrontend()
	{
		$catDB = new ProjectcategoriesModel();
		$projects = $this->select('project_id, project_name, project_slug, project_summary, project_image, project_category')->where('project_status', 1)->paginate(9);

		for($index = 0; $index < count($projects); $index++) {
			$projects[$index]['category_name'] = $catDB->getCategoryNamebyID($projects[$index]['project_category'])['cat_name'];
		}
        $data = [
            'projects' => $projects,
            'pager' => $this->pager,
        ];
		return $data;
	}
    public function getSingleProject($slug = null)
    {
        if($slug != null) {
			$catDB = new ProjectcategoriesModel();
			$project = $this->where('project_slug', $slug)->first();
			$project['category_name'] = $catDB->getCategoryNamebyID($project['project_category'])['cat_name'];
            return $project;
        }
        return false;
    }
	public function addEditProject($project)
	{
		$session = session();
		helper('form');
		$project_id = intval($project['project_id']);
		$slugify = new FunctionsModel();
		$data = [
			'project_name' => $project['project_name'],
			'project_summary' => $project['project_summary'],
			// 'project_image' => $project['project_image'],
			'project_description' => $project['project_description'],
			'project_category' => intval($project['project_category']),
			'project_tags' => $project['project_tags'],
			'project_status' => intval($project['project_status']),
			'project_home_view' => intval($project['project_home_view']),
		];

		if (!empty($project['project_image'])) {
			$data['project_image'] = $project['project_image'];
		}
		if ($project_id == 0) {
			$slug = $slugify->slugify($project['project_name']);
			$correctSlug = $this->checkSlugDuplicacy($slug);
			$data['project_slug'] = esc($correctSlug);
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
			$query = $this->set($data)->where(['project_id' => $project_id])->update();
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
	public function changeStatus($project_id)
	{
		$project = $this->where(['project_id' => $project_id])->first();
		if ($project != null) {
			if ($project['project_status'] == 1) {
				$query = $this->set(['project_status' => 0])->where(['project_id' => $project_id])->update();
				if ($query) {
					$respose = array(
						'status' => 'success',
					);
					return $respose;
				} else {
					$respose = array(
						'status' => 'failed',
						'message' => $this->error(),
					);
					return $respose;
				}
			} else {
				$query = $this->set(['project_status' => 1])->where(['project_id' => $project_id])->update();
				if ($query) {
					$respose = array(
						'status' => 'success',
					);
					return $respose;
				} else {
					$respose = array(
						'status' => 'failed',
						'message' => 'Failed to change status, please contact support.',
					);
					return $respose;
				}
			}
		} else {
			$respose = array(
				'status' => 'failed',
				'message' => 'No faq found for this request.',
			);
			return $respose;
		}
	}
	public function changeHomeStatus($project_id)
	{
		$project = $this->where(['project_id' => $project_id])->first();
		if ($project != null) {
			if ($project['project_home_view'] == 1) {
				$query = $this->set(['project_home_view' => 0])->where(['project_id' => $project_id])->update();
				if ($query) {
					$respose = array(
						'status' => 'success',
					);
					return $respose;
				} else {
					$respose = array(
						'status' => 'failed',
						'message' => $this->error(),
					);
					return $respose;
				}
			} else {
				$query = $this->set(['project_home_view' => 1])->where(['project_id' => $project_id])->update();
				if ($query) {
					$respose = array(
						'status' => 'success',
					);
					return $respose;
				} else {
					$respose = array(
						'status' => 'failed',
						'message' => $this->error(),
					);
					return $respose;
				}
			}
		} else {
			$respose = array(
				'status' => 'failed',
				'message' => 'No service found for this request.',
			);
			return $respose;
		}
	}
	public function checkSlugDuplicacy($slug)
	{
		$data = $this->where(['project_slug' => $slug])->countAll();

		if ($data > 0) {
			$slug2 = $slug . '-' . $data;
			return $slug2;
		} else {
			return $slug;
		}
	}
}
