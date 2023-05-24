<?php

namespace App\Controllers\Transaction;

use TCPDF;
use App\Controllers\BaseController;
use App\Models\Master\{CategoryModel, EmployeeModel, StageModel};
use App\Models\Transaction\{CarpModel, CarpProgressModel};

class CarpPICController extends BaseController
{	
	protected $employee;
	protected $category;
	protected $carp;
	protected $stage;
	protected $carp_progress;

	public function __construct()
	{
		$this->employee 		= new EmployeeModel();
		$this->category 		= new CategoryModel();
		$this->carp 			= new CarpModel();
		$this->stage 			= new StageModel();
		$this->carp_progress	= new CarpProgressModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Data CARP PIC',
		];

		return view('transaction/your_carp/index', $data);
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$data = [
				'data_carp_pic' => $this->carp->getDataCarpPIC()
			];

			$result = [
				'output' => view('transaction/your_carp/view_data', $data)
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
				'data_first' => $this->carp->getDataDetail($id),
			];

			$result = [
				'output' => view('transaction/your_carp/view_modal_detail', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
	
	public function update_stage()
	{
		if ($this->request->isAJAX()) {
				$id 		= $this->request->getPost('id');
				$stage 		= $this->request->getPost('stage');
				$data_stage = $this->stage->find($stage);

				$this->carp->update($id, [
					'stage' 		=> $stage,
					'status' 		=> $data_stage['status_id'],
					'status_date' 	=> date("Y-m-d"),
					'updated_by' 	=> user()->id
				]);

				$result = [
					'success' => 'Data has been updated from database'
				];
			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function get_progress()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getVar('id');
			$data = [
				'data_carp_progress'=> $this->carp_progress->getDataProgress($id),
				'data_first' 		=> $this->carp->getDataDetail($id),
			];

			$result = [
				'output' => view('transaction/your_carp/view_progress', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
	
	public function save_progress()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();
			$this->carp_progress->insert([
				'carp_id' 		=> strip_tags($this->request->getPost('id')),
				'description' 	=> strip_tags($this->request->getPost('description')),
			]);

			$result = [
				'success' => 'Data has been added to database'
			];
			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
	
}
