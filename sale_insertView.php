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
	      	  				"		<th colspan='2' style='padding: 5px'>Sales Order Insert</th>".
	      	  				"	</tr>"	;
					//--- draw insert table body
	      	  		echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Sales No</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='sale_no'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Sales date</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='sale_date' placeholder='YYYY-MM-dd'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Customer ID</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='cust_id'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Sales Amount</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='sale_amt'></td>".
	      	  				"	</tr>"	;
					//--- draw insert table footer
					echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>".
	      	  				"			<input type='submit' value='Save'>".
	      	  				"			<input type='reset' value='Cancel' onclick=\"location.href='./sale_gridView.php'\">".
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
					$sql = "INSERT INTO soh  VALUES ('".$_POST["sale_no"]	."',".
													"'".$_POST["sale_date"]	."',".
													"'".$_POST["cust_id"]	."',".
													" ".$_POST["sale_amt"]	." )";

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

