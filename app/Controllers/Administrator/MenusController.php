<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Models\Administrator\MenusModel;

class MenusController extends BaseController
{
	protected $menus;

	public function __construct()
	{
		$this->menus = new MenusModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Menus'
		];

		return view('administrator/products/index', $data);
	}

	public function get_data()
	{
			
		$records = $this->menus->where('parent_id', 0)->findAll();
		$i = 0;
		
        foreach($records as $records){
            $records[$i]->sub = $this->get_sub_menu($records->id);
            $i++;
        }
        return $categories;
	}

	public function get_sub_menu($id)
	{
		$records = $this->menus->where('parent_id', $id)->findAll();
        $i=0;
        foreach($records as $records){
            $records[$i]->sub = $this->get_sub_menu($records->id);
            $i++;
        }
        return $records; 
	}
	public function fetch_menu($data){
			$menu1 = "";
		foreach($data as $menu){
			$menu1 .= "<li><a href=".site_url('parent-menu/'.$menu->slug).">".$menu->category_name."</a>";

			if(!empty($menu->sub)){

				$menu1 .= "<ul>";

				$menu1 .= $this->fetch_sub_menu($menu->sub);

				$menu1 .= "</ul>";
			}
			$menu1 .= '</li>';
		}
		return $menu1;
	}

	public function fetch_sub_menu($sub_menu){
		$sub = "";
		foreach($sub_menu as $menu){

			$sub .= "<li><a href=".site_url('child-menu/'.$menu->id).">".$menu->name_menu."</a>";
			
			if(!empty($menu->sub)){

				$sub .= "<ul>";

				$sub .= $this->fetch_sub_menu($menu->sub);

				$sub .= "</ul>";
			}		
			$sub .= '</li>';
		}
		return $sub;
	}

	public function update_data()
	{
		if ($this->request->isAJAX()) {
			$validation = \Config\Services::validation();

			$rules = $this->validate([
				'name' => [
					'label' => 'product name',
					'rules' => 'required|min_length[3]',
				],
				'description' => [
					'label' => 'product desc',
					'rules' => 'required|min_length[3]',
				],
				'price' => [
					'label' => 'product price',
					'rules' => 'required|numeric',
				],
				'date' => [
					'label' => 'product date',
					'rules' => 'required',
				]
			]);

			if (!$rules) {
				$result = [
					'error' => [
						'name' => $validation->getError('name'),
						'description' => $validation->getError('description'),
						'price' => $validation->getError('price'),
						'date' => $validation->getError('date')
					]
				];
			} else {
				$id = $this->request->getPost('id');
				$this->ajax->update($id, [
					'name' => strip_tags($this->request->getPost('name')),
					'description' => strip_tags($this->request->getPost('description')),
					'price' => strip_tags($this->request->getPost('price')),
					'date' => strip_tags($this->request->getPost('date'))
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

			$this->ajax->delete($id);

			$result = [
				'output' => "Data has been deleted from database"
			];

			echo json_encode($result);
		} else {
			exit('404 Not Found');
		}
	}
}
