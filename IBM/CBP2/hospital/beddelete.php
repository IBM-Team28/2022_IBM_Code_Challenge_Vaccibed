<?php
$conn = mysqli_connect("localhost", "root", "", "cbp");
$id = $_GET['id'];
$q = "delete from beddetails where bid=$id";
$s = mysqli_query($conn, $q);
if ($s) {
    echo '<script>location.href="hospitalbed.php"</script>';
}
?>