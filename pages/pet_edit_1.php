<?php
include('../includes/connection.php');

	$ci = $_POST['id'];
	$petn = $_POST['pet_name'];
	$petg = $_POST['pet_gender'];
	$petbd = $_POST['pet_bday'];
	$petc = $_POST['pet_categ'];
	$petcl = $_POST['pet_color'];
	$petb = $_POST['pet_breed'];
	$peta = $_POST['pet_age'];
	$petw = $_POST['pet_weight'];
	   	
		
	 	$query = 'UPDATE pets set PET_NAME ="'.$petn.'", PET_GENDER ="'.$petg.'", PET_CATEG ="'.$petc.'", PET_COLOR ="'.$petcl.'", 
			BREED="'.$petb.'", PET_AGE ="'.$peta.'", PET_WEIGHT ="'.$petw.'", PET_BDAY ="'.$petbd.'" WHERE PET_ID ="'.$ci.'"';
			$result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
			alert("You've Update Pet Owner Successfully.");
			window.location = "pet.php";
		</script>