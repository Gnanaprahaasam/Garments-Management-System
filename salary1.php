<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

require_once('mysql_conn.php');
$dept = $_REQUEST['dtype'];
$sql ="SELECT * FROM employee where dept='$dept'";
$result = mysqli_query($conn,$sql);
$month = $_REQUEST['month'];
$monthNO;
switch ($month)
{
	case 'January': $monthNO = '01';
	break;
	case 'February': $monthNO = '02';
	break;
	case 'March': $monthNO = '03';
	break;
	case 'April': $monthNO = '04';
	break;
	case 'May': $monthNO = '05';
	break;
	case 'June': $monthNO = '06';
	break;
	case 'July': $monthNO = '07';
	break;
	case 'August': $monthNO = '08';
	break;
	case 'September': $monthNO = '09';
	break;
	case 'October': $monthNO = '10';
	break;
	case 'November': $monthNO = '11';
	break;
	case 'December': $monthNO = '12';
	break;
	
}

?>


<html>
<head><title>Salary Calculation</title></head>
<style>
    body{
		background: none;
    	
	}
	table{
        background:transparent;
        width: 80%;
        height:20%;
        border-radius: 12px;
        border-collapse: collapse;        
		color: midnightblue;
        font-family: "Times New Roman",Serif;
        text-align: center;
		font-size: 16px;
    }
    th, td {
        
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #DDD;
    }

    tr:hover {background-color: #D6EEEE;}    
	
	input[type='submit'] {
        background-color:#0097a7 ;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
    input[type='submit']:hover {
        background-color: lightblue; 
        color: white;
    }
    footer{        
        font-family: "Georgia",Serif;	
    }
</style>

<center>
<h1>Salary Information</h1>
<br>
<div style="text-align:right">
    <p><a href="home.php" class="home"><input  type="submit" name="submit" class ="home" value="home"></a>
    <a href="view_form.php" class="view"><input type="submit" name="submit" class="view" value="View Form"></a>    
    <a href="totalsal.php" class="tsalary"><input type="submit" name="submit" class="tsalary" value="Total-salary"></a>
    <a href="salary.php" class="salary"><input type="submit" name="submit" class="salary" value="Salary"></a>
    <a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
    
</div><br>
<hr>
<br><br>
<table border="1" style="width:50%">
	<tr style="background:lightgrey">
		<td><b>User ID</b></td>
		<td><b>Name</b></td>
		<td><b>Department</b></td>
		<td><b>Salary</b></td>
		<td><b>Absent Days</b></td>
		<td><b>Payable salary</b></td>
	
	</tr>
    <?php
	
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			$var = $row['e_id'];
			echo "<td>".$var."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['dept']."</td>";
			
			$sql2 ="SELECT * FROM `attendance` WHERE e_id='$var' AND attend_date LIKE '%$monthNO%'";	
			$result2 = mysqli_query($conn,$sql2);
			$attend = mysqli_num_rows($result2);
			$sql3 ="SELECT salary FROM `employee` WHERE e_id='$var'";
			$result3 = mysqli_query($conn,$sql3);
			$salary=  mysqli_fetch_array($result3);
			$sal = $salary['salary'];
			$pSalary = ($sal/30)*$attend;
			$abs = 30-$attend;
			echo "<td>".$sal."</td>";
			echo "<td>".$abs."</td>";
			echo "<td>".$pSalary."</td>";
			echo "</tr>";

			$sqlinsert = "INSERT INTO `salary`(`e_id`, `month`, `salary`, `p_salary`, `absentDays`) VALUES ('$var','$monthNO','$sal','$pSalary','$abs')";
			if(!mysqli_query($conn,$sqlinsert))
			{
				echo "Error: " . $sqlinsert . "<br>" . mysqli_error($conn);
			}
		}
	echo "</table> \n"; 
	
    ?>
</table>
<br><br>
<hr>
<footer>
	
</footer>
</center>
</html>