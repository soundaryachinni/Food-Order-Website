
<?php 
include('../config/constants.php');
include('login-check.php'); 

 ?> 


<html class="admin-bg">
       <head>
                   <title> Food Order Website - Home page</title>
                   <link rel="stylesheet" href="../css/admin1.css">
       </head>


       <body>
                  <!--Menu section starts here -->

                   <div class="menu text-center">
                     <div class="wrapper ">
                            <ul>

                                   <li><a href="index.php">Home</a></li>
                                   <li><a href="manage-admin.php">Admin </a></li>
                                   <li><a href="manage-category.php">Category</a></li>
                                   <li><a href="manage-food.php">Food</a></li>
                                   <li><a href="manage-order.php">Order</a></li>
                                   <li><a href="logout.php">Logout</a></li>


                                   

                                
                            </ul>
                     </div>
                     
                  </div> 

                  <!--Menu section Ends here -->


                  <!--Main content section starts here -->

               <div class="main-content">
                    <div class="wrapper">
                      <h1 class="color">Manage Admin</h1>
                                  <br/>
                                  <br/>
                                  

                                  <?php 
                                
                                   
                    
                                       if (isset($_SESSION['add']))
                                        {
                                          
                                         echo  $_SESSION['add'];//displaying session message
                                         unset($_SESSION['add']);//removing session message 
                                       }

                                       if (isset($_SESSION['delete']))
                                        {
                                         echo $_SESSION['delete'];
                                         unset($_SESSION['delete']);
                                       }
                                       if (isset($_SESSION['update']))
                                        {
                                         echo $_SESSION['update'];
                                         unset($_SESSION['update']);
                                       }

                                       if (isset($_SESSION['user-not-found']))
                                        {
                                          echo $_SESSION['user-not-found'];
                                          unset($_SESSION['user-not-found']);
                                       }

                                       if (isset($_SESSION['pwd-not-match']))
                                        {
                                          echo $_SESSION['pwd-not-match'];
                                          unset($_SESSION['pwd-not-match']);
                                       }

                                       if (isset($_SESSION['change-pwd']))
                                        {
                                          echo $_SESSION['change-pwd'];
                                          unset($_SESSION['change-pwd']);
                                       }

                                    ?>
                                    <br/>
                                    <br/>
                                    

                            

         <!-- button to add admin -->
  <a href="add-admin.php" class="btn-primary">Add Admin</a>

              <br/>   <br/>   <br/>

               <table class="tbl-full  font">
                        <tr>
                             <th>S.no</th>
                              <th> Full Name</th>
                              <th> Username</th>
                              <th> Actions</th>

                         </tr>

                         <?php
                         //Qyery to get all admin

                         $sql= "SELECT * FROM tbl_admin";

                         //Execute the Query

                         $res = mysqli_query($conn,$sql);

                         //check whether the Query Executed or not

                         if ($res==TRUE) 
                         {
                            //count rows to check whethe we have Data in Database
                          $count = mysqli_num_rows($res);//function to get all the rows in database

                          $sn=1; //create a varial  and assign the value 

                          //check the number of rows
                          if ($count>0)
                           {
                             //we have data in database
                            while ($rows=mysqli_fetch_assoc($res)) 
                            {
                              //using while loop to get all the data from database
                              //and while loop will run as long as we have data in database

                              //get individual data

                              $id=$rows['id'];
                              $full_name=$rows['full_name'];
                              $username=$rows['username'];

                              //dispaly the values in our table
                              ?>
                              
                              <tr>
                                   <td><?php echo $sn++;?>.</td>
                                    <td> <?php echo $full_name;?></td>
                                    <td> <?php echo $username; ?></td>
                                     <td>
                                      <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="admin"> Change Password</a>
                                      <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                         <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                       </td>


                                    </tr>
                                    <?php 

 



                             }
                           }
                          else
                          {
                            //we do not have data in datbase
                          }
                        } 

                         ?>

                             

                                   

                   </table>

                        

                    </div>
               </div>

            <!--Main content section Ends here -->
            

       </body>
</html>






       	    