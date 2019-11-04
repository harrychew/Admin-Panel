<?php    
	include("includes/db.php");
	

    $get_shop="select * from shops";
    $run_shop=mysqli_query($con,$get_shop);
    $number_shop=mysqli_num_rows($run_shop);
    

    $get_rest="select * from restaurants";
    $run_rest=mysqli_query($con,$get_rest);
    $number_rest=mysqli_num_rows($run_rest);
   
	

    $dataPoints3=array(

    	array("label"=>"shops","y"=>$number_shop),
    	array("label"=>"restaurants","y"=>$number_rest)

    );
?>



         