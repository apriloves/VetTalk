<?php

require('../includes/connection.php');
require('session.php');
if (isset($_POST['btnlogin'])) {


  $users = trim($_POST['user']);
  $upass = trim($_POST['password']);
  $h_upass = sha1($upass);
if ($upass == ''){
     ?>    <script type="text/javascript">
                alert("Password is missing!");
                window.location = "login.php";
                </script>
        <?php
}else{
//create some sql statement             
        $sql = "SELECT ID,u.CUST_ID,e.FIRST_NAME,e.LAST_NAME,e.GENDER,e.BIRTHDATE,e.ADDRESS,e.PHONE_NUMBER,e.EMAIL_ADD,p.PET_NAME,p.PET_GENDER,p.PET_CATEG,p.PET_COLOR,p.BREED,p.PET_AGE,p.PET_WEIGHT,t.TYPE
        FROM  `users_owner` u
        join `pet_owner` e on e.CUST_ID=u.CUST_ID
        JOIN `pets` p ON e.CUST_ID=p.CUST_ID
        join `type` t ON t.TYPE_ID=u.TYPE_ID
        WHERE  `USERNAME` ='" . $users . "' AND  `PASSWORD` =  '" . $upass . "'";
        $result = $db->query($sql);

        if ($result){
        //get the number of results based n the sql statement
        //check the number of result, if equal to one   
        //IF theres a result
            if ( $result->num_rows > 0) {
                //store the result to a array and passed to variable found_user
                $found_user  = mysqli_fetch_array($result);
                //fill the result to session variable
                $_SESSION['MEMBER_ID']  = $found_user['ID']; 
                $_SESSION['CUST_ID']  = $found_user['CUST_ID'];
                $_SESSION['FIRST_NAME'] = $found_user['FIRST_NAME']; 
                $_SESSION['LAST_NAME']  =  $found_user['LAST_NAME'];
                $_SESSION['GENDER']  =  $found_user['GENDER'];  
                $_SESSION['BIRTHDATE']  =  $found_user['BIRTHDATE'];
                $_SESSION['ADDRESS']  =  $found_user['ADDRESS'];
                $_SESSION['PHONE_NUMBER']  =  $found_user['PHONE_NUMBER'];
                $_SESSION['EMAIL_ADD']  =  $found_user['EMAIL_ADD'];
                $_SESSION['PET_NAME']  =  $found_user['PET_NAME'];
                $_SESSION['PET_GENDER']  =  $found_user['PET_GENDER']; 
                $_SESSION['PET_CATEG']  =  $found_user['PET_CATEG'];
                $_SESSION['PET_COLOR']  =  $found_user['PET_COLOR'];  
                $_SESSION['BREED']  =  $found_user['BREED']; 
                $_SESSION['PET_AGE']  =  $found_user['PET_AGE']; 
                $_SESSION['PET_WEIGHT']  =  $found_user['PET_WEIGHT']; 
                $_SESSION['TYPE']  =  $found_user['TYPE'];
                $AAA = $_SESSION['MEMBER_ID'];

        //this part is the verification if admin or user ka
        if ($_SESSION['TYPE']=='Pet Owner'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected to index.php
                      alert("Welcome, <?php echo  $_SESSION['FIRST_NAME']; ?> !");
                      window.location = "../petowner/index.php";
                  </script>
             <?php        
           
        }
            } else {
            //IF theres no result
              ?>
                <script type="text/javascript">
                alert("Username or Password Not Registered! Contact Your administrator.");
                window.location = "index.php";
                </script>
              <?php

            }

         } else {
                 # code...
        echo "Error: " . $sql . "<br>" . $db->error;
        }
        
    }       
} 
 $db->close();
?>