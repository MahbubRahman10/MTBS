<?php 
		
		include_once 'config/db_connect.php';

		$sql="select count(*) as total from message where status = '0'";
		$result=$con->query($sql);
		$row=$result->fetch_assoc();
		$messagestatus = $row['total'];

		$sql="select count(*) as total from book where status = '0'";
		$result=$con->query($sql);
		$row=$result->fetch_assoc();
		$status = $row['total'];


?>


<div class="sidebar" id="sidebar">
	<h4 class="logo"><a href="" style="color: white; font-weight: 700">Housefull<span style="color: orange; font-weight: 700">BD</span></a></h4>
	<ul id="nav">
		<li><a  <?php if($_SERVER['REQUEST_URI'] == '/mvc/admin/index.php') { ?>  class="selected" <?php } ?>  href="index.php"><i class="fa fa-tachometer"></i>   Dashboard</a></li>
		<li><a <?php if($_SERVER['REQUEST_URI'] == '/mvc/admin/admin.php') { ?> class="selected" <?php  } elseif($_SERVER['REQUEST_URI'] == 'http://localhost:8000/admin/viewadmin') {  ?> class="selected" <?php } elseif($_SERVER['REQUEST_URI'] === 'http://localhost:8000/admin/slide')  { ?> class="selected" <?php } else  { ?> class="csc" <?php } ?>  href="admin.php"><i class="glyphicon glyphicon-user"> </i>  Admin</a></li>

		<li><a <?php if($_SERVER['REQUEST_URI'] === '/mvc/admin/message.php'){ ?> class="selected" <?php } ?>  href="message.php"> <i class="fa fa-envelope-open" aria-hidden="true"></i> Message(s) <?php if($messagestatus>0) { ?> <span class="messagestatus" style="float: right; background:  #6FB3E0; padding: 4px 10px;  font-weight: 700; color: white; border-radius: 10%;"><?php echo $messagestatus; ?></span> <?php  } ?></a></li>
		
		<li><a <?php if($_SERVER['REQUEST_URI'] === '/mvc/admin/user.php') { ?> class="selected" <?php } ?> href="user.php"><i class="fa fa-users" aria-hidden="true"></i> Users</a></li>
		<li><a <?php if($_SERVER['REQUEST_URI'] === '/mvc/admin/movie.php') {  ?> class="selected" <?php } elseif($_SERVER['REQUEST_URI'] === 'http://localhost:8000/admin/movie/upcoming') { ?> class="selected" <?php } elseif($_SERVER['REQUEST_URI'] === 'http://localhost:8000/admin/addmovie') { ?> class="selected" <?php } elseif($_SERVER['REQUEST_URI'] === 'http://localhost:8000/admin/addupcomingmovie') { ?> class="selected" <?php } else  { ?> class="csc" <?php } ?> href="movie.php"><i class="fa fa-film" ></i> Movie</a></li>
		

		<?php $ip=$_SERVER['REQUEST_URI'];  $words = preg_replace('/[0-9]+/', '', $ip); ?>


		<li><a <?php if($_SERVER['REQUEST_URI'] === '/mvc/admin/theater.php') { ?>  class="selected"  <?php } elseif($_SERVER['REQUEST_URI'] === 'http://localhost:8000/admin/addtheater') { ?>  class="selected" <?php } elseif($words== 'http://localhost:/admin/screens/') { ?>  class="selected" <?php } elseif($words== 'http://localhost:/admin/addscreens/') { ?> class="selected" <?php } elseif($words== 'http://localhost:/admin/seatdistribution/') { ?> class="selected" <?php } elseif($words== 'http://localhost:/admin/addseatcategory/') { ?> class="selected" <?php } elseif($words== 'http://localhost:/admin/seat/') { ?>  class="selected" <?php } elseif($words== 'http://localhost:/admin/addseat/') {?>  class="selected" <?php } elseif($words== 'http://localhost:/admin/show/') { ?>  class="selected" <?php } elseif($words== 'http://localhost:/admin/addshow/') {?>  class="selected" <?php } else {?>  class="csc" <?php } ?> href="theater.php"><i class="fa fa-television"></i> Theater </a> </li>
		

		<li><a <?php if($_SERVER['REQUEST_URI'] === '/mvc/admin/book.php') { ?> class="selected" <?php }  ?> href="book.php"> <i class="fa fa-ticket" aria-hidden="true"></i> Book <?php if($status>0) { ?> <span class="bookstatus" style="float: right; background:  #6FB3E0; padding: 1px 10px;  font-weight: 700; color: white; border-radius: 10%;"><?php echo $status; ?></span> <?php }?></a></li>
		<li><a href="adminlogout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>	
	</ul>
</div>