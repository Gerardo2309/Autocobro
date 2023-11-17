<?php 

	class dashboardModel extends Mysql{

		public function __construct(){
			parent::__construct();
		}

		public function selectVentas(){
			$return = 0;
			$sql = "SELECT * FROM venta";
			$request = $this->select_all($sql);
			if (!empty($request)){
				$return = $request;
			}
			return $return;
		}

		public function selecEmployee(){
			$return = 0;
			$sql = "SELECT * FROM users";
			$request = $this->select_all($sql);
			if (!empty($request)){
				$return = $request;
			}
			return $return;	
		}

		public function selecArticulos(){
			$return = 0;
			$sql = "SELECT * FROM articulos WHERE stock = 0";
			$request = $this->select_all($sql);
			if (!empty($request)){
				$return = $request;
			}
			return $return;	
		}
	}

?>