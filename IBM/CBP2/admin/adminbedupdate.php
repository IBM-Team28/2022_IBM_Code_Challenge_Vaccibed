<?php
session_start(); //to start the session
include "../connection.php";
include "adminbase.php";
$email = $_SESSION['email'];
$id = $_GET['id'];
$q = "select  * from bedcategory where bcid='$id'";
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
		<form method="POST">
			<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Bed Category</h3>
			<table>


				<tr>
					<td>Bed Type</td>
					<td><input type="text" class="form-control" pattern="[a-z A-Z]+" name="txtTotal" required="" value="<?php echo $r['category']; ?>"></td>
				</tr>

				<tr>
					<td>Description</td>
					<td><textarea  class="form-control" name="txtAvailable" required="" ><?php echo $r['description']; ?></textarea></td>
				</tr>



				<tr>


					<td></td>
					<td colspan="4"><input type="submit" class="btn btn-warning" name="btnSubmit" required="" value="Update"></td>
				</tr>
			</table>
		</form>
	</center>

</div>
<?php

if (isset($_REQUEST['btnSubmit'])) {
	$type = $_REQUEST['txtTotal'];
	$desc = $_REQUEST['txtAvailable'];


	$q = "update bedcategory set category='$type',description='$desc' where bcid='$id'";
	$s = mysqli_query($conn, $q);
	if ($s) {
		echo '<script>alert("Details updated.")</script>';
		echo '<script>location.href="adminaddbedtypes.php"</script>';
	} else {
		echo '<script>alert("Sorry some error occured")</script>';
	}
}
?>