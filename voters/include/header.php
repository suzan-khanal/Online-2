<?php
session_start();

require_once("../admin/include/connect.php");




//if($_SESSION['Key'] != "AdminKey")
//{
//    echo"<script> location.assign('logout.php');</script>";
//    die;

//}
if(!isset($_SESSION['Key'])) {
  header('Location: ../admin/logout.php');
  die;

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voters-panel</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
     <link rel="stylesheet" href="../assets/css/style.css">

</head>
<body>

<div class="container-fluid">
    <div class="row bg-black text-white">
        <div class="col-1">
            <img src="../assets/images/logo.gif" alt="image" width="80px"/>
        </div>
        <div class="col-11 my-auto">
        <h3>ONLINE VOTING SYSTEM -<small> Welcome <?php echo $_SESSION['username']; ?> </small> </h3>
        </div>
    
</div>


    
