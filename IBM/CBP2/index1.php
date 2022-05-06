<!DOCTYPE html>
<html>

<head>
	<style type="text/css">
		body {
			background-image: url("images/bg1.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;

		}

		#log {
			background-color: rgba(0, 150, 220, 0.5);
			margin: 50px;
			padding: 50px;
			color: white;
			width: 400px;
			float: right;
		}

		#nav {
			background-color: rgba(0, 150, 220, 0.5);
			margin: 20px 0px;
			padding: 20px;
			color: white;
			width: 100%;
		}

		#msg {
			background-color: rgba(0, 150, 220, 0.5);
			margin: 100px;
			padding: 20px;
			color: white;
			width: 500px;
			float: left;
		}

		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;

		}

		li {
			float: left;

		}

		li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		li a:hover {
			background-color: white;
			text-decoration: none;
			height: 100%;
		}

		li a.active {
			color: white;
			background-color: #04AA6D;
		}

		td,
		th {
			padding: 20px;
		}
	</style>
	<meta charset="utf-8">
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
	<div id="nav">
		<div style="margin:10px;">
			<h1 style="color:#ebd231; font-weight: 700;">COVID BED PORTAL</h1>
		</div>
		<div style="margin-left: 700px; margin-top: -60px;">
			<ul>
				<li><a href="index.php">Home</a></li>
				<!-- <li><a href="commonhospital.php">Hospital</a></li> -->
				<li><a href="commonpatient.php">Patient</a></li>
			</ul>

			</ul>
		</div>
	</div>
	<div id="msg">
		<h1 id="hd1" style="font-weight: 700;">Notify with the bed availability</h1>
		<h2 id="hd2" style="font-weight: 700; color:#ebd231;">Save a life</h2>
	</div>
	<div id="log">
		<form method="POST">
			<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 700;">Login</h3>
			<table>
				<tr>
					<td>Username</td>
					<td><input type="text" class="form-control" name="txtUname" required=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>  
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="Password" class="form-control" name="txtPwd" required=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><a style="color:white;" href="reg.php">Not yet a user? Register here</a></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" style="width:300px;" class="btn btn-warning" name="btnSubmit" required=""></td>
				</tr>
			</table>
		</form>
	</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {


			$("#hd1").fadeIn("slow");
			$("#hd2").fadeIn("slow");


		});
	</script>
	<?php
	session_start(); //to start the session
	include 'connection.php';
	if (isset($_REQUEST['btnSubmit'])) {
		$email = $_REQUEST['txtUname'];
		$pwd = $_REQUEST['txtPwd'];
		$_SESSION['email'] = $email;
		

		$q = "select count(*) from login where user_name='$email'";
		//$j="select status from login where user_name='$email'";
		//$jk= mysqli_query($conn, $j);
		$s = mysqli_query($conn, $q);
		$r = mysqli_fetch_array($s);
		if ($r[4] == '-1')
		{
			echo '<script>alert("Not a User...")</script>';
			echo '<script>location.href="index.php"</script>';

		}

	
		if ($r[0] == 0)    //to check whether the username exist
		{
			echo '<script>alert("Username doesnt exist")</script>';
		} else {
			//creating a session variable
			$q = "select * from login where user_name='$email'";
			$s = mysqli_query($conn, $q);
			$r = mysqli_fetch_array($s);
			if ($r['password'] == $pwd)  //to check the password entered by user with the password in database
			{

				if ($r['user_type'] == "admin")  //to check the usertye/role of the user
				{
					echo '<script>location.href="admin/adminhome.php"</script>';
				} else if ($r['user_type'] == "hospital") {
					$q = "select * from hospital where email='$email'";
					$s = mysqli_query($conn, $q);
					$r = mysqli_fetch_array($s);
					$_SESSION['id'] = $r[0];
					echo '<script>location.href="hospital/hospitalhome.php"</script>';
				} else if ($r['user_type'] == "patient") {
					$q = "select * from patients where email='$email'";
					$s = mysqli_query($conn, $q);
					$r = mysqli_fetch_array($s);
					$_SESSION['id'] = $r[0];
					echo '<script>location.href="patient/patienthome.php"</script>';
				}
			} else {
				echo '<script>alert("Incorrect password")</script>';
				echo '<script>location.href="index.php"</script>';
			}
		}
		
}
	?>

</body>

</html>