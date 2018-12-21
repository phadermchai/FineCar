<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "finecar";

$conn = mysqli_connect($servername, $username, $password, $dbName);
mysqli_set_charset($conn, "utf8");

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FineCar</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Armata">
    <link rel="stylesheet" href="assets/css/Article-Cards.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Features-Clean.css">
    <link rel="stylesheet" href="assets/css/Large-Dropdown-Menu-BS3.css">
    <link rel="stylesheet" href="assets/css/Large-Dropdown-Menu-BS31.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/News-Cards.css">
    <link rel="stylesheet" href="assets/css/Projects-Horizontal.css">
    <link rel="stylesheet" href="assets/css/Social-Icons.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-with-rotating-cards.css">
</head>

<body style="padding-top:0px;">
<nav class="navbar navbar-light navbar-expand-md fixed-top" style="background-color:rgba(0,0,0,0.49);color:rgba(0,0,0,0);">
        <div class="container-fluid"><a class="navbar-brand text-uppercase" href="index.php" style="background-color:rgba(72,167,255,0);color:rgba(255,255,255,0.9);font-family:Armata, sans-serif;"><i class="fa fa-road" style="font-size:23px;"></i>&nbsp;Fine Cars</a><button class="navbar-toggler"
                data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="navcol-1" style="color:rgb(255,255,255);">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php" style="color:#ffffff;">หน้าแรก</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="SearchCar.php" style="color:rgba(255,255,255,0.52);background-color:rgba(255,255,255,0);">ค้นหารถเช่า</a></li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="color:rgba(252,252,252,0.57);">ปล่อยรถเช่า</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="LetCar.php">ปล่อยรถเช่าของคุณ</a><a class="dropdown-item" role="presentation" href="LetDriver.php">สมัครเป็นคนขับกับเรา</a></div>
                    </li>
                    <?php
                        if(!isset($_SESSION["Username"])){
                        echo '<li class="nav-item" role="presentation"><a class="nav-link" href="Login.php" style="color:rgba(255,255,255,0.5);">ลงชื่อเข้าใช้</a></li>';
                        }else{
                            echo '<li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="UserManage.php" style="color:rgba(252,252,252,0.61);">'.$_SESSION['Username'].'</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="UserManage.php">ดูข้อมูลผู้ใช้</a><a class="dropdown-item" role="presentation" href="Logout.php">ออกจากระบบ</a></div>
                            </li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="contact-clean">
        <form method="post">
            <h2 class="text-center">สมัครเป็นสมาชิกกับเรา</h2>
            <div class="form-group"><input class="form-control" type="text" name="Username" placeholder="Username" style="width:100%;"></div>
            <div class="form-group"><input class="form-control" type="password" name="Pass" placeholder="Password" style="width:100%;"></div>
            <div class="form-group"><button class="btn btn-primary" type="submit" name="submit" style="width:100%;"> ลงทะเบียน </button></div>
            <?php 
        if(isset($_REQUEST['submit'])){
            $nameuser = $_REQUEST['Username'];
            $pass = $_REQUEST['Pass'];

            if($nameuser == "" || $pass == ""){
                echo '<center><p style = "color: red;"> * กรุณากรอกข้อมูลให้ครบ <p></center>';
            }else{
                mysqli_query($conn," INSERT INTO userinfo(Username, Pass)
                        VALUE ('$nameuser', '$pass') ");
            
                echo '<center><h3 style = "color: green;"> ลงทะเบียนสำเร็จ <h3></center>';
                echo '<center><a href="Login.php"> กลับสู่หน้าลงชื่อเข้าใช้ <p></center>';
            }
        
        }
    ?>
        </form>
    </div>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-animation.js"></script>
</body>

</html>