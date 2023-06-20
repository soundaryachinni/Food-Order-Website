
<?php include('../config/constants.php');?>
<html class="login-bg">
       <head>
                   <title> Login- Food Order System</title>
                   <link rel="stylesheet" href="../css/admin1.css">
                   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                  
       </head>

       <body>
       	
       	 <div class="login">

       	 	<h1 class="text-center ">Login</h1> <br/>  <br/> <br/> <br/>

          <?php 

          if (isset($_SESSION['login'])) 
          {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
          }

          if (isset($_SESSION['no-login-message'])) 
          {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
          }


          ?>

          <br/> <br/>

        


       	 	<!--login form starts here-->
          

       	 	<form action="" method="POST"style="max-width:500px;margin:auto" >
                <b>Username:</b>
       	 		<div class="input-container ">
              <i class="fa fa-user icon"></i>
          <input class="input-field" type="text" placeholder=" Enter your Username" name="username">
         </div> <br/>  

          <b>Password:</b>
         <div class="input-container">
     <i class="fa fa-lock icon"></i>
    <input class="input-field" type="password" placeholder="Enter your password" name="password" id="myInput"> <br/> <br/>
  </div>
  <br/>

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

<input type="submit" name="submit" value="Login" class="btn-login">  





       	 	<!--login form ends here-->

       	 	
       	 </div>
       </body>

       <?php 

            //check whether the submit button clicked or not

       if (isset($_POST['submit'])) 
       {
         //process for login
        //1.get the data from the login form

         $username=$_POST['username'];
         $password=md5($_POST['password']);

         //2.SQL to check whether the user with username and password exist or not

         $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

         //3.execute the query
         $res=mysqli_query($conn,$sql);

         //4.count rows to check whether the user exist or not

         $count=mysqli_num_rows($res);

         if ($count==1) 
         {
           // user available and login success

          $_SESSION['login'] ="<div class='success'>LOGIN SUCCESSFUL!!!</div>";
          $_SESSION['user']=$username; // to check whether the user logged in or not and logout will unset it


          //redirect to home page or dashboard
          header('location:'.SITEURL.'admin/');
         }
         else
         {
          //users not available and login fails

          $_SESSION['login'] ="<div class='error text-center'>Username and password did not match!!!</div>";

          //redirect to home page or dashboard
          header('location:'.SITEURL.'admin/login.php');

         }



       }
     ?>