<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php

isset($_POST["userID"])?$uid = trim($_POST['userID']):$uid = NULL;
isset($_POST["name"])?$name = trim($_POST["name"]):$name = NULL;
isset($_POST['ic'])? $ic = trim($_POST['ic']): $ic = NULL;
isset($_POST["email"])?$email = trim($_POST["email"]):$email = NULL;
isset($_POST["phonenum"])?$phnum = trim($_POST["phonenum"]):$phnum = NULL;
isset($_POST["passw"])?$passw= trim($_POST["passw"]):$passw = NULL;
isset($_POST["cpassw"])?$cpassw= trim($_POST["cpassw"]):$cpassw = NULL;
isset($_POST['q1'])?$q1 = trim($_POST['q1']):$q1 = NULL;
isset($_POST['a1'])?$a1 = trim($_POST['a1']):$a1 = NULL;
isset($_POST['q2'])?$q2 = trim($_POST['q2']):$q2 = NULL;
isset($_POST['a2'])?$a2 = trim($_POST['a2']):$a2 = NULL;

global $uid, $name, $ic, $email, $phnum, $passw, $cpassw, $q1, $a1, $q2, $a2, $status;

    //For Validation function
    function validate($uid, $name, $ic, $email, $phnum, $passw, $cpassw, $q1, $a1, $q2, $a2){
        $errMsg = array();
        
        if($uid == NULL){
            $errMsg["userID"] = "Please enter <b>Username</b>.";
        }elseif(!preg_match("/^[A-Za-z0-9]{8,20}$/", $uid)){
            $errMsg["userID"] = "<b>Username</b> minimum 8 characters.";
        }elseif(dupID($uid)){
            $errMsg["userID"] = "<b>Username</b> has been used. Try another one.";
        }
        
        if($name == NULL) {
            $errMsg["name"] = "Please enter <b>Name</b>.";
        }elseif (!preg_match("/^[A-Za-z \'\.]{3,30}$/", $name)){
            $errMsg["name"] = "Invalid <b>Name</b> Format.";
        }
        if($ic == NULL){
            $errMsg['ic'] = "Please enter <b>IC Number</b>.";
        }elseif(!preg_match("/^([0-9][0-9])((0[1-9])|(1[0-2]))((0[1-9])|([1-2][0-9])|(3[0-1]))\-([0-9][0-9])\-([0-9][0-9][0-9][0-9])$/", $ic)){
            $errMsg['ic'] = 'Invalid <b>IC Number</b> Format.';        
        }elseif(dupIC($ic)){
            $errMsg["ic"] = "<b>IC Number</b> is registered.";
        }
        if($email == NULL){
            $errMsg["email"] = "Please enter <b>Email Address</b>.";
        }elseif(!preg_match ("/^[\w@#$%]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/", $email) || strlen($email) > 30){
            $errMsg["email"] = "Invalid <b>Email Address</b> Format.";
        }
        if($phnum == NULL){
            $errMsg["phonenum"] = "Please enter <b>Phone Number</b>.";
        }elseif(!preg_match ("/^01[0-9]-[0-9]{7,8}$/", $phnum)){
            $errMsg["phonenum"] = "Invalid <b>Phone Number</b> Format!";
        }
        if($passw == NULL){
            $errMsg["passw"] = "Please enter <b>Password</b>.";
        }elseif(!preg_match("/^[A-Z][A-Za-z0-9]{7,15}$/", $passw)){
            $errMsg['passw'] = "Invalid <b>Password</b> Format.";
        }
        if($cpassw != $passw){
            $errMsg["cpassw"] = "<b>Comfirm Password</b> Must Match The Password.";
        }
        if($q1 == ""){
            $errMsg['q1'] = "Please select <b>Question 1</b>.";
        }
        if($q2 == ""){
            $errMsg['q2'] = "Please select <b>Question 2</b>.";
        }
        if($a1 == NULL){
            $errMsg['a1'] = "Please answer <b>Question 1</b>";
        }
        if($a2 == NULL){
            $errMsg['a2'] = "Please answer <b>Question 2</b>";
        }
        return $errMsg;
    }

    //create create function to check existance of USER ID
    
    function dupID($uid){
        require_once './database/db.php';
        $db = new mysqli(HOST, USER, PASS, NAME);
        $sql = "SELECT * FROM member WHERE username = '$uid'";
        if($res = $db->query($sql)){
            if($res->num_rows > 0){
                return TRUE;
            }
        }
        $res->free();
        $db->close();
        return FALSE;
    }
    function dupIC($ic){
        require_once './database/db.php';
        $db = new mysqli(HOST, USER, PASS, NAME);
        $sql = "SELECT * FROM member WHERE icNum = '$ic'";
        if($res = $db->query($sql)){
            if($res->num_rows > 0){
                return TRUE;
            }
        }
        $res->free();
        $db->close();
        return FALSE;
    }
?>
