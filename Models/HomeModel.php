<?php 

	class homeModel extends Mysql{

		public function __construct(){
			parent::__construct();
		}


		public function selectLogin(string $user, string $password){
			$return = "";
			$opc = 0;
			$this->strUser = $user;
			$this->strPassword = $password;
			$sql = "SELECT * FROM users WHERE id_usuario = '{$this->strUser}' ";
			$request = $this->select($sql);

			if(!empty($request)){
				$sql_rol = "SELECT nom_rol FROM rol WHERE id_rol = '{$request['id_rol']}' ";
				$request_rol = $this->select($sql_rol);
				$hash = $request['password'];
				// Crear la contraseña:
				//$hash = Password::hash('Gerardo2309');
				if (Password::verify($this->strPassword, $hash)) {
					$return = Users::verify($request,$request_rol);
					$opc = 1;
				} else {
					$return = "Contraseña incorrecta!";
					$opc = 0;
				}
			}else{
				$return = "El Usuario no existe";
				$opc = 0;
			}
			$arrData = array(
			    "opc"=>$opc, 
			    "msg"=>$return
			);

			return $arrData;
		}

		public function selecStatus(string $iduser,string $status){
			$return = "";
			$this->intstatus = $status;
			$this->strIduser = $iduser;
			$query_update = "UPDATE users SET status = ?  WHERE id_usuario = ?";
			$arrData = array($this->intstatus , $this->strIduser);
			$request_update = $this->update($query_update,$arrData);
			$return = $request_update;
		}

	}
	class Password {
		const SALT = 'EstoEsUnSalt';
		public static function hash($password) {
			return hash('sha512', self::SALT . $password);
		}
		public static function verify($password, $hash) {
			return ($hash == self::hash($password));
		}
	}


	class Users {
		public static function verify($arrdatos, $datosrol) {
			$_SESSION['user'] = $arrdatos['id_usuario'];
			$_SESSION['nombre'] = $arrdatos['nom_user'];
			$_SESSION['nomcompleto'] = $arrdatos['nom_user']." ".$arrdatos['apellido'];
			$_SESSION['rol'] = $arrdatos['id_rol'];
			$_SESSION['nomrol'] = $datosrol['nom_rol'];
			$ruta =base_url();
			return $ruta;
			
		}
	}

?>