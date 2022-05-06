<?php
session_start(); //to start the session
include "../connection.php";
include "adminbase.php";
$email = $_GET['id'];
$q="SELECT * FROM (SELECT * FROM hospital h INNER JOIN login l ON h.email=l.user_name) as t where t.email='$email'";
$s=mysqli_query($conn,$q);
$r=mysqli_fetch_array($s);
?>

<a href="mailto:<?php echo $r['email']; ?>?Subject=Login%20Credentials&body=username:%20<?php echo $r['email'] ?>%20password:%20<?php echo $r['password'] ?>"><img src="../images/mail.png"></a>


