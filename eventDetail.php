<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();

global $ticket;
//check what method used
if($_SERVER["REQUEST_METHOD"] == "GET"){    //if get method
    require_once './database/db.php';
    $db = new mysqli(HOST, USER, PASS, NAME);
    $id = strtoupper(trim($_GET['id']));     //get the event ID from URL
    $sql = "SELECT e_Name, e_Desc, e_Loc, startDate, startTime, endDate, endTime, fee, price, ticket, img FROM event WHERE e_ID = '$id'";
    //retrieve all information from database according to Event ID
    $result = $db->query($sql);
    if($row = $result->fetch_object()){
        $name = $row->e_Name;
        $desc = $row->e_Desc;
        $loc = $row->e_Loc;
        $start = $row->startDate." ".$row->startTime;
        $end = $row->endDate." ".$row->endTime;
        $fee = $row->fee;
        $price = $row->price;
        $ticket = $row->ticket;
        $img = $row->img;
    }
}else{           //if(isset($_POST['add_to_cart'])){
//    if($_POST['quantity'] > $ticket){
//        echo "<script>alert('Insufficient stock of tickets.');window.location.href='event.php';</script>";
//    }else{
        if(isset($_SESSION['shopping_cart'])){    /* there is something inside the shopping cart 
            then check whether the chosen item is inside the array or not */
            $item_id = array_column($_SESSION['shopping_cart'], "item_id");    //use variable to store all item id from cart
            if(!in_array($_GET['id'], $item_id)){     //not inside array, add the new item into cart
                $item = array(
                    "item_id" => $_GET['id'],
                    "item_name" => $_POST['hideName'],
                    "item_price" => $_POST['hidePrice'],
                    "item_quantity" => $_POST['quantity']
                        );
                $_SESSION['shopping_cart'][] = $item;
                echo "<script>alert('".$_POST['hideName']." has been added into your shopping cart.');window.location.href='event.php'</script>";
            }else{          //already inside array, pop up message to inform user
                printf("<script>alert('%s already inside your shopping cart. Please remove it before adding.')</script>", $_POST['hideName']);
                echo "<script>window.location.href='shopping_cart.php';</script>";
            }
        }else{      //nothing inside the shopping cart
            $item = array(
                    "item_id" => $_GET['id'],
                    "item_name" => $_POST['hideName'],
                    "item_price" => $_POST['hidePrice'],
                    "item_quantity" => $_POST['quantity']
                        );
            $_SESSION['shopping_cart'][0] = $item;
            echo "<script>alert('".$_POST['hideName']." has been added into your shopping cart.');window.location.href='event.php'</script>";
        }
    }
    $db->close();
//}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL | <?php echo $name;?></title>
        <script>
        
        </script>
        <style>
            .word{
                font-size: 18px;
            }
            pre {
                overflow-x: auto;
                white-space: pre-wrap;
                white-space: -moz-pre-wrap;
                white-space: -pre-wrap;
                white-space: -o-pre-wrap;
                word-wrap: break-word;
                line-height: 35px;
            }
        </style>
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
        <div style="padding-left: 25%;padding-right: 28%;padding-top: 8px;">
            <img width="900" src="eventImg/<?php echo $img; ?>">
            
            <ul class="collapsible">
                <li>
                    <div class="collapsible-header" id="description"><i class="material-icons">description</i>Description</div>
                    <div class="collapsible-body" id="detail_description"><span>
                        <?php echo "<pre style='font-family: Segoe UI;' class='word'>$desc</pre>";?></span></div>
                </li>
                <li>
                    <div class="collapsible-header" id="location"><i class="material-icons">place</i>Location</div>
                    <div class="collapsible-body" id="detail_location"><span><?php echo "<p class='word'>$loc</p>";?></span></div>
                </li>
                <li>
                    <div class="collapsible-header" id="time"><i class="material-icons">access_time</i>Date And Time</div>
                    <div class="collapsible-body" id="detail_time"><span>
                            <table>
                                <tr>
                                    <th class="word">Start</th>
                                    <th class="word">End</th>
                                </tr>
                                <tr>
                                    <td><?php echo "<p class='word'>$start</p>";?></td>
                                    <td><?php echo "<p class='word'>$end</p>";?></td>
                                </tr>
                            </table>
                        </span></div>
                </li>
            </ul>
        </div>
        
        <form action="" method="POST">
            <div style="padding-left: 25%;padding-right: 28%;padding-bottom: 50px;">
                
                <label>Quantity</label>
                <select class="browser-default" name="quantity">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                
                <br/><br/>
                <input type="hidden" value='<?php echo $name;?>' name="hideName"/>
                <input type="hidden" value='<?php echo $price;?>' name='hidePrice'/>
                <table style="border: 0px;" class="word">
                    <tr>
                        <td><?php echo ($fee == 'P')?"&nbsp;&nbsp;<i class='material-icons'>attach_money</i>RM".number_format($price, 2):
                            "&nbsp;&nbsp;Free";?></td>
                        <td><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;Stock left : $ticket";?></td>
                        <td>
                            <button class="btn-floating pulse btn-large" name="add_to_cart" id="add_to_cart" 
                                    type="submit" style="background-color: #ffa726;" ><i class="material-icons left">add_shopping_cart</i>
                            </button>
                        </td>
                    </tr>
                </table>
                
            </div>
        </form>
        <script>
        $(document).ready(function(){
            $('#description').click(function(){
                $('#detail_description').slideToggle("slow");
                $('#detail_location').slideUp("slow");
                $('#detail_time').slideUp("slow");
            });
            $('#location').click(function(){
                $('#detail_location').slideToggle("slow");
                $('#detail_description').slideUp("slow");
                $('#detail_time').slideUp("slow");
            });
            $('#time').click(function(){
                $('#detail_time').slideToggle("slow");
                $('#detail_location').slideUp("slow");
                $('#detail_description').slideUp("slow");
            });
        });
        </script>
    </body>
</html>
<?php
if($ticket <= 0){    //if ticket out of stock, disable the add to cart button
    echo "<script>";
    echo "$('#add_to_cart').prop('disabled', true);";
    echo "</script>";
}else{
    echo "<script>";
    echo "$('#add_to_cart').prop('disabled', false);";
    echo "</script>";
}
?>