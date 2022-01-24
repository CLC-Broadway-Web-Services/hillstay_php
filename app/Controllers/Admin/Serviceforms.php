<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ServiceformModel;
use App\Models\Admin\ServicesModel;

class Serviceforms extends BaseController
{
    public function index()
    {
        $formsMD = new ServiceformModel();
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        $data['allforms'] = $formsMD->getAllForms();
        $data['sessionData'] = session()->getFlashData('serviceStatusMessage');
        // $data['pageCSS'] = '';
        $data['pageJS'] = '<script src="/public/custom/assets/js/formsTable.js"></script>';

        return view('Administrator/Dashboard/services/forms/forms', $data);
    }
    public function addEditForm($formid = 0)
    {
        $formsMD = new ServiceformModel();
        $serviceDB = new ServicesModel();
        $data = array();
        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        helper('form');

        $data['allServices'] = $serviceDB->getAllServicesNameAndIDOnly();

        if ($formid == 0) {
            $formData = [
                'form_id' => 0,
                'service_id' => 0,
                'form_heading' => '',
                'sort_number' => 0,
                'form_fields' => '',
                'form_status' => 0,
            ];
            $data['formData'] = $formData;
        } else {
            $form = $formsMD->getFormbyId($formid);
            $formData = [
                'form_id' => intval($form['form_id']),
                'service_id' => intval($form['service_id']),
                'form_heading' => $form['form_heading'],
                'sort_number' => intval($form['sort_number']),
                'form_fields' => json_decode($form['form_fields']),
                'form_status' => intval($form['form_status']),
            ];
            $data['formData'] = $formData;
        }

        // add edit post request
        if ($this->request->getMethod() == 'post') {
            $thisData = [
                'form_id' => $formid,
                'service_id' => $this->request->getPost('service_id', FILTER_SANITIZE_NUMBER_INT),
                'form_heading' => $this->request->getPost('form_heading'),
                'sort_number' => $this->request->getPost('sort_number', FILTER_SANITIZE_NUMBER_INT),
                'form_fields' => json_encode($this->request->getPost('form_fields')),
                'form_status' => $this->request->getPost('form_status', FILTER_SANITIZE_NUMBER_INT),
            ];

            // return print_r($thisData);
            // die();

            if ($formid == 0) {
                $query = $formsMD->addEditForm($thisData);
                return json_encode($query);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/service/forms');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/service/forms/add');
                }
            } else {
                $query = $formsMD->addEditForm($thisData);
                return json_encode($query, $formid);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/service/forms');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/service/forms/edit/' . $formid);
                }
            }
        }


        $data['pageJS'] = '<script src="/public/dashboard/assets/js/libs/jquery.validate.min.js"></script>
        <script src="/public/custom/assets/js/adminServiceFormDynamicFields.js"></script>';
        $data['pageCSS'] = '';

        return view('Administrator/Dashboard/services/forms/addEditForm', $data);
    }
    public function formStatusChange($form_id)
    {
        $formsMD = new ServiceformModel();
        $query = $formsMD->changeStatus($form_id);
        if ($query['status'] == 'success') {
            return redirect()->to('/administrator/service/forms');
        } else {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
            return redirect()->to('/administrator/service/forms');
        }
    }
}
