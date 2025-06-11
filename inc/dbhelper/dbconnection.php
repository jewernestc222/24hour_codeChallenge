<?php
		
	class DbConnection{
		private $db;
		private $serverName = "localhost";
		private $coninfo = array("Database"=>"24hourcodeChallenge_db","UID"=>"sa","PWD"=>"AAbbCC!!123");
		private $conn_state;
		function __construct(){
			$this->db = sqlsrv_connect($this->serverName,$this->coninfo);

			if($this->db){
				$this->conn_state = "ok";
			}else
			{
				$this->conn_state = sqlsrv_errors();
			}
		}
		function connection_state(){
			return $this->conn_state;
		}
		function getDb()
		{
			return $this->db;
		}
		function dbClose(){
		//	sqlsrv_close($this->db);
		}
	}
?>

