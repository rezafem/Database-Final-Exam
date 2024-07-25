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
	      	  				"		<th colspan='2' style='padding: 5px'>Purchase Order ".$_GET["id"]." Product Insert</th>".
	      	  				"	</tr>"	;
					//--- draw insert table body
	      	  		echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Purchase No</td>".
	      	  				"		<td style='padding: 5px'><input type='hidden' name='purc_no' value='".$_GET["id"]."'>".$_GET["id"]."</td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Product ID</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='prod_id'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Unit price</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='purc_price'></td>".
	      	  				"	</tr>".
	      	  				"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<td style='padding: 5px ; background-color: #EEEEEE'>Purchase Quantity</td>".
	      	  				"		<td style='padding: 5px'><input type='text' name='purc_qty'></td>".
	      	  				"	</tr>";
	      	  		//--- draw insert table footer
					echo	"	<tr style='background-color: #FFFFFF'>".
	      	  				"		<th colspan='2' style='padding: 5px'>".
	      	  				"			<input type='submit' value='Save'>".
	      	  				"			<input type='reset' value='Cancel' onclick=\"location.href='./purc_detail_gridView.php?id=".$_GET["id"]."'\">".
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
					//--- Insert Purchase order product data first
					$sql = "INSERT INTO pod  VALUES ('".$_POST["purc_no"]	."',".
													"'".$_POST["prod_id"]	."',".
													" ".$_POST["purc_price"]." ,".
													" ".$_POST["purc_qty"]	." ,".
													" ".(intval($_POST["purc_price"],10) * intval($_POST["purc_qty"],10))." )";

					if ($conn->query($sql) === TRUE){
						//--- Update Purchase order data
						$sql	=	"UPDATE poh  SET purc_amt = (SELECT SUM(exte_price) FROM pod WHERE purc_no = '".$_POST["purc_no"]."')".
									" WHERE purc_no = '".$_POST["purc_no"]."'";
						if ($conn->query($sql) === TRUE){
							$conn->close();
							//---
							header("location:./purc_detail_gridView.php?id=".$_GET["id"])	;
						}
						else{
							echo	"Error: " . $sql . "<br>" . $conn->error."<br>".
									"<a href='./purc_detail_gridView.php?id=".$_GET["id"]."'>Go back</a>"	;
							//---
							$conn->close();
						}
					}
					else{
						echo	"Error: " . $sql . "<br>" . $conn->error."<br>".
								"<a href='./purc_detail_gridView.php?id=".$_GET["id"]."'>Go back</a>"	;
						//---
						$conn->close();
					}
				}
    		?>
		</div>
	</body>
</html>


