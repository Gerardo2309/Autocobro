<?php 

	class scannerModel extends Mysql{

		public function __construct(){
			parent::__construct();
		}
	
		public function selectDiscounts(){
			$return = 0;
			$sql = "SELECT * FROM discounts";
			$request = $this->select_all($sql);
			if (!empty($request)){
				$return = $request;
			}
			return $return;
		}
	
		public function selectCodebr(string $codebar){
			$return = 0;
			$this->strCode = $codebar;
			$sql = "SELECT * FROM articulos WHERE cod_articulo ='{$this->strCode}' ";
			$request = $this->select_all($sql);
			if (!empty($request)){
				$return = $request;
			}
			return $return;
		}

		public function insertPtoCaja(int $id, string $gaft, string $vendedor ){
			$return = "";
			$this->strid = $id;
			$this->strgft = $gaft;
			$this->strvendedor = $vendedor;
			//ALTER SEQUENCE staff_id_empleado_seq RESTART WITH 1;
			$sql = "SELECT * FROM caja WHERE gafete ='{$this->strgft}' ";
			$request = $this->select($sql);
			if (empty($request)) {
				$query_insert = "INSERT INTO caja(id_caja,gafete,id_usuario) VALUES(?,?,?)";
				$arrData = array($this->strid,$this->strgft,$this->strvendedor);
				$request_insert = $this->insert($query_insert,$arrData);
				$return = $request_insert;
			}else{
				$return = 0;
			}
			return $return ;
		}


		public function insertPDetCaja($products){
			$return = "";
			$this->products = $products;
			foreach($this->products as $index){
				$query_insert = "INSERT INTO detalle_caja(gafete,cod_articulo,cantidad) VALUES(?,?,?)";
				$arrData = $index;
				$request_insert = $this->insert($query_insert,$arrData);
				$return = $request_insert;

			}
			return $return ;
			
		}





	}

?>