<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Master\{EmployeeModel};
use App\Models\Administrator\UserModel;

class UserController extends BaseController
{
	protected $branch;
	protected $employee;
	
	public function __construct()
	{
		$this->user 	= new UserModel();
		$this->employee = new EmployeeModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Setting User',
		];

		return view('administrator/setting_user/index', $data);
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$data = [
				'data_user' => $this->user->getDataUser()
			];

			$result = [
				'output' => view('administrator/setting_user/view_data', $data)
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
				'data_employee' => $this->employee->getDataEmployeeCombo(),
				'data_user' 	=> $this->user->getDataUserCombo(),
			];
			
			$result = [
				'output' => view('administrator/setting_user/view_modal', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function save_data()
	{
		if ($this->request->isAJAX()) {
				$id = $this->request->getPost('username');

				$this->user->update($id, [
					'employee_id' 	=> strip_tags($this->request->getPost('employee')),
				]);

				$result = [
					'success' => 'Data has been added to database'
				];
			echo json_encode($result);
		}
	}

	public function get_modal_edit()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');

			$row = $this->branch->find($id);

			$data = [
				'id'			=> $row['id'],
				'name'			=> $row['name'],
				'code'			=> $row['code'],
				'description'	=> $row['description']
			];

			$result = [
				'output' => view('master/branch/view_modal_edit', $data)
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
				'code' 			=> ['label' => 'code','rules' => 'required'],
				'description' 	=> ['label' => 'description','rules' => 'required'],
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' 			=> $validation->getError('name'),
						'code' 			=> $validation->getError('code'),
						'description' 	=> $validation->getError('description')
					]
				];
			} else {
				$id = $this->request->getPost('id');
				$this->branch->update($id, [
					'name' 			=> strip_tags($this->request->getPost('name')),
					'code' 			=> strip_tags($this->request->getPost('code')),
					'description' 	=> strip_tags($this->request->getPost('description')),
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
			$this->branch->update($id, [
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
