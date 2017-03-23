<?php

require_once('DbConnection.php');

class Mails extends DbConnection {



/***********************  Send Password or Verification Code  ************************/

public function SendPasswordByMail($name,$email) {
					$password = md5(uniqid(rand(), true));
					$password = substr($password, 0, 6);
					require "./PHPMailer/PHPMailerAutoload.php";
					require "./PHPMailer/class.phpmailer.php";
					require "./PHPMailer/class.smtp.php";
			    $from = $email;
			    $from_name = 'Real Estate';
			    $subject = 'Verification mail from Real Estate project';
			    $body = '<br><br>Hello <span style="text-transform:capitalize">'.$name.'</span>, <br><br> This is a verification mail from Real Estate Project for this mail id <br> <ib>Your Login credentials are given below</ib> <br> <br> <b> Username  : '.$email.' <br> <br> Password : '.$password.'<br>';
			    $to = $email;
			    $mail = new PHPMailer;  // create a new object
			    $mail->IsSMTP(); // enable SMTP   //
			    $mail->SMTPAuth = true;  // authentication enabled
			    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			    $mail->Host = 'smtp.gmail.com';
			    $mail->Port = 465;
			    $mail->Username = "projectatcm@gmail.com";
			    $mail->Password = "[code]magos";
			    $mail->SetFrom($from, $from_name);
			    $mail->addReplyTo($from);
			    $mail->Subject = $subject;
			    $mail->IsHTML(true);
			    $mail->Body = $body;
			    $mail->AddAddress($to);
			    if (!empty($cc)) {
			        $mail->addCC($cc);
			    }
			    if (!empty($bcc)) {
			        $mail->addBCC($bcc);
			    }
			    if (!$mail->Send()) {
			        echo $error = 'Mail error: ' . $mail->ErrorInfo;
			        return false;
			    } else {
			        return $password;
			    }
	}



/***********************  Notification Mail Body  ************************/

public function mailBody($mailsubject,$mailbody,$mailfor) {
				$password = md5(uniqid(rand(), true));
				$password = substr($password, 0, 6);
				require "./PHPMailer/PHPMailerAutoload.php";
				require "./PHPMailer/class.phpmailer.php";
				require "./PHPMailer/class.smtp.php";
				$from = 'projectatcm@gmail.com';
				$from_name = 'Real Estate project';
				$subject = $mailsubject;
				$body = $mailbody;
				$to = $mailfor;
				$mail = new PHPMailer;  // create a new object
				$mail->IsSMTP(); // enable SMTP   //
				$mail->SMTPAuth = true;  // authentication enabled
				$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->Username = "projectatcm@gmail.com";
				$mail->Password = "[code]magos";
				$mail->SetFrom($from, $from_name);
				$mail->addReplyTo($from);
				$mail->Subject = $subject;
				$mail->IsHTML(true);
				$mail->Body = $body;
				$mail->AddAddress($to);
				if (!empty($cc)) {
						$mail->addCC($cc);
				}
				if (!empty($bcc)) {
						$mail->addBCC($bcc);
				}
				if (!$mail->Send()) {
						echo $error = 'Mail error: ' . $mail->ErrorInfo;
						return FALSE;
				} else {
						return TRUE;
				}
}



/*********************** Password Change Notification ********************/

public function notificationmail($mailsubject,$name,$notificationtype,$password,$email) {
			$body = ' <br> Hello <span style="text-transform:capitalize">'.$name.'</span>, <br><p>Your '.$notificationtype.' has sucessfully updated as below <br><br><b>'.$password.'</b> </p>';
			$notificationmailsend = $this->mailBody($mailsubject,$body,$email);
			if($notificationmailsend) {
				return TRUE;
			}else{
				return FALSE;
			}
}



/*********************** Login Notification ********************/

public function loginNotification($email,$ip) {
			$mailsubject = 'Account Login Alert';
			$body = '<br><br>Your account for the carrer project has been logged in from the ip address <br> <br> <b>'.$ip.'</b>';
			$notificationmailsend = $this->mailBody($mailsubject,$body,$email);
			if($notificationmailsend) {
				return TRUE;
			}else{
				return FALSE;
			}
}

/*********************** Interest Mail Notification ********************/

public function expressInterestMail($interesteduserid,$interestedusername,$interesteduseremail,$interesteduserphone,$postedusername,$posteduseremail,$propertyid,$propertytitle,$propertylocation) {
			$mailsubject = 'Interesed in your property posted in Realestate.com';
			$mailbody = '<br><br>Hello <span style="text-transform:capitalize">'.$postedusername.'</span>, <br><br> One of our client is interested in your property posted on the website realestate.com <br> <br> <ib>Property details :</ib> <br> <br> <b> Property Id  : '.$propertyid.' <br> <br> Property Title : '.$propertytitle.'<br> <br> <b> Property Location  : '.$propertylocation.' <br><br> <ib> Interested User details :</ib> <br> <br> <b> Inerested User Id  : '.$interesteduserid.' <br> <br> <b> Inerested Username  : '.$interestedusername.' <br> <br> Interested User Email : '.$interesteduseremail.'<br> <br> Interested User Phone : '.$interesteduserphone.'';

			require "./PHPMailer/PHPMailerAutoload.php";
			require "./PHPMailer/class.phpmailer.php";
			require "./PHPMailer/class.smtp.php";

			$from = $interesteduseremail;
			$from_name = $interestedusername;

			$subject = $mailsubject;
			$body = $mailbody;
			$to = $posteduseremail;
			$mail = new PHPMailer;  // create a new object
			$mail->IsSMTP(); // enable SMTP   //
			$mail->SMTPAuth = true;  // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 465;
			$mail->Username = "projectatcm@gmail.com";
			$mail->Password = "[code]magos";
			$mail->SetFrom($from, $from_name);
			$mail->addReplyTo($from);
			$mail->Subject = $subject;
			$mail->IsHTML(true);
			$mail->Body = $body;
			$mail->AddAddress($to);
			if (!empty($cc)) {
					$mail->addCC($cc);
			}
			if (!empty($bcc)) {
					$mail->addBCC($bcc);
			}
			if (!$mail->Send()) {
					echo $error = 'Mail error: ' . $mail->ErrorInfo;
					return FALSE;
			} else {
					return TRUE;
			}
}


/*------------------------------------------ seller to auctioner respond --------------------*/

public function respondToAuctioner($sendername,$senderaddress,$senderlocation,$senderemail,$senderphone,$auctionid,$auctionername,$auctioneremail,$bidamount){

	$mailsubject = 'Response to your bid on auction '.$auctionid;
	$mailbody = '<br><br>Hello <span style="text-transform:capitalize">'.$auctionername.'</span>, <br><br><ib>'.$sendername.'</ib> is intrested in the bid amount of <b>₹ '.$bidamount.'</b> that you are posted for the auction <ib>id '.$auctionid.'</ib> please repond to this mail or contact directly by the given below details <br> <br> <b>Address : </b><br><br>'.$senderaddress.'<br> <br><b>Location : </b><br><br> '.$senderlocation.'<br> <br> <b> Email  :</b> '.$senderemail.' <br><br>  <b> Phone  :</b> '.$senderphone.' ';

	require "./PHPMailer/PHPMailerAutoload.php";
	require "./PHPMailer/class.phpmailer.php";
	require "./PHPMailer/class.smtp.php";

	$from = $senderemail;
	$from_name = $sendername;

	$subject = $mailsubject;
	$body = $mailbody;
//	$to = $auctioneremail;
	$to = 'jeybincodemagos@gmail.com';
	$mail = new PHPMailer;  // create a new object
	$mail->IsSMTP(); // enable SMTP   //
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->Username = "projectatcm@gmail.com";
	$mail->Password = "[code]magos";
	$mail->SetFrom($from, $from_name);
	$mail->addReplyTo($from);
	$mail->Subject = $subject;
	$mail->IsHTML(true);
	$mail->Body = $body;
	$mail->AddAddress($to);
	if (!empty($cc)) {
			$mail->addCC($cc);
	}
	if (!empty($bcc)) {
			$mail->addBCC($bcc);
	}
	if (!$mail->Send()) {
			echo $error = 'Mail error: ' . $mail->ErrorInfo;
			return FALSE;
	} else {
			return TRUE;
	}
}







}

?>
