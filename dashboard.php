<?php
   
   session_start();
   if(!isset($_SESSION['user'])) header('location: login.php');

   $user =$_SESSION['user'];

   ?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - Inventory Management System</title>
	<link rel="stylesheet" type="text/css" href="css/login.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/6f924482e7.js" crossorigin="anonymous"></script>
</head>
<body>
  <div id="dashboardMaincontainer">
    
   <?php include('partials/app-sidebar.php')?>
    <div class="dashboard_content_container" id="dashboard_content_container">
      <?php include('partials/app-topnav.php')?>
      <div class="dashboard_content">
        <div class="dashboard_content_main">
          
          <!-- <div id="canvas-holder" style="width:40%">
            <canvas id="chart-area"></canvas>
            <canvas id="chart-area-extra"></canvas>
          </div> -->

          <div id="canvas-holder" style="width:40%">
            <canvas id="chart-area"></canvas>
          </div>

          <div id="canvas-holder-extra" style="width:40%">
            <canvas id="chart-area-extra"></canvas>
          </div>

        </div>
      </div>
    </div>
  </div>

 <script src="js/script.js"></script>
 <script src="js/jquery/jquery-3.5.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
 <script>
    var config = {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            12,
            54
          ],
          backgroundColor: [
            '#F5F5DC',
            '#E9967A'
          ],
          // label: 'Dataset 1'
        }],
        labels: [
          'Products',
          'Sales',
        ]
      },
      options: {
        responsive: true
      }
    };

    
    var ctx = document.getElementById('chart-area').getContext('2d');
    myChart = new Chart(ctx, config);

    function addData(chart,data) {
      chart.data.datasets[0].data = [data.products, data.sales];
      chart.update();
    }

    $.ajax({
        url:"database/get-dashboard-data.php",
        method:'GET',
        dataType:'json',
        success:function(data)
        {
          addData(myChart, data);
        }
    });
  </script>

  <script>
    var config2 = {
      type: 'pie',
      data: {
        datasets: [{
          data: [
            12,
            54
          ],
          backgroundColor: [
            '#F5F5DC',
            '#E9967A'
          ],
          // label: 'Dataset 1'
        }],
        labels: [
          'Suppliers',
          'Customers',
        ]
      },
      options: {
        responsive: true
      }
    };

    
    var ctx2 = document.getElementById('chart-area-extra').getContext('2d');
    myChart2 = new Chart(ctx2, config2);

    function addData2(chart,data) {
      chart.data.datasets[0].data = [data.supplier, data.users];
      chart.update();
    }

    $.ajax({
        url:"database/get-suppliers-data.php",
        method:'GET',
        dataType:'json',
        success:function(data)
        {
          addData2(myChart2, data);
        }
    });
  </script>
</body>
</html>