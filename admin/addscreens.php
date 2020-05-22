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

                if(isset($_POST['submit']))
                {
                  $name =  $_POST['name'];
                  $seat =  $_POST['seat'];
                 
                  if(empty($name)|| empty($seat)){
                      $error = "Field must not be empty";  

                      echo $error;   
                  }
                  else{


                    $query = "INSERT INTO theater(tname, total_seat, cinemahall_id) VALUES ('$name','$seat','$id')";

                    $result=$con->query($query);

                    if($result){
                      header("Location: screens.php?id=$id");
                    }                    

                  }

                }




              ?>


              

              <br><br>
              <div class="container" style="width: auto;">
                <div class="col-md-12 " >
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
                          <a href="screens.php?id=<?php echo $id; ?>">Screen</a>
                        </li>
                      </ul>
                      <ul section="bc" id="suv" >
                        <li>
                          <a>Add Screen</a>
                        </li>
                      </ul>

                      <br><br><br><br>



                    <form method="POST" action="" enctype="multipart/form-data"> 
                      <div class="form-group">
                        <label for="">Screen Name</label>
                        <input type="text" class="form-control" name="name">
                      </div>
                      <div class="form-group">
                        <label for="">Total Seat</label>
                        <input type="text" class="form-control" name="seat">
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