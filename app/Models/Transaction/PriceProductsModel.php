<?php

namespace App\Models\Transaction;
use CodeIgniter\Model;

class PriceProductsModel extends Model
{
	protected $table          = 't_price_products';
	protected $primaryKey     = 'id';
	protected $returnType     = 'array';
	protected $allowedFields  = ['product_id', 'price', 'note', 'date','created_by','updated_by'];
	protected $useTimestamps  = true;
	protected $createdField   = 'created_at';
	protected $updatedField   = 'updated_at';

	public function getDataPrice($product_id=null)
    {
		$product 		= empty($product_id) ? '1=1':'m_products.id = '.$product_id;
		return $this->db->table('t_price_products')
		->select('barcode,t_price_products.id,m_products.name,t_price_products.price,date,note')
		->join('m_products','t_price_products.product_id = m_products.id', 'left')
		->where($product)
		->get()
		->getResultArray();  
    }
}
