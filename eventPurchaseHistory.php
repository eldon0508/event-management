<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();

$header = array(
    "" => "No.",
    "name" => "Customer Name",
    "icNum" => "IC Number",
    "email" => "Email Address",
    "num_of_ticket" => "Tickets Purchased"
);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL Admin | Event Purchase History</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <header><?php include_once './adminheader.php';?></header>
        <div class="container"><h1>Purchase History</h1></div>
        <form method="post" action="" style="padding-right: 25%;padding-left: 25%;">
            <table>
                <?php
                echo "<tr>";
                foreach ($header as $key => $value){
                    printf("<th>%s</th>", $value);
                }
                echo "</tr>";
                
                if($_SERVER['REQUEST_METHOD'] == 'GET'){
                    $count = 1;
                    require_once './database/db.php';
                    $db = new mysqli(HOST,USER,PASS,NAME);
                    $sql = "SELECT name, icNum, email, num_of_ticket FROM ticket WHERE e_ID = '".$_GET['id']."'";
                    $res = $db->query($sql);
                    while($rw = $res->fetch_object()){
                        printf("<tr>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%d</td>
                            </tr>", $count, $rw->name, $rw->icNum, $rw->email, $rw->num_of_ticket);
                        $count++;
                    }
                }
                ?>
            </table>
        </form>
    </body>
</html>
