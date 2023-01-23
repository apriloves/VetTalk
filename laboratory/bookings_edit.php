<?php 
    include'includes/connection.php';
    include'includes/sidebar.php';

  if(isset($_POST['update_btn']))
    {
        $id = $_POST['id'];
        $status = $_POST['status'];

        $emp_id = $_POST['emp_id'];
        $name= $_POST['name'];
        $message = $_POST['message'];
        $time = date('Y-m-d', strtotime($_POST['date']));


        $query = "UPDATE lab_bookings SET status='$status' WHERE LAB_ID='$id'";
        $query_run = mysqli_query($db,$query);

        if($status == "Approved")
        {
            if($query_run)
            {
                $message .= " is APPROVED";
                $query_run2 = mysqli_query($db,"INSERT INTO notif_emp(emp_id,name,message,time) VALUES('$emp_id','$name','$message','$time')");

                if($query_run2)
                {
                    // echo "saved";
                    $_SESSION['success'] = "updated";
                    echo "<script>window.location.href='bookings_active.php'</script>";
                    //header('Location: bookings.php');
                }
            }
        }
        else if ($status == "Denied")
        {
            if($query_run)
            {
                $message .= " is DENIED";
                $query_run2 = mysqli_query($db,"INSERT INTO notif_emp(emp_id,name,message,time) VALUES('$emp_id','$name','$message','$time')");

                if($query_run2)
                {
                    // echo "saved";
                    $_SESSION['success'] = "updated";
                    echo "<script>window.location.href='bookings_active.php'</script>";
                    //header('Location: bookings.php');
                }
            }
        }
        else if ($status == "Cancelled")
        {
            if($query_run)
            {
                $message .= " is CANCELLED";
                $query_run2 = mysqli_query($db,"INSERT INTO notif_emp(emp_id,name,message,time) VALUES('$emp_id','$name','$message','$time')");

                if($query_run2)
                {
                    // echo "saved";
                    $_SESSION['success'] = "updated";
                    echo "<script>window.location.href='bookings_active.php'</script>";
                    //header('Location: bookings.php');
                }
            }
        }
        else
        {
            $_SESSION['status'] = "not updated";
            echo "<script>window.location.href='bookings_active.php'</script>";
            //header('Location: bookings.php');
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
        
            $query = "SELECT l.LAB_ID, l.CUST_ID, l.PET_ID, p.PET_NAME, l.ID, l.date, l.timeslot, l.lab_test, l.status FROM lab_bookings l 
                      JOIN pets p on l.PET_ID = p.PET_ID
                     WHERE l.LAB_ID='$id' ";
            $query_run = mysqli_query($db,$query);

            foreach($query_run as $row);
            {
        ?> 
                
                <form action="#" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $row['LAB_ID']?>" >

                    <input type="hidden" name="emp_id" value="<?php echo $row['ID']?>" >
                    <input type="hidden" name="name" value="Laboratory Appointment">
                    <input type="hidden" name="date" value="<?php echo $row['date']?>" >
                    <input type="hidden" name="message" value="Your <?php echo $row['lab_test']?> Appointment for pet <?php echo $row['PET_NAME']?> for this date <?php echo $row['date']?> and time <?php echo $row['timeslot']?> ">


                    <div class="form group">
                        <label for="">Status</label>
                            <select name="status" class="form-control" >
                                <option value="<?php echo $row['status']; ?>" selected disabled> <?php echo $row['status']; ?> </option>
                                <option value="Approved"> Approved </option>
                                <option value="Denied"> Denied </option>
                                <option value="Cancelled"> Cancelled </option>
                            </select>
                            </div>

                    <div class="modal-footer">
                        <a href="bookings.php" class="btn btn-danger"> CANCEL </a>
                        <button type="submit" name="update_btn" class="btn btn-primary"> UPDATE </button>
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