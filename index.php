<?php    
session_start();
include("includes/db.php");
include("get_sales_graph.php");


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
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>

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
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="helpers.php" class="btn-box big span4"><i class=" icon-user" style="color:#4ef442"></i><b> <?php 
                                    $get_helpers="select * from helpers";
                                    $run_helpers=mysqli_query($con,$get_helpers);
                                    echo mysqli_num_rows($run_helpers); 
                                    ?>   </b>
                                        <p class="text-muted">
                                            Helpers</p>
                                    </a><!---#1334f2-->
                                    <a href="collectors.php" class="btn-box big span4"><i class="icon-user" style="color:#f2f922"></i><b><?php 
                                    $get_collectors="select * from collectors";
                                    $run_collectors=mysqli_query($con,$get_collectors);
                                    echo mysqli_num_rows($run_collectors); 
                                    ?></b>
                                        <p class="text-muted">
                                            Collectors</p>
                                    </a>
                                    <a href="transporters.php" class="btn-box big span4"><i class="icon-user" style="color:#e00822"></i><b><?php 
                                    $get_transporters="select * from transporters";
                                    $run_transporters=mysqli_query($con,$get_transporters);
                                    echo mysqli_num_rows($run_transporters); 
                                    ?></b>
                                        <p class="text-muted">
                                            Transporters</p>
                                    </a>
                                </div>
                                <div class="btn-box-row row-fluid">
                                    <div class="span8">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="restaurants.php" class="btn-box small span4"><i class=" icon-food"></i><b>Restaurants</b> </a>
                                                <a href="helplaa_track_sales.php" class="btn-box small span4"><i class="icon-money"></i><b>Total Sales</b>
                                                </a>
                                                <a href="shops.php" class="btn-box small span4"><i class="icon-shopping-cart"></i><b>Shops</b>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="helplaa_user.php" class="btn-box small span4"><i class="icon-group"></i><b>Users</b>
                                                </a>
                                                 <a href="message.php" class="btn-box small span4"><i class="icon-envelope"></i><b>Messages</b>
                                                </a>
                                                <a href="social_feed.php" class="btn-box small span4"><i class="icon-bullhorn"></i><b>Social Feed</b>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <ul class="widget widget-usage unstyled span4">
                                        <li>
                                            <p>
                                                <strong>Users</strong> 
                                                <span class="pull-right small muted">
                                                    <?php 
                                                    $get_users="select * from users";
                                                    $run_users=mysqli_query($con,$get_users);
                                                    $number_users=mysqli_num_rows($run_users); 
                                                    echo $number_users;
                                                    ?> 
                                                </span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar" style="width: <?php echo $number_users/$number_users*100;?>%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Helpers</strong> 
                                                <span class="pull-right small muted">
                                                    <?php 
                                                    $get_helpers="select * from helpers";
                                                    $run_helpers=mysqli_query($con,$get_helpers);
                                                    $number_helpers=mysqli_num_rows($run_helpers);
                                                    echo $number_helpers; 
                                                    ?> 
                                                </span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-success" style="width:<?php echo $number_helpers/$number_users*100;?>%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Collectors</strong> 
                                                <span class="pull-right small muted">
                                                    <?php 
                                                    $get_collectors="select * from collectors";
                                                    $run_collectors=mysqli_query($con,$get_collectors);
                                                    $number_collectors=mysqli_num_rows($run_collectors);
                                                    echo $number_collectors; 
                                                    ?>
                                                </span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-warning" style="width: <?php echo $number_collectors/$number_users*100;?>%;">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <p>
                                                <strong>Transporters</strong> 
                                                <span class="pull-right small muted">
                                                    <?php 
                                                    $get_transporters="select * from transporters";
                                                    $run_transporters=mysqli_query($con,$get_transporters);
                                                    $number_transporters=mysqli_num_rows($run_transporters); 
                                                    echo $number_transporters;
                                                    ?>
                                                </span>
                                            </p>
                                            <div class="progress tight">
                                                <div class="bar bar-danger" style="width: <?php echo $number_transporters/$number_users*100;?>%;">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--/#btn-controls-->

                            <div class="module">
                                <div class="module-head">
                                    <h3>Sales Chart</h3>

                                </div>
                                
                                <div class="module-body">
                                    <div class="chart inline-legend grid">
                                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="module">
                                <div class="module-head">
                                    <h3>Helpers Chart</h3>

                                </div>
                                
                                <div class="module-body">
                                    <div class="chart inline-legend grid">
                                        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="module">
                                <div class="module-head">
                                    <h3>Shops vs Restaurant Chart</h3>

                                </div>
                                
                                <div class="module-body">
                                    <div class="chart inline-legend grid">
                                        <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; <?php echo date("Y");?> Edmin - Ebletech.com </b>All rights reserved.
            </div>
        </div>
      
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>

        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <<!-- script src="scripts/graph.js" type="text/javascript"></script>
 -->
      
    </body>

</html>

<?php }?> 

