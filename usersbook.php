<html>
	<head>
		<title>HousefullBD</title>
		<link rel="icon" type="image/png" href="/img/film-reel.png">
		<?php include 'sections/head.php'; ?> 

	</head>
	<body>

		<?php ob_start(); include 'sections/nav.php'; ?> 
		<!-- PHP Script -->
		<?php
			use Carbon\Carbon;
			$db = new Database();

			if (isset($_SESSION['user'])) {
				$id=$_SESSION['user'];
			}
			else{
				header("Location: index.php");
			}
			// Query for fetch data from books Table
			$query = " select * from book INNER JOIN screening on book.screening_id = screening.id INNER JOIN cinemahall on cinemahall.id = screening.cinemahall_id INNER JOIN theater on theater.cinemahall_id = cinemahall.id where book.user_id='$id'";

			$result = $db->select($query);
			$book = array();
			if ($result) {
				while($row = $result->fetch_assoc()){
					$book[] = $row;
				}
			}
		?>

		<br><br><br>

		<div class="container">
			<div class="col-md-12">
				<div class="row">
					<!-- Nav tabs -->
					<div class="card">
						<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
							<li ><a href="users.php" >Profile</a></li>
							<li role="presentation" class="active"><a aria-controls="home" role="tab" data-toggle="tab">Book</a></li>
							<li role="presentation"><a href="usersprofileedit.php">Edit Profile</a></li>
							<li role="presentation"><a href="logout.php" >SignOut</a></li>
						</ul>
						<!-- Tab panes -->
						<div role="tabpanel" class="tab-pane active" id="home">
							<div class="container">
								<div class="col-md-12">
									<div class="row">
									<?php if(count($book)!=0) { ?>
										<h5 style="font-size: 20px; margin-bottom: 25px;"><strong>Yor Booking History : </strong></h5>
										<table class="table table-bordered" style="width: 95%;">
											<thead>
												<th>Movie</th>
												<th>Theater</th>
												<th>Time</th>
												<th>Payment</th>
												<th>Transaction ID</th>
											</thead>
											<?php $i = 0 ?>
											<tbody>
												<?php foreach($book as $data) { ?>
												<tr class="data" >
													<td><?php echo $data['movie_name']; ?></td>
													<td><?php echo $data['hname']; ?></td>
													<td><?php  echo Carbon::parse($data['date'])->format('d-m-Y ');    echo $data['time']; ?> </td>
													<td><?php echo $data['payment_type']; ?> </td>
													<td><?php echo $data['transaction_id']; ?></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										<?php } else{ ?>
										<h4>You don't have any Book</h4>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>    
					</div>
				</div>
			</div>    
		</div><br><br><br><br><br><br><br>
		<?php include 'sections/footer.php'; ?>
	</body>      
</html>