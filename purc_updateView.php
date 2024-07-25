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
					    die("Databses connection failed: " . $conn->connect_error);
					} 
					//--- select purc info
					$sql = "SELECT * FROM poh WHERE purc_no = '".$_GET["id"]."'" ;
					$result = $conn->query($sql);
					//---
					$row = $result->fetch_assoc()	;
					//--- draw update table header
					// <form action="/purc_updateView2.php">
					echo	"<form method='post'>".
							"<table style='margin: 20px auto ; background-color: #BDBDBD ; border-spacing: 1px'>".
							"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>Purchase Order Information Update</th>".
	      	  				"	</tr>"	;
					//--- draw update table body
	      	  		echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Purchase No</td>".
	      	  				"		<td style='padding: 5px'><input type='hidden' name='purc_no' value='".$row["purc_no"]."'>".$row["purc_no"]."</td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Purchase Date</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='purc_date' value='".$row["purc_date"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Vendor ID</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='vend_id' value='".$row["vend_id"]."'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Purchase Amount</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='puc_amt' value='".$row["puc_amt"]."'></td>".
	      	  				"	</tr>"	;
					//--- draw update table footer
					echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>".
	      	  				"			<input type='submit' value='Save'>".
	      	  				"			<input type='reset' value='Cancel' onclick=\"location.href='./purc_gridView.php'\">".
							"		</th>".
	      	  				"	</tr>".
							"</table>".
							"</form>"	;
					//---
					$conn->close();
				}
				// purc_updateView2.php
				else{
					//--- Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
					    die("Databses connection failed: " . $conn->connect_error);
					} 
					//---
					$sql	=	"UPDATE purc SET purc_date	=	'".$_POST["purc_date"]	."',".
												"vend_id	=	'".$_POST["vend_id"]	."',".
												"puc_amt	=	'".$_POST["puc_amt"]		."' ".
								" WHERE purc_id = '".$_POST["purc_id"]."'";

					if ($conn->query($sql) === TRUE){
						$conn->close();
						//---
						header("location:./purc_gridView.php")	;
					}
					else{
						echo	"Error: " . $sql . "<br>" . $conn->error."<br>".
								"<a href='./purc_gridView.php'>Go back</a>"	;
						//---
						$conn->close();
					}
				}
    		?>
		</div>
	</body>
</html>



