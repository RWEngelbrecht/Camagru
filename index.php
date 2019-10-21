<!DOCTYPE html>
<?php
include ("config/setup.php");
ini_set("display_errors", true);
session_start();
    // include("functions/functions.php");
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Camagru</title>
    <link rel="stylesheet" href="styles/style.css" media="all" />
    </head>
<body>
    <div class="main_wrapper">
        <div class="header_wrapper">
            <a href="index.php">
              <img id="banner" src="images/logom.png">
            </a>
        </div>
        <!--Navigation bar starts-->
        <div class="menubar">
            <ul id="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
            </ul>
        </div>
        <!--content wrapper starts-->
        <div class="content_wrapper">
        </div>
        <!--content wrapper ends-->
        <!--footer starts-->
        <div id="footer">
            <h2 style="text-align:center; padding-top:30px;">rengelbr</h2>
        </div>
        <!--footer ends-->
  </body>
</html>
