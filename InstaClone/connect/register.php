<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="root"; // Mysql password 
$db_name="printstagram"; // Database name 
$tbl_name="person"; // Table name

$conn =mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,"$db_name")or die("cannot select DB");


$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$username=$_POST['username'];
$password=$_POST['password'];

// To protect MySQL injection 
$firstname = stripslashes($firstname);
$lastname = stripslashes($lastname);
$username = stripslashes($username);
$password = stripslashes($password);
$firstname = mysqli_real_escape_string($conn,$firstname);
$lastname = mysqli_real_escape_string($conn,$lastname);
$username = mysqli_real_escape_string($conn,$username);
$password = mysqli_real_escape_string($conn,$password);

$sql="INSERT INTO $tbl_name (username, password, fname, lname) VALUES ('$username',md5('$password'),'$firstname','$lastname')";

if (mysqli_query($conn, $sql)) 
{
    echo "New record created successfully. Return to the previous page to log in";
} 
else 
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>