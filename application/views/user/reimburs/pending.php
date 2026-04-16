<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('user/partials/head.php') ?>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">


    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('user/partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('asst') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('user/partials/topbar.php') ?>

                <div class="container-fluid">
                <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="float-right"> 
                     <a href="<?= base_url('user/reimburs/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
                    
                    </div>
                </div>
                <hr>
                <?php if ($this->session->flashdata('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php elseif($this->session->flashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif ?>
                <div class="card shadow">
                    <div class="card-header"><strong>LIST REIMBURSEMENT </strong></div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                    <th class="col-sm-1">No</th>
                                    <th >Tanggal</th> 
                                    <th class="col-sm-1">Kode</th>
                                    <th class="col-sm-2">Nama Project</th>
                                    <th >Total Reimburs</th> 
                                    <th >Status</th> 

                        
                                    <th class="col-sm-2" align="center">Aksi</th>     
                                </tr>
                            </thead>
                                  <tbody>                                                        
                                <?php foreach ($all_dept_info as $key => $izin) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $izin->tanggal_reimbus ?></td>
                                        <td><?php echo $izin->kode_reimbus ?></td>
                                        <td><?php echo $izin->name_project ?></td>
                                        <td><?php
                                             $hasil_rupiah = "Rp " . number_format($izin->total_reimburs,2,',','.');
                                              echo $hasil_rupiah; ?></td>
                                        <td>
                                            <?php 
                                $attr = array(
                                'target'=>'_blank' 
                                ); ?><?php
                               
                                    if ($izin->status_reimbus == '1') {
                                        echo '<span class="badge badge-warning"> Pending </span>';
                                    } elseif ($izin->status_reimbus == '2') {

                                         echo '<span class="badge badge-primary"> Process </span>';
                                       
                                    }
                                   elseif ($izin->status_reimbus == '3') {

                                        echo '<span class="badge badge-success"> Paid </span>';
                                       
                                    }
                                      elseif ($izin->status_reimbus == '4') {

                                        echo '<span class="badge badge-success"> Paid </span>';
                                       
                                    }
                                     elseif ($izin->status_reimbus == '5') {

                                       echo '<span class="badge badge-dange"> Fail </span>';
                                       
                                    }
                                    ?>  
                                        </td>
                      
                                     
                                        <td align="center"><a href="<?= base_url('user/reimburs/detail/' . $izin->kode_reimbus) ?>" class="btn btn-primary btn-sm">Lihat</a>
                                          <?php if ($izin->status_reimbus == 1 ) : ?>
                                                    <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('user/reimburs/hapus/' . $izin->kode_reimbus) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> <?php endif; ?></td>
        
                                    </td>                                       
                                    </tr>
<!-- modal update -->
                                    <?php  endforeach; ?>
                                                           
                        </tbody>
                            </table>
                        </div> </div>      

     
                            
                </div>
                </div>
            </div>

            <!-- load footer -->
            <?php $this->load->view('user/partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('user/partials/js.php') ?>
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>