<?php
session_start(); //to start the session
include "../connection.php";
include "adminbase.php";
$email = $_SESSION['email'];
// $id = $_SESSION['id'];
$qryCat = "SELECT * FROM `bedcategory`";
$resCat = mysqli_query($conn, $qryCat);
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

    /*tr:nth-child(odd) {background-color: silver;}*/
</style>
</style>
<div id="log">
    <form method="POST">
        <input type="search" name="user" id="" style="color:#000">
        <input type="submit" name="find" value="Find" style="background-color: #000;">
    </form>
    <form method="POST">
        <input type="submit" name="sort" value="A-Z" style="background-color: #000;">
        <input type="submit" name="sortDesc" value="Z-A" style="background-color: #000;">
    </form>
    <?php
    if (isset($_REQUEST['find'])) {
        $user = $_POST['user'];
    ?>
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Request Details</h3>
        
            <table id="tbl" border="1">
               
                <tr>
                   
                    <th>NAME</th>
                    <th>ADDRESS</th>
                   
                    <th>Local Body</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>BED</th>
                    <th>BOOKING DATE</th>
                    <th>Current Situation</th>
                    <th>DOCUMENTS</th>
                    <th colspan="2">STATUS</th>
                </tr>
                <?php
                $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb WHERE bb.`pid`=p.`pat_id` AND bb.`bcid`= bc.`bcid` AND p.`name` LIKE '%$user%' AND bb.`status`<>'Discharged' AND p.`email` IN ( SELECT `user_name` FROM `login`)  ORDER BY bookingid DESC";

                $s = mysqli_query($conn, $q);
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
                
                <td>' . $r['name'] . '</td>
                <td>' . $r['housename'] . '</td>
                
                <td>' . $r['lbody'] . '</td>
                <td>' . $r['email'] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['currentsituation'] . '</td>
                <td><a href="' . $r['proof'] . '" target="_blank">Documents</a></td>
                <td>' . $r['status'] . '</td>';
                    if ($r['status'] == "Requested") {
                        echo '<td><a href="adminapprovebooking.php?id=' . $r['bookingid'] . '&status=approved&type=' . $r['bcid'] . '">Allocate</a>
                 / <a href="adminrejectbooking.php?id=' . $r['bookingid'] . '&status=rejected">Reject</a>';
                    } else
                        echo "<td></td>";
                    echo '</tr>';
                }
                ?>
            </table>
        <?php
        
        
        ?>
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Details of Patients directly Admitted By Hospitals</h3>
        
            <table id="tbl" border="1">
                
                <tr>
                    
                    <th>NAME</th>
                    <th>ADDRESS</th>
                   
                    <th>Local Body</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>Hospital</th>
                    <th>BED</th>
                    <th>BOOKING DATE</th>
                    <th colspan="2">STATUS</th>
                </tr>
                <?php
                $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb, `hospital` h WHERE bb.`pid`=p.`pat_id`  AND bb.`status`<>'Discharged' AND bb.`bcid`= bc.`bcid` AND p.`email`NOT IN ( SELECT `user_name` FROM `login`) AND bb.`hid`=h.`hospital_id`";

                $s = mysqli_query($conn, $q);
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
                
                <td>' . $r[1] . '</td>
                <td>' . $r['housename'] . '</td>
                
                <td>' . $r['lbody'] . '</td>
                <td>' . $r[2] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['name'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['status'] . '</td>';

                    echo '</tr>';
                }
                ?>
            </table>
        
    <?php
    } else if (isset($_REQUEST['sort'])) {
    ?>
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Booking Details</h3>
        
            <table id="tbl" border="1">
               
                <tr>
                    
                    <th>NAME</th>
                    <th>ADDRESS</th>
                   
                    <th>Local Body</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>BED</th>
                    <th>BOOKING DATE</th>
                    <th>Current Situation</th>
                    <th>DOCUMENTS</th>
                    <th colspan="2">STATUS</th>
                </tr>
                <?php
                $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb WHERE bb.`pid`=p.`pat_id` AND bb.`bcid`= bc.`bcid` AND bb.`status`<>'Discharged' AND p.`email` IN ( SELECT `user_name` FROM `login`)  ORDER BY p.name ";

                $s = mysqli_query($conn, $q);
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
                
                <td>' . $r['name'] . '</td>
                <td>' . $r['housename'] . '</td>
                
                <td>' . $r['lbody'] . '</td>
                <td>' . $r['email'] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['currentsituation'] . '</td>
                <td><a href="' . $r['proof'] . '" target="_blank">Documents</a></td>
                <td>' . $r['status'] . '</td>';
                    if ($r['status'] == "Requested") {
                        echo '<td><a href="adminapprovebooking.php?id=' . $r['bookingid'] . '&status=approved&type=' . $r['bcid'] . '">Allocate</a>
                 / <a href="adminrejectbooking.php?id=' . $r['bookingid'] . '&status=rejected">Reject</a>';
                    } else
                        echo "<td></td>";
                    echo '</tr>';
                }
                ?>
            </table>
        
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Details of Patients directly Admitted By Hospitals</h3>
        
            <table id="tbl" border="1">
                
                <tr>
                    
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    
                    <th>Local Body</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>Hospital</th>
                    <th>BED</th>
                    <th>BOOKING DATE</th>
                    <th colspan="2">STATUS</th>
                </tr>
                <?php
                $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb, `hospital` h WHERE bb.`pid`=p.`pat_id`  AND bb.`status`<>'Discharged' AND bb.`bcid`= bc.`bcid` AND p.`email`NOT IN ( SELECT `user_name` FROM `login`) AND bb.`hid`=h.`hospital_id`";

                $s = mysqli_query($conn, $q);
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
                
                <td>' . $r[1] . '</td>
                <td>' . $r['housename'] . '</td>
                
                <td>' . $r['lbody'] . '</td>
                <td>' . $r[2] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['name'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['status'] . '</td>';

                    echo '</tr>';
                }
                ?>
            </table>
        
    <?php
    } else if (isset($_REQUEST['sortDesc'])) {
    ?>
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Request Details</h3>
        
            <table id="tbl" border="1">
                
                <tr>
                   
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    
                    <th>Local Body</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>BED</th>
                    <th>BOOKING DATE</th>
                    <th>Current Situation</th>
                    <th>DOCUMENTS</th>
                    <th colspan="2">STATUS</th>
                </tr>
                <?php
                $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb WHERE bb.`pid`=p.`pat_id` AND bb.`bcid`= bc.`bcid` AND bb.`status`<>'Discharged' AND p.`email` IN ( SELECT `user_name` FROM `login`) ORDER BY p.name DESC";

                $s = mysqli_query($conn, $q);
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
                    
                    <td>' . $r['name'] . '</td>
                    <td>' . $r['housename'] . '</td>
                    
                    <td>' . $r['lbody'] . '</td>
                    <td>' . $r['email'] . '</td>
                    <td>' . $r['phone'] . '</td>
                    <td>' . $r['category'] . '</td>
                    <td>' . $r['bookingdate'] . '</td>
                    <td>' . $r['currentsituation'] . '</td>
                    <td><a href="' . $r['proof'] . '" target="_blank">Documents</a></td>
                    <td>' . $r['status'] . '</td>';
                    if ($r['status'] == "Requested") {
                        echo '<td><a href="adminapprovebooking.php?id=' . $r['bookingid'] . '&status=approved&type=' . $r['bcid'] . '">Allocate</a>
                     / <a href="adminrejectbooking.php?id=' . $r['bookingid'] . '&status=rejected">Reject</a>';
                    } else
                        echo "<td></td>";
                    echo '</tr>';
                }
                ?>
            </table>
        
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Details of Patients directly Admitted By Hospitals</h3>
        
            <table id="tbl" border="1">
                
                <tr>
                    
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    
                    <th>Local Body</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>Hospital</th>
                    <th>BED</th>
                    <th>BOOKING DATE</th>
                    <th colspan="2">STATUS</th>
                </tr>
                <?php
                $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb, `hospital` h WHERE bb.`pid`=p.`pat_id` AND bb.`status`<>'Discharged' AND bb.`bcid`= bc.`bcid` AND p.`email`NOT IN ( SELECT `user_name` FROM `login`) AND bb.`hid`=h.`hospital_id`";

                $s = mysqli_query($conn, $q);
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
                   
                    <td>' . $r[1] . '</td>
                    <td>' . $r['housename'] . '</td>
                    
                    <td>' . $r['lbody'] . '</td>
                    <td>' . $r[2] . '</td>
                    <td>' . $r['phone'] . '</td>
                    <td>' . $r['name'] . '</td>
                    <td>' . $r['category'] . '</td>
                    <td>' . $r['bookingdate'] . '</td>
                    <td>' . $r['status'] . '</td>';

                    echo '</tr>';
                }
                ?>
            </table>
        
    <?php
    } else {
    ?>
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Request Details</h3>
        
            <table id="tbl" border="1">
                
                <tr>
                    
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    
                    <th>Local Body</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>BED</th>
                    <th>BOOKING DATE</th>
                    <th>Current Situation</th>
                    <th>DOCUMENTS</th>
                    <th colspan="2">STATUS</th>
                </tr>
                <?php
                $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb WHERE bb.`pid`=p.`pat_id` AND bb.`bcid`= bc.`bcid`  AND bb.`status`<>'Discharged' AND p.`email` IN ( SELECT `user_name` FROM `login`) ORDER BY bookingid DESC";

                $s = mysqli_query($conn, $q);
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
               
                <td>' . $r['name'] . '</td>
                <td>' . $r['housename'] . '</td>
                
                <td>' . $r['lbody'] . '</td>
                <td>' . $r['email'] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['currentsituation'] . '</td>
                <td><a href="' . $r['proof'] . '" target="_blank">Documents</a></td>
                <td>' . $r['status'] . '</td>';
                    if ($r['status'] == "Requested") {
                        echo '<td><a href="adminapprovebooking.php?id=' . $r['bookingid'] . '&status=approved&type=' . $r['bcid'] . '">Allocate</a>
                 / <a href="adminrejectbooking.php?id=' . $r['bookingid'] . '&status=rejected">Reject</a>';
                    } else
                        echo "<td></td>";
                    echo '</tr>';
                }
                ?>
            </table>
        
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Details of Patients directly Admitted By Hospitals</h3>
        
            <table id="tbl" border="1">
                
                <tr>
                    
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    
                    <th>Local Body</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>Hospital</th>
                    <th>BED</th>
                    <th>BOOKING DATE</th>
                    <th colspan="2">STATUS</th>
                </tr>
                <?php
                $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb, `hospital` h WHERE bb.`pid`=p.`pat_id` AND bb.`status`<>'Discharged' AND bb.`bcid`= bc.`bcid` AND p.`email`NOT IN ( SELECT `user_name` FROM `login`) AND bb.`hid`=h.`hospital_id`";

                $s = mysqli_query($conn, $q);
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
                
                <td>' . $r[1] . '</td>
                <td>' . $r['housename'] . '</td>
                
                <td>' . $r['lbody'] . '</td>
                <td>' . $r[2] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['name'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['status'] . '</td>';

                    echo '</tr>';
                }
                ?>
            </table>
        
    <?php
    }
    ?>


</div>