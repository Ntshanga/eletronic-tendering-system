 
<?php 
require_once('core/database/connect.php');
if(!$user->is_logged_in()){
    header('Location: login.php'); 
} 
require ('includes/overall/head.php');
if (isset($_POST['bid'])) {

  $userID=$_SESSION['memberID'];
  $bid =1;
  $sql=$db->prepare("UPDATE Tender_details set bid='$bid', userID='$userID'");
  $sql->execute();
   if($sql->rowCount() == 1){

   header('Location: bidded.php?');
    exit;

  } else {
    echo "No tender Bidded."; 
  }
  
}




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


          <div id ="bidtenders">
                  <?php
                  //get id from the url to edit a record 
                  if (isset($_GET['id'])){
                    $id =$_GET['id'];
                    
                    

                    if (is_numeric($id)) {
                      //select data from the database 
                      $sql="SELECT tender_info, tender_info, tender_descr, location, client, tender_cost FROM Tender_details WHERE tender_id=:tender_id";
                      $statement = $db->prepare($sql);
                      $statement->bindValue(':tender_id', $id);
                      $statement->execute();
                      //Fetch the row.
                      $row = $statement->fetch(PDO::FETCH_ASSOC);
                      //If $row is FALSE, then no row was returned.
                      if($row === false){
                          echo $id . ' not found!';
                      } else{
                        
                        echo"<h3>Tender information</h3><br>";
                          echo $row['tender_info']."<br>";
                          echo"<h3>Tender Description</h3><br>";
                          echo $row['tender_descr']."<br>";
                          echo"<h3>Cost</h3><br>";
                          echo $row['tender_cost']."<br>";
                          echo"<h3>Client</h3><br>";
                          echo $row['client']."<br>";
                          echo"<h3>Location</h3><br>";
                          echo $row['location']."<br>";
                          echo "<h3>are you interested?</h3> ";
                          
                      }

                    
                      
                    }

              }

                  // close database connection


                  ?>
                  <form method ='post' action='' >
                  <input id ='bid' type='submit' name='bid' value='Yes|Bid'>
                  </form>
                          

          </div>
        </div>

          <?php require('includes/overall/footer.php') ?>
        </body>
        </html>


