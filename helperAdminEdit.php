<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $name, $email, $pNum, $pass1, $pass2;

function checkAdmin(){
    $errMsg = array();
    
    isset($_POST['name'])? $name = trim($_POST['name']): $name = NULL;
    isset($_POST['email'])? $email = trim($_POST['email']): $email = NULL;
    isset($_POST['pNum'])? $pNum = trim($_POST['pNum']): $pNum = NULL;
    isset($_POST['pw'])? $pass1 = trim($_POST['pw']): $pass1 = NULL;
    isset($_POST['cpw'])? $pass2 = trim($_POST['cpw']): $pass2 = NULL;
    
    if($name == NULL){
        $errMsg['name'] = "Please enter <b>Name</b>";
    }elseif(!preg_match("/^[A-Za-z \'\.]{3,30}$/", $name)){
        $errMsg["name"] = "Invalid <b>Name</b> Format.";
    }
    if($email == NULL){
        $errMsg["email"] = "Please enter <b>Email Address</b>.";
    }elseif(!preg_match ("/^[\w@#$%]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/", $email) || strlen($email) > 30){
        $errMsg["email"] = "Invalid <b>Email Address</b> Format.";
    }
    if($pNum == NULL){
        $errMsg["phonenum"] = "Please enter <b>Phone Number</b>.";
    }elseif(!preg_match ("/^01[0-9]-[0-9]{7,8}$/", $pNum)){
        $errMsg["phonenum"] = "Invalid <b>Phone Number</b> Format.";
    }
    if($pass1 == NULL){
        $errMsg["pass1"] = "Please enter <b>Password</b>.";
    }elseif(!preg_match("/^[A-Za-z0-9]{8,20}$/", $pass1)){
        $errMsg['pass1'] = "Invalid <b>Password</b> Format.";
    }
    if($pass2 != $pass1){
        $errMsg["cpass2"] = "<b>Comfirm Password</b> must match the password.";
    }
    
    return $errMsg;
}
