<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ContactsModel;
use App\Models\Admin\TestimonialsModel;

class Others extends BaseController
{
    public function subscribers()
    {
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/dashboard', $data);
    }
    public function contactSubmission()
    {
        $data = array();
        $contactDB = new ContactsModel();
        $data['contacts'] = $contactDB->orderBy('id', 'desc')->findAll();

        // return print_r($data);

        // $admin = session()->get('admin');
        // $data['admin'] =  $admin;
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/others/contacts-all', $data);
    }
    public function testimonials($testimonial_id = 0) {
        $data = array();

        $testimonialDB = new TestimonialsModel();
        $data['testimonials'] = $testimonialDB->getAllTestimonialsAdmin();

        if ($testimonial_id == 0) {
            $testimonialData = [
                'testimonial_id' => 0,
                'testimonials_content' => '',
                'testimonials_name' => '',
                'testimonials_post' => '',
                'testimonials_company' => '',
                'testimonials_status' => 1,
            ];
            $data['testimonialData'] = $testimonialData;
        } else {
            $testimonial = $testimonialDB->getTestimonialByID($testimonial_id);
            $testimonialData = [
                'testimonial_id' => $testimonial['testimonial_id'],
                'testimonials_content' => $testimonial['testimonials_content'],
                'testimonials_name' => $testimonial['testimonials_name'],
                'testimonials_post' => $testimonial['testimonials_post'],
                'testimonials_company' => $testimonial['testimonials_company'],
                'testimonials_status' => $testimonial['testimonials_status'],
            ];
            $data['testimonialData'] = $testimonialData;
        }

        // add edit Testimonial request
        if ($this->request->getMethod() == 'post') {
            $thisData = [
                'testimonial_id' => $testimonial_id,
                'testimonials_content' => $this->request->getPost('testimonials_content'),
                'testimonials_name' => $this->request->getPost('testimonials_name'),
                'testimonials_post' => $this->request->getPost('testimonials_post'),
                'testimonials_company' => $this->request->getPost('testimonials_company'),
                'testimonials_status' => $this->request->getPost('testimonials_status'),
            ];

            if ($testimonial_id == 0) {
                $query = $testimonialDB->addEditTestimonial($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/other/testimonials');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/other/testimonials');
                }
            } else {
                $query = $testimonialDB->addEditTestimonial($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/other/testimonials');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/other/testimonials/' . $testimonial_id);
                }
            }
        }
        // $data['pageCSS'] = '<link rel="stylesheet" href="/public/dashboard/assets/css/editors/tinymce.css?ver=2.2.0">';

        $data['pageJS'] = '<script src="/public/custom/assets/js/addEditTestimonials.js"></script>';

        return view('Administrator/Dashboard/others/testimonials', $data);
    }
    public function testimonialsDelete($testimonial_id)
    {
        $testimonialDB = new TestimonialsModel();

        $testimonialDB->deleteTestimonial($testimonial_id);

        return redirect()->to('/administrator/others/testimonials');
    }
    public function testimonialStatusChange($testimonial_id)
    {
        $testimonialDB = new TestimonialsModel();
        $query = $testimonialDB->changeStatus($testimonial_id);
        if ($query['status'] == 'success') {
            return redirect()->to('/administrator/other/testimonials');
        } else {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
            return redirect()->to('/administrator/other/testimonials');
        }
    }
}
