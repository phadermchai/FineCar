<?php 
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "finecar";

$conn = mysqli_connect($servername, $username, $password, $dbName);
mysqli_set_charset($conn, "utf8");

if(isset($_GET['ID'])){
	$ID = mysqli_real_escape_string($conn, $_GET['ID']);
	
	$sql = "SELECT * FROM carinfo WHERE CarID = '$ID'";
	$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
	$row = mysqli_fetch_array($result);
	
	if(isset($_GET['post'])){
		$carname = mysqli_real_escape_string($conn, $_GET['name']);
	}
}else{
	header('Location: CarDetail-2.php');
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
<nav class="navbar navbar-light navbar-expand-md fixed-top" style="background-color:rgba(0,0,0,0.49);color:rgba(0,0,0,0);">
        <div class="container-fluid"><a class="navbar-brand text-uppercase" href="index.php" style="background-color:rgba(72,167,255,0);color:rgba(255,255,255,0.9);font-family:Armata, sans-serif;"><i class="fa fa-road" style="font-size:23px;"></i>&nbsp;Fine Cars</a><button class="navbar-toggler"
                data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="navcol-1" style="color:rgb(255,255,255);">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php" style="color:rgba(255,255,255,0.52)">หน้าแรก</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="SearchCar.php" style="color:#ffffff;background-color:rgba(255,255,255,0);">ค้นหารถเช่า</a></li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="color:rgba(252,252,252,0.57);">ปล่อยรถเช่า</a>
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
    <?php echo' <div data-bs-parallax-bg="true" style="height:500px;background-image:url(&quot;'.$row['CarPic'].'&quot;);background-position:center;background-size:cover;"></div>' ?>
    <div class="IntroSec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1><?php echo $row['CarName'] ?></h1>
                    <p><i class="fa fa-user"></i>&nbsp;<?php echo $row['CarSeat'] ?> ที่นั่ง | <?php echo $row['CarDoor'] ?> ประตู | <?php echo $row['DriverService'] ?>บริการพร้อมคนขับ</p>
                </div>
                <div class="col-md-6">
                    <p class="text-right"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $row['CarLoca'] ?>, Thailand</p>
                    <h1 class="text-nowrap text-right">THB <?php echo $row['CarCost'] ?> / DAY</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="IntroSec" style="background-color:#edeeff;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 style="font-size:30px;">รายละเอียดของรถ</h1>
                    <p>- จำนวนที่นั่ง : <?php echo $row['CarSeat'] ?> ที่นั่ง</p>
                    <p>- จำนวนประตู : <?php echo $row['CarDoor'] ?> ประตู</p>
                    <p>- ระบบเกียร์ : <?php echo $row['CarGear'] ?></p>
                    <p>- ปีที่ออกทะเบียน : <?php echo $row['CarYear'] ?></p>
                </div>
                <?php
                    echo '<div class="col"><a class="btn btn-primary btn-lg" role="button" href="CarDetail-2.php?ID='.$row["CarID"].'" id="RentBu" style="width:100%;font-size:25px;background-color:rgb(0,165,217);">จองเลย</a></div>';
                ?>
            </div>
        </div>
    </div>
    <section>
        <h1 class="text-center">รีวิวจากลูกค้า</h1>
        <div class="card-group">
            <div class="card"><img class="card-img-top w-100 d-block">
                <div class="card-body">
                    <h4 class="card-title">Username</h4>
                    <p class="card-text">Score: 1-5</p>
                    <p class="card-text">Comment</p>
                </div>
            </div>
            <div class="card"><img class="card-img-top w-100 d-block">
                <div class="card-body">
                    <h4 class="card-title">Username</h4>
                    <p class="card-text">Score: 1-5</p>
                    <p class="card-text">Comment</p>
                </div>
            </div>
            <div class="card"><img class="card-img-top w-100 d-block">
                <div class="card-body">
                    <h4 class="card-title">Username</h4>
                    <p class="card-text">Score: 1-5</p>
                    <p class="card-text">Comment</p>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>