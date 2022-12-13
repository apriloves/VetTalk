<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?><?php 

                $query = 'SELECT ID, t.TYPE
                          FROM users u
                          JOIN type t ON t.TYPE_ID=u.TYPE_ID WHERE ID = '.$_SESSION['MEMBER_ID'].'';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $Aa = $row['TYPE'];
                   
if ($Aa=='User'){
           
             ?>    <script type="text/javascript">
                      //then it will be redirected
                      alert("Restricted Page! You will be redirected to POS");
                      window.location = "pos.php";
                  </script>
             <?php   }
                         
           
}   
            ?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $fname = $_POST['firstname'];
              $lname = $_POST['lastname'];
              $bday = $_POST['birthdate'];
              $address = $_POST['address'];
              $pn = $_POST['phonenumber'];
              $email = $_POST['email_add'];
              $p_name = $_POST['petname'];
              $p_categ = $_POST['pet_categ'];
              $p_breed = $_POST['breed'];
              $p_age = $_POST['pet_age'];
              $p_weight = $_POST['pet_weight'];
        
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO pet_owner
                    (CUST_ID, FIRST_NAME, LAST_NAME, BIRTHDATE, ADDRESS, PHONE_NUMBER, EMAIL_ADD)
                    VALUES (Null,'{$fname}','{$lname}','{$bday}','{$address}','{$pn}','{$email}')";
                    mysqli_query($db,$query)or die ('Error in updating Database');

                    $query2 = "INSERT INTO pets
                    (PET_ID, CUST_ID, PET_NAME, PET_CATEG, BREED, PET_AGE, PET_WEIGHT)
                    VALUES (Null,(SELECT MAX(CUST_ID) FROM pet_owner), '{$p_name}','{$p_categ}','{$p_breed}','{$p_age}','{$p_weight}')";
                    mysqli_query($db,$query2)or die ('Error in updating Database');
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "customer.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>