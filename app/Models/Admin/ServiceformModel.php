<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ServiceformModel extends Model
{
    protected $table = 'service_forms';
    protected $primaryKey = 'form_id';
    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;
    protected $allowedFields = [
        'sort_number',
        'service_id',
        'form_heading',
        'form_fields',
        'form_status',
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'form_created_at';
    protected $updatedField  = 'form_updated_at';
    // protected $deletedField  = 'deleted_at';
    // protected $validationRules    = [
    //     'username'     => 'required|alpha_numeric_space|min_length[3]',
    //     'email'        => 'required|valid_email|is_unique[users.email]',
    //     'password'     => 'required|min_length[8]',
    //     'pass_confirm' => 'required_with[password]|matches[password]'
    // ];

    // protected $validationMessages = [
    //     'email'        => [
    //         'is_unique' => 'Sorry. That email has already been taken. Please choose another.'
    //     ]
    // ];

    public function getAllForms()
    {
        $forms = $this->distinct()->select('service_forms.*, services.service_title')
            ->join('services', 'services.service_id=service_forms.service_id')
            ->findAll();

        // $forms = $this->findAll();
        $i = 0;
        for ($i; $i < count($forms); $i++) {
            $fields = json_decode($forms[$i]['form_fields']);
            $counting = count($fields);
            $forms[$i]['form_fields'] = $counting;
        }
        return $forms;        
    }
    public function getFormbyId($form_id)
    {
        return $this->find($form_id);
    }
    public function getFormByServiceID($service_id)
    {
        return $this->where(['service_id' => $service_id])->findAll();
    }
    public function changeStatus($form_id)
    {
        $form = $this->find($form_id);
        if ($form != null) {
            if ($form['form_status'] == 1) {
                $query = $this->set(['form_status' => 0])->where(['form_id' => $form_id])->update();
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
                $query = $this->set(['form_status' => 1])->where(['form_id' => $form_id])->update();
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
                'message' => 'No form found for this request.',
            );
            return $respose;
        }
    }
	public function addEditForm($form)
	{
		$session = session();
		helper('form');
		$formid = intval($form['form_id']);
		$data = [
			'sort_number' => intval($form['sort_number']),
			'service_id' => intval($form['service_id']),
			'form_heading' => esc($form['form_heading']),
			'form_fields' => $form['form_fields'],
			'form_status' => intval($form['form_status']),
		];
		if ($formid == 0) {
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
			$query = $this->set($data)->where(['form_id' => $formid])->update();
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
}
