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
$auctionsbyuserdata = $functions->getAuctionsQuotedByUserId($loginid,$logintype);

/*--Displaying--*/
$data = "<div style='font-weight:bold;text-align:center;font-size:26px;padding-bottom:20px'>All Auctions Data</div>";
$data.= '<h4 style="font-size:22px;padding-bottom:15px;">'.$username.'</h4>';

foreach($auctionsbyuserdata as $allauctions){
	$auctionid = $allauctions['auctionid'];
	$auctiondetailsbyid = $functions->getAllAuctionDataById($auctionid);
	$auctionedpropertyid = $auctiondetailsbyid[0]['property_id'];
	$auctionpropertydata = $functions->getAllPropertiesById($auctionedpropertyid);
	$propertyid = $auctionpropertydata[0]['id'];
	$propertytitle = $auctionpropertydata[0]['title'];
	$auctionquotedatasbyid = $functions->getAuctionsQuotedById($auctionid);

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
				<td>Bid Amount (₹)</td>
			</tr>
';
$slno = 1;
$highestvalue = 0;
foreach($auctionquotedatasbyid as $auction){
	$auctionerid = $auction['userid'];
	$auctionertype = $auction['usertype'];
	$bidamount = $auction['quoted_price'];
	$auctionerdatas = $functions->getDataWithTableAndId($auctionertype,$auctionerid);
	$auctionername = $auctionerdatas[0]['name'];
	$auctioneremail = $auctionerdatas[0]['email'];
	$auctionercontactno = $auctionerdatas[0]['contactnumber'];
	if($bidamount > $highestvalue){
		$highestvalue = $bidamount;
		$highestbidid = $auctionerid;
	}
	$data.='
					<tr class="text-center" style="font-size:13px;">
					<td>'.$slno++.'</td>
					<td>'.$auctionername.'</td>
					<td>'.$auctioneremail.'</td>
					<td>'.$auctionercontactno.'</td>
					<td>'.$bidamount.'</td>
					</tr>';
				}
$data.='</table></div>';
	}
/*--------------------------PDF WRITING---------------------------------------*/
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($stylesheet2,1);
$mpdf->WriteHTML($data,2);
$mpdf->Output('participatedAuctionHistory.pdf','I');



















?>
