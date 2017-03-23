<?php
	$propertytypes = $functions->getAllPropertyTypes();
	$allproperties = $functions->getAllPropertiesByStatus('approved');

 ?>
	<main class="cd-main-content">
		<div class="cd-tab-filter-wrapper">
			<div class="cd-tab-filter">
				<ul class="cd-filters">
					<li class="placeholder">
						<a data-type="all" href="#0">All</a> <!-- selected option on mobile -->
					</li>
					<li class="filter"><a class="selected" href="#0" data-type="all">All</a></li>
					<?php
						foreach ($propertytypes as $types) {
							$typeid = $types['id'];
							$typename = $types['property_type'];
							$typeid = '.type'.$typeid;
					 ?>
					<li class="filter" data-filter="<?=$typeid?>"><a style='text-decoration:none !important;cursor:pointer' hrefref="#0" data-type="<?=$typeid?>"><?=$typename?></a></li>

					<?php } ?>
				</ul> <!-- cd-filters -->
			</div> <!-- cd-tab-filter -->
		</div> <!-- cd-tab-filter-wrapper -->

		<section class="cd-gallery">
			<ul>
				<?php foreach($allproperties as $properties){
					$propertyid = $properties['id'];
					$propertytitle = $properties['title'];
					$propertyprice = $properties['price'];
					$propertyimage = $functions->getAllPropertyImagesByPropertyid($propertyid);
					$propertyimage = $propertyimage[0]['image'];
					$typeid = $properties['property_type'];
					$typeid = 'type'.$typeid;
					$soldchecking = $functions->getPropertiesSoldByPropertyId($propertyid);
					$auctionchecking = $functions->getAuctionByPropertyid($propertyid);
					if($soldchecking){
							$saletype = 'sold';
						} elseif($auctionchecking){
							$saletype = 'auction';
						}else{
							$saletype = 'forsale';

						}

					?>

				<li class="mix <?=$typeid?> <?=$propertytitle?> <?=$saletype?>">
					<div class="properties">
						<div class="image-holder"><img src="<?=$propertyimage?>" class="img-responsive" alt="properties"/>
							<?php
								if($soldchecking){
							 ?>
							<div class="status sold">Sold</div>
							<?php } elseif($auctionchecking){ ?>
								<div class="status new">Auction</div>
								<?php } else{ ?>
									<div class="status sold">For Sale</div>
							<?php  } ?>
						</div>
						<h4><a href="property-detail.php"><?=$propertytitle?></a></h4>
						<p class="price">Price: ₹<?=$propertyprice?></p>
						<a class="btn btn-primary" href="property-detail.php">View Details</a>
					</div>
				</li>
<?php } ?>
				<li class="gap"></li>
				<li class="gap"></li>
				<li class="gap"></li>
			</ul>
			<div class="cd-fail-message">No results found</div>
		</section> <!-- cd-gallery -->

		<div class="cd-filter">
			<form>
				<div class="cd-filter-block">
					<h4>Search</h4>

					<div class="cd-filter-content">
						<input type="search" placeholder="Seatch by title">
					</div> <!-- cd-filter-content -->
				</div> <!-- cd-filter-block -->

				<div class="cd-filter-block">
					<h4>Search By Sale Type</h4>

					<ul class="cd-filter-content cd-filters list">
						<li>
							<input class="filter" data-filter="" type="radio" name="radioButton" id="radio1" checked>
							<label class="radio-label" for="radio1">All</label>
						</li>

						<li>
							<input class="filter" data-filter=".auction" type="radio" name="radioButton" id="radio2">
							<label class="radio-label" for="radio2">Auction</label>
						</li>

						<li>
							<input class="filter" data-filter=".forsale" type="radio" name="radioButton" id="radio3">
							<label class="radio-label" for="radio3">For Sale</label>
						</li>
					</ul> <!-- cd-filter-content -->
				</div> <!-- cd-filter-block -->
			</form>

		</div> <!-- cd-filter -->

		<a style='text-decoration:none !important;cursor:pointer' hrefref="#0" class="cd-filter-trigger">Filters</a>
	</main> <!-- cd-main-content -->
