<?php
    session_start();
    $Username = $_SESSION["Username"];
    if(isset($_SESSION["Username"])){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "finecar";

        $conn = mysqli_connect($servername, $username, $password, $dbName);
        mysqli_set_charset($conn, "utf8");

        //$B_different = strtotime($row['B_DateEnd']) - strtotime($row['B_DateStart']);
        //$DayRent = floor($B_different/(60*60*24));

        //$sqlCar = " SELECT * FROM CarInfo WHERE CarID = ".$row['CarID']." ";
        //$resultCar = mysqli_query($conn, $sqlCar) or die("Bad Query: $sqlCar");
        //$rowCar = mysqli_fetch_array($resultCar);

        //$sqlDriver = " SELECT * FROM DriverInfo WHERE DriverID = ".$row['DriverID']." ";
        //$resultDriver = mysqli_query($conn, $sqlDriver) or die("Bad Query: $sqlDriver");
        //$rowDriver = mysqli_fetch_array($resultDriver);
    }
    else{
        header("Location: Login.php");
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
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php" style="color:rgba(255,255,255,0.52);">หน้าแรก</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="SearchCar.php" style="color:rgba(255,255,255,0.52);background-color:rgba(255,255,255,0);">ค้นหารถเช่า</a></li>
                    <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#" style="color:rgba(252,252,252,0.57);">ปล่อยรถเช่า</a>
                        <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="LetCar.php">ปล่อยรถเช่าของคุณ</a><a class="dropdown-item" role="presentation" href="LetDriver.php">สมัครเป็นคนขับกับเรา</a></div>
                    </li>
                    <?php
                        if(!isset($_SESSION["Username"])){
                        echo '<li class="nav-item" role="presentation"><a class="nav-link" href="Login.php" style="color:#ffffff;">ลงชื่อเข้าใช้</a></li>';
                        }else{
                            echo '<li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="UserManage.php" style="color:#ffffff;">'.$_SESSION['Username'].'</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="UserManage.php">ดูข้อมูลผู้ใช้</a><a class="dropdown-item" role="presentation" href="Logout.php">ออกจากระบบ</a></div>
                            </li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <section id="headtext">
        <div>
            <h2 id="htext"> ออเดอร์การจองรถของคุณ <?php echo $_SESSION["Username"]; ?></h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>รหัสการจอง</th>
                            <th>ชื่อผู้จอง</th>
                            <th>รถยี่ห้อ</th>
                            <th>สถานที่รับรถ</th>
                            <th>วันรับรถ</th>
                            <th>วันส่งรถ</th>
                            <th>จำนวนเงิน</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = " SELECT * FROM bookinfo JOIN carinfo ON carinfo.Username = '$Username' AND bookinfo.CarID = carinfo.CarID ";
                        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
                        if($result){
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                   echo ' <tbody>
                                    <tr>
                                        <td>'.$row['BookID'].'</td>
                                        <td>' .$row['B_Firstname'].' '.$row['B_Lastname'].'</td>
                                        <td>'.$row['CarName'].'</td>
                                        <td>'.$row['B_CarLoca'].'</td>
                                        <td>'.$row['B_DateStart'].'</td>
                                        <td>'.$row['B_DateEnd'].'</td>
                                        <td>THB '.$row['B_Cost'].'</td>
                                    </tr>
                                </tbody> ';
                            }
                        }
                    ?>

                </table>
            </div>
        </div>
    </section>
    
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>