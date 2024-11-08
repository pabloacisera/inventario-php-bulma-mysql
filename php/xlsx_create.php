<?php
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Recibir los nombres de las columnas desde el frontend (AJAX)
$data = json_decode(file_get_contents('php://input'), true);

// Validar si se enviaron nombres de columnas
if (!isset($data['columnNames']) || empty($data['columnNames'])) {
    http_response_code(400);  // Código de error si no se envían datos
    echo "No se enviaron nombres de columnas.";
    exit;
}

// Obtener los nombres de las columnas
$columnNames = $data['columnNames'];

// Crear un nuevo archivo Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Escribir los valores como encabezados en la primera fila (en columnas sucesivas)
$colIndex = 0;
foreach ($columnNames as $columnName) {
    $columnLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1);
    $sheet->setCellValue("{$columnLetter}1", $columnName);
    $colIndex++;
}

// Configurar los encabezados HTTP para la descarga del archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="nombres_columnas.xlsx"');
header('Cache-Control: max-age=0');
header('Pragma: public');
header('Expires: 0');

// Enviar el archivo para su descarga
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
