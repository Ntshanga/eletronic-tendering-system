<?php

// connect to the database
include('connectadmin.php');
include('authent.php');
$userid = (int) $_SESSION['userid'];


// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// get the 'id' variable from the URL
$id = $_GET['id'];

$pending=1;

$phone = $DBcon->query("SELECT PhoneNo FROM members WHERE memberID= $userid")->fetch_object()->PhoneNo;
$email = $DBcon->query("SELECT email FROM members WHERE memberID= $userid")->fetch_object()->email; 


		
	
            

// update record from database
if($stmt = $DBcon->prepare("UPDATE Tender_details set pending=1 where tender_id=$id")){
$stmt->execute();
//send email
            $to = $email;
            $subject = "TENDER ALLOCATION";
            $body = "<p>Hello.</p>
            <p>you have been assign a tender please login in to view your tender</p>
            <P> Thank you for your coperation<p>
            <p>Regards Site Admin</p>";

            $mail = new Mail();
            $mail->setFrom(SITEEMAIL);
            $mail->addAddress($to);
            $mail->subject($subject);
            $mail->body($body);
            $mail->send();
			


    
    //send text message to the user
    
    // Specify your login credentials
    $username   = "chirchir";
    $apikey     = "22197b4799a84fd555bf8d84a9abd2203c6cca1e2a09b6178123f5c8acb27f32";
    
    $recipients =$phone;
    // And of course we want our recipients to know what we really do
    $message    = "Hello you have been assign a tender please login in to view your tender. Regards E-Tender Admin";
    // Create a new instance of our awesome gateway class
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    
    try 
    { 
      // Thats it, hit send and we'll take care of the rest. 
      $results = $gateway->sendMessage($recipients, $message);
      
                
      
    }
    catch ( AfricasTalkingGatewayException $e )
    {
      echo "Encountered an error while sending: ".$e->getMessage();
    }
    // DONE!!! 




		//redirect to approved page page
    header('Location: approvedTenders.php?action=active');
        exit;

		
	} else {
		echo "could not be approved."; 
	}
	
}
