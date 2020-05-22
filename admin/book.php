<?php include 'Auth.php'; ?>

<!DOCTYPE html>
<html>

<?php include 'sections/head.php'; ?>

<body>

    <div id="container">

        <?php include 'sections/side.php'; ?>

        <div class="content" id="content">
            <?php include 'sections/nav.php'; ?>
            <div class="maincontent">


              <?php 

                include_once 'config/db_connect.php';

                $sql="SELECT * FROM book b LEFT JOIN screening s ON s.id = b.screening_id LEFT JOIN cinemahall c ON c.id = s.cinemahall_id LEFT JOIN theater t ON t.cinemahall_id = c.id ORDER BY b.bookID DESC";

                $result=$con->query($sql);
                $book = array();
                if ($result) {
                  while($row=$result->fetch_assoc()){  
                    $book[] = $row;
                  }
                }
                

              ?>

              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
              <div class="container" style="width: auto;">
               <br> 
               <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12" id="users">
                    <div class="panel panel-primary"  style="margin: 20px 20px;">
                      <div class="panel-heading">
                      </div>
                      <div class="panel-body">
                        <ul section="bc" id="suv"  style="float: left; v=background: white;    padding: 8px 15px; margin-bottom: 20px;list-style: none;background-color: #f5f5f5;border-radius: 4px; font-size: 20px;">
                          <li>
                            <a>All Booking</a>
                          </li>
                        </ul>
                        <br><br><br>
                        <table class="table table-bordered">
                          <thead>
                            <th>S.N</th>
                            <th>Token</th>
                            <th>Movie</th>
                            <th>Theater</th>
                            <th>User Email</th>
                            <th>Payment Method</th>
                            <th>Transaction ID</th> 
                            <th>Actions</th>
                          </thead>
                          <?php $i = 0 ?>
                          <tbody>
                            <?php foreach($book as $data) { ?>
                            <?php $i++ ?>
                            <tr class="data<?php echo $data['bookId']; ?>" <?php if($data['status']==0) { ?>  style="background:#eee; color:#333; "  <?php } else{ } ?>  >

                              <td ><?php echo $i; ?></td>

                              <td class="btoken<?php echo $data['bookId']; ?>"><?php echo $data['token']; ?></td>
                              <td class="bmname<?php echo $data['bookId']; ?>"><?php echo $data['movie_name']; ?></td>
                              <td class="btheater<?php echo $data['bookId']; ?>"><?php echo $data['hname']; ?></td>
                              <td class="bemail<?php echo $data['bookId']; ?>"><?php echo $data['email']; ?></td>
                              <td class="bpayment<?php echo $data['bookId']; ?>"><?php echo $data['payment_type']; ?></td>
                              <td class="btid<?php echo $data['bookId']; ?>"><?php echo $data['transaction_id']; ?></td>
                              <td>
                                <span class="details<?php echo $data['bookId']; ?>" style="display: none;"  data-date="<?php echo $data['date']; ?>" data-time="<?php echo $data['time']; ?>" data-phone="<?php echo $data['mobile']; ?>" data-seat="<?php echo $data['ticket_no']; ?>" data-price="<?php echo $data['price']; ?>" data-status="<?php echo $data['status']; ?>"></span>
                                <a href="" class="btn btn-success" id="viewdata"  data-id="<?php echo $data['bookId']; ?>" data-toggle="modal" data-target="#view" style=" border-radius: 0;"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                <a href="" data-toggle="modal" id="deletedata" data-target="#delete" data-id="<?php echo $data['bookId']; ?>" class="btn btn-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>






              </div>  
            </div>


            <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Movie Detail</h4>
                  </div>
                  <div class="modal-body" id="viewmovie">



                   <p itemtype="http://schema.org/Person">Movie Name : 
                    <span itemprop="name" class="moivename" style="font-size: 17px;"> </span></p><br>
                    <p itemtype="http://schema.org/Person">Theater: 
                      <span itemprop="name" class="theatername" style="font-size: 17px;"> </span></p><br>
                      <p itemtype="http://schema.org/Person">Screen: 
                        <span itemprop="name" class="screenname" style="font-size: 17px;"> </span></p><br>
                        <p itemtype="http://schema.org/Person">User Email : 
                          <span itemprop="name" class="email" style="font-size: 17px;"> </span></p><br>
                          <p itemtype="http://schema.org/Person">User Contact No. : 
                            <span itemprop="name" class="phone" style="font-size: 17px;"> </span></p><br>
                            <p itemtype="http://schema.org/Person">Date: 
                              <span itemprop="name" class="date" style="font-size: 17px;"> </span></p><br>
                              <p itemtype="http://schema.org/Person">Time: 
                                <span itemprop="name" class="time" style="font-size: 17px;"> </span></p><br>
                                <p itemtype="http://schema.org/Person">Seat No. : 
                                  <span itemprop="name" class="seat" style="font-size: 17px;"> </span></p><br>

                                  <p itemtype="http://schema.org/Person">Total Price: 
                                    <span itemprop="name" class="price" style="font-size: 17px;"> </span></p><br>


                                    <p itemtype="http://schema.org/Person">Payment Mrthod: 
                                      <span itemprop="name" class="payment" style="font-size: 17px;"> </span></p><br>

                                      <p itemtype="http://schema.org/Person">Transaction ID: 
                                        <span itemprop="name" class="transaction_id" style="font-size: 17px;"> </span></p><br>




                                      </div>

                                    </div>
                                    <!-- /.modal-content --> 
                                  </div>
                                  <!-- /.modal-dialog --> 
                                </div>



                                <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                        <h4 class="modal-title custom_align" id="Heading">Delete Movie</h4>
                                      </div>
                                      <div class="modal-body">

                                       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to remove this Book?</div>

                                     </div>
                                     <div class="modal-footer ">
                                      <button type="button" id="deletes" data-id="" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
                                    </div>
                                  </div>
                                  <!-- /.modal-content --> 
                                </div>
                                <!-- /.modal-dialog --> 
                              </div>






                              <script type="text/javascript">



                                $(document).on('click', '.btn', function(e) {


                                  var id=$(this).attr("data-id");

                                  $("#deletes").attr("data-id",id);



                                });


                              </script>




                              <script type="text/javascript">

                                $(document).on('click', '#deletes', function(e) {
                                  var id=$(this).attr("data-id");

                                  $.ajax({
                                    type: 'POST',
                                    url: 'ajaxedit.php',
                                    data: {bookid: id},
                                    success: function(data) {
                                      $('.data' + id).remove();
                                      $('#delete').modal('hide');
                                    }
                                  });

                                });


                              </script>






                              <script type="text/javascript">



                                $(document).on('click', '.btn', function(e) {
                                  e.preventDefault();


                                  var id=$(this).attr("data-id");

                                  var name=$(".bmname"+id).html();
                                  var theater=$(".btheater"+id).html();
                                  var screen=$(".btheater"+id).html();
                                  var token=$(".btoken"+id).html();
                                  var transaction_id=$(".btid"+id).html();
                                  var email=$(".bemail"+id).html();
                                  var payment=$(".bpayment"+id).html();


                                  var date=$(".details"+id).attr("data-date");
                                  var time=$(".details"+id).attr("data-time");
                                  var seat=$(".details"+id).attr("data-seat");
                                  var price=$(".details"+id).attr("data-price");
                                  var phone=$(".details"+id).attr("data-phone");

                                  var status=$(".details"+id).attr("data-status");




                                  $(".email").html(email);
                                  $(".phone").html(phone);
                                  $(".moivename").html(name);
                                  $(".theatername").html(theater);
                                  $(".screenname").html(screen); 
                                  $(".date").html(date);
                                  $(".time").html(time);    
                                  $(".seat").html(seat);  
                                  $(".price").html(price);  
                                  $(".payment").html(payment);
                                  $(".transaction_id").html(transaction_id); 

                                  if(status==0){


                                   $.ajax({
                                    type: 'POST',
                                    url: 'ajaxedit.php',
                                    data: {
                                      'bookstatusid': id
                                    },
                                    success: function(data) {

                                      $(".data"+id).css('background','white');
                                      $bo=parseInt($(".bookstatus").html());

                                      $now=$bo-1;

                                      if($now==0) {

                                        $(".bookstatus").html($now);
                                        $(".bookstatus").remove();

                                      }     

                                      else{

                                        $(".bookstatus").html($now);

                                      }


                                    }
                                  });



                                 }




                               });

                             </script>














                

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("#menu").click(function(e){
           e.preventDefault();
           $('.sidebar').toggle('slide', { direction: 'left' }, 500);
           $('.content').animate({
            'margin-left' : $('.content').css('margin-left') == '0px' ? '250px' : '0px'
        }, 500);
       });
   </script>


</body>
</html>