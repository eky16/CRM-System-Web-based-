    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->

                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                              
                            <!--Startproject    <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" id="droptogg" href="#"  
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                
                                <span class="badge badge-danger badge-counter " id="count" ></span>
                            </a>
                           
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in "
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header ">
                                    Task Notif
                                </h6>
                                
                                <a class="dropdown-item d-flex align-items-center" href="">
      
                                    <div class="font-weight-bold show_data" >
                                  
                        
                                    </div>
                                </a>

                                <a class="dropdown-item text-center small text-gray-500" href="">View Task Process</a>
                            </div>
                        </li> endproject-->

 

                        
                     <!--startproject  <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                
                                <span class="badge badge-danger badge-counter"><?= $count_task  ?></span>
                            </a>
                          
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                   MY TASK
                                </h6>
                               
                                <?php foreach ($view_task as $key => $tsk) : ?>
                                <a class="dropdown-item d-flex align-items-center" href=" <?php echo base_url(); ?>user/mod_kerja/lihat_semua">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate"><?php echo $tsk->nama_proyek ?></div>
                                        <div class="small text-gray-500"><?php echo $tsk->kode_modul ?></div>
                                    </div>
                                </a><?php  endforeach; ?>

                                <a class="dropdown-item text-center small text-gray-500" href=" <?php echo base_url(); ?>user/mod_kerja/lihat_semua">Read More Messages</a>
                            </div>
                        </li> endproject-->
               

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow"> 
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->login['nama'] ?></span>
                          <?php if (!empty($emp->foto)): ?>       
                          <img class="img-profile rounded-circle" src="<?php echo base_url(); ?>img/uploads/foto_karyawan/<?= $emp->foto ?>">
                      <?php else: ?>
                             <img class="img-profile rounded-circle"
                                    src="<?php echo base_url(); ?>img/undraw_profile.svg">
                            <?php endif; ?>
                            </a> 
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo base_url(); ?>user/karyawan/detail/<?= $emp->EmployeeID ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                     Profil
                                </a>
                                <a class="dropdown-item" href="<?= base_url('logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

