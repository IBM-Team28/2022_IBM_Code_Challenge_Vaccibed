<?php
$conn = mysqli_connect("localhost", "root", "", "cbp");
$id = $_GET['id'];
$q = "DELETE FROM bedcategory WHERE category = Ventilator";
$s = mysqli_query($conn, $q);
if ($s) {
    echo '<script>location.href="adminaddbedtypes.php"</script>';
}
?>