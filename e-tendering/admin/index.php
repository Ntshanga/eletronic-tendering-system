<?php
require_once 'connectadmin.php';

if (isset($_SESSION['userSession'])!="") {
 header("Location: adminpage.php");
 exit;
}

if (isset($_POST['submit'])) {
 
 $username = strip_tags($_POST['username']);
 $password = strip_tags($_POST['password']);
 
 $username = $DBcon->real_escape_string($username);
 $password = $DBcon->real_escape_string($password);
 
 $query = $DBcon->query("SELECT adminID, username, password FROM admin WHERE username='$username'");
 $row=$query->fetch_array();
 
 $count = $query->num_rows; // if username/password are correct returns must be 1 row
 
 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['userSession'] = $row['adminID'];
  $_SESSION['userid'] = $row['userID'];
  header("Location: adminpage.php");
 } else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
    </div>";
 }
 $DBcon->close();
}
?>
<! DOCTYPE html>
<html>
      <head>
      	<meta charset="UTF-8">
      	<title>admin|Home</title>
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
      				<li><a href ="">Home</a></li>
                              <li><a href ="register.php">Register as Admin</a></li>

      				
      			</ul>
      		</nav>
      	
      		<div id ="loginpage">
                        <?php
                          if(isset($msg)){
                           echo $msg;
                          }
                          ?>
                        
      			<form action ="" method ="post" autocomplete ="off">

      				<input type ="text" name ="username" placeholder ="Username..."value ="<?php if(isset($error)){ echo $_POST['username']; } ?>"><br>
      				<input type = "password" name ="password" placeholder ="Password.."><br>
      				<input type ="submit" name ="submit" value ="Login Now">
      		</form>
      		</div>
                  </div>
            
      </body>
</html>