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
                      <form action="../actions.php?action=addUser" method="post" enctype="multipart/form-data">
												<div class="form-group">
                          <label>User Name</label>
                          <input required type="text" class="form-control" name='name' placeholder="Enter Name">
                        </div>
												<div class="form-group">
                          <label>Email</label>
                          <input required type="email" class="form-control" name='email' placeholder="Enter Email Id">
                        </div>
												<div class="form-group">
                          <label>Display Image</label>
                          <input required type="file" id="exampleInputFile" name='profileimage'>
                          <p class="help-block">Please upload logo or desired image for display image</p>
                        </div>
												<div class="form-group">
                          <label>Contact Number</label>
                          <input required type="text" class="form-control" name='contactno' placeholder="Contact Number">
                        </div>
                        <div class="form-group hidden">
                          <label>Status</label>
                          <input required type="text" class="form-control" name='status' value='approved' placeholder="Contact Number">
                        </div>
                        <div class="form-group hidden">
                          <label>page</label>
                          <input required type="text" name='page' value='admin' class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                      </form>
                    </div>
                  </div>

                </div>





    <?php include './includes/footer.php'; ?>
