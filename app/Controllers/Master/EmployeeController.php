<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\Master\{EmployeeModel, BranchModel, DivModel, PositionModel};

class EmployeeController extends BaseController
{
	protected $employee;
	protected $branch;
	protected $div;
	protected $position;
	
	public function __construct()
	{
		$this->employee = new EmployeeModel();
		$this->branch = new BranchModel();
		$this->div = new DivModel();
		$this->position = new PositionModel();
	}

	public function index()
	{
		$data = [
			'title' 		=> 'Data Employee',
			'data_branch' 	=> $this->branch->getDataBranch(),
			'data_div' 		=> $this->div->getDataDiv(),
			'data_position' => $this->position->getDataPosition(),
		];

		return view('master/employee/index', $data);
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {

			$data = [
				'data_employee' => $this->employee->getDataEmployee()
			];

			$result = [
				'output' => view('master/employee/view_data', $data)
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
				'data_branch' 	=> $this->branch->getDataBranch(),
				'data_div' 		=> $this->div->getDataDiv(),
				'data_position' => $this->position->getDataPosition(),
			];
			
			$result = [
				'output' => view('master/employee/view_modal', $data)
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
				'name' 	  		=> ['label' => 'name','rules' => 'required|min_length[3]'],
				'phone' 		=> ['label' => 'phone','rules' => 'required'],
				'address' 		=> ['label' => 'address','rules' => 'required'],
				'position' 		=> ['label' => 'position','rules' => 'required'],
				'division' 		=> ['label' => 'division','rules' => 'required'],
				'branch'		=> ['label' => 'branch','rules' => 'required'],
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' 				=> $validation->getError('name'),
						'phone' 			=> $validation->getError('phone'),
						'address'	 		=> $validation->getError('address'),
						'select_position'	=> $validation->getError('position'),
						'select_division'	=> $validation->getError('division'),
						'select_branch' 	=> $validation->getError('branch')
					]
				];
			} else {
				$name 		= strip_tags($this->request->getPost('name'));
				$phone 		= strip_tags($this->request->getPost('phone'));
				$address 	= strip_tags($this->request->getPost('address'));
				$pos_id 	= strip_tags($this->request->getPost('position'));
				$div_id 	= strip_tags($this->request->getPost('division'));
				$brach_id 	= strip_tags($this->request->getPost('branch'));

				$store = $this->employee->insert([
					'name' 			=> $name,
					'phone' 		=> $phone,
					'address' 		=> $address,
					'pos_id' 		=> $pos_id,
					'div_id' 		=> $div_id,
					'brach_id' 		=> $brach_id,
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
				'records'		=> $this->employee->find($id),
				'data_branch' 	=> $this->branch->getDataBranch(),
				'data_div' 		=> $this->div->getDataDiv(),
				'data_position' => $this->position->getDataPosition(),
			];

			$result = [
				'output' => view('master/employee/view_modal_edit', $data)
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
				'name' 	  		=> ['label' => 'name','rules' => 'required|min_length[3]'],
				'phone' 		=> ['label' => 'phone','rules' => 'required'],
				'address' 		=> ['label' => 'address','rules' => 'required'],
				'position' 		=> ['label' => 'position','rules' => 'required'],
				'division' 		=> ['label' => 'division','rules' => 'required'],
				'branch'		=> ['label' => 'branch','rules' => 'required'],
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' 				=> $validation->getError('name'),
						'phone' 			=> $validation->getError('phone'),
						'address'	 		=> $validation->getError('address'),
						'select_position'	=> $validation->getError('position'),
						'select_division'	=> $validation->getError('division'),
						'select_branch' 	=> $validation->getError('branch')
					]
				];
			} else {
				$id 		= $this->request->getPost('id');
				$name 		= strip_tags($this->request->getPost('name'));
				$phone 		= strip_tags($this->request->getPost('phone'));
				$address 	= strip_tags($this->request->getPost('address'));
				$pos_id 	= strip_tags($this->request->getPost('position'));
				$div_id 	= strip_tags($this->request->getPost('division'));
				$brach_id 	= strip_tags($this->request->getPost('branch'));

				$this->employee->update($id, [
					'name' 			=> $name,
					'phone' 		=> $phone,
					'address' 		=> $address,
					'pos_id' 		=> $pos_id,
					'div_id' 		=> $div_id,
					'brach_id' 		=> $brach_id,
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
			$this->employee->update($id, [
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
