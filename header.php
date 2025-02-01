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
        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
            
            $(document).ready(function(){
                $('.tooltipped').tooltip();
            });
        </script>
        
        <nav id="header">
            <div class="nav-wrapper" style="background-color:#00b0ff">
                <a href="event.php" class="brand-logo">
                    <img src="logo/img3.png" style="width:95px; height: 64px;" title="LYGL Company"/></a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="shopping_cart.php"><i class="material-icons" title="Shopping Cart">shopping_cart</i></a></li>
                    <li><a href="event.php"><i class="material-icons" title="Event">event</i></a></li>
                    <li><a href="register.php"><i class="material-icons" title="Register">person_add</i></a></li>
                    <li><a href="login.php"><i class="material-icons" title="Log In">input</i></a></li>
                    <li><a href="adminLogin.php"><i class="material-icons" title="Create Event">add_box</i></a></li>
                </ul>
            </div>
        </nav>
        
            <ul class="sidenav" id="mobile-demo">
                <li><a href="register.php"><i class="material-icons">person_add</i></a></li>
                <li><a href="login.php"><i class="material-icons">input</i></a></li>
                <li><a href="event.php"><i class="material-icons">event</i></a></li>
            </ul>

    </body>
</html>
