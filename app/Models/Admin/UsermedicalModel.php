<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
class UsermedicalModel extends Model
{
	protected $table = 'user_medical_data';
	protected $primaryKey = 'umid';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'flu_fever',
		'flu_cough',
		'flu_sore_throat',
		'flu_runny_nose',
		'flu_shortness_of_breath',
		'flu_others',
		'chronic_specify',
		'medication_specify',
		'covid_19',
		'covid_19_first_dose',
		'covid_19_second_dose',
		'above_60_specify',
		'living_with_specify',
		'insurance_data',
		'uid',
	];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
