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
            <div class="card-body">
              <div class="form-group row text-left mb-0">
                <div class="col-sm-9">
                  <h4 class="font-weight-bold">
                    Laboratory Record
                  </h4>
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
                <th>Date</th>
                <th>Pet Owner</th>
                <th>Pet Name</th>
                <th>Laboratory Test</th>
                <th>Veterinarian</th>
                <th> </th>
              </tr>
            </thead>    
            <tbody>
<?php  
           $query = 'SELECT *, CONCAT(P.FIRST_NAME," ", P.LAST_NAME) AS  FIRST_NAME, tt.PET_NAME, u.ID, CONCAT(e.FIRST_NAME," ", e.LAST_NAME) AS  EMP_NAME
           FROM lab_bookings T
           JOIN pet_owner P ON T.`CUST_ID`=P.`CUST_ID`
           JOIN pets tt ON tt.`PET_ID`=T.`PET_ID`
           JOIN users u ON u.`ID`=T.`ID`
           JOIN employee e ON e.`EMPLOYEE_ID`=u.`EMPLOYEE_ID`
           WHERE status = "Approved" AND LAB_ID ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {
              
                echo '<tr>';
                echo '<td>'. $row['date'].'</td>';
                echo '<td>'. $row['FIRST_NAME'].'</td>';
                echo '<td>'. $row['PET_NAME'].'</td>';
                echo '<td>'. $row['lab_test'].'</td>';
                echo '<td>'. $row['EMP_NAME'].'</td>';
                echo '<td align="center"> 
                        <div class="btn-group">
                            
                          <div class="btn-group">
                            <a type="button" class="btn btn-primary bg-gradient-secondary dropdown no-arrow" data-toggle="dropdown"     style="color:white;"></i>  Action 
                            </a>
                            <ul class="dropdown-menu text-center" role="menu">
                              <li>
                                <a type="button" class="btn btn-warning bg-gradient-primary btn-block" style="border-radius: 0px;"   href="app_details.php?action=edit & id='.$row['LAB_ID']. '">
                                  <i class="fas fa-fw fa-edit"></i> Details
                                </a>
                              </li>
                              <li>
                                <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="pet_edit.php?action=edit & id='.$row['LAB_ID']. '">
                                <i class="fas fa-fw fa-edit"></i> Edit
                                </a>
                              </li>
                              <li>
                                <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" href="pet_del.php?action=edit & id='.$row['LAB_ID']. '">
                                <i class="fas fa-fw fa-edit"></i> Delete
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                        
                          <div class="btn-group">
                            
                          <div class="btn-group">
                            <a type="button" data-toggle="modal" data-target="#aModal" class="btn btn-primary bg-gradient-secondary dropdown no-arrow" data-toggle="dropdown" style="color:white;" href="app_details.php?action=edit & id='.$row['LAB_ID']. '> <i class="fas fa-flip-horizontal fa-fw fa-plus"></i> Add Lab Result 
                            </a>
                          </div>
                        </div> 
                      </td>';
                        echo '</tr> ';
                        }
?>
            </tbody>

          </table>
            <a  href="pet.php" type="button" style="float:right" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;">  Back</a>
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
            <?php if (isset($_GET['error'])): ?>
                <p> <?php echo $_GET['error'] ?> </p>
            <?php endif ?>
          <form action="result.php" method="post" enctype="multipart/form-data">
            <label>Select file to upload: </label></br>
            <input type="file" name="file"></br>
            <input style="float:right" type="submit" value="Upload" name="submit">
          </form>
        </div>
      </div>
    </div>
</div>