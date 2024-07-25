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
					//--- draw insert table header
					echo	"<form method='post'>".
							"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
							"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>Customer Information Insert</th>".
	      	  				"	</tr>"	;
					//--- draw insert table body
	      	  		echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Customer ID</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='cust_id'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Customer Name</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='cust_name'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Address</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='cust_addr'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Tel</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='cust_tel'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Contact</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='contact'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Start Date</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='start_date'></td>".
	      	  				"	</tr>"	;
					//--- draw insert table footer
					echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>".
	      	  				"			<input type='submit' value='Save'>".
	      	  				"			<input type='reset' value='Cancel' onclick=\"location.href='./cust_gridView.php'\">".
	      	  				"		</th>".
	      	  				"	</tr>".
							"</table>".
							"</form>"	;
				}
				else{
					//--- Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Databses connection failed: " . $conn->connect_error);
					} 
					//---
					$sql = "INSERT INTO cust VALUES ('".$_POST["cust_id"]	."',".
													"'".$_POST["cust_name"]	."',".
													"'".$_POST["cust_addr"]	."',".
													"'".$_POST["cust_tel"]	."',".
													"'".$_POST["contact"]	."',".
													"'".$_POST["start_date"]	."')";

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


