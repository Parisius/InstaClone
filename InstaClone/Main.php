<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- Bootstarp css -->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<!-- Main css -->
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
	<title>Instaclone|Clone</title>
</head>
<body>
    <?php
        session_start();
        $myusername = $_SESSION['ses_username'];
    ?>
	<!-- Nav Bar -->
   	<nav class="navbar navbar-light bg-faded">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fa fa-instagram" aria-hidden="true"></i> InstaClone</a>
    
            <!--<div class="search">
                    <div class="col-md-4 col-md-offset-3">
                    <div class="input-group">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                        </span>
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </div>
            </div>-->

        	<span class="nav-icons pull-right">
            	<a href="PhpCode/addimage.php"><i class="fa fa-instagram icon" aria-hidden="true"></a></i>
                
            	<a href="admin.php"><i class="fa fa-user icon" aria-hidden="true"></a></i>
        	</span>           
        </div>
    </nav>

    <!-- post -->
    

    <?php
       include_once("includes/bdd.php");
        $sql='SELECT pid, poster, caption, image, pdate FROM `photo`ORDER BY pdate DESC';
        

       $result = $bdd->query($sql);
        
    ?>

    <div class="post">
    	<?php
        while($row = $result->fetch()) 
            //$sql1= "SELECT TIMEDIFF(CURRENT_TIMESTAMP, $row['pdate'])";
            //$time = mysqli_query($conn,$sql1);
        {?>


       <div class='user-info'><i class='fa fa-user user-image'></i>
                        
            <span class='pull-right'><?php echo $row['pdate'];?></span>

            <h4>
            <strong><?php echo $row['poster'];?></strong>
            </h4>
            
        </div>
             <img width="650" height="400" src="images/<?php echo $row['image']; ?>">
        <div class="caption">
            <span>
                <?php
                $sql2="SELECT pid, taggee FROM tag WHERE pid = '$row[pid]'";
                $res=$bdd->query($sql2);
                 ?>
                <p class="default-post"><strong>People Tag : </strong> <?php while($row2 = $res->fetch()){
                    echo "<em><strong>";
                    echo $row2['taggee']; 
                    echo "; "; 
                    echo "</em></strong>";
                }?></p>
            </span>
            
            <p class="default-post"> <br/> <strong><?php echo $row['caption'];?></strong></p>
            <hr>
            <div>

            <div>
                <p class="default-post"><strong>Comments: </strong></p>
            <?php
                $host="localhost"; // Host name 
                $username="root"; // Mysql username 
                $password="root"; // Mysql password 
                $db_name="printstagram"; // Database name 


// Connect to server and select databse.
            $conn =mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 
            mysqli_select_db($conn,"$db_name")or die("cannot select DB");
                $sql3="SELECT * FROM comment where pid = '$row[pid]'";
                $resul=mysqli_query($conn,$sql3);
                while($row3 = mysqli_fetch_array($resul))
                {
                ?>

            <p class="default-post">
                <?php
                    echo "<em>";
                    echo $row3['commenter']; 
                    echo ": "; 
                    echo $row3['ctext'];
                    echo "</em>";
                }?></p>
                
            
                <!--<span class="like"><i id="heart" class="fa fa-heart-o" onclick="newLikes();"></i></span>-->
            <?php $pidrow=($row["pid"]); /*echo $pidrow;*/?>
    <form name="form1" method="post" action="PhpCode/comment.php?pidrow=<?php echo $pidrow; ?>" id="comenter">

                <input name="commenter" class="form-control" type="text" placeholder="Add comment">
                <br/>
                
                <button class="btn btn-sm btn-primary " type="submit">Comment</button>
                
            </div> 

    </form>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <?php }?>
    </div>


<div class="footer">
	<footer><strong>InstaClone &copy; 2017</strong></footer>
</div>

<!-- js -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/main.js"></script>
</body>
</html>