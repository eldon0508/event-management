<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
$header = array("No.", "Event Name", "Quantity", "Unit Price(RM)", "Price(RM)");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL | Purchase History</title>
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
        
        <div class="container"><h1>Purchase History</h1></div>
        
        <div style="padding-left: 15%;padding-right: 15%;">
        <table>
            
        <?php
        echo "<tr>";
        foreach($header as $value){
            echo "<th>$value</th>";
        }
        echo "</tr>";
        
        require_once './database/db.php';
        $db = new mysqli(HOST, USER, PASS, NAME);
        $user = $_SESSION['ic'];
        if(isset($user)){     //only member could see purchase history
            $count = 1;
            $sql = "SELECT e_Name, num_of_ticket, price from event e, ticket t where e.e_ID = t.e_ID AND t.icNum = '$user'";
            $res = $db->query($sql);
            while($row = $res->fetch_object()){
                printf("<tr>
                        <td>%d.</td>
                        <td>%s</td>
                        <td>%d</td>
                        <td>%.2f</td>
                        <td>%.2f</td>
                        </tr>",$count, $row->e_Name, $row->num_of_ticket, $row->price, $row->price * $row->num_of_ticket);
                $count++;
            }
        }else{        //if not member
            header("Location: login.php");
        }
        
        ?>
        </table>
            <div style="padding-top: 25px;">
            <?php printf("<b>You have purchased %d event(s).</b>", $count - 1);?>
            </div>
        </div>
        
        
    </body>
</html>

