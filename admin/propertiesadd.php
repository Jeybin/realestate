<?php
require '../libs/Common.php';
$common = new Common();
include './includes/header.php';

?>



                <div class="content-row">

                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <div class="panel-title"><b>Add Users</b>
                      </div>

                      <div class="panel-options">
                        <a class="bg" data-target="#sample-modal-dialog-1" data-toggle="modal" href="#sample-modal"><i class="entypo-cog"></i></a>
                        <a data-rel="collapse" href="#"><i class="entypo-down-open"></i></a>
                        <a data-rel="close" href="#!/tasks" ui-sref="Tasks"><i class="entypo-cancel"></i></a>
                      </div>
                    </div>

                    <div class="panel-body">
                      <form action="../actions.php?action=addProperty" method="post" enctype="multipart/form-data">

												<div class="form-group hidden">
                          <label>Id</label>
                          <input required type="text" class="form-control" name='userid' value='admin'>
                        </div>

												<div class="form-group">
                          <label>Title</label>
                          <input required type="text" class="form-control" name='title' placeholder="Enter Title">
                        </div>

												<div class="form-group">
                          <label>Property Type</label>
													<select class="form-control" name="propertytype" required>
														<option value="">Select Property type</option>
														<?php
														$alltypes = $functions->getAllPropertyTypes();
														foreach($alltypes as $types){
															$id = $types['id'];
															$type = $types['property_type'];
														 ?>
														<option value="<?=$id?>"><?=$type?></option>
														<?php } ?>
													</select>
                        </div>


												<div class="form-group">
                          <label>Price (Please list out the full amount)</label>
                          <input required type="text" class="form-control" name='price' placeholder="Price">
                        </div>
												<div class="form-group">
                          <label>Property Image 1</label>
                          <input required type="file" name='propertyimage1'>
                          <p class="help-block">Please image of land</p>
                        </div>
                        <div class="form-group">
                          <label>Property Image 2</label>
                          <input required type="file" name='propertyimage2'>
                          <p class="help-block">Please image of land</p>
                        </div>

                        <div class="form-group">
                          <label>Property Image 3</label>
                          <input required type="file" name='propertyimage3'>
                          <p class="help-block">Please image of land</p>
                        </div>

													<div class="form-group">
	                          <label>A small description</label>
														<textarea required name="description" class='form-control' placeholder='Description' rows="8" cols="80"></textarea>
	                        </div>



												<div class="form-group">
													<label>Property Location</label>
													<?php $common->loactionselector('officelocation')?>
												</div>

													<div class="form-group">
	                          <label>Address</label>
														<textarea required name="address" class='form-control' placeholder='Address' rows="8" cols="80"></textarea>
	                        </div>

												<div class="form-group hidden">
                          <label>Current Date</label>
                          <input required type="text" class="form-control" name='currentdate' value="<?php echo date("Y-m-d") ?>">
                        </div>

												<div class="form-group hidden">
                          <label>Status</label>
                          <input type="text" class="form-control" name='status' value="approved" >
                        </div>
                        <div class="form-group hidden">
                          <label>page</label>
                          <input type="text" class="form-control" name='page' value="admin" >
                        </div>
                        <button type="submit" class="btn btn-primary">Add Property</button>
                      </form>
                    </div>
                  </div>

                </div>





    <?php include './includes/footer.php'; ?>
