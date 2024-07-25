<?php
    //--- start session
    session_start()	;
	//--- set user id into session
	$_SESSION["userid"]	=	$_POST["userid"]	;
	//---
	header("location:./index.php")	;
	include 'utility_dbinfo.php';
	//--- Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Databases connection failed: " . $conn->connect_error);
	} 
	//--- select user info user_id=sa, password=abcde
	$sql = "SELECT * FROM user WHERE userid = '".$_POST["userid"]."' AND userpwd = '".$_POST["userpwd"]."'" ;
	$result = $conn->query($sql);	//--- not found
	if ($result->num_rows == 0) {
		$conn->close();
		//---
		echo	"Login id or password error!<br>".
				"<a href='./index.php'>Go back</a>"	;
		//---
		return	;
	}
	//--- id & password pass, set session info and redirect 
	$conn->close();
?>

