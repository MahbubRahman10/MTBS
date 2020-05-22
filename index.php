<html>
<head>
      <title>HousefullBD</title>
      <link rel="icon" type="image/png" href="/img/film-reel.png">
      <?php include 'sections/head.php'; ?> 
</head>
	<body>
  		
  		<div id="container">
    		<?php include 'sections/nav.php'; ?>   
     
    		<div id="myCarousel" class="carousel slide" data-ride="carousel">

		 	    <!-- PHP Script for slides -->
			    <?php
				    $db = new Database();
		    		// Query for fetch data from slide Table
				    $query = "select * from slide";
				    $slideresult = $db->select($query);
				    $slides = array();
				    if ($slideresult) {
				    	while ($data = $slideresult->fetch_assoc()) {
				    		$slides[] = $data;
				    	}
				    }
			    ?> 
			    <div class="carousel-inner">      
			    	<?php foreach($slides as $data) { ?>
			    	<div class="item <?php if($data['active'] == '1') { echo 'active'; } ?>" >
			    		<img src="assets\<?php echo $data['image']; ?>" alt="Los Angeles" style="width:100%; height:370px;">
			    	</div>
			    	<!-- Left and right controls -->
			    	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			    		<span class="glyphicon glyphicon-chevron-left"></span>
			    		<span class="sr-only">Previous</span>
			    	</a>
			    	<a class="right carousel-control" href="#myCarousel" data-slide="next">
			    		<span class="glyphicon glyphicon-chevron-right"></span>
			    		<span class="sr-only">Next</span>
			    	</a>
			    	<?php } ?>
		    	</div>
		  	</div>
		 	 <br><br><br>
		  	<div class="container">
			  	<div class="col-md-12">
			  		<h2 class="currentmovie">NOW SHOWING</h2>
			  		<!-- PHP Script for Show Moive -->
			  		<?php
				  		use Carbon\Carbon;
				  		$t = Carbon::now('Asia/Dhaka')->format('Ymd');
					    $db = new Database();
			    		// Query for fetch data from Movies Table
					    $query = "select * from movies";
					    $moviesresult = $db->select($query);
						$movie = array();
					    if ($moviesresult) {
					    	while ($data = $moviesresult->fetch_assoc()) {
					    		$movie[] = $data;
					    	}
					    }
			  		?>

			  		<?php foreach($movie as $data) { ?>
			  		<div class="col-md-3">
			  			<a href="view.php?id=<?php echo $data['id'];?>&data=<?php echo $t; ?>" class="movie">
			  				<div class="movies" data-id="">
			  					<!-- cart reqirement -->
			  					<!-- product image -->					
			  					<div class="image"> <!-- product image -->
			  						<img id="img" src="assets\<?php echo $data['poster']; ?>" height="270" width="100%" style="padding: 2px 2px;"></img>	
			  					</div>
			  					<hr>
			  					<h5> <?php echo $data['name']; ?> </h5>
			  					<hr>
			  					<!-- product details -->
			  					<div id="pri" class="pr" data-id="">		
			  						<h4>Book</h4><br>
			  					</div>
			  				</div>
			  			</a>
			  		</div>
			  		<?php } ?>
			  	</div>
		  	</div>
			<br><br><br>
		  	<div class="container">
		  		<div class="col-md-12">
		  			<div id="create" class="col-lg-15 col-md-15 col-xs-12 col-sm-12 ac m-t20 m-b20">
			  			<h2>Upcoming Movie</h2>
			  			<!-- PHP Script for Upcoming Moive -->
			  			<?php
				  			$t = Carbon::now()->format('Ymd');
				  			$db = new Database();

				    		// Query for fetch data from Movies Table
				  			$query = "select * from upcomingmovies";
				  			$result = $db->select($query);
				  			$upcomingmovies = array();
				  			if ($result) {			  				
				  				while ($data = $result->fetch_assoc()) {
				  					$upcomingmovies[] = $data;
				  				}
				  			}
			  			?>
			  			<?php foreach($upcomingmovies as $data) { ?>
			  			<div class="col-md-3">
			  				<a href="viewupcoming.php?id=<?php echo $data['id']; ?>" class="movie">
			  					<div class="movies" data-id="">				
			  						<div class="image">
			  							<img id="img" src="assets\<?php echo $data['poster']; ?>" height="270" width="100%"></img>
			  						</div>
			  						<hr>
			  						<h5> <?php echo $data['movie_name']; ?> </h5>
			  						<hr>
			  					</div>
			  				</a>
			  			</div>
			  			<?php } ?>
		  			</div>
		  		</div>
		  	</div>
			<br>
	     	<?php include 'sections/footer.php'; ?>      
  		</div>   
	</body>      
</html>