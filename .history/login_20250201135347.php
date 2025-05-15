<?php
 session_start();
include('../library/include/connect.php');
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
    <title>js</title>
    <link rel="stylesheet" href="login_style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <?php 

    @$ademail=$_POST['email'];
    @$adpassword=$_POST['password'];
    @$adadd=$_POST['add'];

    
    if(isset($adadd))
    {
        if(empty($ademail) || empty($adpassword))
        {
               echo '<script>alert("Please enter your email address or password :") </script>';
        }
        else{
            $query ="SELECT *FROM admin WHERE EMAIL='$ademail' AND password='$adpassword'";
            $result = mysqli_query($conn,$query);
            if(mysqli_num_rows($result)>0){
                $_SESSION['EMAIL']=$ademail;
                header("refresh:0; url=index.php");
            
            }
            else
            {
                echo '<script>alert("you cant login into the admon page sorry! :") </script>';
                header("refresh:0;url = index.php");

            }
        }
        
    }
   
    ?>
    <section class="hero">
        
           <form action="login.php" method="post">
            <div class="contian">
                <div class="input">
                    <h1>
                        login admin page 
                    </h1>
                    <div class="input-box">
                        <input type="email" placeholder="user name" name="email">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-box"> 
                        <input type="password" placeholder="password" name="password">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                </div>
                
                
                <button type="submit" name="add">
                    login
                </button >
                
            </div>
           </form>
    </section>
    <script src="js.js"></script>
</body>
</html>