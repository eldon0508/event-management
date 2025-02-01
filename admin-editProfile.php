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
        <title>LYLG Admin | Edit Profile</title>
    </head>
    <body>
        <header><?php include_once './adminheader.php'; ?></header>
        <div style="padding-left: 25%;padding-right: 25%;">
            <h1>Edit Profile</h1>
            <?php
            if(isset($_POST['update'])){
                include_once './helperAdminEdit.php';
                $msg = checkAdmin();
                if(!empty($msg)){
                    echo "<div class='error' style='font-size:18px;'>";
                    printf("&bull; %s", implode("<br/>&bull; ", $msg));
                    echo "</div>";
                }else{
                    $newName = trim($_POST['name']);
                    $newMail = trim($_POST['email']);
                    $newpNnum = trim($_POST['pNum']);
                    $pass2 = trim($_POST['cpw']);

                    require_once './database/db.php';
                    $con = new mysqli(HOST, USER, PASS, NAME);
                    $sql = "UPDATE admin SET adminPass = ?, adminName = ?, adminEmail = ?, 
                            adminPhone = ? WHERE adminUsername = '".$_SESSION['adminUser']."'";
                    $res = $con->prepare($sql);
                    $res->bind_param("ssss", $pass2, $newName, $newMail, $newpNnum);
                    if($res->execute()){
                        echo "<script>alert('Update Successful!');window.location.href='adminProfile.php';</script>";
                    }else{
                        echo "<script>alert('Something went wrong!');window.location.href='adminProfile.php';/script>";
                    }
                    $result->free_result();
                    $con->close();
                }
            }
            ?>
            <form method="post">
                <?php
                require_once './database/db.php';
                $db = new mysqli(HOST, USER, PASS, NAME);
                $sql = "SELECT adminUsername, adminPass, adminName, 
                        adminIC, adminEmail, adminPhone FROM admin 
                        WHERE adminUsername = '".$_SESSION['adminUser']."'";
                $res = $db->query($sql);
                if($rw = $res->fetch_object()){
                ?>
                <table>
                    <tr>
                        <td>Username :</td>
                        <td><?php echo $rw->adminUsername; ?></td>
                    </tr>
                    <tr>
                        <td>Password :</td>
                        <td><input type="password" name="pw" 
                                   value="<?php echo $rw->adminPass; ?>"/></td>
                    </tr>
                    <tr>
                        <td>Confirm Password :</td>
                        <td><input type="password" name="cpw" 
                                   value="<?php echo $rw->adminPass; ?>"/></td>
                    </tr>
                    <tr>
                        <td>Name :</td>
                        <td><input type="text" name="name"
                                   value="<?php echo $rw->adminName; ?>"/></td>
                    </tr>
                    <tr>
                        <td>IC Number :</td>
                        <td><?php echo $rw->adminIC; ?></td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><input type="email" name="email"
                                   value="<?php echo $rw->adminEmail; ?>"/></td>
                    </tr>
                    <tr>
                        <td>Phone Number :</td>
                        <td><input type="tel" pattern="01[0-9]-[0-9]{7,8}" name="pNum"
                                   value="<?php echo $rw->adminPhone;}?>"/> </td>
                    </tr>
                </table><br/><br/>
                <div style="padding: 25px;">
                    <button type="submit" name="update" class="btn waves-effect waves-light">Update</button>
                    <button type="button" onclick="location='adminProfile.php'" class="btn waves-effect waves-red" 
                             style="background-color:#ef5350;">Cancel</button>
                </div>
            </form>
        </div>
        
        
    </body>
</html>
