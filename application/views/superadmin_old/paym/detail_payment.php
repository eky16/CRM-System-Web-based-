<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('user/partials/head.php') ?>
       <style type="text/css">
body {
  font-family: sans-serif;

}

.file-upload {
  background-color: #A9A9A9;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #A9A9A9;
  border: none;
  padding: 7px;
  border-radius: 4px;
  border-bottom: 4px solid #A9A9A9;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #adade2;
  color: #636367;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #636367;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #eff0f5;
  border: 4px dashed #3336ff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #aaabc2;
  padding: 10px 0;
}

.file-upload-image {
 width: 70%;
  height: auto;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 50%;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 200;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}
#hidden_tgl {
    display: none;
}
    </style>
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
     
                   <button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button> 
                    
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
                    <div class="card-header"><strong>Detail Pembayaran  </strong></div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered"  width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                    <th class="col-sm-1">No</th>
                                    <th class="col-sm-2">Kode</th>
                                    <th class="col-sm-2">Karyawan</th>
                                    <th class="col-sm-2">Jenis</th>
                                    <th >Rincian</th> 
                                    <th >Status</th> 
                                    <th class="col-sm-2" align="center">Aksi</th>     
                                </tr>
                            </thead>
                                  <tbody>                                                        
                                                                                    
                         <?php foreach ($all_paym as $pay): ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $pay->no_spk ?></td>
                                        <td><?php echo $pay->tgl_payment ?></td>
                                        <td><?php echo $pay->nama_project ?></td>
                                        <td><?php
                                             $hasil_rupiah = "Rp " . number_format($pay->nominal,2,',','.');
                                              echo $hasil_rupiah; ?></td>
                                        <td><?php echo $pay->status_cek ?></td>
                      
                                        <td align="center">

                                        <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $pay->id_sub; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detail</a>
                                    </td>                                       
                                    </tr>
<!-- modal update -->   

                         <?php endforeach; ?>
                                                           
                        </tbody>
                            </table>
                            <table class="table table-bordered"   width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                     <?php foreach ($hitung_reimbus as $key => $total) : ?>
                                    <th class="col-sm-1">Total Yang Harus Transfer  </th>
                                    <th class="col-sm-2"><?php
                                             $hasil_rupiah = "Rp " . number_format($total->total_reimburs,2,',','.');
                                              echo $hasil_rupiah; ?></th>
                                               <th class="col-sm-1" align="center">
         <?php if($total->status_reimbus == 3 OR $total->status_reimbus == 4) : ?>

                <a  data-toggle="modal" style="color:white" data-target="#right_modalcek<?php echo $total->kode_reimbus; ?>" class="btn btn-info btn-sm"><i class="fa fa-check-circle" style="font-size:15px;color:green"></i>&nbsp;<i class="fa fa-credit-card"></i>&nbsp;&nbsp;Telah Di Transfer</a>
        <?php else: ?>                                      
            <a  data-toggle="modal" style="color:white" data-target="#right_modalpay<?php echo $total->kode_reimbus; ?>" class="btn btn-info btn-sm"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Upload Bukti Bayar</a>
               <?php endif; ?>     
         <?php if( $total->status_reimbus == 4) : ?>

                <a  data-toggle="modal" style="color:white" data-target="" class="btn btn-success btn-sm"><i class="fa fa-check-circle" style="font-size:15px;color:green"></i></a>
               <?php endif; ?>     
        </th>

                                    <?php  endforeach; ?>
                                </tr>
                            </thead>
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