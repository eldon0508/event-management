<?php

function validate(){
    global $id, $hideID, $name, $org, $desc, $loc, $state, $startDate, $startTime, $endDate, $endTime, $status, $fee, $price, $ticket, $file1;
    $err = array();
    isset($_POST['hideID'])?$hideID = trim($_POST['hideID']): $hideID = $id;
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
    isset($_FILES['file'])? $file1 = $_FILES['file']: $file1 = NULL;
    
    //validation of all data fields
    if($hideID == NULL){
        $err["id"] = "<b>Event ID</b> is not found.";
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
    
    if($file1['file'] != NULL){
//        if($file['error'] > 0){
//            //with error, display error msg
//            switch($file['error']){
//                case UPLOAD_ERR_NO_FILE: //4
//                    $err['img'] = "No file selected!"; break;
//                case UPLOAD_ERR_FORM_SIZE: //2
//                    $err['img'] = "File uploaded exceeded 2MB!"; break;
//                default:
//                    $err['img'] = "There was an error in uploading file. Please try again.";
//            }
        if($file['size'] > 2097152){ //bytes
            $err['img'] = "File uploaded exceeded 2MB!";
        }
        
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if($ext != 'png' && $ext != 'jpg' && $ext != 'gif' && $ext != 'jpeg'){
            //check ext to see it is allow to uplaod?
            $err['img'] = 'Only png, jpg, jpeg and gif file allowed.';
        }
    }
    
    return $err;
}