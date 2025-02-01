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
    "e_Name" => "Event Name",
    "num_of_ticket" => "Quantity",
    "price" => "Price(RM)"
);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL Admin | Member Details</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <header><?php include_once './adminheader.php';?></header>
        <div class="container"><h1>Member Detail</h1></div>
        <div style="padding-left: 25%;padding-right: 25%;">
            
            
            <?php
            global $name;
            if($_SERVER['REQUEST_METHOD'] == 'GET'){   
                //get method, retrieve information of member                
                $user = trim($_GET['id']);
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $sql = "select username, name, icNum, email, phone_no from member where username = '$user'";
                $run = $db->query($sql);
                if($row = $run->fetch_object()){
                    $user = $row->username;
                    $name = $row->name;
                    $ic = $row->icNum;
                    $email = $row->email;
                    $phone = $row->phone_no;
                    ?>
            <table>
                <tr>
                    <td>Username :</td>
                    <td><?php echo $user; ?></td>
                </tr>
                <tr>
                    <td>Name :</td>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <td>IC Number :</td>
                    <td><?php echo $ic; ?></td>
                </tr>
                <tr>
                    <td>Email Address :</td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td>Phone Number :</td>
                    <td><?php echo $phone; ?></td>
                </tr>
            </table>
                    <?php
                }else{
                    echo "Member not found! [ <a href='adminMemberList.php'>Back to Member List</a> ].";
                }
                $db->close();
            }else{
                //post method, deactivate or activate the member according to the choice
                if(isset($_POST['btnDe'])){
                    require_once './database/db.php';
                    $db = new mysqli(HOST, USER, PASS, NAME);
                    $sql = "update member set u_status = 'I' where username = '".trim($_GET['id'])."'";
                    if($db->query($sql)){   //deactivate the member account
                        echo "<script>alert('Member has been Deactivated.');window.location.href='adminMemberList.php';</script>";
                    }
                    $db->close();
                }elseif(isset ($_POST['btnAc'])){
                    require_once './database/db.php';
                    $db = new mysqli(HOST, USER, PASS, NAME);
                    $sql = "update member set u_status = 'A' where username = '".trim($_GET['id'])."'";
                    if($db->query($sql)){       //activate the member account
                        echo "<script>alert('Member has been Activated.');window.location.href='adminMemberList.php';</script>";
                    }
                    $db->close();
                }
            }
            ?>
        </div>
        <form method="post" style="padding-left: 25%;padding-right: 25%;padding-top: 20px;">
            <div style="text-align: right;">
                <button type="submit" name="btnDe" class="btn waves-effect waves-light" style="background-color: #ef5350;">Deactivate
                    <i class="material-icons right">highlight_off</i>
                </button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" name="btnAc" class="btn waves-effect waves-light" style="background-color: #66bb6a;">Activate
                    <i class="material-icons right">verified_user</i>
                </button>
            </div>
        </form>
            
        <div class="container"><h2>Purchase History</h2></div>
            <div style="padding-left: 20%;padding-right: 20%;">
                
                
                <table>
                    <?php
                    echo "<tr>";
                    foreach($header as $key => $value){
                        echo "<th>$value</th>";
                    }
                    echo "</tr>";

                    require_once './database/db.php';
                    $db = new mysqli(HOST, USER, PASS, NAME);
                    $count = 1;
                    $sql = "SELECT e_Name, num_of_ticket, price from event e, ticket t where e.e_ID = t.e_ID AND t.icNum = '$ic'";
                    $res = $db->query($sql);
                    while($row = $res->fetch_object()){
                        printf("<tr>
                                <td>%d.</td>
                                <td>%s</td>
                                <td>%d</td>
                                <td>%.2f</td>
                                </tr>",$count, $row->e_Name, $row->num_of_ticket, $row->price);
                        $count++;
                    }
                    ?>
                </table>
            </div>
    </body>
</html>