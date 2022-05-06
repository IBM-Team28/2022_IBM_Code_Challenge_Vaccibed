<?php
session_start(); //to start the session
include "../connection.php";
include "hospitalbase.php";
$email = $_SESSION['email'];
$id = $_SESSION['id'];
$qry = "SELECT * FROM `bedcategory`";
$result = mysqli_query($conn, $qry);
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
					<td>Name of bed</td>
					<td><select class="form-control" name="txtName">
							<?php
							while ($row = mysqli_fetch_array($result)) {
								echo "<option value='$row[bcid]'>$row[category]</option>";
							}
							?>

						</select></td>
				</tr>

				
				<tr>
					<td>Total bed</td>
					<td><input type="text" class="form-control" pattern="[0-9]{1,5}" name="txtTotal" id="tb"  required=""></td>
				</tr>

				<tr>
					<td>Available bed</td>
					<td><input type="text" class="form-control" name="txtAvailable" pattern="[0-9]{1,5}" id="ab"  oninput="calc()" required=""></td>
				</tr>

				<!-- <tr>
					<td>Rate per day</td>
					<td><input type="text" class="form-control" pattern="[0-9]{1,5}" name="txtRate" required=""></td>
				</tr> -->


				<tr>


					<td></td>
					<td colspan="4"><input type="submit" class="btn btn-warning" name="btnSubmit" required=""></td>
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
	<table id="tbl" border="1">
		<tr>
			<th>NAME</th>
			<th>DESCRIPTION</th>
			<th>TOTAL BEDS</th>
			<th>AVAILABLE BEDS</th>
			<th colspan="2">Action</th>
		</tr>
		<?php
		$q = "SELECT * FROM beddetails bd, `bedcategory` bc WHERE bd.`hospital_id`='$id' AND bd.bAvailable>0 AND bd.`bcid`=bc.`bcid`";
		$s = mysqli_query($conn, $q);
		while ($r = mysqli_fetch_array($s)) {
			echo '<tr>
		    	<td>' . $r['category'] . '</td>
		    	<td>' . $r['description'] . '</td>
		    	<td>' . $r['bTotal'] . '</td>
		    	<td>' . $r['bAvailable'] . '</td>
		    	<td><a href="bedupdate.php?id=' . $r['bid'] . '">Update</a></td>
		    	<td><a href="beddelete.php?id=' . $r['bid'] . '">Delete</a></td></tr>';
		}
		?>
	</table>
</div>
<?php

if (isset($_REQUEST['btnSubmit'])) {
	$name = $_REQUEST['txtName'];
	$available = $_REQUEST['txtAvailable'];
	$total = $_REQUEST['txtTotal'];
	if($total<$available)
	{
		echo '<script>alert("Enter availbale bed according to total bed..")</script>';
	}
    else
	{

	$q = "insert into beddetails (`hospital_id`,`bcid`,`bTotal`,`bAvailable`) values('$id','$name','$total','$available')";
	$s = mysqli_query($conn, $q);
	if ($s) {
		echo '<script>alert("Details added.")</script>';
		echo '<script>location.href="hospitalbed.php"</script>';
		// echo $q;
	} else {
		echo '<script>alert("Sorry some error occured")</script>';
		// echo '<script>location.href="index.php"</script>';
	}
}
}
?>