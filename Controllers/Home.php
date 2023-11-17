<?php 

	class Home extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function home(){
			$data['page_id']= 1;
			$data['page_tag']= "Home";
			$data['page_title']= "Página principal";
			$data['page_name']= "home";
			$data['page_stiles']= "home";
			$data['page_content']= "lorem ";
			$this->views->getView($this,"home",$data);

		}

		public function getlogin(){
			$strUser = strClean($_POST['txtuser']);
			$strPassword = strClean($_POST['txtpassword']);
			$request = $this->model->selectLogin($strUser, $strPassword);
			if ($request['opc']==1) {
				$requeststatus = $this->model->selecStatus($strUser,1);

				$arrResponse = array('status' => true, 'msg' => $request['msg']);
			}else{
				$arrResponse = array('status' => false, 'msg' => $request['msg']);
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();

		}

		public function Cerrarsesion($user){
			$strUser = strClean($user);
			$requeststatus = $this->model->selecStatus($strUser,0);
			session_unset();
			session_destroy();
			$arrResponse = array('status' => true, 'msg' => base_url());
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		} 


	}

?>