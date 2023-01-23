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
  $query = 'SELECT * FROM pets WHERE PET_ID ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $ci= $row['PET_ID'];
      $petn=$row['PET_NAME'];
      $petg=$row['PET_GENDER'];
      $petc=$row['PET_CATEG'];
      $petcl=$row['PET_COLOR'];
      $petb=$row['BREED'];
      $peta=$row['PET_AGE'];
      $petw=$row['PET_WEIGHT'];
      $petbd=$row['PET_BDAY'];
    }  
      $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Pet Information</h4>
            </div>
            <div class="card-body">
         
            <form role="form" method="post" action="pet_edit_1.php">
              <input type="hidden" name="id" value="<?php echo $ci; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Pet Name" name="pet_name" value="<?php echo $petn; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Gender:
                </div>
                <div class="col-sm-9">
                  <input type="radio" id="male" name="pet_gender" value="Male">
                  <label for="dog">Male&nbsp&nbsp</label>
                  <input type="radio" id="female" name="pet_gender" value="Female">
                  <label for="cat">Female</label><br>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Birthdate:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Birthdate" name="pet_bday" value="<?php echo $petbd; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Type:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Pet Type"  readonly name="pet_categ" value="<?php echo $petc; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Color:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Pet Color" name="pet_color" value="<?php echo $petcl; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Breed:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Pet Breed" name="pet_breed" value="<?php echo $petb; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Age:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="(0) Months" name="pet_age" value="<?php echo $peta; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Weight:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="(0) Kg" name="pet_weight" value="<?php echo $petw; ?>" required>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block" style="border-radius: 0px;"><i class="fa fa-edit fa-fw"></i>Update</button> 
              </form>  </br>
              <a  href="pet.php" type="button" style="float:right" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back</a>
          </div>
  </div>

<?php
include'../includes/footer.php';
?>