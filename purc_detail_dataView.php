<?php
    ob_start() ;
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
				//--- select cust info
				$sql = "SELECT * FROM pod WHERE purc_no = '".$_GET["id"]."' AND prod_id = '".$_GET["pid"]."'" ;
				$result = $conn->query($sql);
				//---
				$row = $result->fetch_assoc()	;
				//--- draw update table header
					echo	"<form method='post'>".
							"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
							"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>Purchase Order ".$_GET["id"]." Product Detail</th>".
	      	  				"	</tr>"	;
				//--- draw update table body
	      	  		echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Purchase No</td>".
	      	  				"		<td style='padding: 5px'><input type='hidden' name='purc_no' value='".$row["purc_no"]."'>".$row["purc_no"]."</td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Product ID</td>".
	      	  				"		<td style='padding: 5px'><input type='hidden' name='prod_id' value='".$row["prod_id"]."'>".$row["prod_id"]."</td>".
	      	  				"	</tr>".
          	  				"	<tr style='background-color: #FFFFFF'>".
          	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Unit Price</td>".
          	  				"		<td style='padding: 5px'>".$row["purc_price"]."</td>".
          	  				"	</tr>".
          	  				"	<tr style='background-color: #FFFFFF'>".
          	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Purchase Quantity</td>".
          	  				"		<td style='padding: 5px'>".$row["purc_qty"]."</td>".
          	  				"	</tr>".
          	  				"	<tr style='background-color: #FFFFFF'>".
          	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Extend Price</td>".
          	  				"		<td style='padding: 5px'>".$row["exte_price"]."</td>".
          	  				"	</tr>"	;
				//--- draw update table footer
				echo	"	<tr style='background-color: #FFFFFF'>".
      	  				"		<th colspan='2' style='padding: 5px'>".
      	  				"			<input type='reset' value='Cancel' onclick=\"location.href='./purc_gridView.php'\">".
						"		</th>".
      	  				"	</tr>".
						"</table>"	;
				//---
				$conn->close();
			?>
		</div>
	</body>
</html>

