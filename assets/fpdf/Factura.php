<?php

require_once __DIR__ . '../../../clases/cliente.php';
require_once __DIR__ . '../../../clases/producto.php';
require_once __DIR__ . '../../../clases/factura.php';
require_once __DIR__ . '../../fpdf/fpdf.php';
require_once __DIR__ . '../../fpdf/generar_factura.php';

if (!isset($_SESSION['facturas'])){
    die('No hay facturas para imprimir');
}

$index = isset($_GET['index']) ? $_GET['index'] : 0;  


if ($index == null || !isset($_SESSION['facturas'][$index])){
    die('Factura no encontrada');
}

$factura = $_SESSION['facturas'][$index];
generarFacturaPDF($factura);
