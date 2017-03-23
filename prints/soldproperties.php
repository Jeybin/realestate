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
$propertiesbyuser = $functions->getPropertiesByUserId($loginid);
$userdatas = $functions->getDataWithTableAndId($logintype,$loginid);
$username = $userdatas[0]['name'];
$data = "<div style='font-weight:bold;text-align:center;font-size:26px;padding-bottom:20px'>All Sold Properies Datas</div>";
$data.= '<h4 style="font-size:22px;padding-bottom:15px;">'.$username.'</h4>';
$data.= '
				<div class="col-xs-12" style="padding: 5px 0; ">
						<table class="table table-bordered" style="background-color:#fff">
							<tr class="text-center" style="font-weight:700;font-size:14px;">
								<td>#</td>
				        <td>Property Id</td>
				        <td>Property Title</td>
								<td>Location</td>
							</tr>
				';
		$slno= 1;
		foreach($propertiesbyuser as $properties){
			$propertyid = $properties['id'];
			$propertytitle = $properties['title'];
			$propertylocation = $properties['location'];
			$soldproperties = $functions->getAllSoldPropertiesByPropertyId($propertyid);
			if($soldproperties){
$data.='
				<tr class="text-center">
					<td>'.$slno++.'</td>
					<td>'.$propertyid.'</td>
					<td>'.$propertytitle.'</td>
					<td>'.$propertylocation.'</td>
				</tr>
  			';
			}// properties by user
		}
$data.='
				</table>
				</div>
				';
/*--------------------------PDF WRITING---------------------------------------*/
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($stylesheet2,1);
$mpdf->WriteHTML($data,2);
$mpdf->Output('conductedAuctionHistory.pdf','I');



















?>
