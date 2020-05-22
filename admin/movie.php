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

                $sql="select * from movies ORDER BY id DESC";
                $result=$con->query($sql);
                $movie = array();
                if ($result) {
                  while($row=$result->fetch_assoc()){  
                    $movie[] = $row;
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
                            <a>All Movie</a>
                          </li>
                        </ul>

                        <ul  section="bc" id="suv" >
                          <li>
                            <a href="upcomingmovie.php">Upcoming Movie</a>
                          </li>
                        </ul>

                        <a href="addmovie.php" class="new" style="float: right; margin-right: 10px;">
                          <span class="glyphicon glyphicon-plus"></span> Movie 
                        </a>

                        <br><br><br>

                        <table class="table table-bordered">
                          <thead>
                            <th>S.N</th>
                            <th>Movie Title</th>
                            <th>Movie Director</th>
                            <th>Movie Genre</th>
                           <!--  <th>IMDB Rating</th> -->
                            <!-- <th>Relase</th> -->
                            <th>Actions</th>
                          </thead>
                          <?php $i = 1 ?>
                          <tbody>

                            <?php foreach($movie as $data) { ?>

                            <tr class="data<?php echo $data['id']; ?>">

                              <td><?php echo $i++ ?></td>
                              <td class="mname<?php echo $data['id']; ?>" > <?php echo $data['name']; ?></td>
                              <td class="mdirector<?php echo $data['id']; ?>"><?php echo $data['director']; ?></td>
                              <td class="mgenres<?php echo $data['id']; ?>"><?php echo $data['genres']; ?></td>
                              <td style="display: none;" class="mimdb<?php echo $data['id']; ?>"><?php echo $data['imdbRating']; ?></td>
                              <td style="display: none;"> class="mdate<?php echo $data['id']; ?>"><?php echo $data['relaseDate']; ?></td>                  
                              <td>
                                <span class="details<?php echo $data['id']; ?>" style="display: none;" data-cast="<?php echo $data['cast']; ?>" data-poster="\<?php echo $data['poster']; ?>"   data-musicDirector="<?php echo $data['musicDirector']; ?>" data-about="<?php echo $data['aboutMovie']; ?>" ></span>

                                <a href="" class="btn btn-success" id="viewdata"  data-id="<?php echo $data['id']; ?>" data-toggle="modal" data-target="#view" style=" border-radius: 0;"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                                <a href="" data-toggle="modal" data-target="#edit" class="btn btn-primary" style="border-radius: 0;" data-id="<?php echo $data['id']; ?>" data-name="<?php echo $data['name']; ?>" data-genres="<?php echo $data['genres']; ?>" data-date="<?php echo $data['relaseDate']; ?>" data-imdb="<?php echo $data['imdbRating']; ?>"><span class="glyphicon glyphicon-pencil"> </span></a>
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
                    <h4 class="modal-title custom_align" id="Heading">Movie Detail</h4>
                  </div>
                  <div class="modal-body" id="viewmovie">

                   <div class="movieimage" style="float: right;">
                    <img src="" class="movieposter" height="220px" width="220px">
                  </div>

                  <p itemtype="http://schema.org/Person">Movie Name : 
                    <span itemprop="name" class="moivename"> </span></p><br>
                    <p itemtype="http://schema.org/Person">Movie Genres: 
                      <span itemprop="name" class="moivegenres"> </span></p><br>
                      <p itemtype="http://schema.org/Person">Relase Date: 
                        <span itemprop="name" class="moivedate"> </span></p><br>
                        <p itemtype="http://schema.org/Person">IMDB Rating: 
                          <span itemprop="name" class="movieimdb"> </span></p><br>
                          <p itemtype="http://schema.org/Person">Cast: 
                            <span itemprop="name" class="moivecast"> </span></p><br>
                            <p itemtype="http://schema.org/Person">Movie Director: 
                              <span itemprop="name" class="moivedirector"> </span></p><br>

                              <p itemtype="http://schema.org/Person">Movie Music Director: 
                                <span itemprop="name" class="moivemusicdirector"> </span></p><br>


                                <p itemtype="http://schema.org/Person">About Movie: 
                                  <span itemprop="name" class="moiveabout"> </span></p><br>



                                </div>

                              </div>
                              <!-- /.modal-content --> 
                            </div>
                            <!-- /.modal-dialog --> 
                          </div>




                          <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                  <h4 class="modal-title custom_align" id="Heading">Edit Movie Detail</h4>
                                </div>
                                <div class="modal-body">

                                  <label for="email">Movie Name : </label>
                                  <div class="form-group">
                                    <input class="form-control "  id="name" value="" type="text" >
                                  </div>

                                  <label for="email">Movie Genres : </label>
                                  <div class="form-group">
                                    <input class="form-control " id="genres" value="" type="text" >
                                  </div>

                                  <label for="email">imdb rating : </label>
                                  <div class="form-group">
                                    <input class="form-control " id="imdb" value="" type="text" >
                                  </div>

                                  <label for="email">Relase Date : </label>
                                  <div class="form-group">
                                    <input class="form-control "  id="date" value="" type="date" >
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
                             var genres=$(this).attr("data-genres");
                             var imdb=$(this).attr("data-imdb");
                             var date=$(this).attr("data-date");

                    

                             $("#name").val(name);
                             $("#genres").val(genres);
                             $("#imdb").val(imdb);
                             $("#date").val(date);
                             $("#submits").attr("data-id",id);


                           });







                            $(document).on('click', '.btn', function(e) {

                              var id=$(this).attr("data-id");
                              $("#deletes").attr("data-id",id);
                            });







                            $(document).on('click', '#deletes', function(e) {
                              var id=$(this).attr("data-id");

                              $.ajax({
                                type: 'POST',
                                url: 'ajaxedit.php',
                                data: { ids : id },
                                success: function(data) {
                                  $('.data' + id).remove();
                                  $('#delete').modal('hide');
                                }
                              });

                            });






                          });



                        </script>

                        <script type="text/javascript">

                          $(document).on('click', '#submits', function(e) {
                            e.preventDefault();


                            var name=$("#name").val();
                            var genres=$("#genres").val();
                            var imdb=$("#imdb").val();
                            var date=$("#date").val();  
                            var id=$(this).attr('data-id');



                            $.ajax({
                              type: 'POST',
                              url: 'ajaxedit.php',
                              data: {'movieeditid': id, 'name':name, 'genres':genres, 'imdb':imdb,'date':date
                              },
                              success: function(data) {

                                $(".mname"+id).html(name); 
                                $(".mgenres"+id).html(genres); 
                                $(".mimdb"+id).html(imdb); 
                                $(".mdate"+id).html(date); 

                                $('#edit').modal('hide');
                                return false;
                              }
                            });







                          });


                        </script>








                        <script type="text/javascript">



                          $(document).on('click', '.btn', function(e) {
                            e.preventDefault();


                            var id=$(this).attr("data-id");

                            var name=$(".mname"+id).html();
                            var genres=$(".mgenres"+id).html();
                            var imdb=$(".mimdb"+id).html();
                            var date=$(".mdate"+id).html();
                            var director=$(".mdirector"+id).html();

                            var cast=$(".details"+id).attr("data-cast");

                            var poster=$(".details"+id).attr("data-poster");
                            var musicDirector=$(".details"+id).attr("data-musicDirector");
                            var about=$(".details"+id).attr("data-about");

                            var image = "/mvc/assets"+poster;
                     

                            $(".moivename").html(name);
                            $(".moivegenres").html(genres);
                            $(".movieposter").attr('src',image);
                            $(".movieimdb").html(imdb); 
                            $(".moivedate").html(date);
                            $(".moivecast").html(cast);    
                            $(".moivedirector").html(director);  
                            $(".moivemusicdirector").html(musicDirector);  
                            $(".moiveabout").html(about); 



                          });

                        </script>




                        <script type="text/javascript">

                          $(document).ready(function(){
                           $("#search").on("input",function ()  {


                             var str=  $("#search").val();


                             $.ajax({

                              type: 'get',
                              url: '/search',
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