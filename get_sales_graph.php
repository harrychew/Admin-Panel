<?php    
	include("includes/db.php");
	include("get_users_chart.php");
	include("get_shops_restaurant_chart.php");

	$dataPoints=array();
	
	for($i=1;$i<=12;$i++){
		$total_sales3=0;
		$total_food=0;
		$total_shop=0;
		$get_food="select * from food_request where MONTH(Date_time_stamp) ='$i' AND YEAR(Date_time_stamp)=2018";
		$get_shop="select * from shopping_request where MONTH(Date_time_stamp)='$i' AND YEAR(Date_time_stamp)=2018";

		//get food
		$run_food=mysqli_query($con,$get_food);
		while($row_food=mysqli_fetch_array($run_food)){
		$service_charge = $row_food['service_charge'];
		$total_sales=array($service_charge);
		$values=array_sum($total_sales);
		$total_food+=$values;
		// $total_food+=$service_charge;
		}			

		
		//get shop
		$run_shop=mysqli_query($con,$get_shop);
		while($row_shop=mysqli_fetch_array($run_shop)){
		$service_charge2 = $row_shop['service_charge'];
		$total_sales2=array($service_charge2);
		$values2=array_sum($total_sales2);
		$total_shop+=$values2;
		// $total_shop+=$service_charge2;
		}
		if($i==1){
			$month="January";
		}
		elseif($i==2){
			$month="February";
		}elseif($i==3){
			$month="March";
		}elseif($i==4){
			$month="April";
		}elseif($i==5){
			$month="May";
		}elseif($i==6){
			$month="June";
		}elseif($i==7){
			$month="July";
		}elseif($i==8){
			$month="August";
		}elseif($i==9){
			$month="September";
		}elseif($i==10){
			$month="October";
		}elseif($i==11){
			$month="November";
		}elseif($i==12){
			$month="December";
		}
		
		//get total
		$total_sales3=$total_sales3+($total_food+$total_shop);

		// echo array_push($dataPoints, $total_sales3);
		$a=array("y"=>$total_sales3, "label"=>$month);
		array_push($dataPoints,$a);	
	}
	
	
?>
<script>
	window.onload = function() {
 
	var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Sales for 2018"
	},
	axisY: {
		title: "Sales(RM)"
	},
	axisX: {
		title: "Month"
	},
	data: [{
		type: "line",
		markerColor: "#008000",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});

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


var chart3 = new CanvasJS.Chart("chartContainer3", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Shops and Restaurants"
	},
	axisY: {
		title: "Numbers"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.##",
		dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
chart2.render();
chart3.render();
 
}
</script>

         