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

                if (isset($_GET['id'])) {
                  $id = $_GET['id'];
                }


                $sql="select * from theater where cinemahall_id='$id' ORDER BY id DESC";
                $result=$con->query($sql);
                $screens = array();
                if ($result) {
                  while($row=$result->fetch_assoc()){  
                    $screens[] = $row;
                  }
                }
                
              ?>


              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
             
              <div class="container" style="width: auto;">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12" id="users">
                      <div class="panel panel-primary"  style="margin: 20px 20px;">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">

                         <ul section="bc" id="suv" >
                          <li>
                            <a href="theater.php">Theater</a>
                          </li>
                        </ul>

                        <ul section="bc" id="suv" >
                          <li>
                            <a>Screen</a>
                          </li>
                        </ul>

                        <a href="addscreens.php?id=<?php echo $id ?>" class="new" style="float: right; margin-right: 10px;">
                          <span class="glyphicon glyphicon-plus"></span> Screen
                        </a>


                        <br><br><br>

                        <table class="table table-bordered">
                          <thead>
                            <th>S.N</th>
                            <th>Screen Name</th>
                            <th>Toatl Seats</th>
                            <th>Seat Distribution</th>
                            <th>Schedule</th>
                            <th>Actions</th>
                          </thead>
                          <tbody>
                            <?php $i = 0 ;
                            foreach($screens as $data) { ?>
                            <tr class="data<?php echo $data['id']; ?>">
                              <?php $i++ ?>
                              <td><?php echo $i; ?></td>
                              <td class="sname<?php echo $data['id']; ?>"><?php echo $data['tname']; ?></td>
                              <td class="sseat<?php echo $data['id']; ?>"><?php echo $data['total_seat']; ?> </td>
                              <td> <a href="seatdistribution.php?id=<?php echo $data['id']; ?>" class="view">View Distribution</a> </td>
                              <td><a href="show.php?id=<?php echo $data['id']; ?>" class="view">View Schedule</a> </td>                
                              <td>
                                <input type="hidden" class="cinema" value="<?php echo $data['id']; ?>" name="">
                                <a href="" class="btn btn-success" id="viewdata"  data-id="<?php echo $data['id']; ?>" data-toggle="modal" data-target="#view" style=" border-radius: 0;"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>


                                <a href="" data-toggle="modal" data-target="#edit" class="btn btn-primary" style="border-radius: 0;" data-id="<?php echo $data['id']; ?>" data-name="<?php echo $data['tname']; ?>" data-seat="<?php echo $data['total_seat']; ?>"><span class="glyphicon glyphicon-pencil"> </span></a>


                                <a href="" data-toggle="modal" id="deletedata" data-target="#delete" data-id="<?php echo $data['id']; ?>" class="btn btn-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>

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



            <!-- /.View --> 
            <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Screen Detail</h4>
                  </div>
                  <div class="modal-body" id="viewmovie">

                   <p itemtype="http://schema.org/Person">Screen Name : 
                    <span itemprop="name"   class="screenname" style="font-size: 15px;"> </span></p><br>
                    <p itemtype="http://schema.org/Person">Total Seat: 
                      <span itemprop="name"   class="screenseat"  style="font-size: 15px;"> </span></p><br>

                    </div>

                  </div>
                  <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
              </div>





















              <!-- /.Edit --> 
              <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                      <h4 class="modal-title custom_align" id="Heading">Edit Movie Detail</h4>
                    </div>
                    <div class="modal-body">

                      <label for="email">Screen Name : </label>
                      <div class="form-group">
                        <input class="form-control "  id="name" value="" type="text" >
                      </div>

                      <label for="email">Total Seat : </label>
                      <div class="form-group">
                        <input class="form-control " id="seat" value="" type="text" >
                      </div>

                    </div>
                    <div class="modal-footer ">
                      <input type="submit" data-id=""  id="submits" class="btn btn-warning btn-lg" style="width: 100%;">
                    </div>
                  </div>
                  <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
              </div>











              <!-- /.Delete -->

              <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                      <h4 class="modal-title custom_align" id="Heading">Delete Movie</h4>
                    </div>
                    <div class="modal-body">

                     <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Movie?</div>

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


              $(document).ready(function(){

                $(document).on('click', '.btn', function(e) {

                  var id=$(this).attr("data-id");
                  var name=$(this).attr("data-name");
                  var seat=$(this).attr("data-seat");

                  $("#name").val(name);
                  $("#seat").val(seat);

                  $("#submits").attr("data-id",id);







                });


              });



            </script>



            <script type="text/javascript">



              $(document).on('click', '.btn', function(e) {
                e.preventDefault();


                var id=$(this).attr("data-id");

                var name=$(".sname"+id).html();
                var seat=$(".sseat"+id).html();


                $(".screenname").html(name);
                $(".screenseat").html(seat);


              });

            </script>







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
                  data: {
                    'screenid': id
                  },
                  success: function(data) {
                    $('.data' + id).remove();
                    $('#delete').modal('hide');
                  }
                });

              });


            </script>





          </script>

          <script type="text/javascript">

            $(document).on('click', '#submits', function(e) {
              e.preventDefault();


              var name=$("#name").val();
              var seat=$("#seat").val();
              var id=$(this).attr('data-id');



              $.ajax({
                type: 'POST',
                url: 'ajaxedit.php',
                data: {
                  'screeneditid': id,'name':name,'seat':seat
                },
                success: function(data) {

                  $(".sname"+id).html(name); 
                  $(".sseat"+id).html(seat);

                  $('#edit').modal('hide');
                  return false;
                }
              });
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