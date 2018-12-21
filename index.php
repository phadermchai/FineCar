<?php 

session_start();

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
                        }else if($_SESSION["Username"] == "admin" && $_SESSION["Pass"] == "admin"){
                            echo '<li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="AdminManage.php" style="color:rgba(252,252,252,0.61);">'.$_SESSION['Username'].'</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="AdminManage.php">จัดการเว็บไซต์</a><a class="dropdown-item" role="presentation" href="Logout.php">ออกจากระบบ</a></div>
                            </li>';
                        }
                        else{
                            echo '<li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="UserManage.php" style="color:rgba(252,252,252,0.61);">'.$_SESSION['Username'].'</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="UserManage.php">ดูข้อมูลผู้ใช้</a><a class="dropdown-item" role="presentation" href="Logout.php">ออกจากระบบ</a></div>
                            </li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <section class="IntroHead" action = "SearchCar.php">
        <div id="SearchSec" style="margin-top:-31px;">
            <p class="text-right" style="color:rgb(255,255,255);margin:0px;margin-top:18px;margin-bottom:28px;margin-right:-37px;">สามารถจอง/ติดต่อสอบถาม&nbsp;<i class="fa fa-comment"></i>&nbsp;Line : @finecars | Tel : 055-212224&nbsp;</p>
            <div class="jumbotron" style="background-color:rgba(30,19,37,0.38);">
                <form method = "post"> 
                    <div class="form-group">
                        <h1 style="color:#ffffff;font-size:70px;margin-bottom:18px;">&nbsp;ค้นหารถเช่า&nbsp;</h1>
                        <!-- <p style="color:rgb(255,255,255);"><i class="fa fa-map-marker" style="font-size:19px;"></i>&nbsp;จุดหมายของคุณ</p><select name = "Lacation" class="form-control d-inline"><option value="Bangkok" selected="">Bangkok</option><option value="Phitsanulok">Phitsanulok</option><option value="Khon Kaen">Khon Kaen</option><option value="Chiang Mai">Chiang Mai</option></select></div>-->
                        <p style = "color:#ffffff;">- สามารถเลือกช่วงเวลาในการเช่รถของคุณได้อย่างอิสระ</p>
                        <p style = "color:#ffffff;">- หากรถที่มีบริการพร้อมคนขับคุณสามารถเลือกคนขับได้ด้วยตัวคุณเอง</p>
                        <p style = "color:#ffffff;">- หากคุณมีรถ คุณสามารถปล่อยเช่าเพื่อสร้างรายได้</p>
                        <p style = "color:#ffffff;">- สามารถสมัครเป็นคนขับรถตามเขตบริการต่างๆ</p>
                    <div
                        class="form-group">
            </form>
            <div class="form-group">
                <p><a class="btn btn-primary" role="button" href="SearchCar.php" style="font-size:22px;width:130px;height:48px;margin-top:24px;background-color:rgba(31,80,126,0.67);">ค้นหาเลย</a></p>
            </div>
        </div>
        </div>
    </section>
    <div class="features-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">บริการของเรา</h2>
            </div>
            <div class="row features">
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-map-marker icon"></i>
                    <h3 class="name">เลือกสถานที่รับรถ</h3>
                    <p class="description">สามารถเลือกสถานที่รับรถได้ ตามสถานที่ต่างๆ ของจังหวัดที่คุณต้องการ</p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-clock-o icon"></i>
                    <h3 class="name"><strong>เลือกช่วงเวลา</strong><br></h3>
                    <p class="description">สามารถเลือกช่วงเวลาในการเช่รถของคุณได้อย่างอิสระ<br></p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-list-alt icon"></i>
                    <h3 class="name"><strong>เลือกคนขับของคุณ</strong><br></h3>
                    <p class="description">หากรถที่มีบริการพร้อมคนขับคุณสามารถเลือกคนขับได้ด้วยตัวคุณเอง<br></p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-car icon"></i>
                    <h3 class="name">ปล่อยรถของคุณ</h3>
                    <p class="description">หากคุณมีรถ คุณสามารถปล่อยเช่าเพื่อสร้างรายได้</p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-user-plus icon"></i>
                    <h3 class="name">สมัครเป็นคนขับกับเรา</h3>
                    <p class="description">สามารถสมัครเป็นคนขับรถตามเขตบริการต่างๆ</p>
                </div>
                <div class="col-sm-6 col-lg-4 item"><i class="fa fa-comments-o icon"></i>
                    <h3 class="name">สามารถจองหรือติดต่อสอบถามทางช่องทาง</h3>
                    <p class="description">1. จองผ่านเว็บไซต์ Finecar</p>
                    <p class="description">2. จองผ่านโทรศัพท์: 055-212224</p>
                    <p class="description">3. จองผ่าน Line: @finecars</p>
                </div>
            </div>
        </div>
    </div>
    <section>
        
</a>
</div>
    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
</body>

</html>