<?php
     session_start();


     $method = isset($_POST['method']) ? $_POST['method'] : '';
     if(function_exists($method)){
         call_user_func($method);
     }
 
     function set(){
        unset($_SESSION['ca']);
        $ca = isset($_POST['ca']) ? $_POST['ca'] : '';
        $yr = isset($_POST['yr']) ? $_POST['yr'] : 0;
        $ename = isset($_POST['ename']) ? $_POST['ename'] : '-';
        $_SESSION['ca'] = array('cano'=>$ca,'yr'=>$yr,'ename'=>$ename);
     }
  function get_emp(){
         $dat  = isset($_SESSION['emp']) ? $_SESSION['emp'] : '';
         echo json_encode($dat);
     }
  function get_ca(){
    $dat = isset($_SESSION['ca']) ? $_SESSION['ca'] : '';
    echo json_encode($dat); 
  }
?>