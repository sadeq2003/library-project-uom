<?php
session_start();
include('library/include/connect.php');
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الصفحة الرئيسية</title>
    
    <!-- الروابط الخارجية -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo|Reem+Kufi&display=swap">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" href="img/Home/logo1.png">
    <link rel="stylesheet" href="css/stylePage.css">
    
    <!-- ستايل مخصص لعرض الكتب -->
    <style>
        .book-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 10px;
            overflow: hidden;
            background: #fff;
            margin-bottom: 30px;
            text-align: center;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .book-img {
            height: 250px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }
        .download-btn {
            background: #2c3e50;
            color: #fff !important;
            padding: 8px 20px;
            border-radius: 25px;
            transition: all 0.3s;
            display: inline-block;
            margin-top: 10px;
        }
        .download-btn:hover {
            background: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <!-- الشريط العلوي -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="img/Home/logo.png" width="65" height="65" alt="مكتبتي"> مكتبتي
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">الصفحة الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="مرحلة اولى.html">مرحلة أولى</a></li>
                    <li class="nav-item"><a class="nav-link" href="مرحلة ثانية.html">مرحلة ثانية</a></li>
                    <li class="nav-item"><a class="nav-link" href="مرحلة ثالثة.html">مرحلة ثالثة</a></li>
                    <li class="nav-item"><a class="nav-link" href="مرحلة رابعة.html">مرحلة رابعة</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">تسجيل دخول الأدمن</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin.php">الأدمن</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- عرض الشرائح -->
    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-interval="10000">
                <img src="img/Home/header-1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-interval="2000">
                <img src="img/Home/header-2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/Home/header-3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- قسم الحكمة -->
    <section class="section-one text-center py-5">
        <div class="container">
            <div class="content-me">
                <h2 class="mb-4">حكمة اليوم</h2>
                <p class="lead">" اتَّقِ اللَّهَ حَيْثُمَا كُنْتَ وأَتْبِعِ السَّيِّئَةَ الْحسنةَ تَمْحُهَا، وخَالقِ النَّاسَ بخُلُقٍ حَسَنٍ "</p>
                <span class="text-muted">- رسول الله صلى الله عليه وسلم -</span>
            </div>
        </div>
    </section>

    <!-- الأقسام الرئيسية -->
    <section class="main-side py-5">
        <div class="container">
            <div class="row">
                <!-- القائمة الجانبية -->
                <aside class="col-lg-3 mb-4">
                    <div class="bg-white p-3 rounded shadow">
                        <h4 class="mb-3"><i class="fas fa-search mr-2"></i>الأقسام</h4>
                        <ul class="list-unstyled">
                            <li><a href="index.html" class="d-block p-2 mb-2"><i class="fas fa-home mr-2"></i>الصفحة الرئيسية</a></li>
                            <li><a href="مرحلة اولى.html" class="d-block p-2 mb-2"><i class="fas fa-tv mr-2"></i>مرحلة أولى</a></li>
                            <li><a href="مرحلة ثانية.html" class="d-block p-2 mb-2"><i class="fas fa-utensil-spoon mr-2"></i>مرحلة ثانية</a></li>
                            <li><a href="مرحلة ثالثة.html" class="d-block p-2 mb-2"><i class="fas fa-pencil-alt mr-2"></i>مرحلة ثالثة</a></li>
                            <li><a href="مرحلة رابعة.html" class="d-block p-2 mb-2"><i class="fas fa-palette mr-2"></i>مرحلة رابعة</a></li>
                        </ul>
                        <img src="img/Home/logo.png" class="img-fluid mt-3" alt="">
                    </div>
                </aside>

                <!-- محتوى الكتب -->
                <div class="col-lg-9">
                    <?php
                    // تعريف الأقسام مع الرموز المناسبة
                  
                    foreach ($categories as $category => $icon) {
                        // استعلام لجلب الكتب في القسم المحدد فقط
                        $query = "SELECT * FROM books WHERE category = '$category'";
                        $result = mysqli_query($conn, $query);
                        
                        if (mysqli_num_rows($result) > 0) {
                            echo '
                            <div class="computer mb-5">
                                <h3 class="mb-4"><i class="'.$icon.' mr-2"></i>الكتب في قسم '.$category.'</h3>
                                <div class="row">';
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                <div class="col-md-4 mb-4">
                                    <div class="book-card h-100">
                                        <div class="p-3">
                                            <div class="stars text-warning mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <img src="uploads/'.$row['bookimage'].'" class="img-fluid book-img mb-3" alt="'.$row['bookname'].'">
                                            <h5 class="font-weight-bold">'.$row['bookname'].'</h5>
                                            <p class="text-muted">'.$row['booktitle'].'</p>
                                            <a href="uploads/'.$row['bookpdf'].'" download class="download-btn">
                                                حمل الآن <i class="fas fa-download mr-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>';
                            }
                            
                            echo '
                                </div>
                            </div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- التذييل -->
    <footer class="bg-dark text-white py-3 text-center">
        <div class="container">
            مشروع مكتبتي - فرقة الرابعة 2023 &copy;
        </div>
    </footer>

    <!-- السكريبتات -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        // إضافة تأثير تفاعلي عند مرور الماوس على بطاقة الكتاب
        $(document).ready(function(){
            $('.book-card').hover(
                function() { $(this).addClass('shadow-lg'); },
                function() { $(this).removeClass('shadow-lg'); }
            );
        });
    </script>
</body>
</html>
