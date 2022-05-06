<?php
include '../connection.php';
$id = $_GET['id'];
$status = $_GET['status'];

$q = "update bedrequest set status='$status' where bookingId='$id'";
$s = mysqli_query($conn, $q);
if ($s) {
    echo '<script>location.href="booking.php"</script>';
}
