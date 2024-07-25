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
					location.href="./prod_delete.php?id="+id	;
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
				    die("Databses connection failed: " . $conn->connect_error);
				} 
				//--- select prod info
				$sql = "SELECT * FROM prod WHERE 1=1" ;
				$result = $conn->query($sql);
				//--- draw product table header
				echo	"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
						"	<tr style='background-color: #FFFFFF'>".
						"		<th colspan='7' style='padding: 5px'>Product Information Quick View</th></tr>".
						"	<tr style='background-color: #FFFFFF'>".
						"		<th style='padding: 5px'>Product ID</th>".
						"		<th style='padding: 5px'>Product Name</th>".
						"		<th style='padding: 5px'>Product Unit</th>".
						"		<th style='padding: 5px'>Unit Price</th>".
						"		<th style='padding: 5px'>Onhand Qty</th>".
						"		<th colspan='2'  style='padding: 5px'></th>".
						"	</tr>"	;
				//--- draw product table data
				while($row = $result->fetch_assoc()) {
      		  		echo	"	<tr style='background-color: #FFFFFF'>".
      		  				"		<td style='padding: 5px'><a href='./prod_dataView.php?id=".$row["prod_id"]."'>".$row["prod_id"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./prod_dataView.php?id=".$row["prod_id"]."'>".$row["prod_Name"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./prod_dataView.php?id=".$row["prod_id"]."'>".$row["prod_Unit"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./prod_dataView.php?id=".$row["prod_id"]."'>".$row["unit_price"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./prod_dataView.php?id=".$row["prod_id"]."'>".$row["onhand_Qty"]."</a></td>".
      		  				"		<td style='padding: 5px'><a href='./prod_updateView.php?id=".$row["prod_id"]."'>Edit</a></td>".
      		  				"		<td style='padding: 5px ; text-decoration: underline ; cursor: pointer' onclick=\"delCfm('".$row["prod_id"]."')\">Delete</a></td>".
      		  				"	</tr>"	;
				}
				//--- draw product table footer
				echo	"	<tr style='background-color: #FFFFFF'>".
						"		<td colspan='7' style='padding: 5px'><a href='./prod_insertView.php'>Insert</a></td>".
						"	</tr>".
						"</table>"	;
    		?>
		</div>
	</body>
</html>
