<?php

namespace App\Controllers;
use App\Models\Transaction\{CarpModel};

class DashboardController extends BaseController
{	
    
    protected $carp;
    
	public function __construct()
	{
		$this->carp 	= new CarpModel();
	}

    public function index()
    {
        $start_date 	= null;
        $end_date 		= null;
        
        $data = [
            'title'           => 'Starter Project CodeIgniter 4',
            'count_open'      => $this->carp->getCount(17,$start_date,$end_date),
            'count_voided'    => $this->carp->getCount(18,$start_date,$end_date),
            'count_closed'    => $this->carp->getCount(19,$start_date,$end_date),
            'count_reopen'    => $this->carp->getCount(20,$start_date,$end_date),
            'count_verified'  => $this->carp->getCount(21,$start_date,$end_date),
            'count_responded' => $this->carp->getCount(22,$start_date,$end_date),
            'count_draft'     => $this->carp->getCount(23,$start_date,$end_date),
            'count_submitted' => $this->carp->getCount(24,$start_date,$end_date),
        ];

        return view('dashboard/index', $data);
    }

    public function get_data_chart_sales()
    {
        $start_date 	= $this->request->getVar('p_start_date');
        $end_date 		= $this->request->getVar('p_end_date');
        
        $data = [
        ];

        echo json_encode($data);
    }
    
    public function get_data_chart_status()
    {
        $start_date 	= $this->request->getVar('p_start_date');
        $end_date 		= $this->request->getVar('p_end_date');
        
        $data = [
            'data_status'   => $this->carp->getDataChartStatus($start_date,$end_date),
        ];

        echo json_encode($data);
    }
    
    public function get_data_chart_bar()
    {
        $start_date 	= $this->request->getVar('p_start_date');
        $end_date 		= $this->request->getVar('p_end_date');
        
        $data = [
            'data_status'   => $this->carp->getDataChartBar($start_date,$end_date),
        ];

        echo json_encode($data);
    }
    
    public function get_data_dashboard()
    {
        $start_date 	= $this->request->getVar('p_start_date');
        $end_date 		= $this->request->getVar('p_end_date');
        
        $data = [
            'count_open'      => $this->carp->getCount(17,$start_date,$end_date),
            'count_voided'    => $this->carp->getCount(18,$start_date,$end_date),
            'count_closed'    => $this->carp->getCount(19,$start_date,$end_date),
            'count_reopen'    => $this->carp->getCount(20,$start_date,$end_date),
            'count_verified'  => $this->carp->getCount(21,$start_date,$end_date),
            'count_responded' => $this->carp->getCount(22,$start_date,$end_date),
            'count_draft'     => $this->carp->getCount(23,$start_date,$end_date),
            'count_submitted' => $this->carp->getCount(24,$start_date,$end_date),
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
                'title'     => 'Detail',
				"data"      => $this->carp->getDataInfo($p_data,$start_date,$end_date)
			];
			$result = [
				'output' => view('dashboard/view_modal_info',$data)
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
}