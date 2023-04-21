<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Master\StoreModel;

class StoreController extends BaseController
{
	protected $store;

	public function __construct()
	{
		$this->store = new StoreModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Master Store'
		];

		return view('master/store/index', $data);
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$data = [
				'data_store' => $this->store->getDataStore()
			];

			$result = [
				'output' => view('master/store/view_data', $data)
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
				'output' => view('master/store/view_modal')
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
				'phone' 		=> ['label' => 'phone','rules' => 'required'],
				'address' 		=> ['label' => 'address','rules' => 'required'],
				'note' 			=> ['label' => 'note','rules' => 'required'],
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' 			=> $validation->getError('name'),
						'phone' 		=> $validation->getError('phone'),
						'address' 		=> $validation->getError('address'),
						'note' 			=> $validation->getError('note')
					]
				];
			} else {
				$this->store->insert([
					'name' 			=> strip_tags($this->request->getPost('name')),
					'phone' 		=> strip_tags($this->request->getPost('phone')),
					'address' 		=> strip_tags($this->request->getPost('address')),
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

			$row = $this->store->find($id);

			$data = [
				'id'			=> $row['id'],
				'name'			=> $row['name'],
				'address'		=> $row['address'],
				'phone'			=> $row['phone'],
				'note'			=> $row['note'],
			];

			$result = [
				'output' => view('master/store/view_modal_edit', $data)
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
				'phone' 		=> ['label' => 'phone','rules' => 'required'],
				'address' 		=> ['label' => 'address','rules' => 'required'],
				'note' 			=> ['label' => 'note','rules' => 'required'],
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' 			=> $validation->getError('name'),
						'phone' 		=> $validation->getError('phone'),
						'address' 		=> $validation->getError('address'),
						'note' 			=> $validation->getError('note')
					]
				];
			} else {
				$id = $this->request->getPost('id');
				$this->store->update($id, [
					'name' 			=> strip_tags($this->request->getPost('name')),
					'phone' 		=> $this->request->getPost('phone'),
					'address' 		=> strip_tags($this->request->getPost('address')),
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
			$this->store->update($id, [
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
