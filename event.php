<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();



?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL | Malaysia All Events</title>
        <style>
            tr td{
                font-size: 18px;
            }
            .word{
                font-size: 20px;padding-bottom: 2%;
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
        
        <div style="padding-top: 2%;" class="container">
            
        <form method="post" action="">
            <div class="row">
                <div class="col s6">
                    <input type="text" placeholder="Search for events" name="searchEvent"/>
                </div>
                <div class="col s3">
                    <button class="btn waves-effect waves-light" type="submit" name="search">Search
                        <i class="material-icons right">search</i></button>
                </div>
            </div>
        
        
        <?php
        echo "<div class='word'>";           //allow user to browse event according to the event type
        printf("Filter by :    <a href='event.php'>No Filter</a>   |   ");
        $allFee = getFee();
        foreach ($allFee as $key => $value){
            printf("<a href='?fee=%s'>%s</a>   |   ", $key, $value);
        }
        echo "</div>";
        ?>
        
            <table class="highlight">
            <?php
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $today = date('Y-m-d');
            
            isset($_GET['fee'])?$fee = $_GET['fee']:$fee = '%';
            require_once './database/db.php';
            $db = new mysqli(HOST, USER, PASS, NAME);
            $sel = "select e_ID, startDate from event";
            if($code = $db->query($sel)){
                while($run = $code->fetch_object()){
                    if($run->startDate <= $today){    //if event is expired, change the status to inactive automatically
                        $sql1 = "update event set status = 'I' where e_ID = '$run->e_ID'";
                        $db->query($sql1);
                    }
//                    else{
//                        $sql1 = "update event set status = 'A' where e_ID = '$run->e_ID'";
//                        $db->query($sql1);
//                    }
                }
            }
            if(isset($_POST['search'])){     //if user search for something
                $search = $_POST['searchEvent'];
                $sql = "select e_ID, e_Name, e_Loc, startDate, price, status from event WHERE e_Name like '%$search%'";
                if($event = $db->query($sql)){
                    //found records, display to customer
                    while($row = $event->fetch_object()){
                        if($row->status == 'A'){    //only display event with active status
                            $price = number_format($row->price, 2);
                            printf("<tr class='card-panel hoverable'><td><a href='eventDetail.php?id=%s'>%s
                                </a><br/>%s Malaysia Time Malaysia 
                                (Kuala Lumpur) Time<br/>%s<br/>%s</td></tr>", $row->e_ID,
                                    $row->e_Name, $row->startDate, $row->e_Loc, ($price == 0)?"Free":"Price at : RM$price");
                        }
                    }
                }else{
                    //records not found, display error
                    echo "<b>There is no any upcoming Events</b>.";
                }                
            }else{      //normal browsing events
                $sql = "select e_ID, e_Name, e_Loc, startDate, price, status from event WHERE fee LIKE '$fee'";
                if($event = $db->query($sql)){
                    //found records, display to customer
                    while($row = $event->fetch_object()){
                        if($row->status == 'A'){    //only display event with active status
                            $price = number_format($row->price, 2);
                            printf("<tr class='card-panel hoverable'><td><a href='eventDetail.php?id=%s'>%s
                                </a><br/>%s Malaysia Time Malaysia 
                                (Kuala Lumpur) Time<br/>%s<br/>%s</td></tr>", $row->e_ID,
                                    $row->e_Name, $row->startDate, $row->e_Loc, ($price == 0)?"Free":"Price at : RM$price");
                        }
                    }
                }else{
                    //records not found, display error
                    echo "<b>There is no any upcoming Events</b>.";
                }
            }
            
            
            ?>
        </table>
        </div>
        </form>
    </body>
    
    
    <?php
    function getFee(){
        return array("P" => "Paid", "F" => "Free");
    }
    ?>
</html>
