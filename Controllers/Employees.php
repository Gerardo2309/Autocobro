<?php 

	class Employees extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function employees(){
			$data['page_id']= 5;
			$data['page_tag']= "Employees";
			$data['page_title']= "Page Employees MxM";
			$data['page_name']= "Employees";
			$data['page_stiles']= "employees";
			$data['page_content']= "For user to check they list";
			$this->views->getView($this,"employees",$data);

		}

		public function getEmployees(){
			$arrData = $this->model->selectEmployees();
			if (!empty($arrData)) {
				for ($i=0; $i <count($arrData) ; $i++) { 
					$arr_Emprol = $this->model->selectEmprol($arrData[$i]['id_rol']);
					$arrData[$i]['id_rol'] = $arr_Emprol[0]['nom_rol'];
				}
			}

			for ($i=0; $i <count($arrData); $i++) { 
				$arrData[$i]['options'] = '<div class="text-center"> 
					<button class="btn btn-warning rounded-pill btn-sm btnEditEmployee" onclick="openModalEditE(this)" id="'.$arrData[$i]['id_usuario'].'"title="EDIT">EDIT<i class="lni lni-checkmark"></i></button>
					<button class="btn btn-danger rounded-pill btn-sm btnEliminar" onclick="openModalDelE(this)" id="'.$arrData[$i]['id_usuario'].'"title="DELET">DELET<i class="lni lni-close"></i></button>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getEmploy($iduser){
			$striduser = strClean($iduser);
			$arrData = $this->model->selectEmploy($striduser);
			if (!empty($arrData)) {
				$arrResponse = array('status' => true, 'msg' => $arrData);

			}else{
				$arrResponse = array('status' => false, 'msg' => 'Articulo No Existe.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setEmployee(){
			$strUsername = strClean($_POST['txtusername']);
			$strRol = strClean($_POST['txtRol']);
			$strFname = strClean($_POST['txtNames']);
			$strLname = strClean($_POST['txtLNames']);
			$strPassword = strClean($_POST['txtPass']);

			$request = $this->model->insertEmployee($strUsername,$strRol,$strFname,$strLname,$strPassword);

			if ($request > 0) {
				$arrResponse = array('status' => true, 'msg' => 'Data saved successfully.');
			}else if($request == 'exist'){
				$arrResponse = array('status' => false, 'msg' => 'Attention! User already exists.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'It is not possible to store the data.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setUpEmploy(){
			$strOlduser = strClean($_POST['txtolduser']);
			$strUsername = strClean($_POST['txtusername']);
			$strRol = strClean($_POST['txtRol']);
			$strFname = strClean($_POST['txtNames']);
			$strLname = strClean($_POST['txtLNames']);
			$strPassword = strClean($_POST['txtPass']);

			$request = $this->model->UpdateEmployee($strOlduser,$strUsername,$strRol,$strFname,$strLname,$strPassword);

			if ($request > 0) {
				$arrResponse = array('status' => true, 'msg' => 'User edited successfully.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'It is not possible to store the data.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setDelEmploy($iduser){
			$striduser = strClean($iduser);
			$request = $this->model->DeletEmployee($striduser);
			if ($request > 0) {
				$arrResponse = array('status' => true, 'msg' => 'User deleted successfully.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'It is not possible to delete the data.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

	}

?>