<?php 
	


	require_once('config/stripe.php');

	include 'classes/db.php';

		// Create database object
	$db = new Database();

	session_start();

	if (isset($_SESSION["tmpid"])) {
		
		$tmpid =  $_SESSION["tmpid"];
	}

	if (isset($_SESSION["user"])) {
		
		$userid =  $_SESSION["user"];
	}

	$email = $_POST['email'];
	$mobile = $_POST['mobile'];

	$query = " select * from tmp where id='$tmpid'";
	$result = $db->select($query);
	$book = $result->fetch_assoc();



	$token  = $_POST['stripeToken'];
	$email  = $_POST['stripeEmail'];

	$customer = \Stripe\Customer::create(array(
		'email' => $email,
		'source'  => $token
	));

	$charge = \Stripe\Charge::create(array(
		'customer' => $customer->id,
		'amount'   => 5000,
		'currency' => 'usd'
	));


	$token= $charge['id'];
	$transaction_id=substr($charge->id,-5);
	$user_id = $userid;
	$user_type="Register";
	$movie_id=$book['movie_id'];
	$theater_id=$book['theater_id'];
	$screening_id=$book['screening_id'];
	$ticket=$book['ticket'];
	$ticket_no=$book['ticket_no'];
	$price=$book['price'];
	$payment_type="credit/Debit card";
	$email=$email;
	$mobile=$mobile;	


	$query = "INSERT INTO book(user_type,user_id, movie_id, theater_id, screening_id, ticket, ticket_no, price, token, transaction_id, payment_type, email, mobile ) VALUES ('$user_type','$user_id','$movie_id','$theater_id','$screening_id', '$ticket', '$ticket_no', '$price' , '$token' , '$transaction_id' , '$payment_type' , '$email' , '$mobile' )";

	$result = $db->create($query);

	
	$sql = "DELETE FROM tmp WHERE id='$tmpid'";
	$db->delete($sql);

	$_SESSION["bookid"] = $result;
	header("Location: booked.php");
	
	
 ?>