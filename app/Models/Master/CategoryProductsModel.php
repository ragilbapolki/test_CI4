<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class CategoryProductsModel extends Model
{
	protected $table          = 'm_category_products';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'description', 'code','created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	
	public function getDataCategory()
    {
         return $this->db->table('m_category_products')
		 ->where('m_category_products.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
}
