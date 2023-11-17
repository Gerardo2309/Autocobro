<?php 

	class productsModel extends Mysql{

		public function __construct(){
			parent::__construct();
		}

		public function selectProduct($Codebar){
			$this->strCodebar = $Codebar;
			$sql = "SELECT * FROM articulos WHERE cod_articulo ='{$this->strCodebar}'";
			$request = $this->select($sql);
			return $request;
		}

		public function selectProducts(){
			$sql = "SELECT * FROM articulos";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectCategorys(){
			$sql = "SELECT id_categoria, nom_categoria FROM categoria";
			$request = $this->select_all($sql);
			return $request;
		}

		public function insertProducts($Codebar, $Name, $Category, $Usd, $Mxn, $Stock){
			$this->strCodebar = $Codebar;
			$this->strName = $Name;
			$this->strMxn = $Mxn;
			$this->strUsd = $Usd;
			$this->strStock = $Stock;
			$this->strCategory = $Category;
			$sql = "SELECT cod_articulo FROM articulos WHERE cod_articulo ='{$this->strCodebar}' ";
			$request = $this->select($sql);
			if (empty($request)) {
				$query_insert = "INSERT INTO articulos(cod_articulo, nom_articulo, id_categoria, preciousd, preciomxm, stock) VALUES(?,?,?,?,?,?)";
				$arrData = array($this->strCodebar,$this->strName, $this->strCategory, $this->strUsd, $this->strMxn, $this->strStock);
				$request = $this->insert($query_insert,$arrData);
				$return = $request;
			}else{
				$return = -1;
			}
			return $return;
		}

		public function UpdateProducts($Codebar, $Name, $Category, $Usd, $Mxn, $Stock){
			$this->strCodebar = $Codebar;
			$this->strName = $Name;
			$this->strMxn = $Mxn;
			$this->strUsd = $Usd;
			$this->strStock = $Stock;
			$this->strCategory = $Category;
			$query_insert = "UPDATE articulos SET cod_articulo = ?, nom_articulo = ?, id_categoria = ?, preciousd = ?, preciomxm = ?, stock = ? WHERE cod_articulo = ?";
			$arrData = array($this->strCodebar,$this->strName,$this->strCategory,$this->strUsd,$this->strMxn,$this->strStock,$this->strCodebar);
			$request = $this->update($query_insert,$arrData);
			$return = $request;

			return $return;
		}

		public function DeletProducts($code){
			$this->strcode = $code;
			$sql = "DELETE FROM articulos WHERE cod_articulo = ?";
			$arrData = array($this->strcode);
			$request = $this->delete($sql,$arrData);
			return $request;
		}

	}

?>