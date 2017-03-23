


<div class="footer">

<div class="container">



<div class="row">
            <div class="col-lg-3 col-sm-3">
                   <h4>Information</h4>
                   <ul class="row">
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="about.php">About</a></li>
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="agents.php">Agents</a></li>
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="blog.php">Blog</a></li>
                <li class="col-lg-12 col-sm-12 col-xs-3"><a href="contact.php">Contact</a></li>
              </ul>
            </div>

            <div class="col-lg-3 col-sm-3">
                    <h4>Newsletter</h4>
                    <p>Get notified about the latest properties in our marketplace.</p>
                    <form class="form-inline" role="form">
                            <input type="text" placeholder="Enter Your email address" class="form-control">
                                <button class="btn btn-success" type="button">Notify Me!</button></form>
            </div>

            <div class="col-lg-3 col-sm-3">
                    <h4>Follow us</h4>
                    <a href="#"><img src="images/facebook.png" alt="facebook"></a>
                    <a href="#"><img src="images/twitter.png" alt="twitter"></a>
                    <a href="#"><img src="images/linkedin.png" alt="linkedin"></a>
                    <a href="#"><img src="images/instagram.png" alt="instagram"></a>
            </div>

             <div class="col-lg-3 col-sm-3">
                    <h4>Contact us</h4>
                    <p><b>Bootstrap Realestate Inc.</b><br>
<span class="glyphicon glyphicon-map-marker"></span> 8290 Walk Street, Australia <br>
<span class="glyphicon glyphicon-envelope"></span> hello@bootstrapreal.com<br>
<span class="glyphicon glyphicon-earphone"></span> (123) 456-7890</p>
            </div>
        </div>
<p class="copyright">Copyright 2013. All rights reserved.	</p>


</div></div>




<!-- Modal -->
<div id="loginpop" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="row">
        <div class="col-sm-6 login">
        <h4>Login</h4>
        <form class="" role="form" method="post" action="./actions.php?action=login">
        <div class="form-group">
          <label class="sr-only" for="exampleInputEmail2">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label class="sr-only" for="exampleInputPassword2">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-success">Sign in</button>
      </form>
        </div>
        <div class="col-sm-6">
          <h4>New User Sign Up</h4>
          <p>Join today and get updated with all the properties deal happening around.</p>
          <h2>Register as:</h2>
          <button class="btn btn-info"  data-dismiss="modal" data-toggle="modal" data-target='#registerAsUser'>USER</Button>
          <a class="btn btn-info"  href='agentregister.php'>AGENT</a>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
<div id="registerAsUser" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="row">

        <div class="col-xs-12">

              <form action="./actions.php?action=addUser" method="post" enctype="multipart/form-data">
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
                  <input required type="text" class="form-control" name='status' value='pending' placeholder="Contact Number">
                </div>
                <div class="form-group hidden">
                  <label>page</label>
                  <input required type="text" name='page' value='home' class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Add User</button>
              </form>
            </div>


      </div>
    </div>
  </div>
</div>



</body>
</html>
