<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Master\CategoryProductsModel;

class CategoryProductsController extends BaseController
{
	protected $category_products;

	public function __construct()
	{
		$this->category_products = new CategoryProductsModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Master Categories'
		];

		return view('master/category_products/index', $data);
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$data = [
				'data_category_products' => $this->category_products->getDataCategory()
			];

			$result = [
				'output' => view('master/category_products/view_data', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function get_modal()
	{
		if ($this->request->isAJAX()) {
			$result = [
				'output' => view('master/category_products/view_modal')
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
				'name' 			=> ['label' => 'name','rules' => 'required|min_length[3]'],
				'description' 	=> ['label' => 'desc','rules' => 'required'],
				'code' 			=> ['label' => 'code','rules' => 'required']
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' 			=> $validation->getError('name'),
						'description' 	=> $validation->getError('description'),
						'code' 			=> $validation->getError('code')
					]
				];
			} else {
				$this->category_products->insert([
					'name' 		  	=> strip_tags($this->request->getPost('name')),
					'description' 	=> strip_tags($this->request->getPost('description')),
					'code' 		 	=> strip_tags($this->request->getPost('code')),
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

			$row = $this->category_products->find($id);

			$data = [
				'id'			=> $row['id'],
				'name'			=> $row['name'],
				'description'	=> $row['description'],
				'code'			=> $row['code']
			];

			$result = [
				'output' => view('master/category_products/view_modal_edit', $data)
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
				'name' 			=> ['label' => 'name','rules' => 'required|min_length[3]'],
				'description' 	=> ['label' => 'desc','rules' => 'required'],
				'code' 			=> ['label' => 'code','rules' => 'required']
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' => $validation->getError('name'),
						'description' => $validation->getError('description'),
						'code' => $validation->getError('code')
					]
				];
			} else {
				$id = $this->request->getPost('id');
				$this->category_products->update($id, [
					'name' => strip_tags($this->request->getPost('name')),
					'description' => strip_tags($this->request->getPost('description')),
					'code' => strip_tags($this->request->getPost('code')),
					'updated_by' => user()->id
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
			$this->category_products->update($id, [
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
}
