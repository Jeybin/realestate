<?php
include './includes/header.php';
$allproperties = $functions->getAllProperties();
$today = date("Y-m-d");
?>

<?php
foreach($allproperties as $property){
	$propertyid = $property['id'];
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
	if($locationlen > 32) {
		$location = substr($location, 0 , 32);
		$location = $location.'...';
	}

	$propertytype = $functions->getPropertyTypeById($typeid);
	$propertytype = $propertytype[0]['property_type'];
	$allpropertyimages = $functions->getAllPropertyImagesByPropertyid($propertyid);
	$imagecount = sizeof($allpropertyimages);
	$auctiondata = $functions->getAuctionByPropertyid($propertyid);
	if($auctiondata){
		$auctionid = $auctiondata[0]['id'];
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
		<div class="jumbotron-contents text-capitalize">
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

				</table>
			</h6>
			<h6>
			</h6>
			<div class="row" style="font-size:18px;">
				<?php
				if($userid === 'admin'){
				if($auctiondata){ ?>
				<div class="col-xs-3 text-center tooltip-demo delAuction" data-auctionid="<?=$auctionid?>"  data-toggle="modal" data-target="#deleteAuctionModal">
					<i class="fa fa-undo" data-toggle="tooltip"  data-placement="bottom" title="Remove this property from auction"></i>
				</div>
				<?php }else{ ?>
					<div class="col-xs-3 text-center tooltip-demo addtoauction"  data-property='<?=$propertyid?>'  data-toggle="modal" data-target="#addAuctionModal">
						<i class="fa fa-gavel "  data-toggle="tooltip" data-placement="bottom" title="Make this property for auction"></i>
					</div>
				<?php } ?>
				<div class="col-xs-3 text-center tooltip-demo editPropertyBtn"  data-propertyid='<?=$propertyid?>'  data-toggle="modal" data-target="#editProperty">
					<i class="fa fa-pencil"  data-toggle="tooltip" data-placement="bottom" title="Edit this property data"></i>
				</div>
			<?php }else{
					if($property['status'] === 'approved'){
				?>
				<div class="col-xs-3 text-center tooltip-demo  changestatusdiv"  data-toggle="tooltip" data-placement="bottom" title="Click to approve">
					<i class="fa fa-ban changestatusbtn"  data-statusvalue="blocked"  data-propertyid='<?=$propertyid?>' ></i>
				</div>
				<?php } else { ?>
					<div class="col-xs-3 text-center tooltip-demo   changestatusdiv"   data-toggle="tooltip" data-placement="bottom" title="Click to approve"  >
						<i class="fa fa-check changestatusbtn"  data-statusvalue="approved"  data-propertyid='<?=$propertyid?>' ></i>
					</div>
					<?php } } ?>
				<div class="col-xs-3 text-center tooltip-demo delPropBtn"  data-propertyid='<?=$propertyid?>'  data-toggle="modal" data-target="#deletePropertyModal">
					<i class="fa fa-trash"  data-toggle="tooltip" data-placement="bottom" title="Delete this property"></i>
				</div>
				<div class="col-xs-3 text-center tooltip-demo viewPropertyBtn"  data-propertyid='<?=$propertyid?>' data-proptitle='<?=$title?>'  data-toggle="modal" data-target="#viewPropertyModal">
					<i class="fa fa-eye"  data-toggle="tooltip" data-placement="bottom" title="View full detailes of this property"></i>
				</div>

			</div>
		</div>
	</div>
</div>

<?php } ?>

<?php include './includes/footer.php'; ?>

<!-- Modal -->
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
  </div>
</div>

<div class="modal fade" id="editProperty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Property</h4>
      </div>
      <div class="modal-body propertyEditModal" style="padding-bottom:25px;">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteAuctionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete Auction</h4>
			</div>
			<div class="modal-body text-center" style="padding:15px;">
				<form class="" action="../actions.php?action=deleteAuction" method="post">
				<input type="text" class='form-control hidden' id='auctionDelId' name="delAuctionId" style="border-radius:0">
				<button type="submit" class="btn btn-danger">Delete</button>
				<button type="submit" class="btn btn-primary"  data-dismiss="modal">Cancel</button>
			</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deletePropertyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Delete Auction</h4>
			</div>
			<div class="modal-body text-center" style="padding:15px;">
				<form class="" action="../actions.php?action=deleteProperty" method="post">
				<input type="text" class='form-control hidden ' id='delpropertyid' name="delpropertyid" style="border-radius:0">
				<button type="submit" class="btn btn-danger">Delete</button>
				<button type="submit" class="btn btn-primary"  data-dismiss="modal">Cancel</button>
			</form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addAuctionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
						<input type="text" class='form-control' name="propertyid" id='propertyModalId'>
					</div>
					<div class="form-group">
						<label>Auction Start Date (The auction start date will be between 30 days from today)</label>
						<input type="text" class='form-control auctionstartdate' placeholder='Please enter date' Readonly name="auctionstartdate" required >
					</div>

					<div class="form-group">
						<label class=''>Auction End Date (This will be added with 30 days automatically) </label>
						<input type="text" name="auctionenddate" class='lastdate form-control' readonly placeholder="please select start date">
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
