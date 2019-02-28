<?php
//start sesseion 
require('connectadmin.php');
if (isset($_SESSION['userSession'])!="") {
 header("Location: adminpage.php");
}

if(isset($_POST['submit'])) {
 
 $uname = strip_tags($_POST['username']);
 $upass = strip_tags($_POST['password']);
 
 $uname = $DBcon->real_escape_string($uname);
 $upass = $DBcon->real_escape_string($upass);

 $hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
 
 $check_username = $DBcon->query("SELECT username FROM admin WHERE username='$uname'");
 $count=$check_username->num_rows;
 
 if ($count==0) {
      
      
  
  $query = "INSERT INTO admin(username,password) VALUES('$uname','$hashed_password')";

  if ($DBcon->query($query)) {
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
     </div>";
  }else {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
     </div>";
  }
  } else {
  
  
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry username already taken !
    </div>";
   
 }
 
 $DBcon->close();
}

?>
<html>
      <head>
      	<meta charset="UTF-8">
      	<title>admin|Register</title>
      	<link rel ="stylesheet" type = "text/css" href ="css/index.css"/>




      </head>

      <body background = "../bg.jpg">

      <div id = "header">
      	<div class ="logo">
      		<img src="../images/e-tender.jpeg" alt="logo" height="90px" width ="120px">
      		<hr>

      	</div>
      </div>
      <div id ="menu">
      		<nav>
      			<ul>
      				<li><a href ="index.php">Home</a></li>
                              <li><a href ="register.php">Register as Admin</a></li>

      				
      			</ul>
      		</nav>
      	
      		<div id ="loginpage">
                         <?php
                          if (isset($msg)) {
                           echo $msg;
                          }
                          ?>

                        
      			<form action ="" method ="POST" autocomplete ="off">

      				<input type ="text" name ="username" placeholder ="Username..."><br>
      				<input type = "password" name ="password" placeholder ="Password..">
                              
                              <p> have an account ? please login <a href ="index.php">here</a></p><br>
      				<input type ="submit" name ="submit" value ="Register Now">
      		</form>
      		</div>
                  </div>
            
      </body>
</html>