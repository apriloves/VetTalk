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
  $query = 'SELECT s.CUST_ID, p.PET_ID, p.PET_NAME, p.PET_CATEG, p.BREED, p.PET_AGE, p.PET_WEIGHT FROM pets p join pet_owner s on s.CUST_ID = p.CUST_ID WHERE s.CUST_ID ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $ci= $row['CUST_ID'];
      $si= $row['PET_ID'];
      $pn= $row['PET_NAME'];
      $pc=$row['PET_CATEG'];
      $pb=$row['BREED'];
      $pa=$row['PET_AGE'];
      $pw=$row['PET_WEIGHT'];
    }  
      $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Pet Dog</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="customer.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
         
            <form role="form" method="post" action="pet_edit_1.php">
                
              <input type="hidden" name="id" value="<?php echo $si; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Pet Name" name="petname" value="<?php echo $pn; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Category:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Pet Category" name="pet_categ" value="<?php echo $pc; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Breed:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Breed" name="breed" value="<?php echo $pb; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Age (months):
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder=" Months" name="pet_age" value="<?php echo $pa; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Weight (kg):
                </div>
                <div class="col-sm-9">
                   <input class="form-control" placeholder=" .kg" name="pet_weight" value="<?php echo $pw; ?>" required>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button> 
              </form>  
          </div>
  </div>

<?php
include'../includes/footer.php';
?>