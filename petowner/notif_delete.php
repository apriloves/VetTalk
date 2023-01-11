<?php 
    include'includes/connection.php';
    include'includes/sidebar.php';

    if(isset($_GET['id']))
    {
        $delete_id = $_GET['id'];
        $sql_delete = mysqli_query($db,"DELETE FROM notif_user WHERE id = '$delete_id' ");
        if($sql_delete)
        {
            echo "<script>window.location.href='read_msg.php'</script>";
        }
        else
        {
            echo mysqli_error($db);
        }
    }

?>  


    