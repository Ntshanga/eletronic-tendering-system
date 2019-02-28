
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
              
            </ul>
          </div>


          <div = id ="available_tenders">
            <label style="color:green">All requested Tenders</label><br><br>
            <?php
            $userid=$_SESSION['memberID'];
                  $sql ="SELECT * FROM Tender_details where bid=1 and pending =0 and userID =$userid ORDER BY tender_id";
                  $query = $db->prepare( $sql);
                  $query->execute();

                  if($query){
                    $row =$query->fetchAll( PDO::FETCH_ASSOC );





                  // display records if there are records to display
                  if (count($row)> 0){
                  // display records in a table
                  echo'<div id="flip">';
                  echo "<table border='' cellpadding='10'>";


                  // set table headers
                  echo "<tr><th>Tender ID</th><th>Tender Info</th><th>Tender Cost</th><th>Client</th><th>Location</th><th>Closing Date</th><th></th>";
                  foreach ($row  as $tender) {
                    # code...
              
                  
                  // set up a row for each record
                  echo "<tr onclick='window.document.location='#';''>";
                  echo "<td>" . $tender['tender_id']. "</td>";
                  echo "<td>" . $tender['tender_info'] . "</td>";
                  echo "<td>" . $tender['tender_cost']. "</td>";
                  echo "<td>" . $tender['client']. "</td>";
                  echo "<td>" . $tender['location']. "</td>";
                   echo "<td>" . $tender['closing_date']. "</td>";
                  


                  
                  echo "</tr>";
                  }

                  echo "</table>";
                  echo"</div>";
                  }
                  // if there are no records in the database, display an alert message
                  else
                  {
                  echo "<label style='color:red'>You have been assigned all Tenders</label>";
                  }
                  }else
                  {
                  echo "Error: " . $db->error;
                  }

                  // close database connection


                  ?>
            
            

          </div>
        </div>

          <?php require('includes/overall/footer.php') ?>
        </body>
        </html>





