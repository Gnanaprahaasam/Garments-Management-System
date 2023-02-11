<?php 
session_start();
if (!isset($_SESSION["manager"])) {
	header('Location: index.php');
	exit;
}
require_once('mysql_conn.php');

$sql ="SELECT * FROM stock";
$result = mysqli_query($conn,$sql);

?>


<html>
<head><title>stock&trade</title></head>
<style>
    body{
		background: none;
    	
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
    <a href="view_form.php" class="view"><input type="submit" name="submit" class="view" value="View Form"></a>
    <a href="stock&trade.php" class="stock"><input type="submit" name="submit" class="stock" value="Stock-Trade"></a>
	<a href="logout.php" class="logout"><input  type="submit" name="submit" class ="logout" value="logout"></a></p>
</div>
<hr>
<br><br><br>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
	<table border="1" >		
	    <?php
        echo "<tr style='background:lightgrey'>\n"; 
        echo "<td><b> customer ID </b></td>\n";
        echo "<td><b> customer Name </b></td>\n"; 
        echo "<td><b> Address </b></td>\n"; 
        echo "<td><b> Contact No </b></td>\n";
        echo "<td><b> order Item </b></td>\n"; 
        echo "<td><b> Order Date </b></td>\n"; 
        echo "<td><b> Delivery Date </b></td>\n";
        echo "<td><b> status </b></td>\n"; 
        echo"<td><h2> Update </h2></td>";
        echo "</tr>\n";
        while($row = mysqli_fetch_array($result))
            {
                echo "<tr>";
                $ref=$row['id'];
                $_SESSION['update']=$ref;
                echo"<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['address']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td>".$row['stock']."</td>";
                echo "<td>".$row['order_date']."</td>";
                echo "<td>".$row['date']."</td>";
                echo '<td>'.$row['status'].'</td>';
                echo "<td><a href=\"stock&trade1.php\" name=\"Update\">Update</a></td>";
                echo "</tr>";
            }
            echo "</table> \n";		
            
        ?>	
	</table>
</form>
<br><br>
<hr>
<footer>
    
</footer>
</center>
</html>