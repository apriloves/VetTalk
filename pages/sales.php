<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
  $query = 'SELECT ID, t.TYPE
            FROM users u
            JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  
  while ($row = mysqli_fetch_assoc($result)) {
            $Aa = $row['TYPE'];
                   
  if ($Aa=='User'){
?>
  <script type="text/javascript">
    //then it will be redirected
    alert("Restricted Page! You will be redirected to POS");
    window.location = "pos.php";
  </script>
<?php
  }           
}
            ?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Sales Report</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        </h1>
                    </div>
                    
                </div>
                <strong>Daily Sales:</strong>
                <input id="dailyDate" type="date" class="btn btn-default btn-sm" placeholder=""
                value="<?= date('Y-m-d'); ?>">

               <thead>
                   <tr>
                     <th>Product Code</th>
                     <th>Name</th>                    
                     <th>Category</th>
                     <th>Price</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT PRODUCT_ID, PRODUCT_CODE, NAME, CNAME, PRICE FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID GROUP BY PRODUCT_CODE';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['PRODUCT_CODE'].'</td>';
                echo '<td>'. $row['NAME'].'</td>';
                echo '<td>'. $row['CNAME'].'</td>';
                echo '<td>'. $row['PRICE'].'</td>';
            }
?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>

                <div id="printBut" class="pull-right">
                <button type="button" class="btn btn-success btn-sm">
                    PRINT
                    <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
                </button>
                </div>

<?php
include'../includes/footer.php';
?>
