<?php
session_start();
include('library/include/connect.php');

// استعلام لجلب الكتب التي تخص المرحلة الأولى (تأكد من اسم العمود والقيمة حسب قاعدة بياناتك)
$query = "SELECT * FROM books WHERE bookstage = '1'";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>مرحلة أولى</title>
        
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cairo|Oswald&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Reem+Kufi&display=swap">
        
        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
        
        <!-- Normalize -->
        <link type="text/css" rel="stylesheet" href="css/normalize.css"/>
        
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        
        <!-- Page Icon -->
        <link rel="icon" href="img/Home/logo.png">
        
        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="css/stylePage.css"/>
    </head>
    <body>

        <!--Start Navbar-->
        <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="img/Home/logo.png" width="65" height="65" alt="مكتبتي"> مكتبتي
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">الصفحة الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="first.php">مرحلة أولى</a></li>
                    <li class="nav-item"><a class="nav-link" href="second.php">مرحلة ثانية</a></li>
                    <li class="nav-item"><a class="nav-link" href="third.php">مرحلة ثالثة</a></li>
                    <li class="nav-item"><a class="nav-link" href="fourth.php">مرحلة رابعة</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="login.php">تسجيل دخول الأدمن</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="admin.php">الأدمن</a></li>
                </ul>
            </div>
        </div>
    </nav>
        <!--End Navbar-->
        
        <!--Start section-one-->
        <section class="section-one text-center">
            <div class="container">
                <div class="content-me">
                    <h2>مواد المرحلة الأولى</h2>
                    <p>" إن المعرفة لم تعد قوة في عصر السرعة والإنترنت والكمبيوتر ، إنما تطبيق المعرفة هو القوة "</p>
                    <span>-كفاح فياض-</span>
                </div>
            </div>
        </section>
        <!--End section-one-->

        <!--Start main side-->
        <section class="main-side">
    <div class="container">
        <div class="row">
            <!--Start Aside-->
            <aside class="col-lg-3 text-right">
                        <h2>الأقسام <i class="fas fa-search"></i></h2>
                        <ul>
                        <li>
                            <a href="index.php" class="d-block p-2 mb-2">
                                <i class="fas fa-home mr-2"></i>Home
                            </a>
                        </li>
                        <li>
                            <a href="computer_science.php" class="d-block p-2 mb-2">
                                <i class="fas fa-laptop mr-2"></i>Computer Science
                            </a>
                        </li>
                        <li>
                            <a href="hardware.php" class="d-block p-2 mb-2">
                                <i class="fas fa-microchip mr-2"></i>Hardware
                            </a>
                        </li>
                        <li>
                            <a href="software.php" class="d-block p-2 mb-2">
                                <i class="fas fa-code mr-2"></i>Software
                            </a>
                        </li>
                        <li>
                            <a href="networking.php" class="d-block p-2 mb-2">
                                <i class="fas fa-network-wired mr-2"></i>Networking
                            </a>
                        </li>
                            <img src="img/Home/logo.png" class="d-block w-100" alt="">
                        </div>
                        </ul>
                       
                    </aside>
            <!--End Aside-->

            <!--Start content-my-side-->
            <div class="col-lg-9 content-my-side text-right">
                <div class="row">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-lg-4 text-center">
                                <div class="box">
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="img">
                                        <img src="uploads/' . htmlspecialchars($row['bookimage']) . '" class="d-block w-100" alt="' . htmlspecialchars($row['bookname']) . '">
                                    </div>
                                    <h3>' . htmlspecialchars($row['bookname']) . '</h3>
                                    <p>' . htmlspecialchars($row['booktitle']) . '</p>
                                    <a download href="uploads/' . htmlspecialchars($row['bookpdf']) . '">حمل الآن <i class="fas fa-arrow-left"></i></a>
                                </div>
                            </div>';
                        }
                    } else {
                        echo '<p class="text-center">لا توجد كتب للمرحلة الأولى حالياً.</p>';
                    }
                    ?>
                </div>
            </div>
            <!--End content-my-side-->
        </div>
    </div>
</section>

        <!--End main side-->

        <footer class="text-center">
            مشروع المكتبة الالكترونية لقسم الحاسوب &copy;
        </footer>

        <script src="js/jQuery-min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>
