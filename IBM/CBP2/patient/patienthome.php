<?php
session_start(); //to start the session
include "../connection.php";
include "patientbase.php";
$email = $_SESSION['email'];
$q = "select * from patients where email='$email'";
$s = mysqli_query($conn, $q);
$r = mysqli_fetch_array($s);
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
</style>
<div id="log">
	<form method="POST">
		<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Patient Registration</h3>
		<table style="width:900px;">
			<tr>
				<td>Name</td>
				<td><input type="text" class="form-control" pattern="[a-z A-Z ]+" name="txtName" required="" value="<?php echo $r['name'] ?>"></td>

				<td>&nbsp;&nbsp;&nbsp;&nbsp;House name</td>
				<td><input type="text" class="form-control" pattern="[a-z A-Z ]+" name="txtHouse" required="" value="<?php echo $r['housename'] ?>"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Place</td>
				<td><input type="text" class="form-control" pattern="[a-z A-Z ]+" name="txtPlace" required="" value="<?php echo $r['adrs'] ?>"></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;Pin</td>
				<td><input type="text" class="form-control" pattern="[6][0-9]{5}" name="txtPin" required="" value="<?php echo $r['pin'] ?>"></td>

			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>

				<td>Aadhar</td>
				<td><input type="text" class="form-control" name="txtAadhar" pattern="[1-9][0-9]{11}" required="" value="<?php echo $r['id_proof'] ?>"></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;Contact</td>
				<td><input type="text" class="form-control" pattern="[6789][0-9]{9}" name="txtContact" required="" value="<?php echo $r['phone'] ?>"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>

				<td>Age</td>
				<td><input type="number" class="form-control"   name="txtAge" max="110" min="1" required="" value="<?php echo $r['age'] ?>"></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;Local Body</td>
				<td><input type="text" class="form-control" pattern="[a-z A-Z ]+" name="txtBody" required="" value="<?php echo $r['lbody'] ?>"></td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>

			<tr>


				<td></td>
				<td><input type="submit" style="width:300px;" class="btn btn-warning" name="btnSubmit" required="" value="Update"></td>
			</tr>
		</table>
	</form>
</div>
<?php

if (isset($_REQUEST['btnSubmit'])) {
	$name = $_REQUEST['txtName'];
	$house = $_REQUEST['txtHouse'];
	$place = $_REQUEST['txtPlace'];
	$pin = $_REQUEST['txtPin'];
	$contact = $_REQUEST['txtContact'];
	$aadhar = $_REQUEST['txtAadhar'];
    $lbody = $_REQUEST['txtBody'];
	$age = $_REQUEST['txtAge'];



	$q = "update patients set name='$name',housename='$house',adrs='$place',id_proof='$aadhar',pin='$pin',phone='$contact',lbody='$lbody',age=$age where email='$email'";
	$s = mysqli_query($conn, $q);
	if ($s) {


		echo '<script>alert("Updation successful.")</script>';
		echo '<script>location.href="patienthome.php"</script>';
	} else {
		echo '<script>alert("Sorry some error occured")</script>';
		// echo '<script>location.href="index.php"</script>';
		echo $q;
	}
}
?>