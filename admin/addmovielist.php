<?php include 'Auth.php'; ?>

<?php
	
	include_once 'config/db_connect.php';

	if(isset($_GET['id'])){

		$id =  $_GET['id'];


		$query = "select * from upcomingmovies where id='$id'";

		$result=$con->query($query);

		$row=$result->fetch_assoc();


		$name = $row['movie_name'];
		$language = $row['language'];
		$country = $row['country'];
		$genre = $row['genres'];
		$rdate = $row['relaseDate'];
		$poster = $row['poster'];
		$cast = $row['cast'];
		$director = $row['director'];
		$mdirector = $row['musicDirector'];
		$about = $row['about'];


		$query = "INSERT INTO movies(name, language, country, genres, relaseDate, poster, cast, director, musicDirector, trailer, aboutMovie) VALUES ('$name','$language','$country', '$genre', '$rdate', '$poster','$cast','$director','$mdirector','$trailer','$about')";

		$result=$con->query($query);

		if($result){
			$sql = "DELETE FROM upcomingmovies WHERE id='$id'";
			$con->query($sql);

			header("Location: movie.php");
		} 


	}


?>