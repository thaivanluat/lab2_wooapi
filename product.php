<?php
require_once('load.php');

if (isset($_POST['btn-update'])) {
$id = $_POST['productId'];
$name = $_POST['productName'];
$price = $_POST['productPrice'];
$sale_price = $_POST['productSprice'];

$data = [
    'name' =>  $name,
    'regular_price' => $price,
    'price' => $price,
    'sale_price' => $sale_price
];

$woocommerce->put('products/' . $id, $data);
header('Location: http://localhost:8080/lab2/product.php');
}

if (isset($_POST['btn-delete'])) {
$id = $_POST['productId'];
$woocommerce->delete('products/' . $id, ['force' => true]);
header('Location: http://localhost:8080/lab2/product.php');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <script src="js/jquery.js"></script>

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Woocommerce Store</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>    
  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="order.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Order</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link " href="product.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Products</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Product</li>
        </ol>

       
       
          <div class="card-header">
            <i class="fas fa-table"></i>
            Product List        
           
          </div>
         		 
						
		                                  <div class='table-responsive'>
		                                      <table id='myTable' class='table table-striped table-bordered'>
		                                          <thead>
		                                              <tr>
		                                                  <th>ID</th>
		                                                  <th>SKU</th>
		                                                  <th style="width: 35%">Name</th>
		                                                  <th>Price</th>
		                                                  <th>Sale Price</th>
		                                                  <th>Picture</th>
		                                                  <th>Action</th>

		                                              </tr>
		                                          </thead>
		                                          <tbody>
		                                              <?php
		                  foreach($products as $product){
		                  echo "<tr><td>" . $product->id."</td>
		                            <td>" . $product->sku."</td>
		                            <td id='productname'>" . $product->name."</td>
		                            <td id='productprice'>" . $product->regular_price."</td>
		                            <td id='productsaleprice'>" . $product->sale_price."</td>		                        
		                            <td><img height='50px' width='50px' src='".$product->images[0]->src."'></td>
		                            <td><a class='open-AddBookDialog btn btn-primary text-white' data-target='#updatemodal' data-id=".$product->id." data-toggle='modal'>Update</a>
                        			 <a class='open-deleteDialog btn btn-danger text-white' data-target='#deletemodal' data-id=".$product->id." data-toggle='modal'>Delete</a></td></tr>";
		                  }
		                  ?>
		                                          </tbody>
		                                      </table>
                                   
						</div> 
	  				
          <div class="card-footer small text-muted"><!-- Updated yesterday at 11:59 PM --></div>
        </div>

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->


  		<div class="modal fade" id="updatemodal" role="dialog">
		   <div class="modal-dialog">
		       <!-- Modal content-->
		       <div class="modal-content">
		           <div class="modal-header">
		               <h4 class="modal-title">Update Product Information</h4>
		                <button type="button" class="close" data-dismiss="modal">
     					 <span>×</span>
    					</button>
		           </div>
		           <div class="modal-body">
		               <p>Product ID: </p>
		               <form action="" method="post">
		                   <div class="form-group">
		                       <input type="text"  class="form-control" name="productId" id="productId" value="" readonly>
		                       <p>Product Name</p>
		                       <input type="text"  class="form-control" name="productName" id="productName" value="">
		                       <p>Price</p>
		                       <input type="text"  class="form-control" name="productPrice" id="productPrice" value="">
		                       <p>Sale Price</p>
		                       <input type="text"  class="form-control" name="productSprice" id="productSprice" value=""> 
		                   </div>
		                   <div class="modal-footer">
		                <button type="submit" class="btn btn-block" name="btn-update">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		              
		                  </div>
		               </form>
		           </div>
		       </div>
		   </div>
		</div>


			<div class="modal fade" id="deletemodal" role="dialog">
			    <div class="modal-dialog">

			        <!-- Modal content-->
			        <div class="modal-content">
			            <div class="modal-header">
			                
			                <h4 class="modal-title">Confirm Product Deletion	</h4>
			                <button type="button" class="close" data-dismiss="modal">
         					 <span>×</span>
        					</button>
			            </div>
			            <div class="modal-body">
			                <p>Really you want to delete product?</p>
			                <form action="" method="post">
			                    <div class="form-group">
			                        <input type="text" class="form-control" name="productId" id="productId" value=""readonly>
			                    </div>

			                    <div class="modal-footer">
			                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			                <button type="submit" class="btn btn-danger" name="btn-delete">Delete</button>
			                   </div>
			                </form>
			            </div>
			        </div>
			    </div>
			</div>

     






  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 
		<script>
            $(document).on("click", ".open-AddBookDialog", function() {
            	var productid = $(this).data('id');
                var productname = $(this).closest("tr").find("#productname").text();
                var productprice = $(this).closest("tr").find("#productprice").text();
                var productsaleprice =$(this).closest("tr").find("#productsaleprice").text();
                $(".modal-body #productId").val(productid);
                $(".modal-body #productName").val(productname);
                $(".modal-body #productPrice").val(productprice);
                $(".modal-body #productSprice").val(productsaleprice);
            });
        </script>

        
        <script>
            $(document).on("click", ".open-deleteDialog", function() {
                var productid = $(this).data('id');
                $(".modal-body #productId").val(productid);
            });
        </script>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
