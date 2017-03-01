<?php


session_start();

$myusername = $_SESSION['ses_username'];
// echo $myusername;

$conn = mysqli_connect("localhost", "root", "root");
mysqli_select_db($conn,"printstagram");
// echo $_GET['pidrow'];

$pidrow=$_GET['pidrow'];
$commenter=$_POST['commenter']; 
$commenter = stripslashes($commenter);
$commenter = mysqli_real_escape_string($conn,$commenter);
echo $commenter ;echo " ";
echo $pidrow; echo " ";
//$tagger=$SION['ses_tagger'];
//echo $tagger;

$sql = "INSERT INTO comment (pid, ctime, ctext, commenter) VALUES ('$pidrow', CURRENT_TIMESTAMP, '$commenter','$myusername')"; 
$result = mysqli_query($conn,$sql);
if ($result) {?>
<HTML>
<HEAD>

Comment send. Please hit your browser's back button to return to your profile.
<?php }
else
 printf("Error: %s\n", mysqli_error($conn));
?>
</HEAD>
<BODY>

</BODY>
</HTML>