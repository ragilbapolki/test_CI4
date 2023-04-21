<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class UnitModel extends Model
{
	protected $table          = 'm_unit';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'description', 'code','created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	
	public function getDataUnit()
    {
         return $this->db->table('m_unit')
		 ->where('m_unit.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
}
