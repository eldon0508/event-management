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
        <title>LYGL Admin | Create Event</title>
        
    </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="helperInsert.js" type='text/javascript'></script>
    <style>
        td{
            width: 350px;
        }
    </style>
    <body>
        <header><?php include_once './adminheader.php';?></header>
        <div class="container">
        <h1>Create Event</h1>
        </div>
        
        <div style="padding-right: 25%;padding-left: 25%;">
        <?php
        include './helperInsert.php';
        
        isset($_FILES['file'])? $file = $_FILES['file']: $file = NULL;
        
            if(isset($_POST['btnInsert'])){
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $code = "select sst from event";
                $ans = $db->query($code);
                if($row = $ans->fetch_object()){
                    $sst = $row->sst;
                }
                $db->close();
                
                $msg = validateAll();
                if(!empty($msg)){
                    //found error, display them
                    echo "<div class='error'>"; 
                    printf("&bull; %s", implode("<br/>&bull; ", $msg));
                    echo "</div>";
                }else{    //no error, store into database
                    require_once './database/db.php';
                    $db = new mysqli(HOST, USER, PASS, NAME);
                    //retrieve data
                    $id = strtoupper(trim($_POST['id']));
                    $name = trim($_POST['name']);
                    $org = trim($_POST['org']);
                    $desc = trim($_POST['desc']);
                    $loc = trim($_POST['loc']);
                    $state = trim($_POST['state']);
                    $startDate = $_POST['startDate'];
                    $startTime = trim($_POST['startTime']);
                    $endDate = trim($_POST['endDate']);
                    $endTime = trim($_POST['endTime']);
                    $status = strtoupper(trim($_POST['status']));
                    $fee = strtoupper(trim($_POST['fee']));
                    $fee == 'P'? $price = trim($_POST['price']): $price = 0.0;
                    $ticket = trim($_POST['ticket']);
                    isset($sst)? $realSST = $sst: $realSST = 0.1;
                    
                    //everything ok
                    //change file name to unique file id
                    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                    $save_as = uniqid().".".$ext;
                    move_uploaded_file($file['tmp_name'], "eventImg/$save_as");  //save file


                    //(e_ID,e_Name,e_Org,e_Desc,e_Loc,e_State,startDate,startTime,endDate,endTime,status,fee,price,ticket)
                    $sql = "INSERT INTO event VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    //pass value into parameters
                    //i-integer, d-double, s-string
                    $run = $db->prepare($sql);
                    $run->bind_param("ssssssssssssdidsi", $id, $name, $org, $desc, $loc, $state, 
                            $startDate, $startTime, $endDate, $endTime, $status, $fee, $price, $ticket, $realSST, $save_as, $_SESSION['no']);
                    $run->execute();
                    
                    if($run->affected_rows > 0){
                        echo "<script>alert('Event $name has been added into the database.'); window.location.href='adminEventList.php';</script>";
                    }else{
                        echo "<script>alert('Event is not added. Try Again.'); window.location.href='insert-event.php';</script>";
                    }
                    $run->free_result();
                    $db->close();
                }
            }
            
            ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
           
            <table cellpadding="10" class="highlight">
                <tr>
                    <td>Event ID :</td>
                    <td><input type="text" name="id" id="id" maxlength="6" autofocus="autofocus" oninput="checkID();" placeholder="E99999"
                               value="<?php isset($_POST['id'])?$id = trim($_POST['id']): $id = NULL; echo $id;?>"/></td>
                    <td id="id1" class="error"></td>
                </tr>
                <tr>
                    <td>Event Name :</td>
                    <td><input type="text" name="name" id="name" oninput="checkName();"
                               value="<?php isset($_POST['name'])?$name = trim($_POST['name']): $name = NULL; echo $name;?>" /></td>
                    <td id="name1" class="error"></td>
                </tr>
                <tr>
                    <td>Organizer :</td>
                    <td><input type="text" name="org" id="org" oninput="checkOrg();"
                               value="<?php isset($_POST['org'])? $org = trim($_POST['org']): $org = NULL; echo $org;?>" /></td>
                    <td id="org1" class="error"></td>
                </tr>
                <tr>
                    <td>Event Description :</td>
                    <td>
                        <textarea name="desc" id="desc" oninput="checkDesc();"><?php isset($_POST['desc'])?
                        $desc = trim($_POST['desc']): $desc = ""; echo $desc;?></textarea>
                    </td>
                    <td id="desc1" class="error"></td>
                </tr>
                <tr>
                    <td>Event Location :</td>
                    <td><textarea name="loc" id="loc" oninput="checkLoc();"><?php isset($_POST['loc'])?
                    $loc = trim($_POST['loc']): $loc = ""; echo $loc;?></textarea></td>
                    <td id="loc1" class="error"></td>
                </tr>
                <tr>
                    <td>State</td>
                <td>
                    <select name="state" id="state" class="browser-default" required="required">
                            <?php
                            isset($_POST['state'])?$state = trim($_POST['state']): $state = NULL;
                            $states = getState();
                            foreach($states as $key => $value){
                                printf("<option value='%s' %s>%s</option>",$key,(($state==$key)?"selected='selected'":""),$value);
                            }
                           ?>
                    </select>
                </td>
                    <td id="state1" class="error"></td>
                </tr>
                <tr>
                    <td>Event Start :</td>
                    <td><input type="date" name="startDate" id="startDate" onchange="checkDate();" 
                               value="<?php isset($_POST['startDate'])?$startDate = $_POST['startDate']: $startDate = NULL; echo $startDate;?>" /><br/>
                        <input type="time" name="startTime" 
                               value="<?php isset($_POST['startTime'])?$startTime = trim($_POST['startTime']): $startTime = NULL; echo $startTime;?>" />
                    </td>
                    <td id="date1" class="error"></td>
                </tr>
                <tr>
                    <td>Event End :</td>
                    <td><input type="date" name="endDate" id="endDate" onchange="checkDate();" 
                               value="<?php isset($_POST['endDate'])?$endDate = $_POST['endDate']: $endDate = NULL; echo $endDate;?>"/><br/>
                        <input type="time" name="endTime" 
                        value="<?php isset($_POST['endTime'])?$endTime = $_POST['endTime']: $endTime = NULL; echo $endTime;?>" />
                    </td>
                    <td id="date2" class="error"></td>
                </tr>
                <tr>
                    <td>Event Status :</td>
                    <td>
                        <label><input type="radio" name="status" 
                                      value="A" <?php isset($_POST['status'])?$status = strtoupper(trim($_POST['status'])):$status = NULL;
                                      if($status=='A'){echo "checked='checked'";}?>/>
                            <span>Active</span></label>
                        <label>&nbsp;&nbsp;<input type="radio" name="status" 
                                      value="I" <?php isset($_POST['status'])?$status = strtoupper(trim($_POST['status'])):$status = NULL;
                                      if($status=='I'){echo "checked='checked'";}?>/>
                            <span>Inactive</span></label>
                    </td>
                </tr>
                <tr>
                    <td>Event Type :</td>
                    <td>
                        <label><input type="radio" name="fee" onclick="display(0);"
                                      value="P" <?php isset($_POST['fee'])?$fee = strtoupper(trim($_POST['fee'])):$fee = NULL;
                                      if($fee=='P'){echo "checked='checked'";}?>/>
                            <span>Paid</span></label>
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="fee" onclick="display(1);"
                                      value="F" <?php isset($_POST['fee'])?$fee = strtoupper(trim($_POST['fee'])):$fee = NULL;
                                      if($fee=='F'){echo "checked='checked'";}?>/>
                            <span>Free</span></label>
                    </td>
                    <td><input type="text" name="price" id="price" style="display: none"
                               value="<?php $fee == 'P'?$price = $_POST['price']: $price = 0.0; 
                               echo $price;?>"/></td>
                </tr>
                <tr>
                    <td>Ticket Available :</td>
                    <td><input type="text" name="ticket" id="ticket" oninput="checkTicket();"
                               value="<?php isset($_POST['ticket'])?$ticket = trim($_POST['ticket']): $ticket = NULL; echo $ticket;?>" /></td>
                    <td id="ticket1" class="error"></td>
                </tr>
                <tr>
                    <td>Image :</td>
                    <td><input type="file" name="file"/></td>
                    <td></td>
                </tr>
            </table>
            <div style="padding: 25px;">
            <button type="submit" name="btnInsert" class="btn waves-effect waves-light" >Insert</button>
            <button type="button" name="btnCancel" onclick="location='adminEventList.php'"
                   class="btn waves-effect waves-red" style="background-color:#ef5350;">Cancel</button>
            </div>
        </form>
    </div>
    </body>
    <?php
    function getState(){
        $states = array(""=>"---Selection One---","JH"=>"Johor","KD"=>"Kedah","KT"=>"Kelantan",
                        "KL"=>"Kuala Lumpur","LB"=>"Labuan","MK"=>"Melaka","NS"=>"Negeri Sembilan",
                        "PH"=>"Pahang","PN"=>"Penang","PR"=>"Perak","PL"=>"Perlis",
                        "PJ"=>"Putrajaya","SB"=>"Sabah","SW"=>"Sarawak","SG"=>"Selangor",
                        "TR"=>"Terengganu");
            
        return $states;
        
    }
    ?>
</html>
