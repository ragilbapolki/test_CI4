<?php

namespace App\Models\Transaction;
use CodeIgniter\Model;

class OrderModel extends Model
{		
	protected $table          = 't_order';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';	
	protected $allowedFields  = ['no', 'date', 'customer_id', 'total_payment', 'moneys', 'change', 'created_by','updated_by'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';

	public function getMaxId()
    {
		return $this->db->table('t_order')
		->selectMax('id')
		->where('date = CURRENT_DATE')
		->get()
		->getResultArray();  
    }

	public function getDataOrderParam($start_date,$end_date)
    {
		$p_where		= empty($start_date) && empty($end_date) ?'1=1':"date BETWEEN ' ". date_format(date_create($start_date),"Y-m-d") . "' and '".date_format(date_create($end_date),"Y-m-d")."'";
		return $this->db->table('t_order')
		->select('m_customer.name, t_order.*')		
		->join('m_customer','t_order.customer_id = m_customer.id', 'left')
		->where($p_where)
		->get()
		->getResultArray();  
    }
	
	public function getDataDetail($id)
    {
		return $this->db->table('t_order')
		->select('m_customer.name, users.username,t_order.*')		
		->join('m_customer','t_order.customer_id = m_customer.id', 'left')
		->join('users','t_order.created_by = users.id', 'left')
		->where('t_order.id = '.$id)
		->get()
		->getResultArray(); 
    }

	public function getCount($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('t_order')
		->selectCount('id')		
		->where($p_where)
		->get()
		->getResultArray();  
    }
	
	public function getDataInfo($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" date BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('t_order')
		->select('m_customer.name, t_order.*')		
		->join('m_customer','t_order.customer_id = m_customer.id', 'left')
		->where($p_where)
		->get()
		->getResultArray();  
    }
}
