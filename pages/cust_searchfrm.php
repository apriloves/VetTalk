<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?><?php 

                $query = 'SELECT ID, t.TYPE
                          FROM users u
                          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['TYPE'];
                   
if ($Aa=='User'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected
                      alert("Restricted Page! You will be redirected to POS");
                      window.location = "pos.php";
                  </script>
             <?php   }
                         
           
}   
  $query = 'SELECT e.CUST_ID, e.FIRST_NAME, e.LAST_NAME, e.BIRTHDATE, e.ADDRESS, e.PHONE_NUMBER, e.EMAIL_ADD, l.PET_NAME, l.PET_CATEG, l.BREED, l.PET_AGE, l.PET_WEIGHT FROM pet_owner e join pets l on e.CUST_ID = l.CUST_ID WHERE e.CUST_ID ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $ci= $row['CUST_ID'];
      $fn= $row['FIRST_NAME'];
      $ln=$row['LAST_NAME'];
      $bd=$row['BIRTHDATE'];
      $ad=$row['ADDRESS'];
      $phone=$row['PHONE_NUMBER'];
      $ea=$row['EMAIL_ADD'];

      $petn=$row['PET_NAME'];
      $petc=$row['PET_CATEG'];
      $petb=$row['BREED'];
      $peta=$row['PET_AGE'];
      $petw=$row['PET_WEIGHT'];
    }
    $id = $_GET['id'];
?>
            
            <center>
              <div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
                <div class="card-header py-3">
                  <h5 class="m-2 font-weight-bold text-primary">Pet Owner's Detail</h5>
                </div>
                
                <div class="card-body">
                  <div class="form-group row text-left">

                    <div class="col-sm-3 text-primary">
                        <h6>
                          Full Name<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $fn; ?> <?php echo $ln; ?> <br>
                        </h6>
                      </div>

                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Birthdate<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $bd; ?> <br>
                        </h6>
                      </div>
                      
                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Home Address<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $ad; ?> <br>
                        </h6>
                      </div>
                      
                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Phone Number<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $phone; ?> <br>
                        </h6>
                      </div>
                      
                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Email Address<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $ea; ?> <br>
                        </h6>
                      </div>
                      
                    </div>

                    <div class="card-header py-3">
                      <h5 class="m-2 font-weight-bold text-primary">Pet's Detail</h5>
                    </div>
                    <div class="form-group row text-left">

                    <div class="col-sm-3 text-primary">
                        <h6>
                          Pet Name<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $petn; ?> <br>
                        </h6>
                      </div>
                      
                    </div>
                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Pet Category<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $petc; ?> <br>
                        </h6>
                      </div>
                      
                    </div>
                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Pet Breed<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $petb; ?> <br>
                        </h6>
                      </div>
                      
                    </div>
                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Pet Age (Months)<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $peta; ?> <br>
                        </h6>
                      </div>
                      
                    </div>
                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Pet Weight (kg)<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $petw; ?> <br>
                        </h6>
                      </div>
                      
                    </div>
                    <a href="customer.php" type="button" class="btn btn-primary bg-gradient-primary btn-block">
                      <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back 
                    </a>
                  </div>
                </div>
              

<?php
include'../includes/footer.php';
?>