<!DOCTYPE html>
<?php

session_start();
$myusername = $_SESSION['ses_username'];
include_once("includes/bdd.php");

$sql = "SELECT pid, image FROM photo WHERE poster='$myusername' OR pid in (select pid from tag where taggee='$myusername') OR pid in (select pid from ingroup natural join shared where username='$myusername' and username != ownername) order by pdate desc"; 
$sql1 ="SELECT description FROM person where username = '$myusername' ";
$result=$bdd->query($sql);
$result1=$bdd->query($sql1);
//$result1 = mysqli_query($conn,$sql1);
//$result = mysqli_query($conn,$sql);
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>InstaClone|<?php echo $myusername?></title>

  <link href="https://fonts.googleapis.com/css?family=Lobster+Two|Poppins" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
</head>
<body>
  <!-- build an instagram-like app -->
<header>
  </div>
  <h1> <a class="navbar-brand" href="Main.php"><i class="fa fa-instagram" aria-hidden="true"></i>InstaClone</h1></a>
          
            <form name="form1" method="post" action="PhpCode/logout.php">
                <span class='pull-right'><button type="submit">Logout</button></span>
            </form>
          
</header>

<section class="profile">
  <!-- added avatar class to image so we can make a circular avatar -->
  <img class="avatar" src="assets/img/10.jpg" alt="my profile picture" />
  <div class="profile-info">
    <h1><?php echo "$myusername" ?></h1>
    <?php 
    
    while($row1 = $result1->fetch()){
    ?>
    <p>
      <h2>
        <em> <?php echo $row1['description'];?> </em><br/>
         <a href="PhpCode/description.php" class="btn btn-primary" > Editer votre description</a>      
        </a>
      </h2>
    </p> 
    <a href="Phpcode/profileinfo.php"><button type="button" class="btn btn-primary">Tag a friend</button></a>
    <a href="Phpcode/fgdropdown5PS.php"><button type="button" class="btn btn-primary">Manage friend</button></a>
    <?php   
}
    ?>

  </div>
</section>
<section class="gallery">
  <br/>
  <br/>
  <br/>
  <?php 
  while($row = $result->fetch()) {
?>
  <div class="image-container"> 
	 
   <img src="images/<?php echo $row['image']; ?>">
        
    <!--<img src="imageview.php?pid=<?php// echo $row["pid"]; ?>" /><br/>-->
      <span class="likes">
        <i class="fa fa-heart" aria-hidden="true"></i><span class="count"> 202</span>
      </span>
  </div>
<?php   
}

?>

</section>

<footer><strong>InstaClone &copy; 2017</strong></footer>


</body>
<script src="assets/js/admin/main.js"></script>
</html>
