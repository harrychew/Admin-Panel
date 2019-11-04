<?php    
session_start();
include("includes/db.php");
if(!isset($_SESSION['admin_id'])){
    echo "<script>window.open('login.php?not_admin=You are not an Admin','_self')
    </script>"; //put this at the top of every php file in admin panel to 
                //prevent people from directly go to the php file by typing 
                //the url in the brower, example: 'localhost/ecommerce/view_cats.php'
}else{
    $admin_id=$_SESSION['admin_id'];
	if(isset($_GET['delete_user'])){
		$delete_id=$_GET['delete_user'];
		$delete_user="delete from users where User_id='$delete_id'";
		$run_delete =mysqli_query($con,$delete_user);
		if($run_delete){
			echo "<script>alert('A User has been deleted!')</script>";
			echo "<script>window.open('helplaa_user.php','_self')</script>";
		}
	}
}
?>