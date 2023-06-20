<?php include('../config/constants.php'); 
include('login-check.php');
?>




<html class="add-category">
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

<!-- main section starts here-->
  
         <div class="main-content">
                  <div class="wrapper log1 ">
                        <h1 class="clr"> Add Category</h1>
              <br/> <br/> <br/>

              <?php

               if (isset($_SESSION['add']))//checking whether the session set or not
               {
                    echo $_SESSION['add'];//Display  the session message if set
                    unset($_SESSION['add']);//remove the session message
               } 



               if (isset($_SESSION['upload']))//checking whether the session set or not
               {
                    echo $_SESSION['upload'];//Display  the session message if set
                    unset($_SESSION['upload']);//remove the session message
               }   

              
             ?>
             <br/> <br/>


              <form action="" method="POST"style="max-width:500px;margin:auto " enctype="multipart/form-data">

               <table class="tbl-30">

                <tr>
                   <td><b>Title:</b></td>
                    <td>

                        <input   type="text" placeholder="Category Title" name="title" >
    
                        
                    </td>
                </tr> 

        
                       <td> <b>Select Image:</b> </td>
                    

                    <td>
                        <input type="file" name="image">
                    </td>
                </tr> 

                
                <tr>
                    <td><b>Featured:</b></td>
                    <td>
                        <input  type="radio" name="featured" value="Yes"> Yes
                           <pre><input type="radio" name="featured" value="No"> No   </pre>
                    </td>
                </tr> 

                


                <tr>
                    <td><b>Active:</b></td>
                    <td>
                        <input  type="radio" name="active" value="Yes"> Yes
                           <pre><input type="radio" name="active" value="No"> No   </pre>
                    </td>
                </tr>
                

             </table>
             
                     

               </br> </br>
<input type="submit" name="submit" value="Add Category" class="btn">  
</form>

<?php 

//process the value from Form and save it in Database

// check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
  //button clicked
  //echo "button clicked";

       //1.get the data from the form

   $title = $_POST['title'];

   //for radio input we need to check whether the button is selected or not
   if (isset($_POST['featured'])) 
   {
       //get the value from form 
       $featured = $_POST['featured'];  
   }

   else
   {
       //set the default value
       $featured = "No";
   }

if (isset($_POST['active'])) 
   {
       //get the value from form 
       $active = $_POST['active'];  
   }

   else
   {
       //set the default value
       $active = "No";
   }

   //check whether the image is selecter or mot and set the value for image name accordingly
   //print_r($_FILES['image']);
   //die();//break the code

   if (isset($_FILES['image']['name'])) 
   {
       // upload image
    // to uplaod image we need image_name ,source path and destination path
    $image_name = $_FILES['image']['name'];

    //upload image only if image selected
    if ($image_name != "") {
        
    

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

    if($upload==false) {
        //set message
        $_SESSION['upload'] = "<div class='error'> Failed to Upload image</div>";
    //redirect to add-category page
    header('location:'.SITEURL.'admin/add-category.php');
    //stop the process
    //die();
}


   }

}
   else{
    //dont upload image and set the image_name value as blanck
    $image_name = "";
   }
   



   //2.SQL Query to save the data into database

   $sql = "INSERT INTO tbl_category SET
   title ='$title',
   image_name='$image_name',

   featured = '$featured',
   active = '$active'
     ";

     //3. Executing Query and saving Data into Database

     $res = mysqli_query($conn,$sql);


     //4.check whether the (Query is Executed)data inserted or not and display appropriate message
     if($res==TRUE)
     {
      
      //Data inserted
     // echo "Data inserted";
       $_SESSION['add'] = "<div class='success'> Category Added Successfully!!!</div>";
       //redirect to manage category page
        header("location:".SITEURL.'admin/manage-category.php');

     }
     else
     {
       //failed to add category

       $_SESSION['add'] = "<div class='error'> Failed to Add category!!!</div>";
       //redirect to manage category page
        header("location:".SITEURL.'admin/add-category.php');

     }
}

  ?>

       
      
                   


<!-- main section ends here-->