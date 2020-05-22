<html>
	<head>
	      <title>HousefullBD</title>
	      <link rel="icon" type="image/png" href="/img/film-reel.png">
	      <?php include 'sections/head.php'; ?> 

	</head>
	<body>
 	
		<?php ob_start(); include 'sections/nav.php'; ?>
		<?php  include 'sections/Auth.php'; ?> 

		<!-- PHP Script for Show Moive -->
		<?php
			use Carbon\Carbon;
			$now = Carbon::now()->format('Ymd');

			if (isset($_GET['id'])) {
				$id = $_GET['id'];
			}

			// Create database object
			$db = new Database();

			// Query for fetch data from Screening Table
			$query = " select * from screening where id=$id";
			$result = $db->select($query);
			$screen = $result->fetch_assoc();

			$mid = $screen['movie_id'];
			$tid = $screen['theater_id'];

			// Query for fetch data from Moives Table
			$query = " select * from movies where id=$mid";
			$mresult = $db->select($query);
			$viewmovie = $mresult->fetch_assoc();

			// Query for fetch data for show Theater and screening time
			$query = " select * from cinemahall INNER JOIN theater on cinemahall.id = theater.cinemahall_id where theater.id=$tid";
			$ctresult = $db->select($query);
			$hallTh = array();
			if($ctresult){
					while ($data = $ctresult->fetch_assoc()) {
						$hallTh[] = $data;
					}	
			}

			// Query for fetch data from seatdistribution Table
			$query = " select * from seatdistribution where theater_id=$tid";
			$sdresult = $db->select($query);
			$seatdistribution = array();
			if($sdresult){
				while ($data = $sdresult->fetch_assoc()) {
					$seatdistribution[] = $data;
				}	
			}


			// Query for fetch data from Book Table
			$query = " select * from book where screening_id=$id";
			$bresult = $db->select($query);
			$booked = array();
			if ($bresult) {
				while ($data = $bresult->fetch_assoc()) {
					$booked[] = $data;
				}
			}

			// Query for fetch data from tmp Table
			$tmp = array();
			$query = " select * from tmp";
			$tmpresult = $db->select($query);
			if ($tmpresult) {
				while ($data = $tmpresult->fetch_assoc()) {
					$tmp[] = $data;
				}
			}

			// if tmp has value then add tmp ticket no in imditems array
			if(count($tmp)>0){
				$imditems = array();
				for ($i=0; $i <count($tmp) ; $i++) {             	
					$imditems[$i]=$tmp[$i]['ticket_no'];
				}
			}

			// if booked has value then add booked ticket no in items array
			if(count($booked)>0){
	            $items = array();
	            for ($i=0; $i <count($booked) ; $i++) {             	
	            	$items[$i]=$booked[$i]['ticket_no'];
	            }
	            // if tmp has value, Merge imditems(tmp) and items(booked) array
	            if(count($tmp)>0){
	            	$finalitems=array_merge($items,$imditems);
	            }
	            else{
	            	$finalitems=$items;
	            }       
	            foreach ($finalitems as $key) {
	            	 $var= implode(',', $finalitems);
	            }
		        $myArray = explode(',', $var);
	    	}
	    	else{
	    		$myArray=explode(',', "no booked");;
	    	}



	    	// Query for fetch data from Seat table for show Seat
	    	$query = " select * from seat where theater_id=$tid";
	    	$sresult = $db->select($query);
	    	$seattmp = array();
	    	$seat = array();
	    	if($sresult){
	    		while ($data = $sresult->fetch_assoc()) {
	    			$seattmp[] = $data;
	    		}	
				// make unique Cinemal hall
	    		foreach ($seattmp as &$value) {
	    			if (!isset($seat[$value['type']]))
	    				$seat[$value['type']] =& $value;
	    		}
	    	}
		?>
		<br><br><br>

		<div class="container" style="">
			<div class="col-md-9" style=" max-height: 1000px;overflow-y: scroll;">
				<hr>
				<center>
					<h4 style="display: inline-block; padding: 0px 15px;"><span style="color: black; border-color:#eee; border:1px; border-style:solid; border-color:#757575; padding: 2px 10px; margin-right: 10px;"></span> Avaiable</h4>
					<h4  style="display: inline-block;"><span style="color: white;border:1px; border-style:solid; border-color:#eee; padding: 2px 10px; margin-right: 10px; background:#757575; " ></span>  Booked</h4>
				</center>
				<hr> <br>
				<?php foreach ($seat as $key => $seats) { 
						  foreach ($seatdistribution as $key => $seatdistributions) {
						  	if ($seatdistributions['id'] == $seats['seatdistributon_id']) { ?>
								<h4 style="text-align: center;"> <?php echo $seats['type']; ?> | Tk.<span class="price"><?php echo $seatdistributions['price']; ?></span> </h4>
						<?php 	 
						?>
				<hr><br>
				<table>
					<?php foreach ($seattmp as $key => $seattmps) { ?>
					<tbody class="sss" >
						<tr>
								<?php if ($seats['type'] == $seattmps['type'] ){ ?>
								<th style="padding: 9px 20px; font-size: 20px;"><?php echo $seattmps['row']; ?></th>
								<?php for($j=1; $j <= $seattmps['number']; $j++) { 

								$y=$seattmps['row']; $z=$j;  $add="$y$z"; 
								if(in_array($add, $myArray)) { ?>
								<td style="padding: 00px 10px; font-size: 20px;"> <a style="color: white;border:1px; border-style:solid; border-color:#eee; padding: 6px 10px; background:#757575; " class="" ><?php echo $j; ?></a></td>
								<?php } else { ?>
								<td style="padding: 00px 10px; font-size: 20px;"> <a href="" id="seatcol<?php echo $seattmps['row']; echo $j; ?>"  style="color: black; border-color:#eee; border:1px; border-style:solid; border-color:#757575; padding: 6px 10px;" class="ssss" id="<?php echo $seattmps['row']; echo $j; ?>" data-seat="<?php echo $seattmps['row']; echo $j; ?>" data-price="<?php echo $seatdistributions['price']; ?>" status="0" > <?php echo $j; ?></a></td>
								
							<?php } } } } }	?>
							</p>				
						</tr>
					</tbody>
					<?php } ?>
				</table>	
				<br>
				<?php } ?>
			</div>
			<div class="col-md-3">
				<?php foreach($hallTh as $data) { ?>
				<h2> <?php echo $screen['movie_name'] ?> </h2>
				<p> <?php echo $viewmovie['language'] ?> | <?php echo $viewmovie['genres'] ?> </p>
				<hr>
				<p>Theater</p>
				<h3><?php echo $data['hname'] ?> </h3>
				<h4><?php echo $data['tname'] ?> </h4>
				<h4><?php echo $data['location'] ?> </h4>
				<br>
				<br>
				<p>Showtime</p>
				<h4><?php  echo Carbon::parse($screen['date'])->format('D, d-m-Y ');    echo $screen['time']; ?></h4>
				<?php } ?>
				<hr>
				<ul class="booked" style="list-style: none; padding: 10px 10px;"></ul>
				<h4><span class="seat">0</span> Seat(s) <p style="padding: 0px 20px; display: inline-block; color: #f48024;">Tk. <span class="total">0</span></p></span></h4>
				<hr>
				<form method="post" action="confirmbook.php?id=<?php echo $screen['id']; ?>&name=<?php echo $screen['movie_name']; ?>">
					<input type="submit" name="submit" class="btn btn-primary" value="Continue"> 
					<input type="hidden" class="conseat" name="seat" value="">
					<input type="hidden" name="ticket" class="conticket" value="">
					<a  style="display: inline-block;
					padding: 6px 12px;
					margin-bottom: 0;
					font-size: 14px;
					font-weight: 400;
					line-height: 1.42857143;
					text-align: center;
					white-space: nowrap;
					vertical-align: middle;
					-ms-touch-action: manipulation;
					touch-action: manipulation;
					cursor: pointer;
					-webkit-user-select: none;
					-moz-user-select: none;
					-ms-user-select: none;
					user-select: none;
					background-image: none;
					border: 1px solid transparent;
					border-radius: 4px;background: #d9534f; color: white;text-decoration: none;" href="\">Cancel</a>
				</form>
			</div>
		</div>
		<br><br><br><br><br><br><br>
	    <?php include 'sections/footer.php'; ?>      
 
		<script type="text/javascript">
		 	$(document).ready(function(){

				var i;
				$(".ssss").click(function (e) {
			  		e.preventDefault();

			  		var id=$(this).attr("data-seat");
			  		var price=parseInt($(this).attr("data-price"));
			  		var status=$(this).attr("status");
			  		var m=$('.seat').html();
			  		var n=$('.total').html();
			  		var seat=parseInt(m);
			  		var total=parseInt(n);
			  		var datas=$('.conseat').val();

					var ids=id+',';
					

					if(datas.indexOf(id) == -1){
						 
			            var vals=$('.conseat').val();
			            var sp = vals+ids;
						$('.conseat').val(sp);
					}
					else{
			
						var s=id+',';
						datas = datas.replace(s,'');		
						$('.conseat').val(datas);
					}
			       	
			       	if(status==0){
			       	 	$("#seatcol"+id).css("background","#008080");
		    	   	 	$("#seatcol"+id).css("border-color","#008080");
		       		 	$("#seatcol"+id).css("color","white");
					
						$(this).attr("status","1");
						$(".booked").append('<li id=con'+ id +'>'+ id +'</li>');
						var total_seat=seat+1;
		    	   		$('.seat').html(total_seat);
						var total_price=total+price;
		    	   		$('.total').html(total_price);
		       			$('.conticket').val(total_price);
		       	 	}
		       	 	else{

		       	 		$("#seatcol"+id).css("background","white");
		       	 		$("#seatcol"+id).css("border-color","#757575");

		       	 		$("#seatcol"+id).css("color","black");
						$(this).attr("status","0");

						$('#con'+id).remove();

						var total_seat=seat-1;
			       		$('.seat').html(total_seat);

						var total_price=total-price;
		       	 		$('.total').html(total_price);
		       	 		$('.conticket').val(total_price);
		       		}
				});

			});
		</script>

		<script type="text/javascript">
	
			$(function(){
				$('.btn').click(function(event){
				var m=parseInt($('.seat').html());
				if (m===0) {
				    event.preventDefault();
				    alert("Please select a seat")
				}
				});

			});
		</script>
	</body>      
</html>