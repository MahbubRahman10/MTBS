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

                $sql="select * from users where isAdmin = '1'";
                $result=$con->query($sql);
                $admins = array();
                if ($result) {
                  while($row=$result->fetch_assoc()){  
                    $admins[] = $row;
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
                         <ul section="bc" id="suv"  style="float: left; v=background: white;    padding: 8px 15px; margin-bottom: 20px;list-style: none;background-color: #f5f5f5;border-radius: 4px; font-size: 20px;">
                          <li>
                            <a>All Admin</a>
                          </li>
                        </ul>
                        <br><br><br>
                        <table class="table table-bordered">
                          <thead>
                            <th>S.N</th>
                            <th>Admin Name</th>
                            <th>Admin Email</th>
                            <th>Role</th>
                          </thead>
                          <tbody>
                            <?php $i = 0; 
                            foreach($admins as $data) { ?>
                            <tr class="data{{$data->id}}">
                              <?php $i++ ?>
                              <td><?php echo $i; ?></td>
                              <td class="uname<?php echo $data['id']; ?>"><?php echo $data['name']; ?></td>
                              <td class="uemail<?php echo $data['id']; ?>"><?php echo $data['email']; ?></td>
                              <td class="umobile<?php echo $data['id']; ?>"><?php echo $data['role']; ?> </td>
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












            <!-- /.Delete -->

            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">Delete Movie</h4>
                  </div>
                  <div class="modal-body">

                   <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure want to remove this User?</div>

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
                type: 'get',
                url: '/admin/deleteUser',
                data: {
                  'id': id
                },
                success: function(data) {
                  $('.data' + id).remove();
                  $('#delete').modal('hide');
                }
              });

            });


          </script>





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