<?php 

	class wreportModel extends Mysql{

		public function __construct(){
			parent::__construct();
		}

        public function selectWreports(){
			$sql = "SELECT idventa,total,gafete,vendedor,cajero,fecha FROM venta";
			$request = $this->select_all($sql);
			return $request;
		}

	}



?>