<?php include 'Auth.php'; ?>

<?php

	include_once 'config/db_connect.php';

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}

	$sql = "DELETE FROM slide WHERE id='$id'";
   	$result = $con->query($sql);

   	if ($result) {
   		header("Location: slide.php");
   	}


	
	

?>