
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
            <link rel ="stylesheet" type = "text/css" href ="css/check.css"/>





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
            
                  <div id ="check">
                        <h3> View Supplier Details</h3><br>
                        
<?php

// connect to the database

// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// get the 'id' variable from the URL
$id = $_GET['id'];
if($result = $DBcon->query("SELECT username, email, Firstname, Lastname, Company_name, PhoneNo, Location, Specialization, address from  members where memberID=$id")){
      if ($result->num_rows > 0){
            while ($show= $result->fetch_object()){


                  $fname=$show->Firstname;
                  $uname=$show->username;
                  $email=$show->email;

                  $lname=$show->Lastname;
                  $cname=$show->Company_name;
                  $phone=$show->PhoneNo;
                  $location=$show->Location;
                  $specialize=$show->Specialization;
                  $address=$show->address;
            }




      }





      }
}
?>

 <table id="checksupp" cellpadding="10" border="20px">
                
                  <tr>
                     <th>Username</th>
                      <th>Email</th>
                       
                     </tr>
                     <tr>
                      <td><?php echo $uname;?></td>
                      <td><?php echo $email;?></td>
                      
                     </tr><tr>
                     <th>First Name</th>
                      <th>Last Name</th>
                       
                     </tr>
                     <tr>
                      <td><?php echo $fname;?></td>
                      <td><?php echo $lname;?></td>
                      
                     </tr>
                  <tr>
                     <th>Phone</th>
                      <th>Address </th>
                       
                     </tr>
                     <tr>
                      <td><?php echo $phone;?></td>
                      <td><?php echo $address;?></td>
                      
                     </tr>
                     <tr>
                        <th>Company Name</th>
                         <th>Location</th>
                          
                        </tr>
                        <tr>
                          <td><?php echo $cname;?></td>
                          <td><?php echo $location;?></td>
                          
                        </tr>
                        <tr>
                        <th>Specialization</th>
                         
                          
                        </tr>
                        <tr>
                          <td><?php echo $specialize;?></td>
                          
                          
                        </tr>
              </table>



                  </div>
                  </div>
            
      </body>
</html>