<?php
   
   session_start();
   
   include('database/connection.php');

   if(!isset($_SESSION['user'])) header('location: login.php');

   $_SESSION['table'] = 'product'; 
   $user =$_SESSION['user'];

   function load_products($conn) {
    $stmt = $conn->prepare("SELECT * FROM product");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $products;
  } 

function load_products1($conn) {
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $customer = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $customer;
  }

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
          
         <div class="row1">
          <div class="column1 column-4">
            <h1 class="section_header"><i class="fa fa-plus"></i> Product Outgoing</h1>

          <div id="userAddFormContainer">
            <form action="database/product-outmss.php" method="POST" class="appForm2">
              <div class="row1">
            <div class="appFormInputContainer11">
              <label for="barcode">Barcode</label>
              <input placeholder="Barcode" type="text"  class="appForm_Input11" id="barcode" name="barcode"/>
            </div>



            <div class="appFormInputContainer10">
              <label for="product_name">Product Name</label><br>
              <select id="product_name" class="appForm_Input10" name="product_name" required>
                <option selected disabled>Select Product</option>
                <?php
                  $products = load_products($conn);
                  foreach ($products as $prod) {
                    echo "<option value='".$prod['id']."'>".$prod['product_name']."</option>";
                  }
                 ?>
              </select>
            </div>

            </div>
            <div class="row1">
            <div class="appFormInputContainer7">
              <label for="price">Selling Price</label>
              <input placeholder="Selling Price" type="text" class="appForm_Input3" id="price" name="price"/>
            </div>
            <div class="appFormInputContainer8">
              <label for="quantity">Quantity</label>
              <input placeholder="Quantity" type="text" class="appForm_Input3" id="quantity" name="quantity" />
            </div>
            
              

              <div class="appFormInputContainer9">
              <label for="customer">Customer</label><br>
              <select id="first_name" class="appForm_Input17" name='c_name' required>
                <option selected disabled>Select Customer</option>
                <?php
                  $customer = load_products1($conn);
                  foreach ($customer as $prod1) {
                    echo "<option  value='".$prod1['first_name']."'>".$prod1['first_name']."</option>";
                  }
                 ?>
              </select>
              
            </div>




            </div>
            <div class="row1">
              <div class="appFormInputContainer6">
              <label for="description">Description</label>
              <input type="text" class="appForm_Input2" id="description" name="description" />
            </div>
            </div>
           
            <button type="submit" class="appbtn2"><i class="fa fa-save"></i> Save</button>
          </form>
          <?php if(isset($_SESSION['response'])) { ?>

          <?php 
            $response_message = $_SESSION['response']['message'];
            $is_success = $_SESSION['response']['success'];
          ?>
           <div class="responseMessage">
            <p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>">
              <?php echo $response_message; ?>

            </p>
             
           </div>
           <?php unset($_SESSION['response']); } ?>
          </div> 

        </div>
      </div>
    </div>
  </div>

<script src="js/jquery/jquery-3.5.1.min.js"></script>
 <script src="js/script.js"></script>
 <script type="text/javascript">
  $("#product_name").on('change', function(e) {
    var prod_id = $(this).val();

    $.ajax({
      method: 'POST',
      url: 'database/get-single-products.php',
      data: 'prod_id=' + prod_id,
      dataType: 'json',
      success: function(response){
        $("#barcode").val(response[0].barcode);
      }
    });
  });


  
 </script>
</body>
</html>