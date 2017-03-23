<?php
  include './includes/header.php';
  $allagents = $functions->getAllAgents();
  $allusers = $functions->getAllUsers();
  $allproperties = $functions->getAllProperties();
  $allsales = $functions->getAllSales();
  $allauctions = $functions->getAllAuctionData();
  $totalusers = count($allagents) + count($allusers);
  $totalproperties = count($allproperties);
  $totalauctions = count($allauctions);
  $totalsales = $totalproperties-$totalauctions;

?>

<div class="col-xs-3" >
  <div class="col-xs-12" style="border: 1px solid #434A54; border-radius:5px">

  <div class="col-xs-4 text-center" style="font-size:56px">
    <i class='fa fa-users'></i>
  </div>
  <div class="col-xs-8" style="padding:12px 5px">
    <div class="col-xs-12" style="font-size:26px;font-weight:800"><?=$totalusers?></div>
    <div class="col-xs-12"  style="font-size:14px;">Total Users</div>
  </div>
</div>
</div>

<div class="col-xs-3" >
  <div class="col-xs-12" style="border: 1px solid #434A54; border-radius:5px">

  <div class="col-xs-4 text-center" style="font-size:56px">
    <i class='fa fa-map-marker'></i>
  </div>
  <div class="col-xs-8" style="padding:12px 5px">
    <div class="col-xs-12" style="font-size:26px;font-weight:800"><?=$totalproperties?></div>
    <div class="col-xs-12"  style="font-size:14px;">Properties</div>
  </div>
</div>
</div>

<div class="col-xs-3" >
  <div class="col-xs-12" style="border: 1px solid #434A54; border-radius:5px">

  <div class="col-xs-4 text-center" style="font-size:56px">
    <i class='fa fa-gavel'></i>
  </div>
  <div class="col-xs-8" style="padding:12px 5px">
    <div class="col-xs-12" style="font-size:26px;font-weight:800"><?=$totalauctions?></div>
    <div class="col-xs-12"  style="font-size:14px;">Auctions</div>
  </div>
</div>
</div>

<div class="col-xs-3" >
  <div class="col-xs-12" style="border: 1px solid #434A54; border-radius:5px">

  <div class="col-xs-4 text-center" style="font-size:56px">
    <i class='fa fa-tags'></i>
  </div>
  <div class="col-xs-8" style="padding:12px 5px">
    <div class="col-xs-12" style="font-size:26px;font-weight:800"><?=$totalsales?></div>
    <div class="col-xs-12"  style="font-size:14px;">Sale</div>
  </div>
</div>
</div>


<?php include './includes/footer.php'; ?>
