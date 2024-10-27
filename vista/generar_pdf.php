<?php
require('../asset/fpdf.php'); // Asegúrate de que FPDF está disponible 
// Incluir la clase de conexión
include_once '../modelo/conexion.php';

// Crear una instancia de la conexión
$db = (new Conexion())->getConection();

// Obtener la cédula desde la solicitud
$cedula = isset($_GET['cedula']) ? $_GET['cedula'] : ''; // Cambia a $_POST si es necesario

// Preparar y ejecutar la consulta
$query = "SELECT * FROM contacto WHERE cedula = ?";
$stmt = $db->prepare($query);
$stmt->bindParam(1, $cedula, PDO::PARAM_STR);
$stmt->execute();

// Crear el PDF
$pdf = new FPDF('P', 'mm', array(80, 200)); // Formato para impresora térmica
$pdf->AddPage();

// Agregar la imagen de la empresa
//$pdf->Image('ruta/a/tu/logo.png', 10, 10, 60); // Ajusta la ruta y el tamaño

// Espacio
$pdf->Ln(20);

// Título del documento
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Reporte de Contacto', 0, 1, 'C');

// Espacio
$pdf->Ln(10);

// Comprobar si se encontraron resultados
if ($stmt->rowCount() > 0) {
    // Obtener el contacto
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Encabezados de información
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(30, 8, 'Cedula:', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, $row['cedula'], 0, 1);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(30, 10, 'Nombre:', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, $row['nombre'], 0, 1);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(30, 10, 'Apellido:', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, $row['apellido'], 0, 1);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(30, 10, 'Direccion:', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, $row['direccion'], 0, 1);
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(30, 10, 'Celular:', 0);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 10, $row['celular'], 0, 1);
    
} else {
    // Mensaje si no se encontró el contacto
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'No se encontraron datos para la cedula proporcionada.', 0, 1, 'C');
}

// Espacio
$pdf->Ln(10);

// Pie de página
$pdf->SetY(-30);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 3, 'Desarrollado por Ing. Gustavo Andres Cardenas', 0, 1, 'C');

// Salida del PDF
$pdf->Output('I', 'reporte_contacto.pdf');
?>