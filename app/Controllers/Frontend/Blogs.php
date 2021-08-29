<?php

namespace App\Controllers\Frontend;

use App\Models\Admin\BlogsModel;
use CodeIgniter\Controller;

use App\Models\Admin\TestimonialsModel;

class Blogs extends Controller
{
	public function index()
	{
		// $testimonialsDB = new TestimonialsModel();
		// $data['testimonials'] = $testimonialsDB->getAllTestimonialsFront();

		$blogDB = new BlogsModel();
		// $projects = $projectsDB->getAllProjectsFrontend();

        $data = [
            'posts' => $blogDB->getAllPostsFrontend()['posts'],
            'pager' => $blogDB->getAllPostsFrontend()['pager'],
        ];
		// return print_r($data);

		// $data['pageCSS'] = '<link rel="stylesheet" href="/public/libraries/splide/dist/css/splide.min.css">';

		// $data['pageJSbefore'] = '<script src="/public/libraries/splide/dist/js/splide.min.js"></script>';

		// $data['pageJS'] = '<script src="/public/assets/js/counter.init.js"></script>
		// <script src="/public/custom/assets/js/homepage2.js"></script>';

		return view('Frontend/blogs/index', $data);
	}
	public function single($slug = '')
	{
        if($slug == null) {
            return redirect()->to(route_to('clients_page'));
        }
		$blogDB = new BlogsModel();
		$post = $blogDB->getSinglePost($slug);
		$data['post'] = $post;
		$nextPost = $blogDB->select('post_slug')->where('post_id >', $post['post_id'])->findAll(1);
		$previousPost = $blogDB->select('post_slug')->where('post_id <', $post['post_id'])->findAll(1);

		if($previousPost) {
			$data['previousPost'] = $previousPost[0];
		}
		if($nextPost) {
			$data['nextPost'] = $nextPost[0];
		}

		// return print_r($data);

		// $data['pageCSS'] = '<link rel="stylesheet" href="/public/libraries/splide/dist/css/splide.min.css">';

		// $data['pageJSbefore'] = '<script src="/public/libraries/splide/dist/js/splide.min.js"></script>';

		// $data['pageJS'] = '<script src="/public/assets/js/counter.init.js"></script>
		// <script src="/public/custom/assets/js/homepage2.js"></script>';

		return view('Frontend/blogs/single', $data);
	}

}
