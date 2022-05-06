<?php
session_start(); //to start the session
include "connection.php";
include "commonbase.php";
?>
<style type="text/css">
	#log{
		
		margin: 20px 300px;
		padding: 50px;
		color: white;
		width: 400px;
		float: left;
	}
</style>
<div id="log" >
	<h3 style="margin:10px 30px 5px 120px; color:#ebd231; font-weight: 600;">Patient?</h3>
	<!--<a href="commonhospital.php">
		<img src="images/hosp.png" style="height: 150px; width:150px; margin: 20px; ">
	</a>-->
	<a href="commonpatient.php">
		<img src="images/patient.png" style="height: 130px; width:130px; border-radius: 50%; margin: 100px; ">
	</a>
</div>