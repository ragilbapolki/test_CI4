<?php

namespace App\Models\Master;
use CodeIgniter\Model;

class ProductsModel extends Model
{
	protected $table         = 'm_products';
	protected $primaryKey    = 'id';
	protected $returnType    = 'array';
	protected $allowedFields = ['name', 'description', 'price', 'barcode','unit_id','category_id','stock','created_by','updated_by','deleted_by','deleted_at'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';

	public function getDataProducts($p_category=null,$p_unit=null)
    {
		// parameter
		$category 	= empty($p_category) ? '1=1':'m_category_products.id = '.$p_category;
		$unit 		= empty($p_unit) ? '1=1':'m_products.unit_id = '.$p_unit;

         return $this->db->table('m_products')
		 ->select('m_products.id, m_products.name, m_products.description, price, barcode, unit_id, category_id, stock')
         ->join('m_category_products','m_category_products.id = m_products.category_id', 'left')
		 ->where('m_products.deleted_at is null')
		 ->where($category)
		 ->where($unit)
         ->get()
		 ->getResultArray();  
    }
	
	public function getDataDetail($id)
    {
		return $this->db->table('m_products')
		->select('m_products.id, m_products.name, m_products.description, price, barcode, unit_id, category_id, stock, m_category_products.name as category, m_unit.name as unit, m_unit.code as code_unit')
		->join('m_category_products','m_category_products.id = m_products.category_id', 'left')
		->join('m_unit','m_unit.id = m_products.unit_id', 'left')
		->where('m_products.deleted_at is null')
		->where('m_products.id = '.$id)
		->get()
		->getResultArray(); 
    }
	
	public function getCount($start_date,$end_date)
    {	
		$p_where		= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('m_products')
		->selectCount('id')		
		->where('m_products.deleted_at is null')
		->where($p_where)
		->get()
		->getResultArray();  
    }

	public function getSumStock($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('m_products')
		->selectSum('stock')		
		->where('m_products.deleted_at is null')
		->where($p_where)
		->get()
		->getResultArray();  
    }
	
	function getDataChartCategory($start_date,$end_date) 
	{
		$p_where		= $start_date == null && $end_date == null ?'1=1':" b.created_at BETWEEN ' ". $start_date . "' and '".$end_date."' ";

		$sql =  "select DISTINCT(b.name) as name_category, count(a.id) count_product from m_products as a
		left join m_category_products as b on a.category_id = b.id
		where ".$p_where."
		GROUP BY 1
		order by 2";
		return $this->db->query($sql)
		->getResultArray(); 
	}
	
	public function getDataInfo($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" m_products.created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('m_products')
		->select('m_products.id, m_products.name, m_products.description, price, barcode, unit_id, category_id, stock')
		->join('m_category_products','m_category_products.id = m_products.category_id', 'left')
		->where('m_products.deleted_at is null')
		->where($p_where)
		->get()
		->getResultArray();  
    }
}
