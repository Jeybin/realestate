<?php
require '../libs/Functions.php';
$functions = new Functions();
session_start();
$loginid = $_SESSION['loginid'];
$logintype = $_SESSION['logintype'];
if($logintype !== 'builders') {
  header('Location: ../index.php');
}
$table = 'agents';
$agentdatas = $functions->getAgentsById($loginid);
$agentdatas = $agentdatas[0];
$agentname = $agentdatas['name'];
$email = $agentdatas['email'];
$displayimage = $agentdatas['displayimage'];
$contactnumber = $agentdatas['contactnumber'];
$address = $agentdatas['address'];
$location = $agentdatas['location'];
$city = $agentdatas['city'];
$country = $agentdatas['country'];
$pin = $agentdatas['pin'];
$license_no = $agentdatas['license_no'];
$latitude = $agentdatas['latitude'];
$longitde = $agentdatas['longitde'];
$mailverification = $agentdatas['email_verification'];
$status = $agentdatas['status'];
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
    <?php
    $functions->changeToNewPassword($loginid,$table,$email,$mailverification);
     ?>
  </head>
  <body>
    <!--nav-->
		<?php include './includes/topbar.php'; ?>
