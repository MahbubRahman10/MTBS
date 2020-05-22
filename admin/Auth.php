<?php
	
	session_start();

	if (isset($_SESSION['admin'])) {
		
	}
	else{
		header("Location: adminlogin.php");
	}


?>