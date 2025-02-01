<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();

global $lastSST;
require_once './database/db.php';
$db = new mysqli(HOST, USER, PASS, NAME);
$sql = "select sst from event";
$ans = $db->query($sql);
if($row = $ans->fetch_object()){
    $lastSST = $row->sst;
}
$db->close();

$total = 0;
foreach($_SESSION['shopping_cart'] as $key => $values){
    $total += ($values['item_price'] * $values['item_quantity']);
}
$sstTotal = $total * $lastSST;
$grandTotal = $total + $sstTotal;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL | Check Out</title>
    </head>
    <style>
        .border{
            border: 1px blue solid;
        }
    </style>
    <script>
    function isNum(evt){
        var ch = String.fromCharCode(evt.which);
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();
        }
    }
    </script>
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
        <div style="padding-left: 15%;padding-right: 15%;">
        <table class="centered">
            <div style="text-align: center;padding-left: 30%;padding-right: 30%;padding-top: 5%;">
                <?php 
                echo "<span style='font-size: 40px;'>Your total is RM".number_format($grandTotal, 2)."</span><br/>";
                echo "<span style='font-size: 23px;'>Pay securely with a credit card.</span>";
                ?>
            </div>
            
                <tr>
                    <td><img src="img/visa.png" id="visa"/></td>
                    <td><img src="img/mastercard.png" id="mastercard"/></td>
                    <td><img src="img/americanexpress.png" id="american"/></td>
                </tr>
        <?php
        include './helperCheckOut.php';
        if(isset($_POST['proceed'])){
            $error = check();
            if(!empty($error)){  //error in purchasing
                //found error, display them
                echo "<div class='error' style='font-size:18px;'>"; 
                printf("&bull; %s", implode("<br/>&bull; ", $error));
                echo "</div>";
            }else{  //no error in purchasing, store into database
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                if(isset($_SESSION['ic'])){     //login member
                    $sql = "INSERT INTO ticket (num_of_ticket, e_ID, name, email, icNum) VALUES (?,?,?,?,?)";
                    $sql1 = "update event set ticket = ticket - ? where e_ID = ?";
                    foreach($_SESSION['shopping_cart'] as $key => $values){
                        //pass value into parameters
                        //i-integer, d-double, s-string
                        $run = $db->prepare($sql);
                        $run->bind_param("issss", $values['item_quantity'], $values['item_id'], 
                                $_SESSION['name'], $_SESSION['email'], $_SESSION['ic']);
                        $run->execute();
                        
                        $run1 = $db->prepare($sql1);
                        $run1->bind_param("is", $values['item_quantity'], $values['item_id']);
                        $run1->execute();
                    }
                    if($run->affected_rows > 0 && $run1->affected_rows > 0){   //if success, display result
                        $name = $_SESSION['name'];
                        $count = 1;
                        $total = 0;

                        //the subject
                        $subject = "Thank You for Purchasing!";
                        //the message
                        $message = "<h4>Dear $name,</h4><br/>We appreciate your recent purchase of tickets. We value
                            your trust in our company, and we will do our best to meet your service expectations. Below
                            are the Event Details of your purchase.<br/><h2>Event Details</h2>
                            <table border='1' cellpadding='10' cellspacing='0'><tr>
                                <th>No.</th>
                                <th>Event Name</th>
                                <th>Event Location</th>
                                <th>Event Date & Time</th>
                                <th>Quantity</th>
                                <th>Unit Price(RM)</th>
                                <th>Total Price(RM)</th></tr>";

                        foreach ($_SESSION['shopping_cart'] as $key => $value){
                            require_once './database/db.php';
                            $con = new mysqli(HOST, USER, PASS, NAME);
                            $code = "SELECT e_Name, e_Loc, startDate, startTime FROM event WHERE e_ID = '".$value['item_id']."'";
                            $res = $con->query($code);
                            if($rw = $res->fetch_object()){
                                $message .= "<tr><td>$count</td>
                                        <td>$rw->e_Name</td>
                                        <td>$rw->e_Loc</td>
                                        <td>$rw->startDate, $rw->startTime</td>
                                        <td>".$value['item_quantity']."</td>
                                        <td>".$value['item_price']."</td>
                                        <td>".number_format(($value['item_quantity'] * $value['item_price']), 2)."</td></tr>";
                                $total += ($value['item_quantity'] * $value['item_price']);
                            }
                            $count++;
                        }
                        $sstTotal = $total * $lastSST;
                        $grandTotal = $total + $sstTotal;
                        $message .= "<tr><td colspan='6' align='right'>SST (".($lastSST * 100)."%%)</td>
                            <td>".number_format($sstTotal, 2)."</td></tr>
                            <tr><td colspan='6' align='right'>Grand Total (RM)</td>
                                <td>".number_format($grandTotal, 2)."</td></tr></table><br/>
                                Thanks again, for your order. If you have any question, please don't hesitate to email us.";
                        $con->close();

                        //recipient email here
                        $to = $_POST['email'];

                        $headers = "From: LYGL Company <abc@hotmail.com>\r\n";
                        $headers .= "Reply-To: $email\r\n";
                        $headers .= "Content-type: text/html\r\n";
                        //send email
                        mail($to,$subject,$message,$headers);
                        echo "<script>alert('Order Done! Receipt has been sent to your email.');window.location.href='event.php';</script>";
                        unset($_SESSION['shopping_cart']);
                    }else{
                        echo "<script>alert('Something went wrong.');</script>";
                    }
                    $run->free_result();
                    $run1->free_result();
                }else{        //non-member
                    isset($_POST['name'])? $name = trim($_POST['name']): $name = NULL;
                    isset($_POST['email'])? $email = trim($_POST['email']): $email = NULL;
                    isset($_POST['ic'])? $ic = trim($_POST['ic']): $ic = NULL;
                    $sql = "INSERT INTO ticket (num_of_ticket, e_ID, name, email, icNum) VALUES (?,?,?,?,?)";
                    $sql1 = "update event set ticket = ticket - ? where e_ID = ?";
                    foreach($_SESSION['shopping_cart'] as $key => $values){
                        //pass value into parameters
                        //i-integer, d-double, s-string
                        $run = $db->prepare($sql);
                        $run->bind_param("issss", $values['item_quantity'], $values['item_id'], $name, $email, $ic);
                        $run->execute();
                        
                        $run1 = $db->prepare($sql1);
                        $run1->bind_param("is", $values['item_quantity'], $values['item_id']);
                        $run1->execute();
                    }
                    if($run->affected_rows > 0 && $run1->affected_rows > 0){   //if success, display result
                        $count = 1;
                        $total = 0;

                        //the subject
                        $subject = "Thank You for Purchasing!";
                        //the message
                        $message = "<h4>Dear $name,</h4><br/>We appreciate your recent purchase of tickets. We value
                            your trust in our company, and we will do our best to meet your service expectations. Below
                            are the Event Details of your purchase.<br/><h2>Event Details</h2>
                            <table border='1' cellpadding='10' cellspacing='0'><tr>
                                <th>No.</th>
                                <th>Event Name</th>
                                <th>Event Location</th>
                                <th>Event Date & Time</th>
                                <th>Quantity</th>
                                <th>Unit Price(RM)</th>
                                <th>Total Price(RM)</th></tr><tr>";

                        foreach ($_SESSION['shopping_cart'] as $key => $value){
                            require_once './database/db.php';
                            $con = new mysqli(HOST, USER, PASS, NAME);
                            $code = "SELECT e_Name, e_Loc, startDate, startTime FROM event WHERE e_ID = '".$value['item_id']."'";
                            $res = $con->query($code);
                            if($rw = $res->fetch_object()){
                                $message .= "<td>$count</td>
                                        <td>$rw->e_Name</td>
                                        <td>$rw->e_Loc</td>
                                        <td>$rw->startDate, $rw->startTime</td>
                                        <td>".$value['item_quantity']."</td>
                                        <td>".$value['item_price']."</td>
                                        <td>".number_format(($value['item_quantity'] * $value['item_price']), 2)."</td></tr>";
                                $total += ($value['item_quantity'] * $value['item_price']);
                            }
                            $count++;
                        }
                        $sstTotal = $total * $lastSST;
                        $grandTotal = $total + $sstTotal;
                        $message .= "<tr><td colspan='6' align='right'>SST (".($lastSST * 100)."%%)</td>
                            <td>".number_format($sstTotal, 2)."</td></tr>
                            <tr><td colspan='6' align='right'>Grand Total (RM)</td>
                                <td>".number_format($grandTotal, 2)."</td></tr></table><br/>
                                Thanks again, for your order. If you have any question, please don't hesitate to email us.";
                        $con->close();

                        //recipient email here
                        $to = $_POST['email'];

                        $headers = "From: LYGL Company <abc@hotmail.com>\r\n";
                        $headers .= "Reply-To: $email\r\n";
                        $headers .= "Content-type: text/html\r\n";
                        //send email
                        mail($to,$subject,$message,$headers);
                        echo "<script>alert('Order Done! Receipt has been sent to your email.');window.location.href='event.php';</script>";
                        unset($_SESSION['shopping_cart']);
                    }else{
                        echo "<script>alert('Something went wrong.');</script>";
                    }
                    $run->free_result();
                    $run1->free_result();
                }
                $db->close();
            }
        }
       
        ?>
        
        <form action="" method="post">
                <tr class="row">
                    <td>Name:</td>
                    <td>
                        <input type="text" name="name" id="name" oninput="checkName();" 
                               value="<?php echo isset($_SESSION['name'])?$_SESSION['name']:"";?>"/>
                    </td>
                    <td id="name1" class="error"/></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" id='email'
                               oninput="checkEmail();" required="required"
                               value="<?php echo isset($_SESSION['email'])?$_SESSION['email']:"";?>"/></td>
                    <td id="email1" class='error'></td>
                </tr>
                <tr>
                    <td>IC Number:</td>
                    <td><input name='ic' id='ic' oninput='checkIC();' maxlength="14"
                               value='<?php echo isset($_SESSION['ic'])?$_SESSION['ic']:""; ?>'/></td>
                    <td id='ic1' class='error'></td>
                </tr>
                
<!--                <tr>
                    <td>Address:</td>
                    <td><input type="text" name="address" value="" oninput="checkAddress();" id="address"/></td>
                    <td id="address1" class="error"></td>
                </tr>
                <tr class="row">
                    <td>City and Postal Code</td>
                    <td>
                        <div class="input-field col s8">
                            <input type="text" name="city" id="city"/>
                        </div>
                        <div class="input-field col s4">
                            <input type="text" maxlength="5" onkeypress="isNum(event);"/>
                        </div>
                    </td>
                </tr>-->
                
                <tr>
                    <td>Card Number:</td>
                    <td><input type="text" name="card" id="card" maxlength="16" oninput="checkCard();" pattern="[0-9]{16}"
                               required="required" onkeypress="isNum(event);" placeholder="1234567812345678"/></td>
                    <td id="card1" class="error"></td>
                </tr>
                <tr class="row">
                    <td>Expiration Date and Security Code: </td>
                    <td>
                        <div class="input-field col s4">
                            <select class="browser-default" name="date1" required="required">
                                <option value="">--</option>
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div class="input-field col s4">
                            <select class="browser-default" name="date2" required="required">
                                <option value="">----</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                            </select>
                        </div>
                        <div class="input-field col s4">
                            <input type="text" maxlength="4" placeholder="CVC" pattern="[0-9]{3,4}"
                                   onkeypress="isNum(event);" name="pin" required="required"/>
                        </div>
                        
                    </td>
                    <td class="error" id="code1"></td>
                </tr>
                
                <tr><td></td>
                    <td><button type="submit" class="btn waves-effect waves-light" name="proceed">Proceed</button>
                        <button type="button" value="Cancel" name="btnCancel" onclick="location='shopping_cart.php'" 
                                class="btn waves-effect waves-light" style="background-color: #ef5350;">Cancel</button>
                    </td>
                    <td></td>
                </tr>
        </form>
       </table>
            </div>
        <script>
        $(document).ready(function(){
           $('#visa').click(function(){
               $('#visa').toggleClass('border');
               $('#mastercard').removeClass('border');
               $('#american').removeClass('border');
           });
           $('#mastercard').click(function(){
              $('#mastercard').toggleClass('border');
              $('#visa').removeClass('border');
              $('#american').removeClass('border');
           });
           $('#american').click(function(){
              $('#american').toggleClass('border');
              $('#visa').removeClass('border');
              $("#mastercard").removeClass('border');
           });
        });
        </script>
    </body>
</html>

<!--
set @autoid :=0; 
update ticket set t_ID = @autoid := (@autoid+1);
alter table ticket Auto_Increment = 1;
-->