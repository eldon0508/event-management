<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$random = generateRandomString();
//the subject
$subject = "Account Password Reset";
//the message
$message = "<h4>Dear $name,</h4><br/>You recently requested to reset your 
    password for your LYGL Company account. Your temporary password is <b>$random</b>.
    If you did not request a password reset, please ignore this email or reply to let us know. <br/>
    Thanks,<br/>LYGL Corporation Team<br/><b>P.S.</b> We also love hearing from you and helping you with any
    issue you have. Please reply to this email if you want to ask a question or just say hi.";
//recipient email here
$to = $dEmail;
                        
$headers = "From: LYGL Company <abc@hotmail.com>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-type: text/html\r\n";
//send email
mail($to,$subject,$message,$headers);

require_once './database/db.php';
$db = new mysqli(HOST, USER, PASS, NAME);
$sql = "update member set password = ? where username = ?";
$run = $db->prepare($sql);
$run->bind_param("ss", $random, $dID);
$run->execute();

