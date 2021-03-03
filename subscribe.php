<?php
include 'check.php';

if (isset($_POST['subscribe'])) {
    $studId = $_POST['studentId'];
    $amount = $_POST['amount'];

    /*** update subscriptions table ***/
    // Subscription update query
    // NB!: After the 1st subscription (if donation > 0) the next update will set donation = $amount 
    $subscribeQuery = "UPDATE subscriptions 
    SET
    donation = CASE
    WHEN rest = 0 THEN donation + $amount
    WHEN rest - $amount < 0 THEN - (rest - $amount)
    ELSE donation
    END,

    rest = CASE
    WHEN rest - $amount < 0 THEN 0 
    ELSE rest - $amount
    END,

    amount = CASE
    WHEN amount + $amount > deserved_amount THEN deserved_amount
    ELSE amount + $amount
    END,
    
    date = CURRENT_DATE(),
    time = CURRENT_TIME(),

    status = CASE
    WHEN rest = 0 AND amount >= deserved_amount THEN '$subscribed_status'
    WHEN amount > 0 AND amount < deserved_amount THEN '$not_completed_status'
    ELSE status
    END        

    WHERE subscriptions.stud_id = $studId";

    $result = mysqli_query($conn, $subscribeQuery);
    // redirect to home page
    if ($result != 0) {
        header("refresh:0; url=home.php");
    } else {
        echo '<br><br>
    <h3 align= "center" style="color:white; background:red;padding:15px"> حدثت مشكلة ! لم يتم إضافة الاشتراك </h3>';
        echo mysqli_error($conn);
        header("refresh:2; url=home.php");
    }
}
