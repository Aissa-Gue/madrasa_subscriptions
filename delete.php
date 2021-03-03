<?php
include 'check.php';
//initialize subscription
if (isset($_GET['del'])) {
    $sub_id = $_GET['del'];
    $name = $_GET['name'];

    $deleteQuery = "UPDATE subscriptions SET amount = 0, rest = deserved_amount , donation = 0, date = NULL, time = NULL, status = '$default_status' WHERE sub_id = '$sub_id'";

    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script> alert('تم حذف اشتراك الطالب $name بنجاح') </script>";
        echo "<script> window.location.href= 'home.php'</script>";
    } else {
        echo "<script> alert('حدثت مشكلة: لم يتم حذف الاشتراك!!') </script>";
        echo "<script> window.location.href= 'home.php'</script>";
    }
}
