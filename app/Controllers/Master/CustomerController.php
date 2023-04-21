<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Master\CustomerModel;

class CustomerController extends BaseController
{
	protected $customer;

	public function __construct()
	{
		$this->customer = new CustomerModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Master Customer'
		];

		return view('master/customer/index', $data);
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$data = [
				'data_customer' => $this->customer->getDataCustomer()
			];

			$result = [
				'output' => view('master/customer/view_data', $data)
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
				'output' => view('master/customer/view_modal')
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
				'genre' 		=> ['label' => 'genre','rules' => 'required'],
				'phone' 		=> ['label' => 'phone','rules' => 'required'],
				'note' 			=> ['label' => 'note','rules' => 'required']
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' 			=> $validation->getError('name'),
						'select_genre' 	=> $validation->getError('genre'),
						'phone' 		=> $validation->getError('phone'),
						'note' 			=> $validation->getError('note')
					]
				];
			} else {
				$this->customer->insert([
					'name' 			=> strip_tags($this->request->getPost('name')),
					'genre' 		=> strip_tags($this->request->getPost('genre')),
					'address' 		=> strip_tags($this->request->getPost('address')),
					'phone' 		=> strip_tags($this->request->getPost('phone')),
					'note' 			=> strip_tags($this->request->getPost('note')),
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

			$row = $this->customer->find($id);

			$data = [
				'id'			=> $row['id'],
				'name'			=> $row['name'],
				'genre'			=> $row['genre'],
				'address'		=> $row['address'],
				'phone'			=> $row['phone'],
				'note'			=> $row['note'],
			];

			$result = [
				'output' => view('master/customer/view_modal_edit', $data)
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
				'genre' 		=> ['label' => 'genre','rules' => 'required'],
				'phone' 		=> ['label' => 'phone','rules' => 'required'],
				'note' 			=> ['label' => 'note','rules' => 'required']
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' 			=> $validation->getError('name'),
						'select_genre' 	=> $validation->getError('genre'),
						'phone' 		=> $validation->getError('phone'),
						'note' 			=> $validation->getError('note')
					]
				];
			} else {
				$id = $this->request->getPost('id');
				$this->customer->update($id, [
					'name' 			=> strip_tags($this->request->getPost('name')),
					'genre' 		=> strip_tags($this->request->getPost('genre')),
					'address' 		=> strip_tags($this->request->getPost('address')),
					'phone' 		=> strip_tags($this->request->getPost('phone')),
					'note' 			=> strip_tags($this->request->getPost('note')),
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
			$this->customer->update($id, [
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
