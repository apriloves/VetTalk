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
              $p_name = $_POST['petname'];
              $p_al = $_POST['pet_allergy'];
              $p_cd = $_POST['consult_date'];
              $p_mc = $_POST['med_condition'];
              $p_tr = $_POST['treatment'];
              $p_rd = $_POST['recovery_date'];
              $p_vet = $_POST['veterinarian'];
        
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO med_rec
                    (MedRec_ID, PET_ID, PET_ALLERGY, CUR_CONSULT_DATE, MED_CONDITION, TREATMENT, RECOVERY_DATE, EMPLOYEE_ID)
                    VALUES (Null,'{$p_name}', '{$p_al}','{$p_cd}','{$p_mc}','{$p_tr}','{$p_rd}','{$p_vet}')";
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