 <?php

        session_start();
        $myusername = $_SESSION['ses_username'];

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="root"; // Mysql password 
$db_name="printstagram"; // Database name 
$tbl_name="person"; // Table name 

// Connect to server and select databse.
$conn=mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
mysqli_select_db($conn,"$db_name")or die("cannot select DB");

$mysqli = new mysqli("localhost", "root", "root", "printstagram");
    $description = $_POST['message'];
    $description = stripslashes($description);
    $description = mysqli_real_escape_string($conn,$description);
    $sql="UPDATE person set description = '$description' where username='$myusername' ";
    if (mysqli_query($conn, $sql)) 
    {
    echo "New record created successfully.";
    } 
    else 
    {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);

    ?>