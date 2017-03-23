<?php
include './includes/header.php';
$allproperties = $functions->getAllProperties();
$today = date("Y-m-d");
foreach($allproperties as $property){
	$propertyid = $property['id'];
	if($property['userid'] == $loginid){
	$userid = $property['userid'];
	$username = $userid;
	if($userid !== 'admin') {
		$userdatas = $functions->getUsersById($userid);
		if($userdatas){
			$username = $userdatas[0]['name'];
		}
	}
	$title	= $property['title'];
	$titlelen = strlen($title);
	if($titlelen > 17) {
		$title = substr($title, 0 , 17);
		$title = $title.'...';
	}

	$typeid = $property['property_type'];
	$price	= $property['price'];
	$location = $property['location'];
	$locationlen = strlen($location);
	if($locationlen > 20) {
		$location = substr($location, 0 , 20);
		$location = $location.'...';
	}
	$propertytype = $functions->getPropertyTypeById($typeid);
	$propertytype = $propertytype[0]['property_type'];
	$allpropertyimages = $functions->getAllPropertyImagesByPropertyid($propertyid);
	$imagecount = sizeof($allpropertyimages);
	$auctiondata = $functions->getAuctionByPropertyid($propertyid);
	$solddata = $functions->getPropertiesSoldByPropertyId($propertyid);
	if($auctiondata){
		$auctionid = $auctiondata[0]['id'];
		$auctionstartdate = $auctiondata[0]['start_date'];
		$auctionenddate = $auctiondata[0]['end_date'];
		$todayAndAuctionStartDateDifference= $functions->getDateDifference($today,$auctionstartdate);
		$todayAndAuctionEndDateDifference= $functions->getDateDifference($today,$auctionenddate);
	}

	 ?>

<div class="col-md-3">
	<div class="jumbotron">
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
		<div class="jumbotron-contents text-capitalize" >

			<h5><?=$title?></h5>
			<h6>
				<table>

					<tr>
						<td style="width:90px;padding: 1px 0 10px">Posted By</td>
						<td  style="padding: 1px 5px 10px" class='text-center'>:</td>
						<td style="padding: 1px 0 10px"><?=$username?></td>
					</tr>
					<tr>
						<td style="width:90px;padding: 1px 0 10px">Type</td>
						<td  style="padding: 1px 5px 10px" class='text-center'>:</td>
						<td style="padding: 1px 0 10px"><?=$propertytype?></td>
					</tr>
					<tr>
						<td style="width:90px;padding: 1px 0 10px">Location</td>
						<td  style="padding: 1px 5px 10px" class='text-center'>:</td>
						<td style="padding: 1px 0 10px"><?=$location?></td>
					</tr>
					<tr>
						<td style="width:90px;padding: 1px 0 10px">Price</td>
						<td  style="padding: 1px 5px 10px" class='text-center'>:</td>
						<td style="padding: 1px 0 10px"><?=$price?></td>
					</tr>
					<tr>
						<td style="width:90px;padding: 1px 0 10px">Status</td>
						<td  style="padding: 1px 5px 10px" class='text-center'>:</td>
						<td style="padding: 1px 0 10px"><?=$property['status']?></td>
					</tr>

				</table>
			</h6>
			<h6>
			</h6>
			<div class="row" style="font-size:18px;">

				<?php if($loginid !== $userid) { ?>
				<div class="col-xs-6 text-center tooltip-demo "  style="padding:5px;">
					<?php
					 if($auctiondata){
						 		$auctionid = $auctiondata[0]['id'];

								if($todayAndAuctionStartDateDifference < 0){ ?> <button  style='font-size:11px;padding:2px;width:100%' type="button" class='btn btn-primary'  name="button" disabled>Auction Ended</button> <?php }
								if($todayAndAuctionStartDateDifference > 0){ ?> <button style='font-size:11px;padding:2px;width:100%'  type="button" class='btn btn-primary' name="button" disabled>Auction Not Started</button> <?php }
								if(($todayAndAuctionStartDateDifference >= 0) && ($todayAndAuctionEndDateDifference > 0)){
									$checkbid = $functions->getAuctionDataByAuctionIdAndUserId($auctionid,$loginid);
									if($checkbid){
											$bidid = $checkbid[0]['id'];
											$bidprice = $checkbid[0]['quoted_price'];
										 ?>
										<button style='font-size:11px;padding:2px;width:100%' data-toggle="modal" data-target=".increaseBidAmount" data-bidprice="<?=$bidprice?>" data-bidid="<?=$bidid?>" type="button" class='btn btn-primary updateBidBtn' name="button">Increase Bid </button>
									<?php }else{ ?>
										<button style='font-size:11px;padding:2px;width:100%'
														data-toggle="modal"
														data-target=".bidModal"
														data-propPrice="<?=$price?>"
														data-auctionid="<?=$auctionid?>"
														type="button" class='btn btn-primary submitBidBtn' name="button">Bid This Property</button>
								 <?php	} ?>
									 <?php }

							} else { if($solddata){?>
								<button style='font-size:11px;padding:2px;width:100%' disabled  type="button" class='btn btn-success' name="button">Sold</button>
						<?php	}else{ ?>
							<button style='font-size:11px;padding:2px;width:100%'  type="button" class='btn btn-success' name="button">Express Interest</button>
					<?php	}
							} ?>
					</div>
					<?php }else{ ?>
						<div class="col-xs-6 text-center tooltip-demo "  style="padding:5px;">
								<button style='font-size:11px;padding:2px;width:100%' data-toggle='modal' data-target='.deletePropertyModal' data-propertyid='<?=$propertyid?>' type="button" class='btn btn-default deletePropertyBtn' name="button">Delete</button>
						</div>
						<div class="col-xs-6 text-center tooltip-demo markassolddiv<?=$propertyid?>"  style="padding:5px;">
							<?php
							if($solddata){
								 ?>
								 <button style='font-size:11px;padding:2px;width:100%'
 												type="button"
 												disabled
 												class='btn btn-default sold aucbtn<?=$propertyid?>'
 												name="button">Marked as sold</button>
												<?php }else{ ?>
												<button style='font-size:11px;padding:2px;width:100%'
																data-propertyid='<?=$propertyid?>'
																data-btnclass="aucbtn<?=$propertyid?>"
																data-divclass="markassolddiv<?=$propertyid?>"
																type="button"
																class='btn btn-default sold markassoldbtn'
																name="button">Mark as sold</button>
												<?php } ?>
						</div>
						<div class="col-xs-6 text-center tooltip-demo markforauctiondiv"  style="padding:5px;">
							<?php
							if($auctiondata){
								 ?>
								 <button style='font-size:11px;padding:2px;width:100%'
 												type="button"
												data-toggle="modal"
												data-target='#removeFromAuction'
 												class='btn btn-default removeauctionbtn aucbtn<?=$propertyid?>'
												<?php if($solddata) {echo 'disabled';} ?>
 												name="button">Remove auction</button>
												<?php }else{ ?>
												<button style='font-size:11px;padding:2px;width:100%'
																data-propertyid='<?=$propertyid?>'
																type="button"
																data-toggle="modal"
																data-target='.addAuctionModal'
																<?php if($solddata) {echo 'disabled';} ?>
																class='btn btn-default markforauctionbtn aucbtn<?=$propertyid?>'
																name="button">Mark for auction</button>
												<?php } ?>
						</div>


<?php } ?>
				<div class="col-xs-6 text-center tooltip-demo "  style="padding:5px;">
					<a href="viewproperty.php?propertyid=<?=$propertyid?>">
						<button style='font-size:11px;padding:2px;width:100%'  type="button" class='btn btn-default' name="button">View More</button>
					</a>
				</div>


			</div>
		</div>
	</div>
</div>

<?php } }?>

<?php include './includes/footer.php'; ?>

<!-- Modal -->

<div class="modal fade addAuctionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add to auction</h4>
      </div>
      <div class="modal-body">
				<form class="" action="../actions.php?action=addAuction" method="post">
					<div class="form-group hidden">
						<label>Property Id</label>
						<input type="text" class='form-control addAuctionPropertyIdField' name="propertyid" >
					</div>
					<div class="form-group">
						<label>Auction Start Date (The auction start date will be between 30 days from today)</label>
						<input type="text" class='form-control auction__start' placeholder='Please enter date' Readonly name="auctionstartdate" required >
					</div>

					<div class="form-group">
						<label class=''>Auction End Date (This will be added with 30 days automatically) </label>
						<input type="text" name="auctionenddate" class='auction__end form-control' readonly placeholder="please select start date">
					</div>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add to auction</button>
			</form>
      </div>
    </div>
  </div>
</div>


		<div class="modal fade deletePropertyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header text-center">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Delete Property Type</h4>
					</div>
					<div class="modal-body text-center" style="padding:15px;">
						<form class="" action="../actions.php?action=deletePropertyByAgent" method="post">
						<input type="text" class='form-control propertyidfield hidden' name="propId" style="border-radius:0">
						<button type="submit" class="btn btn-danger">Delete</button>
						<button type="submit" class="btn btn-primary"  data-dismiss="modal">Cancel</button>
					</form>
					</div>
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

<div class="modal fade" id='viewPropertyModal' tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
			<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title viewAboutPropertyHeading">About Property</h4>
      </div>
			<div class="modal-body propertyViewModal" style="padding-bottom:25px;">
			</div>
    </div>
  </div>
</div>

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
