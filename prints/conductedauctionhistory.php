<?php

$loginid = $_GET['userid'];
$logintype = $_GET['type'];

require '../mpdf/mpdf.php';
require '../libs/Functions.php';
$mpdf = new mPDF();
$functions = new Functions();

$stylesheet = file_get_contents('../assets/bootstrap/css/bootstrap.css');
$stylesheet2 = file_get_contents('../assets/css/pdfstyles.css');

/*--------Datas from DB------*/
$userdatas = $functions->getDataWithTableAndId($logintype,$loginid);
$username = $userdatas[0]['name'];
$propertiesbyuser = $functions->getPropertiesByUserId($loginid);

/*--Displaying--*/
$data = "<div style='font-weight:bold;text-align:center;font-size:26px;padding-bottom:20px'>Conducted Auctions Data</div>";
$data.= '<h4 style="font-size:22px;padding-bottom:15px;">'.$username.'</h4>';

foreach($propertiesbyuser as $properties){
	$propertyid = $properties['id'];
	$propertytitle = $properties['title'];
	$auctionbyproperties = $functions->getAuctionByPropertyid($propertyid);
	if($auctionbyproperties){
		foreach($auctionbyproperties as $auctionproperties){
			$auctionid = $auctionproperties['id'];
			$highestBidData = $functions->getHighestBid($auctionid);
			$highestBid = $highestBidData[0]['MAX(quoted_price)'];
			$highestBidId = $highestBidData[0]['id'];
			$quotedAuctionData = $functions->getQuotedAuctionByAuctionId($auctionid);

$data.='
<div class="col-xs-12" style="padding: 5px 0 15px; ">
		<div style="padding: 5px 0;font-size:12px;" class="col-xs-12"><div class="">Property Id - '.$propertyid.'</div></div>
		<div style="padding: 2px 0 15px;font-size:16px;font-weight:Bold" class="col-xs-12"><div class="text-capitalize">'.$propertytitle.'</div></div>
		<table class="table table-bordered" style="background-color:#fff">
			<tr class="text-center" style="font-weight:700;font-size:14px;background-color:#607D8B;color:rgba(255,255,255,1)">
				<td>#</td>
        <td>Auctioneer</td>
        <td>Email</td>
				<td>Contact No</td>
				<td>Bided Date</td>
				<td>Bid Amount (₹)</td>
			</tr>
';
$slno = 1;
$slno = 1;
foreach($quotedAuctionData as $quotes){
	$quoteduserid = $quotes['userid'];
	$quotedusertype = $quotes['usertype'];
	$quotedprice = $quotes['quoted_price'];
	$quoteddate = $quotes['quoteddate'];
	$quotedauctionid = $quotes['auctionid'];
	$auctionerdatas = $functions->getDataWithTableAndId($quotedusertype,$quoteduserid);
	$auctionername = $auctionerdatas[0]['name'];
	$auctioneremail = $auctionerdatas[0]['email'];
	$auctionercontactno = $auctionerdatas[0]['contactnumber'];

$data.='
					<tr class="text-center" style="font-size:13px;">
					<td>'.$slno++.'</td>
					<td>'.$auctionername.'</td>
					<td>'.$auctioneremail.'</td>
					<td>'.$auctionercontactno.'</td>
					<td>'.$quoteddate.'</td>
					<td>'.$quotedprice.'</td>
					</tr>';
				}
$data.='</table></div>';
	}
} // if auctionbypropertyid
} //properties by user foreach end

/*--------------------------PDF WRITING---------------------------------------*/
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($stylesheet2,1);
$mpdf->WriteHTML($data,2);
$mpdf->Output('conductedAuctionHistory.pdf','I');



















?>
