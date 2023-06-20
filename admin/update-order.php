<?php include('../config/constants.php'); 
include('login-check.php');
?>




<html class="update-order">
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

                  <form action="" method="POST"style="max-width:500px;margin:auto">
 
      <div class="main-content">
             <div class="wrapper  ">
              <h1 class="clr1"> Update Order</h1>
    <br/> <br/> <br/>

    <?php
    //check id is set or not
    if (isset($_GET['id'])) 
    {
            // get the order details
       $id=$_GET['id'];

       //get all other details based on this id

       //sql to get order details
       $sql= "SELECT * FROM tbl_order WHERE id=$id";

       //execute query
       $res = mysqli_query($conn,$sql);

       //count the rows

       $count = mysqli_num_rows($res);

       if ($count==1)
        {
              // data available
              $row = mysqli_fetch_assoc($res);

              $food = $row['food'];
              $price = $row['price'];
              $qty = $row['qty'];
              $status = $row['status'];
              $customer_name = $row['customer_name'];
              $customer_contact = $row['customer_contact'];
              $customer_email = $row['customer_email'];
              $customer_address = $row['customer_address'];


       }

       else
       {
              //data not available 
              header('location:'.SITEURL.'admin/manage-order.php');
       }


     } 
     else
     {
       //redirect to manage order page
       header('location:'.SITEURL.'admin/manage-order.php');
     }


    ?>

    <table>

                <tr>

                 <td><b>Food Name:</b></td>
                         
                   <td><b><?php echo $food;?></b></td>
    
             </tr>

             <tr>
                    <td><b>Price:</b></td>
                    <td><b>$<?php echo $price;?></b></td>
             </tr>

             <tr>
               <td><b>Quantity:</b></td>
                    <td> 
                   <input  type="number" name="qty" value="<?php echo $qty; ?>">
            </td>
    
             </tr>

                 <tr>
                    <td><b>Status:</b></td>
                         <td>
                            <select name="status" >
                                   <option <?php if($status=="Ordered"){echo "selected";} ?>value="Ordered" >Ordered</option>
                                   <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery"> On Delivery</option>
                                   <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                                   <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                                   

                                   
                            </select>
                     </td>
                     </tr>

                 <tr>
                     <td><b>Customer Name:</b></td>
                      <td>   
                   <input  type="text" name="customer_name" value="<?php echo $customer_name;?>">
            </td>
    
             </tr>
             <tr>

             <td><b>Customer Contact:</b></td>
                         
                  <td>
                   <input  type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
            </td>
    
             </tr>
             <tr>

             <td><b>Customer Email:</b></td>
                    <td>

                   <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
            </td>
    
             </tr>
        
        <tr>
             <td><b>Customer Address:</b></td>
                  <td>
      
                       <textarea  name="customer_address" cols="30" rows="5">  <?php echo $customer_address;?>
                              
                       </textarea>
                </td>
    
             </tr>

      </table>

             


                     <br> <br> <br>

                     <div>
                            <input type="hidden" name="id" value="<?php  echo $id;?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <input type="submit" name="submit" value="Update Order" class="btn1">  

                     </div>
              </form>

              <?php

              //check the submit button clicked or not
              if (isset($_POST['submit']))
               {
                    // echo "clicked";

                     //get al the values fro form
                     $id = $_POST['id'];
                     $price = $_POST['price'];
                     $qty = $_POST['qty'];
                     $total = $price * $qty;

                     $status = $_POST['status'];
                     $customer_name = $_POST['customer_name'];
                     $customer_contact = $_POST['customer_contact'];
                     $customer_email = $_POST['customer_email'];
                     $customer_address = $_POST['customer_address'];


                     //update the value
                     $sql2 = "UPDATE tbl_order SET

                     qty = '$qty',
                     total = '$total',
                     status = '$status',
                     customer_name = '$customer_name',
                     customer_contact = '$customer_contact',
                     customer_email = '$customer_email',
                     customer_address = '$customer_address'
                     WHERE id=$id 
                     ";

                     //execute the query
                     $res2 =  mysqli_query($conn,$sql2);

                     //check uptated or not

                     if ($res2==true) 
                     {
                            // updated

                            $_SESSION['update'] = "<div class='success'>Order Updated Successfully!!! </div>";

                            header('location:'.SITEURL.'admin/manage-order.php');
                     }
                     else
                     {
                            //failed to updated
                            $_SESSION['update'] = "<div class='error'>Failed to Update order.. </div>";

                            header('location:'.SITEURL.'admin/manage-order.php');
                     }


                     //redirect to manage order with message
               } 



              ?>



    

