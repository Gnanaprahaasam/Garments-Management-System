<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

require_once('mysql_conn.php');

if($_SERVER["REQUEST_METHOD"] == "GET")
{	
	$dept = $_GET['dtype'];
	$sql ="SELECT * FROM employee where dept='$dept'";
	$result = mysqli_query($conn,$sql);
	$select = 1;
			
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{	
	$date = date("d/m/Y");
	
	foreach ($_REQUEST['attend'] as $pvalue) {
		$value = strip_tags($pvalue, '</td>');	
		$sqlinsert = "INSERT INTO `attendance` (`e_id`, `attend_date`, `attend`) VALUES ('$value', '$date', '1')";
		if(!mysqli_query($conn,$sqlinsert))
			{
				echo "Error: " . $sqlinsert . "<br>" . mysqli_error($conn);
			}
		}
	$select = 0;		
}


?>



<html>
<head><title>Attendance Taking</title></head>
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
	}
    footer{        
        font-family: "Georgia",Serif;	
    }
</style>
<br>
<div style="text-align:right">
    <p><a href="home.php" class="home"><input  type="submit" name="submit" class ="home" value="home"></a>
    <a href="view_form.php" class="view"><input type="submit" name="submit" class="view" value="View Form"></a>
    <a href="attendence.php" class="att"><input type="submit" name="submit" class="att" value="Attendence"></a>   
    <a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
    
</div>
<br>
<center>
    <h1>Daily Attendance</h1>
<h3>Today is: <?php
    echo date("d, M -Y").'('.date("l").')';
			   ?></h3>
<hr> 
<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

<table border="1" style="width:50%">
	
  <?php
	if($select == 1)
	{
		echo "<tr style='background:lightgrey'>\n"; 
echo "<td><b>User ID</b></td>\n"; 
echo "<td><b>Name</b></td>\n"; 
echo "<td><b>Department</b></td>\n"; 
echo "<td><b>Date</b></td>\n"; 
echo "<td><b>Attendence</b></td>\n"; 
echo "</tr>\n";
		while($row = mysqli_fetch_array($result))
		{
			echo "<tr>";
			echo "<td>".$setID = $row['e_id']."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['dept']."</td>";
			echo "<td>".date("d/m/Y")."</td>";
			echo '<td><input type="checkbox" name="attend[]" value="'.  $setID .'" checked>'.'</td>';
			echo "</tr>";
		}
	echo "</table><br> \n"; 
	echo "<input type=\"submit\" name=\"submit\" value=\"Submit\" />\n";
	}
	else
		echo '<h2>DONE</h2>'.'<br>';
  ?>
</table>
</form>
<br><br>
<hr>
<footer>
	
</footer>
</center>
</html>

