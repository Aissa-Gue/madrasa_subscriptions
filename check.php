<?php
include 'config.php';

session_start();

if (isset($_POST['login'])) {
    $admin = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * from admins where username= '$admin' and password= '$password'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) == 1) {
        //if admin
        $_SESSION['admin'] = $admin;
        header('location: home.php');
    } else {
        //if not admin
        echo "<script> alert('اسم المستخدم أو كلمة المرور غير صحيحة') </script>";
        echo "<script> window.location.href= 'login.php'</script>";
    }
}
/*** redirect to login page if session == null ***/
if ($_SESSION['admin'] == null) {
    echo "<script> window.location.href= 'login.php'</script>";
}

/*** redirect to login If admin inactive for more than 15 min ***/
// 15 min in seconds
$inactive = 900;
// set the session max lifetime to 15 min
ini_set('session.gc_maxlifetime', $inactive);

session_start();

if (isset($_SESSION['time']) && (time() - $_SESSION['time'] > $inactive)) {
    // last request was more than 15 min ago
    session_unset();     // unset $_SESSION variable for this page
    session_destroy();   // destroy session data
    header('location: login.php');
}
$_SESSION['time'] = time(); // Update session