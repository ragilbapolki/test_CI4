<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class BranchModel extends Model
{
	protected $table          = 'm_branch';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'code', 'description', 'created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	
	public function getDataBranch()
    {
         return $this->db->table('m_branch')
		 ->where('m_branch.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
	
}
