	<?php 
	class mysql extends Conexion{
		private $conexion;
		private $strquery;
		private $arrvalues;

		function __construct(){
			$this->conexion = new Conexion();
			$this->conexion = $this->conexion->conect();
		}

		public function insert(string $query, array $arrvalues){
			try{
				$this->strquery = $query;
				$this->arrvalues = $arrvalues;

				$insert = $this->conexion->prepare($this->strquery);
				$data = $insert->execute($this->arrvalues);
			}catch(PDOException $e){
				$data = 0;
			}
			return $data;
		}

		public function select(string $query){
			$this->strquery = $query;
			$result = $this->conexion->prepare($this->strquery);
			$result->execute();
			$data = $result->fetch(PDO::FETCH_ASSOC);
			return $data;
		}

		public function select_all(string $query){
			try{
				$this->strquery = $query;
				$result = $this->conexion->prepare($this->strquery);
				$result->execute();
				$data = $result->fetchall(PDO::FETCH_ASSOC);
			}catch(PDOException $e){
				$data = 0;

			}
			return $data;
		}

		public function update(string $query, array $arrvalues){
			try{
				$this->strquery = $query;
				$this->arrvalues = $arrvalues;
				$update = $this->conexion->prepare($this->strquery);
				$resExecute = $update->execute($this->arrvalues);
				$data = $resExecute;
			}catch(PDOException $e){
				$data = 0;
			}

			return $data;
		}

		public function delete(string $query, array $arrvalues){
			try{
				$this->strquery = $query;
				$this->arrvalues = $arrvalues;
				$result = $this->conexion->prepare($this->strquery);
				$resExecute = $result->execute($this->arrvalues);	
				$data = $result->rowCount();
			}catch(PDOException $e){
				$data = 0;
			}
			return $data;
		}

	}


?>