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
                        <h4 class="m-2 font-weight-bold text-primary">Suggested Vaccination Schedule</h4> 
                </div>
                <div class="card-body">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                            <thead>
                                <tr>
                                    <th>Pet Age (Week)</th>
                                    <th>Vaccine Name</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php                  
                                      $query = 'SELECT * FROM vaccine_sched ORDER BY vacc_sched_id ASC'; 
                                      $result = mysqli_query($db, $query) or die(mysqli_error($db));
                                    
                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                
                                            echo '<tr>';
                                            echo '<td>'. $row['PET_VACC_AGE'].'</td>';
                                            echo '<td>'. $row['VACC_DESC'].'</td>';
                                            echo '</tr>';
                                    }
                                ?> 

                            </tbody>
                        </table></br>
                        <a  href="index.php" type="button" style="float:right" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back</a>
                </div>
                
            </div>
        
                
                
    

<?php
include'../includes/footer.php';
?>