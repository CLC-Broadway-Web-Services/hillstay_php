<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\BlogcategoryModel;
use App\Models\Admin\BlogsModel;

class Blogs extends BaseController
{
    public function index()
    {
        $blogDB = new BlogsModel();
        $catDB = new BlogcategoryModel();
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        $posts = $blogDB->select('post_id, post_title, post_category, post_tags, post_status, post_home_view, post_created_at, post_updated_at')->orderBy('post_id', 'desc')->findAll();

        for($index = 0; $index < count($posts); $index++) {
            $category = $catDB->find($posts[$index]['post_category']);
            $posts[$index]['post_category_name'] = $category['post_cat_name'];
        }
        $data['posts'] = $posts;
        // return print_r($posts);

        $data['sessionData'] = session()->getFlashData('serviceStatusMessage');
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/blogs/blogs', $data);
    }
    public function addEditBlogPost($post_id = 0)
    {
        $data = array();
        helper('form', 'file');

        $blogDB = new BlogsModel();
        $catDB = new BlogcategoryModel();

        if ($post_id == 0) {

            $postData = [
                'post_id' => 0,
                'post_title' => '',
                'post_summary' => '',
                'post_image' => '',
                'post_description' => '',
                'post_category' => '',
                'post_tags' => '',
                'post_status' => '',
                'post_home_view' => 0,
            ];

            $data['postData'] = $postData;

        } else {

            $post = $blogDB->getPostByID($post_id);

            $postData = [
                'post_id' => $post['post_id'],
                'post_title' => $post['post_title'],
                'post_summary' => $post['post_summary'],
                'post_image' => $post['post_image'],
                'post_description' => $post['post_description'],
                'post_category' => intval($post['post_category']),
                'post_tags' => $post['post_tags'],
                'post_status' => intval($post['post_status']),
                'post_home_view' => intval($post['post_home_view']),
            ];

            $data['postData'] = $postData;

        }

        // add edit post request
        if ($this->request->getMethod() == 'post') {

            $thisData = [
                'post_id' => $post_id,
                'post_title' => $this->request->getPost('post_title', FILTER_SANITIZE_STRING),
                'post_summary' => $this->request->getPost('post_summary', FILTER_SANITIZE_STRING),
                'post_description' => esc($this->request->getPost('post_description')),
                'post_category' => $this->request->getPost('post_category', FILTER_SANITIZE_NUMBER_INT),
                'post_tags' => $this->request->getPost('post_tags', FILTER_SANITIZE_STRING),
                'post_status' => $this->request->getPost('post_status', FILTER_SANITIZE_NUMBER_INT),
                'post_home_view' => $this->request->getPost('post_home_view', FILTER_SANITIZE_NUMBER_INT),
            ];

			if ($this->request->getFile('post_image')) {
				$img = $this->request->getFile('post_image');
				$imagePath = $this->uploadBlogImages($img);
				if ($imagePath) {
					$thisData['post_image'] = $imagePath;
				}
            }

            if ($post_id == 0) {
                $query = $blogDB->addEditPost($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/blogs');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/blog/add');
                }
            } else {
                $query = $blogDB->addEditPost($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/blogs');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/blog/edit/' . $post_id);
                }
            }

        }

        // return print_r($postData);

        $data['categories'] = $catDB->getAllCategoriesAdmin();
        $data['pageCSS'] = '<link rel="stylesheet" href="/public/dashboard/assets/css/editors/tinymce.css?ver=2.2.0">
        <link rel="stylesheet" href="/public/custom/assets/css/tagsInput.css">';

        $data['pageJS'] = '<script src="/public/dashboard/assets/js/libs/editors/tinymce.js?ver=2.2.0"></script>
        <script src="/public/dashboard/assets/js/editors.js?ver=2.2.0"></script>
        <script src="/public/custom/assets/js/tagsInput.js"></script>
        <script src="/public/custom/assets/js/adminAddEditBlog.js"></script>';

        return view('Administrator/Dashboard/blogs/addeditblog', $data);
    }
    public function postStatusChange($postid)
    {
        $blogsDB = new BlogsModel();
        $query = $blogsDB->statusChange($postid);
        if ($query['status'] != 'success') {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
        }
        return redirect()->to('/administrator/blogs');
    }
    public function postHomeStatusChange($postid)
    {
        $blogsDB = new BlogsModel();
        $query = $blogsDB->changeHomeStatus($postid);
        if ($query['status'] != 'success') {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
        }
        return redirect()->to('/administrator/blogs');
    }
    public function categories($post_cat_id = 0)
    {
        $data = array();

        $catDB = new BlogcategoryModel();
        $data['categories'] = $catDB->getAllCategoriesAdmin();

        if ($post_cat_id == 0) {
            $catData = [
                'post_cat_id' => 0,
                'post_cat_name' => '',
                'post_cat_slug' => '',
            ];
            $data['catData'] = $catData;
        } else {
            $category = $catDB->getCategoryByID($post_cat_id);
            $catData = [
                'post_cat_id' => $category['post_cat_id'],
                'post_cat_name' => $category['post_cat_name'],
                'post_cat_slug' => $category['post_cat_slug'],
            ];
            $data['catData'] = $catData;
        }

        // add edit category request
        if ($this->request->getMethod() == 'post') {
            $thisData = [
                'post_cat_id' => $post_cat_id,
                'post_cat_name' => $this->request->getPost('post_cat_name'),
            ];

            if ($post_cat_id == 0) {
                $query = $catDB->addEditCategory($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/blog/categories');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/blog/categories');
                }
            } else {
                $query = $catDB->addEditCategory($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/blog/categories');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/blog/categories/' . $post_cat_id);
                }
            }
        }
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/blogs/blogcategories', $data);
    }
    public function categoriesDelete($post_cat_id)
    {
        $blogDB = new BlogsModel();
        $catDb = new BlogcategoryModel();
        $blogs = $blogDB->where(['post_category' => $post_cat_id])->findAll();

        if ($blogs != null) {
            $data['errorMessage'] = 'Please remove all blogs from this category or change category from those blogs, before deleting this category';
        } else {
            $deleting = $catDb->deleteCategory($post_cat_id);
        }
        return redirect()->to('/administrator/blog/categories');
    }
    public function comments()
    {
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/dashboard', $data);
    }

    private function uploadBlogImages($file)
    {
		$img = $file;
		if ($img->isValid() && !$img->hasMoved()) {
			$newName = $img->getRandomName();
			$imageLocation = 'blogImages/' . date('dMY');
			$img->move($imageLocation,$newName);
			return '/'.$imageLocation.'/'.$newName;
		}
		return false;
    }
}
