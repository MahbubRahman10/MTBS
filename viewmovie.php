<html>
	<head>
	      <title>HousefullBD</title>
	      <link rel="icon" type="image/png" href="/img/film-reel.png">
	      <?php include 'sections/head.php'; ?> 

	</head>
	<body>
  		<div id="container">
    	<?php include 'sections/nav.php'; ?>   
      	  
		 	<br><br><br>
		  	<div class="container">
		  		<div class="col-md-12">
		  	
			  		<!-- PHP Script for Show Moive -->
			  		<?php
				  		use Carbon\Carbon;
				  		$t = Carbon::now()->format('Ymd');

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
			  		<h2 class="currentmovie">Bangla</h2>
			  		<?php foreach($movie as $data) { 
			  		 if($data['country'] == "Bangladesh"){  ?>
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
		  			<?php } } ?>
			  		<h2 class="currentmovie">Indo-Bangla</h2>
			  		<?php foreach($movie as $data) { 
			  		 if($data['country'] == "Indo-Bangladesh"){  ?>
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
		  			<?php } } ?>
			  		<h2 class="currentmovie">English</h2>
			  		<?php foreach($movie as $data) { 
			  		 if($data['country'] == "USA"){  ?>
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
			  		<?php } } ?>
		  		</div>
		  	</div>
		  	<br><br><br><br>
	     	<?php include 'sections/footer.php'; ?>      
  		</div>   
	</body>
</html>      