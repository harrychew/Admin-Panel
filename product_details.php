<?php  

//for edit_shopping_item.php search function  
session_start();
include("includes/db.php");

	$postDetails=array();

	$search_key=$_GET('term');

	$search_products="select * from products where Product_name like '%$search_key%' ";
	$run_products=mysqli_query($con,$search_products);

	$row_count=mysqli_num_rows($run_products);
	echo mysqli_error($con);
	if($row_count>0)
	{
		while($row_products=mysqli_fetch_assoc($run_products)){
			$Product_name=$row_products['Product_name'];
			// $Product_id=$row_products['Product_id'];
			$postDetails[]=ucfirst($Product_name);
		}
	}

	echo json_encode($postDetails);

?>

