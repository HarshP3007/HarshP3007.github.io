<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../phpmailer/src/Exception.php';
require __DIR__ . '/../phpmailer/src/PHPMailer.php';
require __DIR__ . '/../phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'harshpandey7754@gmail.com';   // <-- Apna Gmail
        $mail->Password   = 'ruxb dqbc szwu vpxs';         // <-- Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // 🔹 Debug Mode ON
        $mail->SMTPDebug = 0; 
        $mail->Debugoutput = 'html';

        // Sender & Receiver
        $mail->setFrom('harshpandey7754@gmail.com', 'Website Contact Form');
        $mail->addReplyTo($email, $name); 
        $mail->addAddress('harshpandey7754@gmail.com'); // jaha mail receive karna hai

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
            <h3>New Contact Form Submission</h3>
            <p><b>Name:</b> $name</p>
            <p><b>Email:</b> $email</p>
            <p><b>Message:</b><br>$message</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message";

        $mail->send();
        echo "✅ Your message has been sent. Thank you!";

    } catch (Exception $e) {
        echo " Message could not be sent.: {$mail->ErrorInfo}";
    }
} else {
    echo " Invalid request!";
}
