<?php

require_once("../inc/functions.php");

session_start();

$method = isset($_POST['method']) ? $_POST['method'] : "";
if(function_exists($method)){
    call_user_func($method);
}
//sample functions or methods from existing apps
function getEmployeesByLocation(){

    $location = $_POST['location'];

    $param = array($location);

    $dat = dataHandlerGet($param,"sp_get_DTR_today_with_location_bkk");
    echo json_encode($dat);
}

function getEmployeesCountByLocation(){
    $location = $_POST['location'];

    $param = array($location);

    $dat = dataHandlerGet($param,"sp_get_all_employee_by_location");
    echo json_encode($dat);
}

function getImage(){
    echo json_encode($_SESSION['ca']);
}

function getLeaves(){
    $location = $_POST['location'];
    $type = $_POST['type'];

    $param = array($location,$type);

    $dat = dataHandlerGet($param,"sp_getLeaveToday");
    echo json_encode($dat);
}

function getEmployeeByPincode(){
    $rfid = $_POST['rfid'];

    $param = array($rfid);

    $dat = dataHandlerGet($param,"sp_get_employee_by_pincode");
    echo json_encode($dat);
}

function setDTRlog(){
    $empid = $_POST['empid'];
    $inout = $_POST['inout'];

    $param = array($empid,$inout);

    echo dataHandlerIn($param,'sp_dtr_log');
}
function uploadCSV(){
    $file = $_FILES['file']['name'];
    move_uploaded_file($_FILES["file"]["tmp_name"], "../file_uploaded/" . $_FILES['file']['name']);
    $open = fopen("../file_uploaded/" . $_FILES['file']['name'], "r");
    // $data = fgetcsv($open, 1000, ",");
    $xy = array();
    while (($data = fgetcsv($open, 1000, ",")) !== false) {
        $xy = $data[1];
    }
    echo json_encode($xy);
}
function getserverdatetime(){
    $dat = dataHandlerGetNoParam("sp_get_server_datetime_bkk");
    echo json_encode($dat);
}
function getcsvPType(){
    $pizza_type_id ="";
    $name = "";
    $category = "";
    $ingredients = "";
    $xy[] ="";
    $open = fopen("../file_downloaded/pizza_types.csv", "r");
    while (($data = fgetcsv($open, 1000, ",")) !== false) {
      $pizza_type_id = str_replace(',', '', $row[0]);
      $name = str_replace(',', '', $row[1]);
      $category = str_replace(',', '', $row[2]);
      $ingredients = str_replace(',', '', $row[3]);
      
      array_push($xy,(object)["pizza_type" => $pizza_type_id,"name" => $name, "category" => $category,"ingredients" => $ingredients]);

    }
    echo json_encode($xy);
}
?>