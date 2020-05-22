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
		$success = $errors = $errormail = $errorname = $errormsg  = null;
		// Create database object
		$db = new Database();
		if(isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$message = $_POST['description'];

			if(empty($name) || empty($email) || empty($message)){
				$errors = "please fill out this fields" ;
				unset($_POST);
			}
			elseif (empty($name)) {
				$errorname = "Please fill out this field" ;
			}
			elseif (empty($email)) {
				$errormail = "Please fill out this field" ;
			}
			elseif (empty($message)) {
				$errormsg = "Please fill out this field" ;
			}
			else{
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$errormail = "Invalid Email" ;	
				}
				else
				{
					$query = $db->create("INSERT INTO message(name,email,message) VALUES ('$name','$email','$message')");   
					if ($query) {
						header("Location: contact.php");
						$success = "Thank you for your message. We will contact you later.";							
					}
					else
					{
						$errors = "Something Error";
					}
				}
			}
		}
		?>

		<div class="contaienr" >
			<div class="row" style="width: 100%;">
				<div class="col-md-6 col-sm-offset-3" >
					<div class="contact">
						<div> 
							<span class="help-block">
								<strong><?php echo $errors; ?></strong>
							</span><br> 
						</div>
						<br><br>
						<form method="post" action="" class="form-inline" style="margin-left: 100px;">	
							<label>Name : </label><br>
							<input id="name" type="text" class="form-control" name="name" required autofocus style="width: 70%;"><br>
							<span class="help-block">
								<strong><?php echo $errorname; ?></strong>
							</span><br>
							
							<label>Email : </label><br>
							<input id="email" type="email" class="form-control" name="email" required autofocus style="width: 70%;"><br>
							<span class="help-block">
								<strong><?php echo $errormail; ?></strong>
							</span><br>
							
							<label>Message : </label><br>
							<textarea id="description" class="form-control" name="description"   style="width: 70%;"></textarea>

							<span class="help-block">
								<strong><?php echo $errormsg; ?></strong>
							</span><br>
							<!-- Google Captcha -->
							<script src='https://www.google.com/recaptcha/api.js'></script>
							<div class="g-recaptcha" data-sitekey="6LeFpCUUAAAAAOUioXa31zlGk6XfBI-mwfNoC-kz" ></div> <br>
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div><br><br>

		<!-- JavaScript  -->
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