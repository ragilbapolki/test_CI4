<?php

namespace App\Models\Administrator;
use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table          = 'users';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = [
        'email', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at','employee_id'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';
	protected $deletedField   = 'deleted_at';

	public function getDataUser()
    {
         return $this->db->table('users')
         ->join('m_employee','m_employee.id = users.employee_id', 'left')
		 ->where('users.deleted_at is null')
		 ->where('users.employee_id is not null')
         ->get()
		 ->getResultArray();  
    }
	public function getDataUserCombo()
    {
         return $this->db->table('users')
		 ->where('users.deleted_at is null')
         ->get()
		 ->getResultArray();  
    }
}
