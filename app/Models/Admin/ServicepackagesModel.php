<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use App\Models\Globals\FunctionsModel;

class ServicepackagesModel extends Model
{
	protected $table = 'service_packages';
	protected $primaryKey = 'package_id';
	protected $returnType = 'array';
	protected $allowedFields = [
		'service_id',
		'package_name',
		'package_slug',
		'package_price',
		'package_details',
		'package_isSpecial',
		'package_status',
	];
	protected $createdField  = 'package_created_at';
	protected $updatedField  = 'package_updated_at';

	public function getPackageByID($package_id)
	{
		return $this->where(['package_id' => $package_id])->first();
	}
	public function getAllPackageBYServiceID($serviceid)
	{
		return $this->where(['service_id' => $serviceid])->findAll();
	}
	public function allPackagesWIthServiceName()
	{
		$packagesList = $this->distinct()->select('service_packages.*, services.service_title')
			->join('services', 'services.service_id=service_packages.service_id')
			->findAll();
		return $packagesList;
	}
	public function addEditPackage($package)
	{
		$session = session();
		helper('form');
		$packageid = intval($package['package_id']);
		$slugify = new FunctionsModel();
		$data = [
			'service_id' => $package['service_id'],
			'package_name' => $package['package_name'],
			// 'package_slug' => esc($package['package_slug']),
			'package_price' => $package['package_price'],
			'package_details' => $package['package_details'],
			'package_status' => $package['package_status'],
			'package_isSpecial' => $package['package_isSpecial'],
		];
		if ($packageid == 0) {
			$slug = $slugify->slugify($package['package_name']);
			$correctSlug = $this->checkSlugDuplicacy($slug);
			$data['package_slug'] = esc($correctSlug);
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
			$query = $this->set($data)->where(['package_id' => $packageid])->update();
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
	public function statusChange($package_id)
	{
		$package = $this->where(['package_id' => $package_id])->first();
		if ($package != null) {
			if ($package['package_status'] == 1) {
				$query = $this->set(['package_status' => 0])->where(['package_id' => $package_id])->update();
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
				$query = $this->set(['package_status' => 1])->where(['package_id' => $package_id])->update();
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
				'message' => 'No package found for this request.',
			);
			return $respose;
		}
	}
	public function specialChange($package_id)
	{
		$package = $this->where(['package_id' => $package_id])->first();
		if ($package != null) {
			if ($package['package_isSpecial'] == 1) {
				$query = $this->set(['package_isSpecial' => 0])->where(['package_id' => $package_id])->update();
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
				$query = $this->set(['package_isSpecial' => 1])->where(['package_id' => $package_id])->update();
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
				'message' => 'No package found for this request.',
			);
			return $respose;
		}
	}
	public function checkSlugDuplicacy($slug)
	{
		$data = $this->where(['package_slug' => $slug])->countAll();

		if ($data > 0) {
			$slug2 = $slug . '-' . $data;
			return $slug2;
		} else {
			return $slug;
		}
	}
}