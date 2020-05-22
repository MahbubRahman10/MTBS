<html>
	<head>
	      <title>HousefullBD</title>
	      <link rel="icon" type="image/png" href="/img/film-reel.png">
	      <?php include 'sections/head.php'; ?> 

	</head>
	<body>
 	
		<?php ob_start(); include 'sections/nav.php'; ?>
		<?php 
			$msg = $error = null;
			if(isset($_POST['submit']))
			{
				$db = new Database();

				$email = $_POST['email'];
				if (empty($email)) {
					$error = "Please fill out this filed";
				}
				else{
					$query = "SELECT * FROM users WHERE email='$email'";
					$result = $db->select($query);
					if ($result) {
						$row=$result->fetch_assoc();
						$id = $row['id'];
						// Generate Token
						$token = bin2hex(random_bytes(5));
						// Set token
						$sql = "UPDATE users SET email_token='$token' WHERE id=$id";
						$result = $db->update($sql);

						$name = $row['name'];
						$mail = sendmail($token,$name,$email);
						if ($mail == true) {
							$msg = "Check your mail for reset Password!";
						}
					}
					else{
						$error = "This email is not found";
					}
				}
			}

			// function for send mail
			function sendmail($token,$name,$to)
			{
				$body ="<table  width=100% border=0><tr>";
				$body .="<td style=position:absolute;left:350;top:60;><h2><font color = #346699>HousefullBD</font><h2></td></tr>";
				$body .='<tr><td colspan=2><br/><br/><br/><strong>Dear '.$name.',</strong></td></tr>';
				$body .= '<tr><td colspan=2><br/><font size=3>We received an account recovery request for '.$to.'.</font><br/><br/></td></tr>';
				$body .= '<tr><td colspan=2><br/>If you initiated this request, then<br/><a href="/mvc/passwordreset.php?token='.$token.'" target="_blank">click this link to reset your password.</a></td></tr>';
				$body .= '<tr><td colspan=2><br/><br/>Best regards,<br>HousefullBD</td></tr></table>';
				$subject = "Forgot Password";


				$from='admin@HousefullBD.com';      
				$headersfrom='';
				$headersfrom .= 'MIME-Version: 1.0' . "\r\n";
				$headersfrom .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headersfrom .= 'From: '.$from.' '. "\r\n";
			 	mail($to,$subject,$body,$headersfrom);

			 	return true;
			}
		?>

		<div class="container" style="margin-top: 5%; margin-bottom:5%;">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading">Reset Password</div>
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
										<span><strong>E-Mail : </strong></span><br><br>
										<input id="email" type="email" class="form-control" name="email" value="" required>
										<span class="help-block">
											<strong style="color: red;"> <?php echo $error; ?> </strong>
										</span>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" name="submit" class="btn btn-primary">
											Send Password Reset Link
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>      
	<?php include 'sections/footer.php'; ?>
</html>