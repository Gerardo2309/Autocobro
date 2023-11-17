<?php 

	class Dashboard extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function dashboard(){
			$data['page_id']= 4;
			$data['page_tag']= "Dashboard";
			$data['page_title']= "Dashboard Mexico Magico";
			$data['page_name']= "Dashboard";
			$data['page_stiles']= "dashboard";
			$data['page_content']= "esto es dela dashboard ";
			$this->views->getView($this,"dashboard",$data);

		}

		public function getVentas(){

			$request = $this->model->selectVentas();
			if (!empty($request)) {
				$arrResponse = array('status' => true, 'msg' => $request);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No Hay Ventas');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getEmployee(){

			$request = $this->model->selecEmployee();
			if (!empty($request)) {
				$arrResponse = array('status' => true, 'msg' => $request);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No Hay Ventas');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getArticulos(){

			$request = $this->model->selecArticulos();
			if (!empty($request)) {
				$arrResponse = array('status' => true, 'msg' => $request);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Todos los articulos tienen Stock');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}	

	}

?>