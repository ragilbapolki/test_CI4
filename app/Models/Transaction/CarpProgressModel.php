<?php

namespace App\Models\Transaction;
use CodeIgniter\Model;

class CarpProgressModel extends Model
{
	protected $table         = 't_carp_progress';
	protected $primaryKey    = 'id';
	protected $returnType    = 'array';
	protected $allowedFields  = ['carp_id', 'description'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	public function getDataProgress($id)
    {
		return $this->db->table('t_carp_progress')
		->where('t_carp_progress.carp_id = '.$id)
		->get()
		->getResultArray();  
    }
}
