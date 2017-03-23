<?php include './includes/header.php';
$propertiesbyuser = $functions->getPropertiesByUserId($loginid);

?>
<h4 style="opacity:0.5">
  Sold Properties History
  <a href="../prints/soldproperties.php?userid=<?=$loginid?>&type=<?=$logintype?>" style="text-decoration:none;color:#01579B">
    <i class="fa fa-print pull-right" style="padding-right:20px"></i>
  </a>
</h4>

<div class="col-xs-12" style="padding: 5px 0; ">

		<table class="table table-bordered" style="background-color:#fff">

			<tr class="text-center" style="font-weight:700;font-size:14px;">
				<td>#</td>
        <td>Property Id</td>
        <td>Property Title</td>
				<td>Location</td>
			</tr>

			<?php
				$slno= 1;
				foreach($propertiesbyuser as $properties){
					$propertyid = $properties['id'];
					$propertytitle = $properties['title'];
					$propertylocation = $properties['location'];
					$soldproperties = $functions->getAllSoldPropertiesByPropertyId($propertyid);
					if($soldproperties){
					?>

			<tr class="text-center">
				<td><?=$slno++;?></td>
        <td>Property <?=$propertyid?></td>
        <td><?=$propertytitle?></td>
				<td><?=$propertylocation?></td>
			</tr>

			<?php
		 				}// properties by user
					}
		 ?>

		</table>
</div>


<?php include './includes/footer.php'; ?>
