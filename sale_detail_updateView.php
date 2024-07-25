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
	<body>
		<div style="width: 100% ; height: 100px ; float: center">
			<?php include 'utility_menu.php';?>
		</div>
		<div style="width: 100% ; height: 100px ; float: center">
			<?php
				if	($_SERVER["REQUEST_METHOD"] === "GET"){
					//--- Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Databases connection failed: " . $conn->connect_error);
					} 
					//--- select cust info
					$sql = "SELECT * FROM sod WHERE sale_no = '".$_GET["id"]."' AND prod_id = '".$_GET["pid"]."'" ;
					$result = $conn->query($sql);
					//---
					$row = $result->fetch_assoc()	;
					//--- draw update table header
					echo	"<form method='post'>".
							"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
							"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>Sales Order ".$_GET["id"]." Product Update</th>".
	      	  				"	</tr>"	;
					//--- draw update table body
	      	  		echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Sales No</td>".
	      	  				"		<td style='padding: 5px'><input type='hidden' name='sale_no' value='".$row["sale_no"]."'>".$row["sale_no"]."</td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Product ID</td>".
	      	  				"		<td style='padding: 5px'><input type='hidden' name='prod_id' value='".$row["prod_id"]."'>".$row["prod_id"]."</td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Unit Price</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='sale_price' value='".$row["sale_price"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Quantity</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='sale_qty' value='".$row["sale_qty"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Price</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='exte_price' value='".$row["exte_price"]."'></td>".
	      	  				"	</tr>"	;
					//--- draw update table footer
					echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>".
	      	  				"			<input type='submit' value='Save'>".
	      	  				"			<input type='reset' value='Cancel' onclick=\"location.href='./sale_detail_gridView.php?id=".$_GET["id"]."'\">".
							"		</th>".
	      	  				"	</tr>".
							"</table>".
							"</form>"	;
					//---
					$conn->close();
				}
				else{
					//--- Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Databses connection failed: " . $conn->connect_error);
					} 
					//--- Update Sales order product data first
					$sql	=	"UPDATE sod  SET sale_price	=	 ".$_POST["sale_price"]	." ,".
												"sale_qty	=	 ".$_POST["sale_qty"]	." ,".
												"exte_price	=	 ".(intval($_POST["sale_price"],10) * intval($_POST["sale_qty"],10))."  ".
								" WHERE sale_no = '".$_POST["sale_no"]."'".
								"   AND prod_id	= '".$_POST["prod_id"]."'";
					if ($conn->query($sql) === TRUE){
						//--- Update Sales order data
						$sql	=	"UPDATE soh  SET sale_amt = (SELECT SUM(exte_price) FROM sod WHERE sale_no = '".$_POST["sale_no"]."')".
									" WHERE sale_no = '".$_POST["sale_no"]."'";
						if ($conn->query($sql) === TRUE){
							$conn->close();
							//---
							header("location:./sale_detail_gridView.php?id=".$_GET["id"])	;
						}
						else{
							echo	"Error: " . $sql . "<br>" . $conn->error."<br>".
									"<a href='./sale_detail_gridView.php?id=".$_GET["id"]."'>Go back</a>"	;
							//---
							$conn->close();
						}
					}
					else{
						echo	"Error: " . $sql . "<br>" . $conn->error."<br>".
								"<a href='./sale_detail_gridView.php?id=".$_GET["id"]."'>Go back</a>"	;
						//---
						$conn->close();
					}
				}
    		?>
		</div>
	</body>
</html>


