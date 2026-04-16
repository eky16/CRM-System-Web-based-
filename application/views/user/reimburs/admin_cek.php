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
                    <div class="card-header"><strong><?= $tittle ?></strong></div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                    <th width="1px">No</th>
                                    <th >Tanggal</th> 
                                    <th class="col-sm-1">Kode</th>
                                    <th class="col-sm-2">Karyawan</th>
                                    <th class="col-sm-2"> Project</th>
                                    
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
                                        <td><?php echo $izin->user_reimbus ?></td>
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

                                        echo '<span class="badge badge-success"> Success </span>';
                                       
                                    }
                                    elseif ($izin->status_reimbus == '4') {

                                        echo '<span class="badge badge-success"> Success </span>';
                                       
                                    }
                                     elseif ($izin->status_reimbus == '5') {

                                       echo '<span class="badge badge-dange"> Fail </span>';
                                       
                                    }
                                    ?>  
                                        </td>
                      
                                     
                                      
                                    <th scope="row" align="center">

            <div class="toolbox" align="center">
<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">&nbsp;&nbsp;
   Aksi
  </button>
  <div class="dropdown-menu">&nbsp;&nbsp;&nbsp;
                                        <?php if($izin->status_reimbus == '1'): ?>
                                            <a href="<?= base_url('user/reimburs/detail_proses/' . $izin->kode_reimbus) ?>" class="btn btn-primary btn-sm">Lihat & Proses</a>
                                
                            
                                    <?php else: ?>
                                            <a href="<?= base_url('user/reimburs/detailss/' . $izin->kode_reimbus) ?>" class="btn btn-primary btn-sm">Lihat</a><?php endif; ?>

                                         <?php if ($izin->status_reimbus == 1 OR $izin->status_reimbus == 2) : ?>
                                                    <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('user/reimburs/hapus/' . $izin->kode_reimbus) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                           <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $izin->kode_reimbus; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;+ List Pay</a>
                                                     <?php endif; ?>
                </div>
            </div>
        </th>

                          
        
                                    </td>                                       
                                    </tr>
<!-- modal update -->
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $izin->kode_reimbus; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Payment <?php echo $izin->kode_reimbus; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/payment/update_payment2') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Creat at <?php echo $pay->createdTime_payment; ?> - <?php
                                            if ($pay->status_approval == 1) {
                                              echo '<span class="badge badge-secondary">Waiting</span>';
                                            }
                                             if ($pay->status_approval == 2) {
                                              echo '<span class="badge badge-warning">Pending</span>';
                                            }if ($pay->status_approval == 3) {
                                              echo '<span class="badge badge-success">Success</span>';
                                            }
                                              ?></h6>
                                </div>
                                <div class="card-body">
                    
          <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="id_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $pay->id_payment; ?>"  class="form-control" hidden>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">ID </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kod_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $izin->kode_reimbus; ?>"  class="form-control">
                                </div>
                                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Metode Pembayaran </label>
                   <select name="header_payment" class="form-control" required>
                            <option value="">PILIH ...</option>

                            <option value="CAHAYA SELARAS AGUNG,PT" <?php
                            if (!empty($pay->header_payment)) {
                                echo $pay->header_payment == 'CAHAYA SELARAS AGUNG,PT' ? 'selected' : '';
                            }
                            ?>>CAHAYA SELARAS AGUNG,PT</option>
                            <option value="VIA BCA 1988" <?php
                            if (!empty($pay->header_payment)) {
                                echo $pay->header_payment == 'VIA BCA 1988' ? 'selected' : '';
                            }
                            ?>>VIA BCA 1988</option>

                            <option value="VIA BCA 3701" <?php
                            if (!empty($pay->header_payment)) {
                                echo $pay->header_payment == 'VIA BCA 3701' ? 'selected' : '';
                            }
                            ?>>VIA BCA 3701</option>
                            </select>
                                </div>  
                             <div class="form-group col-md-12">
                                            <label for="nama_barang">No Spk </label>
                                             <input  type="text"   name="no_spk" placeholder="Masukkan No SPK" autocomplete="off" value=""  class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Pembayaran</label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="tgl_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Proyek </strong></label>
                            <select id="select-state" placeholder="" name="project_payment" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($proyek as $prk) : ?>
                                <option value="<?php echo $prk->id_lsp ?>"
                                <?php
                                if (!empty($izin->name_project)) {
                                    echo $prk->nama_project == $izin->name_project ? 'selected' : '';
                                }
                                ?>><?php echo $prk->nama_project ?></option>
                                    <?php endforeach; ?>

                        </select>
                                </div>
                            <div class="form-group col-md-12">
                            <label for="nama_barang"><strong>Vendor & No Rek </strong></label>
                            <select id="select-state" placeholder="" name="vendor" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($vendor as $vn) : ?>
                                <option value="<?php echo $vn->id_ven ?>"
                                <?php
                                if (!empty($pay->vendor)) {
                                    echo $vn->id_ven == $pay->vendor ? 'selected' : '';
                                }
                                ?>><?php echo $vn->nama_vendor .' ('. $vn->nama_bank_vendor .')'.  $vn->norek_vendor ?></option>
                                    <?php endforeach; ?>

                        </select>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Almount </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="almount" placeholder="Masukkan Jumlah" autocomplete="off" value="<?= $izin->total_reimburs ?>"  class="form-control" required>
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Potongan Pajak </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="total_pajak" placeholder="" autocomplete="off" value=""  class="form-control" >
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Total Dibayarkan </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="total_payment" placeholder="" autocomplete="off" value="<?= $izin->total_reimburs ?>"  class="form-control" required>
                                </div>
                                        <div class="form-group col-12">
                                            <label>Keterangan</label>
                                            <textarea  name="note_payment" class="form-control " ></textarea>
                                    </div>
                               <input type="text" name="ket" placeholder="Tambah Laporan Proyek" autocomplete="off"  class="form-control" required value="Tambah Laporan Proyek" hidden>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>
<?php if($pay->status_approval == 3): ?>
                                    <div class="form-group col-12">
                                        <button type="submit" disabled class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Selesai</button>
                                    </div><?php else:?>
       <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                    </div><?php endif;?>
                                </div>
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                             <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

                        </div>
        </div></form>
  

    </div>
  </div>
</div>
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
        <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>