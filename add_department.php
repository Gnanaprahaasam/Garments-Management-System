<?php
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}

require_once('mysql_conn.php');
$msg = "";
$msg1 = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$dname= $_POST['dname'];
	$sql ="SELECT * FROM department";
	$result = mysqli_query($conn,$sql);
	$verify = "";
	while ($row =  mysqli_fetch_array($result))
	{
		$sdept = $row['dept_name'];
		if($sdept==$dname)
		{
			$verify="found";
		}
	}
	//echo preg_match('/^ *$/', $dname);
	if($verify != "found" && !preg_match('/^ *$/', $dname))
	{
		$sql1 ="INSERT INTO `department` (dept_name) 
		VALUES ('$dname')";
		if(!mysqli_query($conn,$sql1))
			{
				echo "Error in login: " . $sql1 . "<br>" . mysqli_error($conn);
			}
		else
			$msg= 'Department Added';
	}
	
	
	else
		$msg1='Invalid input or Department already exist';
}
?>

<html>
<head><title>For Adding Department</title></head>
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
<br>
<div style="text-align:right">
    <p><a href="home.php" class="home"><input  type="submit" name="submit" class ="home" value="home"></a>
    <a href="view_form.php" class="view"><input type="submit" name="submit" class="view" value="View Form"></a>
    <a href="add_employee.php" class="emp"><input type="submit" name="submit" class="emp" value="Add-Employee"></a>
    <a href="modify_dept_info.php" class="emp"><input type="submit" name="submit" class="emp" value="modify-dept-info"></a>
    <a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
    
</div>
<br><br>
<center>
	<h1> Add New Department</h1>
	<hr>
	<br><br><br>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    <table>
		<tr>
		   <th>Department Name: </th>
		   <td><input type="text" name="dname"></td>
		</tr>
		<tr>
		   <th>  </th>
		   <td>
			   <input type="submit" name="submit" value="AddDept.">
			   
			</td>
		</tr>
    </table>
 </form>
 <br><br><br>
 <hr>
<footer>
<p style="color:green"><?php echo $msg; ?></p>
<p style="color:red"><?php echo $msg1; ?></p>
</footer>
</center>
</html>