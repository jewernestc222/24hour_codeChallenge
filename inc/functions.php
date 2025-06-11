<?php
	require_once("dbhelper/dbConnection.php");

	function dataHandlerIn($dat,$sp){
		$con = new DbConnection();
		$db = $con->getDb();
		// $dat = array($id,$fname,$lname,$address,$gender,$bday,$datehired,$pin,$rate);
		$pchar = str_repeat("?,", count($dat));
		$sql = "EXEC " . $sp . " " .  substr($pchar, 0,((count($dat) * 2) - 1 ));
		$stmt = sqlsrv_query($db,$sql,$dat);
		if($stmt){
			return 1;
		}
		else{
			
			//$rw [] = sqlsrv_errors();
		    return -1;
		}
		$con->dbClose();
	}

	function dataHandlerInWithReturn($dat,$sp){
		$con = new DbConnection();
		$db = $con->getDb();
		// $dat = array($id,$fname,$lname,$address,$gender,$bday,$datehired,$pin,$rate);
		$pchar = str_repeat("?,", count($dat));
		$sql = "EXEC " . $sp . " " .  substr($pchar, 0,((count($dat) * 2) - 1 ));
		$stmt = sqlsrv_query($db,$sql,$dat);
		$rw = array();
		if($stmt){
			
			while($row = sqlsrv_fetch_array($stmt)){
				$rw[] = $row;
			}
			// return $rw;
		}
		else{
			
			$rw [] = sqlsrv_errors();
		    // return -1;
		}
		$con->dbClose();
		return $rw;

	}

	function dataHandlerInlineIn($sql){
		$con = new DbConnection();
		$db = $con->getDb();

      //  echo $sql;
		$stmt = sqlsrv_query($db,$sql);
		if($stmt){
			return 1;
		}
		else{
			
			//$rw [] = sqlsrv_errors();
		    return -1;
		}
		$con->dbClose();
	}

	function dataHandlerInlineGet($sql){
		$con = new DbConnection();
		$db = $con->getDb();

      //  echo $sql;
		$stmt = sqlsrv_query($db,$sql);
		if($stmt){
			$rw = array();
			while($row = sqlsrv_fetch_array($stmt)){
				$rw[] = $row;
			}
			return $rw;
		}
		else{
			
			$rw [] = sqlsrv_errors();
		}
		$con->dbClose();
	}

	function dataHandlerGet($dat = array(),$sp){
		$con = new DbConnection();
		$db = $con->getDb();
		// $dat = array($id,$fname,$lname,$address,$gender,$bday,$datehired,$pin,$rate);
	    $pchar = str_repeat("?,", count($dat));
		$sql = "EXEC " . $sp . " " .  substr($pchar, 0,((count($dat) * 2) - 1 ));
		
	
        // //echo $sql;
		// echo var_dump($dat);
		$row = array();
		$stmt = sqlsrv_query($db,$sql,$dat);
		if($stmt){
			while($rw = sqlsrv_fetch_array($stmt)){
				$row[] = $rw;
			}
		}
		else{
			$row[] = sqlsrv_errors();
		}

		$con->dbClose();

		return $row;
	}

   function dataHandlerGetNoParam($sp){
		$con = new DbConnection();
		$db = $con->getDb();
		// $dat = array($id,$fname,$lname,$address,$gender,$bday,$datehired,$pin,$rate);
	   // echo $con->connection_state();
		$sql = "EXEC " . $sp;
	
       // echo $sql;
		//echo var_dump($dat);

		$row = array();
		$stmt = sqlsrv_query($db,$sql);
		if($stmt){
			while($rw = sqlsrv_fetch_array($stmt)){
				$row[] = $rw;
			}
		}
		else{
	    	$row[] = sqlsrv_errors();
		}

		$con->dbClose();

		return $row;
	}


	
     
   
?>