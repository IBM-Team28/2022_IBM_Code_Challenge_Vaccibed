<?php
session_start(); //to start the session
include "../connection.php";
include "adminbase.php";
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

    .txtBox {
        height: 45px;
    }

    #txtAdrs {
        height: 70px;
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
</style>
<div id="log">
    <form method="POST">
        <h3 style="margin:10px 30px 30px 0px; color:#ebd231; font-weight: 600;">Add Category</h3>
        <table style="width:900px;">
            <tr>
                <td>Bed Type</td>
                <td><input type="text" class="form-control txtBox" pattern="[a-zA-Z ]+" name="txtName" required=""></td>

                <td>&nbsp;&nbsp;&nbsp;&nbsp;Description</td>
                <td><textarea class="form-control txtBox" id="txtAdrs" name="txtDesc" required=""></textarea></td>
            </tr>
            <tr>
                <!-- <td colspan="2"></td>

				<td></td> -->
                <td colspan="4" class="text-center"><input type="submit" style="width:300px;margin-top:20px" class="btn btn-warning" name="btnSubmit" required=""></td>
            </tr>
        </table>
    </form>
    <table id="tbl" border="1">
		<tr>
			<th>NAME</th>
			<th>DESCRIPTION</th>
			<th colspan="2">Action</th>
		</tr>
		<?php
		$q = "SELECT * FROM  `bedcategory`";
		$s = mysqli_query($conn, $q);
		while ($r = mysqli_fetch_array($s)) {
			echo '<tr>
		    	<td>' . $r['category'] . '</td>
		    	<td>' . $r['description'] . '</td>
		    	<td><a href="adminbedupdate?id=' . $r['bcid'] . '">Update</a></td>
		    	</tr>';
		}
		?>
	</table>
</div>
<?php

if (isset($_REQUEST['btnSubmit'])) {
    $name = $_REQUEST['txtName'];
    $desc = $_REQUEST['txtDesc'];

    $q = "INSERT INTO `bedcategory` (`category`,`description`) VALUES ('$name','$desc')";
    echo $q;
    $s = mysqli_query($conn, $q);
    if ($s) {
        echo '<script>alert("Category Added...")</script>';
        echo '<script>location.href="adminaddbedtypes.php"</script>';
    } else {
        echo '<script>alert("Sorry some error occured")</script>';
    }
}
?>