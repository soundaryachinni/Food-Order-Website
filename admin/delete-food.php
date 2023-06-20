<?php 
//include constant
include('../config/constants.php');


//echo "delete";

//check whether  value is passed 

if (isset($_GET['id']) && isset($_GET['image_name']))
 {
	// process to delete
	//echo "process to delete";

	//1.get id and image name
	$id = $_GET['id'];
	$image_name = $_GET['image_name'];

	//2.remove the image if available

	//check image is available or not delete only if available
	if ($image_name != "") 
	{
		// image available need to remove from folder

		// get the image path
		$path = "../images/food/".$image_name;

		//remove image
		$remove = unlink($path);

		//check image removed or not

		if ($remove==false) 
		{
			// failed to remove
			$_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";

			//redirect to manae food
			header('location:'.SITEURL.'admin/manage-food.php');
		}
	}

	//3.delete from database

	//sql query to delete data from database

 	$sql="DELETE FROM tbl_food WHERE id=$id";

 	//execute query
 	$res = mysqli_query($conn,$sql);

 	//check whether the data deleted or not
 	if ($res==true)
 	 {
 		// set success message and redirect
 		$_SESSION['delete']= "<div class='success'>Food deleted succssefully!!! </div>";
 		//redirect page
 		header('location:'.SITEURL.'admin/manage-food.php');
 	}
 	else
 	{
 		//set fail message and redirect
 		$_SESSION['delete']= "<div class='error'>Failed to delete food </div>";
 		//redirect page
 		header('location:'.SITEURL.'admin/manage-food.php');
 	}


}

else
{
	//redirect to manage page
	//echo "redirect";

	$_SESSION['unauthorize'] = "<div class='error'>Unauthorised Access.</div>";
	header('location:'.SITEURL.'admin/manage-food.php');
}


?>
