<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css">
<meta http-equiv="refresh" content="300;url=logout.php" />
<title>Student Verification</title>
</head>
<body>
<div >
<a href="http://sdlc.tech.shdhs.local/project/index.php">
  <img src="back-button.png" style="width:100px;height:100px;">
</a>
</div>
<div class="all">
<div class="studentINFO">
<?php
session_start();
include 'config.php';
//POST
// $password   =   $_POST['password']; //Password will not be used (Just for sample) 
$input = $_POST['studentID'];


$sql = "SELECT studentID, studentEmail, studentFirst, studentLast FROM student WHERE studentID = '$input' OR studentEmail = '$input';";

$result = mysqli_query($conn, $sql);
date_default_timezone_set('America/New York');
$_SESSION['timestamp'] = date('Y-m-d G:i:s', time());


    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION['studId'] = $row['studentID'];
            echo $row["studentEmail"]. "<br>"; 
            echo $row["studentFirst"]. " ".$row["studentLast"]. "<br>";
        }  
    }else {
        mysqli_close($conn); 
        echo "0 Results, Redirecting . . .";
        //sleep(20);
        
        header("Location: http://sdlc.tech.shdhs.local/project/student_login.php"); 
        exit();

    }


$_SESSION['studPic'] = 'http:/project/images/students/'.$_SESSION['studId'].'.bmp';

//echo "   " . $timeStamp . "\n" . $studId;
mysqli_close($conn); 

?>
<img src='<?php
session_start();
echo $_SESSION['studPic'];
?>'
style="width:80px;height:112px;">
</div>
<div>
<button class="checkinbutton" onclick="window.location.href = '/project/student_checkin.php';">Check In</button>
<button class="checkoutbutton" onclick="window.location.href = '/project/student_checkout.php';">Check Out</button>

</div>
</body>
</html>