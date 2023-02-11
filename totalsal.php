<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

	
?>

<html>
<head><title>Total Salary Info.</title></head>
<style>
    body{
		background: none;
    	
	}
    table{
		width:15%;
        height:15%;
        border-radius: 12px;
        border-style:groove;
        border-color:lightblue;
        background:lightblue ;  /*#f5f5f5*/
		color: midnightblue;
        font-family: "Times New Roman",Serif;
        text-align: center;
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
 <div style="text-align:right">
    <p><a href="home.php" class="home"><input  type="submit" name="submit" class ="home" value="home"></a>
    <a href="attendence.php" class="attendance"><input type="submit" name="submit" class="attendance" value="Attendence"></a>
    <a href="salary.php" class="salary"><input type="submit" name="submit" class="salary" value="Salary"></a>
    <a href="View_stock.php" class="stock"><input type="submit" name="submit" class="stock" value="Stock & Trade"></a>
    <a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
</div>
 <hr>
 <br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    <table>
	<tr>
    <th>Select Month: </th>
	<td>		
    <select name="month">
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
    <tr>
        <th> </th>
        <td><input type="submit" name="submit" value="Search" />
        </td>
    </tr>
	  </table>
</form>
    
    </center>
</html>
<?php 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$month = $_REQUEST['month'];	
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
	require_once('mysql_conn.php');
	$sql ="SELECT * FROM salary where month = '$monthNO'";
	$result = mysqli_query($conn,$sql);
	$total=0;
	while ($row =  mysqli_fetch_array($result))
	{
		$sal= $row['p_salary'];
		$total = $total + $sal;
	}
	echo "<html><center>";
	echo '<h2>'.'Total Playable Salary: '.$total.' Tk'.'</h2>'."<br><br>";
	echo '<hr>';
	echo "</center></html>";
}


?>