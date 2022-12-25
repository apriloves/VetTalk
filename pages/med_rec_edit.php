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
  $query = 'SELECT * FROM med_rec WHERE MedRec_ID ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      
      $si= $row['MedRec_ID'];
      $ci= $row['PET_ID'];
      $p_al=$row['PET_ALLERGY'];
      $p_cd=$row['CUR_CONSULT_DATE'];
      $p_mc=$row['MED_CONDITION'];
      $p_tr=$row['TREATMENT'];
      $p_rd=$row['RECOVERY_DATE'];
      $p_vet=$row['EMPLOYEE_ID'];
    }  
      $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Medical Information</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="pet.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
         
            <form role="form" method="post" action="medrec_edit_1.php">
              <input type="hidden" name="id" value="<?php echo $si; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Pet Allergy:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Pet Allergy" name="pet_allergy" value="<?php echo $p_al; ?>" >
                </div>
              </div>
              
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Consultation Date:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="yyyy/mm/dd" name="consult_date" value="<?php echo $p_cd; ?>" >
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Medical Condition:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Medical Condition" name="med_condition" value="<?php echo $p_mc; ?>" >
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Treatment:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Treatment" name="treatment" value="<?php echo $p_tr; ?>" >
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Recovery Date:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="yyyy/mm/dd" name="recovery_date" value="<?php echo $p_rd; ?>" >
                </div>
              </div>
              <!--<div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Veterinarian
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Veterinarian" name="veterinarian" value="<?php echo $p_vet; ?>" required>
                </div>
              </div>
-->
              
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button> 
              </form>  
          </div>
  </div>

<?php
include'../includes/footer.php';
?>