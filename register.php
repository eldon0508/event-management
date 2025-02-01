<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
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
        <title>LYGL | Sign Up</title>

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
        <div style="padding-right: 28%;padding-left: 28%;">
            
            <h1>Registration</h1>
            <script src="helperRegister.js" type="text/javascript"></script>
        <form method="POST" action="">
                    <?php
                    include './helperRegister.php';
                    
                    $errMsg = validate($uid, $name, $ic, $email, $phnum, $passw, $cpassw, $q1, $a1, $q2, $a2);
                    $status = "A";

                    if(isset($_POST['register'])){
                        if(!empty($errMsg)){
                            echo "<div class='error' style='font-size:18px;'>"; 
                            printf("&bull; %s", implode("<br/>&bull; ", $errMsg));
                            echo "</div>";
                        }else{
                            //Step 1: establish connection
                            require_once './database/db.php';
                            $con = new mysqli(HOST,USER,PASS,NAME);

                            //Step 2:Sql
                            $sql = "INSERT INTO member (username, name, icNum, email, 
                                    phone_no, password, q1, a1, q2, a2, u_status) VALUES(?,?,?,?,?,?,?,?,?,?,?)";

                            //Step 3:Execute Sql
                            $stm = $con->prepare($sql);
                            $stm->bind_param("ssssssisiss", $uid, $name, $ic, $email, 
                                    $phnum, $passw, $q1, $a1, $q2, $a2, $status);
                            $stm->execute();

                            //done resgister
                            if($stm->affected_rows > 0){
                                echo "You are one of us now!<a href='login.php'>[Login Now!]</a>";
                            }else{
                                echo "You are one step away to become our family. Try again.";
                            }
                        }
                    }
                    ?>
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="userID" id="userID1" oninput="checkID();" 
                       value="<?php (isset($_POST['userID'])?$uid = trim($_POST['userID']):$uid = NULL); echo $uid;?>"/>
                <span id="id1" class="error"></span>
            </div>
            
            <div class="input-group">
                <label>Name</label>
                <input type="text" name="name" id="name1" oninput="checkName();" 
                       value="<?php (isset($_POST['name'])?$name = trim($_POST['name']):$name = NULL); echo $name;?>"/>
                <span id="nm1" class="error"></span>
            </div>
            
            <div class="input-group">
                <label>IC Number</label>
                <input type="text" name="ic" id="ic" oninput="checkIC();" 
                       pattern="([0-9][0-9])((0[1-9])|(1[0-2]))((0[1-9])|([1-2][0-9])|(3[0-1]))\-([0-9][0-9])\-([0-9][0-9][0-9][0-9])"
                       value="<?php (isset($_POST['ic'])?$ic = trim($_POST['ic']):$ic = NULL); echo $ic;?>"/>
                <span id="ic1" class="error"></span>
            </div>
            
            <div class="input-group">
                <label>Email Address</label>
                <input type="text" name="email" id="email1" oninput="checkEmail();" 
                       value="<?php (isset($_POST['email'])?$email = trim($_POST['email']):$email = NULL); echo $email;?>"/>
                <span id="em1" class="error"></span>
            </div>
            
            <div class= "input-group">
                <label>Phone Number</label>
                <input type="tel" name="phonenum" id="phonenum1" oninput="checkPhoneNum();" pattern="01[0-9]-[0-9]{7,8}" 
                       value="<?php (isset($_POST['phonenum'])?$phnum = trim($_POST['phonenum']):$phnum = NULL); echo $phnum;?>"/>
                <span id="pn1" class="error"></span>
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="passw" id="passw" oninput="checkPsw();" 
                       value="<?php (isset($_POST['passw'])?$passw = trim($_POST['passw']):$passw = NULL); echo $passw;?>"/>
                <span id="passw1" class="error"></span>
            </div>  
            
            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="cpassw" id="cpassw" oninput="checkCPsw();"
                       value="<?php (isset($_POST['cpassw'])?$cpassw = trim($_POST['cpassw']): $cpassw = NULL); echo $cpassw;?>"/>
                <span id="passw2" class="error"></span>
            </div>
            
            <div class="input-group">
                    <label>Question 1</label>
                <div class="row">
                    <div class="input-field col s4">
                        <select name="q1" class="browser-default" required="required">
                        <?php
                        $question1 = getQ1();
                        foreach($question1 as $key => $value){
                            printf("<option value='%s' %s>%s</option>", $key, ($q1==$key)?"selected='selected'":"", $value);
                        }
                        ?>
                    </select>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" name="a1" 
                               value="<?php isset($_POST['a1'])?$a1 = trim($_POST['a1']):$a1 = NULL; echo $a1; ?>"/>
                    </div>
                </div>
            </div>
            <div class="input-group">
                    <label>Question 2</label>
                <div class="row">
                    <div class="input-field col s4">
                        <select name="q2" class="browser-default" required="required">
                        <?php
                        $question2 = getQ2();
                        foreach($question2 as $key => $value){
                            printf("<option value='%s' %s>%s</option>", $key, ($q2==$key)?"selected='selected'":"", $value);
                        }
                        ?>
                    </select>
                    </div>
                    <div class="input-field col s4">
                    <input type="text" name="a2" 
                           value="<?php isset($_POST['a2'])?$a2 = trim($_POST['a2']):$a2 = NULL; echo $a1; ?>"/>
                    </div>
                </div>
            </div>
            
            <div class="btm">
                <button type="submit" name="register" class="btn waves-effect waves-light">Register</button>
            </div>
            <p>
                Already a member? <a href="login.php">Sign in</a>
            </p>
                
        </form>
    </body>
</html>
