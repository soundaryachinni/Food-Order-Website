

<?php 
include('../config/constants.php');
include('login-check.php'); 
 

?>




<html class="add-admin">
       <head>
                   <title> Food Order Website - Home page</title>
                   <link rel="stylesheet" href="../css/admin1.css">
                   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                  
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


<!-- main section starts here-->
<form action="" method="POST"style="max-width:500px;margin:auto">
 
      <div class="main-content">
	           <div class="wrapper login-box ">
		          <h1 class="clr"> Add Admin</h1>
		<br/> <br/> <br/>

    <?php

    if (isset($_SESSION['add']))//checking whether the session set or not
     {
        echo $_SESSION['add'];//Display  the session message if set
        unset($_SESSION['add']);//remove the session message
      }  
    ?>


                   <b>Full Name:</b>
		           <div class="input-container">
      
                   <input class="input-field" type="text" placeholder="Enter your Full Name" name="Full_name">
    
             </div>

     
           <br/>

<b>User Name:</b>
<div class="input-container ">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder=" Enter your Username" name="username">
 </div> 
  <br/>
  
<b>Password:</b>
  <div class="input-container">
     <i class="fa fa-lock icon"></i>
    <input class="input-field" type="password" placeholder="Enter your password" name="password" id="myInput"> <br/> <br/>
  </div>

    <div>
      <input type="checkbox" onclick="myFunction()">Show Password
    </div>
  <br/>

  <script>
function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>


    <input type="submit" name="submit" value="Add Admin" class="btn">  

	</div>
</div>
</form>	

<?php
//process the value from Form and save it in Database

// check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
  //button clicked
  //echo "button clicked";
 

  //1.get the data from the form

   $Full_name = $_POST['Full_name'];
   $username = $_POST['username'];
   $password =md5($_POST['password']); //password Encryption with md5

   //2.SQL Query to save the data into database

   $sql = "INSERT INTO tbl_admin SET
   full_name ='$Full_name',
   username = '$username',
   password = '$password'
     ";

    //3. Executing Query and saving Data into Database

     $res = mysqli_query($conn,$sql) or die(mysqli_error());

     //4.check whether the (Query is Executed)data inserted or not and display appropriate message
     if($res==TRUE)
     {
      //Data inserted
     // echo "Data inserted";


      //create a session variable to display the message

      $_SESSION['add']= "<div class='success'>Admin Added Successfully!!!</div>";

      //redirect page to manage admin

      header("location:".SITEURL.'admin/manage-admin.php');


     } 
     else
     {
      //Data is failed to insert
      //echo "failed to insert Data";

      //create a session variable to display the message

      $_SESSION['add']= "<div class='error'>Failed to Add Admin !!!</div>";

      //redirect page to Add admin

      header("location:".SITEURL.'admin/add-admin.php');

     }
  }

?>