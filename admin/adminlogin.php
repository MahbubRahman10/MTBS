
	<?php 

		$errors = '';
		session_start();
		ob_start();

		if (isset($_SESSION['admin'])) {
			header('location: index.php');
		}

		include_once 'config/db_connect.php';

		$errors = null;

		if(isset($_POST['signin']))
		{
			$email = $_POST['email'];
			$password = $_POST['password'];

			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$query = "SELECT * FROM users WHERE email='$email' and isAdmin='1'";
			$result=$con->query($query);
			$row=$result->fetch_assoc();
			$count = $result->num_rows;	


			if($count == 1 && password_verify($password, $row['password'])){
					header("Location: index.php");
					$_SESSION['admin'] = $row['id'];
			}
			else{
				$errors = "Email or Password was incorrect!";
			}

		}



	?>


<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<title>HousefullBD Admin</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background: #eee;">


	<div class="container" >
		<div class="col-md-4 col-md-offset-4" style="background: white; margin-top:100px;padding: 50px 20px; box-shadow: 0 2px 4px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12)!important">
			<div style="margin-left: 36%;"><i class="fa fa-lock" style="font-size: 70px; background: #495057; padding: 20px 30px; border-radius: 50%; color: white;"></i></div>
			<h1 style="text-align: center; font-family: 'Stencil Std', fantasy;">ADMIN</h1>			
			<span class="help-block" style="text-align: center;">
				<strong style="color: red; "> <?php echo $errors; ?> </strong>
			</span>
			<br>
			<form method="POST" action="">
				<div class="form-group">
					<input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
					
				</div> <br>
				<div class="form-group">
					<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				</div><br>
				<button type="submit" name="signin" class="btn btn-primary" style="margin-left: 36%; font-weight: bold; font-size: 15px; text-transform: uppercase;">Submit</button>
			</form>
		</div>
	</div>

</body>
</html>