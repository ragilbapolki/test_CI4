<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class EmployeeModel extends Model
{
	protected $table          = 'm_employee';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['name', 'div_id', 'pos_id', 'brach_id', 'phone' , 'created_by', 'address','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	public function getDataEmployee()
    {
         return $this->db->table('m_employee')
		 ->select('m_employee.id, m_employee.name as employee_name, brach_id, div_id, pos_id, phone, address, m_branch.code as branch_name, m_position.name as position_name, m_div.name as div_name')
         ->join('m_branch','m_branch.id = m_employee.brach_id', 'left')
         ->join('m_div','m_div.id = m_employee.div_id', 'left')
         ->join('m_position','m_position.id = m_employee.pos_id', 'left')
		 ->where('m_employee.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }

	public function getDataEmployeeCombo()
    {
         return $this->db->table('m_employee')
		 ->where('m_employee.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
}
