<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

isset($_POST['userID'])? $id = trim($_POST['userID']): $id = null;
isset($_POST['email'])? $email = trim($_POST['email']): $email = null;
isset($_POST['q1'])? $q1 = trim($_POST['q1']): $q1 = null;
isset($_POST['q2'])? $q2 = trim($_POST['q2']): $q2 = null;
isset($_POST['a1'])? $a1 = trim($_POST['a1']): $a1 = null;
isset($_POST['a2'])? $a2 = trim($_POST['a2']): $a2 = null;

function valid(){
    global $id, $email, $q1, $q2, $a1, $a2;
    $err = array();
    
    if($id == null){
        $err["id"] = "Please enter <b>Username</b>.";
    }
    if($email == null){
        $err["email"] = "Please enter <b>Password</b>.";
    }elseif(!preg_match("/^[\w@#$%]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/", $email)){
        $errMsg["email"] = "Invalid <b>Email Address</b> Format.";
    }
    if($q1 == null || $q2 == null){
        $err['q'] = "Please select <b>Security Question</b>.";
    }
    if($a1 == null || $a2 == null){
        $err['a'] = "Please answer <b>Security Answer</b>.";
    }
    return $err;
}
