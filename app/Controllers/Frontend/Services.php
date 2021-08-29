<?php

namespace App\Controllers\Frontend;

use CodeIgniter\Controller;
use App\Models\Globals\FrontservicesModel;

class Services extends Controller
{
    public function singleService($slug = null)
    {
        helper('number');
        if ($slug == null) {
            return redirect()->to(base_url());
        }
        $serviceDB = new FrontservicesModel();
        $service = $serviceDB->getSingleServiceBySlug($slug);
        // return print_r($service);

        $data['service'] = $service;

        $data['pageJS'] = '<script src="/public/custom/assets/js/frontSingleService.js"></script>';

        return view('Frontend/pages/singleService', $data);
    }

    public function singleServicePackages($slug = null)
    {
        helper('number');
        if ($slug == null) {
            return redirect()->to(base_url());
        }
        $serviceDB = new FrontservicesModel();
        $service = $serviceDB->getSingleServiceBySlug($slug);
        // return print_r($service);

        $data['service'] = $service;
        // return print_r($data);

        $data['pageJS'] = '<script src="/public/custom/assets/js/frontSingleService.js"></script>';

        return view('Frontend/pages/singleServicePackages', $data);
    }
    public function serviceSelectedPackage($service_slug = null, $package_id)
    {
        if ($service_slug == null) {
            return redirect()->to(base_url());
        }
        $serviceDB = new FrontservicesModel();
        $service = $serviceDB->getSingleServiceOnlyBySlug($service_slug);
        $package = $serviceDB->getPackagebyID($package_id);
        $forms = $serviceDB->getFormsByServiceID($service['service_id']);
        // return print_r($service);
        $data['service'] = $service;
        $data['package'] = $package;
        $data['forms'] = $forms;
        // return print_r($data);

        $data['pageJS'] = '<script src="/public/custom/assets/js/frontSingleService.js"></script>';

        return view('Frontend/pages/selectedPackage', $data);
    }
}
