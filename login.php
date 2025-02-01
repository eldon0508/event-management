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
        <title>LYGL | Login</title>
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
        <header>
            <?php
            if(isset($_SESSION['ic'])){
                include './header-login.php';
            }else{
                include './header.php';
            }
            ?>
        </header>
        
        <div style="padding-right: 40%;padding-left: 39%;">
            
            <h1 style="text-align: center;">Login</h1>
        
        
            <form method="POST" action="">
            <div>
                <?php
                if(isset($_POST["login"])){
                    $wrong = false;
                    $wrong1 = false;
                    require_once'./database/db.php';
                    $con = new mysqli(HOST, USER, PASS, NAME);//db variable
                    global $uid, $passw;
                    isset($_POST["userID"])?$uid = trim($_POST["userID"]):$uid = NULL;
                    isset($_POST["passw"])?$passw = trim($_POST["passw"]):$passw = NULL;

                    $sql = "SELECT username, name, password, icNum, email, u_status FROM member";  //retrieve data from database
                    $stm = $con->query($sql);

                    while($row = $stm->fetch_object()){
                        $sid = $row->username;
                        $spw = $row->password;
                        $name = $row->name;
                        $ic = $row->icNum;
                        $email = $row->email;
                        $status = $row->u_status;
                        if($status == 'A'){
                            if(checkLogin($uid, $passw, $sid, $spw)){    //store user detail into session
                                $_SESSION['ic'] = trim($ic);
                                $_SESSION['name'] = trim($name);
                                $_SESSION['email'] = trim($email);
                                //if success login, redirect to browse event page
                                header("Location: event.php");
                            }else{
                                //not match account detail
                                $wrong = true;
                                
                            }
                        }else{    //user has been deactivated
                            $wrong1 = true;
                            
                        }
                    }
                    if($wrong == true){    //show error message on invalid detail
                        echo "<span class='error'>Incorrect <b>Username</b> or <b>Password</b>!</span><br/>";
                    }elseif($wrong1 == true){   //show error message deactivated account
                        echo "<span class='error'>Your Account has been <b>Deactivated</b>! [ <a href='reactiveAccount.php'>Reactive Account</a> ]</span>";
                    }else{
                        echo "";
                    }
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
                <p style="text-align: right;">
                    <a href="forget-password.php">Forgot your password? </a>
                </p>
                
                <div class="btm" style="text-align: center;">
                    <button type="submit" name="login"
                            class="waves-effect waves-light btn-large" style="width: 200px;background-color: #00bcd4;">Sign In</button>
                </div>
                <p style="text-align: center">
                    Don't have an account? <a href="register.php">Sign Up Now!</a>
                </p>
                
                
        </form>
        </div>
    </body>
</html>
