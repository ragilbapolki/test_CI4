<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class CustomerModel extends Model
{
	protected $table          = 'm_customer';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'address', 'genre', 'phone', 'note', 'created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	
	public function getDataCustomer()
    {
         return $this->db->table('m_customer')
		 ->where('m_customer.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
	
	public function getCount($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('m_customer')
		->selectCount('id')		
		->where('m_customer.deleted_at is null')
		->where($p_where)
		->get()
		->getResultArray();  
    }
	
	public function getDataInfo($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		return $this->db->table('m_customer')
		->where('m_customer.deleted_at is null')
		->where($p_where)
		->get()
		->getResultArray();  
    }
}
