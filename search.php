<?php    
session_start();
include("includes/db.php");
global $con;
if(isset($_POST["query"])) {
	
	$search_key=$_POST["query"];
	// $output="";

	$query="select * from products where Product_name like '%".$search_key."%'";
	$result=mysqli_query($con,$query);

	$row_count=mysqli_num_rows($result);
	$output = "<ul>"; 
	if($row_count>0)
	{	
		while($row=mysqli_fetch_assoc($result)){
		
			// $Product_id=$row_products['Product_id'];
			$output .= "<li>".$row["Product_name"]."</li>";
			

		}
	}
	else{
		$output .= "<li>Product not Found</li>";
	}
	$output .= "</ul>";  
    echo $output;  
 }  
?>

