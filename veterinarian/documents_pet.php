<?php
include'includes/connection.php';
include'includes/sidebar.php';
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
?> 
<div class="card shadow mb-4">
            <div class="card-header py-3">
            <h4 class="m-2 font-weight-bold text-primary" style="text-align:center">Laboratory Record</h4> 
            </div>
            
<div class="card shadow mb-4">
            <div class="card-body">
              
<hr>
              
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th width="8%">Date</th>
                <th width="15%">Pet Owner</th>
                <th width="10%">Pet Name</th>
                <th width="15%">Laboratory Test</th>
                <th width="15%">Laboratory Result</th>
                <th width="8%">Date Uploaded</th>
              </tr>
            </thead>
            <tbody>
  <?php
           $query = 'SELECT *, CONCAT(P.FIRST_NAME," ", P.LAST_NAME) AS FIRST_NAME, T.LAB_ID, T.date, tt.PET_NAME, u.ID, CONCAT(e.FIRST_NAME," ", e.LAST_NAME) AS  EMP_NAME FROM lab_rec R
           JOIN lab_result RR ON R.result_id =RR.`result_id`
           JOIN lab_bookings T ON R.`LAB_ID`=T.`LAB_ID`
           JOIN pet_owner P ON T.`CUST_ID`=P.`CUST_ID`
           JOIN pets tt ON T.`PET_ID`=tt.`PET_ID`
           JOIN users u ON T.`ID`=u.`ID`
           JOIN employee e ON u.`EMPLOYEE_ID`= e.`EMPLOYEE_ID`
           WHERE tt.PET_ID = '.$_GET['id'];
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                <td><?php echo $row['date'] ?></td>
                <td><?php echo $row['FIRST_NAME'] ?></td>
                <td><?php echo $row['PET_NAME'] ?></td>
                <td><?php echo $row['lab_test'] ?></td>
                <td> <a href="../lab_files/<?php echo $row['result_file'] ?>" target="_blank" style="align:center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspClick to view result</td>
                <td><?php echo $row['uploaded_on'] ?></td>
                </tr>
                <?php
 }
 ?>      

            </tbody>

          </table>
          <a  href="pet.php" type="button" style="float:center" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back</a>
          </div>
          <div class="col-sm-1 py-1">
        </div>
      </div>
    </div>
  </div>

                  </div>
                </div>
              

<?php
include'../includes/footer.php';
?>
