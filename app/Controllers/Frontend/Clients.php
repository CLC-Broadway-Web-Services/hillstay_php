<?php

namespace App\Controllers\Frontend;

use App\Models\Admin\ProjectsModel;
use CodeIgniter\Controller;

class Clients extends Controller
{
	public function index()
	{
		$projectsDB = new ProjectsModel();
		// $projects = $projectsDB->getAllProjectsFrontend();

        $data = [
            'projects' => $projectsDB->getAllProjectsFrontend()['projects'],
            'pager' => $projectsDB->getAllProjectsFrontend()['pager'],
        ];

		// return print_r($projects);

		// $data['pageCSS'] = '<link rel="stylesheet" href="/public/libraries/splide/dist/css/splide.min.css">';

		// $data['pageJSbefore'] = '<script src="/public/libraries/splide/dist/js/splide.min.js"></script>';

		// $data['pageJS'] = '<script src="/public/assets/js/counter.init.js"></script>
		// <script src="/public/custom/assets/js/homepage2.js"></script>';

		return view('Frontend/clients/index', $data);
	}
	public function single($slug = '')
	{
        if($slug == null) {
            return redirect()->to(route_to('clients_page'));
        }
		$projectsDB = new ProjectsModel();
		$project = $projectsDB->getSingleProject($slug);
		$data['project'] = $project;
		$nextProject = $projectsDB->select('project_slug')->where('project_id >', $project['project_id'])->findAll(1);
		$previousProject = $projectsDB->select('project_slug')->where('project_id <', $project['project_id'])->findAll(1);

		if($previousProject) {
			$data['previousProject'] = $previousProject[0];
		}
		if($nextProject) {
			$data['nextProject'] = $nextProject[0];
		}

		// return print_r($data);

		// $data['pageCSS'] = '<link rel="stylesheet" href="/public/libraries/splide/dist/css/splide.min.css">';

		// $data['pageJSbefore'] = '<script src="/public/libraries/splide/dist/js/splide.min.js"></script>';

		// $data['pageJS'] = '<script src="/public/assets/js/counter.init.js"></script>
		// <script src="/public/custom/assets/js/homepage2.js"></script>';

		return view('Frontend/clients/single', $data);
	}

}
