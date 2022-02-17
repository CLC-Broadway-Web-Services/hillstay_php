<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UserContactInfoModel extends Model
{
	protected $table = 'users_contact_info';
	protected $primaryKey = 'id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'user_id',
		'contact_person',
		'primary_number',
		'alternate_number',
		'status', //boolean
		'isDefault', //boolean
	];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	function getUserMethods($user_id)
	{
		$methods = $this->where(['user_id' => $user_id])->findAll();
		if ($methods) {
			return $methods;
		}
		return false;
	}
	function getSingleUserMethod($id)
	{
		return $this->find($id);
	}

	function changeDefaultMethod($user_id, $method_id) {
		$methods = $this->where(['user_id' => $user_id])->findAll();
		foreach($methods as $key => $method) {
			$newMethod = $method;
			$newMethod['isDefault'] = 0;
			if($method['id'] == $method_id) {
				$newMethod['isDefault'] = 1;
			}
			$this->save($newMethod);
			// $this->set($newMethods)->where('id', $id)->update();
		}
		// $methods = $this->where(['user_id' => $user_id])->findAll();
		return true;
	}
}
