<?php
session_start();
include('library/include/connect.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['EMAIL'])) {
    header('location: login.php');
    exit();
}

// معالجة إضافة كتاب جديد
if (isset($_POST['add_book'])) {
    $bookname = mysqli_real_escape_string($conn, $_POST['bookname']);
    $booktitle = mysqli_real_escape_string($conn, $_POST['booktitle']);
    $bookprice = (int)$_POST['bookprice'];
    $section = mysqli_real_escape_string($conn, $_POST['section']);
    $bookstage = (int)$_POST['bookstage'];
    $bookpdf = mysqli_real_escape_string($conn, $_FILES['bookpdf']['name']);
    $bookimage = mysqli_real_escape_string($conn, $_FILES['bookimage']['name']);
    $target_pdf = "uploads/" . basename($_FILES['bookpdf']['name']);
    $target_image = "uploads/" . basename($_FILES['bookimage']['name']);

    $errors = [];

    if (empty($bookname)) $errors[] = "اسم الكتاب مطلوب";
    if (strlen($booktitle) > 100) $errors[] = "العنوان يجب أن يكون أقل من 100 حرف";
    if (!is_numeric($bookprice)) $errors[] = "السعر يجب أن يكون رقماً";

    if (empty($errors)) {
        move_uploaded_file($_FILES['bookpdf']['tmp_name'], $target_pdf);
        move_uploaded_file($_FILES['bookimage']['tmp_name'], $target_image);
        $query = "INSERT INTO books (bookname, booktitle, bookprice, section, bookstage, bookpdf, bookimage) 
                  VALUES ('$bookname', '$booktitle', $bookprice, '$section', $bookstage, '$bookpdf', '$bookimage')";
        mysqli_query($conn, $query);
        echo '<script>alert("تمت إضافة الكتاب بنجاح")</script>';
    } else {
        foreach ($errors as $error) echo "<script>alert('$error')</script>";
    }
}

// معالجة حذف كتاب
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    $query = "DELETE FROM books WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        echo '<script>alert("تم الحذف بنجاح")</script>';
    } else {
        echo '<script>alert("حدث خطأ أثناء الحذف")</script>';
    }
}
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
    <style>
        /* الستايل الكامل */
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --background-color: #f8f9fa;
            --text-color: #2c3e50;
            --hover-color: #2980b9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Cairo', sans-serif;
        }

        body {
            background-color: var(--background-color);
            direction: rtl;
        }

        #container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            background-color: var(--primary-color);
            color: white;
            width: 250px;
            min-height: 100vh;
            padding: 20px;
            position: fixed;
            right: 0;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            margin: 15px 0;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            display: block;
            padding: 12px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background-color: var(--hover-color);
            transform: translateX(-5px);
        }

        .sidebar i {
            margin-left: 10px;
        }

        .main-content {
            margin-right: 250px;
            padding: 30px;
            width: calc(100% - 250px);
        }

        h1 {
            color: var(--primary-color);
            margin-bottom: 30px;
            border-bottom: 3px solid var(--secondary-color);
            padding-bottom: 10px;
            font-size: 28px;
        }

        .book-form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .book-form input,
        .book-form input[type="file"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .book-form input:focus {
            border-color: var(--secondary-color);
            outline: none;
        }

        .book-form button {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .book-form button:hover {
            background-color: var(--hover-color);
        }

        .books-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .books-table th,
        .books-table td {
            padding: 15px;
            text-align: center;
        }

        .books-table thead {
            background-color: var(--primary-color);
            color: white;
        }

        .books-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .books-table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .edit-btn {
            background-color: #27ae60;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }

        .edit-btn:hover,
        .delete-btn:hover {
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }

            .main-content {
                width: 100%;
                margin-right: 0;
                padding: 20px;
            }

            .books-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <section id="container">
        <!-- القائمة الجانبية -->
        <div class="sidebar">
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-book"></i> الصفحة الرئيسية</a></li>
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
                <input type="text" name="section" placeholder="القسم" required>
                <input type="number" name="bookstage" placeholder="المرحلة" required>
                <input type="file" name="bookpdf" accept=".pdf" required>
                <input type="file" name="bookimage" accept="image/*" required>
                <button type="submit" name="add_book"><i class="fa-solid fa-plus"></i> إضافة كتاب</button>
            </form>

            <!-- جدول عرض الكتب -->
            <!-- <table class="books-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>اسم الكتاب</th>
                        <th>العنوان</th>
                        <th>السعر</th>
                        <th>القسم</th>
                        <th>المرحلة</th>
                        <th>الملف</th>
                        <th>الصورة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM books";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['bookname'] ?></td>
                        <td><?= $row['booktitle'] ?></td>
                        <td><?= $row['bookprice'] ?> $</td>
                        <td><?= $row['section'] ?></td>
                        <td><?= $row['bookstage'] ?></td>
                        <td><a href="uploads/<?= $row['bookpdf'] ?>" target="_blank">عرض PDF</a></td>
                        <td><img src="uploads/<?= $row['bookimage'] ?>" alt="صورة الكتاب" width="50"></td>
                        <td>
                            <a href="edit_book.php?id=<?= $row['id'] ?>" class="edit-btn">تعديل</a>
                            <a href="?delete_id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('هل أنت متأكد؟')">حذف</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table> -->
        </div>
    </section>

    <script src="../js/main.js"></script>
</body>
</html>