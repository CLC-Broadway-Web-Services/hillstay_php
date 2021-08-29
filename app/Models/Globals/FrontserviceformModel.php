<?php

namespace App\Models\Globals;

use CodeIgniter\Model;

class FrontserviceformModel extends Model
{
    protected $table = 'service_forms';
    protected $primaryKey = 'form_id';
    protected $returnType     = 'array';
    protected $allowedFields = [];
    protected $createdField  = 'form_created_at';
    protected $updatedField  = 'form_updated_at';

    public function getFormByServiceID($service_id)
    {
        return $this->where(['service_id' => $service_id, 'form_status' => 1])->orderBy('sort_number', 'asc')->findAll();
    }
}
