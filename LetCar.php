<?php

session_start();
if(!isset($_SESSION['Username'])){
    header("Location: Login.php");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "finecar";

$conn = mysqli_connect($servername, $username, $password, $dbName);
mysqli_set_charset($conn, "utf8");


// Action ตอนกดปุ่ม
if(isset($_REQUEST['submit'])){
    $LC_Firstname = $_REQUEST['LC_Firstname'];
    $LC_Lastname = $_REQUEST['LC_Lastname'];
    $LC_CID = $_REQUEST['LC_CID'];
    $LC_Tel = $_REQUEST['LC_Tel'];
    $LC_CarName = $_REQUEST['LC_CarName'];
    $LC_CarYear = $_REQUEST['LC_CarYear'];
    $LC_CarSeat = $_REQUEST['LC_CarSeat'];
    $LC_CarDoor = $_REQUEST['LC_CarDoor'];
    $LC_CarGear = $_REQUEST['LC_CarGear'];
    $LC_DriverService = $_REQUEST['LC_DriverService'];
    $LC_CarInfo = $_REQUEST['LC_CarInfo'];
    $LC_CarLoca = $_REQUEST['LC_CarLoca'];
    $LC_CarCost = $_REQUEST['LC_CarCost'];
    $Username = $_SESSION['Username'];

    // Upload Img ID Card
    $extID = pathinfo(basename($_FILES['LC_CarPic']['name']), PATHINFO_EXTENSION); // ดึงนามสกุลไฟล์
    $new_imgID_name = 'carreq_'.uniqid().".".$extID;
    $imgID_path = "CarImg/ReqCar/";
    $uploadID_path = $imgID_path.$new_imgID_name;
    //Uploadding
    move_uploaded_file($_FILES['LC_CarPic']['tmp_name'],$uploadID_path);
    $LC_CarPic = $uploadID_path;



    mysqli_query($conn," INSERT INTO letcar(LC_Firstname, LC_Lastname,LC_CID, LC_Tel, LC_CarName, LC_CarYear, LC_CarSeat,
                LC_CarDoor, LC_CarGear, LC_CarPic, LC_DriverService, LC_CarInfo, LC_CarLoca, LC_CarCost ,Username)
    VALUE ('$LC_Firstname','$LC_Lastname' , '$LC_CID', '$LC_Tel', '$LC_CarName', '$LC_CarYear', '$LC_CarSeat',
            '$LC_CarDoor', '$LC_CarGear', '$LC_CarPic', '$LC_DriverService', '$LC_CarInfo','$LC_CarLoca', '$LC_CarCost', '$Username') ");


}




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
<div class="contact-clean" style="background-image:url(&quot;assets/img/Wallpaper/pexels-photo-1231643.jpeg&quot;);background-size:cover;">
    <nav class="navbar navbar-light navbar-expand-md fixed-top" style="background-color:rgba(0,0,0,0.49);color:rgba(0,0,0,0);">
        <div class="container-fluid"><a class="navbar-brand text-uppercase" href="index.php" style="background-color:rgba(72,167,255,0);color:rgba(255,255,255,0.9);font-family:Armata, sans-serif;"><i class="fa fa-road" style="font-size:23px;"></i>&nbsp;Fine Cars</a><button class="navbar-toggler"
                data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="navcol-1" style="color:rgb(255,255,255);">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php" style="color:rgba(255,255,255,0.52);">หน้าแรก</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="SearchCar.php" style="color:rgba(255,255,255,0.52);background-color:rgba(255,255,255,0);">ค้นหารถเช่า</a></li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="color:#ffffff;">ปล่อยรถเช่า</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="LetCar.php">ปล่อยรถเช่าของคุณ</a><a class="dropdown-item" role="presentation" href="LetDriver.php">สมัครเป็นคนขับกับเรา</a></div>
                    </li>
                    <?php
                        if(!isset($_SESSION["Username"])){
                        echo '<li class="nav-item" role="presentation"><a class="nav-link" href="Login.php" style="color:rgba(255,255,255,0.5);">ลงชื่อเข้าใช้</a></li>';
                        }else if($_SESSION["Username"] == "admin" && $_SESSION["Pass"] == "admin"){
                            echo '<li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="AdminManage.php" style="color:rgba(255,255,255,0.5);">'.$_SESSION['Username'].'</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="AdminManage.php">จัดการเว็บไซต์</a><a class="dropdown-item" role="presentation" href="Logout.php">ออกจากระบบ</a></div>
                            </li>';
                        }
                        else{
                            echo '<li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="UserManage.php" style="color:rgba(255,255,255,0.5);">'.$_SESSION['Username'].'</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="UserManage.php">ดูข้อมูลผู้ใช้</a><a class="dropdown-item" role="presentation" href="Logout.php">ออกจากระบบ</a></div>
                            </li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
        <form method="post"  enctype="multipart/form-data" style="background-color:rgba(244,244,244,0.93);" >
            <h2 class="text-center">ปล่อยรถเช่าของคุณ</h2>
            <div class="form-group"><input class="form-control" type="text" name="LC_Firstname" placeholder="ชื่อ ผู้ปล่อยเช่า" style="width:100%;"></div>
            <div class="form-group"><input class="form-control" type="text" name="LC_Lastname" placeholder="สกุล ผู้ปล่อยเช่า" style="width:100%;"></div>
            <div class="form-group"><input class="form-control" type="text" name="LC_CID" placeholder="เลขบัตรประชาชน" style="width:100%;"></div>
            <div class="form-group"><input class="form-control" type="text" name="LC_Tel" placeholder="เบอร์ที่สามารถติดต่อได้" style="width:100%;"></div>
            <div class="form-group"><input class="form-control" type="text" name="LC_CarName" placeholder="ยี่ห้อรถ" style="width:100%;"></div>
            <div class="form-group"><input class="form-control" type="text" name="LC_CarYear" placeholder="ปีที่ออกทะเบียน" style="width:100%;"></div>
            <div class="form-group"><label>สถานที่ที่ต้องการให้บริการ</label><select class="form-control" name = "LC_CarLoca" style="width:100%;"><option value="Bangkok">Bangkok</option><option value="Phitsanulok">Phitsanulok</option><option value="Khon Kaen">Khon Kaen</option><option value="Chiang Mai">Chiang Mai</option></select></div>
            <div class="form-group"><label>จำนวนที่นั้ง</label><select class="form-control" name = "LC_CarSeat" style="width:100%;"><option value="2">2 ที่นั้ง</option><option value="3">3 ที่นั้ง</option><option value="4">4 ที่นั้ง</option><option value="5">5 ที่นั้ง</option><option value="5 +">5 ที่นั้ง +</option></select></div>
            <div
                class="form-group"><label>จำนวนประตู</label><select class="form-control" name = "LC_CarDoor" style="width:100%;"><option value="2">2 ประตู</option><option value="3">3 ประตู</option><option value="4">4 ประตู</option><option value="5">5 ประตู</option><option value="5 +">5 ประตู +</option></select></div>
    <div
        class="form-group"><label>ประเภทเกียร์</label><select class="form-control" name = "LC_CarGear" style="width:100%;"><option value="Automatic">Automatic</option><option value="Manual">Manual</option></select></div>
        <div class="form-group"><label>รูปรถของคุณ &nbsp;</label><input type="file" name = "LC_CarPic"></div>
        <div class="form-group"><textarea class="form-control" rows="14" name="LC_CarInfo" placeholder="ข้อมูลเพิ่มเติม" style="width:100%;"></textarea></div>
        <div class="form-group"><input class="form-control" type="text" name="LC_CarCost" placeholder="ราคาที่คาดหวัง(ต่อวัน)" style="width:100%;"></div>
        <div class="form-group"><label>ต้องการปล่อยรถพร้อมคนขับไหม</label><select class="form-control" name="LC_DriverService" style="width:100%;"><option value="ไม่ต้องการ">ไม่ต้องการ</option><option value="ต้องการเป็นคนขับเอง">ต้องการเป็นคนขับเอง</option><option value="สามารถให้หาคนขับแทนได้">สามารถให้หาคนขับแทนได้</option></select></div>
        <div class="form-group"><button class="btn btn-primary" type="submit" name="submit" style="width:100%;">send </button></div>
        </form>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-animation.js"></script>
</body>

</html>