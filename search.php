<?php
include 'header.php';
// input values
$id_name = $_POST['id_name_input'];
$order =  $_POST['order_by_name'];

//search query in subscribed students only
$searchQuery = "SELECT * FROM students, subscriptions WHERE students.stud_id = subscriptions.stud_id AND (students.stud_id = '$id_name' OR students.name LIKE '%$id_name%') $order";

$searchResult = mysqli_query($conn, $searchQuery);
// search num rows
$search_num_rows = mysqli_num_rows($searchResult);

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>

<body>
    <div class="">
        <!-- search new -->
        <div class="row container-fluid justify-content-sm-center">
            <div class="col-sm-6">
                <form action="search.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <span class="input-group-text">ترتيب حسب</span>
                        <select class="col-sm-2" name="order_by_name">
                            <option value=""> الرقم</option>
                            <option value="ORDER BY `students`.`name` ASC" selected> الإسم</option>
                        </select>
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" placeholder="أدخل رقم أو اسم التلميذ" name="id_name_input" aria-label="Server">
                        <input class="btn btn-primary" type="submit" name="search" id="button-addon1" value="بحث">
                    </div>
                </form>
            </div>
        </div>
        <!-- END serch new -->
        <div class="container-fluid">
            <!-- Alert -->
            <div class="alert alert-warning text-center" role="alert">
                <strong> عدد النتائج = </strong>
                <?php echo $search_num_rows ?>
            </div>
            <!-- END Alert -->
            <!-- body table -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">رقم التلميذ</th>
                        <th scope="col">الإسم الكامل</th>
                        <th scope="col" class="text-center">التاريخ</th>
                        <th scope="col" class="text-center">المبلغ المدفوع</th>
                        <th scope="col" class="text-center">المبلغ المتبقي</th>
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
                    while ($row = mysqli_fetch_array($searchResult)) {
                    ?>
                        <tr>
                            <th scope="row" class="text-center"><?php echo $row['stud_id'] ?></th>
                            <td><?php echo $row['name'] ?></td>
                            <td class="text-center"><?php echo $row['date'] ?></td>
                            <td class="text-center"><?php echo $row['amount'] ?>,00</td>
                            <td class="text-center"><?php echo $row['rest'] ?>,00</td>
                            <td class="text-center"><?php echo $row['status'] ?></td>
                            <td><?php echo $row['school'] ?></td>
                            <td class="text-center"><?php echo $row['level'] ?></td>
                            <td class="text-center"><?php echo $row['class'] ?></td>
                            <td class="text-center"><?php echo $row['year'] ?></td>
                            <td class="text-center">
                                <a class="btn btn-outline-danger" href="delete.php?del=<?php echo $row['sub_id'] ?>&name=<?php echo $row['name'] ?>'" onclick="return confirm('هل أنت متأكد؟')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    if ($search_num_rows == 0)
                        echo "<td></td><td></td><td></td><td></td>
                    <td class='text-center'>لا توجد نتائج</td>
                    <td></td><td></td><td></td><td></td><td></td><td></td>";
                    ?>
                </tbody>
            </table>

            <!-- END body table -->
        </div>
    </div>
</body>