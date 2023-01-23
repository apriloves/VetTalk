
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

          <!-- Nav Item - Alerts -->
          <?php
              $sql_get = mysqli_query($db, "SELECT * FROM notif_emp WHERE emp_id={$_SESSION['MEMBER_ID']} AND status=0");
              $count = mysqli_num_rows($sql_get);

            ?>
              <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter"> <?php echo $count ?></span>
                            </a>

                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Unread Notifications
                                </h6>
                                <?php
                                  $sql_get1 = mysqli_query($db, "SELECT * FROM notif_emp WHERE emp_id={$_SESSION['MEMBER_ID']} AND status=0 ORDER BY date_created DESC");
                                  if(mysqli_num_rows($sql_get1) > 0)
                                  {
                                    while($result2 = mysqli_fetch_assoc($sql_get1))
                                    {
                                      echo '<a class="dropdown-item d-flex align-items-center" href="read_msg.php?id='.$result2['id'].'"> 
                                      <div>
                                        <div class="small text-gray-500">'.$result2['date_created'].'</div>
                                        <div class="font-weight-bold">'.$result2['name'].'</div>
                                        <span class="">'.$result2['message'].'</span>
                                      </div>
                                        </a>';
                                    }
                                  }
                                  else
                                  {
                                    echo '<a class="dropdown-item text-danger font-weight-bold" href="#"> No Message/s</a>';
                                  }
                                ?>               
                                <a class="dropdown-item text-center small text-gray-500" href="notifs_all.php">Show All Notifications </a>
                            </div>
                        </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo  $_SESSION['FIRST_NAME']. ' '.$_SESSION['LAST_NAME'] ;?></span>
                <img class="img-profile rounded-circle"
                <?php
                  if($_SESSION['GENDER']=='Male'){
                    echo 'src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS0rikanm-OEchWDtCAWQ_s1hQq1nOlQUeJr242AdtgqcdEgm0Dg"';
                  }else{
                    echo 'src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNngF0RFPjyGl4ybo78-XYxxeap88Nvsyj1_txm6L4eheH8ZBu"';
                  }
                ?>>

              </a>

              <?php 

                $query = 'SELECT ID, FIRST_NAME,LAST_NAME,USERNAME,PASSWORD
                          FROM users u
                          JOIN employee e ON e.EMPLOYEE_ID=u.EMPLOYEE_ID';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $a = $_SESSION['MEMBER_ID'];
                }
                          
            ?>

              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!--<button class="dropdown-item" onclick="on()"> -->
                <a class="dropdown-item" href="admin_prof.php?action=edit & id='<?php echo $a; ?>'">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                </button>
                <a class="dropdown-item" href="settings.php?action=edit & id='<?php echo $a; ?>'">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
          
        <!-- Begin Page Content -->
        <div class="container-fluid">