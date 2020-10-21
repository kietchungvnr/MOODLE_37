<?php

require (__DIR__  . '/../../../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;

//Xuất file ra những record bị lỗi
$file_header = file_get_contents('org_rowerror_header.json');
$file_data = file_get_contents('org_rowerror_data.json');
$rowserror = json_decode($file_data,true);
$filecolumns = json_decode($file_header,true);
$filename = 'orgerror.csv';
// header('Content-Type: .csv');
// header('Content-Disposition: attachment; filename=' . $filename );
header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\"");
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$spreadsheet->getDefaultStyle()
    ->getFont()
    ->setName('Arial')
    ->setSize(12);
$alphas = range('A', 'Z');


foreach ($filecolumns as $key => $value) {
    $spreadsheet->getActiveSheet()->setCellValue($alphas[$key].'1',$value);
}
$row = 2;
foreach ($rowserror as $key => $value) {
    $value = array_values($value);
    for($i=0;$i<count($value);$i++) {
        $spreadsheet->getActiveSheet()->setCellValue($alphas[$i].$row,strip_tags($value[$i]));
    }
    $row++;   
}

$writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
$writer->setUseBOM(true);
$writer->save('php://output');
die;