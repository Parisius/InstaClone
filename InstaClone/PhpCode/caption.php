<?php

$conn = mysqli_connect("localhost", "root", "root");
mysqli_select_db($conn,"printstagram") or die(mysql_error());
if(isset($_GET['pid'])) {
$sql = "SELECT caption FROM photo WHERE pid=" . $_GET['pid'];
$result = mysql_query($conn,"$sql") or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
$row = mysql_fetch_array($result);
//header("content-type: image/jpeg");
echo $row["caption"];
}
mysqli_close($conn);
?>