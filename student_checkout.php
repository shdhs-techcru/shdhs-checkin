<style>  body{background-image: url('blankpagekiosk.png'); no-repeat center center fixed; background-size:1920PX 1080PX} 
.button {
  background-color: #16284c;
  border-radius: 96PX;
  border: 2PX solid #FFFFFF;
  color: #FFFFFF;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 32px;
  margin: 4px 2px;
  cursor: pointer;
}
.text{
    color: #FFFFFF;
}
</style>
<div class="text">
<?php

session_start();
include 'config.php';

$studId = $_SESSION["studId"];
//$timeStamp = $_SESSION['timestamp'];
$timeStamp = $_SESSION["timestamp"];

/*$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
  */  


$sql="INSERT INTO logOutLogger (timeLog, studentId) VALUES ('$timeStamp', '$studId');"; 
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
/*
}} else {
    echo "0 results";
}
}*/
echo "Please confirm that you have turned in a note before you leave.";
echo $studId;
echo $timeStamp;

mysqli_close($conn);

session_destroy();

?>
<h1>
Check out successful
</h1>
</div>
<script>
  function goHome(){
    window.location = 'http://sdlc.tech.shdhs.local/project/index.php';
  }
 // setTimeout(goHome, 10000);
</script>