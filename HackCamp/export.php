<?php
require_once 'Models/UserDataSet.php';
session_start();
$view = new stdClass();
$view->pageTitle = 'Export';
$userDataSet = new UserDataSet();

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


if(isset($_POST['export'])){

    $helper = new Sample();
    if ($helper->isCli()) {
        $helper->log('This example should only be run from a Web Browser' . PHP_EOL);

        return;
    }

// Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();

// Set document properties
    $spreadsheet->getProperties()->setCreator('Mohammad Patel')
        ->setLastModifiedBy('Mohammad Patel')
        ->setTitle('Report')
        ->setSubject('Office 2007 XLSX Report Document')
        ->setDescription('Report document for Office 2007 XLSX, generated using PHP classes.')
        ->setKeywords('office 2007 openxml php')
        ->setCategory('Test result file');


    $employeeDetailsArray = $userDataSet->getEmployeeDetails($_POST['employee_ID']);
    array_unshift($employeeDetailsArray[0], "Employee:");

    $employeeDetails = implode( " ", $employeeDetailsArray[0]);

    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', $employeeDetails)
        ->mergeCells('A1:E1')
        ->setTitle('EmployeeReport');

//set first row to grey
    $spreadsheet->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00666666');

    //set first row font and alignment
    $spreadsheet->getActiveSheet()->getStyle('A1:E1')->applyFromArray(
        array(
            'font'  => array(
                'bold'  => false,
                'color' => array('rgb' => 'ffffff'),
                'size'  => 13,
                'name'  => 'Verdana'
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'textRotation' => 0,
                'wrapText' => TRUE
            )
        )
    );
//set second row to orange
    $spreadsheet->getActiveSheet()->getStyle('A2:E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00f5820c');

    $spreadsheet->getActiveSheet()->getStyle('A2:E2')->applyFromArray(
        array(
            'font'  => array(
                'bold'  => false,
                'color' => array('rgb' => 'ffffff'),
                'size'  => 12,
                'name'  => 'Verdana'
            )
        )
    );
    // Add some data
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A2', 'Project Name')
        ->setCellValue('B2', 'Date')
        ->setCellValue('C2', 'Start Time')
        ->setCellValue('D2', 'End Time')
        ->setCellValue('E2', 'Hours Worked');



    //get report data from database
    $rows = $userDataSet->getTimeReport($_POST['employee_ID']);

    //store data into excel
    $spreadsheet->getActiveSheet()
            ->fromArray($rows, '', 'A3');



    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xls)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Report.xls"');
    header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0


    $writer = IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->setIncludeCharts(true);
    $callStartTime = microtime(true);
    $writer->save('php://output');
    exit;
}

if (isset($_SESSION['login'])){
    $view->email = $_SESSION['login']->getEmail();
}

//if(isset($_POST["export"])){
//
//    header('Content-Type: text/csv');
//    header('Content-Disposition: attachment; filename=report.csv');
//    $output = fopen("php://output", "w+");
//    $rows = $userDataSet->getEmployeeDetails($_POST['employee_ID']);
//
//
//    foreach ($rows as $row){
//        $arraySize = count($row)/2;
//        $newRow = array();
//        $employeeDetails = '';
//        $employeeTemplate=array('ID: ', ' ', '');
//        for($i=0; $i<$arraySize; $i++)
//        {
//            $employeeDetails .=  $employeeTemplate[$i] . $row[$i] . ' ' ;
////            array_push($newRow, $row[$i]);
//        }
//        $newRow = array($employeeDetails);
////        fputcsv($output, $newRow);
//        fputcsv($output, $newRow);
//    }
//
//    fputcsv($output, array('Project Name','Date', 'Start Time', 'End Time', 'Hours Worked'));
//    $rows = $userDataSet->getTimeReport($_POST['employee_ID']);
//
//    foreach ($rows as $row){
//        fputcsv($output, $row);
//    }
////    foreach ($rows as $row){
////        $arraySize = count($row)/2;
////        $newRow = array();
////        for($i=0; $i<$arraySize; $i++)
////        {
////
////            array_push($newRow, $row[$i]);
////        }
////        fputcsv($output, $newRow);
////    }
//
//    fclose($output);
//    exit();
//}

require_once('Views/export.phtml');
