<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if(isset($_GET['action']) == "delete"){
    foreach ($_SESSION['shopping_cart'] as $key => $values){
        if($values['item_id'] == $_GET['id']){
            unset($_SESSION['shopping_cart'][$key]);
            echo "<script>alert('Item removed! You can continue to shop.');window.location.href='event.php';</script>";
        }
    }
}
global $lastSST;
require_once './database/db.php';;
$db = new mysqli(HOST, USER, PASS, NAME);
$code = "select sst from event";
$ans = $db->query($code);
if($row = $ans->fetch_object()){
    $lastSST = $row->sst;
}
$db->close();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL | Shopping Cart</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <style>
            table th{
                text-align: center;
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
        <div style="padding-left: 20%;padding-right: 20%;">
            <h1>Shopping Cart</h1>

        <form method="post" action="">
            
                <?php
                $count = 1;
                $total = 0;
                if(!empty($_SESSION['shopping_cart'])){   //there is stuff inside shopping cart
                    echo "<table class='centered'><tr>
                        <th>No.</th>
                        <th>Event ID</th>
                        <th>Event Name</th>
                        <th>Quantity</th>
                        <th>Unit Price(RM)</th>
                        <th>Total(RM)</th>
                        <th>Action</th>
                        </tr>";
                    foreach($_SESSION['shopping_cart'] as $key => $values){
                        echo "<tr>";
                        printf("<td>%d</td>
                            <td>%s</td>
                            <td style='text-align: left;'>%s</td>
                            <td>%d</td>
                            <td>%.2f</td>
                            <td>%.2f</td>
                            <td><a href='?action=delete&id=%s'>Remove<i class='material-icons left'>remove_shopping_cart</i></a></td>", 
                                $count, $values['item_id'], $values['item_name'], 
                                $values['item_quantity'], $values['item_price'],
                                ($values['item_price'] * $values['item_quantity']), $values['item_id']);
                        $total += ($values['item_price'] * $values['item_quantity']);
                        echo "</tr>";
                        $count++;
                    }
                    $sstTotal = $total * $lastSST;
                    $grandTotal = $total + $sstTotal;
                    printf("<tr><td colspan='4'></td><td align='right'>SST (%s%%)</td><td>%.2f</td><td></td></tr>", 
                            $lastSST * 100, number_format($sstTotal, 2));
                    echo "<tr><td colspan='4'></td><td align='right'>Grand total (RM)</td><td>".
                            number_format($grandTotal,2)."</td><td></td></tr></table>";
                    echo "<div><a href='check-out.php'>Check Out<i class='material-icons left'>payment</i></a></div>";
                        printf("<p>There is %d item(s) in shopping cart.</p>", $count - 1);
                }else{    //there is nothing in shopping cart
                    printf("<p>There is %d item(s) in shopping cart.</p>", $count - 1);
                }
                ?>
        </form>
        </div>
    </body>
</html>
