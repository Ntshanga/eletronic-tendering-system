
<?php
include_once 'connectadmin.php';
include_once 'authent.php';

?>
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
      				<li><a href="posttender.php">Add New Tender</li>
      				<li><a href ="assigntender.php">Assign Tender</a></li>
                              <li><a href ="approvedTenders.php">Aproved Tenders</a></li>
      				<li><a href ="comments.php">See Comments</a></li>
      			</ul>
      		</nav>
      	
      		<div id ="showtender">
                        <label>All Approved Tenders</label><br><br>
      			
<?php
if($result = $DBcon->query("SELECT * FROM Tender_details where bid=1 and pending=1 ORDER BY tender_id")){


// display records if there are records to display
if ($result->num_rows > 0){
      
// display records in a table
echo'<div id="flip">';
echo "<table border='' cellpadding='10'>";



// set table headers
echo "<tr><th>Supplier ID</th><th>Tender ID</th><th>Tender Info</th><th>Tender Cost</th><th>Client</th><th>Location</th><th>Closing Date</th></tr>";
while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td><a style='text-decoration:underline' href='checksupplier.php?id=" . $row->userID . "'>".$row->userID."</a></td>";
echo "<td>" . $row->tender_id . "</td>";
echo "<td>" . $row->tender_info . "</td>";
echo "<td>" . $row->tender_cost. "</td>";
echo "<td>" . $row->client. "</td>";
echo "<td>" . $row->location. "</td>";
echo "<td>" . $row->closing_date. "</td>";

echo "<td><a href='delete.php?id=" . $row->tender_id . "'>Delete</a></td>";

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
echo "No Tender has been Approved";
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