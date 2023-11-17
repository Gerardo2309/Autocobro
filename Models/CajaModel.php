<?php 

	class cajaModel extends Mysql{

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

		public function selectInicio(){
			$return = 0;
			$sql = "SELECT * FROM caja";
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

		public function selectgfts(string $gafete){
			$this->strGft = $gafete;
			$sql_gft = "SELECT DISTINCT detalle_caja.cod_articulo, caja.id_usuario, detalle_caja.cantidad FROM caja,detalle_caja WHERE detalle_caja.gafete ='{$this->strGft}'";
			$request_gafete = $this->select_all($sql_gft);
			if (!empty($request_gafete)) {
				$return = $request_gafete;
			}else{
				$return = "error en el gafete";
			}

			return $return;
		}

		public function selectprogft($producto, $vendedor){
			$this->strproduct = $producto;
			$this->strvendedor = $vendedor;
			$sql = "SELECT articulos.nom_articulo, preciousd, preciomxm,stock, users.nom_user, apellido FROM articulos, users WHERE articulos.cod_articulo ='{$this->strproduct}' AND users.id_usuario = '{$this->strvendedor}' ";
			$request = $this->select_all($sql);
			if (!empty($request)){
				$return = $request;
			}
			return $return;
		}


		public function selectBankcode(string $code){
			$this->strcode = $code;
			$sql = "SELECT * FROM banco WHERE cod_bank ='{$this->strcode}' ";
			$request = $this->select_all($sql);
			if (!empty($request)){
				$sql_nfac = "SELECT idventa FROM venta ORDER by idventa DESC limit 1";
				$request_nfac = $this->select_all($sql_nfac);
				if (empty($request_nfac)) {
					$request[0]['nfactura'] = 1;
				}else{
					$request[0]['nfactura'] = $request_nfac[0]['idventa']+1;
				}
				$return = $request;
			}
			return $return;
		}

		public function insertVenta($venta){
			$return = "";
			$this->arrventa = $venta;
			$query_insert = "INSERT INTO venta(total,gafete,banco,mxn_usd,vendedor,cajero) VALUES(?,?,?,?,?,?)";
			$arrData = $this->arrventa;
			$request_insert = $this->insert($query_insert,$arrData);
			if ($request_insert>0) {
				$sql = "SELECT idventa FROM venta ORDER by idventa DESC limit 1";
				$request = $this->select_all($sql);
				$return = $request;
			}
			return $return ;
		}

		public function insertDtventa($dtventa){
			$this->arrdtventa = $dtventa;
			foreach($this->arrdtventa as $index){
				$query_insert = "INSERT INTO detalle_vents(id,cod_articulo,cantidad) VALUES(?,?,?)";
					$arrData = $index;
					$request_insert = $this->insert($query_insert,$arrData);
			}
				
			return $request_insert;
		}

		public function DropGft(string $Gft){
			$this->strGft = $Gft;
			$sql = "DELETE FROM caja WHERE gafete = ?";
			$arrData = array($this->strGft);
			$request = $this->delete($sql,$arrData);
			return $request;
		}

		public function UpdateGft($up){
			$return = "";
			$this->strUpdate = $up;
			$this->strbar = $up[1];
			$sql = "SELECT stock FROM articulos WHERE cod_articulo ='{$this->strbar}' ";
			$request = $this->select($sql);
			if ($request['stock']<=$this->strbar[0]) {
				$query_update = "UPDATE articulos SET stock = ? WHERE cod_articulo = ?";
				$arrData = $this->strUpdate;
				$request_update = $this->update($query_update,$arrData);
				$return = $request_update;

			}
			return $return;
		}

	}

?>