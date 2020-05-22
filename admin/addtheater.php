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
                  $address =  $_POST['address'];
                  $city =  $_POST['city'];
                  $phone =  $_POST['phone'];
                  $latitude =  $_POST['latitude'];
                  $longitude =  $_POST['longitude'];
                  $about =  $_POST['about'];

                  if(empty($name)|| empty($address) || empty($city) || empty($phone) || empty($latitude) || empty($longitude)){
                      $error = "Field must not be empty";  
                      echo $error;   
                  }
                  else{

                    $query = "INSERT INTO cinemahall(hname, location, city, phone, latitude, longitude, about) VALUES ('$name','$address','$city', '$phone', '$latitude', '$longitude','$about')";

                    $result=$con->query($query);

                    if($result){
                      header("Location: theater.php");
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
                    

                    <ul section="bc"   style="background: white;    padding: 8px 15px; margin-bottom: 20px;list-style: none;background-color: #f5f5f5;border-radius: 4px; font-size: 20px;">
                      <li>
                        <a href="theater.php">Theater ></a>
                        <a>Add Theater</a>
                      </li>
                    </ul>


                    <form method="POST" action="" enctype="multipart/form-data"> 
                      <div class="form-group">
                        <label for="">Theater Name</label>
                        <input type="text" class="form-control" name="name">
                      </div>
                      <div class="form-group">
                        <label for="">Theater Address</label>
                        <input type="text" class="form-control" name="address">
                      </div>
                      <div class="form-group">
                        <label for="">City</label>
                        <input type="text" class="form-control" name="city">
                      </div>
                      <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone">
                      </div>
                      <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" class="form-control" name="latitude">
                      </div>
                      <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" class="form-control" name="longitude">
                      </div>
                      <div class="form-group">
                        <label for="">About Theater</label>
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