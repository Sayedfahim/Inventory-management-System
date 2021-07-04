<?php
   session_start();
   if(!isset($_SESSION['user'])) header('location: login.php');

   $_SESSION['table'] = 'product'; 
   $user =$_SESSION['user'];

   $sales_raw = include('database/show-sales.php');
   

   $sales = [];
    
   if ($sales_raw) {
      foreach ($sales_raw as $key => $value) {
        
        $stmt = $conn->prepare("SELECT * from product WHERE id =".$value['product_id']);
        $stmt->execute();
        $single_product = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (isset($single_product[0])) {
          $sales[$key] = $single_product[0];
          $sales[$key]['sale_quantity'] = $value['quantity'];
          $sales[$key]['first_name'] = $value['first_name'];
          $sales[$key]['created_at'] = $value['created_at']; 
          $sales[$key]['sale_price'] = $value['price'];         
        }
      }
   }

   

   
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard - Inventory Management System</title>
  <link rel="stylesheet" type="text/css" href="css/login.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css" integrity="sha512-PvZCtvQ6xGBLWHcXnyHD67NTP+a+bNrToMsIdX/NUqhw+npjLDhlMZ/PhSHZN4s9NdmuumcxKHQqbHlGVqc8ow==" crossorigin="anonymous" />
</head>
<body>
  <div id="dashboardMaincontainer">
    
   <?php include('partials/app-sidebar.php')?>
    <div class="dashboard_content_container" id="dashboard_content_container">
      <?php include('partials/app-topnav.php')?>
      <div class="dashboard_content">
        <div class="dashboard_content_main">
          
         
          <div class="column column-8">
            <h1 class="section_header"><i class="fa fa-list"></i> List of Products</h1>
            <div class="section_content">
              <div class="product">
                <table>
                  <thead>
                    <tr>
                     <td>#</td>
                    <th>Barcode</th>
                    <th>Product Name</th>
                    <th>Customer</th>
                    <th>Sale Price</th>
                    <th>Sale Quantity</th>
                    <th>Crated At</th>
                    
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?php foreach ($sales as $key => $value) {?>
                      <tr>
                      <td><?= $key + 1 ?></td>
                      <td class="Barcode"><?= $value['barcode'] ?></td>
                      <td class="ProductName"><?= $value['product_name'] ?></td>
                      <td class="CustomerName"><?= $value['first_name'] ?></td>
                      <td class="price"><?= $value['sale_price'] ?></td>
                      <td class="quantity"><?= $value['sale_quantity'] ?></td>
                      <td class="quantity"><?= date('d-m-Y', strtotime($value['created_at'])) ?></td>
                      
                    </tr>
                    <?php } ?>
                    
                  </tbody>
                </table>
                <p class="userCount"><?= count($sales) ?> Sale </p>
              </div>
            </div>
          </div>

          </div>
        </div>
        </div>
        </div>
      
    
  

  <script src="js/script.js"></script>
  

</body>
</html>