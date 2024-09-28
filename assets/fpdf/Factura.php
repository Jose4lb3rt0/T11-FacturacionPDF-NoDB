<?php

require_once '../../clases/cliente.php';
require_once '../../clases/producto.php';
require_once '../../clases/factura.php';
require_once '../fpdf/fpdf.php';
session_start();

    /*echo "<pre>";
    print_r($_SESSION);  
    echo "</pre>";*/

if (!isset($_SESSION['facturas'])){
    die('No hay facturas para imprimir');
}

$index = isset($_GET['index']) ? $_GET['index'] : 0;

    // echo "Index recibido: " . $index . "<br>";

if ($index == null || !isset($_SESSION['facturas'][$index])){
    die('Factura no encontrada');
}

    /*echo "<pre>";
    print_r($_SESSION['facturas'][$index]);
    echo "</pre>";*/

$factura = $_SESSION['facturas'][$index];
$cliente = $factura->getCliente();
$productos = $factura->getProductos();
$total = $factura->calcularTotal();

$pdf = new FPDF();
$pdf->AddPage('P', [150, 297]); 

$pdf->AddFont('Receiptional_Receipt', '', 'Receiptional_Receipt.php');

$pdf->SetFont('Receiptional_Receipt', '', 20);
$pdf->Cell(135, 10, 'Factura', 0, 1, 'C');
$pdf->SetFont('Receiptional_Receipt', '', 10);
$pdf->Cell(135, 10, '____________________', 0, 1, 'C');
$pdf->Cell(135, 10, '** TIENDA SALCEDO **', 0, 1, 'C');
$pdf->Ln(10);

$pdf->Image(__DIR__ . '/imagen.png', 10, 5, 20);

$pdf->SetFont('Receiptional_Receipt', '', 12);
$pdf->Cell(190, 10, utf8_decode('Cliente: ' .  $cliente->getNombre() . " " . $cliente->getApellido()), 0, 1, 'L');
$pdf->Cell(190, 10, utf8_decode('DNI: ' .  $cliente->getDni()), 0, 1, 'L');
$pdf->Cell(190, 10, utf8_decode('Teléfono: ' . $cliente->getTelefono()), 0, 1, 'L');
$pdf->Ln(10);

$pdf->SetFillColor(151, 151, 151); 
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(67, 67, 67); 
$pdf->Cell(33, 10, 'Producto', 1, 0, 'C', true);
$pdf->Cell(33, 10, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(33, 10, 'Precio', 1, 0, 'C', true);
$pdf->Cell(32, 10, 'Total', 1, 0, 'C', true);
$pdf->Ln();

$pdf->SetTextColor(0, 0, 0);
foreach ($productos as $item){
    $producto = $item['producto'];
    $cantidad = $item['cantidad'];
    $precio = $producto->getPrecio();
    $subtotal = $cantidad * $precio;

    $pdf->SetFont('Receiptional_Receipt', '', 9);
    $pdf->Cell(33, 10, $producto->getNombre(), 1, 0, 'C');
    $pdf->Cell(33, 10, $cantidad, 1, 0, 'C');
    $pdf->Cell(33, 10, 'S/ ' . number_format($precio, 2), 1, 0, 'C');
    $pdf->Cell(32, 10, 'S/ ' . number_format($subtotal, 2), 1, 1, 'C');
}


$pdf->Ln();
$pdf->SetFont('Receiptional_Receipt', '', 12);
$pdf->Cell(130, 10, 'Total: S/' . number_format($total, 2), 0, 1, 'R');
$pdf->Ln(20);
$pdf->Cell(100, 10, '______________________', 0, 1, 'R');
$pdf->Cell(100, 10, 'Gracias por tu compra!', 0, 1, 'R');


$pdf->Output();


