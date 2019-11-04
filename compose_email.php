<?php    
session_start();
include("includes/db.php");
use PHPMailer\PHPMailer\PHPMailer;
	require 'includes/PHPMailer/src/Exception.php';
	require 'includes/PHPMailer/src/PHPMailer.php';
	require 'includes/PHPMailer/src/SMTP.php';
	require 'includes/config.php';

if(!isset($_SESSION['admin_id'])){
    echo "<script>window.open('login.php?not_admin=You are not an Admin','_self')
    </script>"; //put this at the top of every php file in admin panel to 
                //prevent people from directly go to the php file by typing 
                //the url in the brower, example: 'localhost/ecommerce/view_cats.php'
}else {
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
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
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
								<h3>Compose Message</h3>
							</div>
							<div class="module-body">

									
									
									<form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data">

										<div class="form-group">
											<label for="name" class="col-sm-2 control-label">Name :</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="name" placeholder="First & Last Name" value="<?php ?>" />
											</div>
										</div>
										<br>

										<div class="form-group">
											<label for="email" class="col-sm-2 control-label">To :</label>
											<div class="col-sm-10">
												<input type="email" class="form-control" name="email_to" placeholder="example@domain.com" value="<?php ?>"/>			
											</div>
										</div>
										<br>

										<div class="form-group">
											<label for="name" class="col-sm-2 control-label">Title :</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="title" placeholder="Title" value="<?php ?>" />
											</div>
										</div>
										<br>
										<div class="form-group">
											<label for="message" class="col-sm-2 control-label">Message :</label>
											<div class="col-sm-10">
												<textarea class="form-control" rows="4" name="message"><?php ?></textarea>
											</div>
										</div>
										<br>

										<div class="form-group" align="center">
											<div class="col-sm-8 col-sm-offset-4">
												<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
											</div>
										</div>
										
									</form> 
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
</body>

<?php

if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$email_to=$_POST['email_to'];
	$title=$_POST['title'];
	$message=$_POST['message'];

	
	//Create a new PHPMailer instance
	$mail = new PHPMailer;
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 2;
	//Set the hostname of the mail server
	$mail->Host = 'smtp.gmail.com';
	// use
	// $mail->Host = gethostbyname('smtp.gmail.com');
	// if your network does not support SMTP over IPv6
	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;  //or 465
	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = SMTP_USER;
	//Password to use for SMTP authentication
	$mail->Password = SMTP_PASS;
	//Set who the message is to be sent from
	$mail->setFrom(SMTP_USER, 'Admin');
	//Set an alternative reply-to address
	$mail->addReplyTo(SMTP_USER);
	//Set who the message is to be sent to
	$mail->addAddress($email_to, $name);
	//Set the subject line
	$mail->Subject = $title;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	// $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
	//Replace the plain text body with one created manually
	$mail->Body = $message;


	//Attach an image file
	// $mail->addAttachment('images/phpmailer_mini.png');

	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";
		$insert_email="insert into email (name,email_to,title,message) values ('$name','$email_to','$title','$message')";
		$run_email=mysqli_query($con,$insert_email);
	    if($run_email){
	    	echo "<script>alert('Message saved!')</script>";
	    	echo "<script>window.open('message.php?admin_id=$admin_id','_self')</script>";
	    //Section 2: IMAP
	    //Uncomment these to save your message in the 'Sent Mail' folder.
	    #if (save_mail($mail)) {
	    #    echo "Message saved!";
	   } #}
	}

	//Section 2: IMAP
	//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
	//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
	//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
	//be useful if you are trying to get this working on a non-Gmail IMAP server.
	// function save_mail($mail)
	// {
	//     //You can change 'Sent Mail' to any other folder or tag
	//     $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
	//     //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
	//     $imapStream = imap_open($path, $mail->Username, $mail->Password);
	//     $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
	//     imap_close($imapStream);
	//     return $result;
	// }



	}

?>

<?php } ?>