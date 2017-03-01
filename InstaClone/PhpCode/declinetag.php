<?php


session_start();


$myusername = $_SESSION['ses_username'];
// echo $myusername;


// echo $_GET['pidrow'];

$pidrow=$_GET['pidrow'];
//$tagger=$_SESSION['ses_tagger'];
//echo $tagger;

$conn = mysqli_connect("localhost", "root", "root");
mysqli_select_db($conn,"printstagram");
$sql = "DELETE from tag WHERE pid=$pidrow AND tstatus=0 AND taggee='$myusername'"; 
$result = mysqli_query($conn,$sql);
?>
<HTML>
<HEAD>
Tag declined. Please hit your browser's back button to return to your profile.
</HEAD>
<BODY>

</BODY>
</HTML>