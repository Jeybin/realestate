<?php
session_start();
$logintype = $_SESSION['logintype'];
$loginid = $_SESSION['loginid'];
if($logintype !== 'admin') { header('Location: ../index.php'); }


  require '../libs/Functions.php';
  $functions = new Functions();
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Bootflat-Admin Template</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon_16.ico"/>
    <link rel="bookmark" href="favicon_16.ico"/>
    <!-- site css -->
    <link rel="stylesheet" href="../assets/css/site.min.css">
    <link rel="stylesheet" href="../assets/css/custom.css">
    <link rel="stylesheet" href="../assets/css/location.css">
    <link rel="stylesheet" href="../assets/css/jqueryui.css">
    <script type="text/javascript" src="../assets/js/site.min.js"></script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>
    <script type="text/javascript" src="../assets/js/jqueryui.js"></script>
  </head>
  <body>
    <!--nav-->
		<?php include './includes/topbar.php'; ?>
