<?php
use CodeIgniter\Model;
namespace App\Models\Administrator;

class MenusModel extends Model
{
	protected $table         = 'menus';
	protected $primaryKey    = 'id';
	protected $returnType    = 'array';
	protected $allowedFields = ['name', 'url', 'code', 'order','parent_id','modul_id','token','icon','created_by','updated_by','deleted_by'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
}
