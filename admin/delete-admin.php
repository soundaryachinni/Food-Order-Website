<?php
//include constants.php file here
include('../config/constants.php');


//1.get the id of the Admin to be deleted
$id = $_GET['id'];

//2.create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res = mysqli_query($conn,$sql);

//check whether the query executed successfully or not
if($res==TRUE)
{
	//query executed successfully and admin deleted
	//echo "Admin Deleted";

	//create session variable to display message

	$_SESSION['delete'] = "<div class='success'>Admin Deleted successfully!!!</div>";

	//redirect to manage admin file
	header('location:'.SITEURL.'admin/manage-admin.php');

}
else
{
	//query failed to delete admin
	//echo "Failed to Delete Admin";
	$_SESSION['delete'] = "<div class='error'>Failed to Delete Admin.Try Again Later</div>";

	header('location:'.SITEURL.'admin/manage-admin.php');
}



//3.redirect to manage admin page with message  success /error

?>