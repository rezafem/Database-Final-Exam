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
			function delCfm(id,pid){
				if	(confirm("Data delete! Are you sure ?"))
					location.href="./purc_detail_delete.php?id="+id+"&pid="+pid	;
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
				//--- select salse order item info
				$sql = "SELECT * FROM pod WHERE purc_no ='".$_GET["id"]."'" ;
				$result = $conn->query($sql);
				//--- draw item table header
				echo	"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
						"	<tr style='background-color: #FFFFFF'>".
						"		<th colspan='7' style='padding: 5px'>Purchase Order ".$_GET["id"]." Quick View</th></tr>".
						"	<tr style='background-color: #FFFFFF'>".
						"		<th style='padding: 5px'>Purchase No</th>".
						"		<th style='padding: 5px'>Product id</th>".
						"		<th style='padding: 5px'>Unit price</th>".
						"		<th style='padding: 5px'>Quantity</th>".
						"		<th style='padding: 5px'>Price</th>".
						"		<th colspan='2'  style='padding: 5px'></th>".
						"	</tr>"	;
				//--- draw item table data
				if	($result->num_rows > 0){
					while($row = $result->fetch_assoc()) {
	      		  		echo	"	<tr style='background-color: #FFFFFF'>".
	      		  				"		<td style='padding: 5px'><a href='./purc_detail_dataView.php?id=".$row["purc_no"	]."&pid=".$row["prod_id"	]."'>".$row["purc_no"	]."</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./purc_detail_dataView.php?id=".$row["prod_id"	]."&pid=".$row["prod_id"	]."'>".$row["prod_id"	]."</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./purc_detail_dataView.php?id=".$row["purc_price"	]."&pid=".$row["purc_price"	]."'>".$row["purc_price"]."</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./purc_detail_dataView.php?id=".$row["purc_qty"	]."&pid=".$row["purc_qty"	]."'>".$row["purc_qty"	]."</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./purc_detail_dataView.php?id=".$row["exte_price"	]."&pid=".$row["exte_price"	]."'>".$row["exte_price"]."</a></td>".
	      		  				"		<td style='padding: 5px'><a href='./purc_detail_updateView.php?id=".$row["purc_no"]."&pid=".$row["prod_id"]."'>Edit</a></td>".
	      		  				"		<td style='padding: 5px ; text-decoration: underline ; cursor: pointer' onclick=\"delCfm('".$row["purc_no"]."','".$row["prod_id"]."')\">Delete</a></td>".
	      		  				"	</tr>"	;
					}
				}
				//--- draw item table footer
				echo	"	<tr style='background-color: #FFFFFF'>".
						"		<td colspan='7' style='padding: 5px'>".
						"			<a href='./purc_detail_insertView.php?id=".$_GET["id"]."'>Insert</a>".
						"			<a href='./purc_gridView.php' style='margin-left: 15px'>Back</a>".
						"		</td>".
						"	</tr>".
						"</table>"	;
    		?>
		</div>
	</body>
</html>


