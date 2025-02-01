<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
$header = array(
            "e_ID" => "Event ID",
            "e_Name" => "Event Name",
            "e_Org" => "Organizer",
            "e_State" => "State", 
            "startDate" => "Event Date", 
            "startTime" => "Event Time", 
            "status" => "Event Status", 
            "price" => "Ticket Price (RM)", 
            "ticket" => "Ticket Stock");

    function getFee(){
        return array("P" => "Paid", "F" => "Free");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>LYGL Admin | Event Details</title>
    </head>
    <script>
    function isNum(evt){
        var ch = String.fromCharCode(evt.which);
        if(!(/[0-9]/.test(ch))){
            evt.preventDefault();
        }
    }
    </script>
    <body>
        <header><?php include_once './adminheader.php';?></header>
        <div style="padding-left: 5%;padding-right: 5%;">
        <h1>List of Events</h1>
        <?php
        isset($_POST['chk'])?$dItem = $_POST['chk']: $dItem = NULL;
        if(isset($_POST['btnDelete'])){
            if(!empty($dItem)){
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $sql = "delete from event where e_ID in ('".implode("','", $dItem)."')";
                if($db->query($sql)){
                    printf("%s event(s) has been deleted.", $db->affected_rows);
                }
                $db->close();
            }
        }elseif(isset ($_POST['btnDe'])){
            if(!empty($dItem)){
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $sql = "update event set status = 'I' where e_ID in ('".implode("','", $dItem)."')";
                if($db->query($sql)){
                    printf("<b>%s event(s) has been Deactivated</b>.", $db->affected_rows);
                }
                $db->close();
            }
        
        }elseif(isset ($_POST['btnAc'])){
            if(!empty($dItem)){
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $sql = "update event set status = 'A' where e_ID in ('".implode("','", $dItem)."')";
                if($db->query($sql)){
                    printf("<b>%s event(s) has been Activated</b>.", $db->affected_rows);
                }
                $db->close();
            }
        }elseif(isset ($_POST['insert'])){
            header("Location: insert-event.php");
        }elseif(isset($_POST['btnSST'])){
            $inSST = trim($_POST['sst']) / 100;
            require_once './database/db.php';
            $con = new mysqli(HOST, USER, PASS, NAME);
            $sql = "update event set sst = $inSST";
            if($con->query($sql)){
                echo "SST has been updated!";
            }
        }
        ?>
        <br/><br/>
        <form method="post" action="">
        <?php
        global $fee, $sort, $order, $state;
        $state = getState();
        isset($_GET['fee'])?$fee = $_GET['fee']:$fee = '%';
        isset($_GET['sort'])?$sort = $_GET['sort']: $sort = 'e_ID';
        isset($_GET['order'])?$order = $_GET['order']: $order = "ASC";
//        isset($_POST['from_date'])?$from = $_POST['from_date']:$from = '%';
//        isset($_POST['to_date'])?$to = $_POST['to_date']:$to = '%';
        
//        echo "From Date<input type='date' name='from_date'/> 
//            To Date<input type='date' name='to_date'/> 
//            <input type='submit' value='Filter' />";
        printf("Filter by :    <a href='?sort=%s&order=%s'>No Filter</a>   |   ", $sort, $order);
        $allFee = getFee();
        foreach ($allFee as $key => $value){
            printf("<a href='?sort=%s&order=%s&fee=%s'>%s</a>   |   ", $sort, $order, $key, $value);
        }
        
        ?>
            <table class="highlight">
        <?php
        echo "<tr><th></th>";
        foreach($header as $key => $value){
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
        echo "<th></th></tr>";

                
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $sql = "SELECT e_ID, e_Name, e_Org, e_State, startDate, startTime, 
                        status, price, ticket FROM event WHERE fee LIKE '$fee' ORDER BY $sort $order";
                $res = $db->query($sql);
                while($row = $res->fetch_object()){
                    printf("<tr>
                        <td><label><input type='checkbox' name='chk[]' value='%s' class='green'/><span></span></label></td>
                        <td>%s</td>
                        <td><a href='eventPurchaseHistory.php?id=%s'>%s</a></td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td><a href='edit-event.php?id=%s'><i class='material-icons left'>edit</i>Edit</a>
                        </td>
                        </tr>",$row->e_ID ,$row->e_ID, $row->e_ID, $row->e_Name, $row->e_Org, 
                            $state[$row->e_State], $row->startDate, $row->startTime, 
                            ($row->status == 'A')?"Active":"Inactive", ($row->price == 0)? "Free" : $row->price, 
                            $row->ticket, $row->e_ID);
                }
                ?>
                
            
        </table>
            <?php echo "<b>$res->num_rows event(s) listed.</b>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="btnAc" class="btn waves-effect waves-light" style="background-color: #66bb6a;">Activate
                <i class="material-icons right">verified_user</i>
            </button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="btnDe" class="btn waves-effect waves-light" style="background-color: #ef5350;">Deactivate
                <i class="material-icons right">highlight_off</i>
            </button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="insert" class="btn waves-effect waves-light" style="background-color: #66bb6a;">Create Event
                <i class="material-icons right">create_new_folder</i>
            </button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="btnDelete" class="btn waves-effect waves-light" style="background-color: #ef5350;">Delete
                <i class="material-icons right">delete_forever</i>
            </button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn waves-effect waves-light" onclick="document.getElementById('sstForm').style.display='block'"
                    style="background-color: #66bb6a;">SST Tax
                <i class="material-icons right">monetization_on</i>
            </button>&nbsp;&nbsp;&nbsp;&nbsp;
            
            
            <div id="sstForm" style="display: none;" class="row">
                <br/><br/>
                <input type="text" name="sst" onkeypress="isNum(event);" class="col s1" maxlength="3"/>
                <button type="submit" name="btnSST" style="background-color: #66bb6a;"
                        class="btn waves-effect waves-light col s1">Submit</button>
            </div>
            
    </form>
    </div>
    </body>
</html>
<?php
function getState(){
    $states = array("JH"=>"Johor","KD"=>"Kedah","KT"=>"Kelantan","KL"=>"Kuala Lumpur",
            "LB"=>"Labuan","MK"=>"Melaka","NS"=>"Negeri Sembilan","PH"=>"Pahang","PN"=>"Penang",
            "PR"=>"Perak","PL"=>"Perlis","PJ"=>"Putrajaya","SB"=>"Sabah","SW"=>"Sarawak",
            "SG"=>"Selangor","TR"=>"Terengganu");
    return $states;
}
?>
