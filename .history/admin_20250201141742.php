<?php
session_start();
include('library/include/connect.php');
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="icon" href="logos/logoheader.png">
    <title>إدارة المكتبة الإلكترونية</title>
    st
</head>
<body>
    <?php if(!isset($_SESSION['EMAIL'])) header('location:login.php'); else { ?>
   
    <?php 
    // معالجة إضافة الكتاب
    if(isset($_POST['add_book'])){
        $bookname = mysqli_real_escape_string($conn, $_POST['bookname']);
        $booktitle = mysqli_real_escape_string($conn, $_POST['booktitle']);
        $bookprice = (int)$_POST['bookprice'];
        $bookpdf = mysqli_real_escape_string($conn, $_FILES['bookpdf']['name']);
        $target = "uploads/".basename($_FILES['bookpdf']['name']);

        $errors = [];
        
        if(empty($bookname)) $errors[] = "اسم الكتاب مطلوب";
        if(strlen($booktitle) > 100) $errors[] = "العنوان يجب أن يكون أقل من 100 حرف";
        if(!is_numeric($bookprice)) $errors[] = "السعر يجب أن يكون رقماً";
        
        if(empty($errors)){
            move_uploaded_file($_FILES['bookpdf']['tmp_name'], $target);
            $query = "INSERT INTO books (bookname, booktitle, bookprice, bookpdf) 
                     VALUES ('$bookname', '$booktitle', $bookprice, '$bookpdf')";
            mysqli_query($conn, $query);
            echo '<script>alert("تمت إضافة الكتاب بنجاح")</script>';
        } else {
            foreach($errors as $error) echo "<script>alert('$error')</script>";
        }
    }

    // معالجة حذف الكتاب
    if(isset($_GET['delete_id'])){
        $id = (int)$_GET['delete_id'];
        $query = "DELETE FROM books WHERE id=$id";
        if(mysqli_query($conn, $query)){
            echo '<script>alert("تم الحذف بنجاح")</script>';
        } else {
            echo '<script>alert("حدث خطأ أثناء الحذف")</script>';
        }
    }
    ?>

    <section id="container">
        <!-- القائمة الجانبية -->
        <div class="sidebar">
            <ul>
                <li><a href="../index.php"><i class="fa-solid fa-book"></i> الصفحة الرئيسية</a></li>
                <li><a href="manage_books.php"><i class="fa-solid fa-book-open"></i> إدارة الكتب</a></li>
                <li><a href="add_book.php"><i class="fa-solid fa-plus"></i> إضافة كتاب جديد</a></li>
                <li><a href="users.php"><i class="fa-solid fa-users"></i> إدارة المستخدمين</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> تسجيل الخروج</a></li>
            </ul>
        </div>

        <!-- المحتوى الرئيسي -->
        <div class="main-content">
            <h1><i class="fa-solid fa-book"></i> إدارة الكتب</h1>
            
            <!-- نموذج إضافة كتاب -->
            <form action="" method="post" enctype="multipart/form-data" class="book-form">
                <input type="text" name="bookname" placeholder="اسم الكتاب" required>
                <input type="text" name="booktitle" placeholder="عنوان الكتاب" maxlength="100" required>
                <input type="number" name="bookprice" placeholder="السعر" min="0" required>
                <input type="file" name="bookpdf" accept=".pdf" required>
                <button type="submit" name="add_book"><i class="fa-solid fa-plus"></i> إضافة كتاب</button>
            </form>

            <!-- جدول عرض الكتب -->
            <table class="books-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>اسم الكتاب</th>
                        <th>العنوان</th>
                        <th>السعر</th>
                        <th>الملف</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM books";
                    $result = mysqli_query($conn, $query);
                    while($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['bookname'] ?></td>
                        <td><?= $row['booktitle'] ?></td>
                        <td><?= $row['bookprice'] ?> $</td>
                        <td><a href="uploads/<?= $row['bookpdf'] ?>" target="_blank">عرض PDF</a></td>
                        <td>
                            <a href="edit_book.php?id=<?= $row['id'] ?>" class="edit-btn">تعديل</a>
                            <a href="?delete_id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php } ?>
    
<script src="../js/main.js"></script>
</body>
</html>