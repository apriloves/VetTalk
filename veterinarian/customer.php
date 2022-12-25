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
            <h4 class="m-2 font-weight-bold text-primary" style="text-align:center">Pet Owner's List
              <a  href="#" data-toggle="modal" data-target="#aModal" type="button" style="float:right" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"> <i class="fas fa-fw fa-plus"></i> Add Pet Owner</a> </h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <!-- <th>Phone Number</th> -->
                        <th>Phone Number</th>
                        <th></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT CUST_ID, FIRST_NAME, LAST_NAME, PHONE_NUMBER FROM pet_owner';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['FIRST_NAME'].'</td>';
                      echo '<td>'. $row['LAST_NAME'].'</td>';
                      // echo '<td>'. $row['PET_NAME'].'</td>';
                      echo '<td>'. $row['PHONE_NUMBER'].'</td>';
                      echo '<td align="center"> <div class="btn-group">
                              
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-secondary dropdown no-arrow" data-toggle="dropdown"     style="color:white;"> Action <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-primary btn-block" style="border-radius: 0px;"   href="cust_searchfrm.php?action=edit & id='.$row['CUST_ID']. '">
                                  <i class="fas fa-fw fa-edit"></i> Details
                                  </a>
                                </li>
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="cust_edit.php?action=edit & id='.$row['CUST_ID']. '"> 
                                  <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-danger btn-block" style="border-radius: 0px;" href="cust_del.php?action=edit & id='.$row['CUST_ID']. '"> 
                                  <i class="fas fa-fw fa-edit"></i> Delete
                                  </a>
                                </li>
                              </ul>
                            </div>
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

 <!-- Client Information Modal-->
 <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" >Client Information</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="cust_transac.php?action=add">
           <div class="form-group">
            <label> First Name </label>
             <input class="form-control" name="firstname" placeholder="ex. Juan" required>
           </div>
           <div class="form-group">
           <label> Last Name </label>
             <input class="form-control" name="lastname" placeholder="ex. Dela Cruz" required>
           </div>
           <div class="form-group">
           <label> Birthdate </label>
             <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" name="birthdate" required>
           </div>
           <div class="form-group">
              <label> Gender </label>
              <input type="radio" id="male" name="gender" value="Male">
              <label for="male">Male&nbsp&nbsp</label>
              <input type="radio" id="female" name="gender" value="Female">
              <label for="female">Female</label><br>
           </div>
           <div class="form-group">
           <label> Address </label>
             <textarea rows="5" cols="50" class="form-control" placeholder="House No.   Blk    Lot   Street Name" name="address" required></textarea>
           </div>
           <div class="form-group">
           <label> Phone Number </label>
              <input class="form-control" placeholder="09xxxxxxxxx" name="phonenumber" required>
            </div>
           <div class="form-group">
           <label> Email Address </label>
             <input class="form-control" placeholder="example@example.com" name="email_add" required>
           </div>

          <!-- Pet Information Modal-->
           <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Pet Information</h5>
          </div>
        <div class="modal-body">
          <form role="form" method="post" action="cust_transac.php?action=add">
           <div class="form-group">
            <label> Pet Name </label>
             <input class="form-control" name="petname" required>
           </div>
           <div class="form-group">
            <label> Pet Category </label><br>
             <input type="radio" id="dog" name="pet_categ" value="dog">
            <label for="dog">Dog&nbsp&nbsp</label>
              <input type="radio" id="cat" name="pet_categ" value="cat">
            <label for="cat">Cat</label><br>
           </div>
           <div class="form-group">
           <label> Breed </label>
              <input type="text"class="form-control" placeholder="Breed" name="breed" required>
            </div>
            <div class="form-group">
            <label> Pet Birthdate </label>
             <input type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control" placeholder="Birthdate" name="pet_birthdate" required>
           </div>

           <div class="form-group">
              <label> Pet Gender </label>
              <input type="radio" id="male" name="pet_gender" value="male">
              <label for="dog">Male&nbsp&nbsp</label>
              <input type="radio" id="female" name="pet_gender" value="female">
              <label for="cat">Female</label><br>
           </div>

            <div class="form-group">
            <label> Pet Color </label>
              <input type="text"class="form-control" placeholder="Pet Color" name="pet_color" required>
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