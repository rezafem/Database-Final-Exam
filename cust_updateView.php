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
					$sql = "SELECT * FROM cust WHERE cust_id = '".$_GET["id"]."'" ;
					$result = $conn->query($sql);
					//---
					$row = $result->fetch_assoc()	;
					//--- draw update table header
					// <form action="/cust_updateView2.php">
					echo	"<form method='post'>".
							"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
							"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>Customer Information Update</th>".
	      	  				"	</tr>"	;
					//--- draw update table body
	      	  		echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Customer ID</td>".
	      	  				"		<td style='padding: 5px'><input type='hidden' name='cust_id' value='".$row["cust_id"]."'>".$row["cust_id"]."</td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Customer Name</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='cust_name' value='".$row["cust_name"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Address</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='cust_addr' value='".$row["cust_addr"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Tel</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='cust_tel' value='".$row["cust_tel"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Contact</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='contact' value='".$row["contact"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Start Date</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='start_date' value='".$row["start_date"]."'></td>".
	      	  				"	</tr>";
					//--- draw update table footer
					echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>".
	      	  				"			<input type='submit' value='Save'>".
	      	  				"			<input type='reset' value='Cancel' onclick=\"location.href='./cust_gridView.php'\">".
							"		</th>".
	      	  				"	</tr>".
							"</table>".
							"</form>"	;
					//---
					$conn->close();
				}
				// cust_updateView2.php
				else{
					//--- Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Databses connection failed: " . $conn->connect_error);
					} 
					//---
					$sql	=	"UPDATE cust SET cust_name	=	'".$_POST["cust_name"]	."',".
												"cust_addr	=	'".$_POST["cust_addr"]	."',".
												"cust_tel	=	'".$_POST["cust_tel"]	."',".
												"contact	=	'".$_POST["contact"]	."',".
												"start_date	=	'".$_POST["start_date"]	."' ".
								" WHERE cust_id = '".$_POST["cust_id"]."'";

					if ($conn->query($sql) === TRUE){
						$conn->close();
						//---
						header("location:./cust_gridView.php")	;
					}
					else{
						echo	"Error: " . $sql . "<br>" . $conn->error."<br>".
								"<a href='./cust_gridView.php'>Go back</a>"	;
						//---
						$conn->close();
					}
				}
    		?>
		</div>
	</body>
</html>


