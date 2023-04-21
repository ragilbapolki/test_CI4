<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class StoreModel extends Model
{
	protected $table          = 'm_store';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'address', 'phone', 'note', 'created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	
	public function getDataStore()
    {
         return $this->db->table('m_store')
		 ->where('m_store.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
}
