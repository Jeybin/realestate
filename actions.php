<?php
require './libs/Functions.php';
require './libs/Mails.php';
require './libs/Common.php';
$functions = new Functions();
$mails = new Mails();
$common = new Common();

if (!empty($_REQUEST)) {
  $action = $_REQUEST['action'];

  /*------------- adding----------------*/


    if($action === 'addAgent') {
    		$name = $_POST['name'];
    		$email = $_POST['email'];
    		$dp = 'profileimage';
    		$contact = $_POST['contactno'];
    		$address = $_POST['address'];
    		$pin = $_POST['pin'];
    		$licenseno = $_POST['licenseno'];
    		$registrationtype = $_POST['registrationtype'];
    		$latitude = $_POST['latitude'];
    		$longitude = $_POST['longitude'];
    		$licenseno = $_POST['licenseno'];
        $location = $_POST['location'];
    		$city = $_POST['city'];
    		$state = $_POST['state'];
    		$country	= $_POST['country'];
    		$address = $_POST['address'];
        $status = $_POST['status'];
        $page = $_POST['page'];
    		$dpdest = './images/agent/profileimage/';
        $licensenochecking = $functions->getAgentWithLicenseNo($licenseno);
        if($licensenochecking){
          echo '<script type="text/javascript">';
          echo 'alert("Already registered with the same licensenumber");';
          if($page === 'admin') {echo 'window.location="./admin/agentadd.php"' ; }
          if($page === 'home'){ echo 'window.location="./agentregister.php"' ;  }
          echo '</script>';
        }else{
      		$emailchecking = $functions->emailChecking($email);
      		if($emailchecking){
            echo '<script type="text/javascript">';
            echo 'alert("Email Already Used");';
            if($page === 'admin') {echo 'window.location="./admin/agentadd.php"' ; }
            if($page === 'home'){ echo 'window.location="./agentregister.php"' ;  }
            echo '</script>';
      		}
      		else{

            $password = $mails->SendPasswordByMail($name,$email);
      				if($password){

                $profileimage = $common->uploads($dp, $dpdest);
                if($profileimage){

              			$addagentdata = $functions->addAgentData($name,$email,$password,$profileimage,$contact,$address,$location,$city,$state,$country,$pin,$licenseno,$latitude,$longitude,$status);
          					$addagentdatastatus = $addagentdata[0];
          					$addagentdataid = $addagentdata[1];

            				if($addagentdatastatus){

            						if($registrationtype === 'builders') {
          								$credaicheck = $functions->getCredaiByAgentId($addagentdataid);
            							if($credaicheck){
                            echo '<script type="text/javascript">';
                            echo 'alert("Credai Already Added");';
                            if($page === 'admin') { echo 'window.location="./admin/agentadd.php"' ; }
                            if($page === 'home'){ echo 'window.location="./agentregister.php"' ; }
                            echo '</script>';
          								}else{
          									$credaiproof = 'credaiproof';
          									$credaidest = './images/agent/credaiproof/';
            								$credaiupload = $common->uploads($credaiproof, $credaidest);

          									if($credaiupload){
            									$addcredaidata = $functions->addCredaiData($addagentdataid,$credaiupload);
          										if($addcredaidata){
                                echo '<script type="text/javascript">';
                                echo 'alert("Registered as builder");';
                                if($page === 'admin') { echo 'window.location="./admin/agentadd.php"' ; }
                                if($page === 'home'){ echo 'window.location="./index.php"' ; }
                                echo '</script>';
          										}else{
                                echo '<script type="text/javascript">';
                                echo 'alert("Credai data to db failed");';
                                if($page === 'admin') { echo 'window.location="./admin/agentadd.php"' ; }
                                if($page === 'home'){ echo 'window.location="./agentregister.php"' ; }
                                echo '</script>';
          										}
          									}
                            else{
                              echo '<script type="text/javascript">';
                              echo 'alert("Credai proof upload failed");';
                              if($page === 'admin') { echo 'window.location="./admin/agentadd.php"' ; }
                              if($page === 'home'){ echo 'window.location="./agentregister.php"' ; }
                              echo '</script>';
                            }

                          }
          							}else{
                          echo '<script type="text/javascript">';
                          echo 'alert("Agent Added");';
                          if($page === 'admin') { echo 'window.location="./admin/agentadd.php"' ; }
                          if($page === 'home'){ echo 'window.location="./index.php"' ; }
                          echo '</script>';
          							}
          						}else{
                        echo '<script type="text/javascript">';
                        echo 'alert("Error");';
                        if($page === 'admin') { echo 'window.location="./admin/agentadd.php"' ; }
                        if($page === 'home'){ echo 'window.location="./agentregister.php"' ; }
                        echo '</script>';
                      }

                    }else{
                      echo '<script type="text/javascript">';
                      echo 'alert("Display image upload failed");';
                      if($page === 'admin') { echo 'window.location="./admin/agentadd.php"' ; }
                      if($page === 'home'){ echo 'window.location="./agentregister.php"' ; }
                      echo '</script>';
                    }
      					}
      				else{
                echo '<script type="text/javascript">';
                echo 'alert("password sending failed");';
                if($page === 'admin') { echo 'window.location="./admin/agentadd.php"' ; }
                if($page === 'home'){ echo 'window.location="./agentregister.php"' ; }
                echo '</script>';
      				 }
      	 		}
          }
    		}

    if($action === 'addUser') {
        $username = $_POST['name'];
        $email = $_POST['email'];
        $dp = 'profileimage';
        $dpdest = './images/agent/profileimage/';
        $contactno = $_POST['contactno'];
        $status = $_POST['status'];
        $page = $_POST['page'];
        $emailchecking = $functions->emailChecking($email);
        if($emailchecking){
          echo '<script type="text/javascript">';
          echo 'alert("Email Already Used");';
          if($page === 'admin') { echo 'window.location="./admin/useradd.php"' ; }
          if($page === 'home'){ echo 'window.location="./index.php"' ; }
          echo '</script>';
        }else{
          $password = $mails->SendPasswordByMail($username,$email);
          if($password){
            $profileimage = $common->uploads($dp, $dpdest);
            if($profileimage){
              $result = $functions->addUserData($username,$email,$password,$profileimage,$contactno,$status);
              if($result){
                echo '<script type="text/javascript">';
                echo 'alert("User Added");';
                if($page === 'admin') { echo 'window.location="./admin/useradd.php"' ; }
                if($page === 'home'){ echo 'window.location="./index.php"' ; }
                echo '</script>';
              }else{
                echo '<script type="text/javascript">';
                echo 'alert("Failed");';
                if($page === 'admin') { echo 'window.location="./admin/useradd.php"' ; }
                if($page === 'home'){ echo 'window.location="./index.php"' ; }
                echo '</script>';
              }
            }else{
              echo '<script type="text/javascript">';
              echo 'alert("Image upload Failed");';
              if($page === 'admin') { echo 'window.location="./admin/useradd.php"' ; }
              if($page === 'home'){ echo 'window.location="./index.php"' ; }
              echo '</script>';
            }
          }else{
            echo '<script type="text/javascript">';
            echo 'alert("Password Sending Failed");';
            if($page === 'admin') { echo 'window.location="./admin/useradd.php"' ; }
            if($page === 'home'){ echo 'window.location="./index.php"' ; }
            echo '</script>';
          }
        }
      }


    /*------------- Properties----------------*/
    if($action === 'addPropertyType') {
        $type = $_POST['propertytype'];
        $checking = $functions->getPropertyDataBYName($type);
        if($checking){
          echo '<script type="text/javascript">';
          echo 'alert("Property Type Already Added");';
          echo 'window.location="./admin/propertytypes.php"' ;
          echo '</script>';
        }else{
          $result = $functions->addPropertyTypes($type);
          if($result){
            echo '<script type="text/javascript">';
          //  echo 'alert("Property Type Added");';
            echo 'window.location="./admin/propertytypes.php"' ;
            echo '</script>';
          }else{
            echo '<script type="text/javascript">';
            echo 'alert("Failed");';
            echo 'window.location="./admin/propertytypes.php"' ;
            echo '</script>';
          }
        }
      }

    if($action === 'updatePropertyType') {
      $id = $_POST['propeId'];
      $name = $_POST['propName'];
      $result = $functions->updatePropertyType($id,$name);
      if($result){
        echo '<script type="text/javascript">';
      //  echo 'alert("Property Type Added");';
        echo 'window.location="./admin/propertytypes.php"' ;
        echo '</script>';
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./admin/propertytypes.php"' ;
        echo '</script>';
      }
    }

    if($action === 'deletePropertyType') {
      $id = $_POST['propId'];
      $table = 'property_types';
      $result = $functions->delete($table,$id);
      if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Deleted");';
        echo 'window.location="./admin/propertytypes.php"' ;
        echo '</script>';
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./admin/propertytypes.php"' ;
        echo '</script>';
      }
    }

    if($action === 'addProperty') {
      $userid      = $_POST['userid'];
      $title       =  $_POST['title'];
      $type        =  $_POST['propertytype'];
      $price       =  $_POST['price'];
      $address     =  $_POST['address'];
      $currentdate =  $_POST['currentdate'];
      $status      =  $_POST['status'];
      $location    =  $_POST['location'];
      $lat         =  $_POST['latitude'];
      $long        =  $_POST['longitude'];
      $status      =  $_POST['status'];
      $description = $_POST['description'];
      $page = $_POST['page'];
      $propertyimage1 = 'propertyimage1';
      $propertyimage2 = 'propertyimage2';
      $propertyimage3 = 'propertyimage3';
      $propertydest = './images/properties/';
      $propertydefaultimage = './images/properties/default.jpg';
      if(empty($_FILES['propertyimage1'])){ $propertyimage1 = $propertydefaultimage; }
      else{ $propertyupload1 = $common->uploads($propertyimage1, $propertydest); }

      if(empty($_FILES['propertyimage2'])){ $propertyimage2 = $propertydefaultimage; }
      else{ $propertyupload2 = $common->uploads($propertyimage2, $propertydest); }

      if(empty($_FILES['propertyimage3'])){ $propertyimage3 = $propertydefaultimage; }
      else{ $propertyupload3 = $common->uploads($propertyimage3, $propertydest); }

      $result = $functions->addProperty($userid,$title,$type,$price,$address,$currentdate,$status,$location,$lat,$long,$description);


          if($result){
              $propertyid = $result[1];

              $uploaddata1 = $functions->addPropertyImage($propertyid,$propertyupload1);
              $uploaddata2 = $functions->addPropertyImage($propertyid,$propertyupload2);
              $uploaddata3 = $functions->addPropertyImage($propertyid,$propertyupload3);

              echo '<script type="text/javascript">';
              echo 'alert("Property Added");';
              if($page === 'admin'){ echo 'window.location="./admin/propertiesadd.php"' ; }
              if($page === 'agents'){ echo 'window.location="./agents/addproperty.php"' ; }
              echo '</script>';
            }else{
              echo '<script type="text/javascript">';
              echo 'alert("Failed");';
              if($page === 'admin'){ echo 'window.location="./admin/propertiesadd.php"' ; }
              if($page === 'agents'){ echo 'window.location="./agents/addproperty.php"' ; }
              echo '</script>';
            }
        }

    if($action === 'updateProperty') {
      $id = $_POST['propertyid'];
      $title = $_POST['propertytitle'];
      $type = $_POST['Propertytype'];
      $price = $_POST['propertyprice'];
      $result = $functions->updatePropertyDatasById($id,$title,$type,$price);
      if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Updated");';
        echo 'window.location="./admin/propertiesall.php"' ;
        echo '</script>';
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./admin/propertiesall.php"' ;
        echo '</script>';
      }
    }

    if($action === 'deleteProperty') {
      $propertyid = $_POST['delpropertyid'];
      $table = 'properties';
      $auctiondatas = $functions->getAuctionByPropertyid($propertyid);
      $propertyimages = $functions->getAllPropertyImagesByPropertyid($propertyid);
      $soldpropertiesbypropertyid = $functions->getAllSoldPropertiesByPropertyId($propertyid);
      if($auctiondatas){
        $auctionid = $auctiondatas[0]['id'];
        $quotedauction = $functions->getQuotedAuctionByAuctionId($auctionid);
        if($quotedauction){ $deleteQuotedAuction = $functions->deleteQuotedAuctions($auctionid); }
        $delauctions = $functions->deleteAuctionByPropertyId($propertyid);
      }
      if($propertyimages){
          foreach($propertyimages as $propimages){
            $propimages = $propimages['image'];
            unlink($propimages);
          }
        $delpropertyimages = $functions->deletePropertyImagesByPropertyId($propertyid);
      }
      if($soldpropertiesbypropertyid) { $delsoldpropdata = $functions->DeleteSoldPropertiesByPropertyId($propertyid); }
      $result = $functions->delete($table,$propertyid);
      if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Deleted");';
        echo 'window.location="./admin/propertiesall.php"' ;
        echo '</script>';
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./admin/propertiesall.php"' ;
        echo '</script>';
      }
    }


    /*------------------ Auctions ----------------------------*/
    if($action === 'addAuction') {
      $propertyid = $_POST['propertyid'];
      $startdate  = $_POST['auctionstartdate'];
      $enddate = $_POST['auctionenddate'];
      $result = $functions->addPropertyToAuction($propertyid,$startdate,$enddate);
      if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Property Added To Auction");';
        echo 'window.location="./admin/propertiesall.php"' ;
        echo '</script>';
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./admin/propertiesall.php"' ;
        echo '</script>';
      }
    }

    if($action === 'deleteAuction') {
      $id = $_POST['delAuctionId'];
      $table = 'auctions';
      $result = $functions->delete($table,$id);
      if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Deleted");';
        echo 'window.location="./admin/propertiesall.php"' ;
        echo '</script>';
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./admin/propertiesall.php"' ;
        echo '</script>';
      }
    }

    if($action === 'submitAgentBid') {
      $auctionid = $_POST['auctionid'];
      $bidamount = $_POST['bidamount'];
      $userid    = $_POST['userid'];
      $usertype  = 'agents';
      $quoteddate = date("d-m-Y");
      session_start();
      $folder = $_SESSION['logintype'];
      $result = $functions->setBidAmount($auctionid,$quoteddate,$bidamount,$userid,$usertype);
      if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Submitted");';
        echo 'window.location="./'.$folder.'/allproperties.php";';
        echo '</script>';
      }else {
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./'.$folder.'/allproperties.php";';
        echo '</script>';
      }
    }

    if($action === 'updateAgentBid') {
      $bidid = $_POST['bidid'];
      $bidamount = $_POST['bidamount'];
      $quoteddate = date("d-m-Y");
      session_start();
      $folder = $_SESSION['logintype'];
      $result = $functions->updateBidAmount($bidid,$bidamount,$quoteddate);
      if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Bid Updated");';
        echo 'window.location="./'.$folder.'/allproperties.php";';
        echo '</script>';
      }else {
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./'.$folder.'/allproperties.php";';
        echo '</script>';
      }
    }

    if($action === 'deletePropertyByAgent') {

        $propertyid = $_POST['propId'];
        $table = 'properties';
        $auctiondatas = $functions->getAuctionByPropertyid($propertyid);
        $propertyimages = $functions->getAllPropertyImagesByPropertyid($propertyid);
        $soldpropertiesbypropertyid = $functions->getAllSoldPropertiesByPropertyId($propertyid);
        if($auctiondatas){
          $auctionid = $auctiondatas[0]['id'];
          $quotedauction = $functions->getQuotedAuctionByAuctionId($auctionid);
          if($quotedauction){ $deleteQuotedAuction = $functions->deleteQuotedAuctions($auctionid); }
          $delauctions = $functions->deleteAuctionByPropertyId($propertyid);
        }
        if($propertyimages){
            foreach($propertyimages as $propimages){
              $propimages = $propimages['image'];
              unlink($propimages);
            }
          $delpropertyimages = $functions->deletePropertyImagesByPropertyId($propertyid);
        }
        if($soldpropertiesbypropertyid) { $delsoldpropdata = $functions->DeleteSoldPropertiesByPropertyId($propertyid); }
        $result = $functions->delete($table,$propertyid);
        if($result){
          echo '<script type="text/javascript">';
          echo 'alert("Deleted");';
          echo 'window.location="./agents/myproperties.php"' ;
          echo '</script>';
        }else{
          echo '<script type="text/javascript">';
          echo 'alert("Failed");';
          echo 'window.location="./agents/myproperties.php"' ;
          echo '</script>';
        }
    }

    if($action === 'respondtoauctioner') {
      $sendername = $_POST['loginusername'];
      $senderaddress = $_POST['loginaddress'];
      $senderlocation = $_POST['loginloc'];
      $senderemail = $_POST['loginemail'];
      $senderphone = $_POST['loginphone'];
      $quotedauctionid = $_POST['auctionid'];
      $auctionername = $_POST['auctionername'];
      $auctioneremail = $_POST['auctioneremail'];
      $bidamount = $_POST['bidamount'];
      $result = $mails->respondToAuctioner($sendername,$senderaddress,$senderlocation,$senderemail,$senderphone,$quotedauctionid,$auctionername,$auctioneremail,$bidamount);
      if($result){
        echo '<script type="text/javascript">';
        echo 'alert("Responded");';
        echo 'window.location="./agents/counductedauctionhistory.php"' ;
        echo '</script>';
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed");';
        echo 'window.location="./agents/counductedauctionhistory.php"' ;
        echo '</script>';
      }
    }

    /*------------- Login and passwords----------------*/
if($action === 'login') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $result = $functions->logincheck($username,$password);
  if($result){
    $loginid = $result[0];
    $logintype = $result[1];
    session_start();
    $_SESSION['logintype'] = $logintype;
    $_SESSION['loginid'] = $loginid;
    echo '<script type="text/javascript">';
    echo 'alert("welcome");';
    echo 'window.location="./'.$logintype.'/index.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("Username and password are not matching");';
    echo 'window.location="./index.php";';
    echo '</script>';
  }
}

if($action === 'firstPasswordChange'){
    $loginid = $_POST['loginid'];
    $table = $_POST['table'];
    $newpass = $_POST['newpassword'];
    $repassword = $_POST['renewpassword'];
    session_start();
    $page = $_SESSION['logintype'];

    if($newpass == $repassword) {
      $result = $functions->passwordChange($table,$newpass,$loginid);
      if($result){
          $functions->changeMailVerificationStatus($table,$loginid);
          $userdata = $functions->getDataWithTableAndId($table,$loginid);
          $name = $userdata[0]['name'];
          $email = $userdata[0]['email'];
          $mails->notificationmail('Password Changed',$name,'Password changed',$newpass,$email);
          echo '<script type="text/javascript">';
          echo 'alert("password changed");';
          echo 'window.location="./'.$page.'/index.php";';
          echo '</script>';
        }
      }else{
        echo '<script type="text/javascript">';
        echo 'alert("passwords not matching");';
        echo 'window.location="index.php"' ;
        echo '</script>';
  }
}


if($action === 'logout') {
  session_start();
  $page = $_SESSION['logintype'];
  $_SESSION = array(); // Unset all of the session variables.
  if(empty($_SESSION)){
    session_destroy();
    echo '<script type="text/javascript">';
    echo 'alert("See you again");';
    echo 'window.location="./index.php";';
    echo '</script>';
  }else{
    echo '<script type="text/javascript">';
    echo 'alert("Error");';
    echo 'window.location="./'.$page.'/index.php";';
    echo '</script>';
  }
}


}
