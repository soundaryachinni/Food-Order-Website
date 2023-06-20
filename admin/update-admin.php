<?php 
include('../config/constants.php');
include('login-check.php'); 

 ?>






<html class="update-admin">
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
             <div class="wrapper login-box ">
              <h1 class="clr1"> Update Admin</h1>
    <br/> <br/> <br/>

    <?php

    //1.get the id of selected admin

    $id=$_GET['id'];

    //2.create sql query to get details
    $sql="SELECT * FROM tbl_admin WHERE id=$id";

    //execute the query
     $res=mysqli_query($conn,$sql);

     //check whether the query executed or not
     if ($res==true) 
     {
       //check whether the available or not
      $count =mysqli_num_rows($res);

      //check whether we have admin data or not
      if ($count==1) 
      {
        //get the details
        //echo "Admin Available";
        $row=mysqli_fetch_assoc($res);

        $full_name = $row['full_name'];
        $username = $row['username'];
      }
      else
      {
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
      }

     }



    ?>

 
    <div class="input-container">
      
      
      
                   <input class="input-field" type="text" placeholder="Enter your Full Name" name="Full_name" value="<?php echo $full_name;?>"> 
    
             </div>
           <br/>

           <div class="input-container ">
    <input class="input-field" type="text" placeholder=" Enter your Username" name="username" value="<?php echo $username;?>">
 </div> 
  <br/>

  <div>
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" name="submit" value="Update Admin" class="btn1">
    </div>  

    <?php

    //check whether the button clicked or not

    if(isset($_POST['submit'])) 
    {
      //echo "Button clicked";

      //get all the values from form to update
      $id = $_POST['id'];
       $Full_name =$_POST['Full_name'];
       $username = $_POST['username'];

       //create a sql query to update admin

       $sql="UPDATE tbl_admin SET
       full_name ='$Full_name',
      username = '$username'
      WHERE id='$id'

      ";

      //execute the query
      $res =mysqli_query($conn,$sql);

      //check whether the query executed successfully or not
       if($res==true)
       {
        //query executed and Admin updated 
        $_SESSION['update']="<div class='success'>Admin Updated Successfully!!!</div>";

        //redirect to manage admin page
        header("location:".SITEURL.'admin/manage-admin.php');
       }
       else
       {
        //failed to update admin
        $_SESSION['update']="<div class='error'>Failed to Updated !!!</div>";

        //redirect to manage admin page
        header("location:".SITEURL.'admin/manage-admin.php');

       }

    }
    ?>




  <!-- main content ends here -->