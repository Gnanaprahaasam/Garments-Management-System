<?php

session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}
    
require_once('mysql_conn.php');
    
$sql ='SELECT * FROM employee';
$result = mysqli_query($conn,$sql);

$sql2='SELECT * FROM department';
$result2=mysqli_query($conn,$sql2);
$select=1;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $department=$_REQUEST['dtype'];
    $test1="SELECT * FROM employee where dept='$department'";
    $test2= mysqli_query($conn,$test1);    
    $test= mysqli_num_rows($test2);
    if($test!=0)
    {
        $sql1="SELECT * FROM employee where dept='$department'";
        $result1= mysqli_query($conn,$sql1);
        $select +=1;
    }
}

?>



<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Employee List</title>
</head>
<style>
   body{
		background-image: url("");
    	background-size: cover;
    	
	}
       
    footer{        
        font-family: "Georgia",Serif;	
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
    .header{
	  font-size: 40px;
	  font-style: !important;
	  font-family: "Garamond", serif;
	  color: green;
	  text-align: center;
    }

</style>
<p>
    <br>
    <?php echo'Admin-person:'.$_SESSION['manager']. "";?>
    <br>
</p>

<div style="text-align:right">
    <p><a href="home.php" class="home"><input  type="submit" name="submit" class ="home" value="home"></a>
    <a href="view_form.php" class="view"><input type="submit" name="submit" class="view" value="View Form"></a>
    <a href="attendence.php" class="attendance"><input type="submit" name="submit" class="attendance" value="Attendence"></a>
    <a href="salary.php" class="salary"><input type="submit" name="submit" class="salary" value="Salary"></a>
    <a href="totalsal.php" class="tsalary"><input type="submit" name="submit" class="tsalary" value="Total-salary"></a>
    <a href="View_stock.php" class="stock"><input type="submit" name="submit" class="stock" value="Stock & Trade"></a>
    <a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
    
</div>
<br><br>
<center>
<hr>
<br><br><br>
<div class="header">    
    <h1> <img src="garments.png" width=10% height=10%><i>Anushmrithun</i></hr><br><h2>Group Of Textile and Garment Pvt.Lmt</h2>
</div>


</center>
</html>