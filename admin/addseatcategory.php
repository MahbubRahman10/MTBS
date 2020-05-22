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

                $sql="select * from theater where id='$id'";
                $result=$con->query($sql);
                $row=$result->fetch_assoc(); 
                $screens = $row['cinemahall_id'];

                if(isset($_POST['submit']))
                {
                  $type =  $_POST['type'];
                  $price =  $_POST['price'];
                 
                  if(empty($type)|| empty($price)){
                      $error = "Field must not be empty";  

                      echo $error;   
                  }
                  else{


                    $query = "INSERT INTO seatdistribution(type, price, theater_id) VALUES ('$type','$price','$id')";

                    $result=$con->query($query);

                    if($result){
                      header("Location: seatdistribution.php?id=$id");
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
                        <a href="seatdistribution.php?id=<?php echo $id; ?>">Seat Distribution</a>
                      </li>
                    </ul>


                    <ul section="bc" id="suv" >
                      <li>
                        <a>Add Category</a>
                      </li>
                    </ul>

                      <br><br><br><br>



                    <form method="POST" action="" enctype="multipart/form-data"> 
                      <div class="form-group">
                        <label for="">Category Name</label>
                        <input type="text" class="form-control" name="type">
                      </div>
                      <div class="form-group">
                        <label for="">Price</label>
                        <input type="text" class="form-control" name="price">
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