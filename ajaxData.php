<?php


include './libs/Functions.php';
include './libs/Mails.php';
$functions = new Functions();
$mails = new Mails();
$type = $_POST['type'];

if($type === 'editProperty') {
	$id = $_POST['id'];
	$propertydatas = $functions->getAllPropertiesById($id);
	$alltypes = $functions->getAllPropertyTypes();
	if($propertydatas){
		$propertydatas = $propertydatas[0];
		$propid = $propertydatas['id'];
		$proptitle = $propertydatas['title'];
		$propuser = $propertydatas['userid'];
		$propaddress = $propertydatas['address'];
		$propertytype = $propertydatas['property_type'];
		$price = $propertydatas['price'];
		$location = $propertydatas['location'];?>

		<form class="" action="../actions.php?action=updateProperty" method="post">
			<div class="form-group hidden">
				<label>Property Id</label>
				<input type="text" class='form-control' value='<?=$propid?>' name="propertyid">
			</div>
			<div class="form-group ">
				<label>Property Title</label>
				<input type="text" class='form-control' name="propertytitle" value="<?=$proptitle?>">
			</div>
			<div class="form-group ">
				<label>Property Type</label>
				<select class="form-control" name="Propertytype">
					<option value="">Select a type</option>
					<?php foreach($alltypes as $types){
						$typeid = $types['id'];
						$type = $types['property_type'];
						 ?>
						<option value="<?=$typeid?>" <?php if($propertytype == $typeid){ ?> Selected <?php } ?>><?=$type?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group ">
				<label>Property Price</label>
					<input type="text" class='form-control' name="propertyprice" value="<?=$price?>">
			</div>
			<div class="form-group ">
				<button type="submit" name="button" class='btn btn-primary'>Update Property</button>
			</div>
	</form>
	<?php
	}
}

if($type === 'viewProperty') {
	$id = $_POST['id'];
	$propertydatas = $functions->getAllPropertiesById($id);
	$propertyimage= $functions->getAllPropertyImagesByPropertyid($id);
	$imagecount = sizeof($propertyimage);
	$propertydatas = $propertydatas[0];
	$propid = $propertydatas['id'];
	$proptitle = $propertydatas['title'];
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
	 ?>

		<div class='row text-capitalize'>
			<div class="col-xs-4">
				<div id="carousel-content-row-generic" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<?php for($i=0;$i<$imagecount;$i++){ ?>
						<li data-target="#carousel-content-row-generic" data-slide-to="<?=$i?>" class="<?php if(($i === 0)){ ?>active<?php }?>"></li>
						<?php } ?>
					</ol>
					<div class="carousel-inner">
						<?php
							$imagenumber = 0;
							foreach($propertyimage as $images){
								$imageid = $images['id'];
								$image   = $images['image'];
								$image   = '.'.$image;
								$imagenumber++;
						 ?>
						<div class="item  <?php if($imagenumber === 1){ ?>active<?php }?>">
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
			<div class="col-xs-8">
				<div class="col-xs-12">
					<div class="col-xs-2">Posted By</div>
					<div class="col-xs-1 text-center">:</div>
					<div class="col-xs-9"><?=$agentname?></div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-2">Property Type</div>
					<div class="col-xs-1 text-center">:</div>
					<div class="col-xs-9"><?=$propertytype?></div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-2">Price</div>
					<div class="col-xs-1 text-center">:</div>
					<div class="col-xs-9"><?=$price?></div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-2">Posted on</div>
					<div class="col-xs-1 text-center">:</div>
					<div class="col-xs-9"><?=$posteddate?></div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-2">Status</div>
					<div class="col-xs-1 text-center">:</div>
					<div class="col-xs-9"><?=$propstatus?></div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-2">Description</div>
					<div class="col-xs-1 text-center">:</div>
					<div class="col-xs-9"><?=$description?></div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-2">Location</div>
					<div class="col-xs-1 text-center">:</div>
					<div class="col-xs-9 viewinmap" style='cursor:pointer;color:navy'  data-mapurl="https://maps.google.com/maps?q=<?=$latitude?>,<?=$longitude?>&hl=es;z=14&amp;output=embed"  data-toggle="modal" data-target=".viewlocationinmap">View location in map</div>
				</div>
				<div class="col-xs-12">
					<div class="col-xs-2">Address</div>
					<div class="col-xs-1 text-center">:</div>
					<div class="col-xs-9"><?=$propaddress?></div>
				</div>

			</div>

		</div>


<?php }

	if($type === 'addFavourites') {
		$propertyid = $_POST['propertyid'];
		$agentid = $_POST['agentid'];
		$logintype = $_POST['logintype'];
		$addtofav = $functions->addFavourites($propertyid,$agentid,$logintype);
		if($addtofav){
				$favouriteid = $addtofav[1];
			?>
			<button type="button" data-logintype="<?=$logintype?>" data-agentid="<?=$agentid?>" data-propid="<?=$propertyid?>"  data-favid="<?=$favouriteid?>" name="button" class='btn btn-warning btn-fill removefav'>Remove from favourites</button>
		<?php }else{ ?>
			<button type="button" data-logintype="<?=$logintype?>" data-agentid="<?=$agentid?>" data-propid="<?=$propertyid?>" name="button" class='btn btn-primary btn-fill addfav'>Add to favourites</button>
	 <?php	}
	}

	if($type === 'removeFavourites') {
		$favouriteid = $_POST['favouriteid'];
		$propertyid = $_POST['propertyid'];
		$agentid = $_POST['agentid'];
		$logintype = $_POST['logintype'];
		$table = 'favourites';
		$removeFav = $functions->delete($table,$favouriteid);
		if($removeFav){			?>
			<button type="button" data-logintype="<?=$logintype?>" data-agentid="<?=$agentid?>" data-propid="<?=$propertyid?>" name="button" class='btn btn-primary btn-fill addfav'>Add to favourites</button>
		<?php }else{ ?>
			<button type="button" data-logintype="<?=$logintype?>" data-agentid="<?=$agentid?>" data-propid="<?=$propertyid?>"  data-favid="<?=$favouriteid?>" name="button" class='btn btn-warning btn-fill removefav'>Remove from favourites</button>
	 <?php	}
	}

if($type === 'expressInterest') {
	$posteduser 		= $_POST['posteduser'];
	$logintype  		= $_POST['logintype'];
	$interesteduser = $_POST['userid'];
	$propertyid     = $_POST['propertyid'];
	$propertydatas  = $functions->getAllPropertiesById($propertyid);
	$propertytitle = $propertydatas[0]['title'];
	$propertylocation = $propertydatas[0]['location'];

	$interesteddatas = $functions->getInterstesByPropertyIdLoginTypeAndUserId($propertyid,$logintype,$interesteduser);
	if(empty($interesteddatas)){
	if($posteduser === 'admin'){
		$posteduserdata = $functions->getDataWithTableAndId('admin','1');
		$postedusername = 'admin';
		$posteduseremail = $posteduserdata[0]['email'];
}else{
		$posteduserdata = $functions->getDataWithTableAndId('agents',$posteduser);
		$postedusername = $posteduserdata[0]['name'];
		$posteduseremail = $posteduserdata[0]['email'];
	}


	$interesteduserdatas = $functions->getDataWithTableAndId($logintype,$interesteduser);
	$interestedusername = $interesteduserdatas[0]['name'];
	$interesteduseremail = $interesteduserdatas[0]['email'];
	$interesteduserphone = $interesteduserdatas[0]['contactnumber'];

	$sendinterestmail = $mails->expressInterestMail($interesteduser,$interestedusername,$interesteduseremail,$interesteduserphone,$postedusername,$posteduseremail,$propertyid,$propertytitle,$propertylocation);

		if($sendinterestmail) {
				$addinterest  = $functions->addPropertyInterest($interesteduser,$logintype,$propertyid);
				if($addinterest) { ?>
					<button style='font-size:11px;padding:2px;width:100%' type="button" name="button" class='btn btn-success btn-fill'  disabled>Interest Expressed</button>
					<?php	}else{ ?>
						<button type="button" name="button" class='btn btn-success btn-fill expressinterest' data-posteduserid="<?=$posteduser?>"  data-logintype="<?=$logintype?>" data-interesteduserid="<?=$interesteduser?>" data-propid="<?=$propertyid?>" >Express Interest</button>
						<?php 	}
					}
				}
			}


if($type === 'markassold') {
	$propertyid = $_POST['propertyid'];
	$auctioncheck = $functions->getAuctionByPropertyid($propertyid);
	$result = $functions->setSoldProperty($propertyid);
	if($result){
		if($auctioncheck){ $removeauction = $functions->deleteAuctionByPropertyId($propertyid); }
		?>
		<button style='font-size:11px;padding:2px;width:100%'
					 type="button"
					 disabled
					 class='btn btn-default sold markassoldbtn'
					 name="button">Marked as sold</button>
	<?php }
}


if($type === 'changestatus') {
	$propertyid = $_POST['propertyid'];
	$value = $_POST['value'];
	$result = $functions->changePropertyStatus($propertyid,$value);
	if($result){

						if($value === 'approved'){?>
							<div class="col-xs-3 text-center tooltip-demo  changestatusdiv"  data-toggle="tooltip" data-placement="bottom" title="Click to approve">
								<i class="fa fa-ban changestatusbtn"  data-statusvalue="blocked"  data-propertyid='<?=$propertyid?>' ></i>
							</div>
						<?php }

						if($value === 'blocked'){ ?>
							<div class="col-xs-3 text-center tooltip-demo   changestatusdiv"   data-toggle="tooltip" data-placement="bottom" title="Click to approve"  >
								<i class="fa fa-check changestatusbtn"  data-statusvalue="approved"  data-propertyid='<?=$propertyid?>' ></i>
							</div>

			 <?php 				}
								 }
		}



if($type === 'markforauction') {
	$propertyid = $_POST['propertyid'];
	$result = $functions->setPropertyForAuction($propertyid,$startdate,$enddate);
	if($result){ ?>
		<button style='font-size:11px;padding:2px;width:100%'
					 type="button"
					 disabled
					 class='btn btn-default sold markassoldbtn'
					 name="button">Marked as sold</button>
	<?php }
}












 ?>
