<!DOCTYPE html>
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
     //get admin photo 
    $get_admins="select * from admins where admin_id='$admin_id'";
    $run_admins=mysqli_query($con,$get_admins);
    $row_admins=mysqli_fetch_array($run_admins);
    $Photo=$row_admins['Photo']; 

?>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edmin</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
        <h3 style="color:red; text-align:center;"><?php echo @$_GET['logged_in'];?></h3> 
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php">Edmin </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav nav-icons">
                            <li class="active"><a href="message.php"><i class="icon-envelope"></i></a></li>
                            <li><a href="all_users.php"><i class="icon-eye-open"></i></a></li>
                            <li><a href="helplaa_track_sales.php"><i class="icon-bar-chart"></i></a></li>
                        </ul>

                        <form class="navbar-search pull-left input-append" action="#">
                        <input type="text" class="span3">
                        <button class="btn" type="button">
                            <i class="icon-search"></i>
                        </button>
                        </form>

                        <ul class="nav pull-right">
                            <li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">Quick Access
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="task.php">Task</a></li>
                                    <li><a href="message.php">Send Mail</a></li>
                                    <li><a href="helplaa_track_sales.php">Track Sales</a></li>
                                    <li class="divider"></li>
                                    <li class="nav-header">Social Media</li>
                                    <li><a href="https://www.facebook.com/needhelphelplaa/"><i class="icon-facebook"></i>Facebook Page</a></li>
                                </ul>
                            </li>
                            <li><a href="support.php">Support </a></li>
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="admins/Photo/<?php echo $Photo;?>" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="my_account.php?admin_id=<?php echo $admin_id; ?>">My Account</a></li>
                                    <li><a href="edit_my_account.php?admin_id=<?php echo $admin_id; ?>">Edit Account</a></li>
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="index.php"><i class="menu-icon icon-dashboard"></i>Dashboard
                                </a></li>
                                <li><a href="social_feed.php"><i class="menu-icon icon-bullhorn"></i>News Feed </a>
                                </li>
                                <li><a href="message.php"><i class="menu-icon icon-inbox"></i>Sent Mail
                                    <b class="label green pull-right">
                                    <?php 
                                    $get_number="select * from email";
                                    $run_number=mysqli_query($con,$get_number);
                                    echo mysqli_num_rows($run_number); 
                                    ?>   
                                    </b> 
                                  </a>
                              </li>
                                <li><a href="task.php"><i class="menu-icon icon-tasks"></i>Tasks 
                                    <b class="label orange pull-right">
                                    <?php 
                                    $get_task="select * from tasks";
                                    $run_task=mysqli_query($con,$get_task);
                                    echo mysqli_num_rows($run_task); 
                                    ?>   
                                    </b></a>
                                </li>
                            </ul>
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages1"><i class="menu-icon icon-shopping-cart">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>User</a>
                                    <ul id="togglePages1" class="collapse unstyled">
                                        <li><a href="helplaa_user.php"><i class="icon-inbox"></i>Manage Users</a></li>
                                        <li><a href="helplaa_track_user_activity.php"><i class="icon-inbox"></i>Track User Activity </a></li>
                                        <li><a href="helplaa_track_user_message.php"><i class="icon-envelope"></i>Track User Message </a></li>
                                        <li><a href="helplaa_track_sales.php"><i class="icon-money"></i>Track Sales</a></li>
                                    </ul>
                                </li>
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages2"><i class="menu-icon icon-shopping-cart">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Helpers </a>
                                    <ul id="togglePages2" class="collapse unstyled">
                                        <li><a href="helpers.php"><i class="icon-inbox"></i>Manage Helpers</a></li>
                                        <li><a href="add_helpers.php"><i class="icon-inbox"></i>Add Helpers</a></li>
                                       <!--  <li><a href="other-user-listing.html"><i class="icon-inbox"></i>Sales </a></li> -->
                                    </ul>
                                </li>
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages3"><i class="menu-icon icon-shopping-cart">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Collectors </a>
                                    <ul id="togglePages3" class="collapse unstyled">
                                        <li><a href="collectors.php"><i class="icon-inbox"></i>Manage Collectors </a></li>
                                         <li><a href="add_collectors.php"><i class="icon-inbox"></i>Add Collectors</a></li>
                                        <!-- <li><a href="other-user-listing.html"><i class="icon-inbox"></i>Sales </a></li> -->
                                    </ul>
                                </li>
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages4"><i class="menu-icon icon-shopping-cart">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>Transporters </a>
                                    <ul id="togglePages4" class="collapse unstyled">
                                        <li><a href="transporters.php"><i class="icon-inbox"></i>Manage Transporters </a></li>
                                        <li><a href="add_transporters.php"><i class="icon-inbox"></i>Add Transporters</a></li>
                                       <!--  <li><a href="other-user-listing.html"><i class="icon-inbox"></i>Sales </a></li> -->
                                    </ul>
                                </li>
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages5"><i class="menu-icon icon-shopping-cart">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>ShopLa</a>
                                    <ul id="togglePages5" class="collapse unstyled">
                                        <li><a href="shops.php"><i class="icon-inbox"></i>Manage Shops</a></li>
                                        <li><a href="products.php"><i class="icon-inbox"></i>Manage Products</a></li>
                                        <li><a href="manage_shopping_request.php"><i class="icon-inbox"></i>Manage Shopping Request</a></li>
                                    </ul>
                                </li>
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages6"><i class="menu-icon icon-shopping-cart">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>HungryLa</a>
                                    <ul id="togglePages6" class="collapse unstyled">
                                        <li><a href="restaurants.php"><i class="icon-inbox"></i>Manage Restaurants</a></li>
                                        <li><a href="foods.php"><i class="icon-inbox"></i>Manage Foods</a></li>
                                        <li><a href="manage_food_request.php"><i class="icon-inbox"></i>Manage Food Request</a></li>
                                    </ul>
                                </li>
                            </ul>
                       
                            
                            
                            <!--/.widget-nav-->
                            <ul class="widget widget-menu unstyled">
                                <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                                </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                                </i>More Pages </a>
                                    <ul id="togglePages" class="collapse unstyled">
                                        <li><a href="login.php"><i class="icon-inbox"></i>Login </a></li>
                                        <li><a href="my_account.php?admin_id=<?php echo $admin_id;?>"><i class="icon-inbox"></i>My Account </a></li>
                                        <li><a href="all_users.php"><i class="icon-inbox"></i>All Users </a></li>
                                    </ul>
                                </li>
                                <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                                    </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->



				<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-head">
								<h3>Manage Food Request</h3>
							
							</div>
							<div class="module-body">

							<a href="test_food_request.php">Insert post to test link</a>
				
							<table id="act">
                                <thead>
						            <tr>
						        		
						                <th>Food_request_id</th>
						                <th>Requester_id</th>
						                <th>Transporter_id</th>
						                <th>Date_time_stamp</th>
						                <th>Total_amount</th>
						                <th>Delivery_time</th>
						                <th>Collector_id</th>
						                <th>Restaurant_id</th>
						                <th>Distance</th>
						                <th>Transport_charge</th>
						                <th>service_charge</th>
						                <th>Status</th>
						                <th>Action</th>
						                <th>Action</th>
						            </tr>
						      </thead>
                              <tbody>
						        	<?php
						        	include("includes/db.php");

									 global $con;
									

									 //get helper post ID
									 $get_food="select * from food_request";
									 $run_food=mysqli_query($con,$get_food);
									 while($row_food=mysqli_fetch_array($run_food)){

									 $Food_request_id =$row_food['Food_request_id'];
									 $Requester_id=$row_food['Requester_id'];
									 $Transporter_id=$row_food['Transporter_id'];
									 $Date_time_stamp=$row_food['Date_time_stamp'];
									 $Total_amount = $row_food['Total_amount'];
									 $Delivery_time =$row_food['Delivery_time'];
									 $Collector_id = $row_food['Collector_id'];
									 $Restaurant_id =$row_food['Restaurant_id'];
									 $Distance = $row_food['Distance'];
									 $Transport_charge=$row_food['Transport_charge'];
									 $service_charge=$row_food['service_charge'];
									 $Status=$row_food['Status'];	

									?>
						          
						                <tr>
						         			<td><?php echo $Food_request_id; ?></td>
						         			<td><?php echo $Requester_id; ?></td>
						          			<td><?php echo $Transporter_id; ?></td>
						          			<td><?php echo $Date_time_stamp; ?></td>
						          			<td><?php echo $Total_amount; ?></td>
						          			<td><?php echo $Delivery_time; ?></td>
						          			<td><?php echo $Collector_id; ?></td>
						          			<td><?php echo $Restaurant_id; ?></td>
						          			<td><?php echo $Distance; ?></td>
						          			<td><?php echo $Transport_charge; ?></td>
						          			<td><?php echo $service_charge; ?></td>
						          			<td><?php echo $Status; ?></td>
						          			<td>
						          				<a href="edit_food_status.php?edit_food_status=<?php echo $Food_request_id; ?>" style="text-decoration: none">Update Status</a>
						          			</td>
						          			<td>
						          				<a href="delete_food_request.php?delete_food_request=<?php echo $Food_request_id; ?>" style="text-decoration: none">Delete
						          				</a>
						          			</td>				          	
						        		</tr>
						            
						            
						        <?php } ?>
						      </tbody>    
									
						        
						    </table>
									
					 
									
							</div>
						</div>

						 <div class="module">
                            <div class="module-head">
                                <h3>Manage Food Item</h3>
                            
                            </div>
                            <div class="module-body">
                            <!-- a href="test_shop_request.php">Insert post to test link</a> -->
                        
                            <table id="act2">
                                <thead>
                                    <tr>
                                        
                                        <th>Food_request_id</th>
                                        <th>Food_item_id</th>
                                        <th>Food_id</th>
                                        <th>quantity</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("includes/db.php");

                                     global $con;
                                    

                                     //get helper post ID
                                     $get_items="select * from food_items";
                                     $run_items=mysqli_query($con,$get_items);
                                     while($row_items=mysqli_fetch_array($run_items)){

                                     $Food_request_id =$row_items['Food_request_id'];
                                     $Food_item_id=$row_items['Food_item_id'];
                                     $Food_id=$row_items['Food_id'];
                                     $quantity=$row_items['quantity'];
                                     

                                    ?>
                                  
                                        <tr>
                                            <td><?php echo $Food_request_id; ?></td>
                                            <td><?php echo $Food_item_id; ?></td>
                                            <td><?php echo $Food_id; ?></td>
                                            <td><?php echo $quantity; ?></td>
                                            
                                            <td>
                                                <a href="edit_food_item.php?edit_food_item=<?php echo $Food_item_id; ?>" style="text-decoration: none">Update item
                                                </a>
                                            </td>
                                            <td>
                                                <a href="delete_food_item.php?delete_food_item=<?php echo $Food_item_id; ?>" style="text-decoration: none">Delete
                                                </a>
                                            </td>                           
                                        </tr>
                                    
                                    
                                <?php } ?>
                                 </tbody>  
                                    
                                
                            </table>
                                    
                     
                                    
                            </div>
                        </div>
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; <?php echo date("Y");?> Edmin - Ebletech.com </b> All rights reserved.
		</div>
	</div>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>

        <script type="text/javascript">
        $(document).ready( function () {
        $('#act').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
            $('.dataTables_paginate > a').wrapInner('<span />');
            $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
            $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
        } );
        </script>
        <script type="text/javascript">
        $(document).ready( function () {
        $('#act2').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
            $('.dataTables_paginate > a').wrapInner('<span />');
            $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
            $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
        } );
        </script>
</body>
</html>

									
<?php } ?>
<?php mysqli_close($con); ?>	

