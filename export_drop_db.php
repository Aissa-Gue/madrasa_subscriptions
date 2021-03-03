<?php
include 'check.php';

// DROP ALL Tables
if (isset($_POST['drop'])) {
    $delYear = $_POST['del_year'];

    if ($delYear != 'all')
        $dropSql = "DELETE FROM students WHERE year = '$delYear'";
    else
        $dropSql = "DELETE FROM students";

    if (mysqli_query($conn, $dropSql))
        echo '<br><br>
    <h3 align= "center" style="color:white; background:green;padding:15px"> تم حذف قاعدة البيانات بنجاح </h3>';
    else
        echo '<br><br>
        <h3 align= "center" style="color:white; background:red;padding:15px"> حدثت مشكلة ! لم يتم حذف قاعدة البيانات </h3>' . mysqli_error($conn);
    header("refresh:1.5; url=upload_form.php");
}

/***Export DB***/
if (isset($_POST['export'])) {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    //Query our MySQL table
    $expYear = $_POST['export_year'];

    if ($expYear != 'all')
        $sql = "SELECT students.stud_id, name, school, level, class, year, date, time, amount, rest, donation, deserved_amount, status FROM students, subscriptions WHERE students.stud_id = subscriptions.stud_id AND year = '$expYear'";
    else
        $sql = "SELECT students.stud_id, name, school, level, class, year, date, time, amount, rest, donation, deserved_amount, status FROM students, subscriptions WHERE students.stud_id = subscriptions.stud_id";

    $stmt = $pdo->query($sql);

    //Retrieve the data from our table.
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //The name of the Excel file that we want to force the
    //browser to download.
    $filename = 'Subscriptions_db_' . $date . '.xls';

    //Send the correct headers to the browser so that it knows
    //it is downloading an Excel file.
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Expires: 0");

    //Define the separator line
    $separator = "\t";

    //If our query returned rows
    if (!empty($rows)) {

        //Dynamically print out the column names as the first row in the document.
        //This means that each Excel column will have a header.
        echo implode($separator, array_keys($rows[0])) . "\n";

        //Loop through the rows
        foreach ($rows as $row) {

            //Clean the data and remove any special characters that might conflict
            foreach ($row as $k => $v) {
                $row[$k] = str_replace($separator . "$", "", $row[$k]);
                $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
                $row[$k] = trim($row[$k]);
            }

            //Implode and print the columns out using the 
            //$separator as the glue parameter
            echo implode($separator, $row) . "\n";
        }
    }
}
