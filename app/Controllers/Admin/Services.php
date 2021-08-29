<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ServicesModel;
use App\Models\Admin\ServicerequiredocsModel;
use App\Models\Admin\ServicefaqsModel;
use App\Models\Admin\ServicepackagesModel;

class Services extends BaseController
{
    public function index()
    {
        $serviceDB = new ServicesModel();
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        $data['services'] = $serviceDB->allServicesinAdmin();
        $data['sessionData'] = session()->getFlashData('serviceStatusMessage');
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        $data['pageCSS'] = '<link href="/public/assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />';
        return view('Administrator/Dashboard/services/services', $data);
    }
    public function addEditService($serviceid = 0)
    {
        $serviceDB = new ServicesModel();
        $data = array();

        $icons = file_get_contents('./public/custom/assets/js/icons.json');
        $iconsDecoded = json_decode($icons);
        $iconsArray = array($iconsDecoded);

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        helper('form', 'file');

        if ($serviceid == 0) {
            $serviceData = [
                'service_id' => 0,
                'service_title' => '',
                'service_slug' => '',
                'service_summary' => '',
                'service_overview' => '',
                'service_icon' => '',
                'service_status' => 0,
                'service_home_view' => 0,
            ];
            $data['serviceData'] = $serviceData;
        } else {
            $service = $serviceDB->getServiceByID($serviceid);
            $serviceData = [
                'service_id' => $service['service_id'],
                'service_title' => $service['service_title'],
                'service_slug' => $service['service_slug'],
                'service_summary' => $service['service_summary'],
                'service_overview' => $service['service_overview'],
                'service_icon' => $service['service_icon'],
                'service_status' => intval($service['service_status']),
                'service_home_view' => intval($service['service_home_view']),
            ];
            $data['serviceData'] = $serviceData;
        }

        if ($this->request->getMethod() == 'post') {
            $thisData = [
                'service_id' => $serviceid,
                'service_title' => $this->request->getPost('service_title'),
                'service_summary' => $this->request->getPost('service_summary'),
                'service_overview' => $this->request->getPost('service_overview'),
                'service_icon' => $this->request->getPost('service_icon'),
                'service_status' => $this->request->getPost('service_status', FILTER_SANITIZE_NUMBER_FLOAT),
                'service_home_view' => $this->request->getPost('service_home_view', FILTER_SANITIZE_NUMBER_FLOAT),
            ];

            if ($serviceid == 0) {
                $query = $serviceDB->addEditService($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/services');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/service/add');
                }
            } else {
                $query = $serviceDB->addEditService($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/services');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/service/edit/' . $serviceid);
                }
            }
            // return print_r($query);
        }

        $data['icons'] = $iconsArray[0];

        $data['pageJS'] = '<script src="/public/dashboard/assets/js/libs/editors/tinymce.js?ver=2.2.0"></script>
        <script src="/public/dashboard/assets/js/editors.js?ver=2.2.0"></script>
        <script src="/public/custom/assets/js/adminAddEditService.js"></script>';

        $data['pageCSS'] = '<link rel="stylesheet" href="/public/dashboard/assets/css/editors/tinymce.css?ver=2.2.0">
        <link href="/public/assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />';

        return view('Administrator/Dashboard/services/addeditservice', $data);
    }
    public function serviceStatusChange($service_id)
    {
        $serviceDB = new ServicesModel();
        $query = $serviceDB->changeStatus($service_id);
        if ($query['status'] == 'success') {
            return redirect()->to('/administrator/services');
        } else {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
            return redirect()->to('/administrator/services');
        }
    }
    public function serviceHomeStatusChange($service_id)
    {
        $serviceDB = new ServicesModel();
        $query = $serviceDB->changeHomeStatus($service_id);
        if ($query['status'] == 'success') {
            return redirect()->to('/administrator/services');
        } else {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
            return redirect()->to('/administrator/services');
        }
    }
    // documents blocks
    public function serviceDocuments()
    {
        $documentsDB = new ServicerequiredocsModel();
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        $data['serviceDocuments'] = $documentsDB->allDocumentsWIthServiceName();
        // print_r($data['serviceDocuments']);
        // die();
        $data['sessionData'] = session()->getFlashData('serviceStatusMessage');
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        // $data['pageCSS'] = '<link href="/public/assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />';
        return view('Administrator/Dashboard/services/serviceDocuments', $data);
    }
    public function addEditServiceDocument($documentid = 0)
    {
        $documentsDB = new ServicerequiredocsModel();
        $serviceDB = new ServicesModel();
        $data = array();
        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        helper('form');

        $data['allServices'] = $serviceDB->getAllServicesNameAndIDOnly();

        if ($documentid == 0) {
            $documentData = [
                'document_id' => 0,
                'service_id' => 0,
                'document_title' => '',
                'document_summary' => '',
                'document_status' => 0,
            ];
            $data['documentData'] = $documentData;
        } else {
            $document = $documentsDB->getDocumentByID($documentid);
            $documentData = [
                'document_id' => $document['document_id'],
                'service_id' => $document['service_id'],
                'document_title' => $document['document_title'],
                'document_summary' => $document['document_summary'],
                'document_status' => intval($document['document_status']),
            ];
            $data['documentData'] = $documentData;
        }

        // add edit post request
        if ($this->request->getMethod() == 'post') {
            // print_r($_POST);
            // die();
            $thisData = [
                'document_id' => $documentid,
                'service_id' => $this->request->getPost('service_id', FILTER_SANITIZE_NUMBER_INT),
                'document_title' => $this->request->getPost('document_title'),
                'document_summary' => $this->request->getPost('document_summary'),
                'document_status' => $this->request->getPost('document_status', FILTER_SANITIZE_NUMBER_INT),
            ];

            if ($documentid == 0) {
                $query = $documentsDB->addEditDocument($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/service/documents');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/service/documents/add');
                }
            } else {
                $query = $documentsDB->addEditDocument($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/service/documents');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/service/documents/edit/' . $documentid);
                }
            }
            // return print_r($query);
        }
        // $data['pageJS'] = '<script src="/public/dashboard/assets/js/libs/editors/tinymce.js?ver=2.2.0"></script>
        // <script src="/public/dashboard/assets/js/editors.js?ver=2.2.0"></script>
        // <script src="/public/custom/assets/js/adminAddEditService.js"></script>';

        // $data['pageCSS'] = '<link rel="stylesheet" href="/public/dashboard/assets/css/editors/tinymce.css?ver=2.2.0">
        // <link href="/public/assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />';

        return view('Administrator/Dashboard/services/addEditServiceDocument', $data);
    }
    public function serviceDocumentStatusChange($documentid)
    {
        $documentsDB = new ServicerequiredocsModel();
        $query = $documentsDB->statusChange($documentid);
        if ($query['status'] == 'success') {
            return redirect()->to('/administrator/service/documents');
        } else {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
            return redirect()->to('/administrator/service/documents');
        }
    }
    // faqs
    public function serviceFaqs()
    {
        $faqsDB = new ServicefaqsModel();
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        $data['serviceFaqs'] = $faqsDB->allFaqsWIthServiceName();
        // print_r($data['serviceDocuments']);
        // die();
        $data['sessionData'] = session()->getFlashData('serviceStatusMessage');
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        // $data['pageCSS'] = '<link href="/public/assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />';
        return view('Administrator/Dashboard/services/serviceFaqs', $data);
    }
    public function addEditServiceFaq($faqid = 0)
    {
        $faqsDB = new ServicefaqsModel();
        $serviceDB = new ServicesModel();
        $data = array();
        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        helper('form');

        $data['allServices'] = $serviceDB->getAllServicesNameAndIDOnly();

        if ($faqid == 0) {
            $faqData = [
                'faq_id' => 0,
                'service_id' => 0,
                'faq_title' => '',
                'faq_content' => '',
                'faq_status' => 0,
            ];
            $data['faqData'] = $faqData;
        } else {
            $faq = $faqsDB->getFaqByID($faqid);
            $faqData = [
                'faq_id' => $faq['faq_id'],
                'service_id' => $faq['service_id'],
                'faq_title' => $faq['faq_title'],
                'faq_content' => $faq['faq_content'],
                'faq_status' => intval($faq['faq_status']),
            ];
            $data['faqData'] = $faqData;
        }

        // add edit post request
        if ($this->request->getMethod() == 'post') {
            $thisData = [
                'faq_id' => $faqid,
                'service_id' => $this->request->getPost('service_id', FILTER_SANITIZE_NUMBER_INT),
                'faq_title' => $this->request->getPost('faq_title'),
                'faq_content' => $this->request->getPost('faq_content'),
                'faq_status' => $this->request->getPost('faq_status', FILTER_SANITIZE_NUMBER_INT),
            ];

            if ($faqid == 0) {
                $query = $faqsDB->addEditFaq($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/service/faqs');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/service/faqs/add');
                }
            } else {
                $query = $faqsDB->addEditFaq($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/service/faqs');
                } else {
                    $data['errorMessage'] = $query['message'];
                    return redirect()->to('/administrator/service/faqs/edit/' . $faqid);
                }
            }
        }

        return view('Administrator/Dashboard/services/addEditServiceFaq', $data);
    }
    public function serviceFaqStatusChange($faqid)
    {
        $faqsDB = new ServicefaqsModel();
        $query = $faqsDB->statusChange($faqid);
        if ($query['status'] != 'success') {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
        }
        return redirect()->to('/administrator/service/faqs');
    }
    // packages
    public function servicePackages()
    {
        $packageDB = new ServicepackagesModel();
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        $data['servicePackages'] = $packageDB->allPackagesWIthServiceName();
        $data['sessionData'] = session()->getFlashData('serviceStatusMessage');
        return view('Administrator/Dashboard/services/servicePackages', $data);
    }
    public function addEditServicePackage($packageid = 0)
    {
        $packageDB = new ServicepackagesModel();
        $serviceDB = new ServicesModel();
        $data = array();
        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        helper('form');

        $data['allServices'] = $serviceDB->getAllServicesNameAndIDOnly();

        if ($packageid == 0) {
            $packageData = [
                'package_id' => 0,
                'service_id' => 0,
                'package_name' => '',
                'package_price' => '',
                'package_details' => '',
                'package_status' => 0,
                'package_isSpecial' => 0,
            ];
            $data['packageData'] = $packageData;
        } else {
            $package = $packageDB->getPackageByID($packageid);
            $packageData = [
                'package_id' => $package['package_id'],
                'service_id' => $package['service_id'],
                'package_name' => $package['package_name'],
                'package_price' => intval($package['package_price']),
                'package_details' => $package['package_details'],
                'package_status' => intval($package['package_status']),
                'package_isSpecial' => intval($package['package_isSpecial']),
            ];
            $data['packageData'] = $packageData;
        }

        // add edit post request
        if ($this->request->getMethod() == 'post') {
            $thisData = [
                'package_id' => $packageid,
                'service_id' => $this->request->getPost('service_id', FILTER_SANITIZE_NUMBER_INT),
                'package_name' => $this->request->getPost('package_name'),
                'package_price' => $this->request->getPost('package_price', FILTER_SANITIZE_NUMBER_INT),
                'package_details' => $this->request->getPost('package_details'),
                'package_status' => $this->request->getPost('package_status', FILTER_SANITIZE_NUMBER_INT),
                'package_isSpecial' => $this->request->getPost('package_isSpecial', FILTER_SANITIZE_NUMBER_INT),
            ];

            // return print_r($thisData);
            // die();

            if ($packageid == 0) {
                $query = $packageDB->addEditPackage($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/service/packages');
                } else {
                    $data['errorMessage'] = $query['message'];
                    // return redirect()->to('/administrator/service/packages/add');
                }
            } else {
                $query = $packageDB->addEditPackage($thisData);
                if ($query['status'] == 'success') {
                    return redirect()->to('/administrator/service/packages');
                } else {
                    $data['errorMessage'] = $query['message'];
                    // return redirect()->to('/administrator/service/packages/edit/' . $packageid);
                }
            }
        }


        $data['pageJS'] = '<script src="/public/dashboard/assets/js/libs/editors/tinymce.js?ver=2.2.0"></script>
        <script src="/public/dashboard/assets/js/editors.js?ver=2.2.0"></script>
        <script src="/public/custom/assets/js/adminAddPackages.js"></script>';

        $data['pageCSS'] = '<link rel="stylesheet" href="/public/dashboard/assets/css/editors/tinymce.css?ver=2.2.0">
        <link href="/public/assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />';

        return view('Administrator/Dashboard/services/addEditServicePackage', $data);
    }
    public function servicePackageStatusChange($packageid)
    {
        $packageDB = new ServicepackagesModel();
        $query = $packageDB->statusChange($packageid);
        if ($query['status'] != 'success') {
            $message = array(
                'serviceStatusMessage' => $query['message']
            );
            session()->setFlashdata($message);
        }
        return redirect()->to('/administrator/service/packages');
    }
    public function queries()
    {
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/dashboard', $data);
    }
    public function testimonials()
    {
        $data = array();

        $admin = session()->get('admin');
        $data['admin'] =  $admin;
        // $data['pageCSS'] = '';
        // $data['pageJS'] = '';

        return view('Administrator/Dashboard/dashboard', $data);
    }
}
