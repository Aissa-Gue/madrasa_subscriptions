<?php
include 'header.php';
//show students
$showQuery = "SELECT * FROM students, subscriptions WHERE students.stud_id = subscriptions.stud_id AND date != 'NULL' ORDER BY `date` DESC, `time` DESC LIMIT 10";
$showResult = mysqli_query($conn, $showQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <!-- body table -->
    <div class="container-fluid">
        <!-- Alert -->
        <div class="alert alert-warning text-center" role="alert">
            <h5><strong> قائمة آخر الاشتراكات المدفوعة </strong></h5>
        </div>
        <!-- END Alert -->

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center">رقم التلميذ</th>
                    <th scope="col">الإسم الكامل</th>
                    <th scope="col" class="text-center">التاريخ</th>
                    <th scope="col" class="text-center">المبلغ المدفوع</th>
                    <th scope="col" class="text-center">المبلغ المتبقي</th>
                    <th scope="col" class="text-center">المبلغ المتبرع</th>
                    <th scope="col" class="text-center">الحالة</th>
                    <th scope="col">الفرع</th>
                    <th scope="col" class="text-center">المستوى</th>
                    <th scope="col" class="text-center">القسم</th>
                    <th scope="col" class="text-center">السنة الدراسية</th>
                    <th scope="col" class="text-center">حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($showResult)) {
                ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $row['stud_id'] ?></th>
                        <td><?php echo $row['name'] ?></td>
                        <td class="text-center"><?php echo $row['date'] ?></td>
                        <td class="text-center"><?php echo $row['amount'] ?>,00</td>
                        <td class="text-center"><?php echo $row['rest'] ?>,00</td>
                        <td class="text-center"><?php echo $row['donation'] ?>,00</td>
                        <td class="text-center"><?php echo $row['status'] ?></td>
                        <td><?php echo $row['school'] ?></td>
                        <td class="text-center"><?php echo $row['level'] ?></td>
                        <td class="text-center"><?php echo $row['class'] ?></td>
                        <td class="text-center"><?php echo $row['year'] ?></td>
                        <td class="text-center">
                            <a class="btn btn-outline-danger" href="delete.php?del=<?php echo $row['sub_id'] ?>&name=<?php echo $row['name'] ?>'" onclick="return confirm('هل أنت متأكد؟')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <!-- END body table -->
</body>

</html>