<?php 

	class Wreport extends Controllers{

		public function __construct(){
			parent::__construct();
		}

		public function wreport(){
			$data['page_id']= 9;
			$data['page_tag']= "Weekly report";
			$data['page_title']= "Weekly Report Page";
			$data['page_stiles'] = "wreport";
			$data['page_name']= "weekly report";
			$data['page_content']= "lorem ";
			$this->views->getView($this,"wreport",$data);

		}

        public function getWreports(){
			$arrData = $this->model->selectWreports();

			for ($i=0; $i <count($arrData); $i++) { 
				$arrData[$i]['options'] = '<div class="text-center"> 
					<button class="btn btn-warning rounded-pill btn-sm btnEditEmployee" onclick="openModalEditE(this)" id="'.$arrData[$i]['idventa'].'"title="EDIT">EDIT<i class="lni lni-checkmark"></i></button>
					<button class="btn btn-danger rounded-pill btn-sm btnEliminar" onclick="openModalDelE(this)" id="'.$arrData[$i]['idventa'].'"title="DELET">DELET<i class="lni lni-close"></i></button>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
        }

	}

?>