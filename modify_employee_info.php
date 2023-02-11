<?php

session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: index.php');
    exit;
}

require_once('mysql_conn.php');
$sql1 = "SELECT * FROM department";
$result1 = mysqli_query($conn,$sql1);
$sql2 = "SELECT * FROM login";
$result2 = mysqli_query($conn,$sql2);
$msg="";
$errmsg="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$id="";
	$setEID="";
	$sql ="SELECT * FROM employee";
	$result = mysqli_query($conn,$sql);
	$sname=$_REQUEST['sname'];             //mysqli_escape_string
	while($row = mysqli_fetch_array($result))
	{
		$e_id = $row['e_id'];
		if($sname == $e_id)
		{
			$setName = $row['name'];
			$setDept = $row['dept'];
			$setSal = $row['salary'];
			$setGen = $row['gender'];
			$setDOB = $row['dob'];
			$setPhn = $row['phone'];
			$setAdrs = $row['address'];
			$setEID = $row['e_id'];
			while($row2 = mysqli_fetch_array($result2))
			{
				$e_id2= $row2['uname'];
				if($sname == $e_id2)
				{
					$setPass = $row2['pass'];
				}
			}
		}
		
	}
	
	$id=$setEID;
	if($sname==$id)
	{	$name = $_REQUEST['ename'];
		$eid = $_REQUEST['eid'];             //mysqli_escape_string
		// && !preg_match('/^ *$/', $name)
		if($_REQUEST['doption'] == "Update Employee Info")
		{
			$dept = $_REQUEST['dtype'];
			$sal = $_REQUEST['sal'];
			$name = $_REQUEST['ename'];
			$date = $_REQUEST['date'];
			$gender = $_REQUEST['gname'];
			$phone = $_REQUEST['phone'];
			$address = $_REQUEST['address'];		
			$password = ($_REQUEST['pass']);   //mysqli_escape_string


			$query = mysqli_query($conn,"SELECT * FROM `employee` WHERE e_id='$eid'");
			$nn = mysqli_num_rows($query);
			if($nn != 0)
			{
				$sql4 = "UPDATE `employee` SET `name`='$name',`dept`='$dept',`salary`='$sal',`phone`='$phone',`gender`='$gender',`dob`='$date',`address`='$address',`e_id`='$eid' WHERE e_id='$eid'";
				if(!mysqli_query($conn,$sql4))
					{
						echo "Error in employee: " . $sql4. "<br>" . mysqli_error($conn);
					}


				$sql3 ="UPDATE `login` SET `uname`='$eid',`pass`='$password',`acctype`='Employee' WHERE uname='$eid'";
				if(!mysqli_query($conn,$sql3))
					{
						echo "Error in login: " . $sql3 . "<br>" . mysqli_error($conn);
					}
				else
				{
					$msg= 'Data Successfully Updated';
					$setName="";
					$setDept ="";
					$setSal = "";
					$setGen = "";
					$setDOB = "";
					$setPhn = "";
					$setAdrs = "";
					$setEID = "";
					$setPass ="";
				}
			}
			/*else
				echo 'Employee ID already exist';*/

		}
		else if($_REQUEST['doption'] == "Remove Employee Info")
		{
			$usql= "DELETE FROM `salary` WHERE e_id='$eid'";
				if(!mysqli_query($conn,$usql))
				{
					echo "Error: " . $usql . "<br>" . mysqli_error($conn);
				}
			$usql= "DELETE FROM `attendance` WHERE e_id='$eid'";
				if(!mysqli_query($conn,$usql))
				{
					echo "Error: " . $usql . "<br>" . mysqli_error($conn);
				}
			$usql= "DELETE FROM `employee` WHERE e_id='$eid'";
				if(!mysqli_query($conn,$usql))
				{
					echo "Error: " . $usql . "<br>" . mysqli_error($conn);
				}	
			$usql= "DELETE FROM `login` WHERE uname='$eid'";
				if(!mysqli_query($conn,$usql))
				{
					echo "Error: " . $usql . "<br>" . mysqli_error($conn);
				}
				else
				{
					$msg= "Successfully Deleted";
					$setName="";
					$setDept ="";
					$setSal = "";
					$setGen = "";
					$setDOB = "";
					$setPhn = "";
					$setAdrs = "";
					$setEID = "";
					$setPass ="";
				}
				
		}

	}
	else
	{	
		$errmsg = "ID not found";
		$setName="";
		$setDept ="";
		$setSal ="";
		$setGen = "";
		$setDOB = "";
		$setPhn = "";
		$setAdrs = "";
		$setEID = "";
		$setPass ="";
	}
}
else
{
	$setName="";
	$setDept ="";
	$setSal ="";
	$setGen = "";
	$setDOB = "";
	$setPhn = "";
	$setAdrs = "";
	$setEID = "";
	$setPass ="";
}

?>

<html>
<head><title>For Modifying Employee.</title></head>
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
    <center>
<h1>Modify/Remove Employee Info</h1>

<div style="text-align:right">
    <p><a href="view_form.php" class="view"><input type="submit" name="submit" class="view" value="View Form"></a>
	<a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
</div>
<hr>
<br><br>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
     <table>
		
		<tr>
		    <th>Search Employee: </th>
			<td><input type="text" name="sname" value="<?php echo $_SESSION['ref']?>"></td>
		</tr>
		<tr>
		    <th>  </th>
            <td><input type="submit" name="search" value="Search"></td>
		</tr>
		<tr>
		    <th>Name: </th>
			<td><input type="text" name="ename" value="<?php echo $setName ?>">
			</td>
		</tr>
		<tr>
		    <th>Current Department: </th>
			<td><input type="text" name="dname" value="<?php echo $setDept ?>" disabled>
			</td>
		</tr>
		<tr>
		    <th>Change Department: </th>
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
		    <th>Gender: </th>
			<td><input type="text" name="gname" value="<?php echo $setGen ?>">
			</td>
		</tr>
		<tr>
		    <th>Date of Birth: </th>
			<td><input type="date" name="date" value="<?php echo $setDOB ?>">
			</td>
		</tr>
		<tr>
		    <th>Phone: </th>
			<td><input type="text" name="phone" value="<?php echo $setPhn ?>">
			</td>
		</tr>
		<tr>
		    <th>Address: </th>
			<td><textarea rows='3' cols='30' name="address"><?php echo $setAdrs ?></textarea>
			</td>
		</tr>
		<tr>
		    <th>Monthly Salary: </th>
			<td><input type="text" name="sal" value="<?php echo $setSal ?>">
			</td>
		</tr>
		<tr>
		    <th>Employee ID:<br><i>(unique key)</i> </th>
			<td><input type="text" name="eid" value="<?php echo $setEID ?>">
			</td>
		</tr>
		<tr>
		    <th>Password: </th>
			<td><input type="text" name="pass" value="<?php echo $setPass ?>">
			</td>
		</tr>
		<tr>
		    <th>Select an Option: </th>
			<td><select name="doption">
					<option>Update Employee Info</option>
					<option>Remove Employee Info</option>
				</select>
			</td>
		</tr>
		<tr>
		    <th>  </th>
			<td>
			<input type="submit" name="submit" value="Submit">
			
			</td>
		</tr>	
</table>
</form>	<br><br>
<hr>
<footer>
	<p style="color:green"><?php echo $msg; ?></p>
	<p style="color:red"><?php echo $errmsg; ?></p>
</footer>
    </center>
</html>