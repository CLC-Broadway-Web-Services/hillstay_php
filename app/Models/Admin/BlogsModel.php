<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use App\Models\Globals\FunctionsModel;

class BlogsModel extends Model
{
	protected $table = 'blogs';
	protected $primaryKey = 'post_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'post_title',
		'post_slug',
		'post_summary',
		'post_image',
		'post_description',
		'post_category',
		'post_tags',
		'post_status',
		'post_home_view',
	];
    protected $useTimestamps = true;
	protected $createdField  = 'post_created_at';
	protected $updatedField  = 'post_updated_at';
	public function getPostByID($post_id)
	{
		return $this->find($post_id);
	}
	public function getAllPostsFrontend()
	{
		$catDB = new BlogcategoryModel();
		$posts = $this->select('post_id, post_title, post_slug, post_image, post_category, post_tags, post_summary')->where('post_status', 1)->paginate(9);

		for($index = 0; $index < count($posts); $index++) {
			$posts[$index]['category_name'] = $catDB->getCategoryNamebyID($posts[$index]['post_category'])['post_cat_name'];
		}
        $data = [
            'posts' => $posts,
            'pager' => $this->pager,
        ];
		return $data;
	}
    public function getSinglePost($slug = null)
    {
        if($slug != null) {
			$catDB = new BlogcategoryModel();
			$post = $this->where('post_slug', $slug)->first();
			$post['category_name'] = $catDB->getCategoryNamebyID($post['post_category'])['post_cat_name'];
            return $post;
        }
        return false;
    }
	public function addEditPost($post)
	{
		$session = session();
		helper('form');
		$post_id = intval($post['post_id']);
		$slugify = new FunctionsModel();
		$data = [
			'post_title' => $post['post_title'],
			'post_summary' => $post['post_summary'],
			// 'post_image' => $post['post_image'],
			'post_description' => $post['post_description'],
			'post_category' => intval($post['post_category']),
			'post_tags' => $post['post_tags'],
			'post_status' => intval($post['post_status']),
			'post_home_view' => intval($post['post_home_view']),
		];

        if(!empty($post['post_image'])) {
			$data['post_image'] = $post['post_image'];
        }
		if ($post_id == 0) {
			$slug = $slugify->slugify($post['post_title']);
			$correctSlug = $this->checkSlugDuplicacy($slug);
			$data['post_slug'] = esc($correctSlug);
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
			$query = $this->set($data)->where(['post_id' => $post_id])->update();
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
	public function statusChange($post_id)
	{
		$post = $this->where(['post_id' => $post_id])->first();
		if ($post != null) {
			if ($post['post_status'] == 1) {
				$query = $this->set(['post_status' => 0])->where(['post_id' => $post_id])->update();
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
				$query = $this->set(['post_status' => 1])->where(['post_id' => $post_id])->update();
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
	public function changeHomeStatus($post_id)
	{
		$post = $this->where(['post_id' => $post_id])->first();
		if ($post != null) {
			if ($post['post_home_view'] == 1) {
				$query = $this->set(['post_home_view' => 0])->where(['post_id' => $post_id])->update();
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
				$query = $this->set(['post_home_view' => 1])->where(['post_id' => $post_id])->update();
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
		$data = $this->where(['post_slug' => $slug])->countAll();

		if ($data > 0) {
			$slug2 = $slug . '-' . $data;
			return $slug2;
		} else {
			return $slug;
		}
	}
}
