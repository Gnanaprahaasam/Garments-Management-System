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
    $id = $_REQUEST["id"];
    $name = $_REQUEST["name"];
    $address = $_REQUEST["address"];
    $phone = $_REQUEST['phone'];
    $stock = $_REQUEST['stock'];
    $booking = $_REQUEST['order'];
    $date = $_REQUEST['date'];
    $status = $_REQUEST['status'];
    if($_REQUEST['choice']=="YES")
    {
        $sql="INSERT INTO `stock` (`id`,`name`, `address`, `phone`, `stock`, `order_date`, `date`,`status`)values('$id','$name','$address','$phone','$stock','$booking','$date','$status')";
        if(!mysqli_query($conn,$sql))
        {
            echo"error in '.$sql.'connection";
        }
        else
        {
            $msg="Given Data is Inserted successfully";
        }
    }
    else if($_REQUEST['choice']=="NO")
    {
        $errmsg="Given Data is invalid";
    }
}
?>

<html>
<head><title>Stock & Trade</title></head>
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
<h1>Stock & Trade information</h1>
<div style="text-align:right">
    <p><a href="home.php" class="home"><input  type="submit" name="submit" class ="home" value="home"></a>
    <a href="view_form.php" class="view"><input type="submit" name="submit" class="view" value="View Form"></a>
    <a href="view_stock.php" class="view"><input type="submit" name="submit" class="view" value="View-stock"></a>
	<a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
</div>
<hr>
<br><br>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    <table>
        <tr>
		    <th>Custormer ID:</th>
			<td><input type="text" name="id"></td>
		</tr>
		
		<tr>
		    <th>Custormer Name:</th>
			<td><input type="text" name="name"></td>
		</tr>
        <tr>
		    <th>Address:</th>
			<td><textarea rows='3' cols='30' name="address"></textarea>
			</td>
		</tr>
        <tr>
		    <th>Phone:</th>
			<td><input type="text" name="phone" ></td>
		</tr>
		<tr>
		    <th>Stock Requirements:</th>
			<td><select name="stock">
                    <option>Lower</option>
                    <option>Bottom</option>
                    <option>Top</option>
                    <option>shirt</option></select>
            </td>
		</tr>
		<tr>
        <?php $order= date("d, M -Y").'('.date("l").')'; ?>
            <th>Booking Date:</th>
			<td><input type="text"  name="order" value="<?php echo $order ?>"></td>
		</tr>
        <tr>
		    <th>Last date for Delivery:</th>
			<td><input type="date" name="date"></td>
		</tr>
        <tr>
		    <th>Delivery Status:</th>
			<td><select name="status">
                <option>Delivered</option>
                <option>Not-Delivered</option></select>
            </td>
		</tr>
        <tr>
            <th>order Confirmation:</th>
            <td><select name="choice">
                <option>YES</option>
                <option>No</option></select>
            </td>
        </tr>

		<tr>
		    <th>  </th>
			<td>
			<input type="submit" name="submit" value="Submit">
			
			</td>
		</tr>	
</table>
</from>
<br><br>
<hr>
<footer>
<p style="color:green"><?php echo $msg; ?></p>
<p style="color:red"><?php echo $errmsg; ?></p>
</footer>
    </center>
</html>

