<?php
	
	include 'classes/db.php';

	// Create database object
	$db = new Database();

	if(isset($_POST['signup']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];


		if(empty($name) || empty($email) || empty($mobile) || empty($password) || empty($repassword)){

			$errors = "please fill out this fields" ;
			return false;
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
							if($query = $db->create("INSERT INTO users(name,email,mobile,password) VALUES ('$name','$email','$mobile','$password')")){   

								header("Location: index.php");
							}
							else
							{

								echo "<script language=\"JavaScript\">\n";
								echo "alert('error while registering you...');\n";
								echo "window.location='register.php'";
								echo "</script>";

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