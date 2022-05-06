<?php
session_start(); //to start the session
include "../connection.php";
include "adminbase.php";
$email = $_SESSION['email'];
// $id = $_SESSION['id'];
$z="SELECT * from bedcategory";
 $zx=mysqli_query($conn,$z);
?>
<style type="text/css">
    #log {
        background-color: rgba(0, 150, 220, 0.5);
        margin: 10px 150px;
        padding: 50px;
        color: white;
        width: 1500px;
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

<div id="log">
    <form method="POST" action="#">
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
    <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Discharged Patients</h3>
    <?php
        $sdate='ghg';
        $edate='bhgv';
    if (isset($_REQUEST['search'])) {
        $sdate = $_REQUEST['sdate'];
        $edate = $_REQUEST['edate'];
         ?>
       
      <table>  
    <form method="POST">
       <tr><td>  <select class="form-control" name="txtName" id="txtName">
             <option>SELECT</OPTION>
							<?php
							while ($row = mysqli_fetch_array($zx)) {?>
								<option value="<?php echo $row['bcid'];?>"><?php echo $row['category']?></option>;
                         <?php   }
							?>

						</select></td></tr>
                        <tr><td>
                        
       <input type=submit value="SEARCH" name="srch" style="color:#000; padding:5px"/></td></tr></table>
       <input type="hidden" value="<?php echo "${sdate}"?>" name='sdate'>
       <input type="hidden" value="<?php echo "${edate}"?>" name='edate'>
                        </form>
         
                            <?php
    }
        if (isset($_REQUEST['srch']))
        {
          
          $b=$_REQUEST['txtName'];
          $sdate = $_REQUEST['sdate'];
          $edate = $_REQUEST['edate'];
          echo "<h3>$sdate - $edate</h3>" ;
          $jm="SELECT * FROM bedcategory where bcid=$b";
          $jk=mysqli_query($conn,$jm);
          $rowcat=mysqli_fetch_array($jk);
          echo "<h2>$rowcat[1]</h2>";
         
          ?>
          <table id="tbl" border="1">
          
                <tr>
                    
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    <th>PLACE</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>BED</th>
                    <th>HOSPITAL</th>
                    <th>BOOKING DATE</th>
                    <th>DISCHARGE DATE</th>
                    <th>Current Situation</th>
                    <th>DOCUMENTS</th>
                    <th>STATUS</th>
                </tr>
          <?php
          
          $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb,hospital h WHERE bb.`pid`=p.`pat_id` AND bb.bcid=$b AND bc.bcid=$b AND bb.`bcid`= bc.`bcid` AND bb.`status`='Discharged' AND  bb.`hid`=h.`hospital_id` AND bb.`dischargedate` >= '$sdate' and bb.`dischargedate` <= '$edate' AND p.`email` IN ( SELECT `user_name` FROM `login`) order by bb.bookingid desc";
          $s = mysqli_query($conn, $q);
          $nu=mysqli_num_rows($s);
          
          if($nu>0)
                {
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
                <td>' . $r[1] . '</td>
                <td>' . $r['housename'] . '</td>
                <td>' . $r[4] . '</td>
                <td>' . $r[2] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['name'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['dischargedate'] . '</td>
                <td>' . $r['currentsituation'] . '</td>
                <td><a href="' . $r['proof'] . '" target="_blank">Documents</a></td>
                <td>' . $r['status'] . '</td>';
                    if ($r['status'] == "Requested") {
                        echo '<td><a href="adminapprovebooking.php?id=' . $r['bookingid'] . '&status=approved&type=' . $r['bcid'] . '">Allocate</a>
                 / <a href="adminrejectbooking.php?id=' . $r['bookingid'] . '&status=rejected">Reject</a>';
                    } else
                        echo "<td></td>";
                }
                }
            else{
                echo "<td colspan=12 class='text-dark' align='center'>No Discharges on this date...</td>";
            }
                
                    echo '</tr>';
                
        
    
    ?>
    </table>
    <br>
    <br>
    <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;"> Patients directly Admitted By Hospitals</h3>
    <table id="tbl" border="1">
          
                <tr>
                    
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    <th>PLACE</th>
                    <th>EMAIL</th>
                    <th>CONTACT</th>
                    <th>BED</th>
                    <th>HOSPITAL</th>
                    <th>BOOKING DATE</th>
                    <th>DISCHARGE DATE</th>
                    
                    <th>STATUS</th>
                </tr>
          <?php
          
          $q = "SELECT * FROM patients p,bedcategory bc,bedrequest bb,hospital h WHERE bb.`pid`=p.`pat_id` AND bb.bcid=$b AND bc.bcid=$b AND bb.`bcid`= bc.`bcid` AND bb.`status`='Discharged' AND  bb.`hid`=h.`hospital_id` AND bb.`dischargedate` >= '$sdate' and bb.`dischargedate` <= '$edate' AND p.`email` NOT IN ( SELECT `user_name` FROM `login`) order by bb.bookingid desc";
          $s = mysqli_query($conn, $q);
          $nu=mysqli_num_rows($s);
          if($nu>0)
          {
                while ($r = mysqli_fetch_array($s)) {
                    echo '<tr>
                
                <td>' . $r[1] . '</td>
                <td>' . $r['housename'] . '</td>
                <td>' . $r[4] . '</td>
                <td>' . $r[2] . '</td>
                <td>' . $r['phone'] . '</td>
                <td>' . $r['category'] . '</td>
                <td>' . $r['name'] . '</td>
                <td>' . $r['bookingdate'] . '</td>
                <td>' . $r['dischargedate'] . '</td>
               
                
                <td>' . $r['status'] . '</td>';
                    if ($r['status'] == "Requested") {
                        echo '<td><a href="adminapprovebooking.php?id=' . $r['bookingid'] . '&status=approved&type=' . $r['bcid'] . '">Allocate</a>
                 / <a href="adminrejectbooking.php?id=' . $r['bookingid'] . '&status=rejected">Reject</a>';
                    } else
                        echo "<td></td>";
                }
            }
                else{
                    echo "<td colspan=10 class='text-dark' align='center'>No Discharges on this date...</td>";
                }
                    echo '</tr>';
                
        
    
    ?>
    </table>
    <?php
        }
    ?>
</div>