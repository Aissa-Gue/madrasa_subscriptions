<?php
include 'check.php';

$uploadfile = $_FILES['uploadfile']['tmp_name'];

require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$objExcel = PHPExcel_IOFactory::load($uploadfile);
foreach ($objExcel->getWorksheetIterator() as $worksheet) {
    $highestrow = $worksheet->getHighestRow();

    for ($row = 1; $row <= $highestrow; $row++) {
        $stud_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
        $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
        $school = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $level = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        $class = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
        $year = $worksheet->getCellByColumnAndRow(5, $row)->getValue();


        if ($stud_id != '') {
            //students table
            $insertqry = "INSERT INTO `students` VALUES ('$stud_id','$name','$school','$level','$class','$year')";
            $insertres = mysqli_query($conn, $insertqry);
        }
    }
    //subscriptions table
    $insert2qry = "INSERT INTO subscriptions (stud_id, rest, deserved_amount, status)
    SELECT stud_id, $deserved_amount, $deserved_amount, '$default_status' FROM students WHERE stud_id NOT IN (SELECT stud_id FROM subscriptions)";
    $insert2res = mysqli_query($conn, $insert2qry);
}


header('Location: upload_form.php');
