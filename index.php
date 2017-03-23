<?php
  include './includes/header.php';
  $latestApprovedPropeties = $functions->getAllPropertiesByStatusAndorder('approved','DESC');

?>

<div class="">
            <div id="slider" class="sl-slider-wrapper">
              <div class="sl-slider">
                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                  <div class="sl-slide-inner">
                    <div class="bg-img bg-img-1"></div>
                    <h2><a href="#">GREAT INDIAN PROPERTY BAZAR</a></h2>
                  </div>
                </div>
          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-2"></div>
              <h2><a href="#">TRUSTED PLACE TO FIND YOUR HOME</a></h2>
            </div>
          </div>

          <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-3"></div>
              <h2><a href="#">FIND YOUR NEXT HOME WITH US</a></h2>
            </div>
          </div>

          <div class="sl-slide" data-orientation="vertical" data-slice1-rotation="-5" data-slice2-rotation="25" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-4"></div>
              <h2><a href="#">LET'S GET YOU HOME</a></h2>
            </div>
          </div>

          <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1">
            <div class="sl-slide-inner">
              <div class="bg-img bg-img-5"></div>

              <h2><a href="#">LIST YOUR PROPERTY<br>
              POST YOUR REQUIREMENTS</a></h2>
            </div>
          </div>
        </div><!-- /sl-slider -->



        <nav id="nav-dots" class="nav-dots">
          <span class="nav-dot-current"></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </nav>

      </div><!-- /slider-wrapper -->
</div>



<div class="banner-search">
  <div class="container">
    <!-- banner -->
    <h3>Buy,Rent & Auction</h3>
    <div class="searchbar">
      <div class="row">
        <div class="col-lg-6 col-sm-6">
            <form method="post" action="action/search_action.php">
          <input type="text" class="form-control" placeholder="Search of Properties" name='property'>
          <div class="row">
            <div class="col-lg-3 col-sm-3 ">
              <select class="form-control" name='type'>
                <option>Buy</option>
                <option>Rent</option>
                <option>Sale</option>
                <option>Auction</option>
              </select>
            </div>
            <div class="col-lg-3 col-sm-4">
              <select class="form-control" name='price'>
                <option>Price</option>
                <option>$150,000 - $200,000</option>
                <option>$200,000 - $250,000</option>
                <option>$250,000 - $300,000</option>
                <option>$300,000 - above</option>
              </select>
            </div>
            <div class="col-lg-3 col-sm-4">
            <select class="form-control" name='title'>
<!--                <option>Property</option>-->
                <option>Apartment</option>
                <option>Flat</option>
<!--                <option>Office Space</option>-->
              </select>
              </div>
              <div class="col-lg-3 col-sm-4">
              <button class="btn btn-success" >Find Now</button>
              </div>
          </div>
          <!--onclick="window.location.href='buysalerent.php'"-->

            </form>
        </div>
        <div class="col-lg-5 col-lg-offset-1 col-sm-6 <?php if(!empty($_SESSION)){ ?> hidden <?php } ?>">
          <p>Join now and get updated with all the properties deals.</p>
          <button class="btn btn-info"   data-toggle="modal" data-target="#loginpop">Login</button>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- banner -->
<div class="container">
  <div class="row">
  <div class="properties-listing spacer"> <a href="allproperties.php" class="pull-right viewall">View All Listing</a>
    <h2>Latest Properties</h2>
    <div id="owl-example" class="owl-carousel">
      <?php
        foreach($latestApprovedPropeties as $properties){
          $propertyid = $properties['id'];
          $propertytitle = $properties['title'];
$propertylen = strlen($propertytitle);
if($propertylen > 20) {
  $propertytitle = substr($propertytitle, 0, 20);
  $propertytitle = $propertytitle.'...';
}

          $propertyprice = $properties['price'];
          $propertyimage = $functions->getAllPropertyImagesByPropertyid($propertyid);
          $propertyimage = $propertyimage[0]['image'];
       ?>
      <div class="properties">
        <div class="image-holder"><img src="<?=$propertyimage?>" class="img-responsive" alt="properties"/>
          <?php
            $soldchecking = $functions->getPropertiesSoldByPropertyId($propertyid);
            $auctionchecking = $functions->getAuctionByPropertyid($propertyid);
            if($soldchecking){
           ?>
          <div class="status sold">Sold</div>
          <?php } elseif($auctionchecking){ ?>
            <div class="status new">Auction</div>
            <?php } else{ ?>
              <div class="status new">For Sale</div>
          <?php  } ?>
        </div>
        <h4><a href="property-detail.php"><?=$propertytitle?></a></h4>
        <p class="price">Price: ₹<?=$propertyprice?></p>
        <a class="btn btn-primary" href="property-detail.php">View Details</a>
      </div>
<?php
  }
 ?>
      </div>
    </div>
  </div>

<div class="row">
  <div class="properties-listing spacer"> <a href="allproperties.php" class="pull-right viewall">View All Listing</a>
    <h2>Properties for auction</h2>

    <?php
      foreach($latestApprovedPropeties as $properties){
        $propertyid = $properties['id'];
        $auctionchecking = $functions->getAuctionByPropertyid($propertyid);
        if($auctionchecking){
        $propertytitle = $properties['title'];
$propertylen = strlen($propertytitle);
if($propertylen > 20) {
  $propertytitle = substr($propertytitle, 0, 20);
  $propertytitle = $propertytitle.'...';
}

        $propertyprice = $properties['price'];
        $propertyimage = $functions->getAllPropertyImagesByPropertyid($propertyid);
        $propertyimage = $propertyimage[0]['image'];
     ?>

    <div class="col-xs-3" style="padding-top:10px ;padding-bottom:10px ;">
    <div class="col-xs-12">
      <div class="properties">
        <div class="image-holder"><img src="<?=$propertyimage?>" class="img-responsive" alt="properties"/>
            <div class="status new">Auction</div>
        </div>
        <h4><a href="property-detail.php"><?=$propertytitle?></a></h4>
        <p class="price">Price: ₹<?=$propertyprice?></p>
        <a class="btn btn-primary" href="property-detail.php">View Details</a>
      </div>
    </div>
  </div>

  <?php
}
  }
   ?>

  </div>
</div>
<div class="row">

  <div class="properties-listing spacer"> <a href="allproperties.php" class="pull-right viewall">View All Listing</a>
    <h2>Properties for sale</h2>
    <?php
      foreach($latestApprovedPropeties as $properties){
        $propertyid = $properties['id'];
        $auctionchecking = $functions->getAuctionByPropertyid($propertyid);
        $rentchecking = $functions->getPropertyRentsPropertyid($propertyid);
        $soldchecking = $functions->getPropertiesSoldByPropertyId($propertyid);
        if((empty($auctionchecking)) && (empty($rentchecking)) && (empty($soldchecking))){
        $propertytitle = $properties['title'];
$propertylen = strlen($propertytitle);
if($propertylen > 20) {
  $propertytitle = substr($propertytitle, 0, 20);
  $propertytitle = $propertytitle.'...';
}

        $propertylen = strlen($propertytitle);
        if($propertylen > 20) {
          $propertytitle = substr($propertytitle, 0, 20);
          $propertytitle = $propertytitle.'...';
        }
        $propertyprice = $properties['price'];
        $propertyimage = $functions->getAllPropertyImagesByPropertyid($propertyid);
        $propertyimage = $propertyimage[0]['image'];
     ?>
  <div class="col-xs-3" style="padding-top:10px ;padding-bottom:10px ;">
    <div class="col-xs-12">
      <div class="properties">
        <div class="image-holder"><img src="<?=$propertyimage?>" class="img-responsive" alt="properties"/>
            <div class="status sold">Sale</div>
        </div>
        <h4><a href="property-detail.php"><?=$propertytitle?></a></h4>
        <p class="price">Price: ₹<?=$propertyprice?></p>
        <a class="btn btn-primary" href="property-detail.php">View Details</a>
      </div>
    </div>
  </div>
  <?php } } ?>

  </div>
</div>

<div class="row">

  <div class="properties-listing spacer"> <a href="allproperties.php" class="pull-right viewall">View All Listing</a>
    <h2>Properties for rent</h2>
    <div class="col-xs-3" style="padding-top:10px ;padding-bottom:10px ;">
    <div class="col-xs-12">
      <?php
        foreach($latestApprovedPropeties as $properties){
          $propertyid = $properties['id'];
          $rentchecking = $functions->getPropertyRentsPropertyid($propertyid);
          if($rentchecking){
          $propertytitle = $properties['title'];
$propertylen = strlen($propertytitle);
if($propertylen > 20) {
  $propertytitle = substr($propertytitle, 0, 20);
  $propertytitle = $propertytitle.'...';
}

          $propertyprice = $properties['price'];
          $propertyimage = $functions->getAllPropertyImagesByPropertyid($propertyid);
          $propertyimage = $propertyimage[0]['image'];
       ?>
      <div class="properties">
        <div class="image-holder"><img src="<?=$propertyimage?>" class="img-responsive" alt="properties"/>
            <div class="status new">Auction</div>
        </div>
        <h4><a href="property-detail.php"><?=$propertytitle?></a></h4>
        <p class="price">Price: ₹<?=$propertyprice?></p>
        <a class="btn btn-primary" href="property-detail.php">View Details</a>
      </div>
      <?php
        }
      }
       ?>
    </div>
  </div>
  </div>
</div>


  <div class="spacer">
    <div class="row">
      <div class="col-lg-6 col-sm-9 recent-view">
        <h3>About Us</h3>
        <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.<br><a href="about.php">Learn More</a></p>

      </div>
      <div class="col-lg-5 col-lg-offset-1 col-sm-3 recommended">
        <h3>Recommended Properties</h3>
        <div id="myCarousel" class="carousel slide">
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" class=""></li>
            <li data-target="#myCarousel" data-slide-to="2" class=""></li>
            <li data-target="#myCarousel" data-slide-to="3" class=""></li>
          </ol>
          <!-- Carousel items -->
          <div class="carousel-inner">
            <div class="item active">
              <div class="row">
                <div class="col-lg-4"><img src="images/properties/1.jpg" class="img-responsive" alt="properties"/></div>
                <div class="col-lg-8">
                  <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                  <p class="price">$300,000</p>
                  <a href="property-detail.php" class="more">More Detail</a> </div>
              </div>
            </div>
            <div class="item">
              <div class="row">
                <div class="col-lg-4"><img src="images/properties/2.jpg" class="img-responsive" alt="properties"/></div>
                <div class="col-lg-8">
                  <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                  <p class="price">$300,000</p>
                  <a href="property-detail.php" class="more">More Detail</a> </div>
              </div>
            </div>
            <div class="item">
              <div class="row">
                <div class="col-lg-4"><img src="images/properties/3.jpg" class="img-responsive" alt="properties"/></div>
                <div class="col-lg-8">
                  <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                  <p class="price">$300,000</p>
                  <a href="property-detail.php" class="more">More Detail</a> </div>
              </div>
            </div>
            <div class="item">
              <div class="row">
                <div class="col-lg-4"><img src="images/properties/4.jpg" class="img-responsive" alt="properties"/></div>
                <div class="col-lg-8">
                  <h5><a href="property-detail.php">Integer sed porta quam</a></h5>
                  <p class="price">$300,000</p>
                  <a href="property-detail.php" class="more">More Detail</a> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include './includes/footer.php';?>
