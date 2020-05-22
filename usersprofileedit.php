<html>
	<head>
		<title>HousefullBD</title>
		<link rel="icon" type="image/png" href="/img/film-reel.png">
		<?php include 'sections/head.php'; ?> 
	</head>
	<body>
		
		<?php ob_start(); include 'sections/nav.php'; ?> 
		
		<?php
			$errorname = $errormobile = $errorold = $errorpass = $errorrepass  = null;
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
			$user = $result->fetch_assoc();

			// Edit Basic Info
			if (isset($_POST['edit'])) {
				$name = $_POST['name'];
				$mobile = $_POST['mobile'];
				if ($name == '') {
					$errorname = "Name is required ";
				}
				elseif ($mobile == '') {
					$errormobile = "Mobile is required";
				}
				else{
					$sql = "UPDATE users SET name='$name',mobile='$mobile' WHERE id=$id";
					$result = $db->update($sql);
					header("Location: users.php");
				}
			}


			if (isset($_POST['change'])) {
				
				$oldpassword = $_POST['oldpassword'];
				$password = $_POST['password'];
				$repassword = $_POST['password_confirmation'];		
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);

				if ($oldpassword == '') {
					$errorold = "Please fill up this filed";
				}
				elseif ($password == '') {
					$errorpass = "Please fill up this filed";
				}
				elseif ($repassword == '') {
					$errorrepass = "Please fill up this filed";
				}
				else{
					if (password_verify($oldpassword, $user['password'])) 
					{	
						if (strlen($password) > 5 ) 
						{				
							if ($password == $repassword) {

								$sql = "UPDATE users SET password='$hashed_password' WHERE id=$id";
								$result = $db->update($sql);
								header("Location: users.php");
							}				
							else{
								$errorrepass = "Password do not match";
							}
						}
						else{
							$errorpass = "Password must contain at least six characters" ;	
						}
					}
					else{
						$errorold = "Please enter the correct password";
					}
				}
			}
		?>

		<br><br><br><br>

		<div class="container">
			<div class="col-md-12">
				<div class="row">
				<!-- Nav tabs -->
					<div class="card">
						<ul class="nav nav-tabs" id="nav-tabs" role="tablist">
							<li><a href="users.php" >Profile</a></li>
							<li><a href="usersbook.php">Book</a></li>
							<li role="presentation" class="active"><a>Edit Profile</a></li>
							<li role="presentation"><a href="logout.php">SignOut</a></li>
						</ul>
						
						<!-- Tab panes -->
						<div role="tabpanel" class="tab-pane active" id="home">
							<div class="container">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4" id="info">
											<h5 style="font-size: 20px; text-transform: uppercase; letter-spacing: 1px; "><strong>Edit Bacic Info </strong></h5> <br>
											<form method="post" action="">
												<label>Name : </label>   
												<input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>"placeholder="">
												<span class="help-block">
													<strong style="color: red;"><?php echo $errorname; ?></strong>
												</span><br>
												
												<label>mobile : </label>   
												<input type="text" class="form-control" name="mobile" value="<?php echo $user['mobile']; ?>" placeholder="">
												<span class="help-block">
													<strong style="color: red;"><?php echo $errormobile; ?></strong>
												</span><br>
												<button type="submit" class="btn btn-primary" name="edit">Edit</button>
											</form><br>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="container">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4" id="info">
											<h5 style="font-size: 20px; text-transform: uppercase; letter-spacing: 1px; "><strong>Change Password </strong></h5>
											<div class="passwords">
												<form method="post" action="" style="margin-left: 00px;">
													<br>
													<h6><label>Old Password :</label></h6>
													<div>
														<input  type="password" class="form-control" name="oldpassword"  style="width: 220px;">
														<span class="help-block">
															<strong style="color: red;"><?php echo $errorold; ?></strong>
														</span>
													</div><br>
													<h6><label>New Password :</label></h6>
													<div>
														<input type="password" class="form-control" name="password" style="width: 220px;">
														<span class="help-block">
															<strong style="color: red;"><?php echo $errorpass; ?></strong>
														</span>
													</div><br>
													<h6><label>Re-Password :</label></h6>
													<div>
														<input type="password" class="form-control" name="password_confirmation" style="width: 220px;">
														<span class="help-block">
															<strong style="color: red;"><?php echo $errorrepass; ?></strong>
														</span>
													</div>
													<br>
													<button type="submit" name="change" class="btn btn-primary">Change</button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>		
					</div>
				</div>
			</div>		
		</div><br><br>
		<?php include 'sections/footer.php'; ?>
	</body>  
</html>
