<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class SupplierModel extends Model
{
	protected $table          = 'm_supplier';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'address', 'phone', 'note', 'code','created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	public function getDataSupplier()
    {
         return $this->db->table('m_supplier')
		 ->where('m_supplier.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
	
	public function getCount($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('m_supplier')
		->selectCount('id')		
		->where('m_supplier.deleted_at is null')
		->where($p_where)
		->get()
		->getResultArray();  
    }
	
	public function getDataInfo($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" m_supplier.created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('m_supplier')
		->where('m_supplier.deleted_at is null')
		->where($p_where)
		->get()
		->getResultArray();  
    }
}
