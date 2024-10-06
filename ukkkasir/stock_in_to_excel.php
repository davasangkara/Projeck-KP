<?php
ob_start();
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');

session_start();
if (empty($_SESSION['admin'])) {
    echo '<script>window.location="login.php";</script>';
    exit;
}

require 'config.php';
include $view;
$lihat = new view($config);
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headers = ['No', 'Nama Barang', 'Qty', 'Price', 'Date'];
foreach (range('A', 'E') as $index => $column) {
    $sheet->setCellValue($column . '1', $headers[$index]);
}

$headerStyle = [
    'font' => [
        'bold' => true,
        'size' => 14,
        'color' => ['rgb' => 'FFFFFF'],
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '4472C4'],
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
];
$sheet->getStyle('A1:E1')->applyFromArray($headerStyle);
$sheet->getRowDimension(1)->setRowHeight(30);

foreach (range('A', 'E') as $column) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
}

$hasil = $lihat->getAllTransactionStockIn();

if (empty($hasil)) {
    error_log('No data retrieved from getAllTransactionStockIn()');
    exit('No data available');
}

$row = 2;
foreach ($hasil as $index => $isi) {
    $sheet->setCellValue('A' . $row, $index + 1);
    $sheet->setCellValue('B' . $row, $isi['nama_barang']);
    $sheet->setCellValue('C' . $row, $isi['qty']);
    $sheet->setCellValue('D' . $row, $isi['price']);
    $sheet->setCellValue('E' . $row, $isi['transaction_date']);
    $row++;
}

$dataRange = 'A1:E' . ($row - 1);
$borderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$sheet->getStyle($dataRange)->applyFromArray($borderStyle);

$writer = new Xlsx($spreadsheet);
$filename = 'Barang_Masuk_Report.xlsx';

$tempFile = tempnam(sys_get_temp_dir(), 'excel');
$writer->save($tempFile);

if (!file_exists($tempFile) || filesize($tempFile) == 0) {
    error_log("Failed to create Excel file or file is empty");
    exit("Failed to generate report");
}

ob_end_clean();

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Content-Length: ' . filesize($tempFile));
readfile($tempFile);

unlink($tempFile);

exit;
