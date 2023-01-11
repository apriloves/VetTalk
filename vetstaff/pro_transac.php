<?php
include'../includes/connection.php';
?>
          <!-- Page Content eto yun-->
          <div class="col-lg-12">
            <?php
              $pc = $_POST['prodcode'];
              $name = $_POST['name'];
              $desc = $_POST['description'];
              $qty = $_POST['quantity'];
              $oh = $_POST['onhand'];
              $pr = $_POST['price']; 
              $cat = $_POST['category'];
              $supp = $_POST['supplier'];
              $dats = $_POST['datestock'];
              $md = $_POST['mdate'];
              $ed = $_POST['edate'];

        
              switch($_GET['action']){
                case 'add':  
                
                    $query = "INSERT INTO product
                              (PRODUCT_ID, PRODUCT_CODE, NAME, DESCRIPTION, QTY_STOCK, ON_HAND, PRICE, CATEGORY_ID, SUPPLIER_ID, DATE_STOCK_IN, MDATE, EDATE)
                              VALUES (Null,'{$pc}','{$name}','{$desc}',{$qty},{$oh},{$pr},{$cat},{$supp},'{$dats}','{$md}','{$ed}')";
                    mysqli_query($db,$query)or die ('Error in updating product in Database '.$query);
                    
                break;
              }
            ?>
              <script type="text/javascript">window.location = "product.php";</script>
          </div>

<?php
include'../includes/footer.php';
?>