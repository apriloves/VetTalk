<?php
    include'../includes/connection.php';

    $output = '';
    $query = "SELECT * FROM pets WHERE CUST_ID='".$_POST['owner_code']."' ";
    $query_run = mysqli_query($db,$query);
    $output.='<option value= "" disabled selected> Select Pet </option>';
    while ($row = mysqli_fetch_array($query_run))
    {
        $output.='<option value= "'.$row["PET_ID"].'" > '.$row["PET_CATEG"].' - '.$row["PET_NAME"].'</option>';
    }
    echo $output;
   

?>