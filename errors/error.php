<?php 
	$status = $_SERVER['REDIRECT_STATUS'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Error</title>

	<style type="text/css">
		div{
			margin: 10% 30% ;
		}
		h3{
			font-size: 300%;
		}
		p{
			font-size: 300%;
		}
	</style>

</head>
<body>

	<div>
		<?php 
			if ($status == '404') {?>
				<h3> Error 404 </h3>
				<p>The page cannot be found.</p>
		<?php }
			else if($status == '503'){ ?>
				<h3> Error 503</h3>
				<p>Internal Server Error </p>
		<?php 
			}
		?>
	
	</div>


</body>
</html>