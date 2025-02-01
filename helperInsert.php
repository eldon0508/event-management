<?php

global $id, $name, $org, $desc, $loc, $state, $startDate, $startTime, $endDate, $endTime, $status, $fee, $price, $ticket, $sst, $file;

function validateAll(){
    $err = array();
    isset($_POST['id'])?$id = trim($_POST['id']): $id = NULL;
    isset($_POST['name'])?$name = trim($_POST['name']): $name = NULL;
    isset($_POST['loc'])?$loc = trim($_POST['loc']): $loc = NULL;
    isset($_POST['org'])? $org = trim($_POST['org']): $org = NULL;
    isset($_POST['desc'])?$desc = trim($_POST['desc']): $desc = NULL;
    isset($_POST['state'])?$state = $_POST['state']: $state = NULL;
    isset($_POST['startDate'])?$startDate = $_POST['startDate']: $startDate = NULL;
    isset($_POST['startTime'])?$startTime = trim($_POST['startTime']): $startTime = NULL;
    isset($_POST['endDate'])?$endDate = $_POST['endDate']: $endDate = NULL;
    isset($_POST['endTime'])?$endTime = $_POST['endTime']: $endTime = NULL;
    isset($_POST['status'])?$status = strtoupper(trim($_POST['status'])):$status = NULL;
    isset($_POST['fee'])?$fee = strtoupper(trim($_POST['fee'])):$fee = NULL;
    $fee == 'P'?$price = trim($_POST['price']): $price = 0.0;
    isset($_POST['ticket'])?$ticket = trim($_POST['ticket']): $ticket = NULL;
    isset($_FILES['file'])? $file = $_FILES['file']: $file = NULL;
    
    //validation of all data fields
    if($id == NULL){
        $err["id"] = "Please enter <b>Event ID</b>.";
    }elseif(dupID($id)){     //check existence of ID
        $err['id'] = "<b>Event ID </b>has been used. Try another one.";
    }
    if($name == NULL){
        $err["name"] = "Please enter <b>Event Name</b>.";
    }
    if($org == NULL){
        $err['org'] = "Please enter <b>Organizer</b>.";
    }
    if($loc == NULL){
        $err['loc'] = "Please enter <b>Location</b>.";
    }
    if($desc == NULL){
        $err['desc'] = "Please enter <b>Description</b>.";
    }
    if($state == ""){
        $err['state'] = "Please select <b>State</b>.";
    }
    if($startDate == NULL || $endDate == NULL){
        $err['date'] = "Please enter <b>Event Date</b>.";
    }
    if($endTime == NULL || $endTime == NULL){
        $err['time'] = "Please enter <b>Event Time</b>.";
    }
    if($status != 'A' && $status != 'I'){
        $err['status'] = "Please choose <b>Event Status</b>.";
    }
    if($fee != 'P' && $fee != 'F'){
        $err['fee'] = "Please choose the <b>Event Type</b>.";
    }
    if($fee == 'P'){
        if($price <= 0){
            $err['fee'] = "Please enter <b>Price</b>.";
        }
    }elseif($fee == 'F'){
        if($price != 0){
            $err['fee'] = "Invalid <b>Price Format</b>.";
        }
    }
    if(!is_numeric($price)){
        $err['price'] = "Invalid <b>Price Format</b>.";
    }
    if($ticket == NULL){
        $err['ticket'] = "Please enter <b>Ticket Stock</b>.";
    }elseif(!is_numeric($ticket)){
        $err['ticket'] = "Invalid <b>Ticket Format</b>.";
    }
    if($file == NULL){
        $err['img'] = "Please choose <b>Event Image</b>.";
    }elseif($file['error'] > 0){
        //with error, display error msg
        switch($file['error']){
            case UPLOAD_ERR_NO_FILE: //4
                $err['img'] = "No file selected!"; break;
            case UPLOAD_ERR_FORM_SIZE: //2
                $err['img'] = "File uploaded exceeded 2MB!"; break;
            default:
                $err['img'] = "There was an error in uploading file. Please try again.";
        }
    }elseif($file['size'] > 2097152){ //bytes
        $err['img'] = "File uploaded exceeded 2MB!";
    }
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if($ext != 'png' && $ext != 'jpg' && $ext != 'gif' && $ext != 'jpeg'){
        //check ext to see it is allow to uplaod?
        $err['img'] = 'Only png, jpg, jpeg and gif file allowed.';
    }
    return $err;
}
function dupID($id){
    require_once './database/db.php';
    $db = new mysqli(HOST, USER, PASS, NAME);
    $sql = "SELECT * FROM event WHERE e_ID = '$id'";
    if($res = $db->query($sql)){
        if($res->num_rows > 0){
            return TRUE;
        }
    }
    return FALSE;
    $res->free();
    $db->close();
}

