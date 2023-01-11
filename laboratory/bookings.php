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
        <h3 class="m-0 font-weight-bold text-primary" style="text-align:center"> Approved Appointment(s)</h3>
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
            
            $query = "SELECT * FROM lab_bookings WHERE status='Approved' AND date ='$date'";
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
                    <th>Action</th>
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
                        <?php 
                                $query = "SELECT * FROM lab_bookings WHERE LAB_ID={$row['LAB_ID']}";
                                $query_run1 = mysqli_query($db,$query);
                            ?>
                                <?php 
                                if(mysqli_num_rows($query_run1) > 0)
                                {
                                    while($row1 = mysqli_fetch_assoc($query_run1))
                                    {
                                ?>
                                    <?php echo '<td align="right">
                                         <a type="button" class="btn btn-primary bg-gradient-primary" href="booking_view.php?action=edit & id='.$row['LAB_ID'] . '"><i class="fas fa-fw fa-info-circle"></i> Details</a>  </td>'; 
                            
                                    }
                                }
                                else
                                {
                                    echo "No record found";
                                }
                            ?>
                            
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