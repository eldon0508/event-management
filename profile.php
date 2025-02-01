<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
function getQ1(){
    return array("" => "---Choose One---",
        1 => "What is your primary school name?",
        2 => "What is your first car?",
        3 => "What was your childhood nickname? ",
        4 => "What is your first pet name?",
        5 => "What is your hobby?");
}
function getQ2(){
    return array("" => "---Choose One---",
        6 => "What is the title and artist of your favorite song?",
        7 => "What is your car’s license plate number?",
        8 => "What street did you live on in third grade?",
        9 => "What is your favourite pet?",
        10 => "What is your favourite color?");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL | Profile</title>
    </head>
    <header>
        <?php
            if(isset($_SESSION['ic'])){
                include './header-login.php';
            }else{
                include './header.php';
            }
            ?>
    </header>
    <div class="container">
    <h1>My Profile</h1>

    <form method="post" action="">
                <table class="input-group">
                    
                        <?php 
                        if(isset($_SESSION['ic'])){   //if user has login
                            require_once './database/db.php';
                            $con = new mysqli(HOST, USER, PASS, NAME);
                            $sql = "SELECT * FROM member WHERE icNum = '".$_SESSION['ic']."'";
                            $result = $con->query($sql);
                            if($row = $result->fetch_object()){
                                $user = $row->username;
                                $name = $row->name;
                                $email = $row->email;
                                $pNum = $row->phone_no;
                                $pass = $row->password;
                                $q1 = $row->q1;
                                $a1 = $row->a1;
                                $q2 = $row->q2;
                                $a2 = $row->a2;
                                $result->free();
                                $con->close();
                            }
                        }else{
                            header("Location: login.php");
                        }
                        if(isset($_POST['submit'])){
                            header("Location: edit-profile.php");
                        }
                        ?>
                    <tr>
                        <td>Username :</td>
                        <td><?php echo $user; ?></td>
                    </tr>
                    <tr>
                        <td>Password :</td>
                        <td><?php echo str_repeat("&bull;", strlen($pass)); ?></td>
                    </tr>
                    <tr>
                        <td>Name :</td>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <td>IC Number :</td>
                        <td><?php echo $_SESSION['ic']; ?></td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number :</td>
                        <td><?php echo $pNum; ?></td>
                    </tr>
                    <tr>
                        <td>Recovery Question 1 :</td>
                        <td><?php $allQ1 = getQ1();
                        echo $allQ1[$q1]; ?></td>
                    </tr>
                    <tr>
                        <td>Answer 1 :</td>
                        <td><?php echo str_repeat("&bull;", strlen($a1)); ?></td>
                    </tr>
                    <tr>
                        <td>Recovery Question 2 :</td>
                        <td><?php $allQ2 = getQ2();
                        echo $allQ2[$q2]; ?></td>
                    </tr>
                    <tr>
                        <td>Answer 2 :</td>
                        <td><?php echo str_repeat("&bull;", strlen($a2)); ?></td>
                    </tr>
                </table><br/><br/>
                <button type="submit" class="btn-floating pulse" name="submit"><i class="material-icons">mode_edit</i></button>
        </form>
    </div>
    </body>
</html>
