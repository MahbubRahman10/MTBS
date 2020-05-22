<?php  include 'Auth.php'; ?>

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

                $sql="select count(*) as total from users";
                $result=$con->query($sql);
                $row=$result->fetch_assoc();
                $users = $row['total'];

                $sql="select count(*) as total from movies";
                $result=$con->query($sql);
                $row=$result->fetch_assoc();
                $movies = $row['total'];

                $sql="select count(*) as total from cinemahall";
                $result=$con->query($sql);
                $row=$result->fetch_assoc();
                $cinemahalls = $row['total'];

                $sql="select count(*) as total from book";
                $result=$con->query($sql);
                $row=$result->fetch_assoc();
                $books = $row['total'];


                // Create Line chart
                $sql = "SELECT created_at as label, COUNT(id) as y FROM visitlogs GROUP BY created_at ORDER BY created_at";
                $result=$con->query($sql);
                $visitor = array();
                if ($result) {
                  while($row=$result->fetch_assoc()){
                    $visitor[] = $row;
                  }
                }
                $dataPoints = array();
                for ($i=0; $i <count($visitor); $i++) { 
                  $dataPoints[] = $visitor[$i];
                }

                // Create Column chart
                
                $sql = "SELECT country as label, COUNT(id) as y FROM movies GROUP BY country ORDER BY country";
                $result=$con->query($sql);
                $country = array();
                if ($result) {
                  while($row=$result->fetch_assoc()){
                    $country[] = $row;
                  }
                }
                $columnPoints = array();
                for ($i=0; $i <count($country); $i++) { 
                  $columnPoints[] = $country[$i];
                }
                


              ?>

              <script>
                window.onload = function () {

                  var chart = new CanvasJS.Chart("chartContainer", {
                    title: {
                      text: "VISITOR STATISTICS"
                    },
                    axisY: {
                      title: "visitors"
                    },
                    data: [{
                      type: "line",
                      dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                  });
                  chart.render();
              
                  var chart = new CanvasJS.Chart("chartContainers", {
                    animationEnabled: true,
                    theme: "light2",
                    title:{
                      text: "Films By Country"
                    },
                    axisY: {
                      title: "Total movies"
                    },
                    data: [{
                      type: "column",
                      yValueFormatString: "#,##0.## movies",
                      dataPoints: <?php echo json_encode($columnPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                  });
                  chart.render();

                }


              </script>

              <br><br>
              <div class="container" style="width: auto;">
                <div class="col-md-12" >
                  <div class="col-md-3" id="newusers">
                    <i class="pull-left fa fa-users user1 icon-rounded" style="background-color: #6FB3E0;padding: 10px 10px; font-size: 30px; color: white; border-radius: 50%;"></i>
                    <div class="userinfo" style="margin-left: 75px;">
                      <h3 style="margin-top: 0px;"><strong> <?php echo $users; ?> </strong></h3>
                      <span style="color: #999; font-size: 15px; ">New Users</span>                               
                    </div>
                  </div>
                  <div class="col-md-3" id="newvisitor">
                    <i class="pull-left fa fa-eye" style="background-color: #1b926c;padding: 10px 10px; font-size: 30px; color: white; border-radius: 50%;"></i>
                    <div class="visitorinfo" style="margin-left: 75px;">
                      <h3 style="margin-top: 0px;"><strong> 4 </strong></h3>
                      <span style="color: #999; font-size: 15px; ">New Visitor</span>                              
                    </div>
                  </div>
                  <div class="col-md-3" id="todayposts">
                    <i class="pull-left fa fa-film" style="background-color: #a2d246;padding: 10px 10px; font-size: 30px; color: white; border-radius: 50%;"></i>
                    <div class="info" style="margin-left: 75px;">
                      <h3 style="margin-top: 0px;"><strong> <?php echo $movies; ?>  </strong></h3>
                      <span style="color: #999; font-size: 15px; ">Running Movie</span>
                    </div>
                  </div>
                  <div class="col-md-3" id="todayposts">
                    <i class="pull-left fa fa-ticket" style="background-color: #a2d246;padding: 10px 10px; font-size: 30px; color: white; border-radius: 50%;"></i>
                    <div class="info" style="margin-left: 75px;">
                      <h3 style="margin-top: 0px;"><strong> <?php echo $books; ?>  </strong></h3>
                      <span style="color: #999; font-size: 15px; ">Today Book</span>                               
                    </div>
                  </div>
                </div>
              </div>
              <br><br><br>



            <div class="container" style="width: auto;">
                <div class="col-md-12 " style="margin-left: -10px;">
                 <div class="col-md-6"> 
                   <div id="chartContainer" style="height: 370px; width: 100%; padding: 0px 0px; box-shadow: 0 1px 3px 0px rgba(0, 0, 0, 0.2);"></div>
                 </div>
                 <div class="col-md-6">
                  <div id="chartContainers" style="height: 370px; width: 100%; padding: 0px 0px; box-shadow: 0 1px 3px 0px rgba(0, 0, 0, 0.2); "></div>
                </div>
              </div>
            </div>
            <br><br><br>
            

            </div>
        </div>
    </div>



    <script src="../assets/js/canvasjs.min.js"></script>

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