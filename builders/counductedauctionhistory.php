<?php
include './includes/header.php';
$loginuserdata = $functions->getAgentsById($loginid);
$loginuserdata = $loginuserdata[0];
$loginusername = $loginuserdata['name'];
$loginuseremail = $loginuserdata['email'];
$loginphone			= $loginuserdata['contactnumber'];
$loginaddress = $loginuserdata['address'];
$loginlocation = $loginuserdata['location'];

$propertiesbyuser = $functions->getPropertiesByUserId($loginid);
?>
<h4 style="opacity:0.5">
  Conducted Auctions History
  <a href="../prints/conductedauctionhistory.php?userid=<?=$loginid?>&type=<?=$logintype?>" style="text-decoration:none;color:#01579B">
    <i class="fa fa-print pull-right" style="padding-right:20px"></i>
  </a>
</h4>

<?php
	foreach($propertiesbyuser as $properties){
		$propertyid = $properties['id'];
		$propertytitle = $properties['title'];
		$auctionbyproperties = $functions->getAuctionByPropertyid($propertyid);
		if($auctionbyproperties){
			foreach($auctionbyproperties as $auctionproperties){
				$auctionid = $auctionproperties['id'];
				$highestBidData = $functions->getHighestBid($auctionid);
				$highestBid = $highestBidData[0]['MAX(quoted_price)'];
				$highestBidId = $highestBidData[0]['id'];
				$quotedAuctionData = $functions->getQuotedAuctionByAuctionId($auctionid);
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
				<td>Bided Date</td>
				<td>Bid Amount (₹)</td>
			</tr>
			<?php
				$slno = 1;
				foreach($quotedAuctionData as $quotes){
					$quoteduserid = $quotes['userid'];
					$quotedusertype = $quotes['usertype'];
					$quotedprice = $quotes['quoted_price'];
					$quoteddate = $quotes['quoteddate'];
					$quotedauctionid = $quotes['auctionid'];
					$auctionerdatas = $functions->getDataWithTableAndId($quotedusertype,$quoteduserid);
					$auctionername = $auctionerdatas[0]['name'];
					$auctioneremail = $auctionerdatas[0]['email'];
					$auctionercontactno = $auctionerdatas[0]['contactnumber'];
			 ?>
       <tr class="text-center" style="font-size:13px;<?php if($highestBid == $quotedprice) { echo "background-color:#B388FF"; }?>">
         <td><?=$slno++?></td>
         <td><?=$auctionername?></td>
         <td><?=$auctioneremail?></td>
         <td><?=$auctionercontactno?></td>
				 <td><?=$quoteddate?></td>
         <td>
					 <?=$quotedprice?>
					 <?php if($highestBid == $quotedprice) {  ?>
						 <form class="" action="../actions.php?action=respondtoauctioner" method="post">



					 <input type="text" name="loginusername" value="<?=$loginusername?>" hidden>
					 <input type="text" name="loginaddress" value="<?=$loginaddress?>" hidden>
						<input type="text" name="loginloc" value="<?=$loginlocation?>" hidden>
						<input type="text" name="loginemail" value="<?=$loginuseremail?>" hidden>
						 <input type="text" name="loginphone" value="<?=$loginphone?>" hidden>

						 <input type="text" name="auctionid" value="<?=$quotedauctionid?>" hidden>
						 <input type="text" name="auctionername" value="<?=$auctionername?>" hidden>
						 <input type="text" name="auctioneremail" value="<?=$auctioneremail?>" hidden>
						 <input type="text" name="bidamount" value="<?=$quotedprice?>" hidden>


						&nbsp;&nbsp; <button type="submit" style="font-size:10px;padding:5px" class="btn btn-default" name="button">Respond to this user</button>
					</form>
					 <?php } ?>
				 </td>
			 </tr>
			 <?php } ?>
    </table>
</div>

<?php
			} // auction by properties foreach
		} // if auctionbypropertyid
	} //properties by user foreach end
?>

<?php include './includes/footer.php'; ?>
