<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
 
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $name = stripcslashes($_POST['name']);
    $email = stripcslashes($_POST['email']);
    $phone = stripcslashes($_POST['phone']);
    $project = stripcslashes($_POST['project']);

    $subject = 'Enquiry Form Submission'; // Define your email subject

    // $mail->SMTPDebug = 2;
    // $mail->SMTPAuth = true;
    // $mail->IsSMTP();
    $mail->Host = 'mail.lizyweb.com';
    $mail->Username = 'smt@lizyweb.com';
    $mail->Password = 'Lizyweb@123';
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    // $mail->Port = 587;

    $mail->setFrom('smt@lizyweb.com', 'Enquiry Form');
    $mail->addAddress('mohammadashif0045@gmail.com');
    $mail->Subject = $subject;

    // Create the HTML message
    $message = "Name: $name<br /><br />";
    $message .= "Email: $email<br /><br />";
    $message .= "Phone: $phone<br /><br />";
    $message .= "Project: $project";

    $mail->MsgHTML($message);

    // Send the email
    if ($mail->Send()) {
        echo "</fieldset>";
        echo "<div id='success_page'>";
        echo "<h1>Your Message Sent Successfully.</h1>";
        echo "<p>Thank you <strong>$name</strong>, your message has been submitted to us. We will contact you shortly.</p>";
        echo "</div>";
        echo "</fieldset>";

        echo '<a href="index.html">Return to Home</a>';
    } else {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Mailer Error: " . $e->getMessage();
}
?>