<?php
include_once 'connectadmin.php';
include_once 'authent.php';
?>
<! DOCTYPE html>
<! DOCTYPE html>
<html>
      <head>
            <meta charset="UTF-8">
            <title>admin|Admin Page</title>
            <link rel ="stylesheet" type = "text/css" href ="css/index.css"/>
            <link rel ="stylesheet" type = "text/css" href ="css/adminpage.css"/>





      </head>

      <body background = "../bg.jpg">

      <div id = "header">
            <div class ="logo">
                  <img src="../images/e-tender.jpeg" alt="logo" height="90px" width ="120px">
            </div>
                  <div id ="welcomeadmin">
                        
                        <ul>
                              
                              <li id ="username">Welcome- <?php echo $userRow['username']; ?></li>
                              <li><a href ="logout.php?logout">Logout</li>
                              

                              


                        </ul>

                  </div>
                  <hr>

            </div>
      <div id ="menu">
                  <nav>
                        <ul>
                              
                              <li><a href ="adminpage.php">Posted Tenders</a></li>
                              <li><a href="posttender.php">Edit Tender</li>
                              <li><a href ="assigntender.php">Assign Tender</a></li>
                              <li><a href ="comments.php">See Comments</a></li>
                        </ul>
                  </nav>
            
                  <div id ="viewcomments">
                        <?php
                        if($result = $DBcon->query("SELECT * FROM comments ORDER BY commentID")){


                        // display records if there are records to display
                        if ($result->num_rows > 0){
                        // display records in a table
                        echo'<div id="flip">';
                        echo "<table border='' cellpadding='10'>";


                        // set table headers
                        echo "<tr><th>Comment ID</th><th>First Name</th><th>Last Name</th><th>Phone No</th><th>Message</th><th></th><th></th></tr>";
                        while ($row = $result->fetch_object())
                        {
                        // set up a row for each record
                        echo "<tr>";
                        echo "<td>" . $row->commentID . "</td>";
                        echo "<td>" . $row->FirstName . "</td>";
                        echo "<td>" . $row->LastName. "</td>";
                        echo "<td>" . $row->PhoneNo. "</td>";
                        echo "<td>" . $row->Comments. "</td>";
                        echo "<td><a href='deletecomments.php?id=" . $row->commentID . "'>Delete</a></td>";
                        echo "</tr>";
                        }

                        echo "</table>";
                        echo"</div>";
                        echo'<div id ="panel">';

                        echo"</div>";
                        }
                        // if there are no records in the database, display an alert message
                        else
                        {
                        echo "No Posted Tender!";
                        }
                        }else
                        {
                        echo "Error: " . $DBcon->error;
                        }

                        // close database connection
                        $DBcon->close();

                        ?>
                        
                  
                  </div>
                  </div>
            
      </body>
</html>