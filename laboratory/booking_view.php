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
 $query = 'SELECT *, FIRST_NAME, LAST_NAME, PET_NAME 
              FROM lab_bookings T
              JOIN pet_owner P ON T.`CUST_ID`=P.`CUST_ID`
              JOIN pets tt ON tt.`PET_ID`=T.`PET_ID`
              WHERE LAB_ID ='.$_GET['id'];
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result)) {
          $fname = $row['FIRST_NAME'];
          $lname = $row['LAST_NAME'];
          $date = $row['date'];
          $timeslot = $row['timeslot'];
          $pname = $row['PET_NAME'];
          $lab_test = $row['lab_test'];
        }
?>
            
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="form-group row text-left mb-0">
                <div class="col-sm-9">
                  <h4 class="font-weight-bold">
                    Laboratory Appointment
                  </h4>
                </div>
                <div class="col-sm-3 py-1">
                  <h6>
                    Date: <?php echo $date; ?>
                  </h6>
                </div>
                <div class="col-sm-9">
                  <h6 >
                    Referral From: Veterinary Clinic </h6> 
                  
                </div>
              </div>
<hr>
              
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="8%">Date</th>
                <th width="15%">Timeslot</th>
                <th width="15%">Pet Owner</th>
                <th width="10%">Pet Name</th>
                <th width="15%">Laboratory Test</th>
                <th width="15%">Veterinarian</th>
              </tr>
            </thead>
            <tbody>
<?php  
           $query = 'SELECT *, CONCAT(P.FIRST_NAME," ", P.LAST_NAME) AS  FIRST_NAME, tt.PET_NAME, CONCAT(e.FIRST_NAME," ", e.LAST_NAME) AS  EMP_NAME
           FROM lab_bookings T
           JOIN pet_owner P ON T.`CUST_ID`=P.`CUST_ID`
           JOIN pets tt ON tt.`PET_ID`=T.`PET_ID`
           JOIN employee e ON e.`EMPLOYEE_ID`=T.`EMPLOYEE_ID`
           WHERE LAB_ID ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {
              
                echo '<tr>';
                echo '<td>'. $row['date'].'</td>';
                echo '<td>'. $row['timeslot'].'</td>';
                echo '<td>'. $row['FIRST_NAME'].'</td>';
                echo '<td>'. $row['PET_NAME'].'</td>';
                echo '<td>'. $row['lab_test'].'</td>';
                echo '<td>'. $row['EMP_NAME'].'</td>';
                echo '</tr> ';
                        }
?>
            </tbody>

          </table>
            
          </div>
          <div class="col-sm-1 py-1">
        </div>
      </div>
    </div>
  </div>


<?php
include'../includes/footer.php';
?>

<div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          

          <h5 class="modal-title" id="exampleModalLabel" >Upload Laboratory Result</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="result.php" method="post" enctype="multipart/form-data">
            <label>Select file to upload: </label></br>
            <input type="file" name="lab_file" id="lab_file"></br>
            <input style="float:right" type="submit" value="Upload File" name="submit">
          </form>
        </div>
      </div>
    </div>
</div>
