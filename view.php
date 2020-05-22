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
			use Carbon\Carbon;
			$t = Carbon::now()->format('Ymd');

			if (isset($_GET['id']) && isset($_GET['data'])) {
				$id = $_GET['id'];
				$data = $_GET['data'];
				$date=Carbon::parse($data)->format('Y-m-d');
			}

			// Create database object
			$db = new Database();

			// Query for fetch data from Movies Table
			$query = " select * from movies where id=$id";
			$result = $db->select($query);
			$viewmovie = $result->fetch_assoc();

			// Query for fetch data for show Theater and screening time
			$query = " select * from cinemahall INNER JOIN screening on cinemahall.id = screening.cinemahall_id where screening.movie_id=$id and screening.date='$date'";
			$result = $db->select($query);
			$hall = array();
			$theater = array();
			if($result){
					while ($data = $result->fetch_assoc()) {
						$hall[] = $data;
					}	
				// make unique Cinemal hall
				$theater = array();
				foreach ($hall as &$value) {
					if (!isset($theater[$value['hname']]))
						$theater[$value['hname']] =& $value;
				}
			}
		?>

		<div class="container" >
			<div class="col-md-12">
				<div class="col-md-6">
					<object width="450" height="350" data="<?php  echo $viewmovie['trailer'] ?> " type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/Ahg6qcgoay4" /></object>
				</div>	
				<div class="col-md-6" id="info">
					<h2><?php  echo $viewmovie['name'] ?></h2>
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
		<br><br><br>
		<div class="container">
			<div class="col-md-12">
				<?php 
					// PHP Block for maintain schedule		
					$t = Carbon::now('Asia/Dhaka');
					$t1=Carbon::now('Asia/Dhaka')->format('Ymd');
					$m=($t1+1);$m2=($t1+2);$m3=($t1+3);
					$d1="view.php?id=".$id."&data=".$t1;
					$d2="view.php?id=".$id."&data=".$m;
					$d3="view.php?id=".$id."&data=".$m2;
					$d4="view.php?id=".$id."&data=".$m3;

					$url = substr($_SERVER['REQUEST_URI'],5);;
				?>

				<ul class="nav nav-tabs">
					<li <?php if($url == $d1){ echo "class=actives";  } ?> ><a href="view.php?id=<?php echo $id;?>&data=<?php echo $t1; ?>">Today <?php echo Carbon::now('Asia/Dhaka')->format('d ') ?></a></li>
					<li <?php if($url == $d2){ echo "class=actives";  } ?> ><a href="view.php?id=<?php echo $id;?>&data=<?php echo $t1+1; ?>"><?php echo $t->addDay(1)->format('d D');  ?></a></li>
					<li <?php if($url == $d3){ echo "class=actives";  } ?> ><a href="view.php?id=<?php echo $id;?>&data=<?php echo $t1+2; ?>"><?php echo $t->addDay(1)->format('d D');  ?></a></li>
					<li <?php if($url == $d4){ echo "class=actives";  } ?> ><a  href="view.php?id=<?php echo $id;?>&data=<?php echo $t1+3; ?>"><?php echo $t->addDay(1)->format('d D');  ?> </a></li>
				</ul>
			</div>
			<br><br><br><br>

			<?php foreach ($theater as $key => $datas) { ?>

			<div class="col-md-12" id="searchdata" style=" border-bottom: 1px solid #eee;">
				<div class="col-md-4">
					<h4><?php echo $datas['hname'];  ?></h4>
					<p><?php echo $datas['city'];  ?></p>
				</div>
				<div class="col-md-8">
					<?php foreach ($hall as $key => $data) { 
						if ($datas['cinemahall_id'] == $data['cinemahall_id']) {
					?>
					<ul class="date" style="display: inline-block;">
						<?php 
							$nowdate=Carbon::now('Asia/Dhaka')->format('Ymd');
							$nowtime=Carbon::now('Asia/Dhaka')->format('Gi');

							$dates = Carbon::parse($data['date'])->format('Ymd') ;
							$times = Carbon::parse($data['time'])->format('Gi') ;

							if($nowdate == $dates){
								if($times >= $nowtime){
									$showtime = 1;
								}
								else{
									$showtime = 0;
								}
							}
							else{
								$showtime = 1;
							}
						?>
						 <?php  ?>
						<?php if ($date == $data['date'] && $showtime == '1' ) { ?>
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