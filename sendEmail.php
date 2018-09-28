<?php 

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require 'PHPMailerAutoload.php';

$conn = require('connection.php');

$id = $_GET['id'] ?? null;

$stmt = $conn->prepare('SELECT * FROM employee WHERE id=?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$mail = new PHPMailer(true); // Passing `true` enables exceptions

try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                     // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'barbosaeliezer783@gmail.com';                 // SMTP username
    $mail->Password = 'sistematarefa';                           // SMTP password
    $mail->SMTPSecure = "tls";                            // Enable TLS encryption, `ssl` also accepted
    $mail->SMTP_Port = 587;                                    // TCP port to connect to
    $mail->SetLanguage("br","libs/");
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>true
        )
    );
            
    //Recipients
    $mail->setFrom('barbosaeliezer783@gmail.com', 'Eliezer-PHP-Test');
    $mail->addAddress($user['email'], $user['name']);     // Add a recipient
  //  $mail->addAddress('ellen@example.com');               // Name is optional
  //  $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Message to '.$user['name'];
    $mail->Body    = '<strong>'.$user['name'].'</strong>'." ".
                       '<h3>This is your tips from last week:</h3><br>
                       <h4> EUR '.$user['tips_due'].'<br>'.
                       'Expenses: EUR '.$user['expenses'].'</h4>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<h3>Message has been sent to </h3>'.$user['name'];
} catch (Exception $e) {
    echo '<h3>Message could not be sent to </h3>'.$user['name'].' Mailer Error: ', $mail->ErrorInfo;
}

?>