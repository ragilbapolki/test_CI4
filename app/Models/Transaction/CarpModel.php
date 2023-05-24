<?php

namespace App\Models\Transaction;
use CodeIgniter\Model;

class CarpModel extends Model
{		
	protected $table          = 't_carp';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';	
	protected $allowedFields  = ['category_id', 'code', 'initiator_by', 'recipient_by', 'verified_by', 'effectiveness','due_date', 'stage','status', 'created_by','updated_by'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';

	public function getMaxId()
    {
		return $this->db->table('t_carp')
		->selectMax('id')
		->get()
		->getResultArray();  
    }

	public function getDataCarp()
    {
         return $this->db->table('t_carp')
		 ->select('t_carp.id, a.name as initiator_name, b.name as recipient_name, c.name as verified_name, due_date, status_date, effectiveness, stage, status, t_carp.created_at, t_carp.code, d.name as category_name')
         ->join('m_employee as a','a.id = t_carp.initiator_by', 'left')
         ->join('m_employee as b','b.id = t_carp.recipient_by', 'left')
         ->join('m_employee as c','c.id = t_carp.verified_by', 'left')
         ->join('m_category as d','d.id = t_carp.category_id', 'left')
		 ->where('t_carp.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }

	public function getDataCarpPIC()
    {
         return $this->db->table('t_carp')
		 ->select('t_carp.id, a.name as initiator_name, b.name as recipient_name, c.name as verified_name, due_date, status_date, effectiveness, stage, status, t_carp.created_at, t_carp.code, d.name as category_name')
         ->join('m_employee as a','a.id = t_carp.initiator_by', 'left')
         ->join('m_employee as b','b.id = t_carp.recipient_by', 'left')
         ->join('m_employee as c','c.id = t_carp.verified_by', 'left')
         ->join('m_category as d','d.id = t_carp.category_id', 'left')
		 ->where('t_carp.deleted_at is null')
		 ->where('t_carp.stage not in (24,21,19,18)')
		 ->where("t_carp.recipient_by = '" .  user()->employee_id."'")
         ->get()
		 ->getResultArray();  
    }

	public function getDataCarpApproval()
    {
         return $this->db->table('t_carp')
		 ->select('t_carp.id, a.name as initiator_name, b.name as recipient_name, c.name as verified_name, due_date, status_date, effectiveness, stage, status, t_carp.created_at, t_carp.code, d.name as category_name')
         ->join('m_employee as a','a.id = t_carp.initiator_by', 'left')
         ->join('m_employee as b','b.id = t_carp.recipient_by', 'left')
         ->join('m_employee as c','c.id = t_carp.verified_by', 'left')
         ->join('m_category as d','d.id = t_carp.category_id', 'left')
		 ->where('t_carp.deleted_at is null')
		 ->where('t_carp.stage in (24,21)')
		 ->where("t_carp.verified_by = '" .  user()->employee_id."'")
         ->get()
		 ->getResultArray();  
    }

	public function getDataDetail($id)
    {
		return $this->db->table('t_carp')
		->select('t_carp.id, a.name as initiator_name, b.name as recipient_name, c.name as verified_name, due_date, status_date, effectiveness, stage, status, t_carp.created_at, t_carp.code, d.name as category_name')
		->join('m_employee as a','a.id = t_carp.initiator_by', 'left')
		->join('m_employee as b','b.id = t_carp.recipient_by', 'left')
		->join('m_employee as c','c.id = t_carp.verified_by', 'left')
		->join('m_category as d','d.id = t_carp.category_id', 'left')
		->where('t_carp.id = '.$id)
		->get()
		->getResultArray(); 
    }
	
	public function getCount($stage_id,$start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('t_carp')
		->select('count(id) as id, coalesce(stage,0) as id_stage')	
		->where('t_carp.stage = '.$stage_id)
		->where($p_where)
		->get()
		->getResultArray();  
    }
	
	function getDataChartStatus($start_date,$end_date) 
	{
		$p_where		= $start_date == null && $end_date == null ?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."' ";

		$sql =  "select case status when 1 then 'Open' when 2 then 'Closed' when 3 then 'Canceled' end as status_name, count(id) count_status from t_carp
		where ".$p_where."
		GROUP BY 1
		order by 2";
		return $this->db->query($sql)
		->getResultArray(); 
	}
	
	function getDataChartBar($start_date,$end_date) 
	{
		$p_where		= $start_date == null && $end_date == null ?'1=1':" a.created_at BETWEEN ' ". $start_date . "' and '".$end_date."' ";
		$sql =  " select sum(data_effective)data_effective, sum(data_non)data_non,name from (select count(effective)as data_effective, count(non) as data_non, name, effective, non   from (select case a.effectiveness when 1 then 'Effective' end effective, case a.effectiveness when 2 then 'Not Effective' end as non,c.name 
		from t_carp as a 
		left join m_employee as b on a.recipient_by = b.id
		left JOIN m_div as c on b.div_id = c.id
		where  ".$p_where.")as aa
		GROUP BY 3,4,5
		order by 3)as aaa
		group by 3";
		return $this->db->query($sql)
		->getResultArray(); 
	}
	
	public function getDataInfo($stage_id,$start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" t_carp.created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";

		return $this->db->table('t_carp')
		->select('t_carp.id, a.name as initiator_name, b.name as recipient_name, c.name as verified_name, due_date, status_date, effectiveness, stage, status, t_carp.created_at, t_carp.code, d.name as category_name')
		->join('m_employee as a','a.id = t_carp.initiator_by', 'left')
		->join('m_employee as b','b.id = t_carp.recipient_by', 'left')
		->join('m_employee as c','c.id = t_carp.verified_by', 'left')
		->join('m_category as d','d.id = t_carp.category_id', 'left')
		->where('t_carp.deleted_at is null')
		->where('t_carp.stage = '.$stage_id)
		->where($p_where)
		->get()
		->getResultArray();  
    }
}
