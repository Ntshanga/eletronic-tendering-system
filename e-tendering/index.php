<?php 
 require('core/database/connect.php');
require ('includes/overall/head.php'); 


//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = 'Username is too short.';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}

	}

	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}

	}


	//if no errors have been created carry on
	if(!isset($error)){
    $fname='enter First Name';
      $lname='enter Last name';
      $cname='enter Company name';
      $pnumber='enter Phone No';
      $location='Current Location';
      $s='your Specialixation';
      $address ='address and city';

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));

		try {
      


			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (username,password,email,active, Firstname, Lastname, Company_name, PhoneNo, Location, Specialization, address) VALUES (:username, :password, :email, :active, :Firstname, :Lastname, :Companyname, :phoneno, :location, :specialization, :address)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion,
        'Firstname'=>$fname,
        'Lastname'=>$lname,
        'Companyname'=>$cname,
        'phoneno'=>$pnumber,
        'location'=>$location,
        'specialization'=>$s,
        'address'=>$address
			));
			$id = $db->lastInsertId('memberID');

			//send email
			$to = $_POST['email'];
			$subject = "Registration Confirmation";
			$body = "<p>Thank you for registering at E-Tender site.</p>
			<p>To activate your account, please click on this link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			<p>Regards Site Admin</p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			//redirect to index page
			header('Location: index.php?action=joined');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}


?>
<body background ="bg.jpg">
      <div id= "header1">
                  <?php include 'includes/overall/menu.php'; ?>
                  <div id= "logo">
                        <img src="images/e-tender.jpeg" alt="logo" height="120px" width ="150px">
                        
                  </div>
        </div>
              
        <div id = "tender_content">
                
            <div id ="tender_table">
              <marquee><img src="images/alert.png" alt="alert" height="51px" width ="160px"></marquee>
                <table>
                    <tr>
                      <th>No</th>
                      <th>Tender Info</th>
                      <th>Location</th>
                      <th>Client</th>
                      <th>Amount</th>    
                   </tr>

                   <tr>
                    <td>1</td>
                      <td>Computer Delivery</td>
                      <td> Nyahururu</td>
                      <td>Laikipia University</td>
                      <td>Ksh. 300000</td>
                   </tr>

                   <tr>
                      <td>2</td>
                      <td >wall painting and floor repair</td>
                      <td>Kisumu</td>
                      <td>Naivas Supermaket</td>
                      <td>Ksh. 200000</td>
                   </tr>

                   <tr>
                      <td>3</td>
                      <td>House Buiding and Construction</td>
                      <td>Eldoret</td>
                      <td>Kiptagich</td>
                      <td>negotiable</td>
                   </tr>

                   <tr>
                      <td>4</td>
                      <td>transportation services</td>
                      <td>Moyale</td>
                      <td>Chirchir Family</td>
                      <td>Ksh.50,000</td>
                   </tr>

                   <tr>
                      <td>5</td>
                      <td>Computer Repair and upgrade</td>
                      <td>Nakuru</td>
                      <td>Kenyatta Universuty</td>
                      <td>Ksh. 70,000</td>
                   </tr>

                   <tr>
                      <td>6</td>
                      <td id ="scrollit">cement delivery</td>
                      <td>Machakos</td>
                      <td>Sinai Primary School</td>
                      <td>Ksh. 500,000</td>
                   </tr>
               </table>
            </div> 
              
           
    <div id = "tender_registration">
    <h3 id= "registerwithus">Register as a Supplier...</h3>
    <hr>
    <?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo "<h4 class='bg-success'>Registration successful, please check your email to activate your account.</h4>";
				}
				?>
    <form action ="index.php" method ="POST" autocomplete ="off">
    <label>Username:</lable><br>
    <input name= "username" type ="text" id ="input" placeholder= "Your Username..." value ="<?php if(isset($error)){ echo $_POST['username']; } ?>"/><br>
    <label>Email:</lable><br>
    <input name= "email" type ="text" id ="input" placeholder= "Your Mail..." value ="<?php if(isset($error)){ echo $_POST['email']; } ?>"/><br>
    <label>Password:</lable><br>
    <input name= "password" type ="password" id ="input" placeholder= "Password..."/><br>
    <label>Confirm Password:</lable><br>
    <input name= "passwordConfirm" type ="password" id ="input" placeholder= "confirm Password..."/><br>
    <input name= "submit" type ="submit" id ="register" value ="Register">
    
    </form>
    <p class ="gotologinpage">already have an account? click <a href ="login.php">here</a></p><br>
              
    </div>
    
            
            
            
 	</div>
              <div id ="tender_info">

                <div id ="features">
                      <p><a name ="features">Electronic Tendering System has the following features</a></p></br>
                      <ol>
                        <li>Publication of Invitation to Tender (ITT)</li>
                        <li>Expression of interest (EOI)</li>
                        <li>EOI management</li>
                        <li>Pre-qualification and selection of vendors</li>
                        <li>Publication of tender documents</li>
                        <li>Opening bids and bid evaluation</li>
                        <li>Placement of contract within a secure environment</li>
                        <li>Bid submission</li>
                      </ol>
                </div>
                <div id ="about">
                  <h2 id="pabout"><a name="about">About</a></h2>
                  <p>Eectronic tendering system provides a range of fully integrated Bid and
                  Tender Management tools that enable purchasing and sourcing professionals to
                  be more effective in managing sourcing, procurement, and communicating with other
                  team members, product vendors and service providers.</p>
                  <p>Integrating with suppliers is a critical piece
                  of the supply chain puzzle.</p>
                  <p> Tender Management solution provides
                  an environment for requisitions management, bidding information management, tender documents management,
                   suppliers offerings management, and much more.</p>


                </div>
                
              </div>
                <div id ="contactus">
                  <h3><a name ="contacts"><marquee> Do you need help? Feel Free to Send us a Msessage</marquee></a></h3>
                <div id ="help">
                  <p><img src ="images/home.png" width ="50px" height="50px">
                    Room P290, Kiptagich House</img></p>
                      <p class="helpcontent" >3177-0020 Uganda Road</p>
                      <p class="helpcontent">Eldoret </p>
                     <p class="helpcontent"> Kenya.</p>
                     <p><img src ="images/contact.png" width="50px" height ="50px">
                      +2540705814794</img></p>
                      <p><img src ="images/contact.png" width="50px" height ="50px">
                      +25421308695</img></p>
                       <p><img src ="images/message.png" width="50px" height ="50px">
                      tenderservice@gmail.com</img></p>
                      
                </div>
            
                
              <div id = "tender_contact">
                <?php
                if (isset($_POST['comment'])) {

                  $fname=$_POST['fname'];
                  $lname=$_POST['lname'];
                  $phone=$_POST['phone'];
                  $message=$_POST['message'];
                  if ($fname==''||$lname==''||$phone==''||$message=="") {
                    echo"all field must be filled";
                  }else{
                    try{
                    $sql=$db->prepare('INSERT INTO comments(FirstName, LastName, PhoneNo, Comments) VALUES (:firstname,:lastname, :phoneno,:message)');
                     $sql->execute(array(
                      ':firstname'=>$fname,
                      ':lastname'=>$lname,
                      ':phoneno'=>$phone,
                      ':message'=>$message
                     ));
                     $id =$db->lastInsertId('commentID');
                     if ($sql) {
                      echo"thank you for sending us a message!";
                       
                     }else{
                      echo"error!!please try again sometime";
                     }
                   }catch(PDOException $e) {
                      echo $e->getMessage();
                  }






                  }
                }


                ?>

               
                <form action ="" method ="Post" >
                    <label for="fname">First Name</label><br>
                    <input type="text" id="fname" name="fname"><br>
                    <label for="lname">Last Name</label><br>
                    <input type="text" id="lname" name="lname"><br>
                    <label for="phone">Phone NO</label><br>
                    <input type="text" id="phone" name="phone"><br>
                    <label for="message">Message</label><br>
                    <input type="text" id="lname" name="message"><br>
                    <input type ="submit" id="submit" name ="comment" value =" Send Comment">
                 </form>
              </div>
              
    
            
              <?php include 'includes/overall/footer.php'; ?>
            </div>



              

      </body>
</html>


