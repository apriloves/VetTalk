<?php 
    include'includes/connection.php';
    include'includes/sidebar.php';

  if(isset($_POST['update_btn']))
    {
        $id = $_POST['id'];
        $status = $_POST['status'];


        $query = "UPDATE lab_bookings SET status='$status' WHERE LAB_ID='$id'";
        $query_run = mysqli_query($db,$query);

        if($query_run)
        {
            // echo "saved";
            $_SESSION['success'] = "Appointment Update Succesful!";
            echo "<script>window.location.href='calendar.php'</script>";
            //header('Location: calendar.php');
        }
        else
        {
            $_SESSION['status'] = "Appointment Update Fail!";
            echo "<script>window.location.href='bookings.php'</script>";
            //header('Location: calendar.php');
        }

    }

?>
 
    <!-- ADD -->
<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Status </h6>
    </div>

    <div class="card-body">
        
    <?php
        if(isset($_POST['edit_btn']))
        {
            $id = $_POST['edit_id'];
        
            $query = "SELECT LAB_ID,status FROM lab_bookings WHERE LAB_ID='$id' ";
            $query_run = mysqli_query($db,$query);

            foreach($query_run as $row);
            {
        ?> 
                
            <form action="#" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $row['LAB_ID']?>" >


                <div class="form group">
                    <label for="">Status</label>
                        <select name="status" class="form-control" >
                            <option value="<?php echo $row['status']; ?>" selected disabled> <?php echo $row['status']; ?> </option>
                            <option value="" Disabled>  </option>
                            <option value="Approved"> Approved </option>
                            <option value="Denied"> Denied </option>
                            <option value="Cancelled"> Cancelled </option>
                        </select>
                        </div>

                <div class="modal-footer">
                    <a href="bookings.php" class="btn btn-danger"> CANCEL </a>
                    <button type="submit" name="update_btn" class="btn btn-primary"> Update </button>
                </div>

            </form>

        <?php
            }
        }
        ?>       

    </div>
    </div>





</div> 
<!-- container-fluid -->



<?php
    include'../includes/footer.php';
?>