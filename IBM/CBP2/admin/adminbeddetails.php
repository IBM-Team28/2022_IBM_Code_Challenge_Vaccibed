<?php
session_start(); //to start the session
include "../connection.php";
include "adminbase.php";
$email = $_SESSION['email'];

$qry = "SELECT hospital.*,login.status FROM hospital,login WHERE hospital.email=login.user_name AND (login.status='1' OR login.status='0')";
$res = mysqli_query($conn, $qry);
?>

<style type="text/css">
	#log {
		background-color: rgba(0, 150, 220, 0.5);
		margin: 10px 300px;
		padding: 20px;
		color: white;
		width: 40%;
		float: left;
	}

	a:hover {
		background-color: white;
		text-decoration: none;
	}
	#tb{
		background-color:#ebd231;
		
	}
</style>
<div id="log">
	<form method="POST">
		<h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">BED DETAILS</h3>
		<table style="margin: auto;">
			<tr>
				<td><select class="form-control" name="sel" id="txtName">
                    <option>Select</option>
                    <?php 
                    while($row=mysqli_fetch_array($res))
                    {
                        ?>
                        <option value=<?php echo $row['hospital_id'] ?>><?php echo $row['name'];?></option>
                        <?php
                    }
                    ?>
                </select>
                </td>
				&nbsp
				&nbsp
                <td>

                    <input type=submit name=srch value=SEARCH style="color:black;">
                </td>
                </tr>
		</table>
	</form>
	<br><br>
	<?php
	if(isset($_REQUEST['srch']))
	{
		$a=$_REQUEST['sel'];
		$sh="SELECT * FROM hospital where hospital_id='$a'";
		$ir=mysqli_query($conn,$sh);
		$in=mysqli_fetch_array($ir);
		?>
		<div id="tb">
		<center>
		<table>
			<tr><td>
		<h2><?php echo $in['name'];?></h2></td></tr>
		<tr><td><h3><?php echo $in['place']; ?></h3></td></tr>
		<?php
		#echo $a;
		$l="SELECT * FROM bedcategory bc,beddetails bd where bc.bcid=bd.bcid and bd.hospital_id='$a'";
		$m=mysqli_query($conn,$l);

		while($n=mysqli_fetch_array($m)){
		
		?>
		
           
			
			<tr><td><?php echo $n['category'];?><td><?php echo $n['bAvailable'];?></td>
			<?php
		   }
		   
	}

	?>
	</table>
</center>
</div>
</div>