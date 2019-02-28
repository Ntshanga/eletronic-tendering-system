<?php require('core/database/connect.php'); 

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); } 

$stmt = $db->prepare('SELECT resetToken, resetComplete FROM members WHERE resetToken = :token');
$stmt->execute(array(':token' => $_GET['key']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//if no token from db then kill the page
if(empty($row['resetToken'])){
	$stop = 'Invalid token provided, please use the link provided in the reset email.';
} elseif($row['resetComplete'] == 'Yes') {
	$stop = 'Your password has already been changed!';
}

//if form has been submitted process it
if(isset($_POST['submit'])){

	//basic validation
	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		try {

			$stmt = $db->prepare("UPDATE members SET password = :hashedpassword, resetComplete = 'Yes'  WHERE resetToken = :token");
			$stmt->execute(array(
				':hashedpassword' => $hashedpassword,
				':token' => $row['resetToken']
			));

			//redirect to index page
			header('Location: login.php?action=resetAccount');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//define page title
$title = 'Reset Account';

//include header template
require('includes/overall/head.php'); 

?>
<body  background ="bg.jpg">
<div class ="loginhead">
          <div id= "logoinlogin">
              <img src="images/e-tender.jpeg" alt="logo" height="60px" width ="100px">
                        
        </div>
    </div>

<div class="resetpass">

	<div class="passwordreset">

	    	<?php if(isset($stop)){

	    		echo "<p class='bg-danger'>$stop</p>";

	    	} else { ?>

				<form  method="post" action="" autocomplete="off">
					<h3>Change Password</h3>

					<?php
					//check for any errors
					if(isset($error)){
						foreach($error as $error){
							echo '<p class="bg-danger">'.$error.'</p>';
						}
					}

					//check the action
					if(isset($_GET['action'])){
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
					}
				}
					?>

					
								<input type="password" name="password" id="password"  placeholder="Password"><br>
							
								<input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm Password" ><br>
							
					
						<input type="submit" name="submit" value="Change Password" >
		
				</form>

			<?php } ?>
		</div>
	</div>


</div>

<?php 
//include header template
require('includes/overall/footer.php'); 
?>
