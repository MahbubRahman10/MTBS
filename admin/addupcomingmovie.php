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

                $error = '';

                if(isset($_POST['submit']))
                {
                  $name =  $_POST['name'];
                  $language =  $_POST['language'];
                  $country =  $_POST['country'];
                  $genre =  $_POST['genre'];
                  $rdate =  $_POST['rdate'];
                  $poster =  $_FILES['poster']["name"];
                  $trailer =  $_POST['trailer'];
                  $cast =  $_POST['cast'];
                  $director =  $_POST['director'];
                  $mdirector =  $_POST['mdirector'];
                  $about =  $_POST['about'];

                  if(empty($name)|| empty($language) || empty($country) || empty($genre) || empty($rdate) || empty($poster) || empty($trailer) || empty($cast) || empty($director) || empty($mdirector) || empty($about)){
                      $error = "Field must not be empty";  

                      echo $error;   
                  }
                  else{

                    $dir = '../assets/';
                    $uploadfile = $dir . $poster;
                    $tmpname = $_FILES['poster']['tmp_name'];
                    $img = move_uploaded_file($tmpname, $uploadfile);

                    $query = "INSERT INTO upcomingmovies(movie_name, language, country, genres, relaseDate, poster, cast, director, musicDirector, trailer, aboutMovie) VALUES ('$name','$language','$country', '$genre', '$rdate', '$poster','$cast','$director','$mdirector','$trailer','$about')";

                    $result=$con->query($query);

                    if($result){
                      header("Location: upcomingmovie.php");
                    }                    

                  }

                }




              ?>


              

              <br><br>
              <div class="container" style="width: auto;">
                <div class="col-md-12 ">
                 <div class="panel panel-primary"  style="margin: 20px 20px;">
                  <div class="panel-heading">

                  </div>
                  <div class="panel-body">
                    
                    <div style="margin-bottom: 20px;">
                      <ul section="bc" id="suv" >
                        <li>
                          <a href="movie.php">All Movie</a>
                        </li>
                      </ul>
                      <ul  section="bc" id="suv" >
                        <li>
                          <a href="upcomingmovie.php">Upcoming Movie</a>
                        </li>
                      </ul>
                    </div>
                    <br><br><br>


                    <form method="POST" action="" enctype="multipart/form-data"> 
                      <div class="form-group">
                        <label for="">Movie Name</label>
                        <input type="text" class="form-control" name="name">
                      </div>
                      <div class="form-group">
                        <label for="">Movie Language</label>
                        <input type="text" class="form-control" name="language">
                      </div>
                      <div class="form-group">
                        <label for="">Movie Country</label>
                        <input type="text" class="form-control" name="country">
                      </div>
                      <div class="form-group">
                        <label for="">Movie Genre</label>
                        <input type="text" class="form-control" name="genre">
                      </div>
                      <div class="form-group">
                        <label for="">Relase Date</label>
                        <input type="date" class="form-control" name="rdate">
                      </div>
                      <div class="form-group">
                        <label for="">Movie Poster</label>
                        <input type="file" class="form-control" name="poster">
                      </div>
                      <div class="form-group">
                        <label for="">Movie Trailer</label>
                        <input type="text" class="form-control" name="trailer">
                      </div>

                      <div class="form-group">
                        <label for="">Movie Cast</label>
                        <input type="text" class="form-control" name="cast">
                      </div>

                      <div class="form-group">
                        <label for="">Movie Director</label>
                        <input type="text" class="form-control" name="director">
                      </div>

                      <div class="form-group">
                        <label for="">Movie Music Director</label>
                        <input type="text" class="form-control" name="mdirector">
                      </div>

                      <div class="form-group">
                        <label for="">About Movie</label>
                        <textarea class="form-control" name="about"> </textarea>
                      </div>

                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>




                  </div>

                </div>
              </div>
            </div>










                

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