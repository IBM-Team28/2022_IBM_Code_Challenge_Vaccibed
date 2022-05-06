<?php
session_start(); //to start the session
include 'connection.php';
include "commonbase.php";
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
				<td><input type="text" class="form-control" pattern="[a-z A-Z ]+" name="txtName" required=""></td>

				<td>&nbsp;&nbsp;&nbsp;&nbsp;House name</td>
				<td><input type="text" class="form-control" pattern="[a-z A-Z ]+" name="txtHouse" required=""></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Place</td>
				<td><input type="text" class="form-control" pattern="[a-z A-Z ]+" name="txtPlace" required=""></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;Pin</td>
				<td><input type="text" class="form-control" pattern="[6][0-9]{5}" maxlength="6" name="txtPin" required=""></td>

			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
			<td>Age</td>
				<td><input type="number" class="form-control"   name="txtAge" max="110" min="1" required=""></td>
</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>

				<td>Aadhar</td>
				<td><input type="text" class="form-control" pattern="[1-9][0-9]{11}" name="txtAadhar" maxlength="12" required=""></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;Contact</td>
				<td><input type="text" class="form-control" pattern="[6789][0-9]{9}" name="txtContact" required=""></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;Gender</td>
				<td class="text-center"><input type="radio" class="form-control" value="male" name="txtGend">Male
					<input type="radio" class="form-control" value="female" name="txtGend">Female
				</td>
				<td>Local Body</td>
				<td><input type="text" class="form-control" pattern="[a-zA-Z ]+" name="txtBody" required=""></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" class="form-control" name="txtEmail" required=""></td>

				<td>&nbsp;&nbsp;&nbsp;&nbsp;Password</td>
				<td><input type="Password" class="form-control" name="txtPwd" required=""></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2"><a style="color:white;" href="index.php">Already a user? Login here</a></td>

				<td></td>
				<td><input type="submit" style="width:300px;" class="btn btn-warning" name="btnSubmit" required=""></td>
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
	$email = $_REQUEST['txtEmail'];
	$pwd = $_REQUEST['txtPwd'];
	$gender = $_REQUEST['txtGend'];
	$lbody=$_REQUEST['txtBody'];
	$age=$_REQUEST['txtAge'];

	$q = "select count(*) from login where user_name='$email'";
	$s = mysqli_query($conn, $q);
	$r = mysqli_fetch_array($s);
	if ($r[0] > 0)    //to check whether the username exist
	{
		echo '<script>alert("Email already registered")</script>';
		echo '<script>location.href="index.php"</script>';
	} else {
		$q = "insert into patients (name,housename,adrs,id_proof,pin,email,phone,gender,lbody,age) values('$name','$house','$place','$aadhar','$pin','$email','$contact','$gender','$lbody',$age)";
		$s = mysqli_query($conn, $q);
		if ($s) {

			$q = "insert into login (user_name,password,user_type,status) values('$email','$pwd','patient','1')";
			$s = mysqli_query($conn, $q);
			if ($s) {
				echo '<script>alert("Registration successful.")</script>';
				echo '<script>location.href="index.php"</script>';
			} else {
				echo '<script>alert("Sorry some error occured")</script>';
				// echo '<script>location.href="index.php"</script>';

			}
		} else {
			echo '<script>alert("Sorry some error occured")</script>';
			// echo '<script>location.href="index.php"</script>';
			echo $q;
		}
	}
}
?>