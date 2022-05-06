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
</style>
<div id="log">
	<form method="POST">
		<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Welcome COVID Control Room</h3>
	</form>
</div>