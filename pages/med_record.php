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
  $query = 'SELECT e.CUST_ID, e.FIRST_NAME, e.LAST_NAME,e.PHONE_NUMBER, e.EMAIL_ADD, l.PET_ID, l.PET_NAME, l.PET_GENDER, l.PET_CATEG, l.PET_COLOR, l.BREED, l.PET_AGE, l.PET_WEIGHT, l.PET_BDAY FROM pet_owner e join pets l on e.CUST_ID = l.CUST_ID WHERE l.PET_ID =' .$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
       $ci= $row['CUST_ID'];
       $fn= $row['FIRST_NAME'];
       $ln=$row['LAST_NAME'];
       $phone=$row['PHONE_NUMBER'];
       $ea=$row['EMAIL_ADD'];

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
            
    <center>
        <div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
                <h5 class="m-2 font-weight-bold text-primary">Pet Information</h5>
            </div>
                
                <div class="card-body">

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h6>
                          Pet Name:<br>
                        </h6>
                      </div>

                      <div class="col-sm-9">
                        <h6>
                          <?php echo $petn; ?> <br>
                        </h6>
                      </div>

                    </div>

                <div class="form-group row text-left">

                    <div class="col-sm-3 text-primary">
                        <h6>
                            Pet Birthdate:<br>
                        </h6>
                    </div>

                    <div class="col-sm-9">
                        <h6>
                            <?php echo $petbd; ?> <br>
                        </h6>
                    </div>

                </div>

                <div class="form-group row text-left">

                    <div class="col-sm-3 text-primary">
                        <h6>
                            Pet Age (Months):<br>
                        </h6>
                    </div>

                    <div class="col-sm-9">
                        <h6>
                            <?php echo $peta; ?> <br>
                        </h6>
                    </div>

                </div>

                <div class="form-group row text-left">

                    <div class="col-sm-3 text-primary">
                        <h6>
                          Pet Weight (kg):<br>
                        </h6>
                    </div>

                    <div class="col-sm-9">
                        <h6>
                          <?php echo $petw; ?> <br>
                        </h6>
                    </div>
                      
                </div>
            </div> 
               
        </div>

            <div class="card shadow mb-4 col-xs-12 col-md-15 border-bottom-primary">
                <div class="card-header py-3">
                        <h4 class="m-2 font-weight-bold text-primary">Medical History</h4> 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                            <thead>
                                <tr>
                                    <th>Allergy</th>
                                    <th>Previous Medical Condition</th>
                                    <th>Current Medical Condition</th>
                                    <th>Consultation Date</th>
                                    <th>Veterinarian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                  
                                    $query = 'SELECT MedRec_ID, p.PET_ID, PET_ALLERGY, PREV_MED_CONDITION, CUR_MED_CONDITION, CUR_CONSULT_DATE, e.EMPLOYEE_ID, CONCAT(e.FIRST_NAME," ", e.LAST_NAME) AS FIRST_NAME FROM med_rec x join pets p on p.PET_ID=x.PET_ID JOIN employee e ON e.EMPLOYEE_ID = x.EMPLOYEE_ID where p.PET_ID =' .$_GET['id'];
                                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                                    
                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                
                                            echo '<tr>';
                                            echo '<td>'. $row['PET_ALLERGY'].'</td>';
                                            echo '<td>'. $row['PREV_MED_CONDITION'].'</td>';
                                            echo '<td>'. $row['CUR_MED_CONDITION'].'</td>';
                                            echo '<td>'. $row['CUR_CONSULT_DATE'].'</td>';
                                            echo '<td>'. $row['FIRST_NAME'].'</td>';
                                            echo '<td align="right"> 
                                                    <div class="btn-group">
                                                    
                                                        <div class="btn-group">
                                                        
                                                            <a type="button" class="btn btn-primary bg-gradient-secondary dropdown no-arrow" data-toggle="dropdown" style="color:white;"> Action <span class="caret"></span>
                                                            </a>

                                                            <ul class="dropdown-menu text-center" role="menu">
                                                                <li>
                                                                <a type="button" class="btn btn-primary bg-gradient-primary btn-block" style="border-radius: 0px;"   href="pet_searchfrm.php?action=edit & id='.$row['PET_ID']. '">
                                                                    <i class="fas fa-fw fa-info-circle"></i> Details
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;"   href="pet_searchfrm.php?action=edit & id='.$row['PET_ID']. '">
                                                                    <i class="fas fa-fw fa-edit"></i> Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" href="cust_edit.php?action=edit & id='.$row['PET_ID']. '">
                                                                    <i class="fas fa-fw fa-trash"></i> Delete
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div> 
                                                </td>
                                            </tr>';
                                    }
                                ?> 

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!--
            <?php                  
                $query = 'SELECT MedRec_ID, p.PET_ID, PET_ALLERGY, PREV_MED_CONDITION, CUR_MED_CONDITION, CUR_CONSULT_DATE, e.EMPLOYEE_ID, CONCAT(e.FIRST_NAME," ", e.LAST_NAME) AS FIRST_NAME FROM med_rec x join pets p on p.PET_ID=x.PET_ID JOIN employee e ON e.EMPLOYEE_ID = x.EMPLOYEE_ID where p.PET_ID =' .$_GET['id'];
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
                while($row = mysqli_fetch_array($result))
                { 
                    $allergy=$row['PET_ALLERGY'];
                    $prev_med=$row['PREV_MED_CONDITION'];
                    $cur_med=$row['CUR_MED_CONDITION'];
                    $cons_date=$row['CUR_CONSULT_DATE'];
                    $vet=$row['FIRST_NAME'];
                }
                $id = $_GET['id'];
            ?>
                <div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
                    <div class="card-header py-3">
                        <h5 class="m-2 font-weight-bold text-primary">Medical History</h5>
                    </div>

                    <div class="form-group row text-left">

                        <div class="col-sm-3 text-primary">
                            <h6>
                            Allergy:<br>
                            </h6>
                        </div>

                        <div class="col-sm-9">
                            <h6>
                            <?php echo $allergy; ?> <br>
                            </h6>
                        </div>

                    </div>

                    <div class="form-group row text-left">

                        <div class="col-sm-3 text-primary">
                            <h6>
                            Previous Medical Condition:<br>
                            </h6>
                        </div>

                        <div class="col-sm-9">
                            <h6>
                            <?php echo $prev_med; ?> <br>
                            </h6>
                        </div>
                        
                    </div>

                    <div class="form-group row text-left">

                        <div class="col-sm-3 text-primary">
                            <h6>
                            Existing Medical Condition:<br>
                            </h6>
                        </div>

                        <div class="col-sm-9">
                            <h6>
                            <?php echo $cur_med; ?> <br>
                            </h6>
                        </div>
                        
                    </div>

                    <div class="form-group row text-left">

                        <div class="col-sm-3 text-primary">
                            <h6>
                            Date of Diagnosis:<br>
                            </h6>
                        </div>

                        <div class="col-sm-9">
                            <h6>
                            <?php echo $cons_date; ?> <br>
                            </h6>
                        </div>
                        
                    </div>

                    <div class="form-group row text-left">

                        <div class="col-sm-3 text-primary">
                            <h6>
                            Veterinarian:<br>
                            </h6>
                        </div>

                        <div class="col-sm-9">
                            <h6>
                            <?php echo $vet; ?> <br>
                            </h6>
                        </div>
                        
                    </div>
                </div>

            -->
                
        <div class="card shadow mb-4 col-xs-12 col-md-15 border-bottom-primary">
            <div class="card-header py-3">
              <center>
              <h4 class="m-2 font-weight-bold text-primary">Immunization Record</h4> </center>
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