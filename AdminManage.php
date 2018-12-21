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
        
    }
    else{
        header("Location: Login.php");
    }




    // ADMIN ACTION
    if(isset($_REQUEST['accept'])){
        $LC_ID = $_REQUEST['LC_ID'];

        $sqlLC = " SELECT * FROM letcar WHERE LC_ID = '$LC_ID' ";
        $resultLC = mysqli_query($conn, $sqlLC) or die("Bad Query: $sqlLC");
        $rowLC = mysqli_fetch_array($resultLC);

        $CarName = $rowLC['LC_CarName'];
        $CarSeat = $rowLC['LC_CarSeat'];
        $CarDoor = $rowLC['LC_CarDoor'];
        $CarGear = $rowLC['LC_CarGear'];
        $CarYear = $rowLC['LC_CarYear'];
        $CarCost = $rowLC['LC_CarCost'];
        $DriverService = $rowLC['LC_DriverService'];
        if($DriverService == "ไม่ต้องการ"){
            $DriverService = "ไม่มี";
        }else{
            $DriverService = "มี";
        }
        $CarPic = $rowLC['LC_CarPic'];
        $CarLoca = $rowLC['LC_CarLoca'];
        $Username = $rowLC['Username'];

        mysqli_query($conn," INSERT INTO carinfo(CarName, CarSeat, CarDoor, CarGear, 
        CarYear, CarCost, DriverService, CarPic, CarLoca, Username )
        VALUE ('$CarName', '$CarSeat', '$CarDoor', '$CarGear',
                '$CarYear', '$CarCost', '$DriverService', '$CarPic', '$CarLoca', '$Username') ");

        mysqli_query($conn," DELETE FROM letcar WHERE LC_ID = '$LC_ID' ");

    }else if(isset($_REQUEST['notaccept'])){

        $LC_ID = $_REQUEST['LC_ID'];
        mysqli_query($conn," DELETE FROM letcar WHERE LC_ID = '$LC_ID' ");

    }else if(isset($_REQUEST['acceptDriver'])){
        $LD_ID = $_REQUEST['LD_ID'];

        $sqlLD = " SELECT * FROM letcar WHERE LC_ID = '$LC_ID' ";
        $resultLD = mysqli_query($conn, $sqlLD) or die("Bad Query: $sqlLD");
        $rowLD = mysqli_fetch_array($resultLD);

        $LD_Firstname = $rowLD['LD_Firstname'];
        $LD_Lastname = $rowLD['LD_Lastname'];
        $LD_Age = $rowLD['LD_Age'];
        $LD_Tel = $rowLD['LD_Tel'];
        $LD_Pic = $rowLD['LD_Pic'];
        $LD_Loca = $rowLD['LD_Loca'];
        $Username = $rowLD['Username'];

        mysqli_query($conn," INSERT INTO driverinfo(D_Firstname, D_Lastname, D_Age, D_Tel, 
        Pic, D_Loca, Username)
        VALUE ('$LD_Firstname', '$LD_Lastname', '$LD_Age', '$LD_Tel',
                '$LD_Pic', '$LD_Loca' , '$Username') ");

        mysqli_query($conn," DELETE FROM letdriver WHERE LD_ID = '$LD_ID' ");

    
    }else if(isset($_REQUEST['notacceptDriver'])){
        $LD_ID = $_REQUEST['LD_ID'];
        mysqli_query($conn," DELETE FROM letdriver WHERE LD_ID = '$LD_ID' ");
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
                        echo '<li class="nav-item" role="presentation"><a class="nav-link" href="Login.php" style="color:rgba(255,255,255,0.5);">ลงชื่อเข้าใช้</a></li>';
                        }else if($_SESSION["Username"] == "admin" && $_SESSION["Pass"] == "admin"){
                            echo '<li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="AdminManage.php" style="color:#ffffff;">'.$_SESSION['Username'].'</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="AdminManage.php">จัดการเว็บไซต์</a><a class="dropdown-item" role="presentation" href="Logout.php">ออกจากระบบ</a></div>
                            </li>';
                        }
                        else{
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
            <h2 id="htext">รายการรถที่ถูกจองทั้งหมด</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>รหัสการจอง</th>
                            <th>ชื่อผู้จอง</th>
                            <th>ชื่อผู้ใช้ในระบบ</th>
                            <th>เบอร์ติดต่อ</th>
                            <th>รถยี่ห้อ</th>
                            <th>สถานที่รับรถ</th>
                            <th>วันรับรถ</th>
                            <th>วันส่งรถ</th>
                            <th>จำนวนเงินที่ต้องชำระ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = " SELECT * FROM bookinfo JOIN carinfo ON  bookinfo.CarID = carinfo.CarID ";
                        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
                        if($result){
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                   echo '<tr>
                                        <td>'.$row['BookID'].'</td>
                                        <td>' .$row['B_Firstname'].' '.$row['B_Lastname'].'</td>
                                        <td>' .$row['Username'].'</td>
                                        <td> 0'.$row['B_Tel'].'</td>
                                        <td>'.$row['CarName'].'</td>
                                        <td>'.$row['B_CarLoca'].'</td>
                                        <td>'.$row['B_DateStart'].'</td>
                                        <td>'.$row['B_DateEnd'].'</td>
                                        <td>THB '.$row['B_Cost'].'</td>
                                    </tr>';
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section id="headtext2" style="background-color:#fffbef;">
        <div>
            <h2 id="htext">คำขอปล่อยรถ</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ชื่อผู้ขอ</th>
                            <th>เบอร์ติดต่อ</th>
                            <th>รถยี่ห้อ</th>
                            <th>ปีที่ออกทะเบียน</th>
                            <th>สถานที่ให้บริการ</th>
                            <th>รูปแบบบริการ</th>
                            <th>รูปรถ</th>
                            <th>ราคาที่คาดหวัง(ต่อวัน)</th>
                            <th>อนุมัติ</th>
                            <th>ไม่อนุมัติ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = " SELECT * FROM letCar ";
                        $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
                        if($result){
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                       echo ' <tr>
                                <td>'.$row['LC_Firstname'].' '.$row['LC_Lastname'].'</td>
                                <td>0'.$row['LC_Tel'].'</td>
                                <td>'.$row['LC_CarName'].'</td>
                                <td>'.$row['LC_CarYear'].'</td>
                                <td>'.$row['LC_CarLoca'].'</td>
                                <td>'.$row['LC_DriverService'].'</td>
                                <td><a href="'.$row['LC_CarPic'].'">ดูข้อมูล</a></td>
                                <td>THB '.$row['LC_CarCost'].'</td>
                                <td><form method="post"><button type="submit" name="accept" style="width:100%;"> อนุมัติ </button>  <input type="hidden" name="LC_ID" value="'.$row['LC_ID'].'"/></form></td>
                                <td><form method="post"><button type="submit" name="notaccept" style="width:100%;"> ไม่อนุมัติ </button>  <input type="hidden" name="LC_ID" value="'.$row['LC_ID'].'"/></form></td>
                            </tr>' ;
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <section id="headtext2">
        <div>
            <h2 id="htext">คำขอสมัครเป็นคนขับรถ</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>รหัสคำขอสมัครเป็นคนขับรถ</th>
                            <th>ชื่อผู้สมัคร</th>
                            <th>เบอร์ติดต่อ</th>
                            <th>จังหวัดที่สามารถทำงานได้</th>
                            <th>ระบบเกียร์ที่สามารถขับได้</th>
                            <th>ดูข้อมูลบัตรประชาชน</th>
                            <th>อนุมัติ</th>
                            <th>ไม่อนุมัติ</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                     $sql = " SELECT * FROM letdriver ";
                     $result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
                     if($result){
                         while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                       echo ' <tr>
                            <td>'.$row['LD_ID'].'</td>
                            <td>'.$row['LD_Firstname'].' '.$row['LD_Lastname'].'</td>
                            <td>'.$row['LD_Tel'].'</td>
                            <td>'.$row['LD_Loca'].'</td>
                            <td>'.$row['LD_Gear'].'</td>
                            <td><a href="'.$row['LD_Pic'].'">ดูข้อมูล</a></td>
                            <td><form method="post"><button type="submit" name="acceptDriver" style="width:100%;"> อนุมัติ </button>  <input type="hidden" name="LD_ID" value="'.$row['LD_ID'].'"/></form></td>
                                <td><form method="post"><button type="submit" name="notacceptDriver" style="width:100%;"> ไม่อนุมัติ </button>  <input type="hidden" name="LD_ID" value="'.$row['LD_ID'].'"/></form></td>
                          
                        </tr> ' ;
                         }
                    }     
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>