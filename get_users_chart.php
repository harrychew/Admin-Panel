<?php    
	include("includes/db.php");
	

    $get_helpers="select * from helpers";
    $run_helpers=mysqli_query($con,$get_helpers);
    $number_helpers=mysqli_num_rows($run_helpers);
    

    $get_collectors="select * from collectors";
    $run_collectors=mysqli_query($con,$get_collectors);
    $number_collectors=mysqli_num_rows($run_collectors);
   
	
	$get_transporters="select * from transporters";
    $run_transporters=mysqli_query($con,$get_transporters);
    $number_transporters=mysqli_num_rows($run_transporters); 
   
    $total=$number_helpers+$number_collectors+$number_transporters;

    $dataPoints2=array(

    	array("label"=>"helpers","y"=>$number_helpers/$total*100),
    	array("label"=>"collectors","y"=>$number_collectors/$total*100),
    	array("label"=>"transporters","y"=>$number_transporters/$total*100)


    );
?>

<!-- <script>
	window.onload = function () {
 
	var chart2 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	title: {
		text: "Helpers Role"
	},
	subtitles: [{
		text: "Helpers, Collectors, Transporters"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();
 
}
</script> -->

         