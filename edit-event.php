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
        <title>LYGL Admin | Edit Event</title>
    </head>
    <style>
        td{
            width: 350px;
        }
    </style>
    <header><?php include_once './adminheader.php';?></header>
        <body>
        <div class="container"><h1>Edit Event</h1></div>
        <div style="padding-right: 25%;padding-left: 25%;">

<?php
global $id, $name, $org, $desc, $loc, $state, $startDate, $startTime, $endDate, $endTime, $status, $fee, $price, $ticket, $file;
isset($_POST['hideID'])?$id = trim($_POST['hideID']):$id = trim($id);
if($_SERVER['REQUEST_METHOD'] == 'GET'){    //if get method
    require_once './database/db.php';
    $db = new mysqli(HOST, USER, PASS, NAME);
    $id = strtoupper(trim($_GET["id"]));
    $sql = "SELECT e_Name, e_Org, e_Desc, e_Loc, e_State, startDate, 
            startTime, endDate, endTime, status, fee, price, ticket, img FROM event WHERE e_ID = '$id'";
    $run = $db->query($sql);
    if($row = $run->fetch_object()){    //exist record
        $name = $row->e_Name;
        $org = $row->e_Org;
        $desc = $row->e_Desc;
        $loc = $row->e_Loc;
        $state = $row->e_State;
        $startDate = $row->startDate;
        $startTime = $row->startTime;
        $endDate = $row->endDate;
        $endTime = $row->endTime;
        $status = $row->status;
        $fee = $row->fee;
        $price = $row->price;
        $ticket = $row->ticket;
        $file = $row->img;
    }else{     //not exist record
        echo "<span class='error'>Record not found!</span> [ <a href='adminEventList.php'>Back to List Events</a> ]";
        $run->free();
        $db->close();
    }
}else{     //if post method
    include './helperEditEvent.php';
    $msg = validate();
    if(!empty($msg)){
        //found error, display them
        echo "<div class='error' style='font-size:18px;'>"; 
        printf("&bull; %s", implode("<br/>&bull; ", $msg));
        echo "</div>";
    }else{    //no error in editing
        $hideID = trim($_POST['hideID']);
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
        
        require_once './database/db.php';
        $db = new mysqli(HOST, USER, PASS, NAME);
        $sql = "UPDATE event SET e_Name = ?, e_Org = ?, e_Desc = ?, 
                e_Loc = ?, e_State = ?, startDate = ?, startTime = ?, 
                endDate = ?, endTime = ?, status = ?, fee = ?, price = ?, ticket = ?, adminNo = ? WHERE e_ID = ?";
        $run = $db->prepare($sql);
        $run->bind_param("sssssssssssdiss", $name,$org,$desc,$loc,$state,$startDate,
                $startTime,$endDate,$endTime,$status,$fee,$price,$ticket,$_SESSION['no'],$hideID);
        if($run->execute()){     //if edit success
            echo "<script>alert('Event $name has been edited.'); window.location.href='adminEventList.php'</script>";
        }else{    //edit fail
            echo "<script>alert('Error in editing Event $name.'); window.location.href='adminEventList.php'</script>";
        }
        $run->free_result();
        $db->close();
    }
}
?>
    
        <script src="helperInsert.js" type="text/javascript"></script>
        <form action="" method="POST" enctype="multipart/form-data">
            <table cellpadding="10">
                <tr>
                    <td>Event ID :</td>
                    <td><?php isset($_POST['hideID'])?$id = $_POST['hideID']:$id = $id; echo $id; ?>
                        <input type="hidden" name="hideID" value="<?php echo $id;?>" />
                    </td>
                    <td id="id1" class="error"></td>
                </tr>
                <tr>
                    <td>Event Name :</td>
                    <td><input type="text" name="name" id="name" oninput="checkName();"
                               value="<?php echo $name;?>" /></td>
                    <td id="name1" class="error"></td>
                </tr>
                <tr>
                    <td>Organizer :</td>
                    <td><input type="text" name="org" id="org" oninput="checkOrg();"
                               value="<?php echo $org;?>" /></td>
                    <td id="org1" class="error"></td>
                </tr>
                <tr>
                    <td>Event Description :</td>
                    <td>
                        <textarea name="desc" id="desc" oninput="checkDesc();"><?php echo $desc;?></textarea>
                    </td>
                    <td id="desc1" class="error"></td>
                </tr>
                <tr>
                    <td>Event Location :</td>
                    <td><textarea name="loc" id="loc" oninput="checkLoc();"><?php echo $loc;?></textarea></td>
                    <td id="loc1" class="error"></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>
                        <select name="state" id="state" class="browser-default">
                            <?php
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
                               value="<?php echo $startDate;?>" /><br/>
                        <input type="time" name="startTime" 
                               value="<?php echo $startTime;?>" />
                    </td>
                    <td id="date1" class="error"></td>
                </tr>
                <tr>
                    <td>Event End :</td>
                    <td><input type="date" name="endDate" id="endDate" onchange="checkDate();"
                               value="<?php echo $endDate;?>"/><br/>
                        <input type="time" name="endTime" 
                        value="<?php echo $endTime;?>" />
                    </td>
                    <td id="date2" class="error"></td>
                </tr>
                <tr>
                    <td>Event Status :</td>
                    <td>
                        <label><input type="radio" name="status" 
                                      value="A" <?php if($status == 'A'){echo "checked='checked'";}?>/>
                            <span>Active</span></label>
                        <label>&nbsp;&nbsp;<input type="radio" name="status" 
                                      value="I" <?php if($status == 'I'){echo "checked='checked'";}?>/>
                            <span>Inactive</span></label>
                    </td>
                </tr>
                <tr>
                    <td>Event Type :</td>
                    <td>
                        <label><input type="radio" name="fee" onclick="display(0);"
                                      value="P" <?php if($fee == 'P'){echo "checked='checked'";}?>/>
                            <span>Paid</span></label>
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="fee" onclick="display(1);"
                                      value="F" <?php if($fee == 'F'){echo "checked='checked'";}?>/>
                            <span>Free</span></label>
                    </td>
                    <td><input type="text" name="price" id="price" style="display: <?php echo ($fee == 'P')?"block":"none";?>;"
                               value="<?php echo $price;?>" /></td>
                </tr>
                <tr>
                    <td>Ticket Available :</td>
                    <td><input type="text" name="ticket" id="ticket" oninput="checkTicket();"
                               value="<?php echo $ticket;?>" /></td>
                    <td id="ticket1" class="error"></td>
                </tr>
            </table>
            
            <div style="padding: 25px;">
            <button type="submit" name="btnEdit" class="btn waves-effect waves-light" >Confirm</button>
            <button type="button" value="Cancel" name="btnCancel" onclick="location='adminEventList.php'" 
                                class="btn waves-effect waves-light" style="background-color: #ef5350;">Cancel</button>
            </div>
        </form>
    </body>   
    </div>
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
