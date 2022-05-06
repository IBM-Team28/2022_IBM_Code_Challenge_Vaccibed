<?php
session_start(); //to start the session
include "../connection.php";
include "hospitalbase.php";
$email = $_SESSION['email'];
$id = $_GET['id'];
$q = "select  * from beddetails where bid='$id'";
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
			<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Bed details</h3>
			<table>


				<tr>
					<td>Total bed</td>
					<td><input type="text" class="form-control" pattern="[0-9]{1,5}" name="txtTotal" required="" id="tb" value="<?php echo $r['bTotal']; ?>"></td>
				</tr>

				<tr>
					<td>Available bed</td>
					<td><input type="text" class="form-control" name="txtAvailable" pattern="[0-9]{1,5}" id="ab" oninput="calc()" required="" value="<?php echo $r['bAvailable']; ?>"></td>
				</tr>



				<tr>


					<td></td>
					<td colspan="4"><input type="submit" class="btn btn-warning" name="btnSubmit" required="" value="Update"></td>
				</tr>
			</table>
		</form>
	</center>
	<script>
		function calc()
		{
			var s=document.getElementById('tb').value;
            var td=document.getElementById('ab').value;

            if(td>s)
			{
				alert("more than total beds...!Enter correctly..");
				td.focus();
				return false;
			}
			return true;
		}
		</script>

</div>
<?php

if (isset($_REQUEST['btnSubmit'])) {
	$available = $_REQUEST['txtAvailable'];
	$total = $_REQUEST['txtTotal'];


	$q = "update beddetails set bTotal='$total',bAvailable='$available' where bid='$id'";
	$s = mysqli_query($conn, $q);
	if ($s) {
		echo '<script>alert("Details updated.")</script>';
		echo '<script>location.href="hospitalbed.php"</script>';
	} else {
		echo '<script>alert("Sorry some error occured")</script>';
	}
}
?>