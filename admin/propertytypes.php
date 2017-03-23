<?php
require '../libs/Common.php';
$common = new Common();
include './includes/header.php';

?>



                <div class="content-row">

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>Add Property Types</b>
                      </div>
                    </div>

								    <div class="panel-body">
                      <form action="../actions.php?action=addPropertyType" method="post" enctype="multipart/form-data">
												<div class="form-group">
                          <label>Property  Types</label>
                          <input required type="text" class="form-control" name='propertytype' placeholder="Enter Property Type">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Property Type</button>
                      </form>
                    </div>
                  </div>

                </div>

								<?php

								$allpropertytypes = $functions->getAllPropertyTypes();
								foreach($allpropertytypes as $propertytypes){
									$id = $propertytypes['id'];
									$type = $propertytypes['property_type'];
								 ?>

								<div class="col-xs-3">
									<ul class="list-group"><li class="list-group-item">
										<?=$type?>
 										<i class='fa fa-pencil pull-right editPropType' data style="font-size:14px" data-toggle="modal" data-target='#editTypeModal' data-id='<?=$id?>' data-ptype='<?=$type?>'></i>
										<i class='fa fa-trash pull-right delPropType' style="font-size:14px;margin-right:5px" data-toggle="modal" data-target='#delTypeModal' data-id='<?=$id?>'></i>
									</li></ul>
								</div>
<?php } ?>



    <?php include './includes/footer.php'; ?>


		<div class="modal fade" id="editTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Edit Property Type</h4>
		      </div>
		      <div class="modal-body">
						<form action="../actions.php?action=updatePropertyType" method="post">

						<input type="text" class='form-control propertyid hidden' name="propeId" style="border-radius:0">
						<input type="text" class='form-control propertyname' name="propName" style="border-radius:0">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">update</button>
					</form>
		      </div>
		    </div>
		  </div>
		</div>

				<div class="modal fade" id="delTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header text-center">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Delete Property Type</h4>
				      </div>
				      <div class="modal-body text-center" style="padding:15px;">
								<form class="" action="../actions.php?action=deletePropertyType" method="post">
								<input type="text" class='form-control propertyid hidden' name="propId" style="border-radius:0">
								<button type="submit" class="btn btn-danger">Delete</button>
								<button type="submit" class="btn btn-primary"  data-dismiss="modal">Cancel</button>
							</form>
				      </div>
				    </div>
				  </div>
				</div>
