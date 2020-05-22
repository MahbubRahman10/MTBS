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

        $sql="select * from cinemahall ORDER BY id DESC";
        $result=$con->query($sql);
        $theater = array();
        if ($result) {
          while($row=$result->fetch_assoc()){  
            $theater[] = $row;
          }
        }
        

        ?>


        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <div class="container" style="width: auto;">
         <br> 
         <div class="col-md-12">
          <div class="row">
            <div class="col-md-11" id="users">
              <div class="panel panel-primary"  style="margin: 20px 20px;">
                <div class="panel-heading">
                </div>
                <div class="panel-body">
                  <ul section="bc" id="suv" >
                    <li>
                      <a>All Theater</a>
                    </li>
                  </ul>


                  <a href="addtheater.php" class="new" style="float: right; margin-right: 10px;">
                    <span class="glyphicon glyphicon-plus"></span> Theater 
                  </a>
                  
                  <br><br><br>

                  <table class="table table-bordered">
                    <thead>
                      <th>S.N</th>
                      <th>Theater Name</th>
<!--                       <th>Theater Location</th> -->
                      <th>City</th>  
                      <th>Screens</th>

                      <th>Actions</th>
                    </thead>
                    <tbody>
                      <?php $i = 0; 
                      foreach($theater as $data){ ?>
                      <tr class="data<?php echo $data['id']; ?>">
                        <?php $i++ ?>
                        <td><?php echo $i ?></td>
                        <td class="tname<?php echo $data['id']; ?>"> <?php echo $data['hname']; ?> </td>
                        <td style="display: none;" class="tlocation<?php echo $data['id']; ?>"> <?php echo $data['location']; ?> </td>
                        <td class="tcity<?php echo $data['id']; ?>"> <?php echo $data['city']; ?> </td>
                        <td style="display: none;" class="tphone<?php echo $data['id']; ?>"> <?php echo $data['phone']; ?> </td> 
                        <td><a href="screens.php?id=<?php echo $data['id']; ?>" class="view">View Screens</a></td>

                        <td>

                         <a href="" class="btn btn-success" id="viewdata"  data-id="<?php echo $data['id']; ?>" data-toggle="modal" data-target="#view" style=" border-radius: 0;"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>


                         <a href="" data-toggle="modal" data-target="#edit" class="btn btn-primary" style="border-radius: 0;" data-id="<?php echo $data['id']; ?>" data-name="<?php echo $data['hname']; ?>" data-location="<?php echo $data['location']; ?>" data-city="<?php echo $data['city']; ?>" data-phone="<?php echo $data['phone']; ?>"><span class="glyphicon glyphicon-pencil"> </span></a>


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
            <h4 class="modal-title custom_align" id="Heading">Theater Detail</h4>
          </div>
          <div class="modal-body" id="viewmovie">

           <p itemtype="http://schema.org/Person">Theater Name : 
            <span itemprop="name" class="theatername" style="font-size: 15px;"> </span></p><br>
            <p itemtype="http://schema.org/Person">Location: 
              <span itemprop="name" class="theaterlocation"  style="font-size: 15px;"> </span></p><br>

              <p itemtype="http://schema.org/Person">City: 
                <span itemprop="name" class="theatercity"  style="font-size: 15px;"> </span></p><br>

                <p itemtype="http://schema.org/Person">Contact Number: 
                  <span itemprop="name" class="theaterphone"  style="font-size: 15px;"> </span></p><br>





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

            <label for="email">Theater Name : </label>
            <div class="form-group">
              <input class="form-control "  id="name" value="" type="text" >
            </div>

            <label for="email">Location : </label>
            <div class="form-group">
              <input class="form-control " id="location" value="" type="text" >
            </div>

            <label for="email">City : </label>
            <div class="form-group">
              <input class="form-control " id="city" value="" type="text" >
            </div>

            <label for="email">Contact Number : </label>
            <div class="form-group">
              <input class="form-control "  id="phone" value="" type="text" >
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
        var location=$(this).attr("data-location");
        var city=$(this).attr("data-city");
        var phone=$(this).attr("data-phone");


        $("#name").val(name);
        $("#location").val(location);
        $("#city").val(city);
        $("#phone").val(phone);


        $("#submits").attr("data-id",id);







      });


    });



  </script>



  <script type="text/javascript">



    $(document).on('click', '.btn', function(e) {
      e.preventDefault();


      var id=$(this).attr("data-id");

      var name=$(".tname"+id).html();
      var location=$(".tlocation"+id).html();
      var city=$(".tcity"+id).html();
      var phone=$(".tphone"+id).html();
      


      $(".theatername").html(name);
      $(".theaterlocation").html(location);
      $(".theatercity").html(city);
      $(".theaterphone").html(phone); 



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
          'theaterid': id
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
    var location=$("#location").val();
    var city=$("#city").val();
    var phone=$("#phone").val();  
    var id=$(this).attr('data-id');



    $.ajax({
      type: 'POST',
      url: 'ajaxedit.php',
      data: {
        'theatereditid': id,'name':name,'location':location,'city':city,'phone':phone
      },
      success: function(data) {

        $(".tname"+id).html(name); 
        $(".tlocation"+id).html(location); 
        $(".tcity"+id).html(city); 
        $(".tphone"+id).html(phone); 

        $('#edit').modal('hide');
        return false;
      }
    });







  });


</script>









<script type="text/javascript">

  $(document).ready(function(){
   $("#search").on("input",function ()  {


     var str=  $("#search").val();

     $.ajax({

      type: 'get',
      url: '/TheaterSearch',
      dataType:'JSON',
      data:{'search':str},

      success:function(data){

       if(data===''){



       }
       else{
        $('tbody').html(data);
      }


    }

  });



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