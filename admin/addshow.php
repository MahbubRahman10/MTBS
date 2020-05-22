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

                if (isset($_GET['id'])) {
                  $id = $_GET['id'];
                }

                $sql="select * from movies";
                $result=$con->query($sql);
                while($row=$result->fetch_assoc()){  
                  $movie[] = $row;
                }

                $sql="select * from theater where id='$id'";
                $result=$con->query($sql);
                $row=$result->fetch_assoc(); 
                $screens = $row['cinemahall_id'];

                if(isset($_POST['submit']))
                {
                  $movie_id =  $_POST['mid'];
                  $date =  $_POST['date'];
                  $time =  $_POST['time'];

                  if(empty($movie_id) || empty($date)|| empty($time)){
                      $error = "Field must not be empty";  

                      echo $error;   
                  }
                  else{

                    $sql="select * from movies where id='$movie_id'";
                    $result=$con->query($sql);
                    $row=$result->fetch_assoc();
                    $mid = $row['id'];
                    $mname = $row['name'];

                    


                    $query = "INSERT INTO screening(movie_id, movie_name, cinemahall_id, theater_id, date, time) VALUES ('$mid','$mname','$screens','$id','$date','$time')";

                    $result=$con->query($query);

                    if($result){
                      header("Location: show.php?id=$id");
                    }                    

                  }

                }




              ?>


              
              <br><br>
              <div class="container" style="width: auto;">
                <div class="col-md-12" >
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
                          <a href="screens.php?id=<?php echo $screens; ?>">Screen</a>
                        </li>
                      </ul>
                      <ul section="bc" id="suv" >
                        <li>
                          <a href="show.php?id=<?php echo $id; ?>">Schedule</a>
                        </li>
                      </ul>
                      <ul section="bc" id="suv" >
                        <li>
                          <a>Add Schedule</a>
                        </li>
                      </ul>
                    <br><br><br><br>

                    <form method="POST" action="" enctype="multipart/form-data"> 
                      <div class="form-group">
                        <label for="">Movie Name</label>
                        <select name="mid" class="form-control" >
                          <?php foreach($movie as $data) { ?>
                          <option value="<?php echo $data['id']; ?>"> <?php echo $data['name']; ?></option><br><br><br>
                          <?php } ?>
                        </select> 
                      </div>
                      <div class="form-group">
                        <label for="">Show Date</label>
                        <input type="date" class="form-control" name="date">
                      </div>
                      <div class="form-group">
                        <label for="">Show Time</label>
                        <input type="text" class="form-control" name="time">
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