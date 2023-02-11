<?php

session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}
    
require_once('mysql_conn.php');
    
$sql ='SELECT * FROM employee';
$result = mysqli_query($conn,$sql);

$sql1='SELECT * FROM department';
$result1=mysqli_query($conn,$sql1);
$select=1;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $department=$_REQUEST['dtype'];
    $test1="SELECT * FROM employee where dept='$department'";
    $result2= mysqli_query($conn,$test1);    
    $test= mysqli_num_rows($result2);    
    if($test!=0)
    {
        $select = 0;    
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
</style>
<p><?php echo'Admin-person:'.$_SESSION['manager']. "";?></p>


<div style="text-align:right">
    <p><a href="home.php" class="home"><input  type="submit" name="submit" class ="home" value="home"></a>
    <a href="add_employee.php" class="emp"><input type="submit" name="submit" class="emp" value="Add-Employee"></a>
    <a href="add_department.php" class="dept"><input type="submit" name="submit" class="dept" value="Add-Department"></a>
    <a href="attendence.php" class="attendance"><input type="submit" name="submit" class="attendance" value="Attendence"></a>
    <a href="salary.php" class="salary"><input type="submit" name="submit" class="salary" value="Salary"></a>
    <a href="totalsal.php" class="tsalary"><input type="submit" name="submit" class="tsalary" value="Total-salary"></a>
    <a href="View_stock.php" class="stock"><input type="submit" name="submit" class="stock" value="Stock & Trade"></a>
    <a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
</div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
<div style="text-align:right">
    <p>Select Department:<select name="dtype">
        <?php
        echo '<option value=\"select\">select</option>';
        while ($row1=  mysqli_fetch_assoc($result1)) 
        {
            echo '<option value="'.$row1['dept_name'].'">'.$row1['dept_name'].'</option>';
        }
        
        ?></select>
    <input  type="submit" name="submit" value="Search"></p>
    
</div>
<center>
<hr>
<br><br><br>


	<table border="1" >		
    <?php 

       if($select == 0) 
       {
            echo"<tr style='background:lightgrey'>";
            echo"<td><h2> S_No </h2></td>";
            echo"<td><h2> Name </h2></td>";
            echo"<td><h2> Empolyee_Id </h2></td>";
            echo"<td><h2> Department </h2></td> ";
            echo"<td><h2> Gender </h2></td>";
            echo"<td><h2> D.O.B </h2></td>";
            echo"<td><h2> Address </h2></td>";
            echo"<td><h2> Contact </h2></td>";
            echo"<td><h2> Modify </h2></td>";
            echo"</tr>";       
        
            $no=0;    
            while($row = mysqli_fetch_array($result2))
            {
                $no+=1;
                echo "<tr>";
                $ref=$row['e_id'];
                $_SESSION['ref']=$ref;
                echo"<td>".$no."</td>";
                echo "<td>".$row['name']."</td>";
                echo"<td>".$row['e_id']."</td>";
                echo "<td>".$row['dept']."</td>";
                echo "<td>".$row['gender']."</td>";
                echo "<td>".$row['dob']."</td>";
                echo "<td>".$row['address']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td><a href=\"modify_employee_info.php\" name=\"modify\">Modify</a></td>";             
                echo "</tr>";
            }
            //echo "</table> \n";		
        }       
        else 
        {
            echo"<tr>";
            echo"<td><h2> S_No </h2></td>";
            echo"<td><h2> Name </h2></td>";
            echo"<td><h2> Empolyee_Id </h2></td>";
            echo"<td><h2> Department </h2></td> ";
            echo"<td><h2> Gender </h2></td>";
            echo"<td><h2> D.O.B </h2></td>";
            echo"<td><h2> Address </h2></td>";
            echo"<td><h2> Contact </h2></td>";
            echo"</tr>";       
        
            $no=0;    
            while($row2 = mysqli_fetch_assoc($result))
            {
                $no+=1;
                echo "<tr>";
                echo"<td>".$no."</td>";
                echo "<td>".$row2['name']."</td>";
                echo"<td>".$row2['e_id']."</td>";
                echo "<td>".$row2['dept']."</td>";
                echo "<td>".$row2['gender']."</td>";
                echo "<td>".$row2['dob']."</td>";
                echo "<td>".$row2['address']."</td>";
                echo "<td>".$row2['phone']."</td>";
                echo "</tr>";
            }
            //echo "</table> \n";		
        }
        
    
    ?>	
	</table>
</form>
<br>
</center>
</html>