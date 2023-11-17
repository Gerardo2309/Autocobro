<?php 
	include 'HomeModel.php';
	class employeesModel extends Mysql{

		public function __construct(){
			parent::__construct();
		}

		public function selectEmployees(){
			$sql = "SELECT id_usuario,nom_user,apellido,id_rol FROM users";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectEmprol($number){
			$this->intnumber = intval($number);
			$sql= "SELECT nom_rol FROM rol WHERE id_rol='{$this->intnumber}'";
			$request = $this->select_all($sql);	
			return $request;
		}

		public function selectEmploy($iduser){
			$this->strIdUser = $iduser;
			$sql = "SELECT id_usuario,nom_user,apellido,id_rol FROM users WHERE id_usuario = '{$this->strIdUser}'";
			$request = $this->select($sql);
			return $request;	
		}

		public function insertEmployee($user,$rol,$name,$last,$pass){
			$return = "";
			$this->struser = $user;
			$this->strrol = $rol;
			$this->strname = $name;
			$this->strlast = $last;
			$this->strpass = Password::hash($pass);

			$query_insert = "INSERT INTO users(id_usuario, nom_user, apellido, password, id_rol, status) VALUES(?,?,?,?,?,?)";
			$arrData = array($this->struser,$this->strname,$this->strlast,$this->strpass,$this->strrol,0);
			$request = $this->insert($query_insert,$arrData);
			$return = $request;

			return $return;
		}

		public function UpdateEmployee($oldUser,$user,$rol,$name,$last,$pass){
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
		}

		public function DeletEmployee($user){
			$this->strIduser = $user;
			$sql = "DELETE FROM users WHERE id_usuario = ?";
			$arrData = array($this->strIduser);
			$request = $this->delete($sql,$arrData);
			return $request;
		}

	}

?>