<?php 
	class banksModel extends Mysql{

		public function __construct(){
			parent::__construct();
		}

		public function selectBanks(){
			$sql = "SELECT * FROM banco";
			$request = $this->select_all($sql);
			return $request;
		}

		public function insertBank($code,$name,$divisa){
			$return = "";
			$this->strcode = $code;
			$this->strname = $name;
			$this->strdivisa = $divisa;


			$query_insert = "INSERT INTO banco(cod_bank, nom_bank, mxn_usd) VALUES(?,?,?)";
			$arrData = array($this->strcode,$this->strname,$this->strdivisa);
			$request = $this->insert($query_insert,$arrData);
			$return = $request;
			return $return;
		}

		/*public function UpdateEmployee($oldUser,$user,$rol,$name,$last,$pass){
			$return = "";
			$this->strolduser = $oldUser;
			$this->struser = $user;
			$this->strrol = $rol;
			$this->strname = $name;
			$this->strlast = $last;
			$this->strpass = Password::hash($pass);
			$query_insert = "UPDATE users SET id_usuario = ?, nom_user = ?, apellido = ?, password = ?, id_rol = ?, status = ? WHERE id_usuario = ?";
			$arrData = array($this->struser,$this->strname,$this->strlast,$this->strpass,$this->strrol,0,$this->strolduser);
			$request = $this->update($query_insert,$arrData);
			$return = $request;

			return $return;
		}*/

		public function DeletBank($code){
			$this->strcode = $code;
			$sql = "DELETE FROM banco WHERE cod_bank = ?";
			$arrData = array($this->strcode);
			$request = $this->delete($sql,$arrData);
			return $request;
		}

	}

?>