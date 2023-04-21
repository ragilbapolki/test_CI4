<?php

namespace App\Models\Transaction;
use CodeIgniter\Model;

class StockModel extends Model
{
	
	protected $table          = 't_stock';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';	
	protected $allowedFields  = ['product_id', 'stock', 'note','type', 'date','supplier_id','created_by','updated_by'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';

	public function getDataStock($product_id=null,$type=null)
    {
		$product 		= empty($product_id) ? '1=1':'m_products.id = '.$product_id;
		$type 			= empty($type) ? '1=1':'t_stock.type = '.$type;
		return $this->db->table('t_stock')
		->select('barcode, t_stock.id, m_products.name , t_stock.stock, date, note, type')
		->join('m_products','t_stock.product_id = m_products.id', 'left')
		->where($product)
		->where($type)
		->get()
		->getResultArray();  
    }
	
	public function getSumStockIn($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('t_stock')
		->selectSum('stock')		
		->where('t_stock.type = 1')
		->where($p_where)
		->get()
		->getResultArray();  
    }
	
	public function getSumStockOut($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		
		return $this->db->table('t_stock')
		->selectSum('stock')		
		->where('t_stock.type = 2')
		->where($p_where)
		->get()
		->getResultArray();  
    }

	public function getDataInfo($start_date,$end_date,$p_data)
    {
		$p_where_data = '1=1';
		if ($p_data == 'in') {
			$p_where_data = 't_stock.type = 1';
		} elseif ($p_data == 'out') {
			$p_where_data = 't_stock.type = 2';
		}
		$p_where_date	= $start_date == null && $end_date == null?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."'";
		return $this->db->table('t_stock')
		->select('barcode, t_stock.id, m_products.name , t_stock.stock, date, note, type')
		->join('m_products','t_stock.product_id = m_products.id', 'left')
		->where($p_where_data)
		->where($p_where_date)
		->get()
		->getResultArray();  
    }
}
