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
		</div>
	</div>

</body>

</html>