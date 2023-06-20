
<?php 
include('../config/constants.php');
include('login-check.php'); 

 ?>



<html class="order-bg">
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

       	       <div class="main-content" >
       	    	      <div class="wrapper" >
       	    		      <h1 class="color">Manage Order</h1>

       	    		      
                                  
                                  <br/>   <br/>   <br/>

                                  <?php
                                  if (isset($_SESSION['update'])) 
                                  {
                                          echo $_SESSION['update'];
                                          unset($_SESSION['update']);
                                   } 


                                  ?>

                                  <br> <br>

                                  <table class="tbl-full ">
                                         <tr>
                                                <th>S.no</th>
                                                <th>Food</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                <th> Date</th>
                                                <th>Status</th>
                                                <th>Name</th>
                                                <th>contact</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Actions</th>

                                         </tr>


                                         <?php 
                                         //get the orders from database
                                         $sql = " SELECT * FROM tbl_order ORDER BY id desc"; //display the latest order first

                                         //execute query
                                         $res = mysqli_query($conn,$sql);

                                         //count the rows
                                         $count = mysqli_num_rows($res);
                                         $sn = 1;

                                         if ($count>0)
                                          {
                                                // order available
                                                 while($row=mysqli_fetch_assoc($res))
                                                 {
                                                        //check al the order details
                                                        $id = $row['id'];
                                                        $food = $row['food'];
                                                        $price = $row['price'];
                                                        $qty = $row['qty'];
                                                        $total = $row['total'];
                                                        $order_date = $row['order_date'];
                                                        $status = $row['status'];
                                                        $customer_name = $row ['customer_name'];
                                                        $customer_contact = $row ['customer_contact'];
                                                        $customer_email =$row ['customer_email'];
                                                        $customer_address = $row['customer_address'];

                                                        ?>
                                                 <tr>
                                                     <td><?php echo $sn++; ?>.</td>
                                                     <td><?php  echo $food;?></td>
                                                     <td><?php echo $price; ?></td>
                                                     <td><?php echo $qty; ?></td>
                                                     <td><?php echo $total; ?></td>

                                                     <td><?php echo $order_date; ?></td>

                                                     <td>
                                                        <?php 
                                                        if ($status=="Ordered") 
                                                        {
                                                            echo "<label>$status</label>";   
                                                        }
                                                        elseif ($status=="On Delivery")
                                                         {
                                                               echo "<label style='color:orange;'>$status</label>";
                                                        }

                                                        elseif ($status=="Delivered")
                                                         {
                                                               echo "<label style='color:green;'>$status</label>";
                                                        }
                                                        elseif ($status=="Cancelled")
                                                         {
                                                               echo "<label style='color:red;'>$status</label>";
                                                        }




                                                         ?>
                                                               
                                                        </td>

                                                     <td><?php echo $customer_name; ?></td>
                                                     <td><?php echo $customer_contact; ?></td>
                                                     <td><?php echo $customer_email; ?></td>
                                                     <td><?php echo $customer_address; ?></td>

                                                     <td>
                                                            <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php  echo $id;?>" class="btn-secondary">Update Order</a>
                                                            
                                                     </td>
                                              </tr>


                                                        <?php
                                                 }
                                         }

                                         else
                                         {
                                          //order not available
                                          echo " <tr><td colspan='12' class='error'>Order not Available </td></tr>";
                                         }



                                         ?>

                                          
                                    

       	    	      </div>
       	       </div>

       	    <!--Main content section Ends here -->
       	    