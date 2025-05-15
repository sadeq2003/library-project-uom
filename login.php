<?php
session_start();
include('library/include/connect.php');
if (isset($_SESSION['EMAIL'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login_style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <section class="hero">
        <form action="login.php" method="post">
            <div class="contian">
                <h1>Login Admin Page</h1>
                <div class="input-box">
                    <input type="email" placeholder="User Name" name="email" required>
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <button type="submit" name="add">Login</button>
            </div>
        </form>
    </section>

    <?php
    @$ademail = $_POST['email'];
    @$adpassword = $_POST['password'];
    @$adadd = $_POST['add'];

    if (isset($adadd)) {
        if (empty($ademail) || empty($adpassword)) {
            echo '<script>alert("Please enter your email address or password.")</script>';
        } else {
            $query = "SELECT * FROM admin WHERE EMAIL='$ademail' AND password='$adpassword'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['EMAIL'] = $ademail;
                header("Location: admin.php");
            } else {
                echo '<script>alert("You cannot log in to the admin page. Sorry!")</script>';
                header("Location: index.php");
            }
        }
    }
    ?>
</body>
</html>
