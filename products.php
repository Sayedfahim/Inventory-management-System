<?php
   
   session_start();
   if(!isset($_SESSION['user'])) header('location: login.php');

   $_SESSION['table'] = 'product'; 
   $user =$_SESSION['user'];

   $product = include('database/show-products.php');

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
                    <th>Price</th>
                    <th>Quantity</th>
                    
                    
                    <th>Actions</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?php foreach ($product as $index => $user) {?>
                      <tr>
                      <td><?= $index + 1 ?></td>
                      <td class="Barcode"><?= $user['barcode'] ?></td>
                      <td class="ProductName"><?= $user['product_name'] ?></td>
                      <td class="price"><?= $user['price'] ?></td>
                      <td class="quantity"><?= $user['quantity'] ?></td>
                      <td>
                        <a href="" class="updateUser" data-userid="<?= $user['id'] ?>"> <i class="fa fa-pencil"></i> Edit</a>
                        <a href="" class="deleteUser" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['quantity'] ?>" data-lname="<?= $user['product_name'] ?>" > <i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                    <?php } ?>
                    
                  </tbody>
                </table>
                <p class="userCount"><?= count($product) ?> product </p>
              </div>
            </div>
          </div>

          </div>
        </div>
        </div>
        </div>
      
    
  

  <script src="js/script.js"></script>
  <script src="js/jquery/jquery-3.5.1.min.js"></script>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous"></script>
  <script>
   function script(){
     
     this.initialize = function(){
      this.registerEvents();
     },

     this.registerEvents = function(){
        document.addEventListener('click', function(e){
          targetElement = e.target;
        classList = targetElement.classList;


        if(classList.contains('deleteUser')){

          e.preventDefault();
          userId = targetElement.dataset.userid;
           fname = targetElement.dataset.fname;
            lname = targetElement.dataset.lname;
            fullName = fname + ' ' +lname ;

            BootstrapDialog.confirm({
                      type: BootstrapDialog.TYPE_DANGER,
                      message: 'Are you sure to delete '+ fullName +'?',
                      callback: function(isDelete){
                $.ajax({
                method: 'POST',
                data:{
                  user_id: userId,
                  f_name: fname,
                  l_name: lname
                },
                url: 'database/delete-products.php',
                dataType: 'json',
                success: function(data){
                  if(data.success){
                    BootstrapDialog.alert({
                      type: BootstrapDialog.TYPE_SUCCESS,
                      message: data.message,
                      callback: function(){
                      location.reload();
                      }
                    });
                  }else 
                    BootstrapDialog.alert({
                      type: BootstrapDialog.TYPE_Danger,
                      message: data.message,
                    });
                  
                }
              });
                      }
                    })

           
          }

          if(classList.contains('updateUser')){
            e.preventDefault();

           Barcode = targetElement.closest('tr').querySelector('td.Barcode').innerHTML;
           ProductName = targetElement.closest('tr').querySelector('td.ProductName').innerHTML;
           price = targetElement.closest('tr').querySelector('td.price').innerHTML;
           quantity = targetElement.closest('tr').querySelector('td.quantity').innerHTML;
           userId = targetElement.dataset.userid;

           BootstrapDialog.confirm({
            title: ' Update ' + Barcode + ' ' + ProductName,
            message: '<form>\
            <div class="form-group">\
            <label for="Barcode">Barcode:</label>\
            <input type="text" class="form-control" id="Barcode" value="'+ Barcode +'">\
            </div>\
            <div class="form-group">\
            <label for="ProductName">Product Name:</label>\
            <input type="text" class="form-control" id="ProductName" value="'+ ProductName +'">\
            </div>\
            <div class="form-group">\
            <label for="price">Price:</label>\
            <input type="price" class="form-control" id="PriceUpdate" value="'+ price +'">\
            </div>\
            <div class="form-group">\
            <label for="quantity">Quantity:</label>\
            <input type="quantity" class="form-control" id="QuantityUpdate" value="'+ quantity +'">\
            </div>\
            </form>',
            callback: function(isupdate){
              if(isupdate){
              $.ajax({
                method: 'POST',
                data: {
                  userId: userId,
                  f_name: document.getElementById('Barcode').value,
                  l_name: document.getElementById('ProductName').value,
                  price: document.getElementById('PriceUpdate').value,
                  quantity: document.getElementById('QuantityUpdate').value,
                },
                url: 'database/update-products.php',
                dataType: 'json',
                success: function(data){
                  if(data.success){
                    BootstrapDialog.alert({
                      type: BootstrapDialog.TYPE_SUCCESS,
                      message: data.message,
                      callback: function(){
                      location.reload();
                      }
                    });
                  }else 
                    BootstrapDialog.alert({
                      type: BootstrapDialog.TYPE_Danger,
                      message: data.message,
                    });
                  
                }
              })
              }
            }
           })
          }
        });
     }
    }

    var script = new script;
    script.initialize();
  </script>

</body>
</html>