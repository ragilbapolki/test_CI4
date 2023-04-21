<?php

namespace App\Controllers\Transaction;

use App\Controllers\BaseController;
use App\Models\Master\{ProductsModel, SupplierModel};
use App\Models\Transaction\StockModel;

class StockProductsController extends BaseController
{
	protected $stock;
	protected $products;
	protected $supplier;

	public function __construct()
	{
		$this->stock = new StockModel();
		$this->products = new ProductsModel();
		$this->supplier = new SupplierModel();
	}

	public function index()
	{
		$data = [
			'title' 		=> 'Stock Product',
			'data_products' => $this->products->getDataProducts()
		];

		return view('transaction/stock/index', $data);
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$product_id 	= $this->request->getVar('p_product');
			$type 	= $this->request->getVar('p_type');
			
			$data = [
				'data_stock' => $this->stock->getDataStock($product_id, $type)
			];

			$result = [
				'output' => view('transaction/stock/view_data', $data)
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
				'data_products' => $this->products->getDataProducts(),
				'data_supplier' => $this->supplier->getDataSupplier()
			];

			$result = [
				'output' => view('transaction/stock/view_modal',$data)
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
				'stock'		=> ['label' => 'product stock','rules' => 'required'],
				'type'		=> ['label' => 'product type','rules' => 'required'],
				'note'		=> ['label' => 'note','rules' => 'required']
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'select_products' 	=> $validation->getError('products'),
						'select_type' 		=> $validation->getError('type'),
						'stock' 			=> $validation->getError('stock'),
						'note' 				=> $validation->getError('note')
					]
				];
			} else {

				$product_id		= $this->request->getPost('products');
				$stock 			= $this->request->getPost('stock');
				$type 			= $this->request->getPost('type');
				$note 			= strip_tags($this->request->getPost('note'));
				$supplier		= $this->request->getPost('supplier');
				$data_product 	= $this->products->find($product_id);

				$this->stock->insert([
					'product_id'	=> $product_id,
					'stock' 		=> $stock,
					'type'	 		=> $type,
					'note'	 		=> $note,
					'supplier_id'	=> $supplier,
					'date'	 		=> date("Y-m-d H:i:s"),
					'created_by'	=>user()->id
				]);
				
				$this->products->set([ 
					'stock'			=> ($type == '1' ) ? ($data_product['stock'] + $stock) : ($data_product['stock'] - $stock),
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
