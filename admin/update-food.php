<?php
ob_start(); 
?>
<?php 
include('../config/constants.php');
include('login-check.php'); 

 ?>

 <?php 

 //check whether the id is set or not

 if (isset($_GET['id'])) 
 {
        // get all the details
       $id = $_GET['id'];

       //sql query to get all the selected food
       $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
       //execute the query
       $res2 = mysqli_query($conn,$sql2);

       //get the value based on query executed

       $row2 = mysqli_fetch_assoc($res2);

       //get the individual values

       $title =  $row2['title'];
       $description = $row2['description'];
       $price = $row2['price'];
       $current_image = $row2['image_name'];
       $current_category = $row2['category_id'];
       $featured = $row2['featured'];
       $active = $row2['active'];


 }
 else
 {
       //redirect to manage-food
       header('location:'.SITEURL.'admin/manage-food.php');
 }


 ?>


<html class="update-category">
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

                  <!-- main content starts here -->

                  <div class="main-content">
                  <div class="wrapper log1 ">
                        <h1 class="clr1"> Update Food</h1>

              <br/> <br/> <br/>

              <form action="" method="POST"style="max-width:500px;margin:auto " enctype="multipart/form-data">




               <table class="tbl-30">

                <tr>
                   <td><b>Title:</b></td>
                    <td>

                        <input   type="text" placeholder="Food Title" name="title" value="<?php echo $title; ?>">
    
                        
                    </td>
                </tr> 

                <tr>
                    <td><b>Description:</b></td>
                    
                    <td>
                        <textarea name="description" cols="25" rows="5" placeholder="Description of the food" ><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    
                    <td><b>Price:</b></td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price?>" >
                    </td>
                </tr>


                    <tr>
                       <td> <b>Current Image:</b> </td>
                    

                    <td>
                      <?php
                      if ($current_image == "") 
                      {
                             // image not available
                            echo "<div class='error'>Image not available </div>";
                      }

                      else
                      {
                            //image available
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>"width=150px border=2px height=100px>
                            <?php
                      }


                       ?>
                    </td>
                </tr> 

                 <tr>
                       <td> <b>Select  New Image:</b> </td>
                    

                    <td>
                        <input type="file" name="image">
                    </td>
                </tr> 

                
                <tr>
                    
                    <td><b>Category:</b></td>
                    <td>
                        <select name="category">
                            <?php
                            //create php code to display categories from database

                            //create aql to get all active categories  from database

                            $sql =  "SELECT * FROM tbl_category WHERE active ='Yes' ";

                            //executing query


                            $res = mysqli_query($conn,$sql);

                            //count rows to check whether we have categories or not

                            $count = mysqli_num_rows($res);

                            //if count is greater than zero,we have categories else we do not have category

                            if ($count>0) 
                            {
                                // we have categories

                                while($row=mysqli_fetch_assoc($res))
                                {

                                    //get the details of categories
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];

                                    ?>
                                    <option <?php if ($current_category==$category_id) { echo "selected"; }?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?> </option> 
                                    <?php 
                                }

                            }

                            else
                            {
                                //we do not have category
                                ?>

                                 <option value="0">No category Found</option>
                           <?php
                           
                         
                          }
                         //display dropdown

                         ?>
                 
                            
                 

                           </select>
                       </td>
                  </tr>
                    
                    

                
                <tr>
                    <td><b>Featured:</b></td>
                    <td>
                        <input <?php if ($featured=="Yes") { echo "checked"; } ?> type="radio" name="featured" value="Yes"> Yes
                           <pre><input <?php if ($featured=="No") { echo "checked"; } ?> type="radio" name="featured" value="No"> No   </pre>
                    </td>
                </tr> 


                <tr>
                    <td><b>Active:</b></td>
                    <td>
                        <input <?php if ($active=="Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes"> Yes
                           <pre><input <?php if ($active=="No") { echo "checked"; } ?>  type="radio" name="active" value="No"> No   </pre>
                    </td>
                </tr>
                

             </table>


             <br><br> <br>

             <div>
                  <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                 <input type="hidden" name="id" value="<?php echo $id;?>">
                 
                 <input type="submit" name="submit" value="Update Food" class="btn1">
             </div>

                   

               </br> </br>
        </form>

        <?php

         //check the submit button clicked or not
         if (isset($_POST['submit'])) 
         {
                // clicked
              //echo "clicked";

              //1.get all the values from form
              $id= $_POST['id'];
              $title= $_POST['title'];
              $description = $_POST['description'];
              $price = $_POST['price'];
              $current_image=$_POST['current_image'];
              $category = $_POST['category'];
              $featured=$_POST['featured'];
              $active=$_POST['active'];

              //2.updating new image if selected

              //check whwther the image is selected or not
              if (isset($_FILES['image']['name']))
               {
                     // get the image details
                     $image_name=$_FILES['image']['name'];

                     //check image is available or not
                     if ($image_name !="") 
                     {
                            // image is available
                            //upload new image

                            //auto rename image
    //get the extension of our image(jpg,png,gf etc)

    $ext =end(explode('.',$image_name));

    //rename the image

    $image_name = "Food-Name-".rand(000,999).'.'.$ext; 



    $source_path = $_FILES['image']['tmp_name'];

    $destination_path = "../images/food/".$image_name;

    //upload the image
    $upload = move_uploaded_file($source_path, $destination_path);

    //check whether the image is uploaded or not
    //and if the image is not uploaded then will stop the process and redirect with erro message

    if($upload==false) 
    {
        //set message
        $_SESSION['upload'] = "<div class='error'> Failed to Upload image</div>";
    //redirect to add-category page
    header('location:'.SITEURL.'admin/manage-food.php');
    //stop the process
    //die();

}
        //remove the current image if available

       if ($current_image!="") 
       {
              $remove_path ="../images/food/".$current_image;

    $remove = unlink($remove_path);

    //check whether the image is removed or not

    //if failed to remove the display message and stop the procces
    if ($remove==false) 

    {
           // failed to remove the image
       $_SESSION['failed-remove'] = "<div class='error'> Failed to remove current image</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

       

    }
       
         }

                     }
                     else
                     {
                           $image_name = $current_image;  
                     }
              }
              else
              {
                     $image_name = $current_image;
              }


              //3.update the database
              $sql2 = " UPDATE tbl_food SET
              title ='$title',
              description='$description',
              price='$price',
              image_name='$image_name',
              category_id = '$category',
              featured = '$featured',
              active = '$active'
              WHERE id=$id 
              ";

              //execute the query
              $res2 = mysqli_query($conn,$sql2);



              //4.redirect to manage category
              //chech whether the query executed or not
              if ($res2==true) {
                     // category updated

                      $_SESSION['update'] = "<div class='success'>Successfully  updated food!!! </div>";
                      header('location:'.SITEURL.'admin/manage-food.php');
              }

              else
              {
                     //failed to update
                     $_SESSION['update'] = "<div class='error'>Failed to update food. </div>";
                      header('location:'.SITEURL.'admin/manage-food.php');
              }



         }


          ?>

