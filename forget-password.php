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

function checkForget($dID,$id,$dEmail,$email,$dQ1,$q1,$dQ2,$q2,$dA1,$a1,$dA2,$a2){
    if($dID === $id && $dEmail === $email && $dQ1 === $q1 && $dA1 === $a1 && $dQ2 === $q2 && $dA2 === $a2){
        return true;
    }
    return false;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Password Recovery</title>
    </head>
    <body>
        <header><?php include './header.php';?></header>        
        <div style="padding-right: 28%;padding-left: 28%;">
            <h3 style="text-align: center;">Password Recovery</h3>
            <form method="post" action="">
        <?php
        if(isset($_POST['reset'])){
            include './helperForget.php';
            $wrong = true;
            $err = valid();
            if(!empty($err)){
                //found error, display them
                echo "<div class='error' style='font-size:18px;'>"; 
                printf("&bull; %s", implode("<br/>&bull; ", $err));
                echo "</div>";
            }else{    //no error
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $sql = "select username, name, email, q1, a1, q2, a2 from member";
                $run = $db->query($sql);
                while($row = $run->fetch_object()){
                    $dID = $row->username;
                    $name = $row->name;
                    $dEmail = $row->email;
                    $dQ1 = $row->q1;
                    $dQ2 = $row->q2;
                    $dA1 = $row->a1;
                    $dA2 = $row->a2;
                    if(checkForget($dID,$id,$dEmail,$email,$dQ1,$q1,$dQ2,$q2,$dA1,$a1,$dA2,$a2)){
                        include_once './mailForget.php';
                        echo "<script>alert('A recovery password email has been sent. Please check your mailbox.');</script>";
                        echo "<script>window.location.href='login.php';</script>";
                    }else{
                        $wrong = false;
                    }
                }
                if($wrong == false){
                    echo "<span class='error'><b>Account Detail not matches</b>!</span>";
                }
                $db->close();
            }
        }
        
        ?>
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="userID" id="userID1" placeholder="Enter your username...." 
                           value="<?php isset($_POST['userID'])? $id = trim($_POST['userID']): $id = null; echo $id; ?>" />
                    <span id="id1"></span>
                </div>  
                
                <div class="input-group">
                    <label>Email Address</label>
                    <input type="text" name="email" id="email1"  placeholder="Enter your email...."
                           value="<?php isset($_POST['email'])? $email = trim($_POST['email']): $email = null; echo $email; ?>"/>
                    <span id="em1" class="error"></span>
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
                                   value="<?php isset($_POST['a2'])?$a2 = trim($_POST['a2']):$a2 = NULL; echo $a2; ?>"/>
                            </div>
                        </div>
                    </div>
                
                <div class="btm" style="text-align: center;">
                    <button type="submit" name="reset"
                            class="waves-effect waves-light btn-large" style="width: 200px;background-color: #00bcd4;">Recover</button>
                </div>
            <form>
        </div>
    </body>
</html>
