<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!-- Bootstarp css -->
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
	<!-- Main css -->
	<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
	<title>InstaClone | Picture Manipulation</title>
</head>
<body>
    <?php
        session_start();
        $myusername = $_SESSION['ses_username'];
        include_once("../includes/bdd.php");
    ?>
   
	<!-- Nav Bar -->
   	<nav class="navbar navbar-light bg-faded">
        <div class="container">
            <a class="navbar-brand" href="../Main.php"><i class="fa fa-instagram" aria-hidden="true"></i>InstaClone</a>

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
                        
            	<a href="../admin.php"><i class="fa fa-user icon" aria-hidden="true"></a></i>
        	</span>           
        </div>
    </nav>

    <!-- post -->
    <div class="post">
        
        <br>
                <?php
                
                    $sql = "Select* from photo";
                    $result = $bdd->query($sql);
                    $count=0;
                    while( $columns=$result->fetch())
                    {
						
						$count=$count+1;
						}
						   $result->closeCursor();
                   
                    
                    $newpid = $count + 1;

                
                ?>
                              
        
	   <p class="default-post"><strong>First select the pic you want to upload and make sur to copy this file name with Ctrl+C
       <br/> <br/> Submit your picture<br/> <br/> Then past the filename you copied in the next field and fill up the other field and hit add button. 
   </strong></p><br/>
	  <form class="form-horizontal"method="post" enctype="multipart/form-data" action="">
		<p>
			<div class="col-sm-10">
			<input class="form-control" type="file" name="fichier" size="30">
			</div>
			<div class="form-group">
			<center>
			<input type="submit" name="upload" value="Submit" class="btn btn-primary"> 
			</center>
			</div>
		</p>
	  </form>
	  
	  <?php

if( isset($_POST['upload']) ) // si formulaire soumis
{
    $content_dir = '../images/'; // dossier où sera déplacé le fichier

    $tmp_file = $_FILES['fichier']['tmp_name'];

    if( !is_uploaded_file($tmp_file) )
    {
        exit("File not found");
    }

    // on vérifie maintenant l'extension
    $type_file = $_FILES['fichier']['type'];

    if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'JPG')&& !strstr($type_file, 'PNG')&& !strstr($type_file, 'png') )
    {
        exit("Check the file extension");
    }

    // on copie le fichier dans le dossier de destination
    $name_file = $_FILES['fichier']['name'];

    if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
    {
        exit("Impossible to copy this file in $content_dir");
    } else {
    
        echo "Image added"; 
}

}

?>


<br>
	  <br>
	  	   <div class="alert alert-danger" role="alert">
        <strong>Oh snap!</strong> Possible file are ".JPG .PNG".
        </div>
         <div > 
			 <?php
     if(isset($_POST['formconnexion'])){
		 $image = htmlspecialchars($_POST['fichier']);
       $commentaire = htmlspecialchars($_POST['commentaire']);
         $appartenance = htmlspecialchars($_POST['appartenance']);
       $groupe= htmlspecialchars($_POST['groupe']);
     
      
      
       if(!empty( $image) and  !empty($commentaire) and !empty($appartenance)){
		   if($appartenance=='public')
		   {
			    $sql="INSERT INTO photo VALUES ($newpid, '$myusername', '$commentaire', CURRENT_TIMESTAMP, NULL, NULL, NULL,1, '$image')";
		     $requete=$bdd->query($sql);
		      $erreur = "Informations about this Image are added";
			   
			   }else
			   {
				   $sql="INSERT INTO photo VALUES ($newpid, '$myusername', '$commentaire', CURRENT_TIMESTAMP, NULL, NULL, NULL,0, '$image')";
		     $requete=$bdd->query($sql);
		     $sql1="INSERT INTO shared VALUES ($newpid, '$groupe', '$myusername')";
		       $requete1=$bdd->query($sql1);
		      $erreur = "Informations about this Image are added";
				   
				   }
		   
		   }
		   else{
			   $erreur = "Please fill up all the field!";
			   
			   }
		 
		 }
     
     
     
     
        ?>
         <form class="form-signin" method="post" action="">
	  
	
     <input type="text" id="fichier" class="form-control" placeholder="Uploaded file name+extension" name="fichier">

			
       
	   <br/>
     
     <br/>
       <textarea class="form-control" rows="3" name="commentaire" type="text" id="commentaire" placeholder="Your Comment"></textarea>

        
    <br/>
  Set Photo to Public or Private.
                                <br>
        <select id="appartenance" name="appartenance" class="form-control" onChange="THEFUNCTION(this.selectedIndex);">
		  <option>public</option>        
		  <option>private</option>        
		  
     </select>      
       
     </select>
     <br/>
     <div style="display:none;" id="choix">
      <select id="groupe" name="groupe"  class="form-control">
		  <option>besties</option>        
		  <option>family</option>        
       
     </select>
 </div>
	
	  <br/>

        <br/>

        <input class="btn btn-lg btn-primary btn-block" type="submit" name="formconnexion" value="Add">
		
		</form>
		<div align="center">
    <?php
    if (isset($erreur)){
      echo $erreur;
    }
    ?>
        </div>  
	       
        
        </div>
        <br/>
        <br/>
    </div>
                
    <!--<div class="post">
    	<div class="user-info">
    	<i class="fa fa-user user-image"></i>
    	<span class="pull-right">35m</span>
    	</div>
    	<img src="../assets/img/post1.jpg" width="650" height="400">
    	<div class="caption">
    		<span><strong id="count-likes"></strong><strong> likes</strong></span>
    		<h4>
    			<strong>brist </strong>
    			Developer for life...#projaro
    		</h4>
    		<p class="default-post"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
    		<hr>
    		<div>
    			<span class="like"><i id="heart" class="fa fa-heart-o" onclick="newLikes();"></i></span>
    			<textarea data-key="13" class="comment" cols="60" rows="1" placeholder="Add comment"></textarea>
    		</div>

    	</div>
    </div>-->

<div class="footer">
	<footer><strong>InstaClone &copy; 2017</strong></footer>
</div>

<!-- js -->
<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../assets/js/main.js"></script>
</body>
</html>
