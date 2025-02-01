<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
function checkLogin($uid, $passw, $sid, $spw){
    if($uid === $sid && $passw === $spw){
        return true;
    }
    return false;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL | Admin Login</title>
    <script type="text/javascript">
    function id(){
        var id = document.getElementById('userID1').value;
        if(id.length == 0){
            document.getElementById('id1').innerHTML = "Please enter <b>Username</b>.";
        }else{
            document.getElementById('id1').innerHTML = "";
        }
    }
    function pass(){
        var pass = document.getElementById('passw').value;
        if(pass.length == 0){
            document.getElementById('passw1').innerHTML = "Please enter <b>Password</b>.";
        }else{
            document.getElementById('passw1').innerHTML = "";
        }
    }
    </script>
    </head>
    
    <body>
        <header><?php include_once './header.php';?></header>
        
        <div style="padding-right: 40%;padding-left: 39%;">
            
            <h1 style="text-align: center;">Admin Login</h1>
        
        
            <form method="POST" action="">
            <div>
                <?php             
                $wrong = false;
                $wrong1 = false;
                if(isset($_POST["login"])){
                    require_once'./database/db.php';
                    $con = new mysqli(HOST, USER, PASS, NAME);    //db variable
                    global $uid, $passw;
                    isset($_POST["userID"])?$uid = trim($_POST["userID"]):$uid = NULL;
                    isset($_POST["passw"])?$passw = trim($_POST["passw"]):$passw = NUll;

                    $sql = "SELECT adminNo, adminUsername, adminPass FROM admin";
                    $stm = $con->query($sql);
                    while($row = $stm->fetch_object()){
                        $no = $row->adminNo;
                        $sid = $row->adminUsername;
                        $spw = $row->adminPass;
                        
                        if(checkLogin($uid, $passw, $sid, $spw)){    //store admin id into session
                            $_SESSION['no'] = trim($no);
                            $_SESSION['adminUser'] = trim($sid);
                            header("Location: adminEventList.php");
                        }else{
                            $wrong = true;
                        }
                   }
                }
                if($wrong == true){    //reload the page for user to login again if failed
                   echo "<span class='error'>Incorrect <b>Username</b> or <b>Password</b>!</span>";
                }
               ?>

            </div>
                <div class="input-group">
                <label>Username</label>
                <input type="text" name="userID" id="userID1" oninput="checkID();" placeholder="Enter your username...."/>
                <span id="id1"></span>
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="passw" id="passw" oninput="checkPsw();" placeholder="Enter your password...."/>
                <span id="passw1"></span>
            </div>
                
                <div class="btm" style="text-align: center;">
                    <button type="submit" name="login"
                            class="waves-effect waves-light btn-large" style="width: 200px;background-color: #00bcd4;">Sign In</button>
                </div>
        </form>
        </div>
    </body>
</html>
