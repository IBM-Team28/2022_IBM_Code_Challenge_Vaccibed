<?php
session_start(); //to start the session
include '../connection.php';
include "hospitalbase.php";
$hid = $_SESSION['id'];
$qryBed = "SELECT * FROM `bedcategory` bc, `beddetails` bd WHERE bd.`hospital_id`=$hid AND bd.`bcid`=bc.`bcid`";
$resBed = mysqli_query($conn, $qryBed);
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

    option {
        color: #000;
    }

    select {
        width: 100%;
        padding: 7px;
        border-radius: 3px;
        color:black;
        border: none;
    }
</style>
<div id="log">
    <form method="POST">
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Patient Registration</h3>
        <table style="width:900px;">
            <tr>
                <td>Name</td>
                <td><input type="text" class="form-control" pattern="[a-zA-Z ]+" name="txtName" required=""></td>

                <td>&nbsp;&nbsp;&nbsp;&nbsp;House name</td>
                <td><input type="text" class="form-control" pattern="[a-zA-Z ]+" name="txtHouse" required=""></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Place</td>
                <td><input type="text" class="form-control" pattern="[a-zA-Z ]+" name="txtPlace" required=""></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Pin</td>
                <td><input type="text" class="form-control" pattern="[6][0-9]{5}" maxlength="6" name="txtPin" required=""></td>

            </tr>
            <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
			<td>Age</td>
				<td><input type="number" class="form-control"   name="txtAge" required=""></td>
</tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>

                <td>Aadhar</td>
                <td><input type="text" class="form-control" name="txtAadhar" pattern="[1-9][0-9]{11}" maxlength="12" required=""></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;Contact</td>
                <td><input type="text" class="form-control" pattern="[6789][0-9]{9}" name="txtContact" required=""></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;Gender</td>
				<td class="text-center"><input type="radio" class="form-control" value="male" name="txtGend">Male
					<input type="radio" class="form-control" value="female" name="txtGend">Female
				</td>
				<td>Local Body</td>
				<td><input type="text" class="form-control" pattern="[a-zA-Z ]+" name="txtBody" required=""></td>
			</tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" class="form-control" name="txtEmail" required=""></td>

                <td>&nbsp;&nbsp;&nbsp;&nbsp;Bed Type</td>
                <td><select name="bed" id="">
                        <option value="Select">Select Bed Type</option>
                        <?php
                        while ($row = mysqli_fetch_array($resBed)) {
                            if($row['bAvailable']>0)
                            {
                            echo "<option value='$row[bcid]'>$row[category]</option>";
                            }
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>

                <td colspan="4" class="text-center"><input type="submit" style="width:300px;" class="btn btn-warning" name="btnSubmit" required=""></td>
            </tr>
        </table>
    </form>
</div>
<?php

if (isset($_REQUEST['btnSubmit'])) {
    $name = $_REQUEST['txtName'];
    $house = $_REQUEST['txtHouse'];
    $place = $_REQUEST['txtPlace'];
    $pin = $_REQUEST['txtPin'];
    $contact = $_REQUEST['txtContact'];
    $aadhar = $_REQUEST['txtAadhar'];
    $email = $_REQUEST['txtEmail'];
    $gender = $_REQUEST['txtGend'];
	$lbody=$_REQUEST['txtBody'];
    $age=$_REQUEST['txtAge'];
    $bed = $_REQUEST['bed'];
    $date = date("Y-m-d");
    $q = "select count(*) from login where user_name='$email'";
    $s = mysqli_query($conn, $q);
    $r = mysqli_fetch_array($s);
    if ($r[0] > 0)    //to check whether the username exist
    {
        echo '<script>alert("Email already registered")</script>';
        echo '<script>location.href="index.php"</script>';
    } else {
        $q = "insert into patients (name,housename,adrs,id_proof,pin,email,phone,gender,lbody,age) values('$name','$house','$place','$aadhar','$pin','$email','$contact','$gender','$lbody',$age)";
        $s = mysqli_query($conn, $q);
        $qry = "INSERT INTO `bedrequest` (`bcid`,`pid`,`hid`,`bookingdate`,`status`) VALUES ('$bed',(SELECT max(pat_id) from patients),'$hid','$date','Admitted')";
        $ss = mysqli_query($conn, $qry);
        if ($s && $ss) {
            $bedCount = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `beddetails` WHERE `hospital_id`='$hid' AND `bcid`='$bed'"));
            $count = $bedCount['bAvailable'];
            $bid = $bedCount['bid'];
            $newCount = $count - 1;
            $update = "UPDATE `beddetails` SET `bAvailable`='$newCount' WHERE `bid`='$bid'";
            if (mysqli_query($conn, $update)) {
                echo '<script>alert("Registration successful.")</script>';
            }
        } else {
            echo '<script>alert("Sorry some error occured")</script>';
            // echo '<script>location.href="index.php"</script>';
            echo $q;
        }
    }
}
?>