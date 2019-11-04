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
		<title>Message</title>
		<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
		<script>
			tinymce.init({selector:'textarea'});
		</script>
	</head>

	<body bgcolor="skyblue">
		<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="795" border="2" bgcolor="#187eae">
		<tr align="center">
			<td colspan="7"><h2>Add Message</h2></td>
		</tr>
		
		<tr>
			<td colspan="7"><b>Message:</b></td>
			<td><textarea name="message" cols="20" rows="10" value=""/></textarea></td>	

		</tr>
		
		<tr>
			<td colspan="7"><b>Sender ID:</b></td>
			<td><select name="sender_id">
			<?php
			$get_sender="select * from senders";
			$run_sender=mysqli_query($con,$get_sender);
			while ($row_sender=mysqli_fetch_array($run_sender)){
			
			$Sender_id=$row_sender['Sender_id'];
			$User_id=$row_sender['User_id'];
			echo "<option value='$Sender_id'>$Sender_id</option>";
			}
			?>
			</select>
			</td>	
		</tr>

		<tr>
			<td colspan="7"><b>Receiver ID:</b></td>
			<td><select name="receiver_id">
			<?php
			$get_receiver="select * from receivers";
			$run_receiver=mysqli_query($con,$get_receiver);
			while ($row_receiver=mysqli_fetch_array($run_receiver)){
			
			$Receiver_id=$row_receiver['Receiver_id'];
			$User_id=$row_receiver['User_id'];
			echo "<option value='$Receiver_id'>$Receiver_id</option>";
			}
			?>
			</select>
			</td>	
		</tr>
		<tr>
			<td colspan="7"><b>Type of service:</b></td>
			<td><select name="service">
				<option>Help Post</option>
				<option>Shopping Request</option>
				<option>Food Request</option>
			</select>
			</td>
		</tr>

			
		<tr>
			<td colspan="7"><b>Help Post ID:</b></td>
			<td><select name="help_id">
				<option></option>
						<?php
						$get_help="select * from help_posts";
						$run_help=mysqli_query($con,$get_help);
						while ($row_help=mysqli_fetch_array($run_help)){
			
						$Help_post_id=$row_help['Help_post_id'];
			
						echo "<option value='$Help_post_id'>$Help_post_id</option>";
						}
						?>
					</select>
				</td>
		</tr>
		<tr>
			<td colspan="7"><b>Shopping Request ID:</b></td>
			<td><select name="shopping_id">
				<option></option>
						<?php
						$get_shopping="select * from shopping_request";
						$run_shopping=mysqli_query($con,$get_shopping);
						while ($row_shopping=mysqli_fetch_array($run_shopping)){
			
						$Shopping_request_id=$row_shopping['Shopping_request_id'];
			
						echo "<option value='$Shopping_request_id'>$Shopping_request_id</option>";
						}
						?>
					</select>
				</td>
		</tr>
		<tr>
			<td colspan="7"><b>Food Request ID:</b></td>	
			<td><select name="food_id">
				<option></option>
						<?php
						$get_food="select * from food_request";
						$run_food=mysqli_query($con,$get_food);
						while ($row_food=mysqli_fetch_array($run_food)){
			
						$Food_request_id=$row_food['Food_request_id'];
			
						echo "<option value='$Food_request_id'>$Food_request_id</option>";
						}
						?>
					</select>
				</td>
		</tr>
		

		
		<tr align="center">
			<td colspan="7"><input type="submit" name="submit_message" value="Submit Message"/></td>
		</tr>
	</table>
</form>
</body>
</html>

<?php
	if(isset($_POST['submit_message'])){
		
		$message=$_POST['message'];
		$sender_id =$_POST['sender_id'];
		$receiver_id =$_POST['receiver_id'];
		$help_id=$_POST['help_id'];
		$shopping_id=$_POST['shopping_id'];
		$food_id=$_POST['food_id'];
		$insert_message= "insert into messages (Message,Sender_id,Receiver_id,Shopping_request_id,Help_post_id,Food_request_id) values ('$message','$sender_id','$receiver_id','$shopping_id','$help_id','$food_id')";
		$run_message=mysqli_query($con, $insert_message);
		echo mysqli_error($con);
			if($run_message){
			echo "<script>alert('Message sent!')</script>";
			echo "<script>window.open('helplaa_track_user_message.php','_self')</script>";
			}
		
	}	

?>
<?php }?>