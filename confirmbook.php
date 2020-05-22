	<?php
		
		include 'classes/db.php';

		// Create database object
		$db = new Database();

		if (isset($_POST['submit'])) {
			$id = $_GET['id'];
			$name = $_GET['name'];

			$seat =  $_POST['seat'];
			$ticket =  $_POST['ticket'];

			$ticketsub=substr($seat, 0, -1);

			$array = explode(",", $ticketsub);

			$tic =array();

			foreach ($array as $key => $value) {
				$tickets[] = $value;
			}
			$totalticket = count($tickets);

			$query = " select * from screening where id=$id";
			$sresult = $db->select($query);
			$screen = $sresult->fetch_assoc();

			$cid = $screen['cinemahall_id'];
			$mid = $screen['movie_id'];

			$query = " select * from cinemahall where id=$cid";
			$cresult = $db->select($query);
			$hall = $cresult->fetch_assoc();

			$query = " select * from movies where id=$mid";
			$mresult = $db->select($query);
			$viewmovie = $mresult->fetch_assoc();


			$query = "INSERT INTO tmp(movie_id, theater_id, screening_id, ticket, ticket_no, price) VALUES ('$mid','$cid','$id', '$totalticket', '$ticketsub', '$ticket')";

			$result = $db->create($query);

			session_start();

			$_SESSION["tmpid"] = $result;
			

			header("Location: payment.php");

		}



?>