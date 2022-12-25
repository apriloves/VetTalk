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
  $query2 = 'SELECT ID, e.FIRST_NAME, e.LAST_NAME, e.GENDER, USERNAME, PASSWORD, e.EMAIL, PHONE_NUMBER, r.JOB_TITLE, e.HIRED_DATE, t.TYPE, l.PROVINCE, l.CITY
            FROM users u
            join employee e on u.EMPLOYEE_ID = e.EMPLOYEE_ID
            join role r on r.JOB_ID=r.JOB_ID
            join location l on e.LOCATION_ID=l.LOCATION_ID
            join type t on u.TYPE_ID=t.TYPE_ID
            WHERE ID ='.$_GET['id'];

  $result2 = mysqli_query($db, $query2) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result2))
    {   
      $zz= $row['ID'];
      $a= $row['FIRST_NAME'];
      $b=$row['LAST_NAME'];
      $c=$row['GENDER'];
      $d=$row['USERNAME'];
      $e=$row['PASSWORD'];
      $f=$row['EMAIL'];
      $g=$row['PHONE_NUMBER'];
      $h=$row['JOB_TITLE'];
      $i=$row['HIRED_DATE'];
      $j=$row['PROVINCE'];
      $k=$row['CITY'];
      $l=$row['TYPE'];
    }
    $id = $_GET['id'];
?>
          <center>
              <div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
                <div class="card-header py-3">
                  <h5 class="m-2 font-weight-bold text-primary"><?php echo $a; ?>'s Detail</h5>
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
                          : <?php echo $a; ?> <?php echo $b; ?> <br>
                        </h6>
                      </div>

                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Gender<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $c; ?> <br>
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
                          : <?php echo $k; ?>, <?php echo $j; ?> <br>
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
                          : <?php echo $g; ?> <br>
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
                          : <?php echo $f; ?> <br>
                        </h6>
                      </div>
                      
                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Username<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $d; ?> <br>
                        </h6>
                      </div>
                      
                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Password<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $e; ?> <br>
                        </h6>
                      </div>
                      
                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Role<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $l; ?> <br>
                        </h6>
                      </div>
                      
                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Hired Date<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          : <?php echo $i; ?> <br>
                        </h6>
                      </div>
                      
                    </div>

                    

                    <a href="user.php" type="button" class="btn btn-primary bg-gradient-primary btn-block">
                      <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back 
                    </a>
                  </div>
                </div>

<?php
include'../includes/footer.php';
?>