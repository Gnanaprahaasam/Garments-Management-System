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
		$dname = $_REQUEST['dname'];
		$dtype = $_REQUEST['dtype'];
		if($_REQUEST['doption'] == "Update Department")
		{
			$verify = "";
			while ($search =  mysqli_fetch_array($result))
			{
				$sdept = $search['dept_name'];
				if($sdept==$dname)
				{
					$verify="found";
				}
			}
			if($verify != "found" && !preg_match('/^ *$/', $dname))
			{
				$usql= "UPDATE `department` SET `dept_name`='$dname' WHERE dept_name='$dtype'";
				if(!mysqli_query($conn,$usql))
				{
					echo "Error in login: " . $usql . "<br>" . mysql_error($conn);
				}
				$usql1= "UPDATE `employee` SET `dept`='$dname' WHERE dept='$dtype'";
                	if(!mysqli_query($conn,$usql1))
				{
					echo "Error in login: " . $usql1 . "<br>" . mysqli_error($conn);
				}
				else{
					$msg= "Successfully Department Updated";
				}
			}
			else
			{
				$msg1= "Inavlid input or Department already exist";
			}
		}
		else if($_REQUEST['doption'] == "Remove Department")
		{
			$usql= "DELETE FROM `department` WHERE dept_name='$dtype'";
			if(!mysqi_query($conn,$usql))
			{
				echo "Error in login: " . $usql . "<br>" . mysqli_error($conn);
			}
			else{
				$msg= "Successfully Department Deleted";
			}
		}

	
	}
?>

<html>
<head><title>For Modifying & Removing Dept.</title></head>
<style>
    body{
		background: none;
    	
	}
    table{
        height:40%;
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
<h1>Modify/Remove Dept. Info</h1>
<br>
<div style="text-align:right">
    <p><a href="view_form.php" class="view"><input type="submit" name="submit" class="view" value="View Form"></a>
	<a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
</div>
<hr>
<br><br><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
  <table>
   <tr>
      <th>Select Department: </th>
	  <td><select name="dtype">
			<?php
				 while ($row =  mysqli_fetch_assoc($result)) {
            echo '<option value="'.$row['dept_name'].'">'.$row['dept_name'].'</option>';
			}?>
			</select>
	  </td>
   </tr>
   <tr>
      <th>Department Name: </th>
	  <td><input type="text" name="dname"></td>
   </tr>
    <tr>
      <th>Select an Option: </th>
	  <td><select name="doption">
					<option>Update Department</option>
					<option>Remove Department</option>
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
</form>
<br><br><br>
<hr>
<footer>
	<p style="color:green"><?php echo $msg; ?></p>
	 <p style="color:red"><?php echo $msg1; ?></p>
</footer>
    </center>
</html>