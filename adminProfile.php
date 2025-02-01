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
        <title>LYGL Admin | Admin Profile</title>
    </head>
    <body>
        <header><?php include_once './adminheader.php';?></header>
        <div style="padding-left: 25%;padding-right: 25%;">
            <h1>Admin Profile</h1>
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
                        <td><?php echo str_repeat("&bull;", strlen($rw->adminPass)); ?></td>
                    </tr>
                    <tr>
                        <td>Name :</td>
                        <td><?php echo $rw->adminName; ?></td>
                    </tr>
                    <tr>
                        <td>IC Number :</td>
                        <td><?php echo $rw->adminIC; ?></td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><?php echo $rw->adminEmail; ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number :</td>
                        <td><?php echo $rw->adminPhone; }?></td>
                    </tr>
                </table><br/><br/>
                <button type="submit" class="btn-floating pulse" name="submit"><i class="material-icons">mode_edit</i></button>
            </form>
        </div>
    </body>
</html>

<?php
if(isset($_POST['submit'])){
    header("Location: admin-editProfile.php");
}
?>
