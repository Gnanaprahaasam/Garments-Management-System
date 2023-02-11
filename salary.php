<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

require_once('mysql_conn.php');
$sql ="SELECT * FROM employee";
$result = mysqli_query($conn,$sql);
$sql1 ="SELECT * FROM department";
$result1 = mysqli_query($conn,$sql1);
?>

<html>
<head><title>Information of Salary</title></head>
<style>
    body{
		background: none;
    	
	}
    table{
        height:30%;
        border-radius: 12px;
        border-style:groove;
        border-color:lightblue;
        background:lightblue ;  /*#f5f5f5*/
		color: midnightblue;
        font-family: "Times New Roman",Serif;
        text-align: left;
		font-size: 16px;
    }
	
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
    <a href="attendence.php" class="attendance"><input type="submit" name="submit" class="attendance" value="Attendence"></a>
    <a href="totalsal.php" class="tsalary"><input type="submit" name="submit" class="tsalary" value="Total-salary"></a>
    <a href="View_stock.php" class="stock"><input type="submit" name="submit" class="stock" value="Stock & Trade"></a>
    <a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
    
</div><br>
     <hr>
     <br><br><br>
<form action="salary1.php" method="POST">
  <table>
    <tr>
    <th>Select Department: </th> 
    <td><select name="dtype">
				<?php
				while ($row1 =  mysqli_fetch_assoc($result1)) 
				{
					echo '<option value="'.$row1['dept_name'].'">'.$row1['dept_name'].'</option>';
				}
				?>
			</select>
			</td>
	</tr>
	<tr>
	<th>Select Month: </th>
	<td><select name="month">
					<option>January</option>
					<option>February</option>
					<option selected>March</option>
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
<tr>
    <th> </th>
    <td><input type="submit" name="submit" value="Search" /></td>
</tr>
  </table>
</form>
<br><br><br>
<hr>
<footer>
	
</footer>
</center>
</html>