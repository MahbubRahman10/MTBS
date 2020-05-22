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
			if (isset($_SESSION['token'])) {
				$token=$_SESSION['token'];
			}
			else{
				header("Location: index.php");
			}
			// Query for fetch data from users Table
			$query = " select * from users where email_token=$token";
			$result = $db->select($query);
			$user = $result->fetch_assoc();

			if (isset($_POST['submit'])) {

				$password = $_POST['password'];
				$repassword = $_POST['repassword'];		

				$hashed_password = password_hash($password, PASSWORD_DEFAULT);

				if ($password == '') {
					$errorpass = "Please fill up this filed";
				}
				elseif ($repassword == '') {
					$errorrepass = "Please fill up this filed";
				}
				else{
					if (strlen($password) > 5 ) 
					{				
						if ($password == $repassword) {

							$sql = "UPDATE users SET password='$hashed_password' WHERE email_token=$token";
							$result = $db->update($sql);
							header("Location: login.php");
						}				
						else{
							$errorrepass = "Password do not match";
						}
					}
					else{
						$errorpass = "Password must contain at least six characters" ;	
					}
					
				}
			}
		?>

	
		<div class="container" style="margin-top: 3%; margin-bottom:2%;">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading">Reset Your Password</div>
						<div class="panel-body">
							<?php if (isset($msg)) { ?>
								<div class="alert alert-success">
									<?php  echo $msg;  ?>
								</div>
							<?php } ?>
							<form class="form-horizontal" role="form" method="POST" action="">
								<div class="form-group">
									<label for="email" class="col-md-4 control-label"></label>

									<div class="col-md-6">
										<span><strong>Password</strong></span>
										<input id="password" type="password" class="form-control" name="password" value="" required>
										<span class="help-block">
											<strong style="color: red;"> <?php echo $errorpass; ?> </strong>
										</span><br>
										<span><strong>Re Password</strong></span>
										<input id="repassword" type="password" class="form-control" name="repassword" value="" required>
										<span class="help-block">
											<strong style="color: red;"> <?php echo $errorrepass; ?> </strong>
										</span>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" name="submit" class="btn btn-primary">
											Reset Password
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br><br>
		<?php include 'sections/footer.php'; ?>
	</body>  
</html>
