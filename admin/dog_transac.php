<?php
include'includes/connection.php';
include'includes/sidebar.php';
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
              $cname = $_POST['petowner'];
              $p_name = $_POST['petname'];
              $p_gender = $_POST['pet_gender'];
              $p_color = $_POST['pet_color'];
              $p_breed = $_POST['breed'];
              $p_age = $_POST['pet_age'];
              $p_weight = $_POST['pet_weight'];
              $p_bday = $_POST['pet_bday'];
        
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO pets
                    (PET_ID, CUST_ID, PET_NAME, PET_GENDER, PET_CATEG, PET_COLOR, BREED, PET_AGE, PET_WEIGHT, PET_BDAY)
                    VALUES (Null,'{$cname}', '{$p_name}','{$p_gender}','dog','{$p_color}','{$p_breed}','{$p_age}','{$p_weight}','{$p_bday}')";
                    mysqli_query($db,$query)or die ('Error in updating Database');
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "pet.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>