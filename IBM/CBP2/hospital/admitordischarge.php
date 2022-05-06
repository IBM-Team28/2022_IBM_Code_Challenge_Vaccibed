<?php
include '../connection.php';
$id = $_GET['id'];
$status = $_GET['status'];
echo $id;
$date = date("Y-m-d");
$q = "update bedrequest set status='$status', dischargedate='$date' where bookingId='$id'";
$s = mysqli_query($conn, $q);
if ($s) {
    if ($status == "Discharged") {
        $booking = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `bedrequest` WHERE `bookingid`='$id'"));
        $type = $booking['bcid'];
        $hid = $booking['hid'];
        $bedCount = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `beddetails` WHERE `hospital_id`='$hid' AND `bcid`='$type'"));
        $count = $bedCount['bAvailable'];
        $bid = $bedCount['bid'];
        $newCount = $count + 1;
        $update = "UPDATE `beddetails` SET `bAvailable`='$newCount' WHERE `bid`='$bid'";
        echo $update;
        if (mysqli_query($conn, $update) == TRUE) {
            echo '<script>location.href="hospitalviewpatients.php"</script>';
        }
    }
    echo '<script>location.href="hospitalviewpatients.php"</script>';
} else {
    echo '<script>alert("Error")</script>';
}
