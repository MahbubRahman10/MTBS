<html>
	<head>
	      <title>HousefullBD</title>
	      <link rel="icon" type="image/png" href="/img/film-reel.png">
	      <?php include 'sections/head.php'; ?> 

	</head>
	<body>

		<?php ob_start(); include 'sections/nav.php'; ?> 

		<?php include 'sections/AuthMiddleware.php'; ?> 	 

		<?php 
			$db = new Database();
			$errors = null;

			if(isset($_POST['signin']))
			{
				$email = $_POST['email'];
				$password = $_POST['password'];

				$hashed_password = password_hash($password, PASSWORD_DEFAULT);

				$query = "SELECT * FROM users WHERE email='$email'";
				$result = $db->select($query);
				$row=$result->fetch_assoc();
				$count = $result->num_rows;	


				if($count == 1 && password_verify($password, $row['password'])){
						header("Location: index.php");
						$_SESSION['user'] = $row['id'];
				}
				else{
					$errors = "email or Password was incorrect!";
				}
			}
		?>
		<div class="container">
	    	<div class="col-md-12">
				<div class="login" >
					<form id="signup" method="post" action="" >

						<h4 style="text-align: center; font-size: 175%;color: #757575;font-weight: 300;">Login</h4><hr><br>        
						<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false">
						</div>

						<span class="help-block" style="text-align: center;">
							<strong style="color: red; "> <?php echo $errors; ?> </strong>
						</span>
						<input name="email" type="email" placeholder="Email address" required="required"/>

						<!-- 
						<?php if ($errorsmail ) { ?>
						<span class="help-block">
							<strong style="color: red;"> <?php echo $errorsmail; ?></strong>
						</span>
						<?php } ?> <br>
						-->
						<input name="password" type="password" placeholder="Password" required="required" /><br>
						<!-- 
						<?php  if ($errorspassword) { ?>
						<span class="help-block">
							<strong style="color: red;"><?php echo $errorspassword; ?></strong>
						</span>
						<?php } ?>
						-->
						<label class="checkbox">
							<input type="checkbox" name="remember"> Remember Me
						</label>
						<button  type="submit" class="btn btn-primary" name="signin" id="signin">SignIN</button><br><br>
						<label class="ma" style="padding: 0px 40px;">
							<span >Need an account?<span>
							<a href="register.php"> Register Here</a>
						</label>                         
						<label class="forget">
							<a class="btn btn-link" href="reset.php">
							Forgot Your Password?
							</a>
						</label>        
					</form>
				</div>
			</div>
		</div>
		<?php include 'sections/footer.php'; ?>      
	</body>      
</html>