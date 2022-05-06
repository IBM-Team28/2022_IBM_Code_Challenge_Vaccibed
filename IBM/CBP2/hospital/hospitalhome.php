<?php
session_start(); //to start the session
include "../connection.php";
include "hospitalbase.php";
$email = $_SESSION['email'];
$q = "select * from hospital where email='$email'";
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
	<center><h2><?php echo $r['name']; ?></h2></center>
	<form method="POST">
		<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Profile</h3>
		<table style="width:900px;">
			<tr>
				<td>Name</td>
				<td><input type="text" class="form-control" pattern="[a-zA-Z ]+" name="txtName" required="" value="<?php echo $r['name']; ?>"></td>

				<td>&nbsp;&nbsp;&nbsp;&nbsp;Address</td>
				<td><textarea class="form-control" name="txtAddress" required=""><?php echo $r['adrs']; ?></textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Place</td>
				<td><input type="text" class="form-control" pattern="[a-zA-Z ]+" name="txtPlace" required="" value="<?php echo $r['place']; ?>"></td>

				<td>&nbsp;&nbsp;&nbsp;&nbsp;License</td>
				<td><input type="text" class="form-control" name="txtLicense" required="" value="<?php echo $r['licen_num']; ?>"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Pin</td>
				<td><input type="text" class="form-control" pattern="[6][0-9]{5}" maxlength="6" name="txtPin" required="" value="<?php echo $r['pin']; ?>"></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;Contact</td>
				<td><input type="text" class="form-control" pattern="[6789][0-9]{9}" maxlength="10" name="txtContact" required="" value="<?php echo $r['contact']; ?>"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="4"><input type="submit" style="width:860px;" class="btn btn-warning" name="btnSubmit" value="Update" required=""></td>
			</tr>
		</table>
	</form>
</div>
<?php

if (isset($_REQUEST['btnSubmit'])) {
	$name = $_REQUEST['txtName'];
	$address = $_REQUEST['txtAddress'];
	$place = $_REQUEST['txtPlace'];
	$pin = $_REQUEST['txtPin'];
	$contact = $_REQUEST['txtContact'];
	$license = $_REQUEST['txtLicense'];


	$q = "update hospital set name='$name',adrs='$address',place='$place',licen_num='$license',pin='$pin',contact='$contact' where email='$email'";
	$s = mysqli_query($conn, $q);
	if ($s) {
		echo '<script>alert("Updation successful.")</script>';
		echo '<script>location.href="hospitalhome.php"</script>';
		// echo $q;
	} else {
		echo '<script>alert("Sorry some error occured")</script>';
		// echo '<script>location.href="index.php"</script>';
	}
}
?>