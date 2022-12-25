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

// JOB SELECT OPTION TAB
$sql = "SELECT DISTINCT TYPE, TYPE_ID FROM type";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='type'>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['TYPE_ID']."'>".$row['TYPE']."</option>";
  }

$opt .= "</select>";

        $query = "SELECT ID, e.FIRST_NAME, e.LAST_NAME, e.GENDER, USERNAME, PASSWORD, e.EMAIL, PHONE_NUMBER, r.JOB_TITLE, e.HIRED_DATE, t.TYPE, l.PROVINCE, l.CITY
                      FROM users u
                      join employee e on u.EMPLOYEE_ID = e.EMPLOYEE_ID
                      join role r on e.JOB_ID=r.JOB_ID
                      join location l on e.LOCATION_ID=l.LOCATION_ID
                      join type t on u.TYPE_ID=t.TYPE_ID
                      WHERE ID =".$_SESSION['MEMBER_ID'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
          while($row = mysqli_fetch_array($result))
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

       
            <div class="card-header py-3">
              <center><h4 class="m-2 font-weight-bold text-primary">Admin Profile</h4></center>
            </div>
            <div class="card-body">
      
              <div class="form-group row text-left text-primary">
                <div class="col-sm-2">
                 Full Name:
                </div>
                <div class="col-sm-3 text-secondary">
                    <?php echo $a; ?> <?php echo $b; ?> <br>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-2">
                 Gender:
                </div>
                <div class="col-sm-3 text-secondary">
                    <?php echo $c; ?> <br>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-2">
                 Address:
                </div>
                <div class="col-sm-3 text-secondary">
                    <?php echo $j; ?>, <?php echo $k; ?> <br>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-2">
                 Contact No.:
                </div>
                <div class="col-sm-3 text-secondary">
                    <?php echo $g; ?> <br>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-2">
                 Email Address:
                </div>
                <div class="col-sm-3 text-secondary">
                    <?php echo $f; ?> <br>
                </div>
              </div>

              <div class="form-group row text-left text-primary">
                <div class="col-sm-2">
                 Role:
                </div>
                <div class="col-sm-3 text-secondary">
                    <?php echo $l; ?> <br>
                </div>
              </div>
            <!--
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Hired Date:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Hired Date" name="hireddate" value="<?php echo $i; ?>" required>
                </div>
              </div>
              
              <div class="form-group row text-left text-primary">
                <div class="col-sm-3" style="padding-top: 5px;">
                  Account Type:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Account Type" name="type" value="<?php echo $l; ?>" readonly>
                </div>
              </div>
        -->
              <hr>

                <a href="admin_prof_edit.php?action=edit & id='<?php echo $zz; ?>'" type="button" class="btn btn-warning btn-block">
                    <i class="fa fa-edit fa-fw"></i>Edit Profile</>    
                </a>
             
            </div>
              

<?php
include'../includes/footer.php';
?>

