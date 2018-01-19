<?php
require_once('email_config.php');
require('phpmailer/PHPMailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->SMTPDebug = 3;           // Enable verbose debug output. Change to 0 to disable debugging output.

$mail->isSMTP();                // Set mailer to use SMTP.
$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers.
$mail->SMTPAuth = true;         // Enable SMTP authentication


$mail->Username = EMAIL_USER;   // SMTP username
$mail->Password = EMAIL_PASS;   // SMTP password
$mail->SMTPSecure = 'tls';      // Enable TLS encryption, `ssl` also accepted, but TLS is a newer more-secure encryption
$mail->Port = 587;              // TCP port to connect to
$options = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->smtpConnect($options);
$mail->From = 'christin0708server@gmail.com';  // sender's email address (shows in "From" field)
$mail->FromName = 'Server - Christin';   // sender's name (shows in "From" field)
$mail->addAddress('yangxue0708@gmail.com', 'Christin Yang');  // Add a recipient
//$mail->addAddress('ellen@example.com');                        // Name is optional
$mail->addReplyTo($_POST['email']);                          // Add a reply-to address
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Message from Portfolio.';
$mail->Body    = $_POST['message'];  //'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = htmlentities($_POST['message']);  //'This is the body in plain text for non-HTML mail clients';
$output = [
    //'success' => true,

];

//if ($output['success'] !== null) {
//    http_response_code(400);
//    echo json_encode($output);
//    exit();
//}

////Sanitize name field
//$message['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
//if(empty($message['name'])){
//    $output['success'] = false;
//    $output['messages'][] = 'missing name key';
//}
////Validate email field
//$message['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
//if(empty($message['email'])){
//    $output['success'] = false;
//    $output['messages'][] = 'invalid email key';
//}
////Sanitize subject
//$message['subject'] = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
//if(empty($message['subject'])){
//    $output['success'] = false;
//    $output['subject'][] = 'missing message key';
//}
////Sanitize message
//$message['message'] = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
//if(empty($message['message'])){
//    $output['success'] = false;
//    $output['messages'][] = 'missing message key';
//}

//$message['message'] = nl2br($message['message']);


if(!$mail->send()) {
    $output['success'] = false;
    $output['message'] = $mail -> ErrorInfo;

    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}





print(json_encode($output));
?>
