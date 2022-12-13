<?php
include('../includes/connection.php');

    $ci= $_POST['CUST_ID'];
    $si= $_POST['PET_ID'];
    $pn= $_POST['PET_NAME'];
    $pc=$_POST['PET_CATEG'];
    $pb=$_POST['BREED'];
    $pa=$_POST['PET_AGE'];
    $pw=$_POST['PET_WEIGHT'];
	   	
		
	 	$query = 'UPDATE pets SET PET_NAME ="'.$pn.'",
         PET_CATEG ="'.$pc.'", BREED ="'.$pb.'", PET_AGE ="'.$pa.'", 
         PET_WEIGHT="'.$pw.'" WHERE CUST_ID ="'.$ci.'"';
			
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
			alert("You've Update Pet Details Successfully.");
			window.location = "pet.php";
		</script>