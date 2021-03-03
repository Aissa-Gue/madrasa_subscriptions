<?php
include 'check.php';

$uploadfile = $_FILES['uploadfileComp']['tmp_name'];

require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';

$objExcel = PHPExcel_IOFactory::load($uploadfile);
foreach ($objExcel->getWorksheetIterator() as $worksheet) {
    $highestrow = $worksheet->getHighestRow();

    for ($row = 1; $row <= $highestrow; $row++) {
        //students table data
        $stud_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
        $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
        $school = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $level = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        $class = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
        $year = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
        // subscriptions table data
        $date_data = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
        $time_data = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
        $amount_data = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
        $rest_data = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
        $donation_data = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
        $deserved_amount_data = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
        $status_data = $worksheet->getCellByColumnAndRow(12, $row)->getValue();

        if ($stud_id != '') {
            //students table
            $insertqry = "INSERT INTO `students` VALUES ('$stud_id','$name','$school','$level','$class','$year')";
            $insertres = mysqli_query($conn, $insertqry);

            //subscriptions table
            $insert2qry = "INSERT INTO subscriptions (stud_id, date, time, amount, rest, donation, deserved_amount, status)
            SELECT stud_id, '$date_data', '$time_data', $amount_data, $rest_data, $donation_data, $deserved_amount_data, '$status_data' FROM students WHERE stud_id NOT IN (SELECT stud_id FROM subscriptions)";
            $insert2res = mysqli_query($conn, $insert2qry);
            //set date and time = NULL when student not subscribed
            $resetDateTimeQuery = "UPDATE subscriptions SET date = NULL, time = NULL WHERE rest = deserved_amount";
            $resetDateTimeRes = mysqli_query($conn, $resetDateTimeQuery);
        }
    }
}
//INSERT INTO subscriptions (stud_id, date, time, amount, rest, donation, deserved_amount, status) SELECT stud_id, '2020-12-20', '18:00:25', '5000', '2000', '0', '7000', 'no' FROM students WHERE stud_id NOT IN (SELECT stud_id FROM subscriptions)

header('Location: upload_form.php');
