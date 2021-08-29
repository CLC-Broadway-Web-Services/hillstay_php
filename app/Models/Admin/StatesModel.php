<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class StatesModel extends Model
{
	protected $table = 'states';
	protected $primaryKey = 'id ';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'name',
		'country_code',
		'fips_code',
		'iso2',
		'wikiDataId',
	];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	public function getStates()
	{
		$cache = cache();
		// $cache->delete('states');
		if ($cache->get('states')) {
			return $cache->get('states');
		} else {
			$states = $this->select('id, name')->findAll();
			$cache->save('states', $states, 604800);
			return $states;
		}
	}
	public function getSingleState($id)
	{
		return $this->find($id);
	}
}

class CitiesModel extends Model
{
	protected $table = 'cities';
	protected $primaryKey = 'id ';
	protected $returnType     = 'array';
	protected $allowedFields = [
		'name',
		'state_id',
		'state_code',
		'country_code',
		'latitude',
		'longitude',
		'wikiDataId',
	];
	protected $useSoftDeletes = true;
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';

	public function getCities()
	{
		$cache = cache();
		// $cache->delete('cities');
		if ($cache->get('cities')) {
			return $cache->get('cities');
		} else {
			$cities = $this->select('id, name, state_id')->findAll();
			$cache->save('cities', $cities, 604800);
			return $cities;
		}
	}
	public function getCitiesByState($state_id)
	{
		$cache = cache();
		if ($cache->get('cities_' . $state_id)) {
			return $cache->get('cities_' . $state_id);
		} else {
			$cities = $this->select('id, name, state_id')->where('state_id', $state_id)->findAll();
			$cache->save('cities_' . $state_id, $cities, 604800);
			return $cities;
		}
	}
}
