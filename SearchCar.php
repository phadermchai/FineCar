<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "finecar";

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

<body style="padding-top:0px;background-image:url(&quot;assets/img/Wallpaper/wallpaperSearch.jpg&quot;);width:100%;background-size:cover;height:100%;">
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
    <section id="SearchBar">
        <div class="SerchSect" style="background-color:rgba(0,0,0,0.1);"></div>
    </section>
    <section></section>
    <div class="projects-horizontal" style="background-color:rgba(4,10,9,0.75);">
        <div class="container">
            <div class="intro">
                <h2 class="text-center" style="color:rgb(255,255,255);background-color:rgba(0,255,209,0.33); padding-top:10px;">ค้นหารถเช่าของคุณ</h2>
            </div>
			<form method="post" enctype="multipart/form-data">
			    <center><p style = "color:#ffffff;">- สถานที่รับรถ -</p></center>
			    <center><div class="form-group"><select class="form-control d-inline" name = "Car_Loca"style="width:15%; display:inline;"><option value="All">ทั้งหมด</option><option value="Bangkok">Bangkok</option><option value="Phitsanulok">Phitsanulok</option><option value="Khon Kaen">Khon Kaen</option><option value="Chiang Mai">Chiang Mai</option></select></div>
                <div class="form-group"><button class="btn btn-primary d-inline" type="submit" name = "submit" style="width:10%;">ค้นหา</button></div></center>
			</form>
 

            <div class="row projects">
            <?php
                    
					if(isset($_REQUEST['submit'])){
						$Loca = $_REQUEST['Car_Loca'];
					
						if($Loca != 'All'){
							$sql = "SELECT * from carinfo WHERE CarLoca = '$Loca' ";
						}
						else{
							$sql = "SELECT * from carinfo";
                        }

						// Create connection
						$conn = mysqli_connect($servername, $username, $password, $dbName);

						// Check connection
						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}
						//echo "Connected successfully";
						
						//$sqlLD = " SELECT * FROM letcar WHERE LC_ID = '$LC_ID' ";
						//$resultLD = mysqli_query($conn, $sqlLD) or die("Bad Query: $sqlLD");
						//$rowLD = mysqli_fetch_array($resultLD);

						mysqli_set_charset($conn, "utf8");

						$result = mysqli_query($conn,$sql);
						if($result){
							while($record = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								
							   echo' <div class="col-sm-6 item">
											<div class="row">
												<div class="col-md-12 col-lg-5"><a href="CarDetail.php?ID='.$record["CarID"].'"><img class="img-fluid" src="'.$record["CarPic"].'"></a></div>
												<div class="col">
													<h3 class="name" style="font-size:30px;color:rgb(255,255,255);"> '.$record["CarName"].'
													<br></h3>
													<p class="description" style="color:rgb(255,255,255);">&nbsp;<i class="fa fa-map-marker"></i>&nbsp;'.$record["CarLoca"].', Thailand</p>
													<p class="description" style="color:rgb(255,255,255);">&nbsp;'.$record["CarSeat"].' ที่นั่ง | '.$record["CarDoor"].' ประตู | เกียร์  '.$record["CarGear"].'&nbsp;</p>';
													if($record["DriverService"] == "มี"){
													   echo '<p class="description" style="background-color:rgba(30,0,0,0.51);color:rgb(0,224,255);">* '.$record["DriverService"].'บริการพร้อมคนขับ</p>';
													}
													
											 echo   '</div>
											</div>
										</div>';
							}
						}else{
							echo"ไม่พบฐานข้อมูล";
						}
					}else{
                        $sql = "SELECT * from carinfo";
                        $conn = mysqli_connect($servername, $username, $password, $dbName);
                        mysqli_set_charset($conn, "utf8");
                        $result = mysqli_query($conn,$sql);
						if($result){
							while($record = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								
							   echo' <div class="col-sm-6 item">
											<div class="row">
												<div class="col-md-12 col-lg-5"><a href="CarDetail.php?ID='.$record["CarID"].'"><img class="img-fluid" src="'.$record["CarPic"].'"></a></div>
												<div class="col">
													<h3 class="name" style="font-size:30px;color:rgb(255,255,255);"> '.$record["CarName"].'
													<br></h3>
													<p class="description" style="color:rgb(255,255,255);">&nbsp;<i class="fa fa-map-marker"></i>&nbsp;'.$record["CarLoca"].', Thailand</p>
													<p class="description" style="color:rgb(255,255,255);">&nbsp;'.$record["CarSeat"].' ที่นั่ง | '.$record["CarDoor"].' ประตู | เกียร์  '.$record["CarGear"].'&nbsp;</p>';
													if($record["DriverService"] == "มี"){
													   echo '<p class="description" style="background-color:rgba(30,0,0,0.51);color:rgb(0,224,255);">* '.$record["DriverService"].'บริการพร้อมคนขับ</p>';
													}
													
											 echo   '</div>
											</div>
										</div>';
							}
						}else{
							echo"ไม่พบฐานข้อมูล";
						}
                        
                    }
                    ?>
            </div>
            
           

        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>