<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}
require_once('mysql_conn.php');

$msg="";
$errmsg="";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$eid="";
	$setid="";
	$sname=$_REQUEST['sid'];             
	$sql ="SELECT * FROM stock";
	$result = mysqli_query($conn,$sql);	
	while($row1 = mysqli_fetch_array($result))
	{
		$id= $row1['id'];
		if($sname==$id)
		{
			$setid = $row1['id'];
			$setName = $row1['name'];
			$setAdrs = $row1['address'];
			$setPhn = $row1['phone'];			
			$setStock = $row1['stock'];
			$setOrder_date = $row1['order_date'];
			$setDate = $row1['date'];
			$setStatus = $row1['status'];
		}
		
	}
	
	$eid=$setid;
	if($sname==$eid)
	{
		$name = $_REQUEST['ename'];
		$id = ($_REQUEST['id']);             //mysqli_escape_string
		// && !preg_match('/^ *$/', $name)
		if($_REQUEST['doption'] == "Update Stock Info")
		{
			$name = $_REQUEST['ename'];
			$address = $_REQUEST['address'];
			$phone = $_REQUEST['phone'];
			$stock = $_REQUEST['stock'];
			$order = $_REQUEST['order_date'];
			$date = $_REQUEST['date'];
			$status=$_REQUEST['status'];					
			$id = ($_REQUEST['id']);   //mysqli_escape_string


			$query = mysqli_query($conn,"SELECT * FROM `stock` WHERE id='$id'");
			$nn = mysqli_num_rows($query);
			if($nn != 0)
			{
				$sql4 = "UPDATE `stock` SET `name`='$name',`phone`='$phone',`address`='$address',`stock`='$stock',`order_date`='$order',`date`='$date',`status`='$status',`id`='$id' WHERE id='$id'";
				if(!mysqli_query($conn,$sql4))
				{
					echo "Error in stock: " . $sql4. "<br>" . mysqli_error($conn);
				}
				else
				{
					$msg= 'Data Successfully Updated';
					$setid ="";
					$setName = "";
					$setAdrs = "";
					$setPhn = "";			
					$setStock = "";
					$setOrder_date = "";
					$setDate = "";
					$setStatus = "";
				}
			}
			/*else
				echo 'Employee ID already exist';*/

		}
		else if($_REQUEST['doption'] == "Remove Stock Info")
		{
			$usql= "DELETE FROM `stock` WHERE id='$id'";
				if(!mysqli_query($conn,$usql))
				{
					echo "Error: " . $usql . "<br>" . mysqli_error($conn);
				}
				else
				{
					$msg= "Successfully Deleted";
					$setid ="";
					$setName = "";
					$setAdrs = "";
					$setPhn = "";			
					$setStock = "";
					$setOrder_date = "";
					$setDate = "";
					$setStatus = "";
				}
				
		}

	}
	else
	{	
		$errmsg = "ID not found";
		$setid ="";
		$setName = "";
		$setAdrs = "";
		$setPhn = "";			
		$setStock = "";
		$setOrder_date = "";
		$setDate = "";
		$setStatus = "";
	}
}
else
{
	$setid ="";
	$setName = "";
	$setAdrs = "";
	$setPhn = "";			
	$setStock = "";
	$setOrder_date = "";
	$setDate = "";
	$setStatus = "";
}

?>


<html>
<head><title>stock&trade</title></head>
<style>
    body{
		background: none;
    	
	}
    table{
        height:70%;
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
<h1>Stock & Trade updated</h1>
<div style="text-align:right">
    <p><a href="home.php" class="home"><input  type="submit" name="submit" class ="home" value="home"></a>
    <a href="view_stock.php" class="view"><input type="submit" name="submit" class="view" value="View-stock"></a>
    <a href="stock&trade.php" class="stock"><input type="submit" name="submit" class="stock" value="Stock-Trade"></a>
	<a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
</div>
	<hr>
	<br>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
	<table>
		
		<tr>
		    <th>Order ID: </th>
			<td><input type="text" name="sid" value="<?php echo $_SESSION['update'] ?>"></td>
		</tr>
		<tr>
		    <th>  </th>
            <td><input type="submit" name="search" value="Search"></td>
		</tr>
		<tr>
		    <th>Customer Name: </th>
			<td><input type="text" name="ename" value="<?php echo $setName ?>">
			</td>
		</tr>
		<tr>
		    <th>Address: </th>
			<td><textarea rows='3' cols='30' name="address"><?php echo $setAdrs ?></textarea>
			</td>
		</tr>
		<tr>
		    <th>Phone: </th>
			<td><input type="text" name="phone" value="<?php echo $setPhn ?>">
			</td>
		</tr>
		<tr>
		    <th>Order Item: </th>
			<td><input type="text" name="stock" value="<?php echo $setStock ?>">
			</td>
		</tr>
		<tr>
		    <th>Order Date: </th>
			<td><input type="text" name="order_date" value="<?php echo $setOrder_date ?>">
			</td>
		</tr>
		<tr>
		    <th>Last date for Delivery: </th>
			<td><input type="date" name="date" value="<?php echo $setDate ?>">
			</td>
		</tr>
		<tr>
		    <th>Order ID<i>(unique key)</i>: </th>
			<td><input type="text" name="id" value="<?php echo $setid ?>">
			</td>
		</tr>
		
		<tr>
		    <th>Order status: </th>
			<td><input type="text"   name="status" value="<?php echo $setStatus ?>"disabled ></td>
			<td><select name="status">
					<option>Delivered</option>
					<option>Not-Delivered</option>
				</select>
			</td>
		</tr>
		<tr>
		    <th>Select an Option: </th>
			<td><select name="doption">
					<option>Update Stock Info</option>
					<option>Remove Stock Info</option>
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
<br>
<hr>
<footer>
<p style="color:green"><?php echo $msg; ?></p>
<p style="color:red"><?php echo $errmsg; ?></p>
</footer>
</center>
</html>