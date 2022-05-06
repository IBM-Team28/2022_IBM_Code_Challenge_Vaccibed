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
			width: 1100px;
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

		th,
		td {
			padding: 10px;
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
		<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Patients</h3>
		<?php
		if (isset($_REQUEST['find'])) {
			$user = $_REQUEST['user'];
		?>
			<table id="tbl" border="1">
				<tr>
					
					<th>NAME</th>
					<th>EMAIL</th>
					<th>HOUSE</th>
					<th>PLACE</th>
					<th>LOCAL BODY</th>
					<th>AGE</th>
					<th>GENDER</th>
					<th>AADHAR</th>
					<th>PIN</th>
					<th colspan="2">CONTACT</th>
				</tr>
				<?php
				$q = "SELECT patients.*,login.status FROM patients,login WHERE patients.email=login.user_name AND login.status='1' AND patients.name LIKE '%$user%'";
				$s = mysqli_query($conn, $q);
				while ($r = mysqli_fetch_array($s)) {
					echo '<tr>
		    	
		    	<td>' . $r['name'] . '</td>
		    	<td>' . $r['email'] . '</td>
		    	<td>' . $r['housename'] . '</td>
		    	<td>' . $r['adrs'] . '</td>
				<td>' . $r['lbody'] . '</td>
				<td>' . $r['age'] . '</td>
				<td>' . $r['gender'] . '</td>
		    	<td>' . $r['id_proof'] . '</td>
		    	<td>' . $r['pin'] . '</td>
		    	<td>' . $r['phone'] . '</td>';
					if ($r['status'] == '1') {
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
					<th>EMAIL</th>
					<th>HOUSE</th>
					<th>PLACE</th>
					<th>LOCAL BODY</th>
					<th>AGE</th>
					<th>GENDER</th>
					<th>AADHAR</th>
					<th>PIN</th>
					<th colspan="2">CONTACT</th>
				</tr>
				<?php
				$q = "SELECT patients.*,login.status FROM patients,login WHERE patients.email=login.user_name AND login.status='1' ORDER BY patients.name";
				$s = mysqli_query($conn, $q);
				while ($r = mysqli_fetch_array($s)) {
					echo '<tr>
		    	
		    	<td>' . $r['name'] . '</td>
		    	<td>' . $r['email'] . '</td>
		    	<td>' . $r['housename'] . '</td>
		    	<td>' . $r['adrs'] . '</td>
				<td>' . $r['lbody'] . '</td>
				<td>' . $r['age'] . '</td>
				<td>' . $r['gender'] . '</td>
		    	<td>' . $r['id_proof'] . '</td>
		    	<td>' . $r['pin'] . '</td>
		    	<td>' . $r['phone'] . '</td>';
					if ($r['status'] == '1') {
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
					<th>EMAIL</th>
					<th>HOUSE</th>
					<th>PLACE</th>
					<th>LOCAL BODY</th>
					<th>AGE</th>
					<th>GENDER</th>
					<th>AADHAR</th>
					<th>PIN</th>
					<th colspan="2">CONTACT</th>
				</tr>
				<?php
				$q = "SELECT patients.*,login.status FROM patients,login WHERE patients.email=login.user_name AND login.status='1' ORDER BY patients.name DESC";
				$s = mysqli_query($conn, $q);
				while ($r = mysqli_fetch_array($s)) {
					echo '<tr>
					
					<td>' . $r['name'] . '</td>
					<td>' . $r['email'] . '</td>
					<td>' . $r['housename'] . '</td>
					<td>' . $r['adrs'] . '</td>
					<td>' . $r['lbody'] . '</td>
					<td>' . $r['age'] . '</td>
				    <td>' . $r['gender'] . '</td>
					<td>' . $r['id_proof'] . '</td>
					<td>' . $r['pin'] . '</td>
					<td>' . $r['phone'] . '</td>';
					if ($r['status'] == '1') {
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
					<th>EMAIL</th>
					<th>HOUSE</th>
					<th>PLACE</th>
					<th>LOCAL BODY</th>
					<th>AGE</th>
					<th>GENDER</th>
					<th>AADHAR</th>
					<th>PIN</th>
					<th colspan="2">CONTACT</th>
				</tr>
				<?php
				$q = "select patients.*,login.status from patients,login where patients.email=login.user_name and login.status='1'";
				$s = mysqli_query($conn, $q);
				while ($r = mysqli_fetch_array($s)) {
					echo '<tr>
		    	
		    	<td>' . $r['name'] . '</td>
		    	<td>' . $r['email'] . '</td>
		    	<td>' . $r['housename'] . '</td>
		    	<td>' . $r['adrs'] . '</td>
				<td>' . $r['lbody'] . '</td>
				<td>' . $r['age'] . '</td>
				<td>' . $r['gender'] . '</td>
		    	<td>' . $r['id_proof'] . '</td>
		    	<td>' . $r['pin'] . '</td>
		    	<td>' . $r['phone'] . '</td>';
					if ($r['status'] == '1') {
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