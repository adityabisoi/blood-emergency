<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

//Database Connection
$servername="localhost";
$username="root";
$password="";
$dbname="blood_emergency";

$conn=new mysqli($servername,$username,$password,$dbname);

if($conn-> connect_error)
{
    die("Connection failed".$conn-> connect_error);
}
else{
    $sql="SELECT email FROM login";
    $result=$conn->query($sql);
    if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc()){
            $email=$row['email'];
            sendMail($email);
            }
        }

}

// Instantiation and passing `true` enables exceptions


//try
function sendMail($email) {
    $mail = new PHPMailer(true);
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'adityabisoi1999@gmail.com';                     // SMTP username
    $mail->Password   = 'Aditya@123';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('no_reply@gmail.com');
    //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($email);               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
}
//  catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }
