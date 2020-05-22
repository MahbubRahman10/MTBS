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
			$errors = $errormail = $errormobile = $errorpassword  = null;

			// Create database object
			$db = new Database();

			if(isset($_POST['signup']))
			{
				$name = $_POST['name'];
				$email = $_POST['email'];
				$mobile = $_POST['mobile'];
				$password = $_POST['password'];
				$repassword = $_POST['repassword'];

				$hashed_password = password_hash($password, PASSWORD_DEFAULT);

				if(empty($name) || empty($email) || empty($mobile) || empty($password) || empty($repassword)){

					$errors = "please fill out this fields" ;
					unset($_POST);
				}
				else{
					if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$errormail = "Invalid Email" ;	
					}
					else{
						if((strlen( $password) > 5)){

							if($password==$repassword){

								$query = "SELECT email FROM users WHERE email='$email'";
								$result = $db->select($query);
								if($result){
									$count = -1;
								}
								else{
									$count = 0;
								}
								if($count == 0){
									$query = $db->create("INSERT INTO users(name,email,mobile,password) VALUES ('$name','$email','$mobile','$hashed_password')");   
									if ($query) {
										$_SESSION['user'] = $query;
										header("Location: index.php");							
									}
									else
									{
										$errors = "Something Error";
									}
								}
								else
								{
									$errormail = "Sorry,This Email ID already taken" ;	
								}
							}
							else{
								$errorpassword = "Error! password do not match" ;
							}
						}
						else{
							$errorpassword = "Password must contain at least six characters" ;
						}
					}
				}
			}
		?>
		<div class="container">
			<div class="col-md-12">
				<div class="register" >
					<form id="signup" method="post" action="" class="form-inline">
						<h4 style="text-align: center; font-size: 175%;color: #757575;font-weight: 300;">Join today!</h4><hr>
						<span class="help-block" style="text-align: center;">
							<strong style="color: red; "> <?php echo $errors; ?> </strong>
						</span>
						<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>

						<input name="name" type="text" placeholder="Name" class="name" />

						<!-- @if ($errors->has('name'))
						<span class="help-block">
							<strong style="color: red;">{{ $errors->first('name') }}</strong>
						</span>
						@endif <br> -->


						
						<input name="email" type="email" placeholder="Email address" class="email" />

						<?php if($errormail != null){ ?>
						<span class="help-block" style=" text-align: left; padding: 0px 12px;">
							<strong style="color: red;"> <?php echo $errormail; ?></strong>
						</span>
						<?php } ?>

						<input name="mobile" type="text" placeholder="Mobile No." class="mobile" /><br>

						<?php if($errormobile != null){ ?>
						<span class="help-block" style=" text-align: left; padding: 0px 12px;">
							<strong style="color: red;"> <?php echo $errormobile; ?></strong>
						</span>
						<?php } ?>

						<input name="password" type="password" placeholder="Password"  class="password"/><br>  <h5 class="checkpassword" style="padding: 0px 10px; margin-top: -15px; font-weight: 700;"></h5>
						
						<?php if($errorpassword != null){ ?>
						<span class="help-block" style=" text-align: left; padding: 0px 12px;">
							<strong style="color: red;"> <?php echo $errorpassword; ?></strong>
						</span>
						<?php } ?>

						<input name="repassword" type="password" placeholder="Re-password"  class="repassword" /><h5 class="checkrepassword" style="padding: 0px 10px; margin-top: 0px; font-weight: 700;" ></h5>
						<br>

						<?php if($errorpassword != null){ ?>
						<span class="help-block">
							<strong style="color: red;"> <?php echo $errorpassword; ?></strong>
						</span>
						<?php } ?>

						<script src='https://www.google.com/recaptcha/api.js'></script>
						<div class="g-recaptcha" data-sitekey="6LeFpCUUAAAAAOUioXa31zlGk6XfBI-mwfNoC-kz" style="padding: 0px 10px;"></div> <br> 

						<button  class="btn" name="signup" id="signups">SignUp</button>

						<br><br>
					</form>
				</div>
			</div>
		</div>

		<!-- JavaScript -->
		<script type="text/javascript">
		    $(document).ready(function(){
				$(".password").on("input",function (e)  {
					e.preventDefault();
					var password = $(".password").val();
				   	$('.checkpassword').html('<img src="/img/Loading.gif" width="60" />');
			        console.log(password)
					var regex = new RegExp("^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]{6,}$");

					if (password.length<=5) {
					    $(".checkpassword").html("password must be at least 6 characters");
					    $(".password").css("border-color", "#a94442");
					    $(".checkpassword").css("color", "#a94442");
					}

					else if(regex.test(password))
					{
				        $(".checkpassword").html("Password is correct");
				        $(".password").css("border-color", "#3c763d");
				        $(".checkpassword").css("color", "#3c763d");        
					}

					else{
					    $(".checkpassword").html("password must contain at least one letter and one number");
					    $(".password").css("border-color", "#a94442");
					    $(".checkpassword").css("color", "#a94442");
					}

				});
			});
		</script>


		<script type="text/javascript">

			$(document).ready(function(){
				$(".repassword").on("input",function (e)  {
					e.preventDefault();
					var repassword = $(".repassword").val();
					var password = $(".password").val();
					if (repassword.length>=6) {
						if(repassword==password)
						{
							$(".checkrepassword").html("password is matched");
							$(".repassword").css("border-color", "#3c763d");
							$(".checkrepassword").css("color", "#3c763d");
						}

						else{
							$(".checkrepassword").html("password is not matched");
							$(".repassword").css("border-color", "#a94442");
							$(".checkrepassword").css("color", "#a94442");
						}
					}
					else{

					}
				});
			});
		</script>

		<script type="text/javascript">    

			$(function(){
				$('.form-inline').submit(function(event){
					var varified=grecaptcha.getResponse();
					if (varified.length===0) {
						event.preventDefault();
					}
				});
			});

		</script>

		<?php include 'sections/footer.php'; ?>      
	</body> 
</html>     