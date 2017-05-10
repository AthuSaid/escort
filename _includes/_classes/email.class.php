<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/_includes/_classes/PHPMailerAutoload.php";

class email {
	
	
	/**
	 * Send Customized Email to Person
	 * @param array $obj
	 */
    public function fSendEmailToPerson($obj){
            	    
	    	$mail = new phpmailer;
	    	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	    	$mail->isSMTP();                                      // Set mailer to use SMTP
	    	$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
	    	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	    	$mail->Username = 'danieltriboni@gmail.com';          // SMTP username
	    	$mail->Password = 'xxx';                 	  // SMTP password
	    	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	    	$mail->Port = 465;                                    // TCP port to connect to
	    	
	    	$mail->setFrom('from@example.com', SIS_TITULO);
	    	$mail->addAddress($obj['email'], $obj['name']);     	// Add a recipient
	    	//$mail->addAddress('ellen@example.com');               // Name is optional
	    	//$mail->addReplyTo('info@example.com', 'Information');
	    	//$mail->addCC('cc@example.com');
	    	//$mail->addBCC('bcc@example.com');
	    	
	    	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	    	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	    	$mail->isHTML(true);                                  	// Set email format to HTML
	    	
	    	$mail->Subject = $obj['subject'];
	    	$mail->Body    = $obj['message'];
	    	$mail->AltBody = strip_tags($obj['message']);
	    	
	    	if(!$mail->send())	    		
	    		return false;
	    	else
	    		return true;	    	
    }    
}
