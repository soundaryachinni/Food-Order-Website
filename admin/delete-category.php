<?php 


//include constant file

include('../config/constants.php');
//echo "Delete page";

//check whether the id and image value set or not

if (isset($_GET['id']) AND isset($_GET['image_name']))
 {
 	// get value and delete
 	//echo "get value and delete";

 	$id = $_GET['id'];
 	$image_name = $_GET['image_name'];

 	//remove the image file if available

 	if ($image_name!= "")
 	 {
 		// image is available remove it

 		$path = "../images/category/".$image_name;

 		//removee the image
 		$remove = unlink($path);

 		//failed to remove image the add an error message and stop the process

 		if ($remove==false)
 		 {
 			//set the session message
 			$_SESSION['remove']= "<div class='error'>failed to remove category image </div>";
 			//redirect to manage-category page
 			header('location:'.SITEURL.'admin/manage-category.php');
 			//stop the procces
 			//die();

 		}
 	}

 	//redirect to manage category page

 	//sql query to delete data from database

 	$sql="DELETE FROM tbl_category WHERE id=$id";

 	//execute query
 	$res = mysqli_query($conn,$sql);

 	//check whether the data deleted or not
 	if ($res==true)
 	 {
 		// set success message and redirect
 		$_SESSION['delete']= "<div class='success'>category deleted succssefully!!! </div>";
 		//redirect page
 		header('location:'.SITEURL.'admin/manage-category.php');
 	}
 	else
 	{
 		//set fail message and redirect
 		$_SESSION['delete']= "<div class='error'>Failed to delete category  </div>";
 		//redirect page
 		header('location:'.SITEURL.'admin/manage-category.php');
 	}

 } 
 else
 {
 	//redirect to manage category page

 	header('location:'.SITEURL.'admin/manage-category.php');

 }

?>
