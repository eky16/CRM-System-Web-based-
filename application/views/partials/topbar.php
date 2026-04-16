 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                             <!--Start Project   <li class="nav-item dropdown no-arrow mx-1"> 
                            <a class="nav-link dropdown-toggle" href="#" id="dropimg" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-picture-o"></i>
                                
                                <span class="badge badge-danger badge-counter " id="count_img"></span>
                            </a> 
                           
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Daily Report Img
                                </h6>
                                     <a class="dropdown-item d-flex align-items-center" href="">
      
                                    <div class="font-weight-bold show_data_img" >
                                  
                        
                                    </div>
                                </a>

                                <a class="dropdown-item text-center small text-gray-500" href=" ">View Task Process</a>
                            </div>
                        </li> 

                              
                            <!--StartProject    <li class="nav-item dropdown no-arrow mx-1"> 
                            <a class="nav-link dropdown-toggle" href="#" id="droptogg" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                               
                                <span class="badge badge-danger badge-counter " id="count"></span>
                            </a>
                          
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Task Notif
                                </h6>
                                     <a class="dropdown-item d-flex align-items-center" href="">
      
                                    <div class="font-weight-bold show_data" >
                                  
                        
                                    </div>
                                </a>

                                <a class="dropdown-item text-center small text-gray-500" href=" ">View Task Process</a>
                            </div>
                        </li> EndProject-->


                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <!--Startproject   <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                               
                                <span class="badge badge-danger badge-counter"><?= $izin_atasan  ?></span>
                            </a>
                            
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Atasan
                                </h6>
                                
                                <?php foreach ($atasan as $key => $izin) : ?>
                                <a class="dropdown-item d-flex align-items-center" href=" <?php echo base_url(); ?>izin">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate"><?php echo $izin->nama_karyawan ?></div>
                                        <div class="small text-gray-500"><?php echo $izin->jenis ?></div>
                                    </div>
                                </a><?php  endforeach; ?>

                                <a class="dropdown-item text-center small text-gray-500" href=" <?php echo base_url(); ?>izin">Read More Messages</a>
                            </div>
                        </li> EndProject-->
                                                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                     <!--Startproject  <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                               
                                <span class="badge badge-danger badge-counter"><?= $izin_hrd  ?></span>
                            </a>
                            
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    HRD
                                </h6>
                                
                                <?php foreach ($hrd as $key => $izin) : ?>
                                <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url(); ?>izin/hrd">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate"><?php echo $izin->nama_karyawan ?></div>
                                        <div class="small text-gray-500"><?php echo $izin->jenis ?></div>
                                    </div>
                                </a><?php  endforeach; ?>

                                <a class="dropdown-item text-center small text-gray-500" href=" <?php echo base_url(); ?>izin/hrd">Read More Messages</a>
                            </div>
                        </li> endproject-->
                                               <!-- Nav Item - Alerts
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                           
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li> -->



                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                      <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->login['nama'] ?></span>
                             <img class="img-profile rounded-circle"
                                    src="<?php echo base_url(); ?>img/undraw_profile.svg">
                            </a> 
                          
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li> 
                    </ul>
                </nav>