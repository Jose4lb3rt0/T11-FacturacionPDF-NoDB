<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';  
require '../clases/Factura.php';
require '../assets/fpdf/generar_factura.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
$index = isset($_POST['index']) ? $_POST['index'] : 0;

$factura = $_SESSION['facturas'][$index];
$cliente = $factura->getCliente();
$productos = $factura->getProductos();
$total = $factura->calcularTotal();

$timestamp = date('Ymd_His');
$pdfFile = "../mails/output_{$timestamp}.pdf";
generarFacturaPDF($factura, $pdfFile);

$emailCliente = $cliente->getCorreo(); 

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'josealberto3200@gmail.com';              
    $mail->Password   = $_ENV['SMTP_KEY'];          
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                   

    $mail->setFrom('josealberto3200@gmail.com', 'Tienda Salcedo'); 
    $mail->addAddress($emailCliente); 

    $pdfFile = "../mails/output_{$timestamp}.pdf";
    if (file_exists($pdfFile)) {
        $mail->addAttachment($pdfFile); 
    }

    $mail->isHTML(true);                                  
    $mail->Subject = 'Factura de tu compra';
    $mail->Body    = 'Adjunto te enviamos la factura de tu compra en formato PDF.<br>Gracias por tu compra.';

    $mail->send();
    echo 'Correo enviado exitosamente';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
