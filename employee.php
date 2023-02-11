<?php
session_start();
	if (!isset($_SESSION["employee"])) {
		header('Location: index.php');
		exit;
	}
require_once('mysql_conn.php');



$sql1 = "SELECT * FROM employee";
$result1 = mysqli_query($conn,$sql1);
while($row = mysqli_fetch_array($result1))
{
	$e_id= $row['e_id'];
	if($_SESSION["employee"] == $e_id)
	{
		$getEID = $row['e_id'];
		$getName = $row['name'];
		$getDept = $row['dept'];
		$getSal = $row['salary'];
		$getPhn = $row['phone'];
		$getGen = $row['gender'];
		$getDOB = $row['dob'];
		$getAdrs = $row['address'];
	}
	
}
$month = date("m");
$sql = "SELECT * FROM salary where `month`= '$month'";
$result = mysqli_query($conn,$sql);
$nn = mysqli_num_rows($result);
if($nn != 0)
{
	while($row1 = mysqli_fetch_array($result))
	{
		$e_id= $row1['e_id'];
		if($_SESSION["employee"] == $e_id)
		{
			$getPsal= $row1['p_salary'];
			$getAbs= $row1['absentDays'];
		
		}
	}
}
else
{
$getPsal= 0;
$getAbs= 0;
}
	
?>

<html>
<head><title>Employee Details</title></head>
<style>
    body{
		background: lightblue;
    	
	}
    table{
        height:60%;
        border-radius: 12px;
        border-style:groove;
        border-color:lightblue;
        background:lightgrey ;  /*#f5f5f5*/
		color: midnightblue;
        font-family: "Times New Roman",Serif;
        text-align: center;
		font-size: 16px;
    }
    footer{        
        font-family: "Georgia",Serif;	
    }
</style>
<center>
<h1>Employee Information</h1>
<hr>
<br><br>
<table border="1">
   <tr>
      <th>Your ID: </th>
	  <td>
	     <?php
		   echo $getEID;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Name: </th>
	  <td>
	     <?php
		   echo $getName;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Department: </th>
	  <td>
	     <?php
		   echo $getDept;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Phone: </th>
	  <td>
	     <?php
		   echo $getPhn;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Gender: </th>
	  <td>
	     <?php
		   echo $getGen;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Date-Of-Birth: </th>
	  <td>
	     <?php
		   echo $getDOB;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Address: </th>
	  <td>
	     <?php
		   echo $getAdrs;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Last Months Absence: </th>
	  <td><?php
		   echo $getAbs;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Your Monthly Salary: </th>
	  <td><?php
		   echo $getSal;
		 ?>
	  </td>
   </tr>
   <tr>
      <th>Payable Salary: </th>
	  <td><?php
		   echo $getPsal;
		 ?>
	  </td>
   </tr>

</table>
<br><br>
<hr>
<footer>
	<!--<a href="print.php"><h3>Print Your Info</h3></a>-->
	<a href="logout.php"><h2>Logout</h2></a>
</footer>
</center>

</html>