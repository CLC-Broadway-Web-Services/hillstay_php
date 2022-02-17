<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ProjectcategoriesModel;
use App\Models\Admin\ProjectsModel;

class Projects extends BaseController
{
    public function index()
    {
        $projectDB = new ProjectsModel();
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        $projects = $projectDB->select('project_id, project_name, project_category, project_tags, project_status, project_home_view, project_created_at, project_updated_at')->orderBy('project_id', 'desc')->findAll();

        for ($index = 0; $index < count($projects); $index++) {
            $catDB = new ProjectcategoriesModel();
            $category = $catDB->find($projects[$index]['project_category']);
            $projects[$index]['project_category_name'] = $category['cat_name'];
        }
        $data['projects'] = $projects;

        $data['sessionData'] = session()->getFlashData('serviceStatusMessage');
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';
        // return print_r($data);

        return view('Administrator/Dashboard/projects/projects', $data);
    }
    public function categories($cat_id = 0)
    {
        $data = array();

        $catDb = new ProjectcategoriesModel();
        $data['categories'] = $catDb->getAllCategoriesAdmin();

        if ($cat_id == 0) {
            $catData = [
                'cat_id' => 0,
                'cat_name' => '',
                'cat_slug' => '',
            ];
            $data['catData'] = $catData;
        } else {
            $category = $catDb->getCategoryByID($cat_id);
            $catData = [
                'cat_id' => $category['cat_id'],
                'cat_name' => $category['cat_name'],
                'cat_slug' => $category['cat_slug'],
            ];
            $data['catData'] = $catData;
        }

        // add edit category request
        if ($this->request->getMethod() == 'post') {
            $thisData = [
                'cat_id' => $cat_id,
                'cat_name' => $this->request->getPost('cat_name'),
            ];

            if ($cat_id == 0) {
                $query = $catDb->addEditCategory($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/project/categories');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/project/categories');
                }
            } else {
                $query = $catDb->addEditCategory($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/project/categories');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/project/categories/' . $cat_id);
                }
            }
        }
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/projects/projectcategories', $data);
    }
    public function categoriesDelete($cat_id)
    {
        $projectDB = new ProjectsModel();
        $catDb = new ProjectcategoriesModel();
        $projects = $projectDB->where(['project_category' => $cat_id])->findAll();

        if ($projects != null) {
            $data['errorMessage'] = 'Please remove all Projects from this category or change category from those Projects, before deleting this category';
        } else {
            $deleting = $catDb->deleteCategory($cat_id);
        }
        return redirect()->to('/administrator/project/categories');
    }
    public function addEditProject($project_id = 0)
    {
        $data = array();
        helper('form', 'file');

        $projectDB = new ProjectsModel();
        $catDb = new ProjectcategoriesModel();

        if ($project_id == 0) {
            $projectData = [
                'project_id' => 0,
                'project_name' => '',
                'project_summary' => '',
                'project_image' => '',
                'project_description' => '',
                'project_page_data' => '',
                'project_category' => '',
                'project_tags' => '',
                'project_status' => '',
                'project_home_view' => 0,
            ];
            $data['projectData'] = $projectData;
        } else {
            $project = $projectDB->getProjectByID($project_id);
            $projectData = [
                'project_id' => $project['project_id'],
                'project_name' => $project['project_name'],
                'project_summary' => $project['project_summary'],
                'project_image' => $project['project_image'],
                'project_description' => $project['project_description'],
                'project_page_data' => $project['project_page_data'],
                'project_category' => intval($project['project_category']),
                'project_tags' => $project['project_tags'],
                'project_status' => intval($project['project_status']),
                'project_home_view' => intval($project['project_home_view']),
            ];
            $data['projectData'] = $projectData;
        }

        // add edit post request
        if ($this->request->getMethod() == 'post') {
            $thisData = [
                'project_id' => $project_id,
                'project_name' => $this->request->getPost('project_name', FILTER_SANITIZE_STRING),
                'project_summary' => $this->request->getPost('project_summary', FILTER_SANITIZE_STRING),
                'project_description' => esc($this->request->getPost('project_description')),
                'project_page_data' => esc($this->request->getPost('project_page_data')),
                'project_category' => $this->request->getPost('project_category', FILTER_SANITIZE_NUMBER_INT),
                'project_tags' => $this->request->getPost('project_tags', FILTER_SANITIZE_STRING),
                'project_status' => $this->request->getPost('project_status', FILTER_SANITIZE_NUMBER_INT),
                'project_home_view' => $this->request->getPost('project_home_view', FILTER_SANITIZE_NUMBER_INT),
            ];

            if ($this->request->getFile('project_image')) {
                $img = $this->request->getFile('project_image');
                $imagePath = $this->uploadProjectImages($img);
                if ($imagePath) {
                    $thisData['project_image'] = $imagePath;
                }
            }

            if ($project_id == 0) {
                $query = $projectDB->addEditProject($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/projects');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/project/add');
                }
            } else {
                $query = $projectDB->addEditProject($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/projects');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/project/edit/' . $project_id);
                }
            }
        }

        // return print_r($projectData);

        $data['categories'] = $catDb->getAllCategoriesAdmin();
        $data['pageCSS'] = '<link rel="stylesheet" href="/public/dashboard/assets/css/editors/tinymce.css?ver=2.2.0">
        <link rel="stylesheet" href="/public/custom/assets/css/tagsInput.css">';

        $data['pageJS'] = '<script src="/public/dashboard/assets/js/libs/editors/tinymce.js?ver=2.2.0"></script>
        <script src="/public/dashboard/assets/js/editors.js?ver=2.2.0"></script>
        <script src="/public/custom/assets/js/tagsInput.js"></script>
        <script src="/public/custom/assets/js/adminAddEditProject.js"></script>';

        return view('Administrator/Dashboard/projects/addeditproject', $data);
    }
    public function statusChange($service_id)
    {
        $projectDB = new ProjectsModel();
        $query = $projectDB->changeStatus($service_id);
        if ($query['status'] == 'success') {
            return redirect()->to('/administrator/projects');
        } else {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
            return redirect()->to('/administrator/projects');
        }
    }
    public function homeStatusChange($service_id)
    {
        $projectDB = new ProjectsModel();
        $query = $projectDB->changeHomeStatus($service_id);
        if ($query['status'] == 'success') {
            return redirect()->to('/administrator/projects');
        } else {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
            return redirect()->to('/administrator/projects');
        }
    }
    private function uploadProjectImages($file)
    {
        $img = $file;
        if ($img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $imageLocation = 'projectImages/' . date('dMY');
            $img->move($imageLocation, $newName);
            return '/' . $imageLocation . '/' . $newName;
        }
        return false;
    }
}
