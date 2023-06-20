
<?php 
include('../config/constants.php');
include('login-check.php'); 
 
?>



<html class="food-bg">
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
       	    		      <h1 class="color">Manage  Food</h1>



                                  <br/>
                                  <br/><br/> <br/>
                            

                                  <!-- button to add admin -->
                                  <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

                                  <br/>   <br/>   <br/>
                                  <?php 

                                  if (isset($_SESSION['add'])) 
                                  {
                                          echo $_SESSION['add'];
                                          unset($_SESSION['add']);
                                   }

                                   if (isset($_SESSION['delete'])) 
                                  {
                                          echo $_SESSION['delete'];
                                          unset($_SESSION['delete']);
                                   }

                                    if (isset($_SESSION['upload'])) 
                                  {
                                          echo $_SESSION['upload'];
                                          unset($_SESSION['upload']);
                                   }
                                    if (isset($_SESSION['unauthorize'])) 
                                  {
                                          echo $_SESSION['unauthorize'];
                                          unset($_SESSION['unauthorize']);
                                   }

                                   if (isset($_SESSION['update'])) 
                                  {
                                          echo $_SESSION['update'];
                                          unset($_SESSION['update']);
                                   }




                                  ?>
                                  <table class="tbl-full font">
                                         <tr>
                                                <th>S.no</th>
                                                <th>Title</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Featured</th>
                                                <th>Active</th>
                                                <th>Action</th>

                                         </tr>
                                         <?php
                                         //create sql query to get all the food
                                         $sql= "SELECT * FROM tbl_food";
                                         //execute the query
                                         $res = mysqli_query($conn,$sql);

                                         //count rows to check food is available or not
                                         $count = mysqli_num_rows($res);

                                         $sn=1;

                                         if ($count>0) 
                                         {
                                                // we have food
                                               //get the food fro database

                                          while($row=mysqli_fetch_assoc($res))
                                          {
                                                 //get the value from individual
                                                 $id = $row['id'];
                                                 $title = $row ['title'];
                                                 $price = $row ['price'];
                                                 $image_name = $row ['image_name'];
                                                 $featured = $row ['featured'];
                                                 $active = $row ['active'];
                                                 ?>
                                                 <tr>
                                                     <td><?php  echo $sn++;?>.</td>
                                                     <td><?php  echo $title;?></td>
                                                     <td> $ <?php  echo $price;?></td>
                                                     <td>
                                                        <?php
                                                        //check whether the image name is available or not

                                                        if ($image_name!="")
                                                         {
                                                               // display image
                                                               ?>

                                                               <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name;?>" width="80px" height="50px"  border=1px >

                                                               <?php
                                                        }

                                                        else{
                                                               //diplay the message
                                                               echo "<div class='error'> Image not added</div>";
                                                        } 
                                                        ?> 
                                                 </td>
                                                     <td><?php  echo $featured;?></td>
                                                     <td><?php  echo $active?> </td>
                                                     <td>
                                                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                                                     </td>
                                              </tr>                                              
                                                 <?php
                                          }

                                         }

                                         else
                                         {
                                          //food not added
                                          echo "<tr> <td  colspan='7' class='error'>Food not added yet. </td>  </tr>";
                                         }
                                         ?>

                                              

       	    	      </div>
       	       </div>
       	    <!--Main content section Ends here --> 
                  </table>    	    