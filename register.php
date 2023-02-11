<?php
	
require("mysql_conn.php");
$err1= "";
$err = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST['uname'];
	$password = $_POST['pass'];
	$acctype = 'Manager';


	$sql = "SELECT * from login";
	$result = mysqli_query($conn,$sql);
		
	while($row = mysqli_fetch_array($result))
	{
		
		$un= $row['uname'];
		$up= $row['pass'];
		$type = $row['acctype'];
		
		if($un == $username && $up == $password && $type == "Manager")
		{                
			$err = 'Allready the field is registered';
		}
		else if($un!=$username && $up!=$password)
		{
			$sql1 = "INSERT INTO `login` (`uname`,`pass`,`acctype`)VALUES('$username','$password','$acctype')";
			if(mysqli_query($conn,$sql1))
			{
				$err1='Given data are inserted succuessfully';
			}								
		}
		
	}
}
?>


<html>
<head><title>Register Page</title></head>
<center>
<h1>Register Page</h1>

<style>
	body{
		background-image: url("textile.jpg");
    	background-size: cover;
	}
	.box{
		background: #f5f5f5;
		color: midnightblue;
		top: 20%;
		left: 40%;
		position: absolute;  
		box-sizing: border-box;
		padding: 40px 40px;
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
	<div  class="box">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
			<p>Account Type:<br>(Only for Admin)</p>
			<p>User ID: </p>
			<input type="text" name="uname" placeholder="    Enter Username or ID" required="">
			<p>Password: </p>
			<input type="password" name="pass" placeholder="        Enter Password" required="">
            
			<p style="color:red"><?php echo $err; ?></p>
			<p style="color:green"><?php echo $err1; ?></p>
			<input type="submit" name="submit" value="Register">
	
		<br><br>
			<a href="index.php">Goto Login</a>
		</form>
	</div>
</body>
</center>

</html>