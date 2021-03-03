<?php
include 'header.php';
// input values
$status = $_POST['status_input']; // subscribed, not subscribed, not completed
$donation = $_POST['donation_input'];
$school = $_POST['school_input'];
$level = $_POST['level_input'];
$class = $_POST['class_input'];
$year = $_POST['year_input'];
$order =  $_POST['order_by_name'];
/*** inject Sub queries ***/

//status
$statusSql = "AND status like '%$status%'";
//donation
$donationSql = "AND donation $donation";
// school
$schoolSql = "AND school like '%$school%'";
// level
$levelSql = "AND level like '%$level%'";
// class
$classSql = "AND class like '%$class%'";
// year
$yearSql = "AND year like '%$year%'";

// Full Query
$reportQuery = "SELECT * FROM students, subscriptions WHERE students.stud_id = subscriptions.stud_id $statusSql $donationSql $schoolSql $levelSql $classSql $yearSql ORDER BY 'year' ASC, 'school' ASC $order";


if ($reportResult = mysqli_query($conn, $reportQuery)) {
    //echo 'success';
    $reportRows = mysqli_num_rows($reportResult);
} else {
    echo 'ERROR: ' . mysqli_error($conn);
}


/*** Statistique Queries ***/
// amount SUM() & Rest SUM()
$statSumQuery = "SELECT SUM(subscriptions.amount) as amount_sum, SUM(subscriptions.rest) as rest_sum, SUM(subscriptions.donation) as donation_sum FROM students, subscriptions WHERE students.stud_id = subscriptions.stud_id $statusSql $donationSql $schoolSql $levelSql $classSql $yearSql";

//yes status COUNT()
$statYesQuery = "SELECT count(status) as yes_stat FROM students, subscriptions WHERE students.stud_id = subscriptions.stud_id $statusSql $donationSql $schoolSql $levelSql $classSql $yearSql AND status = '$subscribed_status' GROUP by status";

//Not-yet status COUNT()
$statNotYetQuery = "SELECT count(status) as notYet_stat FROM students, subscriptions WHERE students.stud_id = subscriptions.stud_id $statusSql $donationSql $schoolSql $levelSql $classSql $yearSql AND status = '$not_completed_status' GROUP by status";

//No status COUNT()
$statNoQuery = "SELECT count(status) as no_stat FROM students, subscriptions WHERE students.stud_id = subscriptions.stud_id $statusSql $donationSql $schoolSql $levelSql $classSql $yearSql AND status = '$default_status' GROUP by status";
/////// APPLY QUERIES //////
$statSumResult = mysqli_query($conn, $statSumQuery);
$statYesResult = mysqli_query($conn, $statYesQuery);
$statNotYetResult = mysqli_query($conn, $statNotYetQuery);
$statNoResult = mysqli_query($conn, $statNoQuery);
// echo 0 if there is no result
if (mysqli_num_rows($statYesResult) == 0) $yesZero = 0;
if (mysqli_num_rows($statNotYetResult) == 0) $notYetZero = 0;
if (mysqli_num_rows($statNoResult) == 0) $noZero = 0;
/*** END stat queries ***/

//* amount and rest sum
$row = mysqli_fetch_array($statSumResult);
//var
$Num_rows = $reportRows;
$required_amount_sum = $reportRows * $deserved_amount . ".00";
$amount_sum = $row['amount_sum'] . ".00";
$rest_sum = $row['rest_sum'] . ".00";
$donation_sum = $row['donation_sum'] . ".00";
//* status count
$yesRow = mysqli_fetch_array($statYesResult);
$notYetRow = mysqli_fetch_array($statNotYetResult);
$noRow = mysqli_fetch_array($statNoResult);
//var
$yes_count = $yesRow['yes_stat'] . $yesZero;
$notYet_count = $notYetRow['notYet_stat'] . $notYetZero;
$no_count = $noRow['no_stat'] . $noZero;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>

<body>
    <div class="container-fluid">
        <ul class="list-group list-group-flush">
            <!-- Second row -->
            <!-- select1 -->
            <form action="report.php" method="post" enctype="multipart/form-data">
                <div class="row mb-3 container-fluid">
                    <div class="col-sm">
                        <label for="status" class="form-label">الحالة</label>
                        <select class="form-select" id="status" aria-label="Default select" name="status_input">
                            <option value="" selected>اختر حالة</option>
                            <option value="<?php echo $subscribed_status ?>"><?php echo $subscribed_status ?></option>
                            <option value="<?php echo $not_completed_status ?>"><?php echo $not_completed_status ?></option>
                            <option value="<?php echo $default_status ?>"><?php echo $default_status ?></option>
                        </select>
                    </div>
                    <!-- select2 -->
                    <div class="col-sm">
                        <label for="donation" class="form-label">التبرع</label>
                        <select class="form-select" id="donation" aria-label="Default select" name="donation_input">
                            <option value="<?php echo ' >= 0' ?>" selected>اختر حالة</option>
                            <option value="<?php echo ' = 0' ?>">غير متبرع
                            </option>
                            <option value="<?php echo ' > 0' ?>">متبرع
                            </option>
                        </select>
                    </div>
                    <!-- select3 -->
                    <div class="col-sm">
                        <label for="school" class="form-label">الفرع</label>
                        <select class="form-select" id="school" aria-label="Default select" name="school_input">
                            <option value="" selected>اختر فرع</option>
                            <option value="<?php echo $school1 ?>"><?php echo $school1 ?></option>
                            <option value="<?php echo $school2 ?>
"><?php echo $school2 ?>
                            </option>
                            <option value="<?php echo $school3 ?>
"><?php echo $school3 ?>
                            </option>
                            <option value="<?php echo $school4 ?>
"><?php echo $school4 ?>
                            </option>
                            <option value="<?php echo $school5 ?>
"><?php echo $school5 ?>
                            </option>
                        </select>
                    </div>
                    <!-- select4 -->
                    <div class="col-sm">
                        <label for="level" class="form-label">المستوى</label>
                        <select class="form-select" id="level" aria-label="Default select" name="level_input">
                            <option value="" selected>اختر مستوى</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                    </div>
                    <!-- select5 -->
                    <div class="col-sm">
                        <label for="class" class="form-label">القسم</label>
                        <select class="form-select" id="class" aria-label="Default select" name="class_input">
                            <option value="" selected>اختر قسم</option>
                            <option value="أ"> أ</option>
                            <option value="ب">ب</option>
                            <option value="ج">ج</option>
                            <option value="د">د</option>
                            <option value="ه">هـ</option>
                            <option value="و">و</option>
                            <option value="ز">ز</option>
                        </select>
                    </div>
                    <!-- select6 -->
                    <div class="col-sm">
                        <label for="year" class="form-label">السنة الدراسية</label>
                        <select class="form-select" id="year" aria-label="Default select" name="year_input">
                            <option value="" selected>اختر سنة</option>
                            <option value="<?php echo $year1 ?>">
                                <?php echo $year1 ?>
                            </option>
                            <option value="<?php echo $year2 ?>">
                                <?php echo $year2 ?>
                            </option>
                        </select>
                    </div>
                </div>
                <!-- End Second row -->
                <div class="row container-fluid justify-content-sm-center mt-4 mb-4">
                    <div class="col-sm-3">
                        <div class="input-group">
                            <span class="input-group-text">ترتيب حسب</span>
                            <select class="form-select" name="order_by_name">
                                <option value=""> الرقم</option>
                                <option value=",`name` ASC"> الإسم</option>
                            </select>
                            <input class="btn btn-primary" type="submit" name="report" id="button-addon1" value="عرض التقرير">
                        </div>
                    </div>
                </div>
            </form>
        </ul>
    </div>
    <!-- body table -->
    <div class="container-fluid">
        <!-- result Statistiques -->
        <div class="alert alert-warning container-fluid" role="alert">
            <div class="row text-center">
                <div class="col-sm">
                    <strong>عدد النتائج</strong><br>
                    <?php echo $Num_rows ?>
                </div>
                <div class="col-sm">
                    <strong>المبلغ المطلوب</strong><br>
                    <?php echo $required_amount_sum ?>
                </div>
                <div class="col-sm">
                    <strong>المبلغ المدفوع</strong><br>
                    <?php echo $amount_sum ?>
                </div>
                <div class="col-sm">
                    <strong>المبلغ المتبقي</strong><br>
                    <?php echo $rest_sum ?>
                </div>
                <div class="col-sm">
                    <strong>المبلغ المتبرع</strong><br>
                    <?php echo $donation_sum ?>
                </div>
                <div class="col-sm">
                    <strong>مشترك</strong><br>
                    <?php echo $yes_count ?>
                </div>
                <div class="col-sm">
                    <strong>غير مكتمل</strong><br>
                    <?php echo $notYet_count ?>
                </div>
                <div class="col-sm">
                    <strong>غير مشترك</strong><br>
                    <?php echo $no_count ?>
                </div>
            </div>
        </div>
        <!-- END result Statistiques -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center">رقم التلميذ</th>
                    <th scope="col">الإسم الكامل</th>
                    <th scope="col" class="text-center">اليوم</th>
                    <th scope="col" class="text-center">الوقت</th>
                    <th scope="col" class="text-center">المبلغ المدفوع</th>
                    <th scope="col" class="text-center">المبلغ المتبقي</th>
                    <th scope="col" class="text-center">المبلغ المتبرع</th>
                    <th scope="col" class="text-center">الحالة</th>
                    <th scope="col">الفرع</th>
                    <th scope="col" class="text-center">المستوى</th>
                    <th scope="col" class="text-center">القسم</th>
                    <th scope="col" class="text-center">السنة الدراسية</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($reportResult)) {
                ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $row['stud_id'] ?></th>
                        <td><?php echo $row['name'] ?></td>
                        <td class="text-center"><?php echo $row['date'] ?></td>
                        <td class="text-center"><?php echo $row['time'] ?></td>
                        <td class="text-center"><?php echo $row['amount'] ?>,00</td>
                        <td class="text-center"><?php echo $row['rest'] ?>,00</td>
                        <td class="text-center"><?php echo $row['donation'] ?>,00</td>
                        <td class="text-center"><?php echo $row['status'] ?></td>
                        <td><?php echo $row['school'] ?></td>
                        <td class="text-center"><?php echo $row['level'] ?></td>
                        <td class="text-center"><?php echo $row['class'] ?></td>
                        <td class="text-center"><?php echo $row['year'] ?></td>
                    </tr>
                <?php
                }
                // if no result found
                if ($reportRows == 0)
                    echo "<td></td><td></td><td></td><td></td><td></td>
                    <td class='text-center'>لا توجد نتائج</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td>";
                ?>
            </tbody>
        </table>
    </div>

    <!-- END body table -->

</body>

</html>