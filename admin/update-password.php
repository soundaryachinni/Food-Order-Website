<?php
 include('../config/constants.php');
 include('login-check.php'); 
 
?>





<html class="change-password">
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


                  <!-- main content starts here -->
                  <form action="" method="POST"style="max-width:500px;margin:auto">
 
      <div class="main-content">
             <div class="wrapper login-box1">
              <h2> Change Password</h2>
    <br/> <br/> <br/>

    <?php

    if (isset($_GET['id'])) 
    {
       $id=$_GET['id'];
     } 
     ?>
     <b>Current Password:</b>
    <div class="input-container">

                  
      
                   <input class="input-field" type="Password" placeholder=" Current Password" name="current_password" > 
    
             </div>
           <br/>
           <b>New Password:</b>
           <div class="input-container">

                   
                   <input class="input-field" type="password" placeholder="New password" name="new_password" > 
    
             </div>
           <br/>

           <b> Confirm Password:</b>
           <div class="input-container">
                    
                   <input class="input-field" type="password" placeholder="Confirm password" name="confirm_password" > 
    
             </div>
           <br/>

           <div>

        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" name="submit" value="Change Password" class="btn2">
    </div>

    <?php
             //check whether the submit button  is clicked or not
            if(isset($_POST['submit']))
            {
              //echo "clicked";

              //1.get the data from form

              $id=$_POST['id'];
              $current_password = md5($_POST['current_password']);
              $new_password = md5($_POST['new_password']);
              $confirm_password = md5($_POST['confirm_password']);
          


              //2.check whether the user with current id and current password exists or not

              $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

              //execute the query
             $res =mysqli_query($conn,$sql);

              if ($res==true)
               {
                //check whether the data is available ornot
                $count=mysqli_num_rows($res);

                if ($count==1) 
                {
                  //user exists and password can be changed
                 //echo "User Found";

                  //check whether the new password match or not
                  if ($new_password==$confirm_password) 
                  {
                    //update the password
                    //echo"password match";
                    $sql2="UPDATE tbl_admin SET
                     password='$new_password'
                     WHERE id=$id
                    ";
                    //execute the query
                    $res2 =mysqli_query($conn,$sql2);

                    //check  whether the query executed or not
                    if ($res2==true)
                     {
                      //display success message
                       $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully!!!</div>";

                  //redirect the user 
                  header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                      //display error message
                       $_SESSION['change-pwd'] = "<div class='error'> Failed to  change Password</div>";

                  //redirect the user 
                  header('location:'.SITEURL.'admin/manage-admin.php');

                    }
                  }

                  else
                  {
                    //redirect to manage admin page
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Did Not Match</div>";

                  //redirect the user 
                  header('location:'.SITEURL.'admin/manage-admin.php');
                  }
                }
                else
                {
                  //user does not exist set message and redirect
                 $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";

                  //redirect the user 
                  header('location:'.SITEURL.'admin/manage-admin.php');
                }

              }

              //3.check whether the new password and confirm password match or not

              //4.change password if all above is true

            }



     ?>


                  <!-- main content ends here -->

