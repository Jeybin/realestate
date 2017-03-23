<?php

require_once ('DbConnection.php');

class Functions extends DbConnection {

	/*------------- LOGIN ------------------*/
	public function logincheck($username,$password) {
		$admincheck = $this->adminLoginCheck($username,$password);
		if($admincheck){
			$loginid = $admincheck[0]['id'];
			$logintype = 'admin';
			return array($loginid,$logintype);
		}else{
			$agentlogincheck = $this->agentLoginCheck($username,$password);
			if($agentlogincheck){
				$loginid = $agentlogincheck[0]['id'];
				$builderscheck = $this->getCredaiByAgentId($loginid);
				if($builderscheck){ $logintype = 'builders'; }
				else{ $logintype = 'agents'; }
				return array($loginid,$logintype);
				}else{
					$userslogincheck = $this->userslogincheck($username,$password);
					if($userslogincheck){
						$loginid = $userslogincheck[0]['id'];
						$logintype = 'users';
						return array($loginid,$logintype);
					}
				}
			}

			return FALSE;
		}

	public function adminLoginCheck($username,$password) {
		$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
		$output = $this->getData($query);
		return $output;
	}
	public function agentLoginCheck($username,$password) {
		$query = "SELECT * FROM agents WHERE email='$username' AND password='$password'";
		$output = $this->getData($query);
		return $output;
	}
	public function userslogincheck($username,$password) {
		$query = "SELECT * FROM users WHERE email='$username' AND password='$password'";
		$output = $this->getData($query);
		return $output;
	}

/*---------------- Agent Datas ---------------*/
public function addAgentData($name,$email,$password,$profileimage,$contact,$address,$location,$city,$state,$country,$pin,$licenseno,$latitude,$longitude,$status){
	$query = "Insert into agents set name         			 = '$name',"
          . "                      email  	 					 = '$email',"
					. "                      password     		   = '$password',"
          . "                      displayimage   		 = '$profileimage',"
					. "                      contactnumber 		   = '$contact',"
          . "                      address  					 = '$address',"
					. "                      location	   				 = '$location',"
					. "                      city					 		   = '$city',"
					. "                      state				 		   = '$state',"
					. "                      country			   		 = '$country',"
          . "                    	 pin	 							 = '$pin',"
          . "                      license_no		 			 = '$licenseno',"
					. "                      latitude   	  		 = '$latitude',"
					. "                      longitde     			 = '$longitude',"
          . "                      email_verification  = 'not verified',"
          . "                      status					  	 = '$status'";
  $output = $this->setDataAndReturnLastInsertId($query);
  return $output;
}

public function getAgentsByEmail($email) {
	$query = "SELECT * FROM agents WHERE email = '$email'";
	$output = $this->getData($query);
	return $output;
}

public function getAgentWithLicenseNo($licenseno){
	$query = "SELECT * FROM agents WHERE license_no = '$licenseno'";
	$output = $this->getData($query);
	return $output;
}

public function getAgentsById($id) {
	$query = "SELECT * FROM agents WHERE id = '$id'";
	$output = $this->getData($query);
	return $output;
}

public function getAllAgents($order='ASC') {
	$query = "SELECT * FROM agents ORDER BY id $order";
	$output = $this->getData($query);
	return $output;
}

public function getAgentDataByStatus($status){
	$query = "SELECT * FROM agents WHERE status = '$status'";
	$output = $this->getData($query);
	return $output;
}


/*-------------------- Credai ---------------------------*/
public function getCredaiByAgentId($agentid){
	$query = "SELECT * FROM credai WHERE agentid = '$agentid'";
	$output = $this->getData($query);
	return $output;
}

public function addCredaiData($agentid,$proof){
	$query = "Insert into credai set agentid       = '$agentid',"
          . "                      credaiproof	 = '$proof'";
  $output = $this->setData($query);
  return $output;
}

/*-------------------------- User Data -----------------------*/

public function getUsersByEmail($email) {
	$query = "SELECT * FROM users WHERE email = '$email'";
	$output = $this->getData($query);
	return $output;
}

public function getUsersByStatus($status) {
	$query = "SELECT * FROM users WHERE status = '$status'";
	$output = $this->getData($query);
	return $output;
}

public function getUsersById($id) {
	$query = "SELECT * FROM users WHERE id = '$id'";
	$output = $this->getData($query);
	return $output;
}


public function addUserData($username,$email,$password,$profileimage,$contactno,$status) {
	$query = "Insert into users set name         			 = '$username',"
          . "                     email  	 					 = '$email',"
					. "                     password     		   = '$password',"
          . "                     displayimage   		 = '$profileimage',"
					. "                     contactnumber 		 = '$contactno',"
          . "                     email_verification = 'not verified',"
          . "                     status					   = '$status'";
  $output = $this->setData($query);
  return $output;
}


public function getUserDataByStatus($status){
	$query = "SELECT * FROM users WHERE status = '$status'";
	$output = $this->getData($query);
	return $output;
}

public function getAllUsers($order='ASC'){
	$query = "SELECT * FROM users ORDER BY id $order";
	$output = $this->getData($query);
	return $output;
}

/*--------------------- Property ----------------------*/
public function getPropertyDataBYName($type) {
	$query = "SELECT * FROM property_types WHERE property_type = '$type'";
	$output = $this->getData($query);
	return $output;
}


public function getAllPropertyTypes() {
	$query = "SELECT * FROM property_types";
	$output = $this->getData($query);
	return $output;
}

public function getPropertyTypeById($typeid) {
	$query = "SELECT * FROM property_types WHERE id='$typeid'";
	$output = $this->getData($query);
	return $output;
}

public function getAllProperties() {
	$query = "SELECT * FROM properties";
	$output = $this->getData($query);
	return $output;
}


public function getAllPropertiesById($id) {
	$query = "SELECT * FROM properties WHERE id='$id'";
	$output = $this->getData($query);
	return $output;
}



public function getAllPropertiesByStatus($status){
	$query = "SELECT * FROM properties WHERE status = '$status'";
	$output = $this->getData($query);
	return $output;
}
public function getAllPropertiesByStatusAndorder($status,$order='ASC'){
	$query = "SELECT * FROM properties WHERE status = '$status' ORDER BY id $order";
	$output = $this->getData($query);
	return $output;
}

public function addPropertyTypes($type){
	$query = "Insert into property_types set property_type = '$type'";
  $output = $this->setData($query);
  return $output;
}

public function updatePropertyType($id,$name){
	$query  = "UPDATE property_types SET property_type = '$name' WHERE id = '$id'" ;
	$output = $this->setData($query);
	return $output;
}

public function updatePropertyDatasById($id,$title,$type,$price){
	$query  = "UPDATE properties SET id = '$id', title='$title', property_type='$type' WHERE id = '$id'" ;
	$output = $this->setData($query);
	return $output;
}

public function checkLocation($latitude,$longitude){
	$query = "SELECT * FROM properties WHERE latitude = '$latitude' AND longitude = '$longitude'";
	$output = $this->getData($query);
	return $output;
}

public function addProperty($userid,$title,$type,$price,$address,$currentdate,$status,$location,$lat,$long,$description) {
	$query = "Insert into properties set userid     = '$userid',"
					. "                     title  	 				= '$title',"
          . "                     address  	 			= '$address',"
					. "                     property_type   = '$type',"
          . "                     price				   	= '$price',"
					. "                     posteddate		 	= '$currentdate',"
          . "                     status					= '$status',"
					. "                     location				= '$location',"
					. "                     description			= '$description',"
					. "                     latitude				= '$lat',"
          . "                     longitude				= '$long'";
  $output = $this->setDataAndReturnLastInsertId($query);
  return $output;
}

public function addPropertyImage($lastid,$propertyimage){
	$query = "Insert into propertyimages set property_id  = '$lastid',"
          . "                    					 image				= '$propertyimage'";
  $output = $this->setDataAndReturnLastInsertId($query);
  return $output;
}

public function getAllPropertyImagesByPropertyid($propertyid){
	$query = "SELECT * FROM propertyimages WHERE property_id = '$propertyid'";
	$output = $this->getData($query);
	return $output;
}

public function getPropertiesByUserId($userid){
	$query = "SELECT * FROM properties WHERE userid = '$userid'";
	$output = $this->getData($query);
	return $output;
}


public function deletePropertyImagesByPropertyId($propertyid){
	$query = "DELETE FROM propertyimages WHERE property_id=$propertyid";
	$output = $this->setData($query);
	return $output;
}

public function getAllSoldPropertiesByPropertyId($propertyid){
	$query = "SELECT * FROM soldproperties WHERE propertyid = '$propertyid'";
	$output = $this->getData($query);
	return $output;
}

public function DeleteSoldPropertiesByPropertyId($propertyid){
	$query = "DELETE FROM soldproperties WHERE propertyid=$propertyid";
	$output = $this->setData($query);
	return $output;
}

/*----------------- Auctions -------------------------*/

public function getAllAuctionData(){
	$query = "SELECT * FROM auctions";
	$output = $this->getData($query);
	return $output;
}

public function getAllAuctionDataById($id){
	$query = "SELECT * FROM auctions WHERE id='$id'";
	$output = $this->getData($query);
	return $output;
}


public function getAuctionByPropertyid($propertyid){
	$query = "SELECT * FROM auctions WHERE property_id = '$propertyid'";
	$output = $this->getData($query);
	return $output;
}

public function addPropertyToAuction($propertyid,$startdate,$enddate){
	$query = "Insert into auctions set property_id  = '$propertyid',"
					. "                   		 start_date		= '$startdate',"
          . "                   		 end_date			= '$enddate'";
  $output = $this->setData($query);
  return $output;
}

public function deleteAuctionByPropertyId($id){
	$query = "DELETE FROM auctions WHERE property_id=$id";
	$output = $this->setData($query);
	return $output;
}

public function getQuotedAuctionByAuctionId($auctionid){
	$query = "SELECT * FROM auctions_qouted WHERE auctionid = '$auctionid'";
	$output = $this->getData($query);
	return $output;
}

public function getAuctionDataByAuctionIdAndUserId($auctionid,$userid){
	$query = "SELECT * FROM auctions_qouted WHERE auctionid = '$auctionid' AND userid = '$userid'";
	$output = $this->getData($query);
	return $output;
}

public function deleteQuotedAuctions($auctionid){
	$query = "DELETE FROM auctions_qouted WHERE auctionid=$auctionid";
	$output = $this->setData($query);
	return $output;
}



public function setBidAmount($auctionid,$quoteddate,$bidamount,$userid,$usertype) {
	$query = "Insert into auctions_qouted set auctionid  		= '$auctionid',"
					. "                   		 				usertype			= '$usertype',"
					. "                   		 				userid				= '$userid',"
					. "                   		 				quoteddate		= '$quoteddate',"
          . "                   		 				quoted_price	= '$bidamount'";
  $output = $this->setData($query);
  return $output;
}

public function updateBidAmount($bidid,$bidamount,$quoteddate){
	$query  = "UPDATE auctions_qouted SET quoted_price = '$bidamount', quoteddate = '$quoteddate' WHERE id = $bidid" ;
	$output = $this->setData($query);
	return $output;
}


public function getAuctionsQuotedByUserId($loginid,$logintype){
	$query = "SELECT * FROM auctions_qouted WHERE userid = '$loginid' AND usertype = '$logintype'";
	$output = $this->getData($query);
	return $output;
}


public function getAuctionsQuotedById($auctionid){
	$query = "SELECT * FROM auctions_qouted WHERE auctionid = '$auctionid' ";
	$output = $this->getData($query);
	return $output;
}

public function getHighestBid($auctionid){
	$query = "SELECT id, MAX(quoted_price) FROM auctions_qouted WHERE auctionid='$auctionid'";
	$output = $this->getData($query);
	return $output;
}



/*--------------------------Sales--------------------------*/

public function getAllSales(){
	$query = "SELECT * FROM soldproperties ";
	$output = $this->getData($query);
	return $output;
}
	public function getPropertiesSoldByPropertyId($propertyid){
	$query = "SELECT * FROM soldproperties WHERE propertyid = $propertyid";
	$output = $this->getData($query);
	return $output;
}

public function setSoldProperty($propertyid) {
	$query = "Insert into soldproperties set propertyid	= '$propertyid'";
  $output = $this->setData($query);
  return $output;
}

/*------------------------- Rent ------------------------*/
public function getPropertyRentsPropertyid($propertyid){
	$query = "SELECT * FROM rent WHERE propertyid = $propertyid";
	$output = $this->getData($query);
	return $output;
}

/*--------------------- favourites -------------------*/
public function getFavouritesByUserIdAndPropertyId($loginid,$propertyid){
	$query = "SELECT * FROM favourites WHERE userid='$loginid' AND propertyid='$propertyid'";
	$output = $this->getData($query);
	return $output;
}

public function addFavourites($propertyid,$agentid,$logintype){
	$query = "Insert into favourites set propertyid	= '$propertyid',"
          . "                    			 userid			= '$agentid',"
          . "                     		 logintype	= '$logintype'";
  $output = $this->setDataAndReturnLastInsertId($query);
  return $output;
}

public function getFavouritesByUserIdAndType($loginid,$logintype){
	$query = "SELECT * FROM favourites WHERE userid='$loginid' AND logintype='$logintype'";
	$output = $this->getData($query);
	return $output;
}


/*------------------------- Interests ------------------------*/
public function getInterestedDatasByUseridAndProppertyId($loginid,$propertyid){
	$query = "SELECT * FROM interested WHERE userid='$loginid' AND propertyid='$propertyid'";
	$output = $this->getData($query);
	return $output;
}

public function addPropertyInterest($interesteduser,$logintype,$propertyid){
	$query = "Insert into interested set userid			= '$interesteduser',"
          . "                    			 logintype	= '$logintype',"
          . "                     		 propertyid	= '$propertyid'";
  $output = $this->setData($query);
  return $output;
}

public function getInterstesByPropertyIdLoginTypeAndUserId($propertyid,$logintype,$interesteduser){
	$query = "SELECT * FROM interested WHERE userid='$interesteduser' AND logintype='$logintype' AND propertyid='$propertyid'";
	$output = $this->getData($query);
	return $output;
}
public function getInterstesByLoginTypeAndUserId($loginid,$logintype){
	$query = "SELECT * FROM interested WHERE userid='$loginid' AND logintype='$logintype'";
	$output = $this->getData($query);
	return $output;
}


/*-------------------------- Common -----------------------*/
public function emailChecking($email){
	$userscheck = $this->getUsersByEmail($email);
	if($userscheck){
		return $userscheck;
	}else{
		$agentcheck = $this->getAgentsByEmail($email);
		if($agentcheck){
			return $agentcheck;
		}else{
			return FALSE;
		}
	}
}

public function delete($table,$id) {
		$query = "DELETE FROM $table WHERE id=$id";
		$output = $this->setData($query);
		return $output;
}

public function getDataWithTableAndId($table,$id){
	$query = "SELECT * FROM $table WHERE id = $id";
	$output = $this->getData($query);
	return $output;
}

public function passwordChange($table,$new,$loginid){
	$query  = "UPDATE $table SET password = '$new' WHERE id = '$loginid'" ;
	$output = $this->setData($query);
	return $output;
}

public function changeMailVerificationStatus($table,$id,$status='verified') {
	$query  = "UPDATE $table SET email_verification = '$status' WHERE id = $id" ;
	$output = $this->setData($query);
	return $output;
}

public function getDateDifference($date1,$date2) {
	$date1				=	date_create($date1);
	$date2				=	date_create($date2);
	$difference		= date_diff($date1,$date2);
	$daysdifference =  $difference->format("%R%a");
	return $daysdifference;
}

public function getAllAdminDatas(){
	$query = "SELECT * FROM admin";
	$output = $this->getData($query);
	return $output;
}

public function changePropertyStatus($propertyid,$value){
	$query  = "UPDATE properties SET status = '$value' WHERE id = '$propertyid'" ;
	$output = $this->setData($query);
	return $output;
}

public function setPropertyForAuction($propertyid,$startdate,$enddate){
	$query = "INSERT INTO auctions SET property_id='$propertyid',start_date='$startdate',end_date='$enddate'";
	$output = $this->setData($query);
	return $output;
}

public function changeToNewPassword($loginid,$table,$email,$mailverification) { ?>
	<script type="text/javascript">
	<?php  if($mailverification === 'not verified') { ?>
			$(document).ready(function(){
						$('.changeNewPassword').modal({
								backdrop: 'static',
								keyboard: false
						});
							$('.changeNewPassword').modal('show');
					});
		<?php } ?>
	</script>

		<div class="modal fade changeNewPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body" style="padding: 25px;">
						<form action="../actions.php?action=firstPasswordChange" method="post">
								<input  type="text" class="form-control hidden" name="loginid" value="<?=$loginid?>" >
								<input  type="text" class="form-control hidden" name="table" value="<?=$table?>" >
								<input  type="text" class="form-control hidden" name="email" value="<?=$email?>" >
								<label>New Password</label>
								<input type="password" class="form-control" name="newpassword" >
								<br>
								<label>Re enter new Password</label>
								<input type="password" class="form-control" name="renewpassword" >
								<br>
								<button type="submit" class="btn btn-primary">Change Password</button>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php }







} ?>
