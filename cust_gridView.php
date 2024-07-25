<?php
	session_start()	;
	//--- if user is not logined, redirect to index.php
	if	(!isset($_SESSION["userid"])){
		header("location:./index.php")	;
		return	;
	}
	//---
	include 'utility_dbinfo.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<script>
			function delCfm(id){
				if	(confirm("Data delete! Are you sure ?"))
					location.href="./cust_delete.php?id="+id	;
			}
		</script>
	</head>
	<body>
		<div style="width: 100% ; height: 100px ; float: center">
			<?php include 'utility_menu.php';?>
		</div>
		<div style="width: 100% ; height: 100px ; float: center">
			<?php
				//--- Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				    die("Databases connection failed: " . $conn->connect_error);
				} 
				//--- select cust info
				$sql = "SELECT * FROM cust WHERE 1=1" ;
				$result = $conn->query($sql);
				//--- draw customer table header
				echo	"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
						"	<tr style='background-color: #FFFFFF'>".
						"		<th colspan='8' style='padding: 5px'>Customer Information Quick View</th></tr>".
						"	<tr style='background-color: #FFFFFF'>".
						"		<th style='padding: 5px'>Customer ID</th>".
						"		<th style='padding: 5px'>Customer Name</th>".
						"		<th style='padding: 5px'>Address</th>".
						"		<th style='padding: 5px'>Tel</th>".
						"		<th style='padding: 5px'>Contact</th>".
						"		<th style='padding: 5px'>Start Date</th>".
						"		<th colspan='2'  style='padding: 5px'></th>".
						"	</tr>"	;
				//--- draw customer table data
				while($row = $result->fetch_assoc()) {
      		  		echo	"	<tr style='background-color: #FFFFFF'>".
      		  				"		<td style='padding: 5px'><a href='./cust_dataView.php?id=".$row["cust_id"]."'>".$row["cust_id"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./cust_dataView.php?id=".$row["cust_id"]."'>".$row["cust_name"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./cust_dataView.php?id=".$row["cust_id"]."'>".$row["cust_addr"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./cust_dataView.php?id=".$row["cust_id"]."'>".$row["cust_tel"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./cust_dataView.php?id=".$row["cust_id"]."'>".$row["contact"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./cust_dataView.php?id=".$row["cust_id"]."'>".$row["start_date"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./cust_updateView.php?id=".$row["cust_id"]."'>Edit</a></td>".
      		  				"		<td style='padding: 5px ; text-decoration: underline ; cursor: pointer' onclick=\"delCfm('".$row["cust_id"]."')\">Delete</a></td>".
      		  				"	</tr>"	;
				}
				//--- draw customer table footer
				echo	"	<tr style='background-color: #FFFFFF'>".
						"		<td colspan='8' style='padding: 5px'><a href='./cust_insertView.php'>Insert</a></td>".
						"	</tr>".
						"</table>"	;
    		?>
		</div>
	</body>
</html>
