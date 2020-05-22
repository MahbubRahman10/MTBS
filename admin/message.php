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

                $sql="select * from message ";
                $result=$con->query($sql);
                $message = array();
                if ($result) {
                  while($row=$result->fetch_assoc()){  
                    $message[] = $row;
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
                            <a>All Message</a>
                          </li>
                        </ul>
                        <br><br><br>

                        <table class="table table-bordered">
                          <thead>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                          </thead>
                          <?php $i = 0 ?>
                          <tbody>
                            <?php foreach($message as $data) { ?>
                            <?php $i++ ?>
                            <tr class="data<?php echo $data['id']; ?>" <?php if($data['status']==0){ ?>  style="background:#eee; color:#333; "  <?php } else{ }  ?> >

                              <td ><?php  echo $i; ?></td>

                              <td class="maname<?php echo $data['id']; ?>"><?php echo $data['name']; ?></td>
                              <td class="memail<?php echo $data['id']; ?>"><?php echo $data['email']; ?></td>


                              <td>
                                <span class="details<?php echo $data['id']; ?>" style="display: none;"  data-date="<?php echo $data['created_at']; ?>"  data-description="<?php echo $data['message']; ?>" data-status="<?php echo $data['status']; ?>"></span>

                                <a href="" class="btn btn-success" id="viewdata"  data-id="<?php echo $data['id']; ?>" data-toggle="modal" data-target="#view" style=" border-radius: 0;"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
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




            <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Message</h4>
                  </div>
                  <div class="modal-body" id="viewmovie">



                   <p itemtype="http://schema.org/Person">Name : 
                    <span itemprop="name" class="username" style="font-size: 17px;"> </span></p><br>

                    <p itemtype="http://schema.org/Person">Email: 
                      <span itemprop="name" class="useremail" style="font-size: 17px;"> </span></p><br>

                      <p itemtype="http://schema.org/Person">Message: 
                        <span itemprop="name" class="usermessage" style="font-size: 17px;"> </span></p><br>

                        <p itemtype="http://schema.org/Person">Date : 
                          <span itemprop="name" class="date" style="font-size: 17px;"> </span></p><br>





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

                         <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to remove this Message?</div>

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
                      data: { msgid : id },
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

                    var name=$(".mname"+id).html();
                    var email=$(".memail"+id).html();


                    var message=$(".details"+id).attr("data-description");
                    var date=$(".details"+id).attr("data-date");


                    var status=$(".details"+id).attr("data-status");


                    $(".username").html(name);
                    $(".useremail").html(email);
                    $(".usermessage").html(message);
                    $(".date").html(date);

                    if(status==0){

                     $.ajax({
                      type: 'POST',
                      url: 'ajaxedit.php',
                      data: {
                        'messagestatusid': id
                      },
                      success: function(data) {

                        $(".data"+id).css('background','white');
                        $bo=parseInt($(".messagestatus").html());

                        $now=$bo-1;

                        if($now==0) {

                          $(".messagestatus").html($now);
                          $(".messagestatus").remove();

                        }     

                        else{

                          $(".messagestatus").html($now);

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