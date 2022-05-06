<?php
session_start(); //to start the session
include "../connection.php";
include "adminbase.php";
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

	/*tr:nth-child(odd) {background-color: silver;}*/
</style>
<div id="log">
	<form method="POST">
		<input type="search" name="user" id="" style="color:#000">
		<input type="submit" name="find" value="Find" style="background-color: #ebd231;">
	</form>
	<form method="POST">
		<input type="submit" name="sort" value="A-Z" style="background-color: #ebd231;">
		<input type="submit" name="sortDesc" value="Z-A" style="background-color: #ebd231;">
	</form>
	<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Hospitals</h3>
	<?php
	if (isset($_REQUEST['find'])) {
		$user = $_REQUEST['user'];
	?>
		<table id="tbl" border="1">
			<tr>
				
				<th>NAME</th>
				<th>ADDRESS</th>
				<th>PLACE</th>
				<th>PIN</th>
				<th>LICENSE</th>
				<th>EMAIL</th>
				<th colspan="2">CONTACT</th>
			</tr>
			<?php
			$q = "SELECT hospital.*,login.status FROM hospital,login WHERE hospital.email=login.user_name AND (login.status='1' OR login.status='0') AND hospital.`name` LIKE '%$user%'";
			$s = mysqli_query($conn, $q);
			while ($r = mysqli_fetch_array($s)) {
				echo '<tr>
		    	
		    	<td>' . $r['name'] . '</td>
		    	<td>' . $r['adrs'] . '</td>
		    	<td>' . $r['place'] . '</td>
		    	<td>' . $r['pin'] . '</td>
		    	<td>' . $r['licen_num'] . '</td>
		    	<td>' . $r['email'] . '</td>
		    	<td>' . $r['contact'] . '</td>';
				if ($r['status'] == '0') {
					echo '<td><a href="adminapprove.php?id=' . $r['email'] . '&status=1">Approve</a>
		    		 || <a href="adminapprove.php?id=' . $r['email'] . '&status=-1">Reject</a></td>';
				} else if ($r['status'] == '1') {
					echo '<td><a href="adminapprove.php?id=' . $r['email'] . '&status=-1">Delete</a>';
				}
				echo '</tr>';
			}
			?>
		</table>
	<?php
	} else if (isset($_REQUEST['sort'])) {
	?>
		<table id="tbl" border="1">
			<tr>
				
				<th>NAME</th>
				<th>ADDRESS</th>
				<th>PLACE</th>
				<th>PIN</th>
				<th>LICENSE</th>
				<th>EMAIL</th>
				<th colspan="2">CONTACT</th>
			</tr>
			<?php
			$q = "SELECT hospital.*,login.status FROM hospital,login WHERE hospital.email=login.user_name AND (login.status='1' OR login.status='0') order by hospital.name ";
			$s = mysqli_query($conn, $q);
			while ($r = mysqli_fetch_array($s)) {
				echo '<tr>
		    	
		    	<td>' . $r['name'] . '</td>
		    	<td>' . $r['adrs'] . '</td>
		    	<td>' . $r['place'] . '</td>
		    	<td>' . $r['pin'] . '</td>
		    	<td>' . $r['licen_num'] . '</td>
		    	<td>' . $r['email'] . '</td>
		    	<td>' . $r['contact'] . '</td>';
				if ($r['status'] == '0') {
					echo '<td><a href="adminapprove.php?id=' . $r['email'] . '&status=1">Approve</a>
		    		 || <a href="adminapprove.php?id=' . $r['email'] . '&status=-1">Reject</a></td>';
				} else if ($r['status'] == '1') {
					echo '<td><a href="adminapprove.php?id=' . $r['email'] . '&status=-1">Delete</a>';
				}
				echo '</tr>';
			}
			?>
		</table>
	<?php
	} else if (isset($_REQUEST['sortDesc'])) {
	?>
		<table id="tbl" border="1">
			<tr>
				
				<th>NAME</th>
				<th>ADDRESS</th>
				<th>PLACE</th>
				<th>PIN</th>
				<th>LICENSE</th>
				<th>EMAIL</th>
				<th colspan="2">CONTACT</th>
			</tr>
			<?php
			$q = "SELECT hospital.*,login.status FROM hospital,login WHERE hospital.email=login.user_name AND (login.status='1' OR login.status='0') order by hospital.name DESC";
			$s = mysqli_query($conn, $q);
			while ($r = mysqli_fetch_array($s)) {
				echo '<tr>
					
					<td>' . $r['name'] . '</td>
					<td>' . $r['adrs'] . '</td>
					<td>' . $r['place'] . '</td>
					<td>' . $r['pin'] . '</td>
					<td>' . $r['licen_num'] . '</td>
					<td>' . $r['email'] . '</td>
					<td>' . $r['contact'] . '</td>';
				if ($r['status'] == '0') {
					echo '<td><a href="adminapprove.php?id=' . $r['email'] . '&status=1">Approve</a>
						 || <a href="adminapprove.php?id=' . $r['email'] . '&status=-1">Reject</a></td>';
				} else if ($r['status'] == '1') {
					echo '<td><a href="adminapprove.php?id=' . $r['email'] . '&status=-1">Delete</a>';
				}
				echo '</tr>';
			}
			?>
		</table>
	<?php
	} else {


	?>

		<table id="tbl" border="1">
			<tr>
				
				<th>NAME</th>
				<th>ADDRESS</th>
				<th>PLACE</th>
				<th>PIN</th>
				<th>LICENSE</th>
				<th>EMAIL</th>
				<th colspan="2">CONTACT</th>
			</tr>
			<?php
			$q = "SELECT hospital.*,login.status FROM hospital,login WHERE hospital.email=login.user_name AND (login.status='1' OR login.status='0')";
			$s = mysqli_query($conn, $q);
			while ($r = mysqli_fetch_array($s)) {
				echo '<tr>
		    	
		    	<td>' . $r['name'] . '</td>
		    	<td>' . $r['adrs'] . '</td>
		    	<td>' . $r['place'] . '</td>
		    	<td>' . $r['pin'] . '</td>
		    	<td>' . $r['licen_num'] . '</td>
		    	<td>' . $r['email'] . '</td>
		    	<td>' . $r['contact'] . '</td>';
				if ($r['status'] == '0') {
					echo '<td><a href="adminapprove.php?id=' . $r['email'] . '&status=1">Approve</a>
		    		 || <a href="adminapprove.php?id=' . $r['email'] . '&status=-1">Reject</a></td>';
				} else if ($r['status'] == '1') {
					echo '<td><a href="adminapprove.php?id=' . $r['email'] . '&status=-1">Delete</a>';
				}
				echo '</tr>';
			}
			?>
		</table>
	<?php
	}
	?>
</div>