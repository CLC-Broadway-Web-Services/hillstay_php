<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use App\Models\Globals\FunctionsModel;
use App\Models\Admin\ServicerequiredocsModel;

class ServicesModel extends Model
{
	protected $table = 'services';
	protected $primaryKey = 'service_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'service_title',
		'service_slug',
		'service_summary',
		'service_overview',
		'service_icon',
		'service_status',
		'service_home_view',
	];
	protected $createdField  = 'service_created_at';
	protected $updatedField  = 'service_updated_at';

	public function allServicesinAdmin()
	{
		return $this->findAll();
	}
	public function getServiceByID($serviceid)
	{
		$data = $this->where(['service_id' => $serviceid])->first();
		return $data;
	}
	public function getServiceBySlugFull($serviceslug)
	{
		$docs = new ServicerequiredocsModel();
		$faqs = new ServicefaqsModel();
		$packages = new ServicepackagesModel();
		$service =  $this->where(['service_slug' => $serviceslug])->first();
		$service['docs'] = $docs->getAllDocsBYServiceID($service['service_id']);
		$service['faqs'] = $faqs->getAllFaqsBYServiceID($service['service_id']);
		$service['packages'] = $packages->getAllPackagesBYServiceID($service['service_id']);
		return $service;
	}
	public function addEditService($service)
	{
		$session = session();
		helper('form');
		$serviceid = intval($service['service_id']);
		$slugify = new FunctionsModel();
		$data = [
			'service_title' => esc($service['service_title']),
			'service_summary' => esc($service['service_summary']),
			'service_overview' => esc($service['service_overview']),
			'service_icon' => esc($service['service_icon']),
			'service_status' => intval($service['service_status']),
			'service_home_view' => intval($service['service_home_view']),
		];
		if ($serviceid == 0) {
			$slug = $slugify->slugify($service['service_title']);
			$correctSlug = $this->checkSlugDuplicacy($slug);
			$data['service_slug'] = esc($correctSlug);
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
			$query = $this->set($data)->where(['service_id' => $serviceid])->update();
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
	public function changeStatus($service_id)
	{
		$service = $this->where(['service_id' => $service_id])->first();
		if ($service != null) {
			if ($service['service_status'] == 1) {
				$query = $this->set(['service_status' => 0])->where(['service_id' => $service_id])->update();
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
				$query = $this->set(['service_status' => 1])->where(['service_id' => $service_id])->update();
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
				'message' => 'No service found for this request.',
			);
			return $respose;
		}
	}
	public function changeHomeStatus($service_id)
	{
		$service = $this->where(['service_id' => $service_id])->first();
		if ($service != null) {
			if ($service['service_home_view'] == 1) {
				$query = $this->set(['service_home_view' => 0])->where(['service_id' => $service_id])->update();
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
				$query = $this->set(['service_home_view' => 1])->where(['service_id' => $service_id])->update();
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
		$data = $this->where(['service_slug' => $slug])->countAll();

		if ($data > 0) {
			$slug2 = $slug . '-' . $data;
			return $slug2;
		} else {
			return $slug;
		}
	}
	public function getAllServicesNameAndIDOnly() {
		return $this->select('service_id, service_title')->findAll();
	}
	// DOCUMENTS BLOCKS	
	public function allDocumentsWIthServiceName()
	{
		$documentsDB = new ServicerequiredocsModel();
		$documentsList = $this->distinct()->select($documentsDB->table . '.*,' . $this->allowedFields[0])
			->join($documentsDB->table, $documentsDB->table . '.service_id=' . $this->table . '.service_id')
			->findAll();
		return $documentsList;
	}
}
// packages - packages have custom forms fields in JSON format