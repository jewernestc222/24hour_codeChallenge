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

function getDTRlog(){
    $location = $_POST['location'];

    $param = array($location);

    $dat = dataHandlerGet($param,"sp_get_DTR_today_bkk");
    echo json_encode($dat);
}

function getDTRlogTelework(){
    $location = $_POST['location'];

    $param = array($location);

    $dat = dataHandlerGet($param,"sp_get_DTR_today_telework_bkk");
    echo json_encode($dat);
}

function getserverdatetime(){
    $dat = dataHandlerGetNoParam("sp_get_server_datetime_bkk");
    echo json_encode($dat);
}

function getMinuteRule(){

    $sysid = $_POST['sysid'];
    $param = array($sysid);

    $dat = dataHandlerGet($param,"sp_get_59_minute_rule");
    echo json_encode($dat);
}

function insertTimeOff(){
    $sysid = $_POST['sysid'];
    $toDate = $_POST['toDate'];
    // $timeOut = $_POST['timeOut'];
    $lessHrs = $_POST['lessHrs'];
    $toTitle = $_POST['toTitle'];
    $countryCode = $_POST['countryCode'];
    $remarks = $_POST['remarks'];

    $param = array($sysid,$toDate,$lessHrs,$toTitle,$countryCode,$remarks);

    echo dataHandlerIn($param,'sp_insert_time_off');
}

function deleteTimeOff(){
    $sysid = $_POST['sysid'];

    $param = array($sysid);

    echo dataHandlerIn($param,'sp_delete_time_off');
}

function getHolidays(){

    $sysid = $_POST['sysid'];
    $param = array($sysid);

    $dat = dataHandlerGet($param,"sp_get_holiday");
    echo json_encode($dat);
}

function insertHoliday(){
    $sysid = $_POST['sysid'];
    $date = $_POST['date'];
    $title = $_POST['title'];
    $countryCode = $_POST['countryCode'];

    $param = array($sysid,$date,$title,$countryCode);

    echo dataHandlerIn($param,'sp_insert_holiday');
}

function deleteHoliday(){
    $sysid = $_POST['sysid'];
    $param = array($sysid);
    echo dataHandlerIn($param,'sp_delete_holiday');
}
function getEmployeeLogs(){
    $empid = $_POST['empid'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $param = array($empid,$start,$end);
    $dat = dataHandlerGet($param,"sp_getEmployeeLogs_bkk");
    echo json_encode($dat);
}
function getDTRLogsBKK(){
    $loc = $_POST['location'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $param = array($loc,$start,$end);
    $dat = dataHandlerGet($param,"sp_getDTRLogs_bkk");
    echo json_encode($dat);
}
function getDTRLogsBKKbyid(){
    $loc = $_POST['location'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $empid = $_POST['empid'];
    $param = array($loc,$start,$end,$empid);
    $dat = dataHandlerGet($param,"sp_getDTRLogs_bkk_byid");
    echo json_encode($dat);
}
function getDepartmentList(){
    $sysid = $_POST['sysid'];
    $param = array($sysid);
    $dat = dataHandlerGet($param,"sp_get_department");
    echo json_encode($dat);
}
function insertDepartment(){
    $sysid = $_POST['sysid'];
    $departmentname = $_POST['departmentname'];
    $param = array($sysid,$departmentname);
    echo dataHandlerIn($param,'sp_insert_department');
}
function deleteDepartment(){
    $sysid = $_POST['sysid'];
    $param = array($sysid);
    echo dataHandlerIn($param,'sp_delete_department');
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
function getAuditTrail(){
    $sysid = $_POST['sysid'];
    $param = array($sysid);
    $dat = dataHandlerGet($param,"sp_get_audittrail");
    echo json_encode($dat);
}
?>