<?php
/*
	Version: 0.0.1
	Author: Benjamin Burkett
	File:  contact.php
	Createad: 05/08/15
	Contributors:
	Last Updated: 05/08/15
*/

    require '../PHPMailer-master/PHPMailerAutoload.php';
	extract( $_POST );

    $mail = new PHPMailer();

    $mail->isSMTP();
    //$mail->SMTPDebug = 2;
    //$mail->Debugoutput = 'html';
    $mail->Host = 'localhost';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@rhoadsproperties.com';            // SMTP username
    $mail->Password = 'Madison26';                           // SMTP password

    $mail->From = 'info@rhoadsproperties.com';
    $mail->FromName = 'Mailer';
    $mail->addAddress('michael.rhoads@rhoadsproperties.com', '');     // Add a recipient
    $mail->isHTML(true);

    $mail->Subject = 'Subject: Contact Us Message';
    $mail->Body    = "<p>Name: $firstname</p><p>Email: $email</p><p>Question: $question</p>";
    $mail->AltBody = <<<QWE
Name: $firstname
Email: $email
Question: $question
QWE;
;

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
}
/*
	---------------------------------
	Change log
	0.0.1 -- 05/01/2015 -- BAB -- Created file
	---------------------------------
*/
?>
