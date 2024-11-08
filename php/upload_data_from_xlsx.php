<?php
header('Content-Type: application/json');
require __DIR__ . '/../vendor/autoload.php';
require "../php/main.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar conexión a la base de datos
$connection = conn();
if (!$connection) {
    echo json_encode(['status' => 'error', 'message' => 'No se pudo establecer conexión a la base de datos.']);
    exit;
}

// Verificar si el archivo se subió correctamente
if (!isset($_FILES['archivo_excel']) || $_FILES['archivo_excel']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['status' => 'error', 'message' => 'No se recibió archivo o hubo un error al subirlo.']);
    exit;
}

$tmpFilePath = $_FILES['archivo_excel']['tmp_name'];
$fileName = $_FILES['archivo_excel']['name'];  // Obtener el nombre del archivo subido
$tableName = ''; // Variable para almacenar el nombre de la tabla

// Determinar la tabla según el nombre del archivo usando un SWITCH
switch (true) {
    case (strpos(strtolower($fileName), 'proveedores') !== false):
        $tableName = 'proveedores';
        break;
    case (strpos(strtolower($fileName), 'productos') !== false):
        $tableName = 'productos';
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'El nombre del archivo no corresponde a una tabla válida.']);
        exit;
}

try {
    $document = IOFactory::load($tmpFilePath);
    $allSheets = $document->getSheetCount();
    $data = [];

    // Recorrer todas las hojas
    for ($iSheet = 0; $iSheet < $allSheets; $iSheet++) {
        $sheet = $document->getSheet($iSheet);
        $number_rows = $sheet->getHighestDataRow();
        $highestColumnIndex = Coordinate::columnIndexFromString($sheet->getHighestColumn());
        $sheetData = [];
        
        // Recorrer la primera fila para obtener los nombres de las columnas dinámicamente
        $columnNames = [];
        for ($col = 1; $col <= $highestColumnIndex; $col++) {
            $columnLetter = Coordinate::stringFromColumnIndex($col);
            $cellCoordinate = $columnLetter . 1;  // Tomamos los nombres de las columnas desde la primera fila
            $columnNames[$col] = $sheet->getCell($cellCoordinate)->getValue();
        }

        // Recorrer las filas de la hoja
        for ($row = 2; $row <= $number_rows; $row++) {  // Comenzamos desde la segunda fila para evitar los encabezados
            $rowData = [];
            $insertData = [];

            // Obtener los valores de cada columna para la fila actual
            for ($col = 1; $col <= $highestColumnIndex; $col++) {
                $columnLetter = Coordinate::stringFromColumnIndex($col);
                $cellCoordinate = $columnLetter . $row;
                $value = $sheet->getCell($cellCoordinate)->getValue();
                $rowData[$columnNames[$col]] = $value;  // Usar el nombre de la columna en vez de la letra

                // Preparar los datos para la consulta de inserción
                $insertData[$columnNames[$col]] = $value;
            }

            $sheetData[] = $rowData;

            // Generar la consulta SQL dinámica para la tabla correspondiente
            $columns = implode(', ', array_keys($insertData));
            $placeholders = ':' . implode(', :', array_keys($insertData));
            $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
            
            // Preparar la consulta SQL
            $stmt = $connection->prepare($sql);

            // Asignar los valores de la fila a los parámetros de la consulta
            foreach ($insertData as $key => $value) {
                $stmt->bindParam(':' . $key, $insertData[$key]);
            }

            // Ejecutar la consulta
            $stmt->execute();
        }

        $data["Hoja_$iSheet"] = $sheetData;
    }

    // Enviar respuesta JSON con los datos obtenidos y confirmación de inserción
    echo json_encode(['status' => 'success', 'message' => 'Archivo procesado correctamente y datos insertados.', 'data' => $data]);

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error al procesar el archivo: ' . $e->getMessage()]);
}
