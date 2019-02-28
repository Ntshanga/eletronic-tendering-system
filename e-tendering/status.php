
<?php 
require_once('core/database/connect.php');
if(!$user->is_logged_in()){
    header('Location: login.php'); 
} 
require ('includes/overall/head.php');

?>
<body  background ="bg.jpg">
<div class ="loginhead">
          <div id= "logoinlogin">
              <img src="images/e-tender.jpeg" alt="logo" height="60px" width ="100px">
              </div>
            <div id= "userid">
            <ul>
            <li>welcome <?php echo ' '. $_SESSION['username']; ?></li>
            <li class="logout"><a href='logout.php'>Logout</a></li>
            
            </ul>
            
              
            </div>
                        
        </div>
        <div id= "overallmenu">
        <div id = "membersmenu">

            <ul>
              <li><a href ="memberpage.php">All Available Tenders</a></li>
              <li><a href ="bidded.php" >Requested Tenders</a></li>
              <li><a href ="mytenders.php" >My Tenders</a></li>
              <li><a href = "profile.php">My Profile</a></li>
              <li><a href = "status.php">My Status</a></li>
            </ul>
          </div>


          <div = id ="available_tenders">
            jkvjkvjkvjkvjkvjkvvjkjvj
            

          </div>
        </div>

          <?php require('includes/overall/footer.php') ?>
        </body>
        </html>





