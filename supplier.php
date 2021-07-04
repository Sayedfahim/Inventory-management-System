<?php session_start(); ?>

<?php
   if(!isset($_SESSION['user'])) header('location: login.php');
   
   $_SESSION['table'] = 'supplier';   
   $user = $_SESSION['user'];
   
   $supplier = include('database/supplier-show.php');


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
        <div class="row">
          <div class="column column-5">
            <h1 class="section_header"><i class="fa fa-plus"></i> Supplier List</h1>

          <div id="userAddFormContainer">
            <form action="database/supplier-add.php" method="POST" class="appForm">
            <div class="appFormInputContainer">
              <label for="company_name">Company Name</label>
              <input placeholder="Company Name" type="text"  class="appFormInput" id="company_name" name="company_name"/>
            </div>
            
            <div class="appFormInputContainer">
              <label for="product_name">Product Name</label>
              <input placeholder="Product Name" type="text" class="appFormInput" id="product_name" name="product_name"/>
            </div>
            <div class="appFormInputContainer">
              <label for="barcode">Barcode</label>
              <input placeholder="Barcode" type="text" class="appFormInput" id="barcode" name="barcode" />
            </div>
            <div class="appFormInputContainer">
              <label for="product_price">Product Price</label>
              <input placeholder="Product Price" type="text" class="appFormInput" id="product_price" name="product_price" />
            </div>
           
            <button type="submit" class="appbtn"><i class="fa fa-plus"></i> Save</button>
           

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
          <div class="column column-7">
            <h1 class="section_header"><i class="fa fa-list"></i> List of Supplier</h1>
            <div class="section_content">
              <div class="supplier">
                <table>
                  <thead>
                    <tr>
                     <td>#</td>
                    <th>Company Name</th>
                    
                    <th>Product Name</th>
                    <th>Barcode</th>
                    <th>Product Price</th>
                    
                    <th>Actions</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <?php foreach ($supplier as $index => $user) {?>
                      <tr>
                      <td><?= $index + 1 ?></td>
                      <td class="CompanyName"><?= $user['company_name'] ?></td>
                      
                      <td class="Productname"><?= $user['product_name'] ?></td>
                      <td class="barcode"><?= $user['barcode'] ?></td>
                      <td class="product_price"><?= $user['product_price'] ?></td>
                      
                      <td>
                        <a href="" class="updateUser" data-userid="<?= $user['id'] ?>"> <i class="fa fa-pencil"></i> Edit</a>
                        <a href="" class="deleteUser" data-userid="<?= $user['id'] ?>" data-fname="<?= $user['company_name'] ?>" data-lname="<?= $user['product_name'] ?>" > <i class="fa fa-trash"></i> Delete</a>
                      </td>
                    </tr>
                    <?php } ?>
                    
                  </tbody>
                </table>
                <p class="userCount"><?= count($supplier) ?> supplier </p>
              </div>
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
                url: 'database/delete-supplier.php',
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

           CompanyName = targetElement.closest('tr').querySelector('td.CompanyName').innerHTML;
           barcode = targetElement.closest('tr').querySelector('td.barcode').innerHTML;
           Productname = targetElement.closest('tr').querySelector('td.Productname').innerHTML;
           product_price = targetElement.closest('tr').querySelector('td.product_price').innerHTML;
           userId = targetElement.dataset.userid;

           BootstrapDialog.confirm({
            title: ' Update ' + CompanyName ,
            message: '<form>\
            <div class="form-group">\
            <label for="CompanyName">Company Name:</label>\
            <input type="text" class="form-control" id="CompanyName" value="'+ CompanyName +'">\
            </div>\
            <div class="form-group">\
            <label for="barcode">Barcode:</label>\
            <input type="text" class="form-control" id="Barcode" value="'+ barcode +'">\
            </div>\
            <div class="form-group">\
            <label for="Productname">Product Name:</label>\
            <input type="text" class="form-control" id="Productname" value="'+ Productname +'">\
            </div>\
            <div class="form-group">\
            <label for="product_price">Product Price:</label>\
            <input type="text" class="form-control" id="ProductPrice" value="'+ product_price +'">\
            </div>\
            </form>',
            callback: function(isupdate){
              if(isupdate){
              $.ajax({
                method: 'POST',
                data: {
                  userId: userId,
                  f_name: document.getElementById('CompanyName').value,
                  l_name: document.getElementById('Productname').value,
                  barcode: document.getElementById('Barcode').value,
                  product_price: document.getElementById('ProductPrice').value,
                },
                url: 'database/update-supplier.php',
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