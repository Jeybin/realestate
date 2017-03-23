<?php
 include './includes/header.php';
	$auctionsbyuserdata = $functions->getAuctionsQuotedByUserId($loginid,$logintype);
?>

<h4 style="opacity:0.5">
  Participated Auction History
  <a href="../prints/participatedauctionhistory.php?userid=<?=$loginid?>&type=<?=$logintype?>" style="text-decoration:none;color:#01579B">
    <i class="fa fa-print pull-right" style="padding-right:20px"></i>
  </a>
</h4>

<?php
  foreach($auctionsbyuserdata as $allauctions){
		$auctionid = $allauctions['auctionid'];
    $auctiondetailsbyid = $functions->getAllAuctionDataById($auctionid);
    $auctionedpropertyid = $auctiondetailsbyid[0]['property_id'];
    $auctionpropertydata = $functions->getAllPropertiesById($auctionedpropertyid);
    $propertyid = $auctionpropertydata[0]['id'];
    $propertytitle = $auctionpropertydata[0]['title'];
		$auctionquotedatasbyid = $functions->getAuctionsQuotedById($auctionid);
 ?>

<div class="col-xs-12" style="padding: 5px 0; ">
		<div style="padding: 5px 0;" class="col-xs-12"><div class="">Property Id - <?=$propertyid?></div></div>
		<div style="padding: 2px 0 15px;font-size:14px;font-weight:700" class="col-xs-12"><div class="text-capitalize"><?=$propertytitle?></div></div>
		<table class="table table-bordered" style="background-color:#fff">
			<tr class="text-center" style="font-weight:700;font-size:14px;">
				<td>#</td>
        <td>Auctioneer</td>
        <td>Email</td>
				<td>Contact No</td>
				<td>Bid Amount (₹)</td>
			</tr>
      <?php
        $slno = 1;
        $highestvalue = 0;
        foreach($auctionquotedatasbyid as $auction){
          $auctionerid = $auction['userid'];
          $auctionertype = $auction['usertype'];
          $bidamount = $auction['quoted_price'];
          $auctionerdatas = $functions->getDataWithTableAndId($auctionertype,$auctionerid);
          $auctionername = $auctionerdatas[0]['name'];
          $auctioneremail = $auctionerdatas[0]['email'];
          $auctionercontactno = $auctionerdatas[0]['contactnumber'];
       ?>
       <tr class="text-center"
          style="font-size:13px;
                  <?php if($auctionerid == $loginid) {echo "color:#4CAF50;"; }?>
                    ">
         <td><?=$slno++?></td>
         <td><?=$auctionername?></td>
         <td><?=$auctioneremail?></td>
         <td><?=$auctionercontactno?></td>
         <td><?=$bidamount?></td>
       </tr>

      <?php } ?>
    </table>
</div>


<?php
}
 ?>

<?php include './includes/footer.php'; ?>
