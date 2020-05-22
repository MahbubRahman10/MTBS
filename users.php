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
			// Query for fetch data from users Table
			$query = " select * from users where id=$id";
			$result = $db->select($query);
			$users = $result->fetch_assoc();
		?>
		
		<br><br><br>
		<div class="container">
			<div class="col-md-12">
				<div class="row">
					<!-- Nav tabs -->
					<div class="card">
						<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Profile</a></li>
							<li ><a href="usersbook.php">Book</a></li>
							<li role="presentation"><a href="usersprofileedit.php">Edit Profile</a></li>
							<li role="presentation"><a href="logout.php" >SignOut</a></li>
						</ul>
						<!-- Tab panes -->
						<div role="tabpanel" class="tab-pane active" id="home">
							<div class="container">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4" id="info">
											<?php if(isset($_SESSION['editmsg'])) { ?>
											<div class="alert alert-success">
												<?php echo $_SESSION['editmsg']; ?>
											</div>
											<?php } ?>                                                       
											<h4><span>Name : </span> <?php echo $users['name']; ?> </h4><br>
											<h4><span>Email : </span> <?php echo $users['email']; ?> </h4><br>
											<h4><span>Mobile : </span>  <?php echo $users['mobile']; ?></h4><br>
											<br>
										</div>
									</div>
								</div>
							</div>
						</div>		
					</div>
				</div>
			</div>		
		</div>
		<br><br><br><br><br><br>
		<?php include 'sections/footer.php'; ?>
	</body>      
</html>