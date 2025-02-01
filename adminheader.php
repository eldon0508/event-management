<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if(isset($_GET['action'])){
    session_destroy();
    header('Location:event.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Header</title>
        <link href="header-login.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <style>
            .error{
                color:#ef5350;text-align: left;width: 550px;
            }
            .input-group label{
                font-size: 15px;
            }
            .input-group{
                padding-top: 10px;
            }
            .btm{
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        <?php
        if(isset($_GET['action']))
        {
            session_destroy();
            header('Location:adminLogin.php');
        }
        ?>
           <nav id="header">
            <div class="nav-wrapper" style="background-color:#00b0ff">
                <a href='adminProfile.php' class="brand-logo">
                    <img src="logo/img3.png" style="width:95px; height: 64px;" title="LYGL Company"/></a>
                <ul class="right hide-on-med-and-down">
                    <li class="drowdown-content"><a href="adminProfile.php">
                            <i class="material-icons" title="Admin Account">supervisor_account</i></a>
                        <ul>
                            <li><a href="?action=logout">
                                    <i class="material-icons" title="Log Out">power_settings_new</i></a></li>
                        </ul>
                    </li>
                    <li><a href="adminEventList.php"><i class="material-icons" title="Event List">event</i></a></li>
                    <li><a href="adminMemberList.php"><i class="material-icons" title="Member List">account_box</i></a></li>
                </ul>
            </div>
        </nav>

    </body>
</html>
