<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Affordable and professional web design">
	  <meta name="keywords" content="web design, affordable web design, professional web design">
  	<meta name="author" content="Brad Traversy">
    <title>LogiGear Lottery | Welcome</title>
    <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    <header>
      <div class="container">
        <div id="branding">
          <a href="index.php"><h1><span class="highlight">LogiGear</span> Lottery</h1></a>
        </div>
        <nav>
          <ul>
            <li class="current"><a href="index.php">Home</a></li>
            <li><a href="bookticket.php">Book Ticket</a></li>
            <li><a href="listbooked.php">List Booked</a></li>
            <?php 
                if(!isset($_SESSION['email']))
                {
            ?>
            <li><a href="register.php">Register</a></li>
           <?php
              }
            ?>
            <?php
                if(isset($_SESSION['email']))
                {
            ?>
            <li><a href="functions/logout.func.php"> Logout </a></li>
            <?php
              }
            ?>
          </ul>
            <?php include 'functions/login.func.php'; ?>
        </nav>
      </div>
    </header>