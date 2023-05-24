<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class PositionModel extends Model
{
	protected $table         = 'm_position';
	protected $primaryKey    = 'id';
	protected $returnType    = 'array';
	protected $allowedFields  = ['name', 'code', 'description', 'created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	public function getDataPosition()
    {
         return $this->db->table('m_position')
		 ->where('m_position.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
}
