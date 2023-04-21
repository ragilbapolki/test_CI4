<?php

namespace App\Controllers;

use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends BaseController
{
    protected $db, $builder;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('peoples');
    }

    public function export_pdf()
    {        
		return view('export/pdf');
    }

    public function export_excel()
    {
        $peoples = $this->builder->get()->getResultArray();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Name')
            ->setCellValue('C1', 'Address')
            ->setCellValue('D1', 'Email')
            ->setCellValue('E1', 'Birthdate');

        $column = 2;
        // tulis data mobil ke cell
        $no = 1;
        foreach ($peoples as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $data['name'])
                ->setCellValue('C' . $column, $data['address'])
                ->setCellValue('D' . $column, $data['email'])
                ->setCellValue('E' . $column, $data['birthdate']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Peoples Data';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
