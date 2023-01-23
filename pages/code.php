<?php
require ('../includes/connection.php');
require('session.php');
    
// check to see if the user successfully created an account 
if (isset($success) && $success == true){ 
    echo '<font color="green">Yay!! Your account has been created. <a href="login.php">Click here</a> to login!<font>'; 
} 
// check to see if the error message is set, if so display it 
else if (isset($error_msg)) 
    echo '<font color="red">'.$error_msg.'</font>'; 
else
    echo '<font color="green">Yay!! Your account has been created. <a href="login.php">Click here</a> to login!<font>'; // do nothing
    
    ?>

   <?php if (isset($_POST['registerbtn'])){
            
              $fname = $_POST['firstname'];
              $lname = $_POST['lastname'];
              $bday = $_POST['birthdate'];
              $gen = $_POST['gender'];
              $address = $_POST['address'];
              $pn = $_POST['phonenumber'];
              $email = $_POST['email_add'];
              $role = $_POST['user_role'];
              $uname = $_POST['username'];
              $pass = $_POST['password'];
              $cpass = $_POST['confirm_password'];
        
              // verify all the required form data was entered
                if ($uname != "" && $pass != "" && $cpass != ""){
                    // make sure the two passwords match
                    if ($pass === $cpass){
                        // make sure the password meets the min strength requirements
                        if ( strlen($pass) >= 5 && strpbrk($pass, "!#$._,:;()") != false ){
                                 
                                    switch($_GET['action']){
                                        case 'add':     
                                            $query1= "INSERT INTO pet_owner
                                            (CUST_ID, FIRST_NAME, LAST_NAME, GENDER, BIRTHDATE, ADDRESS, PHONE_NUMBER, EMAIL_ADD)
                                            VALUES (Null,'{$fname}','{$lname}','{$gen}','{$bday}','{$address}','{$pn}','{$email}')";
                                            mysqli_query($db,$query1)or die ('Error in updating Database');
                        
                                            $query2 = "INSERT INTO users_owner
                                            (ID, TYPE_ID, CUST_ID, USERNAME, PASSWORD)
                                            VALUES (Null, '{$role}',(SELECT MAX(CUST_ID) FROM pet_owner), '{$uname}', '{$pass}')";
                                            mysqli_query($db,$query2)or die ('Error in updating Database');

                                            break;
                                      }
                                }
                                else
                                    $error_msg = 'The username <i>'.$uname.'</i> is already taken. Please use another username.';
                        }
                        else
                            $error_msg = 'Your password is too weak. Please try again.';
                    }
                    else
                        $error_msg = 'Your passwords did not match.';
                }
                else
                    $error_msg = 'Please fill out all required fields.';

             

    ?>
             