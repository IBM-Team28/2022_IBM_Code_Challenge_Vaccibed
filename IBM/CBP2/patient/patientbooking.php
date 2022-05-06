<?php
session_start(); //to start the session
include "../connection.php";
include "patientbase.php";
$email = $_SESSION['email'];
$id = $_SESSION['id'];
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

    td,
    th {
        padding: 10px;
    }

    #tbl {
        width: 900px;
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

    /*tr:nth-child(odd) {background-color: silver;}*/
</style>
</style>
<div id="log">
    <form method="POST">
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Bed Request details</h3>
        <table id="tbl" border="1">
            <tr>
                
                <th>Bed Type</th>
                <th>Requesting Date</th>
                <th>Hospital</th>
                <th>PLACE</th>
                <th>EMAIL</th>
                <th>CONTACT</th>
                <th colspan="2">STATUS</th>
            </tr>
            <?php
            $q = "SELECT * FROM `bedrequest` bb, `bedcategory` bc WHERE bb.`bcid`=bc.`bcid` AND bb.pid='$id'";
            // echo $q;
            $s = mysqli_query($conn, $q);
            while ($r = mysqli_fetch_array($s)) {
                echo '<tr>
                
                <td>' . $r['category'] . '</td>
                <td>' . $r['bookingdate'] . '</td>';
                if ($r['hid'] > 0) {
                    $hid = $r['hid'];
                    $qryHos = "SELECT * FROM `hospital` WHERE `hospital_id`='$hid'";
                    $resHos = mysqli_query($conn, $qryHos);
                    $rowHos = mysqli_fetch_array($resHos);
                    echo '<td>' . $rowHos['name'] . '</td>
                <td>' . $rowHos['place'] . '</td>
                <td>' . $rowHos['email'] . '</td>
                <td>' . $rowHos['contact'] . '</td>';
                } else {
                    echo "<td colspan=5 class='text-dark'>No Hospital Allocated...</td>";
                }

                if ($r['status'] == 'Discharged')
                    echo "<td>Discharged on $r[dischargedate]</a>";
                else
                    echo '<td>' . $r['status'] . '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </form>
</div>