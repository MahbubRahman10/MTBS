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

              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
              <div class="container" style="width: auto;">
                <div class="col-md-12">
                  <div class="row" class="admins">
                    <div class="col-md-6">
                      <h2 style="padding: 20px 100px;background: green; color: white; font-size: 40px; font-weight: 800;"><a href="viewadmin.php" style="color: white;">View Admin</a></h2>
                    </div>
                    <div class="col-md-6">
                      <h2 style="padding: 20px 100px;background: green; color: white; font-size: 40px; font-weight: 800;"><a href="slide.php" style="color: white;">Slide</a></h2>
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