<html>
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
.print{
    color: #4287f5;

}
</style>
<body>
<p style="color:white";>
<?php
session_start();
include 'config.php';
//CHECK_IN
//Receive timestamp and student id?

$studId = $_SESSION["studId"];
$timeStamp = $_SESSION["timestamp"];
$date = date('Y-m-d');
$time = date('G:i:s');

/*



*/

//$sql ="call GET_SLIP($studId, TIME('$time'), DATE('$date'));";    //WIP

$sql = "SELECT s.studentFirst, s.studentLast, c.courseName, sec.classroomNumber, sec.periodName, t.teacherFirst, t.teacherLast 
FROM student s 
    INNER JOIN sectionEnrollment sE ON s.studentId = sE.studentId 
    INNER JOIN section sec ON sec.sectionId=sE.sectionId 
    INNER JOIN teacher t ON t.teacherId=sec.teacherId 
    INNER JOIN course c ON SUBSTRING(sec.courseId,1,6)=SUBSTRING(c.courseId, 1,6) WHERE s.studentId=$studId
AND sec.periodName=(SELECT p.periodName FROM calendarDays cD 
INNER JOIN period p ON cD.calendarId=p.calendarId 
    AND TIME('$time') BETWEEN p.periodBegin 
    AND p.periodEnd 
    AND cD.calendarDate= DATE('$date'));";


$result = mysqli_query($conn, $sql);

//echo "Error: " . "<br>" . $conn->error;   DEBUG

if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
          
        $output ="";
        $output = $row["studentFirst"]. " "; 
        $output .= $row["studentLast"]. "<br>"; 
        $output .= $row["courseName"]. "  "; 
        $output .= $row["classroomNumber"]. "<br>"; 
        $output .= "Period: ".$row["periodName"]. "<br>"; 
        $output .= $row["teacherFirst"]. " "; 
        $output .= $row["teacherLast"]. "<br>";
         
    }

   // echo $output;
   // echo $timeStamp;

    $sql="INSERT INTO logInLogger (timeLog, studentId) VALUES (TIMESTAMP('$timeStamp'), '$studId');"; 
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


} else {
    echo "0 results";
    //echo $sql;
}
    
mysqli_close($conn);


//Display Date, Period, Teacher Name, Student Name, Time?
//Send info to print?
//Send info to csv file about student late?

$_SESSION["output"] = $output;

?>
</p>

<iframe src="http://sdlc.tech.shdhs.local/project/print.php" style="border:0px #ffffff none;" name="myiFrame" scrolling="no" frameborder="1" marginheight="0px" marginwidth="0px" height="400px" width="600px" allowfullscreen></iframe>
<script>
    function goHome(){
    window.location = 'http://sdlc.tech.shdhs.local/project/index.php';
    //alert('Hello');
  }
  setTimeout(goHome, 10000);
</script>
</body>
</html>