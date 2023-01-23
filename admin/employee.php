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
            <h4 class="m-2 font-weight-bold text-primary" style="text-align:center">Employee's List
              <a  href="#" data-toggle="modal" data-target="#aModal" type="button" style="float:right" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"> <i class="fas fa-fw fa-plus"></i> Add Employee</a> </h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
                  <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Role</th>
                          <th>Action</th>
                        </tr>
                     </thead>
                    <tbody>
                    <?php                  
                        $query = 'SELECT e.EMPLOYEE_ID, e.FIRST_NAME, e.LAST_NAME, r.JOB_TITLE FROM employee e JOIN role r ON e.JOB_ID=r.JOB_ID WHERE NOT e.JOB_ID ="1"';
                        $result = mysqli_query($db, $query) or die (mysqli_error($db));
                        while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>'. $row['FIRST_NAME'].'</td>';
                        echo '<td>'. $row['LAST_NAME'].'</td>';
                        echo '<td>'. $row['JOB_TITLE'].'</td>';

                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary" href="emp_searchfrm.php?action=edit & id='.$row['EMPLOYEE_ID'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="emp_edit.php?action=edit & id='.$row['EMPLOYEE_ID']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                </li>
                            </ul>
                            </div>
                          </div> </td>';
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

<div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          

          <h5 class="modal-title" id="exampleModalLabel" >Add Employee</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-body">

                        <form role="form" method="post" action="emp_transac.php?action=add">
                        
                            <div class="form-group">
                            <label> First Name </label>
                              <input class="form-control" placeholder="First Name" name="firstname" required>
                            </div>
                            <div class="form-group">
                            <label> Last Name </label>
                              <input class="form-control" placeholder="Last Name" name="lastname" required>
                            </div>
                            <div class="form-group">
                            <label> Email </label>
                              <input class="form-control" placeholder="Email" name="email" required>
                            </div>
                            <div class="form-group">
                            <label> Phone Number </label>
                              <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
                            </div>
                            
                            <div class="form-group">
                          <label> Job Role </label>
                          <?php
                            $sql = 'SELECT DISTINCT JOB_TITLE, JOB_ID FROM role WHERE NOT JOB_ID = "1"';
                            $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

                            if($result->num_rows> 0){
                              $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                            }
                        
                        ?>
                          <select class="form-control" name="job_name" required >
                            <option>  </option>
                              <?php 
                                foreach ($options as $option){
                              ?>
                              <option>
                                <?php echo  $option['JOB_TITLE']; ?> 
                              </option>
                              <?php 
                            }
                              ?>
                        </select>
                        </div>

                            <div class="form-group">
                            <label> Date Hired </label>
                              <input type="date" id="FromDate" name="hireddate" value="yyyy-MM-dd" class="form-control" />
                            </div>
                            <div class="form-group">
                            <label> Province </label>
                              <input class="form-control" id="province" placeholder="Province" name="province" required></select>
                            </div>
                            <div class="form-group">
                            <label> City </label>
                              <input class="form-control" id="city" placeholder="City" name="city" required></select>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>
                            
                        </form>  
                      </div>
            </div>
          </div></center>
        


          <!--script>  
window.onload = function() {  

  // ---------------
  // basic usage
  // ---------------
  var $ = new City();
  $.showProvinces("#province");
  $.showCities("#city");

  // ------------------
  // additional methods 
  // -------------------

  // will return all provinces 
  console.log($.getProvinces());
  
  // will return all cities 
  console.log($.getAllCities());
  
  // will return all cities under specific province (e.g Batangas)
  console.log($.getCities("Batangas")); 
  
}
</script>
