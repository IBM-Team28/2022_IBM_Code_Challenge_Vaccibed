<?php
session_start(); //to start the session
include "../connection.php";
include "adminbase.php";
$email = $_SESSION['email'];
// $id = $_SESSION['id'];
$bookingId = $_GET['id'];
$type = $_GET['type'];
$qry = "SELECT * FROM `beddetails` bd, `hospital` h WHERE bd.`hospital_id`=h.`hospital_id` AND bd.`bAvailable`>0 AND bd.`bcid`='$type'";
$result = mysqli_query($conn, $qry);

?>
<style type="text/css">
    #log {
        background-color: rgba(0, 150, 220, 0.5);
        margin: 10px 150px;
        padding: 50px;
        color: white;
        width: 1200px;
        float: left;
    }

    td,
    th {
        padding: 10px;
    }

    #tbl {
        width: 1100px;
    }

    a {
        color: #ebd231;
    }

    table {
        border-collapse: collapse;
        border: none;
    }

    th {
        background-color: rgba(0, 100, 180, 0.7);
        color: #ebd231;
    }

    #btnSub {
        border-radius: 10px;
    }

    #btnSub:hover {
        background-color: #FABA59;
    }

    /*tr:nth-child(odd) {background-color: silver;}*/
</style>
</style>
<div id="log">
    <form method="POST">
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Allocate</h3>
        <table id="tbl" border="1">
            <tr>
                <th><select name="hospital" id="" style="padding: 10px; width:100%; word-spacing:20px; text-align:center">
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $row['hospital_id'] ?>"><?php echo $row['name'] . " " . $row['place'] . ", Bed Available:" . $row['bAvailable']; ?></option>
                        <?php
                        }
                        ?>
                    </select></th>
            </tr>
            <tr>
                <td class=" text-center"><input type="submit" name="submit" value="Allocate" id="btnSub" class="bg-primary" style="border:none; padding:10px"></td>
            </tr>
        </table>
    </form>
</div>
<?php
if (isset($_REQUEST['submit'])) {
    $hospital = $_REQUEST['hospital'];
    $qryUp = "UPDATE `bedrequest` SET `hid`='$hospital', `status`='Allocated' WHERE `bookingid`='$bookingId'";
    if (mysqli_query($conn, $qryUp) == TRUE) {
        $bedCount = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `beddetails` WHERE `hospital_id`='$hospital' AND `bcid`='$type'"));
        $count = $bedCount['bAvailable'];
        $bid = $bedCount['bid'];
        $newCount = $count - 1;
        $update = "UPDATE `beddetails` SET `bAvailable`='$newCount' WHERE `bid`='$bid'";
        if (mysqli_query($conn, $update)) {
?>
            <script>
                alert("Hospital Allocated");
                window.location = "adminviewbooking.php"
            </script>
<?php
        }
    }
}
?>