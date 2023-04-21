<?php

namespace App\Models\Transaction;
use CodeIgniter\Model;

class OrderDetailModel extends Model
{
	protected $table          = 't_order_detail';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';	
	protected $allowedFields  = ['order_id', 'product_id', 'price','quantity','total_price','created_by','updated_by'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';

	public function getDataDetail($id)
    {
		return $this->db->table('t_order_detail')
		->select('m_products.name, m_products.barcode,t_order_detail.*')		
		->join('m_products','t_order_detail.product_id = m_products.id', 'left')
		->where('t_order_detail.order_id = '.$id)
		->get()
		->getResultArray(); 
    }
	public function getDataChart($start_date,$end_date)
    {
		$p_where		= $start_date == null && $end_date == null ?'1=1':" created_at BETWEEN ' ". $start_date . "' and '".$end_date."' ";
		
		$sql =  "select DISTINCT (sf_formatTanggal(created_at)) bulan,MONTH (created_at), YEAR(created_at) as tahun,  sum(quantity) as qty from t_order_detail
		where ".$p_where."
		GROUP BY 1
		order by 2 ";
		return $this->db->query($sql)
		->getResultArray(); 
    }
}
