<?php 
include('../config/constants.php');
include('login-check.php'); 

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
             <div class="wrapper log1">
              <h1 class="clr1"> Update Catagory</h1>

    <br/> <br/> <br/>

    <?php

    //check whether the id is set or not
    if (isset($_GET['id'])) 
    {
     	// get the id and all details
     	//echo"getting the data";

     	$id= $_GET['id'];
     	//create sql query to get all details
     	$sql = "SELECT * FROM tbl_category WHERE id=$id";

     	//execute the query
     	$res = mysqli_query($conn,$sql);

     	//count the rows to check whether the id is valid or not
     	$count = mysqli_num_rows($res);

     	if ($count==1)
     	 {
     	 	// get all the data

     	 	$row =mysqli_fetch_assoc($res);
     	 	$title = $row['title'];
     	 	$current_image=$row['image_name'];
     	 	$featured=$row['featured'];
     	 	$active=$row['active'];



     	 } 

     	 else
     	 {
     	 	//redirect to manage category page with session message
     	 	$_SESSION['no-category-found'] = "<div class='error'>category not Found </div>";

     	 	//redirect to manage category

     	header('location:'.SITEURL.'admin/manage-category.php');

     	 }

     }

     else
     {
     	//redirect to manage category

     	header('location:'.SITEURL.'admin/manage-category.php');



     
     } 


    ?>

    <form action="" method="POST"style="max-width:500px;margin:auto " enctype="multipart/form-data">

             <table class="tbl-30">

             	<tr>
             		<td><b>Title:</b></td>
             		<td>

             			<input   type="text" placeholder="Category Title" name="title" value="<?php echo $title;?>">
    
             			
             		</td>
             	</tr>



             


             	<tr>
             		
             			<td><b>Current Image:</b></td>
             			<td>
             				
             				            <?php
                                               if ($current_image != "") 
                                               {
                                                      // display image.
                                                 ?>
                                                 <img src="<?php echo SITEURL ;?>images/category/<?php echo $current_image;?>"width=150px border=2px >
                                                 <?php 

                                               }

                                               else
                                               {
                                                 //display message
                                                 echo "<div class='error'> Image not added</div>";
                                               }

                                                ?>
             				
             			</td>
             		
             	</tr>

             	<tr>
             		<td>
             			<b>New Image:</b>
             		</td>

             		<td>
             			<input type="file" name="image">
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
             			<input <?php if ($active=="Yes") { echo "checked"; } ?>   type="radio" name="active" value="Yes"> Yes
                           <pre><input <?php if ($active=="No") { echo "checked"; } ?>  type="radio" name="active" value="No"> No   </pre>
             		</td>
             	</tr>
             	

             </table>
                  
             
             
        <br> <br>
        <div>
              <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
              <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" name="submit" value="Update Category" class="btn1">
    </div>

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
              $current_image=$_POST['current_image'];
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

    $image_name = "Food_Category_".rand(000,999).'.'.$ext; 



    $source_path = $_FILES['image']['tmp_name'];

    $destination_path = "../images/category/".$image_name;

    //upload the image
    $upload = move_uploaded_file($source_path, $destination_path);

    //check whether the image is uploaded or not
    //and if the image is not uploaded then will stop the process and redirect with erro message

    if($upload==false) 
    {
        //set message
        $_SESSION['upload'] = "<div class='error'> Failed to Upload image</div>";
    //redirect to add-category page
    header('location:'.SITEURL.'admin/manage-category.php');
    //stop the process
    //die();

}
        //remove the current image if available

       if ($current_image!="") 
       {
              $remove_path ="../images/category/".$current_image;

    $remove = unlink($remove_path);

    //check whether the image is removed or not

    //if failed to remove the display message and stop the procces
    if ($remove==false) 

    {
           // failed to remove the image
       $_SESSION['failed-remove'] = "<div class='error'> Failed to remove current image</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

       

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
              $sql2 = " UPDATE tbl_category SET
              title ='$title',
              image_name='$image_name',
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

                      $_SESSION['update'] = "<div class='success'>Successfully  updated category!!! </div>";
                      header('location:'.SITEURL.'admin/manage-category.php');
              }

              else
              {
                     //failed to update
                     $_SESSION['update'] = "<div class='error'>Failed to update category. </div>";
                      header('location:'.SITEURL.'admin/manage-category.php');
              }



         }


          ?>





