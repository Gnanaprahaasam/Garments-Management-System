<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

require_once('mysql_conn.php');
$sql ="SELECT * FROM salary";
$result = mysqli_query($conn,$sql);
while ($row1 =  mysqli_fetch_assoc($result))
{
	
}

?>

<html>
<head><title>Calculation For Total Salary</title></head>
<center>
 <h1>Salary Information</h1>
 <hr>
     <form>
	  <table>
<tr><th>Select Department: </th>
     <td><select name="month">
					<option>January</option>
					<option>February</option>
					<option>March</option>
					<option>April</option>
					<option>May</option>
					<option>June</option>
					<option>July</option>
					<option>August</option>
					<option>September</option>
					<option>October</option>
					<option>November</option>
					<option>December</option>
				</select>
    </td>
     </tr> 
	<tr><th> </th>
     <td>
<input type="submit" name="submit" value="Search" />
        </td>
     </tr>
	    </table>
     </form>
<br>

    </center>
</html>