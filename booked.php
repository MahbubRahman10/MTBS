<html>
<head>
      <title>HousefullBD</title>
      <link rel="icon" type="image/png" href="/img/film-reel.png">
      <?php include 'sections/head.php'; ?> 

</head>
	<body>
	 	
		<?php ob_start(); include 'sections/nav.php'; ?>
		<?php  include 'sections/Auth.php'; ?> 
		
		<?php 
			
			$db = new Database();
			
			if (isset($_SESSION['bookid'])) {
				$id = $_SESSION['bookid'];
			}
			
			$query = " select * from book where bookId=$id";
			$result = $db->select($query);
			$book = $result->fetch_assoc();

			$sid  = $book['screening_id'];

			$query = " select * from screening where id=$sid";
			$result = $db->select($query);
			$screening = $result->fetch_assoc();

			$cid  = $screening['cinemahall_id'];

			$query = " select * from cinemahall where id=$cid";
			$result = $db->select($query);
			$cinemahall = $result->fetch_assoc();
		?>
		<div class="contaienr" style="margin-top: 5%;">
			<div class="tk">
				<h1 style="text-align: center;font-weight: 100; font-size: 60px;">Thank You!</h1><br>
			</div>
			<h4 style="text-align: center;">Your Booking for <strong><?php echo $screening['movie_name']; ?></strong> on <strong><?php echo $screening['date']; ?>, <?php echo $screening['time']; ?></strong>  at <strong><?php echo $cinemahall['hname']; ?></strong> are confirmed.</h4>
			<br>
			<h4 style="text-align: center;">Your Transaction Id: <strong><?php echo $book['transaction_id']; ?></strong></h4>
			<br>
		</div>
		<br><br><br><br><br><br><br><br>
		<!-- JavaScript -->
		<script type="text/javascript">
			$(document).ready(function() {
				window.history.pushState(null, "", window.location.href);        
				window.onpopstate = function() {
					window.history.pushState(null, "", window.location.href);
				};
			});

		</script>
    	<?php include 'sections/footer.php'; ?>        
	</body>      
</html>