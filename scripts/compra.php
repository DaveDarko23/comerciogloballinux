<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include("querys.php");
    include("pdfGenerator.php");
    // include("prueba.php");
    $_POST = json_decode(file_get_contents('php://input'), true);
    $PK_Usuario = $_POST["PK_Usuario"];
    $precioTotal = $_POST["precioTotal"];
    $array = $_POST["array"];
    $array2 = $array["array"];

    $random = rand(0, 99999999999);
    $url = "http://10.0.0.3/pdf/mail-" . $random . ".pdf";

    foreach ($array2 as $user) {
        list($id, $name, $Cantidad, $precio) = $user;
        if (Database::updateStock($id, $Cantidad) === 200) {
            if (Database::insertPDF($PK_Usuario, $url) === 200) {
                Database::cleanCarrito($PK_Usuario);
                echo 200;
            }
        }
    }

    $estado = Database::getState($PK_Usuario);
    $domicilio = Database::getDomicilio($PK_Usuario);

    generateContentPdf($array2, $precioTotal, $estado, $domicilio, $random);

    $email = Database::getEmail($PK_Usuario);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

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
    $mail->addAttachment('../pdf/mail-' . $random . '.pdf');

    $mail->send();
    echo "Email sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
