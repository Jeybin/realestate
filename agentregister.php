<?php
require './libs/Common.php';
$common = new Common();
include './includes/header.php';

?>
<script type="text/javascript">
$(document).on("click",".agentregtype",function(){
	var $type = $(this).val();
	if($type === 'builders'){
	$('.credaiProof').css({
					'display': 'block',
			});
		}else{
			$('.credaiProof').css({
							'display': 'none',
					});
		}
});

</script>
<div class="col-xs-offset-2 col-xs-8">


                <div class="content-row">

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>Add Agents</b>
                      </div>

                      <div class="panel-options">
                        <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i class="entypo-cog"></i></a>
                        <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
                        <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
                      </div>
                    </div>

                    <div class="panel-body">
                      <form action="./actions.php?action=addAgent" method="post" enctype="multipart/form-data">
												<div class="form-group">
                          <label>Company Name</label>
                          <input required type="text" class="form-control" name='name' placeholder="Enter Name">
                        </div>
												<div class="form-group">
                          <label>Email</label>
                          <input required type="email" class="form-control" name='email' placeholder="Enter Email Id">
                        </div>
												<div class="form-group">
                          <label>Contact Number</label>
                          <input required type="text" class="form-control" name='contactno' placeholder="Contact Number">
                        </div>
                        <div class="form-group">
                          <label>Display Image</label>
                          <input required type="file" id="exampleInputFile" name='profileimage'>
                          <p class="help-block">Please upload logo or desired image for display image</p>
                        </div>
												<div class="form-group">
                          <label>License No</label>
                          <input required type="text" class="form-control" name='licenseno' placeholder="Enter license no">
                        </div>

												<div class="form-group">
                          <label>Select type of registration :</label>&nbsp;&nbsp;
													<input type="radio" class="agentregtype" name='registrationtype' value="builders">&nbsp;Builders &nbsp;&nbsp;&nbsp;
                          <input type="radio" class="agentregtype" name='registrationtype' value="realestateagents">&nbsp;Real Estate Agents
                        </div>

											  <div class="form-group credaiProof" style="display:none">
                          <label>CERDAI Registration Proof</label>
                          <input type="file" name='credaiproof'>
                          <p class="help-block">Please upload credai registration</p>
                        </div>

												<div class="form-group">
													<label>Office Location</label>
													<?php $common->loactionselector('officelocation')?>
												</div>

                        <div class="form-group">
													<label>Office City</label>
                          <input type="text" class="form-control select_location" readonly id='citylocation' name='city' placeholder="Office City">
                        </div>

                          <div class="form-group">
  													<label>Office State</label>
                            <input type="text" class="form-control select_location" readonly id='statelocation' name='state' placeholder="Office State">
                          </div>

                          <div class="form-group">
  													<label>Office Country</label>
                            <input type="text" class="form-control select_location" readonly id='countrylocation' name='country' placeholder="Office Country">
                          </div>

												<div class="form-group">
                          <label>Office Address</label>
													<textarea required name="address" class='form-control' placeholder='Enter Address' rows="8" cols="80"></textarea>
                        </div>

												<div class="form-group">
                          <label>Pin Number</label>
                          <input required type="text" name='pin' class="form-control" placeholder="PIN Number">
                        </div>
												<div class="form-group hidden">
                          <label>status</label>
                          <input required type="text" name='status' value='pending' class="form-control">
                        </div>
												<div class="form-group hidden">
                          <label>page</label>
                          <input required type="text" name='page' value='home' class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Add Agent</button>
                      </form>
                    </div>
									</div>
                  </div>

                </div>





    <?php include './includes/footer.php'; ?>
