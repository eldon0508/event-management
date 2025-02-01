<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $name, $email, $ic, $card, $date1, $date2, $pin;

function check(){
    $err = array();
    if(isset($_POST['proceed'])){
        isset($_POST['name'])? $name = trim($_POST['name']): $name = NULL;
        isset($_POST['email'])? $email = trim($_POST['email']): $email = NULL;
        isset($_POST['ic'])? $ic = trim($_POST['ic']): $ic = null;
        isset($_POST['card'])? $card = trim($_POST['card']): $card = NULL;
        isset($_POST['date1'])? $date1 = trim($_POST['date1']): $date1 = NULL;
        isset($_POST['date2'])? $date2 = trim($_POST['date2']): $date2 = NULL;
        isset($_POST['pin'])? $pin = trim($_POST['pin']): $pin = NULL;
        
        
        if($name == NULL){
            $err['name'] = "Please enter <b>Name</b>.";
        }elseif(!preg_match("/^[A-Za-z \'\.\,]+$/", $name)){
            $err['name'] = "<b>Invalid Name Format</b>.";
        }
        if($email == NULL){
            $err['email'] = "Please enter <b>Email</b>.";
        }elseif(!preg_match("/^[\w@#$%]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/", $email)){
            $err['email'] = "<b>Invalid Email Format</b>.";
        }
        if($ic == NULL){
            $err['ic'] = "Please enter <b>IC Number</b>.";
        }elseif(!preg_match("/^([0-9][0-9])((0[1-9])|(1[0-2]))((0[1-9])|([1-2][0-9])|(3[0-1]))\-([0-9][0-9])\-([0-9][0-9][0-9][0-9])$/", $ic)){
            $err['ic'] = "Invalid <b>IC Number</b> Format.";
        }
        if($card == NULL){
            $err['card'] = "Please enter <b>Card Number</b>.";
        }elseif(!preg_match("/^\d{16}$/", $card)){
            $err['card'] = "Invalid <b>Card Number</b> Format";
        }
        if($date1 == NULL || $date2 == NULL){
            $err['date'] = "Please enter <b>Expiration Date</b>.";
        }
        if($pin == NULL){
            $err['pin'] = "Please enter <b>CVC</b> Number.";
        }elseif(!preg_match("/^[\d]{3,4}$/", $pin)){
            $err['pin'] = "Invalid <b>CVC</b> Format.";
        }
        
    }
    return $err;
}
