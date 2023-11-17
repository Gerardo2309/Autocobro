<?php 

	class Caja extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function caja(){
			$data['page_id']= 3;
			$data['page_tag']= "Caja";
			$data['page_title']= "Caja Mexico Magico";
			$data['page_stiles'] = "caja";
			$data['page_name']= "caja";
			$data['page_content']= "esto es dela caja ";
			$this->views->getView($this,"caja",$data);

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

		public function getinicio(){

			$request = $this->model->selectInicio();
			if (!empty($request)) {
				$arrResponse = array('status' => true, 'msg' => $request);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Articulo No Existe.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}
		
		public function getgfts(){
			$strGft = strClean($_POST['gafete']);
			$request_gft = $this->model->selectgfts($strGft);
			foreach ($request_gft as $index) {
				$request_prod = $this->model->selectprogft($index['cod_articulo'],$index['id_usuario']);
				$nuevo_request = array_pop($request_prod);
				$product[] =  array(
				    "gafete"=>$strGft, 
				    "codigobar"=>$index['cod_articulo'],
				   	"nombres"=> $nuevo_request['nom_articulo'],
				   	"preciousd"=> $nuevo_request['preciousd'],
				   	"preciomxm"=> $nuevo_request['preciomxm'],
				   	"cantidad"=> $index['cantidad'],
				   	"stock"=> $nuevo_request['stock']-$index['cantidad'],
				   	"vendedor"=> $index['id_usuario']
				);
			}
			if (!empty($product)) {
				$arrResponse = array('status' => true, 'msg' => $product);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Articulo No Existe.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getBankcode(){
			$strCode = strClean($_POST['codebar']);

			$request = $this->model->selectBankcode($strCode);
			if (!empty($request)) {
				$arrResponse = array('status' => true, 'msg' => $request);
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Articulo No Existe.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}


		public function setVenta($products){
			$cadena = $products;
			$separador = "&";
			$separada = explode($separador, $cadena);

			$strNumero = strClean($_POST['intNumero']);
			$strColor = strClean($_POST['txtColores']);
			$strVendedor = strClean($_POST['txtVendedor']);
			$strCajero = strClean($_POST['txtCajero']);

			$productos = json_decode($separada[0], true);
			$banco = json_decode($separada[1], true);
			$pagototal = json_decode($separada[2], true);
			$gafete = $strNumero." ".$strColor;

			if ($banco[0]['mxn_usd'] == 'MXN') {
				$venta =[
				    "0"=>$pagototal[0],
				    "1"=>$gafete,
				    "2"=> $banco[0]['cod_bank'],
				  	"3"=> $banco[0]['mxn_usd'],
				  	"4"=> $strVendedor,
					"5"=> $strCajero
				];
			}else if($banco[0]['mxn_usd'] == 'USD'){
				$venta =[
				    "0"=>$pagototal[1],
				    "1"=>$gafete,
				    "2"=> $banco[0]['cod_bank'],
				  	"3"=> $banco[0]['mxn_usd'],
				  	"4"=> $strVendedor,
					"5"=> $strCajero
				];
			}

			$request_Ventas = $this->model->insertVenta($venta);
			if (!empty($request_Ventas)) {
				foreach($productos as $index){
					$dtventa[] =  array(
					    "0"=>$request_Ventas[0]['idventa'],
					    "1"=>$index['id'],
					   	"2"=> $index['cantidad'],
					);
				}
				$request_Dtventas = $this->model->insertDtventa($dtventa);

			}

			if ($request_Dtventas > 0) {
				$arrResponse = array('status' => true, 'msg' => 'Datos Guardados Correctamente.');
			}else if($request_Dtventas == 'exist'){
				$arrResponse = array('status' => false, 'msg' => '¡Atencion! El LA venta ya exste.');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getDropGft(string $Gft){
			$strGft = strClean($Gft);
			if ($strGft  != '') {
				$arrData = $this->model->DropGft($strGft);
				if (empty($arrData)) {
					$arrResponse = array('status' => false, 'msg' => 'Dato no encontrado.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}


		public function getUpdateGft($arrvent){
			$cadena = $arrvent;
			$separador = "&";
			$separada = explode($separador, $cadena);
			$productos = json_decode($separada[0], true);

			foreach($productos as $index){
				$update =[
					"0"=>$index['stock'],
					"1"=>$index['id']
				];
				$arrData = $this->model->UpdateGft($update);
			}
			if ($arrData == "") {
				$arrResponse = array('status' => false, 'msg' => 'No Es Permitido');
			}else{
				$arrResponse = array('status' => true, 'msg' => 'Articulo Actualizado Correctamente');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			
			die();
		}
	}

?>