<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TestimonialsModel extends Model
{
	protected $table = 'testimonials';
	protected $primaryKey = 'testimonial_id';
    protected $returnType     = 'array';
    
	protected $allowedFields = [
		'testimonials_content',
		'testimonials_name',
		'testimonials_post',
		'testimonials_company',
		'testimonials_status',
    ];
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
	protected $createdField  = 'testimonials_created_at';
	protected $updatedField  = 'testimonials_updated_at';
    protected $deletedField = 'testimonials_deleted_at';
    
	public function getAllTestimonialsAdmin()
	{
		return $this->orderBy('testimonial_id', 'desc')->findAll();
	}
	public function getAllTestimonialsFront()
	{
		return $this->where('testimonials_status', 1)->orderBy('testimonial_id', 'desc')->findAll();
	}
	public function getTestimonialByID($testimonial_id)
	{
		return $this->find($testimonial_id);
	}
	public function addEditTestimonial($testimonial)
	{
		$session = session();
		helper('form');
		$testimonial_id = intval($testimonial['testimonial_id']);
		$data = [
			'testimonials_content' => $testimonial['testimonials_content'],
			'testimonials_name' => $testimonial['testimonials_name'],
			'testimonials_post' => $testimonial['testimonials_post'],
			'testimonials_company' => $testimonial['testimonials_company'],
			'testimonials_status' => $testimonial['testimonials_status'],
		];
		if ($testimonial_id == 0) {
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
			$query = $this->set($data)->where(['testimonial_id' => $testimonial_id])->update();
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
	public function deleteTestimonial($testimonial_id)
	{
		return $this->delete($testimonial_id);
	}
	public function changeStatus($testimonial_id)
	{
		$testimonial = $this->where(['testimonial_id' => $testimonial_id])->first();
		if ($testimonial != null) {
			if ($testimonial['testimonials_status'] == 1) {
				$query = $this->set(['testimonials_status' => 0])->where(['testimonial_id' => $testimonial_id])->update();
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
				$query = $this->set(['testimonials_status' => 1])->where(['testimonial_id' => $testimonial_id])->update();
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
				'message' => 'No testimonial found for this request.',
			);
			return $respose;
		}
	}
}
