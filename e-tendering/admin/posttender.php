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
                              <li><a href="posttender.php">Edit Tender</li>
                              <li><a href ="assigntender.php">Assign Tender</a></li>
                              <li><a href ="comments.php">See Comments</a></li>
                        </ul>
                  </nav>
            
      <div id ="loginpage">
<?php
      function renderForm($tenderInfo= '', $tenderDesc ='',$tenderCost= '',$client= '',$location= '', $error = '', $id = '',$bid='', $useID='', $pending='', $closing_date='')
{ 
      if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?>


<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<form action="" method="post">
<div>
<?php if ($id != '') { ?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<p>ID: <?php echo $id; ?></p>
<?php } ?>

<label>Tender Info: *</label><br> 
<input type="text" name="tenderInfo" value="<?php echo $tenderInfo; ?>"/><br/>
<label>Tender Desc: *</label><br> 
<input type="text" name="tenderDesc" value="<?php echo $tenderDesc; ?>"/><br/>
<label>Tender Cost: *</label><br> 
<input type="text" name="tenderCost" value="<?php echo $tenderCost; ?>"/><br/>
<label>Client: *</label><br> 
<input type="text" name="client" value="<?php echo $client; ?>"/><br/>
<label>Location: *</label><br> 
<input type="text" name="location" value="<?php echo $location; ?>"/><br/>
<label>Closing Date: *</label><br> 
<input type="text" name="closing_date" value="<?php echo $closing_date; ?>"/><br/>
<p>* required</p>
<input type="submit" name="submit" value="Submit" />
</div>
</form>
 </div>
</div>
            
</body>
</html>
<?php }



/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['id']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
if (is_numeric($_POST['id']))
{
// get variables from the URL/form
$id = $_POST['id'];
$tenderInfo = htmlentities($_POST['tenderInfo'], ENT_QUOTES);
$tenderDesc = htmlentities($_POST['tenderDesc'], ENT_QUOTES);
$tenderCost = htmlentities($_POST['tenderCost'], ENT_QUOTES);
$client = htmlentities($_POST['client'], ENT_QUOTES);
$location = htmlentities($_POST['location'], ENT_QUOTES);
$closing_date = htmlentities($_POST['closing_date'], ENT_QUOTES);


// check that all field are empty
if ($tenderInfo == '' || $tenderDesc == '' ||$tenderCost=='' ||$client==''|| $location==''||$closing_date=='')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($tenderInfo, $tenderDesc,$tenderCost,$client,$location, $error, $id, $closing_date);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $DBcon->prepare("UPDATE Tender_details SET Tender_info = ?, tender_descr = ?, tender_cost = ?, client = ?, location = ?, closing_date=?
WHERE id=? and pending=0 and bid=0 "))
{
$stmt->bind_param("ssi", $tenderInfo, $tenderDesc, $tenderCost, $client,$location ,$id, $closing_date);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

// redirect the user once the form is updated
header("Location: adminpage.php");
}
}
// if the 'id' variable is not valid, show an error message
else
{
echo "Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if($stmt = $DBcon->prepare("SELECT * FROM Tender_details WHERE tender_id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

@$stmt->bind_param("ssi", $tenderInfo, $tenderDesc, $tenderCost, $client,$location, $closing_date);
$stmt->fetch();

// show the form
renderForm($tenderInfo, $tenderDesc,$tenderCost,$client,$location,$closing_date, NULL, $id);

$stmt->close();
}
// show an error if the query has an error
else
{
echo "Error: could not prepare SQL statement";
}
}
// if the 'id' value is not valid, redirect the user back to the view.php page
else
{
header("Location: adminpage.php");
}
}
}



/*

NEW RECORD

*/
// if the 'id' variable is not set in the URL, we must be creating a new record
else
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// get the form data
$tenderInfo = htmlentities($_POST['tenderInfo'], ENT_QUOTES);
$tenderDesc = htmlentities($_POST['tenderDesc'], ENT_QUOTES);
$tenderCost = htmlentities($_POST['tenderCost'], ENT_QUOTES);
$client = htmlentities($_POST['client'], ENT_QUOTES);
$location = htmlentities($_POST['location'], ENT_QUOTES);
$closing_date = htmlentities($_POST['closing_date'], ENT_QUOTES);
$bid =0;
$pending=0;
$userID=0;


// check that firstname and lastname are both not empty
if ($tenderInfo == '' || $tenderDesc == '' ||$tenderCost=='' ||$client==''|| $location==''||$closing_date=='')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($tenderInfo, $tenderDesc,$tenderCost,$client,$location,$closing_date, $error);
}
else
{
// insert the new record into the database
if ($sql ="INSERT INTO Tender_details (tender_info, tender_descr, tender_cost, client, location, closing_date,bid,pending, userID) VALUES ('$tenderInfo', '$tenderDesc','$tenderCost','$client','$location','$closing_date','$bid','$pending', '$userID')")
{
      $row=$DBcon->query($sql);


}
// show an error if the query has an error
else
{
echo "ERROR: Could not prepare SQL statement.";
}

// redirec the user
header("Location: adminpage.php");
}

}
// if the form hasn't been submitted yet, show the form
else
{
renderForm();
}
}

// close the mysqli connection
$DBcon->close();
?>



                  
                 