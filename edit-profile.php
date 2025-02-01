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
        <title>LYGL | Edit Profile</title>
        
    </head>
    <body>
        <?php 
        echo "<header>";
            if(isset($_SESSION['ic'])){
                include './header-login.php';
            }else{
                include './header.php';
            }
        echo "</header>";

                //connect to DataBase    
                require_once './database/db.php';
                
                $con = new mysqli(HOST, USER, PASS, NAME);
                $sql = "SELECT * FROM member WHERE icNum = '".$_SESSION["ic"]."'";
                $result = $con->query($sql);
                if($row = $result->fetch_object()){    //no error, retrieve all data
                    $username = $row->username;
                    $name = $row->name;
                    $email = $row->email;
                    $pNum = $row->phone_no;
                    $pass = $row->password;
                    $q1 = $row->q1;
                    $a1 = $row->a1;
                    $q2 = $row->q2;
                    $a2 = $row->a2;
                    $result->free();
                }else{    //error
                    header("Location: login.php");
                }
                $con->close();
        ?>
        
        <form method="POST" action="">
            <div class="container">
                <h1>Edit Profile</h1>
            </div>
            <div style="padding-right: 25%;padding-left: 25%;">
            <?php
             if(isset($_POST['update'])){
                 include './helperEditProfile.php';
                 $msg = checkEdit();    //store the error msg
                 
                if(!empty($msg)){    //if got error message
                    echo "<div class='error' style='font-size:18px;'>";
                    printf("&bull; %s", implode("<br/>&bull; ", $msg));
                    echo "</div>";
                    
                }else{       //if no error
                    $newName = trim($_POST['name']);
                    $newMail = trim($_POST['email']);
                    $newpNnum = trim($_POST['pNum']);
                    $pass2 = trim($_POST['cpw']);
                    $q1 = trim($_POST['q1']);
                    $q2 = trim($_POST['q2']);
                    $a1 = trim($_POST['a1']);
                    $a2 = trim($_POST['a2']);
                    
                    require_once './database/db.php';
                    $con = new mysqli(HOST, USER, PASS, NAME);
                    $sql = "UPDATE member SET name = ?, email = ?, phone_no = ?, password = ?,
                            q1 = ?, a1 = ?, q2 = ?, a2 = ? WHERE icNum = ?";
                    $result = $con->prepare($sql);
                    $result->bind_param("ssssisiss", $newName, $newMail, $newpNnum, $pass2, $q1, $a1, $q2, $a2, $_SESSION['ic']);
                    if($result->execute()){    //if update success
                        echo "<script>alert('Update Successful!');window.location.href='profile.php';</script>";
                    }else{
                        echo "<script>alert('Something went wrong!');window.location.href='profile.php';/script>";
                    }
                    $result->free_result();
                    $con->close();
                }
            }
            ?>
                <table class="input-group">
                    <tr>
                        <td>Username :</td>
                        <td><?php echo $username; ?></td><td></td>
                    </tr>
                    <tr>
                        <td>New Password :</td>
                        <td><input type="password" name="pw" id="pw" oninput="checkPass();"
                                   value="<?php echo $pass; ?>"/></td>
                        <td id="pw1" class="error"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password :</td>
                        <td><input type="password" name="cpw" id="cpw" value="<?php echo $pass; ?>"
                                   oninput="checkCpass();"/></td>
                        <td id="cpw1" class="error"></td>
                    </tr>
                    <tr>
                        <td>Name :</td>
                        <td><input type="text" value="<?php echo $_SESSION['name']; ?>" name="name" oninput="checkName();" id="name"/></td>
                        <td id="name1" class="error"></td>
                    </tr>
                    <tr>
                        <td>IC Number :</td>
                        <td><?php echo $_SESSION['ic']; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><input value="<?php echo $_SESSION['email']; ?>" name="email" id="email"/></td>
                        <td id="email1" class="error"></td>
                    </tr>
                    <tr>
                        <td>Phone Number :</td>
                        <td><input type="tel" pattern="01[0-9]-[0-9]{7,8}" name="pNum" value="<?php echo $pNum; ?>"/></td>
                        <td id="pNum1" class="error"></td>
                    </tr>
                    <tr>
                        <td>Recovery Question 1 :</td>
                        <td>
                            <select class="browser-default" name="q1">
                            <?php
                            $question1 = getQ1();
                            foreach($question1 as $key => $value){
                                printf("<option value='%s' %s>%s</option>", $key, ($q1==$key)?"selected='selected'":"", $value);
                            }
                            ?>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Answer 1 :</td>
                        <td><input type="password" name="a1" value="<?php echo $a1; ?>" /></td>
                        <td id="a1a" class="error"></td>
                    </tr>
                    <tr>
                        <td>Recovery Question 2 :</td>
                        <td>
                            <select class="browser-default" name="q2">
                            <?php
                                $question2 = getQ2();
                                foreach($question2 as $key => $value){
                                    printf("<option value='%s' %s>%s</option>", $key, ($q2==$key)?"selected='selected'":"", $value);
                                }
                            ?>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Answer 2 :</td>
                        <td><input type="password" name="a2" value="<?php echo $a2; ?>" /></td>
                        <td id="a2a" class="error"></td>
                    </tr>
                </table>
                
                <div style="padding: 25px;">
                    <button type="submit" name="update" class="btn waves-effect waves-light">Update</button>
                    <button type="button" onclick="location='profile.php'" class="btn waves-effect waves-red" 
                             style="background-color:#ef5350;">Cancel</button>
                </div>
        </form>
    </div>
    </body>
</html>
