<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class StageModel extends Model
{
	protected $table          = 'm_stage';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'code', 'description', 'created_by','updated_by','deleted_by','deleted_at', 'status_id'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	public function getDataStage()
    {
         return $this->db->table('m_stage')
		 ->where('m_stage.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
}
