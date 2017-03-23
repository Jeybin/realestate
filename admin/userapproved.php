<?php
	include './includes/header.php';
	$allusers = $functions->getUsersByStatus('approved');
	if($allusers){
	foreach($allusers as $users){
		$name = $users['name'];
		$email = $users['email'];
		$displayimage = $users['displayimage'];
		$displayimage = '.'.$displayimage;
		$contactnumber = $users['contactnumber'];
		$verification = $users['email_verification'];
		$status = $users['status'];
?>

<div class="col-sm-6 col-md-3">
	<div class="thumbnail">
		<div style="height:200px">
			<img class="img-rounded" src="<?=$displayimage?>">
		</div>
		<div class="caption text-center">
			<h3><?=$name?></h3>
			<p class='text-capitalize'>
				<?=$email?> <br>
				<?=$contactnumber?> <br>
				Email <?=$verification?> <br>
				<?=$status?> <br>
			</p>
			<div class="row">
			<div class="col-xs-6">
				<?php if($status === 'approved'){ ?>
				<button type="button" class='btn btn-default' style='border-radius:0' name="button">Block</button>
				<?php }else{ ?>
					<button type="button" class='btn btn-default' style='border-radius:0' name="button">Approve</button>
					<?php } ?>
				</div>
				<div class="col-xs-6">
					<button type="button" class='btn btn-danger' style='border-radius:0' name="button">Delete</button>
					</div>

			</div>
		</div>
	</div>
</div>
<?php
	} }else { ?>
		<h3 class='text-center' style="padding-top:25px;opacity:0.5">No Users Found</h3>
		 <?php } include './includes/footer.php'; ?>
