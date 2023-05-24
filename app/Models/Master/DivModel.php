<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class DivModel extends Model
{
	protected $table          = 'm_div';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'code', 'description', 'created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	public function getDataDiv()
    {
         return $this->db->table('m_div')
		 ->where('m_div.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
}
