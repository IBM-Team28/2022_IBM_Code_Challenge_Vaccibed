<?php
session_start(); //to start the session
include "../connection.php";
include "patientbase.php";
$email = $_SESSION['email'];
$q = "select * from patients where email='$email'";
$s = mysqli_query($conn, $q);
$r = mysqli_fetch_array($s);
$qry = "SELECT * FROM bedcategory";
$res = mysqli_query($conn, $qry);
?>

<style type="text/css">
	#log {
		background-color: rgba(0, 150, 220, 0.5);
		margin: 10px 300px;
		padding: 20px;
		color: white;
		width: 40%;
		float: left;
	}

	a:hover {
		background-color: white;
		text-decoration: none;
	}
</style>
<div id="log">
	<form method="POST">
		<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Search bed</h3>
		<table style="margin: auto;">
			<tr>
				<?php
				while ($row = mysqli_fetch_array($res)) {
				?>
					<td>
						<a href="#?type=<?php echo $row['bcid'] ?>"> <!--patientbed.php-->
							<h3 style="margin:40px; padding: 30px; background-color:rgba(0, 100, 100, 0.5) ; width:250px; color:white;"><?php echo $row['category'] ?><br><span style="font-weight: 100; font-size:12px"><?php echo $row['description'] ?></span></h3>
						</a>
					</td>
				</tr>
				<?php
				}
				?>
		
		</table>
	</form>
</div>