<?php
include 'check.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap_v5.0.0-beta1/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="bootstrap_v5.0.0-beta1/bootstrap-icons-1.2.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="bootstrap_v5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
    <script src="bootstrap_v5.0.0-beta1/jquery-3.3.1.js"></script>
    <script type="text/javascript">
        $(function() {
            var href = window.location.href;
            $('nav a').each(function(e, i) {
                if (href.indexOf($(this).attr('href')) >= 0) {
                    $(this).addClass('active');
                }
            });
        });
    </script>

    <title>index</title>
</head>

<body class="">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark my_nav_bg sticky-top mb-3" role="navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">برنامج الاشتراكات</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="upload_form.php">قاعدة البيانات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">بحث</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report.php">تقرير</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">تسجيل الخروج</a>
                    </li>

                </ul>
                </li>
                </ul>
                <form class="d-flex" action="subscribe.php" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-2 mt-2">
                        <span class="input-group-text">@</span>
                        <input type="text" name="studentId" class="form-control" placeholder="رقم التلميذ" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-2 mt-2">
                        <span class="input-group-text">00.</span>
                        <input type="text" name="amount" placeholder="المبلغ المدفوع" class="form-control" aria-label="Amount" required>
                        <span class="input-group-text">دج</span>
                        <input class="btn btn-danger" type="submit" name="subscribe" value=" اشتراك ">
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <!-- END Navbar -->

</body>

</html>