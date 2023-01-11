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
  //$query = 'SELECT e.CUST_ID, e.FIRST_NAME, e.LAST_NAME,e.PHONE_NUMBER, e.EMAIL_ADD, l.PET_ID, l.PET_NAME, l.PET_GENDER, l.PET_CATEG, l.PET_COLOR, l.BREED, l.PET_AGE, l.PET_WEIGHT, l.PET_BDAY FROM pet_owner e join pets l on e.CUST_ID = l.CUST_ID WHERE l.PET_ID =' .$_GET['id'];

  //$result = mysqli_query($db, $query) or die(mysqli_error($db));
   // while($row = mysqli_fetch_array($result))
   // {   
       // $ci= $row['CUST_ID'];
       //$fn= $row['FIRST_NAME'];
       //$ln=$row['LAST_NAME'];
       //$phone=$row['PHONE_NUMBER'];
       //$ea=$row['EMAIL_ADD'];

      //$petn=$row['PET_NAME'];
      //$petg=$row['PET_GENDER'];
      //$petc=$row['PET_CATEG'];
      //$petcl=$row['PET_COLOR'];
      //$petb=$row['BREED'];
      //$peta=$row['PET_AGE'];
      //$petw=$row['PET_WEIGHT'];
      //$petbd=$row['PET_BDAY'];

   // }
   // $id = $_GET['id'];

   $query = 'SELECT l.PET_ID, e.CUST_ID, l.PET_NAME, l.PET_GENDER, l.BREED, l.PET_AGE, l.PET_WEIGHT, l.PET_BDAY from pets l JOIN pet_owner e on l.CUST_ID = e.CUST_ID WHERE l.PET_ID ='.$_GET['id']; 

   $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      
      $petn=$row['PET_NAME'];
      $petg=$row['PET_GENDER'];
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
                        <h4 class="m-2 font-weight-bold text-primary">Medical History
                            <a  href="#" data-toggle="modal" data-target="#aModal" type="button" style="float:right" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"> <i class="fas fa-fw fa-plus"></i> 
                            </a>
                       </h4>
                       
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                            <thead>
                                <tr>
                                    <th>Allergy</th>
                                    <th>Consultation Date</th>
                                    <th>Medical Condition</th>
                                    <th>Treatment</th>
                                    <th>Recovery Date</th>
                                    <th>Veterinarian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                  
                                    $query = 'SELECT x.MedRec_ID, p.PET_ID, x.PET_ALLERGY, x.MED_CONDITION, x.TREATMENT, x.RECOVERY_DATE, x.CUR_CONSULT_DATE, e.EMPLOYEE_ID, CONCAT(e.FIRST_NAME," ", e.LAST_NAME) AS FIRST_NAME FROM med_rec x join pets p on p.PET_ID=x.PET_ID JOIN employee e ON e.EMPLOYEE_ID = x.EMPLOYEE_ID where p.PET_ID =' .$_GET['id']; 'SORT BY CUR_CONSULT_DATE';
                                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                                    
                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                
                                            echo '<tr>';
                                            echo '<td>'. $row['PET_ALLERGY'].'</td>';
                                            echo '<td>'. $row['CUR_CONSULT_DATE'].'</td>';
                                            echo '<td>'. $row['MED_CONDITION'].'</td>';
                                            echo '<td>'. $row['TREATMENT'].'</td>';
                                            echo '<td>'. $row['RECOVERY_DATE'].'</td>';
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
                                                                <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;"   href="med_rec_edit.php?action=edit & id='.$row['MedRec_ID']. '">
                                                                    <i class="fas fa-fw fa-edit"></i> Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" href="medrec_del.php?action=edit & id='.$row['MedRec_ID']. '">
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

                
        
            <div>
                <a href="pet.php" type="button" class="btn btn-primary bg-gradient-primary btn-block">
                    <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back 
                </a>
            </div>

<?php
include'../includes/footer.php';
?>

<div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          

          <h5 class="modal-title" id="exampleModalLabel" >Medical Information</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form role="form" method="post" action="med_rec_transac.php?action=add">
            <div class="form-group">
              <label> Pet Name </label>
              <?php
                
                $query ='SELECT PET_ID, PET_NAME FROM pets WHERE PET_ID = ' .$_GET['id'];
                $query_run = mysqli_query($db,$query);
                $row = mysqli_fetch_array($query_run);
                ?>
                <input id="pet" type="text" readonly name="petname" value="<?php echo $row['PET_NAME']?>" class="form-control" placeholder=" ">
            
            
          
        </div>
        
           <div class="form-group">
            <label> Pet Allergy </label>
             <input class="form-control" name="pet_allergy" required>
           </div>
           <div class="form-group">
           <label> Consultation Date </label>
             <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" placeholder="Consultation Date" name="consult_date" required>
           </div>

            <div class="form-group">
            <label> Medical Condition </label>
              <textarea type="text"class="form-control" placeholder="Medical Condition" name="med_condition" required></textarea>
            </div>
           <div class="form-group">
           <label> Treatment </label>
              <textarea type="text"class="form-control" placeholder="Treatment" name="treatment" required></textarea>
            </div>
            <div class="form-group">
           <label> Recovery Date </label>
             <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" placeholder="Recovery Date" name="recovery_date" >
           </div>

            <div class="form-group">
              <label> Veterinarian </label>
              
              <?php
                
                $query ='SELECT e.EMPLOYEE_ID, CONCAT(e.FIRST_NAME," ", e.LAST_NAME) AS EMPLOYEE_NAME, r.JOB_ID FROM employee e JOIN role r on e.JOB_ID = r.JOB_ID WHERE e.JOB_ID = "3"';
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                if($result->num_rows> 0){
                  $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
            
            ?>
            <select class="form-control" placeholder="Choose Veterinarian" name="veterinarian" required >
              <option>  </option>
                <?php 
                  foreach ($options as $option){
                ?>
                <option>
                   <?php echo $option['EMPLOYEE_ID']; echo " - Dr."; echo  $option['EMPLOYEE_NAME']; ?> 
                </option>
                <?php 
              }
                 ?>
          </select>
        </div>

           
            <hr>
              <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>