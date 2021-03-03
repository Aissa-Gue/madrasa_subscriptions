<?php
// variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "subscriptions_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo 'Failed to connect to database' . mysqli_connect_error();
}

//arabic lang chars
mysqli_set_charset($conn, 'utf8');

// current date
$date = date("Y-m-d");

//Deserved amount
$deserved_amount = 7000;
// status
$default_status = "غير مشترك";
$subscribed_status = "مشترك";
$not_completed_status = "غير مكتمل";
// schools
$school1 = "بابا السعد";
$school2 = "الرحبة";
$school3 = "باعيسى اوعلوان";
$school4 = "واد نشو";
$school5 = "قسم القرآن";
//years
$year1 = "2019/2020";
$year2 = "2020/2021";
