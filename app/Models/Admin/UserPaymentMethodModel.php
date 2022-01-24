<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UserPaymentMethodModel extends Model
{
	protected $table = 'users_payment_method';
	protected $primaryKey = 'id';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'user_id',
		'method', // 'BANK','UPI'
		'upi_number',
		'bank_user_name',
		'bank_acc_number',
		'bank_name',
		'bank_ifsc',
		'bank_branch',
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
