
<?php 
include('../config/constants.php'); 

 include('login-check.php'); 



?> 





<html class="home-bg">
<style type="text/css">
    
</style>
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

                     <div class="main-content  ">
       	       
       	    	      <div class="wrapper  ">
       	    		      <h1 class="color1">DASHBOARD</h1>
                                  <br/>  <br/> <br/>

                                  <?php 

                                   if (isset($_SESSION['login'])) 
                                        {
                                            echo $_SESSION['login'];
                                             unset($_SESSION['login']);
                                       }

                                 ?>

                                 <br/> <br/>



       	    		        <div class="col-4 text-center">
                                <?php
                                //sql query 

                                $sql = " SELECT * FROM tbl_category";

                                //execute query
                                $res = mysqli_query($conn,$sql);

                                //count the rows

                                $count = mysqli_num_rows($res);

                                ?>

       	    		        	<h1><?php echo $count; ?></h1>
       	    		        	<br/>
       	    		        	Categories
       	    		        	
       	    		        </div>

       	    		        <div class="col-4 text-center">

                                <?php
                                //sql query 

                                $sql2 = " SELECT * FROM tbl_food";

                                //execute query
                                $res2 = mysqli_query($conn,$sql2);

                                //count the rows

                                $count2 = mysqli_num_rows($res2);

                                ?>
       	    		        	<h1><?php echo $count2; ?></h1>
       	    		        	<br/>
       	    		        	Foods
       	    		        	
       	    		        </div>

       	    		        <div class="col-4 text-center">
                                <?php
                                //sql query 

                                $sql3 = " SELECT * FROM tbl_order";

                                //execute query
                                $res3 = mysqli_query($conn,$sql3);

                                //count the rows

                                $count3 = mysqli_num_rows($res3);

                                ?>

       	    		        	<h1><?php echo $count3; ?></h1>
       	    		        	<br/>
       	    		        	Total orders
       	    		        	
       	    		        </div>
       	    		        <div class="col-4 text-center">

                                <?php
                                //create sql query to get total revenue
                                //aggeregate function in sql

                                $sql4 = " SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                                //execute the quey

                                $res4 = mysqli_query($conn,$sql4);

                                //get the value
                                $row4 = mysqli_fetch_assoc($res4);

                                //get the total revenue
                                 $total_revenue = $row4['Total']; 


                                ?>
       	    		        	<h1>$<?php echo $total_revenue; ?></h1>
       	    		        	<br/>
       	    		        	Revenue Generated
       	    		        	
       	    		        </div>
       	    		        <div class="clearfix"></div>

       	    	      </div>
       	       </div>

       	    <!--Main content section Ends here -->

       	    