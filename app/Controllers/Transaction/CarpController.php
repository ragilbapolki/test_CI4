<?php

namespace App\Controllers\Transaction;

use TCPDF;
use App\Controllers\BaseController;
use App\Models\Master\{CategoryModel, EmployeeModel, StageModel};
use App\Models\Transaction\{CarpModel};

class CarpController extends BaseController
{	
	protected $employee;
	protected $category;
	protected $carp;
	protected $stage;

	public function __construct()
	{
		$this->employee = new EmployeeModel();
		$this->category = new CategoryModel();
		$this->carp 	= new CarpModel();
		$this->stage 	= new StageModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Data CARP',
		];

		return view('transaction/carp/index', $data);
	}
	

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$data = [
				'data_carp' => $this->carp->getDataCarp()
			];

			$result = [
				'output' => view('transaction/carp/view_data', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function get_modal()
	{
		if ($this->request->isAJAX()) {
			$max_id 		= $this->carp->getMaxId();
			$get_max_id 	= empty($max_id[0]['id'])? 0 : $max_id[0]['id'];
			$set_id			= $get_max_id + 1;
	
			if (strlen($get_max_id) == 1) {
				$set_id = '0000' . $set_id;
			} elseif (strlen($get_max_id) == 2) {
				$set_id = '000' . $set_id;
			} elseif (strlen($get_max_id) == 3) {
				$set_id = '00' . $set_id;
			} elseif (strlen($get_max_id) == 4) {
				$set_id = '0' . $set_id;
			}
	
			$data = [
				'data_initiator_by' => $this->employee->getDataEmployeeCombo(),
				'data_recipient_by' => $this->employee->getDataEmployeeCombo(),
				'data_verified_by' 	=> $this->employee->getDataEmployeeCombo(),
				'data_category' 	=> $this->category->getDataCategory(),
				'data_stage' 		=> $this->stage->getDataStage(),
				'code_carp' 		=> 'CARP'.($set_id)
			];
			$result = [
				'output' => view('transaction/carp/view_modal', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function save_data()
	{
		if ($this->request->isAJAX()) {
				$code			= $this->request->getPost('code');
				$category		= $this->request->getPost('category');
				$initiator		= $this->request->getPost('initiator');
				$recipient		= $this->request->getPost('recipient');
				$verified		= $this->request->getPost('verified');
				$effectiveness	= $this->request->getPost('effectiveness');
				$due_date		= date_format(date_create($this->request->getPost('due_date')),"Y-m-d");

				$data_carp = $this->carp->insert([
					'code'			=> $code,
					'category_id' 	=> $category,
					'initiator_by'	=> $initiator,
					'recipient_by'	=> $recipient,
					'verified_by'	=> $verified,
					'due_date'		=> $due_date,
					'effectiveness'		=> $effectiveness,
					'created_by'	=> user()->id
				]);
				$result = [
					'success' => 'Data has been added to database',
				];
			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

}
