
<?php 
require_once('core/database/connect.php');
if(!$user->is_logged_in()){
    header('Location: login.php'); 
} 
require ('includes/overall/head.php');

// create a form validation fuction 

function test_input($data){

$data = trim($data);
$data =stripcslashes($data);
$data =htmlspecialchars($data);
return $data;

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
              
            </ul>
          </div>


          <div = id ="available_tenders">
            <?php


            ?>
           
            
            <label>User Details</label><br><br>
            <?php
            $memberID= $_SESSION['memberID'];
            $sql=$db->query("SELECT Firstname, Lastname, Company_name, PhoneNo, Location, Specialization, address from  members where memberID=$memberID ORDER BY memberID");
            $row =$sql->fetchAll( PDO::FETCH_ASSOC );
            if(count($row)>0){
                foreach ($row as $show) {
                  $fname=$show['Firstname'];
                  $lname=$show['Lastname'];
                  $cname=$show['Company_name'];
                  $phone=$show['PhoneNo'];
                  $location=$show['Location'];
                  $specialize=$show['Specialization'];
                  $address=$show['address'];

           
           }}
            




            if (isset($_POST['userdetails'])) {
              if (empty($_POST['firstname'])) {
                $error[]="this first name is required";
                # code...
              }else{
                $firstname=test_input($_POST['firstname']);
                //check if firstname contain letters and whitespace 
                if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
                  $error[]=" first name is only letters and whitespace are allowed";
                  # code...
                }


              }
              if (empty($_POST['lastname'])) {
                $error[]="Last name is required";
                # code...
              }else{
                 $lastname=test_input($_POST['lastname']);
                 if (!preg_match("/^[a-zA-Z]*$/", $lastname)) {
                  $error[]="last name is only letters and whitespace are allowed";
                  
                }

              }
              if (empty($_POST['address'])) {
                $error[]="Address is required";
                # code...
              }else{
                 $address =test_input($_POST['address']);
              }
              if (empty($_POST['phone'])) {
                $error[]="Phone number is required";
                # code...
              }else{
                 $phone=test_input($_POST['phone']);

              }
              if (empty($_POST['specialization'])) {

                $error[]="Your specialization is required";
              }else{
                $specilization=test_input($_POST['specialization']);
                if (!preg_match("/^[a-zA-Z ]*$/", $specilization)) {
                  $error[]="specialization is only letters and whitespace are allowed";      
                }

              }
              if (empty($_POST['company'])) {
                $error[]="company name if required";
                # code...
              }else{
                 $companyname=test_input($_POST['company']);
                 if (!preg_match("/^[a-zA-Z]*$/", $companyname)) {
                  $error[]=" company name is only letters and whitespace are allowed";      
                }
              }
              if (empty($_POST['location'])) {
                $error[]="Your Location is required";
              }else{
                $location=test_input($_POST['location']);
                if (!preg_match("/^[a-zA-Z]*$/", $location)) {
                  $error[]="location is only letters and whitespace are allowed";      
                }
              }


               if (!isset($error)) {
                 # code...
               
                $sql=$db->prepare("UPDATE members  SET 
                  Firstname='$firstname',
                  Lastname='$lastname',
                  address ='$address',
                  PhoneNo ='$phone',
                  Specialization='$specilization',
                  Company_name='$companyname',
                  Location='$location'




                  ");
                $sql->execute();
                if($sql->rowCount() == 1){


                     header('Location: profile.php?');
                     echo "record updated successfully";
                      exit;

                    } else {
                      echo "record had already been updated."; 
                    }





               }
               
               



               }
             

              
          


            ?>
            <form method ="post" action ="">
              <?php
              if(isset($error)){
          foreach($error as $error){
            echo '<p class="bg-danger">'.$error.'</p>';
          }
        }



              ?>

              <table>
                
                  <tr>
                     <th>First Name</th>
                      <th>Last Name</th>
                       
                     </tr>
                     <tr>
                      <td><input type ="text" name="firstname" value="<?php echo $fname;?>"></td>
                      <td><input type ="text" name="lastname" value="<?php echo $lname;?>"></td>
                      
                     </tr>
                  <tr>
                     <th>Phone</th>
                      <th>Address </th>
                       
                     </tr>
                     <tr>
                      <td><input type ="text" name="phone" value="<?php echo $phone;?>"></td>
                      <td><input type ="text" name="address" value="<?php echo $address;?>"></td>
                      
                     </tr>
                     <tr>
                        <th>Company Name</th>
                         <th>Location</th>
                          
                        </tr>
                        <tr>
                          <td><input  type ="text" name="company" value="<?php echo $cname;?>"></td>
                          <td><input type ="text" name="location" value="<?php echo $location;?>"></td>
                          
                        </tr>
                        <tr>
                        <th>Specialization</th>
                         
                          
                        </tr>
                        <tr>
                          <td><input  type ="text" name="specialization" value="<?php echo $specialize;?>"></td>
                          
                          
                        </tr>
              </table>
              <input type ="submit" name="userdetails" value="Update">



            </form>
            

          </div>
        </div>

          <?php require('includes/overall/footer.php') ?>
        </body>
        </html>


