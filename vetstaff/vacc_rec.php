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
            
    <center>
                
        <div class="card shadow mb-4 col-xs-12 col-md-15 border-bottom-primary">
            <div class="card-header py-3">
              <center>
              <h4 class="m-2 font-weight-bold text-primary">Vaccination Record</h4> </center>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                    <thead>
                        <tr>
                            <th>Vaccine</th>
                            <th>Vaccination Date</th>
                            <th>Veterinarian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                  
                            $query = 'SELECT p.PET_ID, VACC_NAME, VACC_DATE, CONCAT(e.FIRST_NAME," ", e.LAST_NAME) AS FIRST_NAME FROM vaccination v join pets p on v.PET_ID=p.PET_ID JOIN employee e ON v.EMPLOYEE_ID = e.EMPLOYEE_ID where p.PET_ID =' .$_GET['id']; 'ORDER BY VACC_DATE DESC';
                            $result = mysqli_query($db, $query) or die (mysqli_error($db));
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                                        
                                echo '<tr>';
                                echo '<td>'. $row['VACC_NAME'].'</td>';
                                echo '<td>'. $row['VACC_DATE'].'</td>';
                                echo '<td>'. $row['FIRST_NAME'].'</td>';
                                echo '</tr> ';
                            }
                        ?> 
                                        
                    </tbody>
                </table>
               </div>
            </div>
        </div>
                <div>
                    <a href="pet.php" type="button" class="btn btn-primary bg-gradient-primary btn-block">
                      <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back 
                    </a>
                </div>
    

<?php
include'../includes/footer.php';
?>