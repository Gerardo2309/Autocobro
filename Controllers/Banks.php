<?php 

	class Banks extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function banks(){
			$data['page_id']= 8;
			$data['page_tag']= "Banks";
			$data['page_title']= "Page Banks MxM";
			$data['page_name']= "Banks";
			$data['page_stiles']= "banks";
			$data['page_content']= "For banks to check they list";
			$this->views->getView($this,"banks",$data);

		}

		public function getBanks(){
			$arrData = $this->model->selectBanks();
			for ($i=0; $i <count($arrData); $i++) { 
				$arrData[$i]['options'] = '<div class="text-center"> 
					<button class="btn btn-warning rounded-pill btn-sm btnEditBank" onclick="openModalEditE(this)" id="'.$arrData[$i]['cod_bank'].'"title="EDIT">EDIT<i class="lni lni-checkmark"></i></button>
					<button class="btn btn-danger rounded-pill btn-sm btnEliminar" onclick="openMDelBank(this)" id="'.$arrData[$i]['cod_bank'].'"title="DELET">DELET<i class="lni lni-close"></i></button>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setBank(){
			$strCodebank = strClean(strtoupper($_POST['txtNBank']));
			$strNamebank = strClean(strtoupper($_POST['txtNameB']));
			$strDivisa = strClean(strtoupper($_POST['txtDivisa']));

			$request = $this->model->insertBank($strCodebank,$strNamebank,$strDivisa);

			if ($request > 0) {
				$arrResponse = array('status' => true, 'msg' => 'Data saved successfully.');
			}else if($request == 'exist'){
				$arrResponse = array('status' => false, 'msg' => 'Attention! Bank already exists.');
			}else if($request == 0){
				$arrResponse = array('status' => false, 'msg' => 'It is not possible to store the data.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		/*public function setUpEmploy(){
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
		}*/

		public function setDelBank($code){
			$strCode = strClean($code);
			$request = $this->model->DeletBank($strCode);
			if ($request > 0) {
				$arrResponse = array('status' => true, 'msg' => 'User deleted successfully.');
			}else if ($request == 0){
				$arrResponse = array('status' => false, 'msg' => 'It is not possible to delete the data.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

	}

?>