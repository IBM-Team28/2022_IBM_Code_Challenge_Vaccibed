<?php
include "../connection.php";
$id = $_GET["id"];
$qry = "UPDATE `bedrequest` SET `status`='Rejected' WHERE `bookingid`='$id'";
if (mysqli_query($conn, $qry) == TRUE) {
    echo "<script>alert('Requested Rejected...');
    window.location = 'adminviewrequest.php';
    </script>";
} else {
    echo "<script>alert('Error Occured...');
    window.location = 'adminviewbooking.php';
    </script>";
}
