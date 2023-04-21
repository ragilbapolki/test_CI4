<?php

namespace App\Controllers\Transaction;

use TCPDF;
use App\Controllers\BaseController;
use App\Models\Master\{ProductsModel, CustomerModel};
use App\Models\Transaction\{OrderModel, OrderDetailModel};

class OrderController extends BaseController
{
	protected $order;
	protected $products;
	protected $customer;
	protected $order_detail;

	public function __construct()
	{
		$this->order = new OrderModel();
		$this->products = new ProductsModel();
		$this->customer = new CustomerModel();
		$this->order_detail = new OrderDetailModel();
	}

	public function index()
	{
		$max_id 		= $this->order->getMaxId();
		$set_id 		= empty($max_id[0]['id'])? 0 : $max_id[0]['id'];
		$current_date	= date("Y/m/d");
		$data = [
			'title' 		=> 'Form Order',
			'customer' 		=> $this->customer->getDataCustomer(),
			'data_products' => $this->products->getDataProducts(),
			'customer' 		=> $this->customer->getDataCustomer(),
			'no_invoice' 	=> 'INV/'. $current_date .'/'. ($set_id + 1)
		];

		return view('transaction/order/form_order', $data);
	}
	
	public function index_print_pdf()
	{
		return view('transaction/order/index_print_pdf');
	}

	public function get_data()
	{
		if ($this->request->isAJAX()) {
			$start_date 	= date_format(date_create($this->request->getVar('p_start_date')),"Y-m-d");
			$end_date 		= date_format(date_create($this->request->getVar('p_end_date')),"Y-m-d");
			
			$data = [
				'data_order' => $this->order->getDataOrderParam($start_date,$end_date)
			];
			$result = [
				'output' => view('transaction/order/view_data_report', $data)
			];
			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function get_modal_pay()
	{
		if ($this->request->isAJAX()) {
			$data = [
				'customer' => $this->customer->getDataCustomer()
			];

			$result = [
				'output' => view('transaction/order/view_modal',$data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}

	public function save_data()
	{
		if ($this->request->isAJAX()) {
				$type_btn		= $this->request->getPost('type_btn');
				$no				= $this->request->getPost('no_invoice');
				$date 			= date("Y-m-d H:i:s");
				$customer_id	= $this->request->getPost('customer_id');
				$total_price 	= $this->request->getPost('moneys');
				$total_payment 	= $this->request->getPost('total_payment');
				$change 		= $this->request->getPost('change');
				$detail			= $this->request->getPost('detail');

				$data_order = $this->order->insert([
					'no'			=> $no,
					'date' 			=> $date,
					'customer_id'	=> $customer_id,
					'moneys'		=> $total_price,
					'total_payment'	=> $total_payment,
					'change'		=> $change,
					'created_by'	=> user()->id
				]);
                foreach ($detail as $detail) {
					$data_detail    = explode(",", $detail);
					$this->order_detail->insert([
						'order_id' 			=> $data_order,
						'product_id' 		=> $data_detail[0],
						'price' 			=> $data_detail[3],
						'quantity' 			=> $data_detail[4],
						'total_price' 		=> $data_detail[5],
						'created_by'		=> user()->id
					]);
					$get_products = $this->products->find($data_detail[0]);

					$this->products->update($data_detail[0], [
						'stock' 		=> ($get_products['stock']-$data_detail[4]),
						'updated_by' 	=> user()->id
					]);
				}
				$result = [
					'success' => 'Data has been added to database',
					'id'	  => $data_order
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
				'data_first' => $this->order->getDataDetail($id),
				'data_detail' => $this->order_detail->getDataDetail($id)
			];

			$result = [
				'output' => view('transaction/order/view_modal_detail', $data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
	
    public function export_pdf()
    {
		$id = $this->request->getVar('id');
		$data = [
			'data_first' => $this->order->getDataDetail($id),
			'data_detail' => $this->order_detail->getDataDetail($id)
		];

        $html = view('export/pdf', $data);

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');


        // set margins
        // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
        // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage('P', 'A6');


        // Print text using writeHTMLCell()
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('invoice.pdf', 'I');
    }
}
