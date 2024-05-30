<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

// Replace with the actual details
$email = 'a17100279@gmail.com';

// Content for the email body
$emailContent = '<h1>Bienvenido a Nuestro Sitio Web</h1><p>Gracias por su compra.</p>';

// Use PHPMailer to send the email
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'a22110098@ceti.mx'; // Replace with your Gmail email address
    $mail->Password = 'resident evil 12357'; // Replace with your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('oscarmaciasprof@gmail.com', 'Comercio Global'); // Replace with your Gmail email address and your name
    $mail->addAddress($email); // Use the actual field names

    $mail->isHTML(true);
    $mail->Subject = 'Welcome to Our Website';
    $mail->Body = $emailContent;
    $mail->addAttachment($fileToAttach);

    $mail->send();
    echo "Email sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
