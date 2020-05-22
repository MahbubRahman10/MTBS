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

			    		// Query for fetch data cinemahall Table
					    $query = "select * from cinemahall";
					    $theaterresult = $db->select($query);
					    while ($data = $theaterresult->fetch_assoc()) {
					    	$theaters[] = $data;
					    }

			  		?>
			  		<h2 class="currentmovie">Dhaka</h2>
			  		<?php foreach($theaters as $data) { 
			  			if($data['city'] == "Dhaka"){ 
			  		?>
			  		<div class="col-md-3">
			  			<a href="view.php?id=<?php echo $data['id'];?>&data=<?php echo $t; ?>" class="movie">
			  				<div >
			  					<i class="fa fa-arrow-right" style="padding: 0px 5px;"></i><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $data['hname']; ?></a>
			  				</div>
			  			</a>
			  		</div>
			  		<?php } } ?>
			  		<h2 class="currentmovie">Chittagong</h2>
			  		<?php foreach($theaters as $data) { 
			  			if($data['city'] == "Chittagong"){ 
			  		?>
			  		<div class="col-md-3">
			  			<a href="view.php?id=<?php echo $data['id'];?>&data=<?php echo $t; ?>" class="movie">
			  				<div >
			  					<i class="fa fa-arrow-right" style="padding: 0px 5px;"></i><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $data['hname']; ?></a>
			  				</div>
			  			</a>
			  		</div>
			  		<?php } } ?>
			  		<h2 class="currentmovie">Sylhet</h2>
			  		<?php foreach($theaters as $data) { 
			  			if($data['city'] == "Sylhet"){ 
			  		?>
			  		<div class="col-md-3">
			  			<a href="view.php?id=<?php echo $data['id'];?>&data=<?php echo $t; ?>" class="movie">
			  				<div >
			  					<i class="fa fa-arrow-right" style="padding: 0px 5px;"></i><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $data['hname']; ?></a>
			  				</div>
			  			</a>
			  		</div>
			  		<?php } } ?>
			  		<h2 class="currentmovie">Rajshahi</h2>
			  		<?php foreach($theaters as $data) { 
			  			if($data['city'] == "Rajshahi"){ 
			  		?>
			  		<div class="col-md-3">
			  			<a href="view.php?id=<?php echo $data['id'];?>&data=<?php echo $t; ?>" class="movie">
			  				<div >
			  					<i class="fa fa-arrow-right" style="padding: 0px 5px;"></i><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $data['hname']; ?></a>
			  				</div>
			  			</a>
			  		</div>
			  		<?php } } ?>
			  		<h2 class="currentmovie">Khulna</h2>
			  		<?php foreach($theaters as $data) { 
			  			if($data['city'] == "Khulna"){ 
			  		?>
			  		<div class="col-md-3">
			  			<a href="view.php?id=<?php echo $data['id'];?>&data=<?php echo $t; ?>" class="movie">
			  				<div >
			  					<i class="fa fa-arrow-right" style="padding: 0px 5px;"></i><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $data['hname']; ?></a>
			  				</div>
			  			</a>
			  		</div>
			  		<?php } } ?>
			  		<h2 class="currentmovie">Barisal</h2>
			  		<?php foreach($theaters as $data) { 
			  			if($data['city'] == "Barisal"){ 
			  		?>
			  		<div class="col-md-3">
			  			<a href="view.php?id=<?php echo $data['id'];?>&data=<?php echo $t; ?>" class="movie">
			  				<div >
			  					<i class="fa fa-arrow-right" style="padding: 0px 5px;"></i><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $data['hname']; ?></a>
			  				</div>
			  			</a>
			  		</div>
			  		<?php } } ?>
			  		<h2 class="currentmovie">Rangpur</h2>
			  		<?php foreach($theaters as $data) { 
			  			if($data['city'] == "Rangpur"){ 
			  		?>
			  		<div class="col-md-3">
			  			<a href="view.php?id=<?php echo $data['id'];?>&data=<?php echo $t; ?>" class="movie">
			  				<div >
			  					<i class="fa fa-arrow-right" style="padding: 0px 5px;"></i><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $data['hname']; ?></a>
			  				</div>
			  			</a>
			  		</div>
			  		<?php } } ?>
		  		</div>
		  	</div>
			<br>
	     	<?php include 'sections/footer.php'; ?>      
 	 	</div>   
	</body>
</html>      