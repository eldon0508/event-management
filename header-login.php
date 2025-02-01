<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html>
    <head>
        <meta charset="UTF-8">
        <title>Header</title>
        <link href="header-login.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        </script>
        <style>
            .error{
                color:#ef5350;text-align: left;
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
    <body>
        <?php
        if(isset($_GET['logout']))
        {
            session_destroy();
            header('Location:login.php');
        }
        ?>
        <header>
        <nav id="header">
            <div class="nav-wrapper" style="background-color:#00b0ff">
                <a href="event.php" class="brand-logo">
                    <img src="logo/img3.png" title="LYGL Company" style="width:95px; height: 64px;"/></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="shopping_cart.php"><i class="material-icons" title="Shopping Cart">shopping_cart</i></a></li>
                    <li><a href="event.php"><i class="material-icons" title="Event">event</i></a></li>
                    <li class="drowdown-content"><a href="profile.php" title="Profile"><i class="material-icons">supervisor_account</i></a>
                        <ul>
                            <li><a href='history.php'><i class="material-icons" title="Purchase History">history</i></a></li>
                            <li><a href="?logout"><i class="material-icons" title="Log Out">power_settings_new</i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        </header>
    </body>
</html>
