<?php
    session_start();

    $Username = $_POST['Username'];
    $Pass = $_POST['Pass'];

    ob_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "finecar";
    $conn = mysqli_connect($servername, $username, $password, $dbName);

    $query = mysqli_query($conn, "SELECT * FROM userinfo  WHERE Username='$Username' AND Pass = '$Pass'" );
    $num_row = mysqli_num_rows($query); 
    if($num_row == 1){
        $_SESSION["Username"] = $Username;
        $_SESSION["Pass"] = $Pass;
            echo 'Longin Seccess';
        }else{
           echo 'รหัสผิด';
        }
        header("Location: index.php");

    if(!isset($_SESSION["Username"])){
        header("Location: Login.php");
    }
?>