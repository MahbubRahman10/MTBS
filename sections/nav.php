

<?php 

    session_start();

    // Carbon 
    require 'vendor/autoload.php';
    $t =Carbon\Carbon::now()->format('Ymd');

    // Include Database Class and Create Object
    include 'classes/db.php';
    $db = new Database();

    // Query for fetch data from movies Table
    $query = "select * from movies";
    $movieresult = $db->select($query);
    $movies = array();
    if ($movieresult) {
      while ($data = $movieresult->fetch_assoc()) {
        $movies[] = $data;
      }
    }
    
    // Query for fetch data cinemahall Table
    $query = "select * from cinemahall";
    $theaterresult = $db->select($query);
    while ($data = $theaterresult->fetch_assoc()) {
      $theaters[] = $data;
    }


?>

<?php include 'visitor.php'; ?>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<header>
  <div>
    <div class="logo">
        <span style="color: white; font-weight: 700;font-size: 25px;">Housefull<span  style="font-size: 25px;color: orange; font-weight: 700" class="logos">BD</span></span>
    </div>
    <div id="head-mobile"><a href="" class="menuicon"><i class="fa fa-bars"></i></a> </div>
  </div>
  <nav id='cssmenu'>
    <div class="button"></div>
    <ul id="menu">
      <li><a href='index.php'>Home</a></li>
      <li><a href='#' id="a-movie">Movie</a>
       <ul>
         <div class="csdvsd">
          <div class="container" id="mood">

            <section class="cols" >
              <h4>Bangla</h4><hr>
              <?php foreach ($movies as $key => $value) {
                if($value['country'] == "Bangladesh"){ ?>
                  <h5><a href="view.php?id=<?php echo $value['id']; ?>&data=<?php echo $t; ?>" > <?php echo $value['name']; ?> </a></h5>
              <?php
                }
              }?>
            </section>

            <section class="cols">
              <h4>Indo-Bangla</h4><hr>
              <?php foreach ($movies as $key => $value) {
                if($value['country'] == 'Indo-Bangladesh'){ ?>
                  <h5><a href="view.php?id=<?php echo $value['id']; ?>&data=<?php echo $t; ?>" > <?php echo $value['name']; ?> </a></h5>
              <?php
                }
              }?>
            </section>

            <section class="cols">
              <h4>English</h4><hr>
              <?php foreach ($movies as $key => $value) {
                if($value['country'] == "USA"){ ?>
                  <h5><a href="view.php?id=<?php echo $value['id']; ?>&data=<?php echo $t; ?>" > <?php echo $value['name']; ?> </a></h5>
              <?php
                }
              }?>
            </section>
          </div>
        </div>
      </ul>
    </li>
    <li><a href='#' id="a-theater">Theater</a>
     <ul>
       <div class="csdvsdc">
        <div class="container" id="mood">
          <section class="cols">
           <?php
           use Carbon\Carbon;  
           $t = Carbon::now()->format('Ymd');
           ?>
           <h4>Dhaka</h4><hr>
           <?php foreach ($theaters as $key => $value) {
              if($value['city'] == "Dhaka"){ ?>
              <h5><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $value['hname']; ?></a></h5>
           <?php
              }
            }
          ?>
         </section>

         <section class="cols">
          <h4>Sylhet</h4><hr>
          <?php foreach ($theaters as $key => $value) {
              if($value['city'] == "Sylhet"){ ?>
              <h5><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $value['hname']; ?></a></h5>
           <?php
              }
            }
          ?>
        </section>
        <section class="cols">

          <h4>Chittagong</h4><hr>
           <?php foreach ($theaters as $key => $value) { 
              if($value['city'] == "Chittagong"){ ?>
              <h5><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $value['hname']; ?></a></h5>
           <?php
              }
            }
          ?>
        </section>

        <section class="cols">
          <h4>Khulna</h4><hr>
           <?php foreach ($theaters as $key => $value) {
              if($value['city'] == "Khulna"){ ?>
              <h5><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $value['hname']; ?></a></h5>
           <?php
              }
            }
          ?>
        </section>

        <section class="cols">
          <h4>Rajshahi</h4><hr>
           <?php foreach ($theaters as $key => $value) { 
              if($value['city'] == "Rajshahi"){ ?>
              <h5><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $value['hname']; ?></a></h5>
           <?php
              }
            }
          ?>
        </section>
        <section class="cols">
          <h4>Barisal</h4><hr>
           <?php foreach ($theaters as $key => $value) { 
              if($value['city'] == "Barisal"){ ?>
              <h5><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $value['hname']; ?></a></h5>
           <?php
              }
            }
          ?>
        </section>
        <section class="cols">
          <h4>Rangpur</h4><hr>
           <?php foreach ($theaters as $key => $value) { 
              if($value['city'] == "Rangpur"){ ?>
              <h5><a href="theater.php?name=<?php echo $value['hname']; ?>&data=<?php echo $t; ?>"><?php echo $value['hname']; ?></a></h5>
           <?php
              }
            }
          ?>
        </section>
      </div>
    </div>
  </ul>
</li>
<li><a href="contact.php">Contact Us</a></li>

<?php if(isset($_SESSION['user'])) { ?>
        <li><a href='users.php'>User</a></li>
<?php } 
      else{ ?>
        <li><a href='login.php'>Login/Signup</a></li>
<?php } ?>
</ul>
</nav>
</header>


<script type="text/javascript"> 
  $(document).ready(function(){
    $('.menuicon').on('click', function(e){
      e.preventDefault();
        var check = $("#menu").hasClass("showing");
        
        if(check == false){
          var oldmovieUrl = $("#a-movie").attr("href"); // Get current url
          var newmovieUrl = oldmovieUrl.replace("#", "viewmovie.php"); // Create new
          $("#a-movie").attr("href", newmovieUrl); // Set herf value
         
          var oldtheaterUrl = $("#a-theater").attr("href"); // Get current url
          var newtheaterUrl = oldtheaterUrl.replace("#", "viewtheater.php"); // Create new
          $("#a-theater").attr("href", newtheaterUrl); // Set herf value
  
          $("#menu").addClass("showing");
          $(".showing").css("display","block");
        }
        else{          
          $("#menu").removeClass("showing");
          var oldmovieUrl = $("#a-movie").attr("href"); // Get current url
          var newmovieUrl = oldmovieUrl.replace("viewmovie.php", "#"); // Create new

          var oldtheaterUrl = $("#a-theater").attr("href"); // Get current url
          var newtheaterUrl = oldtheaterUrl.replace("viewtheater.php", "#"); // Create new
          $("#a-theater").attr("href", newtheaterUrl); // Set herf value

          $("#a-movie").attr("href", newmovieUrl); // Set herf value
        }
    });
  });
</script>
