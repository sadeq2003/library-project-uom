<?php
session_start();
include('../shopping/include/connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="logos/logoheader.png">
    <title>store shoping</title>
</head>
<body>
    <?php
     if(!isset($_SESSION['EMAIL']))
     {
        header('location:login.php');
     }
     else
     {

     
    ?>
   
    <?php 
    @$sectionname=$_POST['sectionname'];
    @$addsection=$_POST['sectionadd'];
    @$id=$_GET['id'];


    if(isset($addsection)){
        if(empty($sectionname))
        {
            echo'<script> alert ("pless add section");</script>';}
        
        elseif($sectionname<50){
            echo'<script> alert ("pless add section less then 50 letter");</script>';

        }
    
    else{
        $query="INSERT INTO section (sectionname) VALUES ('$sectionname')";
        $result=mysqli_query($conn,$query);
        echo'<script> alert ("section added sccssuful");</script>';

    }}
    ?>
    
<!-- حدف القسم  ______________________ -->
   <?php
      if(isset($id)){
       $query="DELETE FROM section where id= '$id'";
       $delete =mysqli_query($conn,$query);
       if(isset($delete)){
        echo '<script> alert("ثم الحذف بنجاح "</script>';

           }
         else{
             echo '<script> alert("لم يتم الحذف  "</script>';
        
         }
    }

    ?>

  <section id="container">

        <!-- القائمة الجانبية -->
        <div class="sidebar">
            <!-- <h2>لوحة تحكم الإدارة</h2> -->
            <ul>
                <li><a href="../php/index.html"> <i class="fa-solid fa-house"></i> الصفحة الرئيسية</a></li>
                <li><a href="products.php">
                <i class="fa-solid fa-shirt"></i>صفحة المنتجات</a></li>
                <li><a href="#">
                <i class="fa-solid fa-folder-plus"></i>إضافة منتج</a></li>
                <li><a href="#">
                <i class="fa-solid fa-users"></i>معلومات الأعضاء</a></li>
                <li><a href="track_order.php">
                <i class="fa-solid fa-folder-open"></i>طلبات الزبائن</a></li>
                <li><a href="logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>تسجيل الخروج</a></li>
            </ul>
        </div>

        <!-- المحتوى الرئيسي -->
        <div class="main-content">
            <h1>إضافة قسم جديد</h1>
            <form action="admin.php" method="post">
                <input type="text" placeholder="اسم القسم" name="sectionname"/>
                <button type="submit" name="sectionadd">إضافة قسم</button>
            </form>
            <table >
                <thead>
                    <tr>
                        <th>الرقم التسلسلي</th>
                        <th>اسم القسم</th>
                        <th>حذف القسم</th>
                    </tr>
                </thead>
                <?php
                $query="SELECT * FROM section";
                $result=mysqli_query($conn,$query);
                while($row=mysqli_fetch_assoc($result)){

                
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['sectionname']; ?></td>
                        <td><a href="admin.php?id=<?php  echo $row['id']; ?>">
                        <button type="submit" class="delete-btn">حذف القسم</button>
                        </a></td>
                    </tr>
                    
                </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </section>

    <?php 
     }
     ?>

<script src="../php/javascript.js">
    

</script>

</body>
</html>