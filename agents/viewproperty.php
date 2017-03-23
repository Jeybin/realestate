<?php
$today = date("Y-m-d");

include './includes/header.php';
$propertyid = $_GET['propertyid'];
$propertydatas = $functions->getAllPropertiesById($propertyid);
$allpropertyimages= $functions->getAllPropertyImagesByPropertyid($propertyid);
$imagecount = sizeof($allpropertyimages);
$propertydatas = $propertydatas[0];
$propid = $propertydatas['id'];
$proptitle = $propertydatas['title'];
$posteduserid = $propertydatas['userid'];
$postedby = $propertydatas['userid'];
$description = $propertydatas['description'];
$agentname = $postedby;
if($postedby !== 'admin'){
	$agentdatas = $functions->getAgentsById($postedby);
	$agentname = $agentdatas[0]['name'];
}
$posteddate = $propertydatas['posteddate'];
$posteddate = date("d-m-Y", strtotime($posteddate));
$propstatus = $propertydatas['status'];
$propaddress = $propertydatas['address'];
$propertytype = $propertydatas['property_type'];
$propertytype = $functions->getPropertyTypeById($propertytype);
$propertytype = $propertytype[0]['property_type'];
$price = $propertydatas['price'];
$location = $propertydatas['location'];
$latitude = $propertydatas['latitude'];
$longitude = $propertydatas['longitude'];
$auctiondata = $functions->getAuctionByPropertyid($propertyid);
$solddata = $functions->getPropertiesSoldByPropertyId($propertyid);
if($auctiondata){
	$auctionid = $auctiondata[0]['id'];
	$auctionstartdate = $auctiondata[0]['start_date'];
	$auctionenddate = $auctiondata[0]['end_date'];
	$todayAndAuctionStartDateDifference= $functions->getDateDifference($today,$auctionstartdate);
	$todayAndAuctionEndDateDifference= $functions->getDateDifference($today,$auctionenddate);
}

$favouritesdatas = $functions->getFavouritesByUserIdAndPropertyId($loginid,$propertyid);
$interestedproperties = $functions->getInterestedDatasByUseridAndProppertyId($loginid,$propertyid);

?>


<div class="col-xs-offset-1 col-xs-10 property_lg_maincontainer">

	<div class="col-xs-12" >
		<a class='pull-left' href="allproperties.php" style="color:#2d2d2d;font-size:14px;opacity:0.5"><i class="fa fa-arrow-circle-o-left"></i>&nbsp; Go Back</a>
		<a class='pull-right' href="allproperties.php" style="color:#2d2d2d;font-size:14px;opacity:0.5"><i class="fa fa-print"></i></a>

	</div>

	<div class="col-xs-12 property_lg_div materialshadow">
		<div class="col-xs-4 property_lg_imagediv">
			<div id="carousel-content-row-generic" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php for($i=0;$i<$imagecount;$i++){ ?>
					<li data-target="#carousel-content-row-generic" data-slide-to="<?=$i?>" class="<?php if(($i === 0)){ ?>active<?php }?>"></li>
					<?php } ?>
				</ol>
				<div class="carousel-inner">
					<?php
						$imagenumber = 0;
						foreach($allpropertyimages as $propertyimages){
							$imageid = $propertyimages['id'];
							$image   = $propertyimages['image'];
							$image   = '.'.$image;
							$imagenumber++;
					 ?>
					<div class="item propertiesimagecontainer <?php if($imagenumber === 1){ ?>active<?php }?>">
						<img src="<?=$image?>">
					</div>
					<?php } ?>
				</div>
				<a class="left carousel-control" href="#carousel-content-row-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-content-row-generic" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>


		</div>
		<div class="col-xs-8 property_lg_headData">
			<div class="col-xs-12 property_lg_heading text-capitalize"><?=$proptitle?></div>
			<div class="col-xs-12 property_lg_other_datas" style="font-weight:600" >

				<div class="col-xs-12" style="padding:0">
					<div class="col-xs-3">Posted By</div>
					<div class="col-xs-1">:</div>
					<div class="col-xs-8 text-capitalize"><?=$agentname?> &nbsp;&nbsp;&nbsp; <?php if($posteduserid !== 'admin'){?><a href="posteduserprofile.php?userid=<?=$posteduserid?>">View User Profile</a><?php } ?></div>
				</div>

				<div class="col-xs-12" style="padding:0">
					<div class="col-xs-3">Posted On</div>
					<div class="col-xs-1">:</div>
					<div class="col-xs-8 text-capitalize"><?=$posteddate?></div>
				</div>

				<div class="col-xs-12" style="padding:0">
					<div class="col-xs-3">Property Type</div>
					<div class="col-xs-1">:</div>
					<div class="col-xs-8 text-capitalize"><?=$propertytype?></div>
				</div>

					<div class="col-xs-12" style="padding:0">
						<div class="col-xs-3">Location</div>
						<div class="col-xs-1">:</div>
						<div class="col-xs-8 text-capitalize"><?=$location?></div>
					</div>

						<div class="col-xs-12" style="padding:0">
							<div class="col-xs-3">Price</div>
							<div class="col-xs-1">:</div>
							<div class="col-xs-8 text-capitalize">₹&nbsp;<?=$price?></div>
						</div>


			</div>

				<div class="col-xs-12 property_lg_btn_container text-right">

					<button type="button" name="button" class='btn btn-toolbar btn-fill viewinmap' data-mapurl="https://maps.google.com/maps?q=<?=$latitude?>,<?=$longitude?>&hl=es;z=14&amp;output=embed"  data-toggle="modal" data-target=".viewlocationinmap">View Location Map</button>

					<?php if($loginid !== $posteduserid) { ?>
					<span class='favbtn'>
							<?php
							if($favouritesdatas){
								$favouriteid = $favouritesdatas[0]['id'];
								?>
								<button type="button" data-logintype="<?=$logintype?>" data-agentid="<?=$loginid?>" data-propid="<?=$propertyid?>"  data-favid="<?=$favouriteid?>" name="button" class='btn btn-warning btn-fill  removefav'>Remove from favourites</button>
							<?php }else{ ?>
								<button type="button" data-logintype="<?=$logintype?>" data-agentid="<?=$loginid?>" data-propid="<?=$propertyid?>" name="button" class='btn btn-primary  btn-fill addfav'>Add to favourites</button>
							<?php } ?>
					</span>

					<?php
					 if($auctiondata){
								if($todayAndAuctionStartDateDifference < 0){ ?> <button type="button" name="button" class='btn btn-primary' disabled>Auction Ended</button>  <?php }
								elseif($todayAndAuctionStartDateDifference > 0){ ?> <button type="button" class='btn btn-primary' name="button" disabled>Auction Not Started</button> <?php }
								elseif(($todayAndAuctionStartDateDifference >= 0) && ($todayAndAuctionEndDateDifference > 0)) {
									$checkbid = $functions->getAuctionDataByAuctionIdAndUserId($auctionid,$loginid);
									if($checkbid){
											$bidid = $checkbid[0]['id'];
											$bidprice = $checkbid[0]['quoted_price'];
									?>

									<button data-toggle="modal" data-target=".increaseBidAmount" data-bidprice="<?=$bidprice?>" data-bidid="<?=$bidid?>" type="button" class='btn btn-primary updateBidBtn' name="button">Increase Bid </button>
									<?php }else{ ?>
										<button data-toggle="modal"
														data-target=".bidModal"
														data-propPrice="<?=$price?>"
														data-auctionid="<?=$auctionid?>"
														type="button" class='btn btn-primary submitBidBtn' name="button">Bid This Property</button>
									<?php	} ?>
									  <?php }

							} else { if($solddata){?>
								<button type="button" name="button" class='btn btn-primary btn-fill'>Sold</button>
						<?php	}else{ ?>
							<span class='interestbtncontainer'>
									<?php if($interestedproperties){ ?>
								<button type="button" name="button" class='btn btn-success btn-fill'  disabled>Already Interest Expressed</button>
								<?php }else { ?>
									<button type="button" name="button" class='btn btn-success btn-fill expressinterest' data-posteduserid="<?=$posteduserid?>"  data-logintype="<?=$logintype?>" data-interesteduserid="<?=$loginid?>" data-propid="<?=$propertyid?>" >Express Interest</button>
								<?php } ?>
							</span>
					<?php	}
				}
			} ?>

			</div>
		</div>

		<div class="col-xs-12" style="padding-top:25px;padding-bottom:25px">
			<h3>Property Address</h3>
			<p class='text-justify' style="color:#2d2d2d;font-size:14px;"><?=$propaddress?></p>
		</div>

		<div class="col-xs-12" style="padding-top:25px;padding-bottom:25px">
			<h3>About Property</h3>
			<p class='text-justify' style="color:#2d2d2d;font-size:14px;"><?=$description?></p>
		</div>

	</div>


</div>



<?php include './includes/footer.php'; ?>

<div class="modal fade viewlocationinmap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content confirmationmodals">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h5 class="confirmationmodalstext">Location in map</h5>
      </div>
      <div class="modal-body nopadding">
				<iframe class="mapmodal" src="" height="450" frameborder="0" style="width:100%" allowfullscreen></iframe>      </div>
        <button style="margin-bottom:5px;margin-left:15px" type="button" class="btn btn-default modalcancelbtn" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

	<div class="modal fade bidModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Submit Bid Amount</h4>
	      </div>
	      <div class="modal-body">
					<form class="" action="../actions.php?action=submitAgentBid" method="post">
					<div class="form-group hidden">
						<label>Auction Id</label>
						<input type="text" class="form-control auctionIdModalField" name="auctionid" >
					</div>
					<div class="form-group hidden">
						<label>User Id</label>
						<input type="text" class="form-control" name="userid" value="<?=$loginid?>" >
					</div>
					<div class="form-group">
						<label>Bid Amount</label>
						<input type="number" class="form-control newbidamountfield" placeholder="Enter bid amount" name="bidamount" >
					</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Submit Bid</button>
				</form>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade increaseBidAmount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Change Bid Amount</h4>
	      </div>
	      <div class="modal-body">
					<form class="" action="../actions.php?action=updateAgentBid" method="post">
					<div class="form-group hidden">
						<label>Bid Id</label>
						<input type="text" class="form-control raiseBidIdField" name="bidid" >
					</div>
					<div class="form-group">
						<label>Bid Amount</label>
						<input type="number" class="form-control raiseBidAmountField" placeholder="Enter bid amount" name="bidamount" >
					</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Submit Bid</button>
				</form>
	      </div>
	    </div>
	  </div>
	</div>
