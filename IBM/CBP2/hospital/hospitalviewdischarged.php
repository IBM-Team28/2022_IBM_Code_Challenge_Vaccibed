<?php
session_start(); //to start the session
include "../connection.php";
include "hospitalbase.php";
$email = $_SESSION['email'];
$id = $_SESSION['id'];
$x = "select * from hospital where email='$email'";
$y = mysqli_query($conn, $x);
$z = mysqli_fetch_array($y);
?>
<style type="text/css">
    #log {
        background-color: rgba(0, 150, 220, 0.5);
        margin: 10px 150px;
        padding: 50px;
        color: white;
        width: 1050px;
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
<center><h2><?php echo $z['name']; ?></h2></center>
    <form method="POST">
        <h3>Search:</h3>
        From:
        <input type="date" name="sdate" id="f" oninput="checkdate()" max="2022-03-02" required="" style="color:#000; padding:5px">
        To:
        <input type="date" name="edate" id="t" onfocus="checkdate()" max="2022-03-02" required="" style="color:#000; padding:5px">
        <input type="submit" value="Search" style="color:#000; padding:5px" name="search">
    </form>
    <script>
        function checkdate()
        {
            var s=document.getElementById('f').value;
            var td=document.getElementById('t');

            td.min=s;
        
        }
        </script>
    <?php
    if (isset($_REQUEST['search'])) {
        $sdate = $_REQUEST['sdate'];
        $edate = $_REQUEST['edate'];
        echo "<h3>$sdate - $edate</h3>";
    ?>
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Discharged Patients</h3>
        <table id="tbl" border="1">
            <tr>
                
                <th>NAME</th>
                <th>ADDRESS</th>
                <th>Local Body</th>
                <th>EMAIL</th>
                <th>CONTACT</th>
                <th>BED</th>
                <th>BOOKING DATE</th>
                <th>Discharged DATE</th>
                <th colspan="2">STATUS</th>
            </tr>
        <?php

        $q = "SELECT patients.*,beddetails.*,bedrequest.*,bedcategory.* FROM patients,beddetails,bedrequest, bedcategory WHERE patients.pat_id=bedrequest.pid AND beddetails.bcid=bedrequest.bcid  AND bedrequest.`dischargedate` >= '$sdate' and bedrequest.`dischargedate` <= '$edate' AND bedcategory.`bcid`=beddetails.`bcid` AND beddetails.hospital_id='$id' AND bedrequest.`status`='Discharged' AND bedrequest.hid='$id' order by bedrequest.dischargedate desc";
        $s = mysqli_query($conn, $q);
        $count = mysqli_num_rows($s);
        if ($count > 0) {
            while ($r = mysqli_fetch_array($s)) {
                echo '<tr>
                
                <td>' . $r['name'] . '</td>
                <td>' . $r['housename'] . '</td>
                <td>' . $r['lbody'] . '</td>
                <td>' . $r['email'] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['dischargedate'] . '</td>
                <td>' . $r['status'] . '</td>';
                if ($r['status'] == "Admitted")
                    echo '<td><a href="admitordischarge.php?id=' . $r['bookingid'] . '&status=Discharged">Mark as Discharged</a>';
                echo '</tr>';
            }
        } else {
            echo "<tr><td colspan=9><center><h3>No Discharges on this date...</h3><center></td></tr>";
        }
    }
        ?>
        </table>
</div>