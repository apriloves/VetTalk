<?php
    include'includes/connection.php';
    include'includes/sidebar.php';

    $sql = "SELECT u.ID, e.EMPLOYEE_ID, CONCAT(e.FIRST_NAME,' ', e.LAST_NAME) AS FIRST_NAME, r.JOB_ID FROM users u 
    JOIN employee e ON u.EMPLOYEE_ID = e.EMPLOYEE_ID
    JOIN role r ON e.JOB_ID = r.JOB_ID  
    WHERE e.JOB_ID ='3'";
    $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

    $aaa = "<select class='form-control' name='vet' required>
        <option disabled selected hidden>Select Veterinarian</option>";
    while ($row = mysqli_fetch_assoc($result)) {
    $aaa .= "<option value='".$row['ID']."'>".$row['FIRST_NAME']."</option>";
    }
    
    $aaa .= "</select>";

?>

<?php
         

    if(isset($_GET['date']))
    {
        $date = $_GET['date'];

        $query = $db->prepare('SELECT * FROM lab_bookings WHERE date = ?' );
        $query->bind_param('s', $date);
        $bookings = array();

        if($query->execute())
        {
            $result = $query->get_result();
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $bookings[] = $row['timeslot'];
                    //echo ($bookings);
                }
                $query->close();
            }
        }
    }

    if(isset($_POST['submit']))
    {
        //something was posted
        $owner_code= $_POST['owner_code'];
        $pet_code = $_POST['pet_code'];
        $vet = $_POST['vet'];
        $timeslot = $_POST['timeslot'];
        $lab_test = $_POST['lab_test'];
        $message = "Veterinary Clinic book an appointment. Check your pending appointments";

        //$id = $_POST['id'];
        //$status = $_POST['status'];
        //$emp_id = $_POST['emp_id'];
        //$name= $_POST['name'];
        //$message = $_POST['message'];
        $time = date('Y-m-d', strtotime($_POST['date']));

        $query = $db->prepare('SELECT * FROM lab_bookings WHERE date = ? AND timeslot= ? AND status NOT IN ("denied","cancelled")');
        $query->bind_param('ss', $date,$timeslot);

        if($query->execute())
        {
            $result = $query->get_result();
            if($result->num_rows > 0)
            {
                $msg = "<div class='alert alert-danger'>Already Booked </div>";
            }else{
                //save to db
                $query = "INSERT INTO lab_bookings (CUST_ID,PET_ID,ID,date,timeslot,lab_test,status) VALUES ('$owner_code','$pet_code','$vet','$date','$timeslot', '$lab_test','pending')";
                $query_run = mysqli_query($db,$query);

                if($query_run)
                {
                    //query para ipasok sa notif_emp, basta reference mo sa emp_id yung id ni vet
                    $query_run2 = mysqli_query($db,"INSERT INTO notif_emp(emp_id,name,message,time) VALUES('10','Veterinary Clinic','$message','$date')");

                    
                    if($query_run2)
                    {
                        // echo "saved";
                        $_SESSION['success'] = "updated";
                        echo "<script>window.location.href='lab_calendar.php'</script>";
                
                    }
                    else
                    {

                        $_SESSION['success'] = "notif failed";
                        echo "<script>window.location.href='lab_calendar.php'</script>";

                    }
                }
        
                else
                {
                    $_SESSION['status'] = "not updated";
                    echo "<script>window.location.href='lab_calendar.php'</script>";

                }

                $msg = "<div class='alert alert-success'>Laboratory Booking Success </div>";
                $bookings[]=$timeslot;
            }
        }

    }
   

    $duration = 60;
    $cleanup = 0;
    $start = "09:00";
    $end = "15:00";

    function timeslots($duration,$cleanup,$start,$end)
    {
        $start = new DateTime($start);
        $end =  new DateTime($end);
        $interval = new DateInterval("PT".$duration."M");
        $cleanupInterval = new DateInterval("PT".$cleanup."M");
        $slots = array();

        for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval))
        {
            $endPeriod = clone $intStart;
            $endPeriod->add($interval);
            if ($endPeriod>$end)
            {
                break;
            }

            $slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");
        }
        return $slots;
    }
?>



    <h2 class="text-center"> Book for date <?php echo date('m/d/Y', strtotime($date));?></h2><hr>
    <div class="row">
        <div class="col-md-12">
            <?php echo isset($msg)?$msg:"";?>
        </div>
    <?php $timeslots = timeslots($duration,$cleanup,$start,$end);
        foreach($timeslots as $ts)
        {
    ?>
        <div class="col-md-2">
            <div class= "form-group">
                <?php if(in_array($ts,$bookings)){?>
                    <button class="btn btn-danger"><?php echo $ts; ?></button>
                <?php } else{ ?>
                    <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
                <?php } ?>     
            </div>
        </div>
    <?php } ?>
    </div>



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Booking: <span id="slot"></span></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form action="#" method="POST">
                    <div class="form group">
                        <label for="">Timeslot</label>
                        <input required type="text" readonly name="timeslot" id="timeslot" class="form-control" >
                    </div></br>

                    <div class="form-group">
                        <label for="">Veterinarian</label>
                        <?php
                        echo $aaa;
                        ?>
                    </div>

                    <div class="form group">
                        <label for="">Select Owner</label>
                        <select name="owner_code" id="owners" class="form-control" required>
                            <option value="" selected disabled> Select Owner </option>
                            <?php
                                $query = "SELECT * FROM pet_owner";
                                $query_run = mysqli_query($db,$query);
                                while ($row = mysqli_fetch_array($query_run)){
                                    ?>
                                    <option value="<?= $row['CUST_ID']; ?>"> <?= $row['LAST_NAME']; ?> , <?= $row['FIRST_NAME']; ?></option>
                                    <?php 
                                        }
                                    ?>
                        </select>
                    </div></br>
                    <div class="form group">
                        <label for="">Select Pet </label>
                        <select name="pet_code" id="pets" class="form-control" required>
                        </select>
                    </div></br>

                    <div class="form group">
                    <label>Prescribed Laboratory Test(s):</label></br>
                    <label>
                        <input type="checkbox" name="lab_test" value="CBC">
                        Complete Blood Count
                        <span></span>
                    </label></br>
                    <label>
                        <input type="checkbox" name="lab_test" value="Blood Chem">
                        Blood Chem
                        <span></span>
                    </label></br>
                    <label>
                        <input type="checkbox" name="lab_test" value="Xray">
                        Xray
                        <span></span>
                    </label></br>
                    <label>
                        <input type="checkbox" name="lab_test" value="Ultrasound">
                        Ultrasound
                        <span></span>
                    </label></br>
                    <label>
                        <input type="checkbox" name="lab_test" value="Urinalysis">
                        Urinalysis
                        <span></span>
                    </label>
                    </div></br>

                    <div class="form group align-right">
                        <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                    </div>          
                    
                    
                    
                </form>
            </div> 
        </div>
      </div>
    </div>
  </div>
</div>












<?php
    include'../includes/footer.php';
?>

<script type="text/javascript">
    $(".book").click(function(){   
        var timeslot = $(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $("#timeslot").val(timeslot);
        $("#myModal").modal("show");
    })

    $(document).ready(function(){
        //alert(hello);
        $("#owners").change(function(){
            var owners_id=$("#owners").val();
            $.ajax({
                url: 'action.php',
                method: 'POST',
                data: {owner_code:owners_id},
                success: function(data){
                    $("#pets").html(data);
                }
            })
        });
    });
</script>