<?php
//include config
require_once('core/database/connect.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); } 

//process login form if submitted
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($user->login($username,$password)){ 
		$_SESSION['username'] = $username;
		header('Location: memberpage.php');
		exit;
	
	} else {
		$error[] = 'Wrong username or password or your account has not been activated.';
	}

}//end of submit
require ('includes/overall/head.php');
?>
<body  background ="bg.jpg">
<div class ="loginhead">
          <div id= "logoinlogin">
              <img src="images/e-tender.jpeg" alt="logo" height="60px" width ="100px">
                        
        </div>

</div>
<div id="logindiv">
<p><a href='./'>Back to home page</a></p>
<div class ="detailstologin">
            
            <h3>Login</h3>
            <?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){

					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h4 class='bg-success'>Your account is now active you may now log in.</h4>";
							break;
						case 'reset':
							echo "<h4 class='bg-success'>Please check your inbox for a reset link.</h4>";
							break;
						case 'resetAccount':
							echo "<h4 class='bg-success'>Password changed, you may now login.</h4>";
							break;
					}

				}

				
				?>
				

    <form method ="post" action ="" autocomplete ="off">
        <input name ="username" type ="text" placeholder ="Username..." value ="<?php if(isset($error)){ echo $_POST['username']; } ?>"><br>
        <input name ="password" type ="password" placeholder ="Password"><br>
        <a href='reset.php'>Forgot your Password?</a><br>
        <input type="submit" name="submit" value="Login">

    </form>


</div>

</div>


<?php 
//include header template
require('includes/overall/footer.php'); 


?>
</body>
</html>
