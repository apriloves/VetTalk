<?php
include('../includes/connection.php');

	$ci = $_POST['id'];
	$fn = $_POST['firstname'];
	$ln = $_POST['lastname'];
	$bd = $_POST['birthdate'];
	$ad = $_POST['address'];
	$phone = $_POST['phonenumber'];
	$ea = $_POST['email_add'];
	   	
		
	 	$query = 'UPDATE pet_owner set FIRST_NAME ="'.$fn.'",
			LAST_NAME ="'.$ln.'", BIRTHDATE ="'.$bd.'", ADDRESS ="'.$ad.'", 
			PHONE_NUMBER="'.$phone.'", EMAIL_ADD ="'.$ea.'" WHERE CUST_ID ="'.$ci.'"';
			$result = mysqli_query($db, $query) or die(mysqli_error($db));
							
?>	
	<script type="text/javascript">
			alert("You've Update Pet Owner Successfully.");
			window.location = "customer.php";
		</script>