<?php

namespace App\Controllers\Transaction;

use App\Controllers\BaseController;
use App\Models\Master\ProductsModel;
use App\Models\Transaction\PriceProductsModel;

class PriceProductsController extends BaseController
{
	protected $products;
	protected $price_products;

	public function __construct()
	{
		$this->products = new ProductsModel();
		$this->price_products = new PriceProductsModel();
	}

	public function index()
	{
		$data = [
			'title' 		=> 'Price Product',
			'data_products' => $this->products->getDataProducts()
		];

		return view('transaction/price_products/index', $data);
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$product_id 	= $this->request->getVar('p_product');
			
			$data = [
				'data_price_products' => $this->price_products->getDataPrice($product_id)
			];

			$result = [
				'output' => view('transaction/price_products/view_data', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function get_modal()
	{

		if ($this->request->isAJAX()) {
			$data = [
				'data_products' => $this->products->getDataProducts()
			];
			$result = [
				'output' => view('transaction/price_products/view_modal',$data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function save_data()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			$rules = $this->validate([
				'products'	=> ['label' => 'products','rules' => 'required'],				
				'price'		=> ['label' => 'product price','rules' => 'required'],
				'note'		=> ['label' => 'note','rules' => 'required']
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'select_products' 	=> $validation->getError('products'),
						'price' 			=> $validation->getError('price'),
						'note' 				=> $validation->getError('note')
					]
				];
			} else {
				$product_id	= $this->request->getPost('products');
				$price 		= str_replace(',', '', strip_tags($this->request->getPost('price')));
				$note 		= strip_tags($this->request->getPost('note'));
				$this->price_products->insert([
					'product_id'=> $product_id,
					'price' 	=> $price,
					'note'	 	=> $note,
					'date'	 	=> date("Y-m-d H:i:s"),
					'created_by'=>user()->id
				]);
				
				$this->products->set([ 
					'price'			=> $price,
					'updated_by'	=> user()->id
				])->where('id', $product_id)->update();

				$result = [
					'success' => 'Data has been added to database'
				];
			}
			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
}
