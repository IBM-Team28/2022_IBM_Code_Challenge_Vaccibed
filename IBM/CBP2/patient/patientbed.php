<?php
session_start(); //to start the session
include "../connection.php";
include "patientbase.php";
$email = $_SESSION['email'];
$id = $_SESSION['id'];
?>

<style type="text/css">
	#log {
		background-color: rgba(0, 150, 220, 0.5);
		margin: 10px 150px;
		padding: 50px;
		color: white;
		width: 1000px;
		float: left;
	}

	td,
	th {
		padding: 10px;
	}

	#tbl {
		width: 900px;
	}

	a {
		color: #ebd231;
	}

	table {
		border-collapse: collapse;
		border: none;
	}

	th {
		background-color: rgba(0, 100, 180, 0.7);
		color: #ebd231;
	}
</style>
<div id="log">
	<center>
		<form method="POST" enctype="multipart/form-data">
			<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Bed details</h3>
			<table>

				<tr>
					<td>Current Situation</td>
					<td><textarea class="form-control" name="txtSitu" required=""></textarea></td>
				</tr>

				<tr>
					<td>Related Document</td>
					<td><input type="file" class="form-control" name="file" required=""></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="4"><input type="submit" class="btn btn-warning" name="btnSubmit" required=""></td>
				</tr>
			</table>
		</form>
	</center>
</div>
<?php
if (isset($_REQUEST['btnSubmit'])) {
	$situ = $_REQUEST['txtSitu'];
	$date = date("Y/m/d");
	$folder = '../images/';
	$file = $folder . basename($_FILES['file']['name']);
	move_uploaded_file($_FILES['file']['tmp_name'], $file);
	$type = $_GET['type'];
	$f = "SELECT * FROM `bedrequest` WHERE `pid` = $id  and `status` = 'Admitted'";
	$t = mysqli_query($conn, $f);
	if(mysqli_num_rows($t) == 0)
	{

		$q = "INSERT INTO `bedrequest` (`bcid`,`pid`, `currentsituation`, `proof`, `bookingdate`, `status`) VALUES ('$type','$id','$situ','$file','$date','Requested')";
	$s = mysqli_query($conn, $q);
	if ($s) {
		echo '<script>alert("Bed Requested")</script>';
		echo '<script>location.href="patientbooking.php"</script>';
		// echo $q;
	} else {
		echo '<script>alert("Sorry some error occured")</script>';
		// echo '<script>location.href="index.php"</script>';
	}
	}
	else{
		echo '<script>alert("Patient Already Admitted")</script>';
		echo '<script>location.href="patientbooking.php"</script>';
	}
	
}
?>