<?php
session_start();
require('mysql_conn.php');
$err = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST['uname'];
	$password = $_POST['pass'];
	$sql = "SELECT * FROM login";
	$result = mysqli_query($conn,$sql);		 
	while($row = mysqli_fetch_array($result))
	{
				
		if($row['uname'] == $username && $row['pass'] == $password && $row['acctype'] == "Manager")
		{
			//echo 'success in manager';
			$_SESSION["manager"] = $username;
			header('Location: home.php');
			exit;
		}
		else if($row['uname'] == $username && $row['pass'] == $password && $row['acctype'] == "Employee")
		{
			$_SESSION["employee"] = $username;
			header("Location: employee.php");
			exit;
			
		}
		else
		{
			$err = 'Invalid ID or Pass';
		}
	}
}
?>


<html>
<head><title>Login Page</title></head>
<center>
<h1>Login Page</h1>

<style>
	body{
		background-image: url("textile.jpg");
    	background-size: cover;
	}
	.box{
		background: #f5f5f5;
		color: midnightblue;
		top: 30%;
		left: 40%;
		position: absolute;  
		box-sizing: border-box;
		padding: 40px 30px;
	}

	input{
		width: 100%;
		margin-bottom: 10px;
	}

	input[type="text"], input[type="password"] ,input[type="email"]
	{
		border: none;
		border-bottom: 1px solid #fff;
		background: transparent;
		outline: none;
		height: 40px;
		color: #673ab7;
		font-size: 16px;
	}

	input[type="submit"]
	{
		border: none;
		outline: none;
		height: 40px;
		background: #2196f3;
		color: #fff;
		font-size: 18px;
		border-radius: 20px;
		position: center;
	}

	input[type="submit"]:hover
	{
		cursor: pointer;
		background: #0097a7;
	}

	a{
		text-decoration: none;
		font-size: 16px;
		line-height: 20px;
		color: #069818;
	}

	a:hover{
		color: red;
	}
</style>
<body>
	<div  class = "box">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
			<p>User ID: </p>
			<input type="text" name="uname" placeholder="   Enter Username or ID" required="">
			<p>Password: </p>
			<input type="password" name="pass" placeholder="        Enter Password" required="">
			
			<p style="color:red"><?php echo $err; ?></p>
			<input type="submit" name="submit" value="Login">
	
		<br><br>
			<a href="register.php">Click for New Register</a>
		</form>
	</div>
</body>
</center>

</html>