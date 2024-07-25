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
					//--- select sale info
					$sql = "SELECT * FROM soh WHERE sale_no = '".$_GET["id"]."'" ;
					$result = $conn->query($sql);
					//---
					$row = $result->fetch_assoc()	;
					//--- draw update table header
					// <form action="/sale_updateView2.php">
					echo	"<form method='post'>".
							"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
							"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>Sales Order Information Update</th>".
	      	  				"	</tr>"	;
					//--- draw update table body
	      	  		echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Sales No</td>".
	      	  				"		<td style='padding: 5px'><input type='hidden' name='sale_no' value='".$row["sale_no"]."'>".$row["sale_no"]."</td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Sales Date</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='sale_date' value='".$row["sale_date"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Customer ID</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='cust_id' value='".$row["cust_id"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Sales Amount</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='sale_amt' value='".$row["sale_amt"]."'></td>".
	      	  				"	</tr>"	;
					//--- draw update table footer
					echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>".
	      	  				"			<input type='submit' value='Save'>".
	      	  				"			<input type='reset' value='Cancel' onclick=\"location.href='./sale_gridView.php'\">".
							"		</th>".
	      	  				"	</tr>".
							"</table>".
							"</form>"	;
					//---
					$conn->close();
				}
				// sale_updateView2.php
				else{
					//--- Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Databses connection failed: " . $conn->connect_error);
					} 
					//---
					$sql	=	"UPDATE soh SET sale_date	=	'".$_POST["sale_date"]	."',".
												"cust_id	=	'".$_POST["cust_id"]	."',".
												"sale_amt	=	'".$_POST["sale_amt"]		."' ".
								" WHERE sale_no = '".$_POST["sale_no"]."'";

					if ($conn->query($sql) === TRUE){
						$conn->close();
						//---
						header("location:./sale_gridView.php")	;
					}
					else{
						echo	"Error: " . $sql . "<br>" . $conn->error."<br>".
								"<a href='./sale_gridView.php'>Go back</a>"	;
						//---
						$conn->close();
					}
				}
    		?>
		</div>
	</body>
</html>



