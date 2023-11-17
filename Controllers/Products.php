<?php 

	class Products extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function products(){
			$data['page_id']= 7;
			$data['page_tag']= "Products";
			$data['page_title']= "Page Products MxM";
			$data['page_name']= "Products";
			$data['page_stiles']= "products";
			$data['page_content']= "The user can view and edit the products.";
			$this->views->getView($this,"products",$data);

		}

		public function getProduct($code){
			$strCode = strClean($code);
			$arrData = $this->model->selectProduct($strCode);
			if (!empty($arrData)) {
				$arrResponse = array('status' => true, 'msg' => $arrData);
			}else if($arrData == 0){
				$arrResponse = array('status' => false, 'msg' => 'The Product you are looking for does not exist.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getProducts(){
			$arrData = $this->model->selectProducts();

			for ($i=0; $i <count($arrData); $i++) { 
				$arrData[$i]['price'] = '<div class="row"><div class="col-sm-12">$'.$arrData[$i]['preciousd'].'USD</div><div class="col-sm-12">$'.$arrData[$i]['preciomxm'].'MXM</div></div>';
				$arrData[$i]['options'] = '<div class="text-center"> 
					<button class="btn btn-warning rounded-pill btn-sm btnEditEmployee" onclick="openModalEditP(this)" id="'.$arrData[$i]['cod_articulo'].'"title="EDIT">EDIT<i class="lni lni-checkmark"></i></button>
					<button class="btn btn-danger rounded-pill btn-sm btnEliminar" onclick="openModalDelP(this)" id="'.$arrData[$i]['cod_articulo'].'"title="DELET">DELET<i class="lni lni-close"></i></button>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getCategorys(){
			$arrData = $this->model->selectCategorys();
			if (!empty($arrData)) {
				$arrResponse = $arrData;
			}else if($arrData == 0){
				$arrResponse = array('status' => false, 'msg' => 'The category you are looking for does not exist.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setProducts(){
			$strCodebar = strClean(strtoupper($_POST['txtBarcode']));
			$strName = strClean(strtoupper($_POST['txtNPProd']));
			$strStock = strClean(intval($_POST['txtStock']));
			$strMxn = strClean($_POST['txtMxn']);
			$strUsd = strClean($_POST['txtUsd']);
			$strCategory = strClean(strtoupper($_POST['txtCategory']));

			$request = $this->model->insertProducts($strCodebar, $strName, $strCategory, $strUsd, $strMxn, $strStock);

			if ($request > 0) {
				$arrResponse = array('status' => true, 'msg' => 'Data saved successfully.');
			}else if($request == -1){
				$arrResponse = array('status' => false, 'msg' => 'Attention! User already exists.');
			}else if($request == 0){
				$arrResponse = array('status' => false, 'msg' => 'It is not possible to store the data.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function setUpProduct(){
			$strCodebar = strClean(strtoupper($_POST['txtBarcode']));
			$strName = strClean(strtoupper($_POST['txtNPProd']));
			$strStock = strClean(intval($_POST['txtStock']));
			$strMxn = strClean($_POST['txtMxn']);
			$strUsd = strClean($_POST['txtUsd']);
			$strCategory = strClean(strtoupper($_POST['txtCategory']));

			$request = $this->model->UpdateProducts($strCodebar,$strName,$strCategory,$strUsd,$strMxn,$strStock);

			if ($request > 0) {
				$arrResponse = array('status' => true, 'msg' => 'User edited successfully.');
			}else if($request == 0){
				$arrResponse = array('status' => false, 'msg' => 'It is not possible to store the data.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}



		public function setDelProducts($code){
			$strCode = strClean($code);
			$request = $this->model->DeletProducts($strCode);
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