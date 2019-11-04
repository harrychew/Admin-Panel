<!DOCTYPE>
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

?>

<html>
	<head>
		<title>Request for help</title>
		<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
		<script>
			tinymce.init({selector:'textarea'});
		</script>
	</head>
	<body bgcolor="skyblue">
		<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="795" border="2" bgcolor="#187eae">
		<tr align="center">
			<td colspan="7"><h2>Request for help</h2></td>
		</tr>
		
		<tr>
			<td colspan="7"><b>User ID:</b></td>
			<td><select name="user_id">
			<?php
			$get_user="select * from users";
			$run_user=mysqli_query($con,$get_user);
			while ($row_user=mysqli_fetch_array($run_user)){
			
			$User_id=$row_user['User_id'];
			$Name=$row_user['Name'];
			
			echo "<option value='$User_id'>$User_id</option>";
			}
			?>
			</select>
			</td>	

		</tr>
		
		<tr>
			<td colspan="7"><b>Helper ID:</b></td>
			<td><select name="helper_id">
			<?php
			$get_helper="select * from helpers";
			$run_helper=mysqli_query($con,$get_helper);
			while ($row_helper=mysqli_fetch_array($run_helper)){
			
			$Helper_id=$row_helper['Helper_id'];
			$User_id=$row_helper['User_id'];
			echo "<option value='$Helper_id'>$Helper_id</option>";
			}
			?>
			</select>
			</td>	
		</tr>
		<tr>
			<td colspan="7"><b>Post title:</b></td>
			<td><input type="text" name="post_title" size="60" value=""/>
			</td>
		</tr>

		<tr>
			<td colspan="7"><b>Post Description:</b></td>
			<td><textarea name="post_description" cols="20" rows="10" value=""/></textarea></td>
		</tr>


		<tr>
			<td colspan="7"><b>Reward:</b></td>
			<td><input type="text" name="reward" size="60" value=""/>
			</td>
		</tr>

		<tr>
			<td colspan="7"><b>Latitude:</b></td>
			<td><input type="text" name="latitude" size="60" value=""/>
			</td>
		</tr>

		<tr>
			<td colspan="7"><b>Longitude:</b></td>
			<td><input type="text" name="longitude" size="60" value=""/>
			</td>
		</tr>

		<tr>
			<td colspan="7"><b>Address:</b></td>
			<td><input type="text" name="address" size="60" value=""/>
			</td>
		</tr>
			
		<tr align="center">
			<td colspan="7"><input type="submit" name="submit_request" value="Submit request"/></td>
		</tr>
	</table>
</form>
</body>
</html>

<?php
	if(isset($_POST['submit_request'])){

		$user_id=$_POST['user_id'];
		$helper_id =$_POST['helper_id'];
		$post_title =$_POST['post_title'];
		$post_description =$_POST['post_description'];
		$reward =$_POST['reward'];
		$latitude =$_POST['latitude'];
		$longitude =$_POST['longitude'];
		$address =$_POST['address'];
		$status ="In progress";

		$insert_help= "insert into help_posts (User_id,Post_title,Post_description,Reward,Latitude,Longitude, Address,Helper_id,status) values ('$user_id','$post_title','$post_description','$reward','$latitude','$longitude','$address','$helper_id','$status')";
		$run_post=mysqli_query($con, $insert_help);
		
		if($run_post){
			echo "<script>alert('Request submitted!')</script>";
			echo "<script>window.open('helplaa_track_user_activity.php','_self')</script>";
		}
		
	}	

?>
<?php } ?>