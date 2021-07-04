<?php
   
   session_start();

    include('database/connection.php');

   if(!isset($_SESSION['user'])) header('location: login.php');

   $_SESSION['table'] = 'product'; 
   $user =$_SESSION['user'];

   function load_products($conn) {
    $stmt = $conn->prepare("SELECT * FROM supplier");
    $stmt->execute();
    $Suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $Suppliers;
  }

  function load_products1($conn) {
    $stmt = $conn->prepare("SELECT * FROM supplier");
    $stmt->execute();
    $Suppliers1 = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $Suppliers1;
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
          
         <div class="row">
          <div class="column column-4">
            <h1 class="section_header"><i class="fa fa-plus"></i> Add New Product</h1>

          <div id="userAddFormContainer">
            <form action="database/product-add.php" method="POST" class="appForm1">
              <div class="row">
            <div class="appFormInputContainer1">
              <label for="barcode">Barcode</label>
              <input placeholder="Barcode" type="text"  class="appForm_Input" id="barcode" name="barcode"/>
            </div>
            




             <div class="appFormInputContainer2">
              <label for="product_name">Product Name</label><br>
              <select id="product_name" class="appForm_Input15" name="product_name" required>
                <option selected disabled>Select Product Name</option>
                <?php
                  $Suppliers1 = load_products1($conn);
                  foreach ($Suppliers1 as $prod1) {
                    echo "<option value='".$prod1['product_name']."'>".$prod1['product_name']."</option>";
                  }
                 ?>
              </select>
              
            </div>




            </div>
            <div class="row">
            <div class="appFormInputContainer3">
              <label for="price">Price</label>
              <input placeholder="Price" type="text" class="appForm_Input1" id="price" name="price"/>
            </div>
            <div class="appFormInputContainer4">
              <label for="quantity">Quantity</label>
              <input placeholder="Quantity" type="text" class="appForm_Input1" id="quantity" name="quantity" />
            </div>
            

            

            <div class="appFormInputContainer5">
              <label for="company_name">Supplier</label><br>
              <select id="company_name" class="appForm_Input01" name="company_name" required>
                <option selected disabled>Select Supplier</option>
                <?php
                  $Suppliers = load_products($conn);
                  foreach ($Suppliers as $prod) {
                    echo "<option value='".$prod['id']."'>".$prod['company_name']."</option>";
                  }
                 ?>
              </select>
              
            </div>




            </div>
            <div class="row">
              <div class="appFormInputContainer6">
              <label for="description">Description</label>
              <input type="text" class="appForm_Input2" id="description" name="description" />
            </div>
            </div>
           
            <button type="submit" class="appbtn1"><i class="fa fa-save"></i> Save</button>
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
  $("#company_name").on('change', function(e) {
    var prod_id = $(this).val();

    $.ajax({
      method: 'POST',
      url: 'database/get-single-supplier.php',
      data: 'prod_id=' + prod_id,
      dataType: 'json',
      success: function(response){
        $("#price").val(response[0].product_price);
         $("#barcode").val(response[0].barcode);
      }
    });
  });

$("#product_name").on('change', function(e) {
    var prod_iid = $(this).val();

    $.ajax({
      method: 'POST',
      url: 'database/get-single-supplier1.php',
      data: 'prod_iid=' + prod_iid,
      dataType: 'json',
      //success: function(response){
        //$("#barcode").val(response[0].barcode);
      //}
    });
  });

 </script>
</body>
</html>