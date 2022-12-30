<?php 
    include'includes/connection.php';
    include'includes/sidebar.php';

    if(isset($_GET['date']))
    {
        $date = $_GET['date'];

        $query = $db->prepare('SELECT * FROM bookings WHERE date = ?');
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
        $type = $_POST['type'];
        $reason = $_POST['reason'];
        $notes = $_POST['notes'];
        $timeslot = $_POST['timeslot'];

        $query = $db->prepare('SELECT * FROM bookings WHERE date = ? AND timeslot= ? AND status NOT IN ("denied","cancelled")');
        //SELECT * FROM bookings WHERE date = "2022-11-30" AND timeslot="14:00PM-15:00PM" AND status NOT IN ("denied" ,"cancelled");
        $query->bind_param('ss', $date,$timeslot);

        if($query->execute())
        {
            $result = $query->get_result();
            if($result->num_rows > 0)
            {
                $msg = "<div class='alert alert-danger'>Already Booked </div>";
            }else{
                //save to db
                $query = "INSERT INTO bookings (owner_code,pet_code,type,reason,notes,date,timeslot) VALUES ('$owner_code','$pet_code','$type','$reason','$notes','$date','$timeslot')";
                $query_run = mysqli_query($db,$query);

                $msg = "<div class='alert alert-success'>Booking Success </div>";
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



    <h3 class="text-center"> Book for date <?php echo date('m/d/Y', strtotime($date));?></h3><hr>
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Booking: <span id="slot"></span></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST">
                        <div class="form group">
                            <label for="">Timeslot</label>
                            <input required type="text" readonly name="timeslot" id="timeslot" class="form-control" >
                        </div>

                        <div class="form group">
                            <label>Select Pet Owner</label>
                                <?php
                                    /*<?php echo $_SESSION['id']; ?>*/
                                    $query = "SELECT CUST_ID, CONCAT(FIRST_NAME,' ', LAST_NAME) AS FIRST_NAME FROM pet_owner WHERE CUST_ID={$_SESSION['CUST_ID']}";
                                    //$query = "SELECT CUST_ID FROM pet_owner WHERE CUST_ID={$_SESSION['MEMBER_ID']} AND view LIKE 'active'";
                                    $query_run = mysqli_query($db,$query);
                                    $row = mysqli_fetch_array($query_run);
                                    $pet_row = $row['CUST_ID']; ?>
                                    <input id="owners" type="text" readonly name="owner_code" value="<?php echo $row['FIRST_NAME']?>" class="form-control" placeholder=" ">
                        </div>
                

                        <div class="form group">
                            <label>Select Pet</label>
                                <select name="pet_code" class="form-control" >
                                <option value="" selected disabled> Select Pet </option>
                                <?php
                                    $query = "SELECT * FROM pets WHERE CUST_ID=$pet_row ";
                                    //$query = "SELECT * FROM pet WHERE pet_id=$pet_row AND view LIKE 'active'";
                                    $query_run = mysqli_query($db,$query);
                                    while ($row = mysqli_fetch_array($query_run)){
                                        ?>
                                        <option value="<?= $row['PET_ID']; ?>"> <?= $row['PET_NAME']; ?> - <?= $row['PET_CATEG']; ?></option>
                                        <?php 
                                            }
                                        ?>
                                </select>
                        </div>

                        <div class="form group">
                            <label for="">Type of Appointment</label>
                            <select name="type" class="form-control" required >
                                <option value="" selected disabled> </option>
                                <option value="Walk-in" > Walk-in </option>
                                <option value="Home Service" > Home Service </option>
                            </select>
                        </div>

                        <div class="form group">
                            <label for="">Reason for booking</label>
                            <select name="reason" class="form-control" required >
                                <option value="" selected disabled> </option>
                                <option value="Check-up"> Check-up </option>
                                <option value="Vaccine"> Vaccine </option>
                                <option value="De-worming"> De-worming </option>
                                <option value="Neuter"> Neuter </option>
                                <option value="Spray"> Spray </option>
                            </select>
                        </div>

                        <div class="form group">
                            <label for="">Additional Note/s</label>
                            <input type="text" name="notes" class="form-control" placeholder=" ">
                        </div>
                        
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
    include '../includes/footer.php';
?>


<script type="text/javascript">
    $(".book").click(function(){   
        var timeslot = $(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $("#timeslot").val(timeslot);
        $("#myModal").modal("show");
    })

    /*$(document).ready(function(){
        //alert(hello);
            var owners_id=$("#owners").val();
            $.ajax({
                url: 'action.php',
                method: 'POST',
                data: {owner_code:owners_id},
                success: function(data){
                    $("#pets").html(data);
                }
            })
    });*/
</script>