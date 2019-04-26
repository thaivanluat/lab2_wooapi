<?php


require_once('load.php');



if (isset($_POST['btn-update'])) {
$status = $_POST['uorderId'];
$st = $_POST['status'];
$woocommerce->put('orders/' . $status, array(
'status' => $st
));
header('Location: http://localhost:8080/lab2/order.php');
}

if (isset($_POST['btn-delete'])) {
$oid = $_POST['dorderId'];
$woocommerce->delete('orders/' . $oid, ['force' => true]);
header('Location: http://localhost:8080/lab2/order.php');
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
      
      <li class="nav-item active">
        <a class="nav-link" href="order.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Order</span></a>
      </li>
      <li class="nav-item">
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
          <li class="breadcrumb-item active">Order</li>
        </ol>

        <!-- Icon Cards-->
        
    
        

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
           Order List</div>
          <div class="card-body">
          		<div class="container">
                             <h2 class="sub-header">Orders List</h2>
                               <div class='table-responsive'>
                                   <table id='myTable' class='table table-striped table-bordered'>
                                       <thead>
                                           <tr>
                                               <th>Order #</th>
                                               <th>Customer</th>
                                               <th>Address</th>
                                               <th>Contact</th>
                                               <th>Order Date</th>
                                               <th>Status</th>
                                               <th>Actions</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <?php
               foreach($orders as $details){
               echo "<tr><td>" . $details->id."</td>
                         <td>" . $details->billing->first_name.$details->billing->last_name."</td>
                         <td>" . $details->shipping->address_1."</td>
                         <td>" . $details->billing->phone."</td>
                         <td>" . $details->date_created."</td>
                         <td>" . $details->status."</td>
                         <td><a class='open-AddBookDialog btn btn-primary text-white' data-target='#myModal' data-id=".$details->id." data-toggle='modal'>Update</a>
                         <a class='open-deleteDialog btn btn-danger text-white' data-target='#myModal1' data-id=".$details->id." data-toggle='modal'>Delete</a></td></tr>";
               }
               ?>
                                       </tbody>
                                   </table>
                               </div>
              </div>  
          </div>
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
		<div class="modal fade" id="myModal" role="dialog">
		   <div class="modal-dialog">
		       <!-- Modal content-->
		       <div class="modal-content">
		           <div class="modal-header">
		               <h4 class="modal-title">Update Order Status</h4>
		                <button type="button" class="close" data-dismiss="modal">
     					 <span>×</span>
    					</button>
		           </div>
		           <div class="modal-body">
		               <p>Order ID: </p>
		               <form action="" method="post">
		                   <div class="form-group">
		                       <input type="text" class="form-control" name="uorderId" id="uorderId" value="">
		                       <p for="sell">Select list (select one)</p>
		                       <select name="status" id="status" class="form-control">
		                       		<option>pending</option>
		                            <option>processing</option>
		                            <option>on-hold</option>
		                            <option>completed</option>
		                            <option>cancelled</option>
		                            <option>refunded</option>
		                            <option>failed</option>
		                       </select>
		                   </div>
		                   <div class="modal-footer">
		                <button type="submit" class="btn btn-block" name="btn-update">Update</button>
		              
		                  </div>
		               </form>
		           </div>
		       </div>
		   </div>
		</div>


			<div class="modal fade" id="myModal1" role="dialog">
			    <div class="modal-dialog">

			        <!-- Modal content-->
			        <div class="modal-content">
			            <div class="modal-header">
			                
			                <h4 class="modal-title">Confirm Order Deletion	</h4>
			                <button type="button" class="close" data-dismiss="modal">
         					 <span>×</span>
        					</button>
			            </div>
			            <div class="modal-body">
			                <p>Really you want to delete order?</p>
			                <form action="" method="post">
			                    <div class="form-group">
			                        <input type="text" class="form-control" name="dorderId" id="dorderId" value="">
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

 

  <!-- Bootstrap core JavaScript-->
  		<script>
            $(document).on("click", ".open-AddBookDialog", function() {
                var uorderid = $(this).data('id');
                $(".modal-body #uorderId").val(uorderid);
            });
        </script>

        
        <script>
            $(document).on("click", ".open-deleteDialog", function() {
                var dorderid = $(this).data('id');
                $(".modal-body #dorderId").val(dorderid);
            });
        </script>

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
