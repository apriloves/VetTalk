<?php 
    include'includes/connection.php';
    include'includes/sidebar.php';

    if(isset($_GET['id']))
    {
        $main_id = $_GET['id'];
        $sql_update = mysqli_query($db,"UPDATE notif_emp SET status=1 WHERE id = '$main_id' ");
    }

?>  


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead class="thead dark">
                                    <tr>
                                    <th scope="col">S.no</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sr_no = 1;
                                        $sql_get = mysqli_query($db, "SELECT * FROM notif_emp WHERE id = '$main_id' AND emp_id={$_SESSION['MEMBER_ID']} AND status=1");
                                        while($main_result = mysqli_fetch_assoc($sql_get)) :?>
                                    <tr>
                                    <th scope="row"> <?php echo $sr_no++; ?></th>
                                    <td><?php echo $main_result['name'] ?></td>
                                    <td><?php echo $main_result['message'] ?></td>
                                    <td><?php echo $main_result['time'] ?></td>
                                    <td><a href="notif_delete.php?id=<?php echo $main_result['id']?>" class="text-danger"> <i class="fas fa-trash"></i></a></td>
                                    </tr>
                                    <?php endwhile ?>
                                </tbody>
                            </table>
                        </div> 
                    </div>  
                    <!-- Content Row -->





            

           
<?php 
    include '../includes/footer.php';
?>

    

    

    