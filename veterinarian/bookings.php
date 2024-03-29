<?php
    include'includes/connection.php';
    include'includes/sidebar.php';

    if(isset($_GET['date']))
    {
        $date = $_GET['date'];
    }

?>

    <!-- ADD -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary" style="text-align:center"> Appointment's List</h3>
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
            $query = "SELECT * FROM bookings WHERE status='Approved' AND date ='$date'";
            $query_run = mysqli_query($db,$query);
        ?>
        <table class = "table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Timeslot</th>
                    <th>Owner Name</th>
                    <th>Pet</th>
                    <th>Type</th>
                    <th>Purpose</th>
                    <th>Additional Notes</th>
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
                                $query = "SELECT FIRST_NAME,LAST_NAME FROM pet_owner WHERE CUST_ID={$row['owner_code']}";
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
                                $query = "SELECT PET_NAME,PET_CATEG FROM pets WHERE PET_ID={$row['pet_code']}";
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
                        <td><?php echo $row['type']; ?></td>
                        <td><?php echo $row['reason']; ?></td>
                        <td><?php echo $row['notes']; ?></td>
                        
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
<?php
    include'../includes/footer.php';
?>