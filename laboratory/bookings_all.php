<?php 
    include'includes/connection.php';
    include'includes/sidebar.php';

?>
 
<!-- SIGNUP -->

<!-- Modal 
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
        <div class="modal-body">
            <div class="form group">
                <label>User Id</label>
                <input type="text" name="user_id" class="form-control" placeholder="Enter ID">
            </div>

            <div class="form group">
                <label>User Role</label>
                <select type="text" name="user_role" class="form-control">
                    <option value=""></option>
                    <option value="patient">Patient</option>
                    <option value="admin">Admin</option>
                    <option value="doctor">Veterinarian</option>
                    <option value="staff">Veterinarian Staff</option>
                    <option value="laboratory">Laboratory</option>
                    <option value="patient">Patient</option>
                </select>
            </div>

            <div class="form group">
                <label>User Description</label>
                <input type="text" name="user_description" class="form-control" placeholder="Enter Description">
            </div>

            <div class="form group">
                <label>Username</label>
                <input type="text" name="user_username" class="form-control" placeholder="Enter Username">
            </div>

            <div class="form group">
                <label>Password </label>
                <input type="password" name="user_password" class="form-control" placeholder="Enter Password">
            </div>

            <div class="form group">
                <label>Confirm Password </label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save changes</button>
        </div>
    </form>

    </div>
  </div>
</div>-->


    <!-- ADD -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary" style="text-align:center"> Appointment's List
            <!-- Button trigger modal 
            <button type="button" class="btn btn-primary" data-toggle="modal" style="float:right" data-target="#exampleModal">
                Add Admin
            </button>-->
        </h3>
        </div>
    
    <div class="card-body">
        <?php 
        //session success and fail
            if(isset($_SESSION['success']) && ($_SESSION['success']) !='')
            {
                echo '<h2 class="bg-primary text-white"> '.$_SESSION['success'].' </h2>';
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['status']) && ($_SESSION['status']) !='')
            {
                echo '<h2 class="bg-danger text-white"> '.$_SESSION['status'].' </h2>';
                unset($_SESSION['status']);
            }
        ?>

        <div class="table-responsive">
        <?php
            $query = "SELECT * FROM lab_bookings";
            $query_run = mysqli_query($db,$query);
        ?>
        <table class = "table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>Date</th>
                    <th>Timeslot</th>
                    <th>Owner Name</th>
                    <th>Pet</th>
                    <th>Prescribed Laboratory Test</th>
                    <th>Status</th>
                </tr>
            </thead>
                <tbody>
                    <?php
                        if(mysqli_num_rows($query_run) > 0)
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                                ?>
                                
                                <tr>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['timeslot']; ?></td>
                        <td><?php 
                                $query = "SELECT FIRST_NAME,LAST_NAME FROM pet_owner WHERE CUST_ID={$row['CUST_ID']}";
                                $query_run1 = mysqli_query($db,$query);
                            ?>
                                <?php 
                                if(mysqli_num_rows($query_run1) > 0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run1))
                                    {
                                ?>
                                    <?php echo $row1['FIRST_NAME']; ?>    
                            <?php
                                    }
                                }
                                else
                                {
                                    echo "No record found";
                                }
                            ?></td>
                        <td><?php 
                                $query = "SELECT PET_NAME,PET_CATEG FROM pets WHERE PET_ID={$row['PET_ID']}";
                                $query_run1 = mysqli_query($db,$query);
                            ?>
                                <?php 
                                if(mysqli_num_rows($query_run1) > 0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run1))
                                    {
                                ?>
                                    <?php echo $row1['PET_NAME']; ?> - <?php echo $row1['PET_CATEG']; ?>   
                            <?php
                                    }
                                }
                                else
                                {
                                    echo "No record found";
                                }
                            ?></td>
                        <td><?php echo $row['lab_test']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        
                    </tr>
                    <?php
                            }
                        }
                        else
                        {
                            echo "No record found";
                        }
                    ?>
                </tbody>
            </table>    
        </div>
    </div>
</div>


    

</div> 
<!-- container-fluid -->






 

<?php
    include'../includes/footer.php';
?>