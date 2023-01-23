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
            <h4 class="m-2 font-weight-bold text-primary" style="text-align:center">Patient's List</h4> 
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="5%">        
                  <thead>
                      <tr>
                        <th>Pet Name</th>
                        <th>Pet Gender</th>
                        <th>Breed</th>
                        <th>Pet Owner</th>
                        <th></th>
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
                    WHERE status = "Approved" AND tt.PET_ID = T.`PET_ID`';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['PET_NAME'].'</td>';
                      echo '<td>'. $row['PET_GENDER'].'</td>';
                      echo '<td>'. $row['BREED'].'</td>';
                      echo '<td>'. $row['FIRST_NAME'].'</td>';
                      echo '<td align="right"> 
                        <div class="btn-group">
                            
                          <div class="btn-group">
                            <a type="button" class="btn btn-primary bg-gradient-secondary dropdown no-arrow" data-toggle="dropdown"     style="color:white;"> Action <span class="caret"></span>
                            </a>
                              
                            <ul class="dropdown-menu text-center" role="menu">
                              <li>
                                <a type="button" class="btn btn-warning bg-gradient-primary btn-block" style="border-radius: 0px;"   href="pet_searchfrm.php?action=edit & id='.$row['PET_ID']. '">
                                  <i class="fas fa-fw fa-edit"></i> Details
                                </a>
                              </li>
                              <li>
                                <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="pet_edit.php?action=edit & id='.$row['PET_ID']. '">
                                <i class="fas fa-fw fa-edit"></i> Edit
                                </a>
                              </li>
                              <li>
                                <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" href="pet_del.php?action=edit & id='.$row['PET_ID']. '">
                                <i class="fas fa-fw fa-edit"></i> Delete
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div> 
                          
                        <div class="btn-group">
                          
                          <div class="btn-group">
                                                        
                            <a type="button" class="btn btn-primary bg-gradient-secondary dropdown no-arrow" data-toggle="dropdown" style="color:white;"> Laboratory Records <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu text-center" role="menu">
                              <li>
                                <a type="button" class="btn btn-primary bg-gradient-primary btn-block" style="border-radius: 0px;"   href="pet_app_list.php?action=edit & id='.$row['LAB_ID']. '">
                                <i class="fas fa-fw fa-edit"></i> Laboratory History
                                </a>
                              </li>
                            </ul>
                          </div>

                          </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<?php
include'../includes/footer.php';
?>

<!-- Dog Information Modal-->
<div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          

          <h5 class="modal-title" id="exampleModalLabel" >Dog Information</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form role="form" method="post" action="dog_transac.php?action=add">
            <div class="form-group">
              <label> Pet Owner </label>
              
              <?php
                
                $query ='SELECT s.CUST_ID, CONCAT(s.FIRST_NAME," ", s.LAST_NAME) AS FIRST_NAME FROM pet_owner s';
                $result = mysqli_query($db, $query) or die(mysqli_error($db));
                if($result->num_rows> 0){
                  $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
            
            ?>
            <select class="form-control" name="petowner" required >
              <option>  </option>
                <?php 
                  foreach ($options as $option){
                ?>
                <option>
                   <?php echo $option['CUST_ID']; echo "  "; echo  $option['FIRST_NAME']; ?> 
                </option>
                <?php 
              }
                 ?>
          </select>
        </div>
        
           <div class="form-group">
            <label> Pet Name </label>
             <input class="form-control" name="petname" required>
           </div>
           <div class="form-group">
           <label> Pet Birthdate </label>
             <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" placeholder="Birthdate" name="pet_bday" required>
           </div>

           <div class="form-group">
              <label> Pet Gender </label>
              <input type="radio" id="male" name="pet_gender" value="male">
              <label for="dog">Male&nbsp&nbsp</label>
              <input type="radio" id="female" name="pet_gender" value="female">
              <label for="dog">Female</label><br>
           </div>

            <div class="form-group">
            <label> Pet Color </label>
              <input type="text"class="form-control" placeholder="Pet Color" name="pet_color" required>
            </div>
           <div class="form-group">
           <label> Breed </label>
              <input type="text"class="form-control" placeholder="Breed" name="breed" required>
            </div>

           <div class="form-group">
           <label> Age </label>
              <input type="text"class="form-control" placeholder="0months" name="pet_age" required>
            </div>
            <div class="form-group">
           <label> Weight </label>
              <input type="text"class="form-control" placeholder="0kg" name="pet_weight" required>
            </div>

           <div class="form-group">
             
           
            <hr>
              <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
              <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>