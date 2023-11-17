<?php 
	class discountsModel extends Mysql{

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
		
		public function updateDiscount($discount,$detalle){
			$return = 0;
			$this->strdiscounts = $discount;
			$this->strdt = $detalle;

			$sql = "SELECT id_discount FROM discounts";
			$request = $this->select($sql);
			if (!empty($request)) {
				$query_update = "UPDATE discounts SET nom_discount = ?, id_detalle = ? WHERE id_discount = ?";
				$arrData = array($this->strdiscounts, $this->strdt, $request['id_discount']);
				$request_update = $this->update($query_update,$arrData);
				$return = $request_update;
			}else{
				$return="0";
			}
			return $return;
		}

		public function insertDtDiscount($user){
			$return = "";
			$this->strduser = $user;

			$query_insert = "INSERT INTO detalle_discounts(id_usuario) VALUES(?)";
			$arrData = array($this->strduser);
			$request = $this->insert($query_insert,$arrData);
			$return = $request;
			if($request>0){
				$sql = "SELECT id_detalle FROM detalle_discounts ORDER by id_detalle DESC limit 1";
				$request = $this->select_all($sql);
				$return=$request;
			}

			return $return;
		}

		public function insertDiscount($porcent,$iddt){
			$this->strdt = $iddt;
			$this->strdiscount = $porcent;

			$query_insert = "INSERT INTO discounts(id_discount,nom_discount,id_detalle) VALUES(?,?,?)";
			$arrData = array(1, $this->strdiscount, $this->strdt);
			$request = $this->insert($query_insert,$arrData);

			return $request;
		}



	}

?>