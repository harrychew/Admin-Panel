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
		<title>Request for Food</title>
		<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
		<script>
			tinymce.init({selector:'textarea'});
		</script>
	</head>
	<body bgcolor="skyblue">
		<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="795" border="2" bgcolor="#187eae">
		<tr align="center">
			<td colspan="7"><h2>Request for Food</h2></td>
		</tr>
		
		<tr>
			<td colspan="7"><b>Requester ID:</b></td>
			<td><select name="requester_id">
			<?php
			$get_requester="select * from requesters";
			$run_requester=mysqli_query($con,$get_requester);
			while ($row_requester=mysqli_fetch_array($run_requester)){
			
			$Requester_id=$row_requester['Requester_id'];

			echo "<option value='$Requester_id'>$Requester_id</option>";
			}
			?>
			</select>
			</td>	

		</tr>
		
		<tr>
			<td colspan="7"><b>Transporter ID:</b></td>
			<td><select name="transporter_id">
			<?php
			$get_transporter="select * from transporters";
			$run_transporter=mysqli_query($con,$get_transporter);
			while ($row_transporter=mysqli_fetch_array($run_transporter)){
			
			$Transporter_id=$row_transporter['Transporter_id'];
			
			echo "<option value='$Transporter_id'>$Transporter_id</option>";
			}
			?>
			</select>
			</td>	
		</tr>
		<tr>
			<td colspan="7"><b>Total Amount(RM):</b></td>
			<td ><input type="text" name="total_amount" size="20" placeholder="(in 0.00)" value=""/>
			</td>
		</tr>
		<tr>
			<td colspan="7"><b>Delivery Time(YYYY-MM-DD HH:MM:SS):</b></td>
			<td><input type="text" name="delivery_time" size="20" placeholder="YYYY-MM-DD HH:MM:SS " value=""/>
			</td>
		</tr>

		<tr>
			<td colspan="7"><b>Collector ID:</b></td>
			<td><select name="collector_id">
			<?php
			$get_collector="select * from collectors";
			$run_collector=mysqli_query($con,$get_collector);
			while ($row_collector=mysqli_fetch_array($run_collector)){
		
			$Collector_id=$row_collector['Collector_id'];

			echo "<option value='$Collector_id'>$Collector_id</option>";
			}
			?>
			</select>
			</td>	

		</tr>
		<tr>
			<td colspan="7"><b>Restaurant ID:</b></td>
			<td><select name="restaurant_id">
			<?php
			$get_restaurant="select * from restaurants";
			$run_restaurant=mysqli_query($con,$get_restaurant);
			while ($row_restaurant=mysqli_fetch_array($run_restaurant)){
		
			$Restaurant_id=$row_restaurant['Restaurant_id'];
			$Restaurant_name=$row_restaurant['Restaurant_name'];

			echo "<option value='$Restaurant_id'>$Restaurant_name</option>";
			}
			?>
			</select>
			</td>	

		</tr>
		
		<tr>
			<td colspan="7"><b>Distance(KM):</b></td>
			<td><input type="text" name="distance" size="20" value=""/></td>
		</tr>


		<tr>
			<td colspan="7"><b>Transport Charge(RM):</b></td>
			<td><input type="text" name="transport_charge" size="20" placeholder="(in 0.00)" value=""/>
			</td>
		</tr>

		<tr>
			<td colspan="7"><b>Service Charge(RM):</b></td>
			<td><input type="text" name="service_charge" size="20" placeholder="(in 0.00)" value=""/>
			</td>
		</tr>

		<tr>
			<td colspan="7"><b>Status:</b></td>
			<td><select name="status">
				<option>In Progress</option>
				<option>Completed</option>
				<option>Failed</option>
				
			</select>
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

		$requester_id=$_POST['requester_id'];
		$transporter_id =$_POST['transporter_id'];
		$total_amount =$_POST['total_amount'];
		$delivery_time=$_POST['delivery_time'];
		$collector_id =$_POST['collector_id'];
		$restaurant_id =$_POST['restaurant_id'];
		$distance =$_POST['distance'];
		$transport_charge =$_POST['transport_charge'];
		$service_charge =$_POST['service_charge'];
		$status =$_POST['status'];;

		$insert_food= "insert into food_request (Requester_id, Transporter_id, Total_amount, Delivery_time, Collector_id, Restaurant_id, Distance, Transport_charge, service_charge, Status) values ('$requester_id','$transporter_id','$total_amount','$delivery_time','$collector_id','$restaurant_id','$distance','$transport_charge','$service_charge','$status')";

		echo mysqli_error($con);
		$run_post=mysqli_query($con, $insert_food);
		
		if($run_post){
			echo "<script>alert('Food Request submitted!')</script>";
			echo "<script>window.open('manage_food_request.php','_self')</script>";
		}
		
	}	

?>
<?php } ?>