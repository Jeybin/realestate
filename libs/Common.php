<?php

require_once ('DbConnection.php');

class Common extends DbConnection {

      public function uploads($file, $dest) {
              $Imagefile = $_FILES["$file"];
              //file properties
              $fileName = $Imagefile['name'];
              $fileType = $Imagefile['type'];
              $fileSize = $Imagefile['size'];
              $fileTempName = $Imagefile['tmp_name'];
              $fileError = $Imagefile['error'];
              //file upload
              $fileExt = explode('.', $fileName);
              $fileExt = strtolower(end($fileExt));
              $allowedExt = array('png', 'jpeg', 'jpg', 'pdf');
              if (in_array($fileExt, $allowedExt)) {
                  if ($fileError === 0) {
                      if ($fileSize <= '2000000') {
                          $fileNew = uniqid('', TRUE) . '.' . $fileExt;
                          $fileDest = $dest . $fileNew;
                          if (move_uploaded_file($fileTempName, $fileDest)) {
                              return $fileDest;
                          }
                      } else {
                          echo "Image Upload Error";
                      }
                  }
              }
          }


          public function multipleuploads($file, $dest) {
                  $Imagefile = $_FILES["$file"];
                  $arrayName = $Imagefile['name'];
                  $arrayType = $Imagefile['type'];
                  $arrayTmp = $Imagefile['tmp_name'];
                  $arrayError = $Imagefile['error'];
                  $arraySize = $Imagefile['size'];
                  $totalFiles = sizeof($arrayName);
                  $lastfile = ($totalFiles)-1;
                  for($i=0;$i<$totalFiles;$i++){
                      $fileName = $arrayName[$i];
                      $fileType = $arrayType[$i];
                      $fileSize = $arraySize[$i];
                      $fileTempName = $arrayTmp[$i];
                      $fileError = $arrayError[$i];
                      $fileExt = explode('.', $fileName);
                      $fileExt = strtolower(end($fileExt));
                      $allowedExt = array('png', 'jpeg', 'jpg', 'pdf');
                      if (in_array($fileExt, $allowedExt)) {
                          if ($fileError === 0) {
                              if ($fileSize <= '2000000') {
                                  $fileNew = uniqid('', TRUE) . '.' . $fileExt;
                                  $fileDest = $dest . $fileNew;
                                  if (move_uploaded_file($fileTempName, $fileDest)) {
                                      return $fileDest;
                                  }
                              } else {
                                  return FALSE;
                              }
                          }
                      }
                  }
              }


      /*------------- Location selector with text field only (without map) ----------*/

      public function locationSelectorFieldOnly($fieldname) {?>
        <script type="text/javascript">
          function initialize() {
                var input = document.getElementById('searchTextField');
                var countryrestriction = {componentRestrictions: {'country': 'ind'}}; // limited search by india
                var autocomplete = new google.maps.places.Autocomplete(input,countryrestriction);
                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                          var place = autocomplete.getPlace();
                          latitude = place.geometry.location.lat();
                      		longitude = place.geometry.location.lng();

                          address = place.formatted_address; // gets the formated address of the selected place from places object
                          splitaddress = address.split(","); // spliting the array
                     		  console.log(splitaddress);
                       		splitaddresslength = splitaddress.length;
                          if(splitaddresslength === 1) {
                            countryfrommap = splitaddress[splitaddresslength - 1]; // always the last one in array is country
                       			statefrommap = splitaddress[splitaddresslength - 1]; // and the second last one in array is state
                       			cityfrommap = splitaddress[splitaddresslength - 1];  // and same as above the third last one will be city
                          } else if(splitaddresslength <= 2) {
                       			countryfrommap = splitaddress[splitaddresslength - 1]; // always the last one in array is country
                       			statefrommap = splitaddress[splitaddresslength - 2]; // and the second last one in array is state
                       			cityfrommap = splitaddress[splitaddresslength - 2];  // and same as above the third last one will be city
                       		}
                       		else {
                       			countryfrommap = splitaddress[splitaddresslength - 1]; // always the last one in array is country
                       			statefrommap = splitaddress[splitaddresslength - 2]; // and the second last one in array is state
                       			cityfrommap = splitaddress[splitaddresslength - 3]; // and same as above the third last one will be city
                       		}
                        $('#searchTextField').val(address); // into full location field
                    		$('#citylocation_fieldonly').val(cityfrommap); // into city field
                    		$('#statelocation_fieldonly').val(statefrommap); // into state field
                    		$('#countrylocation_fieldonly').val(countryfrommap); // into country field
                    		$('#latvalue_fieldonly').val(latitude); // into hidden latitude
                    		$('#lonvalue_fieldonly').val(longitude); // into hidden longitude
                      });
              }
              google.maps.event.addDomListener(window, 'load', initialize);
        </script>
            <input id="searchTextField" type="text" name="<?=$fieldname?>" class="form-control" size="50">
            <input type="text" name="latitude_fieldonly" id="latvalue_fieldonly" class="hidden" />
          	<input type="text" name="longitude_fieldonly" id="lonvalue_fieldonly" class="hidden" />

      <?php }


      public function loactionselector() {?>

        <!-- Add locations and GeoCordinates ------------------------------------------------------------------------------------------------------------>
        <!------><input type="text" class="form-control select_location selectedlocation" readonly name="location" placeholder="click to add location" required /><!-------->
      	<!------><input type="" name="latitude" class="latvalue hidden" /><!------------------------------------------------------------------------------->
      	<!------><input type="" name="longitude" class="lonvalue hidden" /><!------------------------------------------------------------------------------>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBi9iGKL01Roy-7MZIOFFA4USHDykfUP8Q&v=3.exp&libraries=places"></script>
        <script type="text/javascript">
            var $map, $autocomplete, $marker, latitude, longitude, address, splitaddress, countryfrommap, statefrommap, cityfrommap, splitaddresslength;
            function initialize() {
                  var auto_complete_input = document.getElementById('place_autocomplete'); // search field in the map modal
                  var auto_complete_options = {componentRestrictions: {'country': 'ind'}}; // limited search by india
                  var lanlng = new google.maps.LatLng(12.8505,73.2711); // default location given is kerala
                  var map_options = {
                      zoom: 7,
                      center: lanlng,
                      mapTypeId: google.maps.MapTypeId.HYBRID,
                      disableDefaultUI: true
                  };
                var map_loader = document.getElementById('map_view'); //div which map is loading
                $autocomplete = new google.maps.places.Autocomplete(auto_complete_input, auto_complete_options); // places auto completion
                $map = new google.maps.Map(map_loader, map_options); // map loading
                $marker = new google.maps.Marker({ // map options
                    position: lanlng,
                    map: $map,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    title: 'Click me',
                    visible: false
              });
              google.maps.event.addListener($autocomplete, "place_changed", getSelectedplace); // getting datas of changed place
              google.maps.event.addListener($marker, "dragend", function (event) {
                  latitude = this.getPosition().lat(); // changed latitude
                  longitude = this.getPosition().lng() // changed longitude
              });
            }

          function getSelectedplace() {
            var place = $autocomplete.getPlace();
            if (!place.geometry) {
              alert("Your Searched place not found!.Plase use the makers to point to your location to get the GeoCordinates");
              return;
            } else {
                var location = place.geometry.location;
                latitude = place.geometry.location.lat();
                longitude = place.geometry.location.lng();
                $map.panTo(location);
                $map.setZoom(16);
                $marker.setPosition(location);
                $marker.setVisible(true);
                $marker.setAnimation(google.maps.Animation.BOUNCE);
                console.log(place);
                alert("Plase Select your exact position.\n1.Drag the marker to your location\n2.Use mouse to scroll and pan arround the map\n3.Locate your position and Drop the marker there");
                address = place.formatted_address; // gets the formated address of the selected place from places object
      console.log(address);
                splitaddress = address.split(","); // spliting the array
                console.log(splitaddress);
                splitaddresslength = splitaddress.length;
                if(splitaddresslength <= 2) {
                  countryfrommap = splitaddress[splitaddresslength - 1]; // always the last one in array is country
                  statefrommap = splitaddress[splitaddresslength - 2]; // and the second last one in array is state
                  cityfrommap = splitaddress[splitaddresslength - 2];  // and same as above the third last one will be city
                }
                else {
                  countryfrommap = splitaddress[splitaddresslength - 1]; // always the last one in array is country
                  statefrommap = splitaddress[splitaddresslength - 2]; // and the second last one in array is state
                  cityfrommap = splitaddress[splitaddresslength - 3]; // and same as above the third last one will be city
                }
                $('.selectedlocation').val(address); // into full location field
                $('#citylocation').val(cityfrommap); // into city field
                $('#statelocation').val(statefrommap); // into state field
                $('#countrylocation').val(countryfrommap); // into country field
                $('.latvalue').val(latitude); // into hidden latitude
                $('.lonvalue').val(longitude); // into hidden longitude
              }
            }

          $(document).ready(function () {
          initialize();
          $('.select_location').focus(function () {
              console.log("focused");
              var location_input = $(this);
              var $modal = $('#locationSelectModal');
              var lan_input = $('input[name=latitude]');
              var lng_input = $('input[name=longitude]');
              var $modal_submit = $modal.find('button.save_location');
              $modal.modal('show').on('shown.bs.modal', function () {google.maps.event.trigger($map, "resize");});
          });
      });
      </script>
      <div class="modal fade locationselectionmodal" id="locationSelectModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" id="place_autocomplete" placeholder="Enter Your Location name [ Eg: Mala,kerala ]" autocomplete="on">
            </div>
            <div class="modal-body"><div class="map_view" id="map_view"></div></div>
            <div class="modal-footer">
                <button class="save_location closemapmodal" type="button"  data-dismiss="modal">Use this Location</button>
            </div>
          </div>
        </div>
      </div>
      <?php }

      /*--------- location selector function end-----------------*/



}

?>
