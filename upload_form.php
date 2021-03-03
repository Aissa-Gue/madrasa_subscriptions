<?php
include 'header.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap_v5.0.0-beta1/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Upload Database</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>إدخال قاعدة بيانات التلاميذ</h4>
                <hr>
                <form method="post" action="file_upload.php" enctype="multipart/form-data">
                    <!-- First row -->
                    <div class="form-group row mb-3">
                        <div class="input-group">
                            <label class="col-md-3">أدخل قاعدة البيانات (Excel)</label>
                            <div class="col-md-5">
                                <input type="file" name="uploadfile" class="form-control" accept=".xlsx, .xls" required />
                            </div>
                            <div class="col-md-3">
                                <input type="submit" name="submit" class="btn btn-primary" value="إدخال">
                                <a class="btn btn-secondary" href="template/ex_1.xlsx">
                                    <i class="bi bi-download"> نموذج</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END First row -->
                </form>

                <form method="post" action="file_upload_complete.php" enctype="multipart/form-data">
                    <!-- Second row -->
                    <div class="form-group row mb-3">
                        <div class="input-group">
                            <label class="col-md-3">أدخل قاعدة البيانات (مع الاشتراكات)</label>
                            <div class="col-md-5">
                                <input type="file" name="uploadfileComp" class="form-control" accept=".xlsx, .xls" required />
                            </div>
                            <div class="col-md-3">
                                <input type="submit" name="submitComp" class="btn btn-primary" value="إدخال">
                                <a class="btn btn-secondary" href="template/ex_comp_1.xlsx">
                                    <i class="bi bi-download"> نموذج</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END second row -->
                </form>

                <form method="post" action="export_drop_db.php" enctype="multipart/form-data">
                    <!-- Third row -->
                    <div class="form-group row mb-3">
                        <label class="col-md-3">استخراج قاعدة البيانات</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-text">السنة الدراسية</span>
                                <select class="form-select" name="export_year">
                                    <option value="all" selected>الكل</option>
                                    <option value="<?php echo $year1 ?>">
                                        <?php echo $year1 ?>
                                    </option>
                                    <option value="<?php echo $year2 ?>">
                                        <?php echo $year2 ?>
                                    </option>
                                </select>
                                <input type="submit" name="export" class="btn btn-success" value="استخراج ق.ب">
                            </div>
                        </div>
                    </div>
                    <!-- END Third row -->
                    <!-- Forth row -->
                    <div class="form-group row mb-3">
                        <label class="col-md-3">حذف قاعدة البيانات</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <span class="input-group-text">السنة الدراسية</span>
                                <select class="form-select" name="del_year">
                                    <option value="all" selected>الكل</option>
                                    <option value="<?php echo $year1 ?>">
                                        <?php echo $year1 ?>
                                    </option>
                                    <option value="<?php echo $year2 ?>">
                                        <?php echo $year2 ?>
                                    </option>
                                </select>
                                <input type="submit" name="drop" class="btn btn-danger" value=" حذف ق . ب " onclick="return confirm('هل أنت متأكد؟')">
                            </div>
                        </div>
                    </div>
                    <!-- END Forth row -->

                </form>
            </div>
        </div>
    </div>
    <script src="bootstrap_v5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
</body>