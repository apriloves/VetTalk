<?php
include'includes/connection.php';
include'includes/sidebar.php';
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
              <center><h4 class="m-2 font-weight-bold text-primary">Sales Report</h4>
              
            </div>
            <div class="card-header py-3" style="text-align:right">
            <?php
        
              $results = mysqli_query($db, "SELECT sum(GRANDTOTAL) FROM transaction") or die(mysqli_error());
                while($rows = mysqli_fetch_array($results)){?>
                <h6 >Total Sales: </h6> <h4 class="m-2 text-primary"><strong> ₱ <?php echo  $rows['sum(GRANDTOTAL)']; ?></strong></h4>
              <?php
                }
            ?>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                        </h1>
                    </div>
                    
                </div>

               <thead>
                   <tr>
                     <th>Date</th>
                     <th>Transaction #</th>
                     <th>Prouct Name</th> 
                     <th>No. of Items</th>  
                     <th>Price</th>
                     <th>Total Amount</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT T.CUST_ID, TD.PRODUCTS, T.NUMOFITEMS, TD.QTY, TD.PRICE, T.GRANDTOTAL, T.DATE, T.TRANS_D_ID
              FROM transaction_details TD
              JOIN transaction T ON TD.`TRANS_D_ID`=T.`TRANS_D_ID`
              GROUP BY TD.TRANS_D_ID';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {
                                 
                echo '<tr>';
                echo '<td>'. $row['DATE'].'</td>';
                echo '<td>'. $row['TRANS_D_ID'].'</td>';
                echo '<td>'. $row['PRODUCTS'].'</td>';
                echo '<td>'. $row['NUMOFITEMS'].'</td>';
                echo '<td>'. $row['PRICE'].'</td>';
                echo '<td>'. $row['GRANDTOTAL'].'</td>';
            }

?>

        
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                  

                  <a href="" onclick="window.print()" class="btn btn-primary" style="float:right"><i class="icon-print icon-large"></i> Print</a>
<?php
include'../includes/footer.php';
?>