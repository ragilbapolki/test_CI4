<?php

namespace App\Controllers;
use App\Models\Master\{ProductsModel, CustomerModel, SupplierModel};
use App\Models\Transaction\{OrderModel, OrderDetailModel, StockModel};

class DashboardController extends BaseController
{
	protected $stock;
	protected $order;
	protected $products;
	protected $customer;
	protected $supplier;
	protected $order_detail;
    
	public function __construct()
	{
		$this->stock = new StockModel();
		$this->order = new OrderModel();
		$this->products = new ProductsModel();
		$this->customer = new CustomerModel();
		$this->supplier = new SupplierModel();
		$this->order_detail = new OrderDetailModel();
	}

    public function index()
    {
        $start_date 	= null;
        $end_date 		= null;
        
        $data = [
            'title'           => 'Starter Project CodeIgniter 4',
            'count_order'     => $this->order->getCount($start_date,$end_date),
            'count_customer'  => $this->customer->getCount($start_date,$end_date),
            'count_supplier'  => $this->supplier->getCount($start_date,$end_date),
            'count_products'  => $this->products->getCount($start_date,$end_date),
            'sum_stoc'        => $this->products->getSumStock($start_date,$end_date),
            'sum_stoc_in'     => $this->stock->getSumStockIn($start_date,$end_date),
            'sum_stoc_out'    => $this->stock->getSumStockOut($start_date,$end_date),
        ];

        return view('dashboard/index', $data);
    }

    public function get_data_chart_sales()
    {
        $start_date 	= $this->request->getVar('p_start_date');
        $end_date 		= $this->request->getVar('p_end_date');
        
        $data = [
            'data_order'      => $this->order_detail->getDataChart($start_date,$end_date),
        ];

        echo json_encode($data);
    }
    
    public function get_data_chart_category()
    {
        $start_date 	= $this->request->getVar('p_start_date');
        $end_date 		= $this->request->getVar('p_end_date');
        
        $data = [
            'data_products'      => $this->products->getDataChartCategory($start_date,$end_date),
        ];

        echo json_encode($data);
    }
    
    public function get_data_dashboard()
    {
        $start_date 	= $this->request->getVar('p_start_date');
        $end_date 		= $this->request->getVar('p_end_date');
        
        $data = [
            'count_order'     => $this->order->getCount($start_date,$end_date),
            'count_customer'  => $this->customer->getCount($start_date,$end_date),
            'count_supplier'  => $this->supplier->getCount($start_date,$end_date),
            'count_products'  => $this->products->getCount($start_date,$end_date),
            'sum_stoc'        => $this->products->getSumStock($start_date,$end_date),
            'sum_stoc_in'     => $this->stock->getSumStockIn($start_date,$end_date),
            'sum_stoc_out'    => $this->stock->getSumStockOut($start_date,$end_date),
        ];

        echo json_encode($data);
    }
    
	public function get_modal_info()
	{
		if ($this->request->isAJAX()) {
            $start_date 	= $this->request->getVar('p_start_date');
            $end_date 	    = $this->request->getVar('p_end_date');
            $p_data 		= $this->request->getVar('p_data');
			$data = [
                'title'           => 'Detail '. $p_data,
				"".$p_data.""     => $this->$p_data->getDataInfo($start_date,$end_date)
			];
			$result = [
				'output' => view('dashboard/view_modal_info_'.$p_data,$data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
	public function get_modal_info_stock()
	{
		if ($this->request->isAJAX()) {
            $start_date 	= $this->request->getVar('p_start_date');
            $end_date 	    = $this->request->getVar('p_end_date');
            $p_data 		= $this->request->getVar('p_data');
			$data = [
                'title'           => 'Stock '. $p_data,
				'stock'           => $this->stock->getDataInfo($start_date,$end_date,$p_data)
			];
			$result = [
				'output' => view('dashboard/view_modal_info_stock',$data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
}