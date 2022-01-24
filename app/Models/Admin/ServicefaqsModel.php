<?php

namespace App\Models\Admin;

use CodeIgniter\Model;


class ServicefaqsModel extends Model
{
	protected $table = 'service_faqs';
	protected $primaryKey = 'faq_id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'service_id',
		'faq_title',
		'faq_content',
		'faq_status',
	];
	protected $createdField  = 'faq_created_at';
	protected $updatedField  = 'faq_updated_at';

	public function getFaqByID($faq_id)
	{
		return $this->where(['faq_id' => $faq_id])->first();
	}
	public function getAllFaqsBYServiceID($serviceid)
	{
		return $this->where(['service_id' => $serviceid])->findAll();
	}
	public function allFaqsWIthServiceName()
	{
		$faqsList = $this->distinct()->select('service_faqs.*, services.service_title')
			->join('services', 'services.service_id=service_faqs.service_id')
			->findAll();
		return $faqsList;
	}
	public function addEditFaq($faq)
	{
		$session = session();
		helper('form');
		$faqid = intval($faq['faq_id']);

		$data = [
			'service_id' => $faq['service_id'],
			'faq_title' => esc($faq['faq_title']),
			'faq_content' => esc($faq['faq_content']),
			'faq_status' => $faq['faq_status'],
		];
		if ($faqid == 0) {
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
			$query = $this->set($data)->where(['faq_id' => $faqid])->update();
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
	public function statusChange($faq_id)
	{
		$faq = $this->where(['faq_id' => $faq_id])->first();
		if ($faq != null) {
			if ($faq['faq_status'] == 1) {
				$query = $this->set(['faq_status' => 0])->where(['faq_id' => $faq_id])->update();
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
				$query = $this->set(['faq_status' => 1])->where(['faq_id' => $faq_id])->update();
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
				'message' => 'No faq found for this request.',
			);
			return $respose;
		}
	}
}
