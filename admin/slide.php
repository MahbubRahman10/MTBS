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
        
        $sql="select * from slide";
        $result=$con->query($sql);
        $slide = array();
        if ($result) {
          while($row=$result->fetch_assoc()){  
            $slide[] = $row;
          }
        }
       

        $error = '';

        if(isset($_POST['submit']))
        {
          $checkbox =  $_POST['checkbox'];
          $image =  $_FILES['image']["name"];

          if(empty($image)){

            $error = "Field must not be empty";  
            echo $error;
          }
          else{
            $dir = '../assets/Slide/';
            $uploadfile = $dir . $image;
            $tmpname = $_FILES['image']['tmp_name'];
            $img = move_uploaded_file($tmpname, $uploadfile);

            if ($checkbox == 'on') {
              $active = '1';
            }
            else{
              $active = '0';
            }

            $slide =  "/Slide/".$image;

            $query = "INSERT INTO Slide(image, active) VALUES ('$slide','$active')";
            $result=$con->query($query);

            if($result){
              header("Location: slide.php");
            }  


          }

        }        




        ?>

        <div class="container" style="width: auto;">
         <br> 
         <div class="col-md-12">
          <div class="row">

           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

            <div id="myCarousel" class="carousel slide" data-ride="carousel">
             <div class="carousel-inner">
              <?php foreach($slide as $data){ ?>
              <div class="item <?php if($data['active'] == '1') { ?> 'active' <?php } ?>" >
                <img src="../assets/<?php echo $data['image']; ?>" alt="Los Angeles" style="width:100%; height:250px;">
              </div>
              <!-- Left and right controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
              </a>
              <?php } ?>
            </div>
          </div>
          <br><br>
          <div style="text-align: center;">
            <a href="" id="viewdata" data-toggle="modal" data-target="#view" class="btn btn-primary" style="border-radius: 0; font-weight: 800; font-size: 30px; ">Add Slide</a>
          </div>

          <br><br><hr>
          <h2 style="text-align: center; ">Slide Images</h2>
          <div class="col-md-12" style="height: 700px;">
            <?php foreach($slide as $data) { ?>
            <div class="col-md-4">
              <img src="../assets/<?php echo $data['image']; ?>" alt="Chicago" style="width:70%; height:170px;"><br><br>
              <?php if($data['active'] == '1'){ ?> <a class="btn btn-primary" style="border-radius: 0; ">Active</a><?php } ?>
              <a href="deleteslide.php?id=<?php echo $data['id']; ?>" class="btn btn-danger" style="border-radius: 0; ">Remove</a>
              <br><br>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            <h4 class="modal-title custom_align" id="Heading">Slide Image</h4>
          </div>
          <div class="modal-body" id="viewmovie">
           <form method="post" action="" enctype="multipart/form-data">
             <label>Add Slide</label>
             <input type="file" name="image" class="form-control"><br>
             <label class="checkbox" style="margin-left: 20px;">
              <input type="checkbox" name="checkbox"> Active
            </label>
            <button type="submit" class="btn btn-primary" name="submit"> Ok </button>
          </form>
        </div>
      </div>
      <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
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