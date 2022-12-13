
                            <!-- Tab panes -->
                            <div class="tab-content">
                              <!-- 1ST TAB -->
                                <div class="tab-pane fade in mt-2" id="checkup">
                                  <div class="row">
                                      <?php  $query = 'SELECT * FROM services WHERE CATEGORY_ID=1 GROUP BY SERVICE_CODE ORDER by SERVICE_CODE ASC';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($service = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-2" >
                                      <form method="post" action="services.php?action=add&id=<?php echo $service['SERVICE_ID']; ?>">
                                          <div class="service">
                                              <h6 class="text-info"><?php echo $service['NAME']; ?></h6>
                                              <h6>₱ <?php echo $service['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="name" value="<?php echo $service['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $service['PRICE']; ?>" />
                                              <input type="submit" name="addservice" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add" />
                                          </div>
                                      </form>
                                  </div>
                                      <?php endwhile; ?>
                                    </div>
                                </div>
                                            <?php
                                        endif;
                                    endif;   
                                    ?>
                              <!-- 2ND TAB -->
                                <div class="tab-pane fade in mt-2" id="vaccines">
                                  <div class="row">
                                      <?php  $query = 'SELECT * FROM services WHERE CATEGORY_ID=2 GROUP BY SERVICE_CODE ORDER by SERVICE_CODE ASC';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($service = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-2" >
                                      <form method="post" action="services.php?action=add&id=<?php echo $service['SERVICE_ID']; ?>">
                                          <div class="service">
                                              <h6 class="text-info"><?php echo $service['NAME']; ?></h6>
                                              <h6>₱ <?php echo $service['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="name" value="<?php echo $service['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $service['PRICE']; ?>" />
                                              <input type="submit" name="addservice" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add" />
                                          </div>
                                      </form>
                                  </div>
                                      <?php endwhile;
                                        endif;
                                    endif;   
                                    ?>
                                    </div>
                                </div>
                               <!-- 3RD TAB -->
                              <div class="tab-pane fade in mt-2" id="deworm">
                                  <div class="row">
                                      <?php  $query = 'SELECT * FROM services WHERE CATEGORY_ID=3 GROUP BY SERVICE_CODE ORDER by SERVICE_CODE ASC';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($service = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-2" >
                                      <form method="post" action="services.php?action=add&id=<?php echo $service['SERVICE_ID']; ?>">
                                          <div class="service">
                                              <h6 class="text-info"><?php echo $service['NAME']; ?></h6>
                                              <h6>₱ <?php echo $service['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="name" value="<?php echo $service['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $service['PRICE']; ?>" />
                                              <input type="submit" name="addservice" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add" />
                                          </div>
                                      </form>
                                  </div>
                                  <?php endwhile;
                                        endif;
                                    endif;   
                                    ?>
                                    </div>
                                </div>

                            <!-- 4TH TAB -->

                                <div class="tab-pane fade in mt-2" id="surgery">
                                  <div class="row">
                                      <?php  $query = 'SELECT * FROM services WHERE CATEGORY_ID=4 GROUP BY SERVICE_CODE ORDER by SERVICE_CODE ASC';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($service = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-2" >
                                      <form method="post" action="services.php?action=add&id=<?php echo $service['SERVICE_ID']; ?>">
                                          <div class="service">
                                              <h6 class="text-info"><?php echo $service['NAME']; ?></h6>
                                              <h6>₱ <?php echo $service['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="name" value="<?php echo $service['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $service['PRICE']; ?>" />
                                              <input type="submit" name="addservice" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add" />
                                          </div>
                                      </form>
                                  </div>
                                  <?php endwhile;
                                        endif;
                                    endif;   
                                    ?>
                                    </div>
                                </div>



<!-- end of tab pane -->
                            </div>
                        </div>
                        <!-- /.panel-body -->
                      </div>
                    </div>
                  </div>