<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <?php
              $sql_get = mysqli_query($db, "SELECT * FROM notif_user WHERE cust_id={$_SESSION['CUST_ID']} AND status=0");
              $count = mysqli_num_rows($sql_get);

            ?>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i> <span class= "badge badge-danger" id="count"> <?php echo $count ?></span>
                  </a>
                  `<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php
                      $sql_get1 = mysqli_query($db, "SELECT * FROM notif_user WHERE cust_id={$_SESSION['CUST_ID']} AND status=0");
                      if(mysqli_num_rows($sql_get1) > 0)
                      {
                        while($result = mysqli_fetch_assoc($sql_get1))
                        {
                          echo '<a class="dropdown-item text-primary" href="read_msg.php?id='.$result['id'].'"> '.$result['name'].'</a>';
                          echo '<div class="dropdown-divider"></div>';
                        }
                      }
                      else
                      {
                        echo '<a class="dropdown-item text-danger font-weight-bold" href="#"> No Message/s</a>';
                      }
                    ?>
                  </div>
                </li>
              </ul>
            </div>