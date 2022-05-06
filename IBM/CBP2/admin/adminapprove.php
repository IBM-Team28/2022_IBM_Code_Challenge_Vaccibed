<?php
include '../connection.php';
$id=$_GET['id'];
$status=$_GET['status'];
$q="update login set status='$status' where user_name='$id'";
$s=mysqli_query($conn,$q);
if($s)
{
    echo '<script>location.href="adminhospital.php"</script>';
}
