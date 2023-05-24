<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class CategoryModel extends Model
{
	protected $table          = 'm_category';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'code', 'description', 'created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	public function getDataCategory()
    {
         return $this->db->table('m_category')
		 ->where('m_category.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
}
