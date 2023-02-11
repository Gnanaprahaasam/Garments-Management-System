<?php
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}
require_once('mysql_conn.php');

$sql ="SELECT * FROM department";
$result = mysqli_query($conn,$sql);

$msg="";
$msg1="";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$dept = $_REQUEST['dtype'];
	$name = $_REQUEST['name'];
	$date = $_REQUEST['date'];
	$gender = $_REQUEST['gender'];
	$phone = $_REQUEST['phone'];
	$address = $_REQUEST['address'];
	$eid = ($_REQUEST['eid']);         //  mysqli_escape_string //mysqli_escape_string
	$password = ($_REQUEST['pass']);
	$sal = $_REQUEST['sal'];
	

	$query = mysqli_query($conn,"SELECT * FROM `employee` WHERE e_id='$eid'");
	$nn = mysqli_num_rows($query);
	if($nn == 0 && !preg_match('/^ *$/', $name))
	{
		$sql1 ="INSERT INTO `login` (uname, pass, acctype) 
		VALUES ('$eid', '$password', 'Employee')";
		if(!mysqli_query($conn,$sql1))
			{
				echo "Error in login: " . $sql1. "<br>" . mysqli_error($conn);
			}
		
		$sql = "INSERT INTO `employee`(`e_id`, `name`, `dept`, `salary`, `phone`, `gender`, `dob`, `address`) 
		VALUES ('$eid','$name','$dept','$sal','$phone','$gender','$date','$address')";
		if(!mysqli_query($conn,$sql))
			{
				echo "Error in employee: " . $sql . "<br>" . mysqli_error($conn);
			}			
		else
			$msg= 'Employee Successfully Inserted';
	}
	else
		$msg1= 'Invalid input or Employee ID already exist';
}
?>

<html>
<head><title>Adding New Employee</title></head>
<style>
    body{
		background: none;
    	
	}
    table{
        height:60%;
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
<div style="text-align:right">
    <p><a href="home.php" class="home"><input  type="submit" name="submit" class ="home" value="home"></a>
    <a href="view_form.php" class="view"><input type="submit" name="submit" class="view" value="View Form"></a>    
    <a href="add_department.php" class="dept"><input type="submit" name="submit" class="dept" value="Add-Department"></a>    
    <a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
    
</div>
<center>
<h1>New Employee Details</h1>
<hr>
<br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
  <table>
    <tr>
	   <th>Select Department: </th>
	   <td><select name="dtype">
			<?php
				while ($row =  mysqli_fetch_assoc($result))
				{
					echo '<option value="'.$row['dept_name'].'">'.$row['dept_name'].'</option>';
				}
			?>
			</select>
		</td>
	</tr>

    <tr>
	   <th>Name: </th>
	   <td><input type="text" name="name"></td>
	</tr>
	<tr>
	   <th>Gender: </th>
	   <td><select name="gender">
					<option>Male</option>
					<option>Female</option>
				</select>
		</td>
	</tr>
	<tr>
	    <th>Date of Birth: </th>
		<td><input type="date" name="date"></td>
	</tr>
	<tr>
	    <th>Phone: </th>
		<td><input type="text" name="phone"></td>
	</tr>
	<tr>
	    <th>Address: </th>
		<td><textarea rows='3' cols='30' name="address"></textarea></td>
	</tr>
	<tr>
	    <th>Monthly Salary: </th>
		<td><input type="text" name="sal"></td>
	</tr>
	<tr>
	    <th>Employee ID: </th>
		<td><input type="text" name="eid"></td>
	</tr>
	<tr>
	    <th>Password: </th>
		<td><input type="text" name="pass"></td>
	</tr>
	<tr>
	    <th>  </th>
		<td><input type="submit" name="submit" value="Submit"></td>
	</tr>
  </table>
</form>
<br><br>
<hr>
<footer>
<p style="color:green"><?php echo $msg; ?></p>
<p style="color:red"><?php echo $msg1; ?></p>
</footer>
</center>
</html>
