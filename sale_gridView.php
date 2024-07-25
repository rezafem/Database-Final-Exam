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
					location.href="./sale_delete.php?id="+id	;
			}
		</script>
	</head>
	<body>
		<div style="width: 100% ; height: 100px ; float: left">
			<?php include 'utility_menu.php';?>
		</div>
		<div style="width: 100% ; height: 100px ; float: right">
			<?php
				//--- Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				    die("Databses connection failed: " . $conn->connect_error);
				} 
				//--- select Sales order info
				$sql = "SELECT * FROM soh WHERE 1=1" ;
				$result = $conn->query($sql);
				//--- draw order table header
				echo	"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
						"	<tr style='background-color: #FFFFFF'>".
						"		<th colspan='7' style='padding: 5px'>Sales Order Quick View</th></tr>".
						"	<tr style='background-color: #FFFFFF'>".
						"		<th style='padding: 5px'>Sales No</th>".
						"		<th style='padding: 5px'>Sales date</th>".
						"		<th style='padding: 5px'>Customer ID</th>".
						"		<th style='padding: 5px'>Sales Amount</th>".
						"		<th colspan='3'  style='padding: 5px'></th>".
						"	</tr>"	;
				//--- draw order table data
				if	($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
	      		  		echo	"	<tr style='background-color: #FFFFFF'>".
	      		  				"		<td style='padding: 5px'><a href='./sale_dataView.php?id=".$row["sale_no"]."'>".$row["sale_no"]."</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./sale_dataView.php?id=".$row["sale_no"]."'>".$row["sale_date"]."</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./sale_dataView.php?id=".$row["sale_no"]."'>".$row["cust_id"]."</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./sale_dataView.php?id=".$row["sale_no"]."'>".$row["sale_amt"]."</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./sale_detail_gridView.php?id=".$row["sale_no"]."'>Detail</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./sale_updateView.php?id=".$row["sale_no"]."'>Edit</a></td>".
	      		  				"		<td style='padding: 5px ; text-decoration: underline ; cursor: pointer' onclick=\"delCfm('".$row["sale_no"]."')\">Delete</a></td>".
	      		  				"	</tr>"	;
					}
				}
				//--- draw order table footer
				echo	"	<tr style='background-color: #FFFFFF'>".
						"		<td colspan='7' style='padding: 5px'><a href='./sale_insertView.php'>Insert</a></td>".
						"	</tr>".
						"</table>"	;
    		?>
		</div>
	</body>
</html>

