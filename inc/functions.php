<?php
	require_once("dbhelper/dbConnection.php");
	function dataHandlerIn($dat,$sp){
		$con = new DbConnection();
		$db = $con->getDb();
		$pchar = str_repeat("?,", count($dat));
		$sql = "EXEC " . $sp . " " .  substr($pchar, 0,((count($dat) * 2) - 1 ));
		$stmt = sqlsrv_query($db,$sql,$dat);
		if($stmt){
			return 1;
		}
		else{
		    return -1;
		}
		$con->dbClose();
	}

	function dataHandlerInWithReturn($dat,$sp){
		$con = new DbConnection();
		$db = $con->getDb();
		$pchar = str_repeat("?,", count($dat));
		$sql = "EXEC " . $sp . " " .  substr($pchar, 0,((count($dat) * 2) - 1 ));
		$stmt = sqlsrv_query($db,$sql,$dat);
		$rw = array();
		if($stmt){
			
			while($row = sqlsrv_fetch_array($stmt)){
				$rw[] = $row;
			}
		}
		else{
			
			$rw [] = sqlsrv_errors();
		}
		$con->dbClose();
		return $rw;

	}

	function dataHandlerInlineIn($sql){
		$con = new DbConnection();
		$db = $con->getDb();
		$stmt = sqlsrv_query($db,$sql);
		if($stmt){
			return 1;
		}
		else{
		    return -1;
		}
		$con->dbClose();
	}

	function dataHandlerInlineGet($sql){
		$con = new DbConnection();
		$db = $con->getDb();
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
	    $pchar = str_repeat("?,", count($dat));
		$sql = "EXEC " . $sp . " " .  substr($pchar, 0,((count($dat) * 2) - 1 ));
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
		$sql = "EXEC " . $sp;
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