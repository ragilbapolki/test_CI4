<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Master\{ProductsModel, CategoryProductsModel, UnitModel};

class ProductsController extends BaseController
{
	protected $units;
	protected $products;
	protected $category_products;
	
	public function __construct()
	{
		$this->units = new UnitModel();
		$this->products = new ProductsModel();
		$this->category_products = new CategoryProductsModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Master Products',
			'data_unit' => $this->units->getDataUnit(),
			'data_category_products' => $this->category_products->getDataCategory()
		];

		return view('master/products/index', $data);
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$p_unit 	= $this->request->getVar('p_unit');
			$p_category = $this->request->getVar('p_category');

			$data = [
				'data_products' => $this->products->getDataProducts($p_category,$p_unit)
			];

			$result = [
				'output' => view('master/products/view_data', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function get_first_data()
	{
		if ($this->request->isAJAX()) {			
			$id   = $this->request->getVar('p_product');
			$data = $this->products->find($id);
			echo json_encode($data);
		} else {
			exit('404 Not Found');
		}
	}
	public function get_modal()
	{

		if ($this->request->isAJAX()) {
			$data = [
				'data_unit' => $this->units->getDataUnit(),
				'data_category_products' => $this->category_products->getDataCategory()
			];
			
			$result = [
				'output' => view('master/products/view_modal', $data)
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
				'barcode' 		=> ['label' => 'product barcode','rules' => 'required'],
				'name' 	  		=> ['label' => 'product name','rules' => 'required|min_length[3]'],
				'description' 	=> ['label' => 'product desc','rules' => 'required'],
				'price' 		=> ['label' => 'product price','rules' => 'required'],
				'stock' 		=> ['label' => 'product stock','rules' => 'required'],
				'category' 		=> ['label' => 'product category','rules' => 'required'],
				'unit' 			=> ['label' => 'product unit','rules' => 'required'],
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'barcode' 			=> $validation->getError('barcode'),
						'name' 				=> $validation->getError('name'),
						'description' 		=> $validation->getError('description'),
						'price'	 			=> $validation->getError('price'),
						'stock' 			=> $validation->getError('stock'),
						'select_category'	=> $validation->getError('category'),
						'select_unit' 		=> $validation->getError('unit')
					]
				];
			} else {
				$barcode 	= strip_tags($this->request->getPost('barcode'));
				$name 		= strip_tags($this->request->getPost('name'));
				$description= strip_tags($this->request->getPost('description'));
				$price 		= str_replace(',', '', strip_tags($this->request->getPost('price')));
				$stock 		= strip_tags($this->request->getPost('stock'));
				$category_id= strip_tags($this->request->getPost('category'));
				$unit_id 	= strip_tags($this->request->getPost('unit'));

				$store = $this->products->insert([
					'barcode' 		=> $barcode,
					'name' 			=> $name,
					'description' 	=> $description,
					'price' 		=> $price,
					'stock' 		=> $stock,
					'category_id' 	=> $category_id,
					'unit_id' 		=> $unit_id,
					'created_by' 	=> user()->id
				]);

				$result = [
					'success' => 'Data has been added to database'
				];
			}
			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function get_modal_edit()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');

			$data = [
				'records'				=> $this->products->find($id),
				'data_unit' 			=> $this->units->getDataUnit(),
				'data_category_products'=> $this->category_products->getDataCategory()
			];

			$result = [
				'output' => view('master/products/view_modal_edit', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function update_data()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			$rules = $this->validate([
				'barcode' 		=> ['label' => 'product barcode','rules' => 'required'],
				'name' 	  		=> ['label' => 'product name','rules' => 'required|min_length[3]'],
				'description' 	=> ['label' => 'product desc','rules' => 'required'],
				'price' 		=> ['label' => 'product price','rules' => 'required'],
				'stock' 		=> ['label' => 'product stock','rules' => 'required'],
				'category' 		=> ['label' => 'product category','rules' => 'required'],
				'unit' 			=> ['label' => 'product unit','rules' => 'required'],
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'barcode' 			=> $validation->getError('barcode'),
						'name' 				=> $validation->getError('name'),
						'description' 		=> $validation->getError('description'),
						'price'	 			=> $validation->getError('price'),
						'stock' 			=> $validation->getError('stock'),
						'select_category'	=> $validation->getError('category'),
						'select_unit' 		=> $validation->getError('unit')
					]
				];
			} else {
				$id 		= $this->request->getPost('id');
				$datas 		= $this->products->find($id);
				$barcode 	= strip_tags($this->request->getPost('barcode'));
				$name 		= strip_tags($this->request->getPost('name'));
				$description= strip_tags($this->request->getPost('description'));
				$price 		= str_replace(',', '', strip_tags($this->request->getPost('price')));
				$stock 		= strip_tags($this->request->getPost('stock'));
				$category_id= strip_tags($this->request->getPost('category'));
				$unit_id 	= strip_tags($this->request->getPost('unit'));

				$this->products->update($id, [
					'barcode' 		=> $barcode,
					'name' 			=> $name,
					'description' 	=> $name,
					'price' 		=> $price,
					'stock' 		=> $stock,
					'category_id' 	=> $category_id,
					'unit_id' 		=> $unit_id,
					'updated_by' 	=> user()->id
				]);

				$result = [
					'success' => 'Data has been updated from database'
				];
			}
			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function delete_data()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$this->products->update($id, [
				'deleted_at' => date("Y-m-d H:i:s"),
				'deleted_by' => user()->id
			]);
			$result = [
				'output' => "Data has been deleted from database"
			];
			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
	
	public function get_modal_detail()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');

			$data = [
				'data_first' => $this->products->getDataDetail($id),
				'data_detail' => $this->detail_products->getDataDetail($id)
			];

			$result = [
				'output' => view('master/products/view_modal_detail', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
}
