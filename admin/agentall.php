<?php
include './includes/header.php';
$allagents = $functions->getAllAgents('DESC');

foreach ($allagents as $agents) {
	$agentid = $agents['id'];
	$profileimage = $agents['displayimage'];
	$profileimage = '.'.$profileimage;
	$agentname = $agents['name'];
	$agentemail = $agents['email'];
	$agentphone = $agents['contactnumber'];
	$agentlicense = $agents['license_no'];
	$agenttype = 'Real Estate Agent';
	$credaidata = $functions->getCredaiByAgentId($agentid);
	if($credaidata){ $agenttype = 'Builder'; }
	$mailverification = $agents['email_verification'];
	$agentstatus = $agents['status'];
?>
<div class="col-sm-6 col-md-3">
	<div class="thumbnail">
		<div style="height:200px">
			<img class="img-rounded" src="<?=$profileimage?>">
		</div>
		<div class="caption text-center">
			<h3><?=$agentname?></h3>
			<p class='text-capitalize'>
				<?=$agenttype?> <br>
				<?=$agentemail?> <br>
				<?=$agentphone?> <br>
				<?=$agentlicense?> <br>
				Email <?=$mailverification?> <br>
				<?=$agentstatus?> <br>
			</p>
			<div class="row">
			<div class="col-xs-6">
				<?php if($agentstatus === 'approved'){ ?>
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
}
include './includes/footer.php'; ?>
