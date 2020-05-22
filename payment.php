<html>
	<head>
	      <title>HousefullBD</title>
	      <link rel="icon" type="image/png" href="/img/film-reel.png">
	      <?php include 'sections/head.php'; ?> 

	</head>
	<body>
	 	
		<?php ob_start(); include 'sections/nav.php'; ?> 
		<?php include 'sections/Auth.php'; ?> 

		<?php

			include 'config/stripe.php';

			use Carbon\Carbon;
			$db = new Database();

			if (isset($_SESSION['tmpid'])) {
				$id=$_SESSION['tmpid'];
			}

			// Query for fetch data from tmp Table
			$query = " select * from tmp where id=$id";
			$tmpresult = $db->select($query);
			$tmp = $tmpresult->fetch_assoc();

			$mid = $tmp['movie_id'];
			$tid = $tmp['theater_id'];
			$sid = $tmp['screening_id'];

			// Query for fetch data from Movie Table
			$query = " select * from movies where id=$mid";
			$mresult = $db->select($query);
			$viewmovie = $mresult->fetch_assoc();

					// Query for fetch data from Movie Table
			$query = " select * from cinemahall where id=$tid";
			$tresult = $db->select($query);
			$hall = $tresult->fetch_assoc();

			// Query for fetch data from Screening Table
			$query = " select * from screening where id=$sid";
			$sresult = $db->select($query);
			$screening = $sresult->fetch_assoc();

			$userid = $_SESSION['user'];

			$query = " select * from users where id=$userid";
			$result = $db->select($query);
			$users = $result->fetch_assoc();

		 ?>
		<br>

	<div class="container" style=" ">
		<form action="paymentconfirm.php" method="post"  id="payment-form">
			<div class="col-md-9" id="paymentmethod">
				<br>
				<ul id="detailtab">
					<li><a>Payment Options</a></li>
				</ul>
				<ul class="nav nav-tabs" id="paytab" >
					<li class="active"><a data-toggle="tab" href="#home">CARD PAYMENT</a></li>
					<li><a data-toggle="tab" href="#menu1">MOBILE PAYMENT</a></li>
				</ul>

				<div class="tab-content">
					<!-- Stripe Payment -->
					<div id="home" class="tab-pane fade in active">
						<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							data-key="<?php echo $stripe['publishable_key']; ?>"
							data-description="Access for a year"
							data-amount="<?php echo $tmp['price']; ?>"
							data-locale="auto">	
						</script>
					</div>
					<div id="menu1" class="tab-pane fade">
						<label >Your Transaction id: </label>
						<input type="text" name="cvv" id="cvv" class="form-control" style="width:350px"> 
					</div>
				</div>
				<hr>
				<ul id="detailtab">
					<li><a>Contact Details</a></li>
				</ul>
				<div class="tab-content">
					<br>
					<div id="home" class="tab-pane fade in active">
						<div class="col-xs-12" style="margin-left:  -30px;">
							<input type="hidden" name="id" value="{{ Session::get('id') }}">      
							<div class="col-xs-6">
								<label>Email: </label>
								<input type="text" name="email" id="email" class="form-control" value="<?php echo $users['email']; ?>" style="width:250px" required>   <br>  
								<input type="hidden" name="name" id="name" class="form-control" value="" style="width:250px;"  required>   <br>  
							</div>
							<div class="col-xs-6">
								<label>Mobile: </label>
								<input type="text" name="mobile" id="mobile" class="form-control" value="<?php echo $users['mobile']; ?>"" style="width:250px" required>   <br>  
							</div>
						</div>
						<br><br><br><br><br><br><br><br>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<h3> <?php echo $viewmovie['name']; ?> </h3>
				<p> <?php echo $viewmovie['language']; ?> |  <?php echo $viewmovie['genres']; ?>  </p>
				<hr>
				<p>Theater</p>
				<h4> <?php echo $hall['hname']; ?> </h4>
				<p><?php echo $hall['location']; ?> </p>
				<br><br>
				<p>Showtime</p>
				<h4> <?php echo Carbon::parse($screening['date'])->format('D, d-m-Y'); ?>  <?php echo $screening['time']; 	?> 
				</h4>
				<hr>
				<section class="cost">
					<h4><strong>Total Ticket  </strong><span style="float: right;"><?php echo $tmp['ticket']; ?> </span></h4>
					<h4><strong>Seat No.  </strong><span style="float: right;"><?php echo $tmp['ticket_no']; ?> </span></h4>
					<h4><strong>Price  </strong><span style="float: right;">Tk. <?php echo $tmp['price']; ?></span></h4>
					<hr>
					<h4><strong>Amount Payable  </strong><span style="float: right;">Tk. <?php echo $tmp['price']; ?> </span></h4>
				</section>
				<br>
				<button  class="btn btn-primary" id="countdown" style="font-size: 25px; padding: 10px 120px; border-radius: 0; margin-bottom: 20px;" >10:00</button>
				<a href="index.php" class="btn btn-danger" style="padding: 10px 128px; border-radius: 0">Cancel</a>
				<a style="display:none;" id="modals" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"  data-backdrop="static" data-keyboard="false"></a>

				<!-- Modal -->
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
								<h4 class="modal-title">Alert!</h4>
							</div>
							<div class="modal-body">
								<p>Timeout.</p>
							</div>
							<div class="modal-footer">
								<a href="index.php" class="btn btn-primary" >Try again</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<!-- JavaScript -->
	<script type="text/javascript" src="assets/js/jquery-2.0.3.js"></script>
	<script type="text/javascript" src="assets/js/jquery.countdownTimer.js"></script>
		
		<script>
		    $(function(){
		        $('#countdown').countdowntimer({
		            minutes :10,
		            size : "lg"
		        });
		    });
		</script>

		<script type="text/javascript">
			$("body").on('DOMSubtreeModified', "#countdown", function() {
				var time=$('#countdown').html();
				if(time=="00:00"){
						$("#modals")[0].click()
				}
			});
		</script>

		<script type="text/javascript">
			$(document).ready(function() {
		        window.history.pushState(null, "", window.location.href);        
		        window.onpopstate = function() {
		            window.history.pushState(null, "", window.location.href);
		        };
		    });
		</script>
	</body>      
</html>