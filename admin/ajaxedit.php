<?php

include 'config/db_connect.php';


// Edit Movie
if(isset($_POST["movieeditid"])) 
{
	$id = $_POST["movieeditid"];
	$name = $_POST["name"];
	$genres = $_POST["genres"];
	$imdb = $_POST["imdb"];
	$date = $_POST["date"];

	$sql = "UPDATE movies SET name = '$name', genres = '$genres', imdbRating = '$imdb', relaseDate = '$date' WHERE id = '$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}
}

// Delete Movie
if(isset($_POST["ids"])) 
{
	$id = $_POST["ids"];

	$sql = "DELETE FROM movies WHERE id=$id";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $conn->error);
	}	

}


// Edit Upcoming Movie
if(isset($_POST["upcomingmovieeditid"])) 
{
	$id = $_POST["upcomingmovieeditid"];
	$name = $_POST["name"];
	$genres = $_POST["genres"];
	$date = $_POST["date"];

	$sql = "UPDATE upcomingmovies SET movie_name = '$name', genres = '$genres', relaseDate = '$date' WHERE id = '$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}
}


// Delete Upcoming Movie
if(isset($_POST["upcomingmovieid"])) 
{
	$id = $_POST["upcomingmovieid"];

	$sql = "DELETE FROM upcomingmovies WHERE id=$id";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $conn->error);
	}	

}

// Delete Message
if(isset($_POST["msgid"])) 
{
	$id = $_POST["msgid"];

	$sql = "DELETE FROM message WHERE id=$id";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $conn->error);
	}	

}


// Delete User
if(isset($_POST["userid"])) 
{
	$id = $_POST["userid"];

	$sql = "DELETE FROM users WHERE id=$id";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $conn->error);
	}	

}


// Delete Booking
if(isset($_POST["bookid"])) 
{
	$id = $_POST["bookid"];

	$sql = "DELETE FROM book WHERE bookId='$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}	

}









// Edit Theater
if(isset($_POST["theatereditid"])) 
{
	$id = $_POST["theatereditid"];
	$name = $_POST["name"];
	$location = $_POST["location"];
	$city = $_POST["city"];
	$phone = $_POST["phone"];

	$sql = "UPDATE cinemahall SET hname = '$name', location = '$location', city = '$city', phone = '$phone' WHERE id = '$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}
}

// Delete Theater
if(isset($_POST["theaterid"])) 
{
	$id = $_POST["theaterid"];

	$sql = "DELETE FROM cinemahall WHERE id=$id";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}	

}




// Edit Screen
if(isset($_POST["screeneditid"])) 
{
	$id = $_POST["screeneditid"];
	$name = $_POST["name"];
	$seat = $_POST["seat"];

	$sql = "UPDATE theater SET tname = '$name', total_seat = '$seat' WHERE id = '$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}
}

// Delete Screen
if(isset($_POST["screenid"])) 
{
	$id = $_POST["screenid"];

	$sql = "DELETE FROM theater WHERE id=$id";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}	

}



// Edit Seat Distribution
if(isset($_POST["seatdistributioneditid"])) 
{
	$id = $_POST["seatdistributioneditid"];
	$name = $_POST["name"];
	$price = $_POST["price"];

	$sql = "UPDATE seatdistribution SET type = '$name', price = '$price' WHERE id = '$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}
}

// Delete Seat Distribution
if(isset($_POST["seatdistributionid"])) 
{
	$id = $_POST["seatdistributionid"];

	$sql = "DELETE FROM seatdistribution WHERE id=$id";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}	

}




// Edit Seat
if(isset($_POST["seateditid"])) 
{
	$id = $_POST["seateditid"];
	$row = $_POST["row"];
	$column = $_POST["column"];

	$sql = "UPDATE seat SET row = '$row', number = '$column' WHERE id = '$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}
}

// Delete Seat
if(isset($_POST["seatid"])) 
{
	$id = $_POST["seatid"];

	$sql = "DELETE FROM seat WHERE id=$id";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}	

}



// Edit Show
if(isset($_POST["showeditid"])) 
{
	$id = $_POST["showeditid"];
	$name = $_POST["name"];
	$date = $_POST["date"];
	$time = $_POST["time"];

	$sql = "UPDATE screening SET movie_name = '$name', date = '$date', time = '$time' WHERE id = '$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}
}

// Delete Show
if(isset($_POST["showid"])) 
{
	$id = $_POST["showid"];

	$sql = "DELETE FROM screening WHERE id=$id";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}	

}







// Message Status
if(isset($_POST["messagestatusid"])) 
{
	$id = $_POST["messagestatusid"];
	$status = '1';

	$sql = "UPDATE message SET status = '$status' WHERE id = '$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}
}



// Book Status
if(isset($_POST["bookstatusid"])) 
{
	$id = $_POST["bookstatusid"];
	$status = '1';

	$sql = "UPDATE book SET status = '$status' WHERE bookId = '$id'";

	if ($con->query($sql) === TRUE) {
		echo json_encode("Record deleted successfully");
	} else {
		echo json_encode("Error deleting record: " . $con->error);
	}
}








?>