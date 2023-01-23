<?php 
require_once('sales.php');

$date = $_GET['date'];
$weeklySales = $sales->weekly_sales($date);


 ?>
 <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/bootstrap-theme.min.css">
    <!-- Font Awesome -->
    <link href="../assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
        print();
    </script>
  </head>
  <body>
    
 <center>
    <h1>Sales Report</h1>
    <h2><?= $date; ?></h2>
 </center>
<br />
<div class="table-responsive">
        <table id="myTable-sales" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th><center>Product Code</center></th>
                    <th><center>Name</center></th>
                    <th><center>Category</center></th>
                    <th><center>Price</center></th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $total = 0;
                foreach($weeklySales as $ws):
                $subTotal = number_format($ws['price'] * $ws['qty'], 2);   
                $total += $subTotal; 
            ?>
                <tr>
                    <td align="center"><?= $ws['PRODUCT_CODE']; ?></td>
                    <td align="center"><?= $ws['NAME']; ?></td>
                    <td align="center"><?= $ws['CNAME']; ?></td>    
                    <td align="center"><?= number_format($ws['PRICE'],2); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="right"><strong>TOTAL:</strong></td>
                <td align="center">
                    <strong><?= number_format($total,2); ?></strong>
                </td>
            </tr>
        </table>
</div>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<!-- for the datatable of employee -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable-sales').DataTable();
    });
</script>

<?php 
$sales->Disconnect();
 ?>