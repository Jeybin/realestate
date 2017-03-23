<?php
 include './includes/header.php';
	$interestedproperties = $functions->getInterstesByLoginTypeAndUserId($loginid,$logintype);
 ?>

<h4 style="opacity:0.5">
  Interested Properties
  <a href="../prints/propertiesinterested.php?userid=<?=$loginid?>&type=<?=$logintype?>" style="text-decoration:none;color:#01579B">
    <i class="fa fa-print pull-right" style="padding-right:20px"></i>
  </a>
</h4>

<div class="col-xs-12" style="padding: 5px 0; ">

		<table class="table table-bordered" style="background-color:#fff">
			<tr class="text-center" style="font-weight:700;font-size:14px;">
				<td>#</td>
        <td>Property Id</td>
        <td>Property Title</td>
				<td>Property Location</td>
				<td>Property Price</td>
				<td>Owner Name</td>
				<td>Owner Email</td>
				<td>Owner Contact No.</td>
			</tr>
<?php
	$slno=1;
	foreach($interestedproperties as $propertyintrests){
		$propertyid = $propertyintrests['propertyid'];
		$propertydatas = $functions->getAllPropertiesById($propertyid);
		$propertytitle = $propertydatas[0]['title'];
		$propertylocation = $propertydatas[0]['location'];
		$propertyprice = $propertydatas[0]['price'];
		$ownerid = $propertydatas[0]['userid'];
		if($ownerid === 'admin') {
			$ownername = 'Admin';
			$owneremail = 'admin@realestate.com';
			$ownerphone = 'admin@realestate.com';
		}else{
		$ownerdatas = $functions->getAgentsById($ownerid);
		$ownername = $ownerdatas[0]['name'];
		$owneremail = $ownerdatas[0]['email'];
		$ownerphone = $ownerdatas[0]['contactnumber'];
	}
?>
			<tr class="text-center" style="font-size:13px;">
				<td><?=$slno++?></td>
        <td>Prop<?=$propertyid?></td>
        <td><?=$propertytitle?></td>
				<td><?=$propertylocation?></td>
				<td><?=$propertyprice?></td>
				<td><?=$ownername?></td>
				<td><?=$owneremail?></td>
				<td><?=$ownerphone?></td>
			</tr>
<?php } ?>
		</table>
</div>
<?php include './includes/footer.php'; ?>
