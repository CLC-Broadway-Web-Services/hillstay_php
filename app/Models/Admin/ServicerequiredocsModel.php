<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ServicerequiredocsModel extends Model
{
    protected $table = 'service_documents';
    protected $primaryKey = 'document_id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'service_id',
        'document_title',
        'document_summary',
        'document_status',
    ];
    protected $createdField  = 'document_created_at';
    protected $updatedField  = 'document_updated_at';

    public function getDocumentByID($documentid)
    {
        return $this->where(['document_id' => $documentid])->first();
    }
    public function getAllDocsBYServiceID($serviceid)
    {
        return $this->where(['service_id' => $serviceid])->findAll();
    }

    public function addEditDocument($document)
    {
        $session = session();
        helper('form');
        $documentid = intval($document['document_id']);

        $data = [
            'service_id' => $document['service_id'],
            'document_title' => esc($document['document_title']),
            'document_summary' => esc($document['document_summary']),
            'document_status' => $document['document_status'],
        ];
        if ($documentid == 0) {
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
            $query = $this->set($data)->where(['document_id' => $documentid])->update();
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

    public function allDocumentsWIthServiceName()
    {
        $documentsList = $this->distinct()->select('service_documents.*, services.service_title')
            ->join('services', 'services.service_id=service_documents.service_id')
            ->findAll();
        return $documentsList;
    }
    public function statusChange($documentid)
    {
        $document = $this->where(['document_id' => $documentid])->first();
        if ($document != null) {
            if ($document['document_status'] == 1) {
                $query = $this->set(['document_status' => 0])->where(['document_id' => $documentid])->update();
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
                $query = $this->set(['document_status' => 1])->where(['document_id' => $documentid])->update();
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
                'message' => 'No document found for this request.',
            );
            return $respose;
        }
    }
}
