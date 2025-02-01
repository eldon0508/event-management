<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
$header = array(
    "username" => "Username",
    "name" => "Name",
    "icNum" => "IC Number",
    "email" => "Email",
    "phone_no" => "Phone Number",
    "u_status" => "Acccount Status"
);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL Admin | Members</title>
    </head>
    <body>
        <header><?php include_once './adminheader.php';?></header>
        <div style="padding-left: 5%;padding-right: 5%;">
        <h1>List of Members</h1>
        
        <?php
        isset($_POST['chk'])?$dItem = $_POST['chk']: $dItem = NULL;
        if(isset($_POST['btnDe'])){     //deactivate the member accounts
            if(!empty($dItem)){
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $sql = "update member set u_status = 'I' where username in ('".implode("','", $dItem)."')";
                if($db->query($sql)){
                    printf("<b>%s member(s) has been Deactivated</b>.", $db->affected_rows);
                }
                $db->close();
            }
        }elseif(isset ($_POST['btnAc'])){       //activate member accounts
            if(!empty($dItem)){
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $sql = "update member set u_status = 'A' where username in ('".implode("','", $dItem)."')";
                if($db->query($sql)){
                    printf("<b>%s member(s) has been Activated</b>.", $db->affected_rows);
                }
                $db->close();
            }
        }
        
        ?>
        <form method="post" action="">
            
            <table class="highlight">
                    <?php
                    isset($_GET['sort'])?$sort = $_GET['sort']: $sort = 'username';
                    isset($_GET['order'])?$order = $_GET['order']: $order = "ASC";
                    
                    echo "<tr><th></th>";
                    foreach ($header as $key => $value){
                        if($key == $sort){
                            //if user want to sort with criteria
                            printf("<th><a href='?sort=%s&order=%s'>%s</a> <img src='img/%s' alt='%s'/></th>", $key, 
                                $order == 'ASC'?"DESC":"ASC", $value,
                                $order == 'ASC'?"asc.png":"desc.png", $order == 'ASC'?"sort ascending":"sort descending");
                        }else{
                            //if user does not click anything
                            printf("<th><a href='?sort=%s&order=ASC'>%s</a> <img src='img/sort.png' alt='sort' /></th>", $key, $value);
                        }
                    }
                    echo "</tr>";
                    require_once './database/db.php';
                    $db = new mysqli(HOST, USER, PASS, NAME);
                    $sql = "select username, name, icNum, email, phone_no, u_status from member order by $sort $order";
                    if($res = $db->query($sql)){
                        while($row = $res->fetch_object()){
                            printf("<tr>
                                <td><label><input type='checkbox' name='chk[]' value='%s' class='green'/><span></span></label></td>
                                <td><a href='memberDetail.php?id=%s'>%s</a></td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>
                                <td>%s</td>", 
                                    $row->username, $row->username, $row->username, $row->name, $row->icNum, $row->email, 
                                    $row->phone_no, $row->u_status=='A'?"Active":"Inactive");
                        }
                    }
                    ?>
                
            </table>
            <?php echo "<b>$res->num_rows member(s) listed.</b>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="btnDe" class="btn waves-effect waves-light" style="background-color: #ef5350;">Deactivate
                <i class="material-icons right">highlight_off</i>
            </button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="btnAc" class="btn waves-effect waves-light" style="background-color: #66bb6a;">Activate
                <i class="material-icons right">verified_user</i>
            </button>
            
            
        </form>
        
        
        </div>
        
        
    </body>
</html>
