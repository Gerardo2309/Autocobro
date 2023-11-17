<?php 

	class Discounts extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function discounts(){
			$data['page_id']= 6;
			$data['page_tag']= "Discounts";
			$data['page_title']= "Page Discounts MxM";
			$data['page_name']= "Discounts";
			$data['page_stiles']= "discounts";
			$data['page_content']= "The user can view and edit the discount percentage.";
			$this->views->getView($this,"discounts",$data);

		}

		public function getDiscounts(){

			$request = $this->model->selectDiscounts();
			if (!empty($request)) {
				$arrResponse = array('status' => true, 'msg' => $request);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No Hay Descuentos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setUpDiscount(){
			$strUser = strClean($_POST['txtuser']);
			$strDiscount = intval($_POST['txtDiscount']);
			$strIdform = intval($_POST['txtidform']);

			$request_detalle = $this->model->insertDtDiscount($strUser);

			$request = $this->model->updateDiscount($strDiscount,$request_detalle[0]['id_detalle']);

			if($request == 0){
				$arrResponse = array('status' => false, 'msg' => 'The discount has not been successful, do you want to add it?');
			}else if ($request > 0) {
				$arrResponse = array('status' => true, 'msg' => 'User edited successfully.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'It is not possible to store the data.');
			}

			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setDiscount(){
			$strUser = strClean($_POST['txtuser']);
			$strDiscount = intval($_POST['txtDiscount']);

			$request_detalle = $this->model->insertDtDiscount($strUser);

			$request = $this->model->insertDiscount($strDiscount,$request_detalle[0]['id_detalle']);

			if ($request > 0) {
				$arrResponse = array('status' => true, 'msg' => 'User edited successfully.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'It is not possible to store the data.');
			}

			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

	}
?>