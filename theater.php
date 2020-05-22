<html>
	<head>
	      <title>HousefullBD</title>
	      <link rel="icon" type="image/png" href="/img/film-reel.png">
	      <?php include 'sections/head.php'; ?> 

	</head>
	<body>
	 	
		<?php include 'sections/nav.php'; ?> 
		
		<!-- PHP Script for Show Moive -->
		<?php
			use Carbon\Carbon;
			$t = Carbon::now()->format('Ymd');

			if (isset($_GET['name']) && isset($_GET['data'])) {
				$name = $_GET['name'];
				$data = $_GET['data'];
				$date=Carbon::parse($data)->format('Y-m-d');
			}

			// Create database object
			$db = new Database();

			// Query for fetch data from Movies Table
			$query = " select * from cinemahall where hname='$name'";
			$tresult = $db->select($query);
			$viewtheater = $tresult->fetch_assoc();

			$thid = $viewtheater['id'];
			$latitude = $viewtheater['latitude'];
			$longitude = $viewtheater['longitude'];
			$apikey = 'AIzaSyCUm0r_-Ud3-v-iaNPRgCyXsooOLOMkXR4';



			// Query for fetch data for show cinemahall and screening time
			$query = " select * from cinemahall INNER JOIN screening on cinemahall.id = screening.cinemahall_id where screening.cinemahall_id=$thid and screening.date='$date'";
			$result = $db->select($query);
			$hall = array();
			$movies = array();
			if($result){
				while ($data = $result->fetch_assoc()) {
					$hall[] = $data;
				}	
				// make unique Movies
				$movies = array();
				foreach ($hall as &$value) {
					if (!isset($movies[$value['movie_name']]))
						$movies[$value['movie_name']] =& $value;
				}
			}

		?>

		<div class="col-md-12" id="viewtheater">
			<br><br><br>
			<div class="col-md-6" style="margin-left: 100px; height: 300px;" >
				<h2 style="color: white; font-weight: 600;"><?php  echo $viewtheater['hname']; ?> </h2>
			    <div class="movie-casts tn-entity-short-details">
			      <p itemprop="actor" itemscope="" itemtype="http://schema.org/Person"><strong> Location: </strong> 
			      <span itemprop="name"><?php echo $viewtheater['location']; ?></span>
			      <p itemprop="director" itemscope="" itemtype="http://schema.org/Person"><strong> Contact Number: </strong> 
			      <span itemprop="name"><?php  echo $viewtheater['phone']; ?></span> </p>   
			   </div>
			</div>
			<div class="col-md-6" id="theatermap">
				<!--   Show Google Map   -->
				<div id="map-canvas"/> </div>
				
				<!--   Start Google Map Functionality   --> 
				<style type="text/css">
			 		 #map-canvas { height: 100% }
				</style>
				<script type="text/javascript"
					src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apikey; ?>&sensor=false">
				</script>
				<script type="text/javascript">
					function initialize() {
						var mapOptions = {
							center: new google.maps.LatLng(<?php echo $latitude.', '.$longitude; ?>),
							zoom: <?php echo '18'; ?>
						};
						var map = new google.maps.Map(document.getElementById("map-canvas"),
							mapOptions);
					}
					google.maps.event.addDomListener(window, 'load', initialize);
				</script>
				<!--    End Google Map Functionality  --> 
			</div>  
		</div>
		<br><br><br>
		<div class="container">
			<div class="col-md-12">
				<?php 
					// PHP Block for maintain schedule		
					$t = Carbon::now();
					$t1=Carbon::now()->format('Ymd');
					$m=($t1+1);$m2=($t1+2);$m3=($t1+3);
					$d1="theater.php?name=".$name."&data=".$t1;
					$d2="theater.php?name=".$name."&data=".$m;
					$d3="theater.php?name=".$name."&data=".$m2;
					$d4="theater.php?name=".$name."&data=".$m3;

					$urls = substr($_SERVER['REQUEST_URI'],5);
					$url = str_replace("%20"," ",$urls);


				?>

				<ul class="nav nav-tabs">
					<li <?php if($url == $d1){ echo "class=actives";  } ?> ><a href="theater.php?name=<?php echo $name;?>&data=<?php echo $t1; ?>">Today <?php echo Carbon::now()->format('d ') ?></a></li>

					<li <?php if($url == $d2){ echo "class=actives";  } ?> ><a href="theater.php?name=<?php echo $name;?>&data=<?php echo $t1+1; ?>"><?php echo $t->addDay(1)->format('d D');  ?></a></li>
					<li <?php if($url == $d3){ echo "class=actives";  } ?> ><a href="theater.php?name=<?php echo $name;?>&data=<?php echo $t1+2; ?>"><?php echo $t->addDay(1)->format('d D');  ?></a></li>
					<li <?php if($url == $d4){ echo "class=actives";  } ?> ><a  href="theater.php?name=<?php echo $name;?>&data=<?php echo $t1+3; ?>"><?php echo $t->addDay(1)->format('d D');  ?> </a></li>
				</ul>
			</div>
			<br><br><br><br>
			<?php foreach ($movies as $key => $datas) { ?>
			<div class="col-md-12" id="searchdata" style=" border-bottom: 1px solid #eee;">
				<div class="col-md-4" style="padding: 10px 0px;">
					<h4><?php echo $datas['movie_name'];  ?></h4>
				</div>
				<div class="col-md-8">
					<?php foreach ($hall as $key => $data) { 
						if ($datas['cinemahall_id'] == $data['cinemahall_id']) {
					?>
					<ul class="date" style="display: inline-block;">
						<?php 
							$t1=Carbon::now()->format('g:i A');
						?>
						<?php if ($date == $data['date'] || $t1 < Carbon::parse($data['time'])->format('g:i A') ) { ?>
							<li><a href="book.php?id=<?php echo $data['id']; ?>"><?php echo $data['time']; ?></a></li>
						<?php } ?>
					</ul>
					<?php } } ?>
				</div>
			</div>
			<?php } ?>
			<br><br><br><br><br>
		</div>
		<br><br><br><br><br>
	    <?php include 'sections/footer.php'; ?>      
	</body>      
</html>