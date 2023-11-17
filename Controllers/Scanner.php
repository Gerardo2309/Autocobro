<?php 

	class Scanner extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function scanner(){
			$data['page_id']= 2;
			$data['page_tag']= "Scanner";
			$data['page_title']= "Página principal";
			$data['page_stiles'] = "scanner";
			$data['page_name']= "scanner";
			$data['page_content']= "lorem ";
			$this->views->getView($this,"scanner",$data);

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

		public function getcodebr(){
			$strCodeBr = strClean($_POST['codebar']);

			$request = $this->model->selectCodebr($strCodeBr);
			if (!empty($request)) {
				$arrResponse = array('status' => true, 'msg' => $request);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Articulo No Existe.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function setProducts($arrDatos){
			$arrdatos = json_decode($arrDatos, true);
			$strNumero = strClean($_POST['intNumero']);
			$strColor = strClean($_POST['txtColores']);
			$strVendedor = strClean($_POST['txtVendedor']);
			$strid =intval(date("Ymd"));
			$gafete = $strNumero." ".$strColor;

			foreach($arrdatos as $index){
				$product[] =  array(
				    "0"=>$gafete, 
				    "1"=>$index['id'],
				   	"2"=> $index['cantidad'],
				);
			}

			$request_ProtoCaja = $this->model->insertPtoCaja($strid,$gafete,$strVendedor,);
			if ($request_ProtoCaja >=1) {
				$request_ProDetCaja = $this->model->insertPDetCaja($product);
				$arrResponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente.');
			}else if($request_ProtoCaja == 0){
				$arrResponse = array('status' => false, 'msg' => 'El Gafete ya exste, Quieres agregar la venta?');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function setDetProd($products){
			$cadena = $products;
			$separador = "&";
			$separada = explode($separador, $cadena);
			$arrdatos = json_decode($separada[0], true);
			$gafete = json_decode($separada[1], true);

			foreach($arrdatos as $index){
				$product[] =  array(
				    "0"=>$gafete, 
				    "1"=>$index['id'],
				   	"2"=> $index['cantidad'],
				);
			}
			$request_ProDetCaja = $this->model->insertPDetCaja($product);

			if ($request_ProDetCaja >=1) {
				$arrResponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

	}

?>