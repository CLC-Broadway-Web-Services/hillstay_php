<?php

namespace App\Models\Globals;

use CodeIgniter\Model;
use App\Models\Admin\ServicepackagesModel;
use App\Models\Admin\ServicerequiredocsModel;
use App\Models\Admin\ServicefaqsModel;
use App\Models\Admin\ServiceformModel;

class FrontservicesModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'service_id'; //service_packages
    protected $returnType     = 'array';
    protected $allowedFields = [];
    protected $createdField  = 'service_created_at';
    protected $updatedField  = 'service_updated_at';

    public function getAllHomepageServices()
    {
        $packageDB = new ServicepackagesModel();

        $services = $this->where(['service_status' => 1, 'service_home_view' => 1])->findAll();
        $i = 0;
        for ($i; $i < count($services); $i++) {
            $price = $packageDB->select('package_price')->where(['service_id' => $services[$i]['service_id']])->orderBy('package_price', 'asc')->first();
            $services[$i]['service_starts_at'] = $price['package_price'];
        }
        return $services;
    }
    public function getSingleServiceBySlug($slug)
    {
        $packagesDB = new ServicepackagesModel();
        $docsDb = new ServicerequiredocsModel();
        $faqsDb = new ServicefaqsModel();

        $service = $this->where(['service_slug' => $slug])->first();
        $packages = $packagesDB->where(['service_id' => $service['service_id'], 'package_status' => 1])->findAll();
        $docs = $docsDb->where(['service_id' => $service['service_id'], 'document_status' => 1])->findAll();
        $faqs = $faqsDb->where(['service_id' => $service['service_id'], 'faq_status' => 1])->findAll();

        $service['packages'] = $packages;
        $service['docs'] = $docs;
        $service['faqs'] = $faqs;

        return $service;
    }
    public function getSingleServiceOnlyBySlug($slug)
    {
        $service = $this->where(['service_slug' => $slug])->first();
        return $service;
    }
    public function getPackagebyID($package_id)
    {
        $packageMD = new ServicepackagesModel();
        $package = $packageMD->find($package_id);
        return $package;
    }
    public function getFormsByServiceID($service_id)
    {
        $formsMD = new ServiceformModel();
        $forms = $formsMD->where(['service_id' => $service_id, 'form_status' => 1])->findAll();

        if (count($forms) > 0) {
            foreach ($forms as $key => $form) {
                $forms[$key]['form_fields'] = json_decode($form['form_fields']);
            }
        }
        return $forms;
    }
}
