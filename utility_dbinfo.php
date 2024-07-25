<?php
	$servername = "localhost"	;
	$username	= "id13472406_rezafem"		;
	$password	= "lG1#<2}!WtanGNXk"		;
	$dbname	    = "id13472406_4a816031"		;
	
    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>