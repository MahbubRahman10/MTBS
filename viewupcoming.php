<html>
	<head>
	      <title>HousefullBD</title>
	      <link rel="icon" type="image/png" href="/img/film-reel.png">
	      <?php include 'sections/head.php'; ?> 
	</head>
	<body>
 	
		<?php include 'sections/nav.php'; ?> 
		<br><br><br>
		<!-- PHP Script for Show Moive -->
		<?php

			if (isset($_GET['id'])) {
				$id = $_GET['id'];
			}

			// Create database object
			$db = new Database();

			// Query for fetch data from Movies Table
			$query = " select * from upcomingmovies where id=$id";
			$result = $db->select($query);
			$viewmovie = $result->fetch_assoc();

		?>

		<div class="container" >
			<div class="col-md-12">
				<div class="col-md-6">
					<object width="450" height="350" data="<?php  echo $viewmovie['trailer'] ?> " type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/Ahg6qcgoay4" /></object>
				</div>	
				<div class="col-md-6" id="info">
					<h2><?php  echo $viewmovie['movie_name'] ?></h2>
					<p style="font-style: italic; margin-top:-10px; color: black; "><?php  echo $viewmovie['genres'] ?></p>
					<div class="movie-casts tn-entity-short-details">
						<p itemprop="actor" itemscope="" itemtype="http://schema.org/Person">Relase Date: 
							<span itemprop="name"><?php  echo $viewmovie['relaseDate'] ?> </span>
						</p>
						<p itemprop="actor" itemscope="" itemtype="http://schema.org/Person">Cast: 
							<span itemprop="name"> <?php  echo $viewmovie['cast'] ?> </span>
						</p>
						<p itemprop="director" itemscope="" itemtype="http://schema.org/Person">Director: 
							<span itemprop="name"> <?php  echo $viewmovie['director'] ?> </span> 
						</p>
						<p itemprop="musicBy" itemscope="" itemtype="http://schema.org/Person">Music Director:
							<span itemprop="name"><?php  echo $viewmovie['musicDirector'] ?></span>
						</p>
						<h5>About Movie</h5>
						<p><?php  echo $viewmovie['aboutMovie'] ?> </p>
					</div>
				</div>	
			</div>
		</div>	
		<br><br><br><br><br>
	    <?php include 'sections/footer.php'; ?>      
	</body>      
</html>