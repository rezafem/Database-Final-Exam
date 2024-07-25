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
				//--- Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
				    die("Databases connection failed: " . $conn->connect_error);
				} 
				//---
				$sql	=	"DELETE FROM prod WHERE prod_id = '".$_GET["id"]."'";

				if ($conn->query($sql) === TRUE){
					$conn->close();
					//---
					header("location:./prod_gridView.php")	;
				}
				else{
					echo	"Error: " . $sql . "<br>" . $conn->error."<br>".
							"<a href='./prod_gridView.php'>Go back</a>"	;
					//---
					$conn->close();
				}
			?>
		</div>
	</body>
</html>


