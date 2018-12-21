<?php 

session_start();
if(isset($_SESSION['Username'])){
    $Username = $_SESSION["Username"];
}else{
    header("Location: Login.php");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "finecar";

$conn = mysqli_connect($servername, $username, $password, $dbName);
mysqli_set_charset($conn, "utf8");

if(isset($_GET['ID'])){
	$ID = mysqli_real_escape_string($conn, $_GET['ID']);
	
	//$sql = "SELECT * FROM CarInfo inner join DriverInfo on CarInfo.CarID = DriverInfo.CarID WHERE CarInfo.CarID = '$ID' "  ;
    $sql = "SELECT * FROM carinfo WHERE CarID = '$ID'";
    $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
    $row = mysqli_fetch_array($result);
	
	if(isset($_GET['post'])){
		$carname = mysqli_real_escape_string($conn, $_GET['name']);
	}
}else{
	header('Location: CarDetail-2.php');
}

if(isset($_REQUEST['submit'])){
    $B_CarLoca = $_REQUEST['B_CarLoca'];
    $B_DateStart = $_REQUEST['B_DateStart'];
    $B_DateEnd = $_REQUEST['B_DateEnd'];
    $B_Firstname= $_REQUEST['B_Firstname'];
    $B_Lastname = $_REQUEST['B_Lastname'];
    $B_Tel = $_REQUEST['B_Tel'];
    $DriverID = $_REQUEST['DriverID'];
    $CarID = $row['CarID'];
    
    // Upload Img ID Card
    $extID = pathinfo(basename($_FILES['B_FileIDCard']['name']), PATHINFO_EXTENSION); // ดึงนามสกุลไฟล์
    $new_imgID_name = 'idcard_'.uniqid().".".$extID;
    $imgID_path = "CardInfoImg/ID_Card/";
    $uploadID_path = $imgID_path.$new_imgID_name;
    //Uploadding
    move_uploaded_file($_FILES['B_FileIDCard']['tmp_name'],$uploadID_path);
    $B_FileIDCard = $uploadID_path;

     // Upload Img Driver Card
     $extD = pathinfo(basename($_FILES['B_FileDCard']['name']), PATHINFO_EXTENSION); // ดึงนามสกุลไฟล์
     $new_imgD_name = 'dcard_'.uniqid().".".$extD;
     $imgD_path = "CardInfoImg/D_Card/";
     $uploadD_path = $imgD_path.$new_imgD_name;
     //Uploadding
     move_uploaded_file($_FILES['B_FileDCard']['tmp_name'],$uploadD_path);
     $B_FileDCard = $uploadD_path;

    // Show Data
    
    // Cal Cost
    $B_different = strtotime($B_DateEnd) - strtotime($B_DateStart);
    //echo 'Day = ' .floor($B_different/(60*60*24));
    //echo 'Cost = '.floor($B_different/(60*60*24)) * $row['CarCost'];
    $B_CarCost = floor($B_different/(60*60*24)) * $row['CarCost'];

    mysqli_query($conn," INSERT INTO bookinfo(B_DateStart, B_DateEnd, B_Firstname, B_Lastname, 
                B_CarLoca, B_Cost, CarID, DriverID, B_Tel, B_FileIDCard, B_FileDCard, Username)
                VALUE ('$B_DateStart', '$B_DateEnd', '$B_Firstname', '$B_Lastname',
                        '$B_CarLoca', '$B_CarCost', '$CarID', '$DriverID', '$B_Tel', '$B_FileIDCard'
                        ,'$B_FileDCard', '$Username') ");
    //header('Location: CarDetail-3.php?ID='.$CarID);
    header('Location: CarDetail-3.php');
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
        <div class="container-fluid"><a class="navbar-brand text-uppercase" href="index.php" style="background-color:rgba(72,167,255,0);color:#ffffff;;font-family:Armata, sans-serif;"><i class="fa fa-road" style="font-size:23px;"></i>&nbsp;Fine Cars</a><button class="navbar-toggler"
                data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end" id="navcol-1" style="color:rgb(255,255,255);">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php" style="color:rgba(255,255,255,0.5);">หน้าแรก</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="SearchCar.php" style="color:#ffffff;">ค้นหารถเช่า</a></li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="color:rgba(252,252,252,0.57);">ปล่อยรถเช่า</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="LetCar.php">ปล่อยรถเช่าของคุณ</a><a class="dropdown-item" role="presentation" href="LetDriver.php">สมัครเป็นคนขับกับเรา</a></div>
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
    
    
    <div id="CarDetailPage2">
        <div class="container">
            <div class="row">
                <div class="col-md-6" id="ColDe">
                    <div>
                        <div class="card-group">
                            <?php echo '<div class="card"><img class="card-img-top w-100 d-block" src="'.$row['CarPic'].'">'; ?>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $row['CarName'] ?><br></h4>
                                    <p class="card-text"><?php echo $row['CarLoca'] ?>, Thailand<br></p>
                                    <p class="card-text">&nbsp;<?php echo $row['CarSeat'] ?> ที่นั่ง | <?php echo $row['CarDoor'] ?> ประตู | เกียร์ <?php echo $row['CarGear'] ?>&nbsp;<br></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br></br></br></br></br>
                    <div style="background-color:#edf3ff; padding:20px;">
                       <h2 class="text-center">ราคารถเช่า</h2>
                        <p style="font-size:25px;">ค่าเช่ารถต่อวัน &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; THB <?php echo $row['CarCost']; ?> </p>
                        <p style="font-size:25px;">ค่าบริการคนขับ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; THB 200</p>
                    </div>
                </div>
                
                
    <div class="col-md-6">
        <form method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <h2 class="text-center">รายละเอียดการเช่ารถ</h2>
                        </div>
                        <div class="form-group">
                            <p>สถานที่รับรถ</p><select name="B_CarLoca" class="form-control" style="width:100%;">
                            <?php
                            $CarLoca = $row['CarLoca'];
                             $sql3 = " SELECT * FROM sublocationlist WHERE CarLoca = '$CarLoca' " ;
                             $result3 = mysqli_query($conn, $sql3) or die("Bad Query: $sql3");
                             if($result3){
                                while($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)){  
                                echo '<option value="'.$row3['SubList'].'" >'.$row3['SubList'].'</option>';
                                }
                            }
                            ?>
                            </select></div>
                        <div
                            class="form-group">
                            <p>ระยะเวลาในการเช่า</p><input name="B_DateStart" class="form-control d-inline" type="date" style="width:47%;"><input name="B_DateEnd" class="form-control d-inline" type="date" style="width:47%;"></div>
                <div class="form-group"><label class="d-block">รายละเอียดผู้เช่ารถ</label><input name="B_Firstname" class="form-control d-inline" type="text" placeholder="ชื่อผู้เช่า" style="width:45%;"><input name="B_Lastname" class="form-control d-inline" type="text" placeholder="สกุลผู้เช่า" style="width:45%;"></div>
                <div
                    class="form-group"><input name="B_Tel" class="form-control d-inline" type="text" placeholder="เบอร์โทรศัพท์" style="width:92%;"></div>
            <div class="form-group"><label class="d-block">เอกสารสำคัญ</label><input type="file" name="B_FileIDCard"><label>บัตรประชาชน</label><input type="file" name="B_FileDCard"><label>ใบขับขี่</label></div>
        
                        <div class="form-group">
                            <section class="card-section-imagia">
                                <h1>เลือกคนขับของคุณ</h1>
                                <div class="container">
                                    <div class="form-row">
                                    <?php 
                                        $sql2 = "SELECT * FROM driverinfo WHERE D_Loca = '$row[CarLoca]'";
                                        $result2 = mysqli_query($conn, $sql2) or die("Bad Query: $sql2"); 
                                        if($row['DriverService'] == "มี"){
                                            if($result2){
                                                while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                                            echo '
                                            <div class="col-sm-6 col-md-4">
                                            <div class="form-check"><input name = "DriverID" class="form-check-input" type="checkbox" id="formCheck-1" value="'.$row2['DriverID'].'"><label class="form-check-label" for="formCheck-1">เลือก</label></div>
                                                <div class="card-container-imagia">
                                                    <div class="card-imagia">
                                                        <div class="front-imagia">
                                                            <div class="cover-imagia"><img src="https://unsplash.it/720/500?image=1067" alt=""></div>
                                                            <div class="user-imagia"><img src="https://unsplash.it/120/120?image=64" class="img-circle" alt=""></div>
                                                            <div class="content-imagia">
                                                                <h4 class="name-imagia"> '.$row2['D_Firstname'].' '.$row2['D_Lastname'].' </h4>
                                                                <p class="subtitle-imagia">Driver </p>
                                                                <p class="text-center"><em> อายุ : '.$row2['D_Age'].' </br>  Tel : '.$row2['D_Tel'].' </em></p>
                                                            </div>
                                                            <div class="footer-imagia"></div>
                                                        </div>
                                                        <div class="back-imagia">
                                                            <div class="content-imagia content-back-imagia">
                                                                <div>
                                                                    <h4 class="text-center">'.$row2['D_Firstname'].' '.$row2['D_Lastname'].' </h4>
                                                                    <p class="text-center"> Driver ID : '.$row2['DriverID'].' </br> อายุ : '.$row2['D_Age'].' </br> Tel : '.$row2['D_Tel'].'</p>
                                                                </div>
                                                            </div>
                        
                                                        </div>
                                                    </div>
                                        </div>
                                    </div> ';
                                    }}
                                
                }
                                    
            ?>
                </section>
            </div>
            <div class="form-group"><input type = "submit" value="ถัดไป" name = "submit" href="CarDetail-3.php?ID=<?php $row['CarID']?>" style="width:100%; height:40px;  background-color:#2377ff; color: #ffffff;"; /></div>
            </form>
        </div>
    </div>
    </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>


    
</body>

</html>




