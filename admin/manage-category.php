
<?php 
include('../config/constants.php');
 
include('login-check.php'); 
 

?>



<html class="category-bg">
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
       	    		      <h1 class="color">Manage Category</h1>


                                  <br/>
                                  <br/><br/> <br/>

                                   <?php

               if (isset($_SESSION['add']))//checking whether the session set or not
               {
                    echo $_SESSION['add'];//Display  the session message if set
                    unset($_SESSION['add']);//remove the session message
               }  

               if (isset($_SESSION['remove']))//checking whether the session set or not
               {
                    echo $_SESSION['remove'];//Display  the session message if set
                    unset($_SESSION['remove']);//remove the session message
               } 




               if (isset($_SESSION['delete']))//checking whether the session set or not
               {
                    echo $_SESSION['delete'];//Display  the session message if set
                    unset($_SESSION['delete']);//remove the session message
               } 


               if (isset($_SESSION['no-category-found']))//checking whether the session set or not
               {
                    echo $_SESSION['no-category-found'];//Display  the session message if set
                    unset($_SESSION['no-category-found']);
             }

             if (isset($_SESSION['update']))//checking whether the session set or not
               {
                    echo $_SESSION['update'];//Display  the session message if set
                    unset($_SESSION['update']);
             }

             if (isset($_SESSION['upload']))//checking whether the session set or not
               {
                    echo $_SESSION['upload'];//Display  the session message if set
                    unset($_SESSION['upload']);
             }

             if (isset($_SESSION['failed-remove']))//checking whether the session set or not
               {
                    echo $_SESSION['failed-remove'];//Display  the session message if set
                    unset($_SESSION['failed-remove']);
             }








             ?>
             <br/> <br/>
                            

                                  <!-- button to add admin -->
                                  <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>

                                  <br/>   <br/>   <br/>  

                                  <table class="tbl-full font">
                                         <tr>
                                                <th>S.no</th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Featured</th>
                                                <th>Active</th>
                                                <th>Action</th>

                                         </tr>


                                         <?php

                                         //query to get all category  from database

                                         $sql = "SELECT * FROM tbl_category";

                                         //execute query
                                         $res = mysqli_query($conn,$sql);

                                         //count rows
                                         $count = mysqli_num_rows($res);

                                         //create serial number variable
                                         $sn=1;

                                         //check whether data in database or not

                                         if ($count>0) 
                                         {
                                                 // we have data in database

                                          //get data and display

                                          while ($row=mysqli_fetch_assoc($res))
                                           {
                                                 // get individual data

                                                 $id =$row['id'];
                                                 $title=$row['title'];
                                                 $image_name=$row['image_name'];
                                                 $featured=$row['featured'];
                                                 $active=$row['active'];

                                                 ?>

                                   <tr>

                                                     <td><?php echo $sn++; ?></td>
                                                    <td><?php echo $title; ?></td>


                                                     <td>
                                                        <?php 

                                                        //check whether the image name is available or not

                                                        if ($image_name!="")
                                                         {
                                                               // display image
                                                               ?>

                                                               <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="80px" height="50px"  border=1px >

                                                               <?php
                                                        }

                                                        else{
                                                               //diplay the message
                                                               echo "<div class='error'> Image not added</div>";
                                                        }


                                                         ?>
                                                               
                                                        </td>


                                                   <td><?php echo $featured; ?></td>
                                                 <td><?php echo $active; ?></td>
                                          <td>
                                                 
                                                 <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update category</a>
                                                 <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Caterory</a>
                                          </td>

                                                


                                   </tr>



                                                 <?php


                                          }

                                          }

                                          else{
                                                 //we dont have data

                                                 //we'll display the mesage inside table

                                                 ?>

                                                 <tr>
                                                      <td colspan="6">
                                                             <div class="error">No Category Added.</div>
                                                      </td>  

                                                 </tr>

                                                 <?php



                                          }



                                         ?> 

                                         

                                              
                                  

       	    		        

       	    	      </div>
       	       </div>

       	    <!--Main content section Ends here -->
       	    

