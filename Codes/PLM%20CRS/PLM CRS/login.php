<?php

	require "connect.php";

	if(!session_id())
	{
		session_start();
	}



			if(isset($_POST['submit']))
			{

				$_POST['submit'] = NULL;
				unset($_POST['submit']);

				$username = $_POST['username'];
				$password = $_POST['pass'];

				$login_request = mysqli_query($conn,"SELECT u.user_name, u.user_level, p.password FROM `tbl_user` 
					as u JOIN `tbl_user_password` as p ON u.user_id = p.user_id WHERE u.user_name = '$username' 
					AND p.password = '$password'; ");

				if(!mysqli_num_rows($login_request))
				{
					echo "<script> alert(\"Wrong username and password!\"); </script>";
				}
				else
				{
					$row = mysqli_fetch_row($login_request);

					$_SESSION['user'] = $row[0];
					$_SESSION['level'] = $row[1];
					$_SESSION['password'] = $row[2];

					header("Location: info.php");
				}
			}
			

		
		
?>

<!DOCTYPE html>
<html lang="en">
	
	<header>
		<div class="container">
			<div style="background-image: url(img/header.gif); background-size: 100% 100%" class = "jumbotron"></div>
		</div>
		
		<div class = "container">
			<div class = "well  col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
			<center><b><h2><font face = "comicsans" color = "#616161"> Computerized Registration System </b></h2></font></center>
		</div>
	</header>

	<head>
		<title>PLM CRS</title>

		<meta name  = "viewport" content= "width=device-width, initial-scale=1.0">
		<link href  = "css/bootstrap.min.css" rel = "stylesheet" type="text/css">
		
		
		<script src="js/jquery-3.1.0.min.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap-show-password.js"></script>
	</head>

	<body background = "gradient.jpg">				
		<!--Username-->
		<br>
		<div class = "well col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
			<div class = "container">
				<form class="form-horizontal" role="form" method="post" action="#">		
					<fieldset class = "col-md-8 col-xs-12 col-sm-12 col-md-offset-1">
						<div class="form-group">
						<div class="col-md-7">
							<div class = "input-group">
							<span class="input-group-addon"><span class = "glyphicon glyphicon-user"></span></span>
							<center><input type="text" required="required" class="form-control" name="username" placeholder="Username" value=""></center>
							</div>
						</div>
						</div>
										
							<!--Password-->
							<div class="form-group">
								<div class="col-md-7">
									<div class="input-group">
										<span class="input-group-addon"><span class = "glyphicon glyphicon-lock"></span></span>
										<center><input id="password" type="password" required="required" class="form-control" name="pass" placeholder="Password" value=""></center>
									</div>
								</div>
							</div>
															
							<!--SUBMIT and FORGOT PW-->
							<div class="form-group">
								<div class="col-md-7">
									<center><input name="submit" type="submit" value="Log-In" class="btn btn-info"></center>
								</div>
							</div>
			
		
					</fieldset>
				</form>
				</div>
			</div>
		</div>
				
			<div class="panel panel-default">
			  <div class="panel-body"></div>
			<br><br><br><br><br>
				<div class="panel-footer">
				  <center><h5>The premier scholars' university of the capital city of the Philippines.<br>
				  All Rights Reserved, <i>Copyright since 2009</i>.</h5></center>
				</div>
			</div>

		<script>
	
		// THIS IS THE JAVA SCRIPT FOR THE SHOW/HIDE BUTTON
			$(function() {
				$('#password').password().on('show.bs.password', function(e) {
				}).on('hide.bs.password', function(e) {
						});
				$('#methods').click(function() {
					$('#password').password('toggle');
				});
			});
		</script>
		
		
	</body>	
</html>