<?php

// connect to the database
include('connectadmin.php');
include('authent.php');

// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// get the 'id' variable from the URL
$id = $_GET['id'];
$bid=0;

// delete record from database
if($stmt = $DBcon->prepare("UPDATE Tender_details set bid=$bid where tender_id=$id")){
$stmt->execute();
$stmt->close();


		//redirect to approved page page
		header('Location: adminpage.php?action=active');
		exit;

	} else {
		echo "could not be approved."; 
	}
	
}
