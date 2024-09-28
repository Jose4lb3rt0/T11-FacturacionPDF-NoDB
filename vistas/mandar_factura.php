<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';  
require '../clases/Factura.php';

$index = isset($_POST['index']) ? $_POST['index'] : 0;

session_start();
$factura = $_SESSION['facturas'][$index];
$cliente = $factura->getCliente();
$productos = $factura->getProductos();
$total = $factura->calcularTotal();

ob_start();
$pdfFile = include('../assets/fpdf/Factura.php'); 
ob_end_clean();

$timestamp = date('Ymd_His');
$pdfFile = "../mails/output_{$timestamp}.pdf";
$pdf->Output('F', $pdfFile);

$emailCliente = $cliente->getCorreo(); 

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'josealberto3200@gmail.com';              
    $mail->Password   = 'oefh gjce yuuh vfft';                       
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
