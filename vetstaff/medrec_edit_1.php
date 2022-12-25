<?php
include('includes/connection.php');

    
    $p_al = $_POST['pet_allergy'];
    $si = $_POST['MedRec_ID'];
    $p_cd = $_POST['consult_date'];
    $p_mc = $_POST['med_condition'];
    $p_tr = $_POST['treatment'];
    $p_rd = $_POST['recovery_date'];
	   	
		
	 	$query = 'UPDATE med_rec set PET_ALLERGY ="'.$p_al.'", CUR_CONSULT_DATE ="'.$p_cd.'", MED_CONDITION ="'.$p_mc.'", TREATMENT ="'.$p_tr.'", RECOVERY_DATE ="'.$p_rd.'"  WHERE MedRec_ID ="'.$si.'" ';
			$result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
			alert("Record Updated Successfully.");
			window.location = "pet.php";
		</script>