<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('user/partials/head.php') ?>
      <style>
        .removeRow
{
 background-color: #D1D1D1;
    color:#FFFFFF;
}
    /* The container */
    .container12 {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 6px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container12 input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 15px;
      width: 15px;
      background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container12:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container12 input:checked ~ .checkmark {
      background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the checkmark when checked */
    .container12 input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the checkmark/indicator */
    .container12 .checkmark:after {
      left: 3px;
      top: 1px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(25deg);
      -ms-transform: rotate(25deg);
      transform: rotate(25deg);
    }

    </style>

  
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- load sidebar -->
    

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content" data-url="<?= base_url('pengeluaran') ?>">
        <!-- load Topbar -->
        <?php $this->load->view('user/partials/topbar.php') ?>

        <div class="container-fluid">
        <div class="clearfix">
          <div class="float-left">
            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
          </div>
          <div class="float-right">
          
             <button  class="btn btn-secondary btn-sm" onclick="window.close()"><i class="fa fa-times"></i> &nbsp;&nbsp;Tutup</button> 
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


          <div class="card-header"><strong><?= $title ?> - <?= $hd_quo->created_quo ?>, <?= $hd_quo->createdtime_quo ?></strong>


                <div class="float-right">
          <!-- Tombol UPDATE -->
                          <?php if ($this->session->login['department'] == 'Marketing' OR $this->session->login['department'] == 'IT') : ?>

      <!--    <a data-toggle="modal" data-target="#right_modalupdateProgress<?= $hd_quo->id; ?>" class="btn btn-warning btn-sm" style="color:white"> <i class="fa fa-edit"></i>&nbsp;&nbsp;Update </a> -->
                          <?php endif; ?>

           <!-- Tombol UPDATE -->
                          <?php if ($this->session->login['department'] == 'Marketing' OR $this->session->login['department'] == 'IT') : ?>


      <!--   <a href="<?= base_url('user/quotation/penawaran/'. $hd_quo->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Penawaran </a>-->
                                   <?php endif; ?>
        
          <a href="<?= base_url('user/quotation/list_quo_order') ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;&nbsp;List Quotation </a>

          <?php if ($this->session->login['department'] == 'Engineering' OR $this->session->login['department'] == 'IT' OR $this->session->login['department'] == 'Estimator'):?>

      <!--    <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate1<?php echo $hd_quo->id ; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ganti Customer</a> -->
          <?php endif;?>
          
        </div></div>
<!-- modal update System -->

          <div class="card-body">
            <div class="row">
              <div class="col-md-5">
                  <div class="table-responsive">
                <table class="table table-borderless">
                  <tr>
                    <td><strong>ID </strong></td>
                    <td width="5">:</td>
                    <td><?= $hd_quo->number_quo ?></td>
                  </tr>
                  
                  <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>:</td>
                    <td><?= $hd_quo->trans_Date ?></td>
                  </tr>
                  <tr>
                    <td><strong>Customer</strong></td>
                    <td>:</td>
                    <td><?= $hd_quo->customer ?></td>
                  </tr>
                  <tr>
                    <td><strong>Sales</strong></td>
                    <td>:</td>
                    <td><?= $hd_quo->sales ?></td>
                  </tr>
                  <tr>
                    <td><strong>Status</strong></td>
                    <td>:</td>
                    <td>     <?php $status_quo = $hd_quo->status_quo  ?>
                                            <?php if ($status_quo == 1):?>
                                              <span class="badge badge-warning">Menunggu Proses Estimator</span>
                                            <?php endif;?>
                                            <?php if ($status_quo == 2):?>
                                            <span class="badge badge-info">PROSES </span>
                                            <?php endif;?>
                                          
                                            <?php if ($status_quo == "Selesai"):?>
                                              <span  class="badge badge-success">Quotation Selesai Diproses </span>
                                            <?php endif;?></td>

                  </tr>

              <!--    <tr>
                    <td><strong>Status Progress</strong></td>
                    <td>:</td>
                    <td><?= $hd_quo->statusProgress ?></td>
                  </tr> -->
                  
                </table></div>
              </div>
              
            <!--  <div class="col-md-7">
                <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td width="155" colspan="3" align="center"><font size="2"><b>STATUS</b></font></td>
                      
                    </tr>
                    <tr>
                      <td width="155" ><font size="2">Waktu</font></td>
                      <td width="250"><font size="2">Keterangan</font></td>
                      <td width="200"><font size="2">Nama</font></td>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($his_quo as $row): ?>
                      <tr>
                        <td><font size="2"><?= $row->actiontime_qt ?></font></td>
                        <td><font size="2"><?= $row->status ?></font> </td>
                        <td><font size="2"><?= $row->action_qt_by ?></font> </td>
                      </tr>
                  <?php endforeach ?>
                  </tbody>
                </table></div>
              </div>-->
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td width="10"><strong>Id</strong></td>
                      <td width="350"><strong>Nama Barang</strong></td>
                      <td width="10"><strong>Jumlah</strong></td>
                      <td width="10"><strong>Harga</strong></td>
                      <td width="10"><strong>Total</strong></td>

                      <td width="150"><strong>Status Quotation Sales</strong></td>

                      <td width="150"><strong>Status</strong></td>
                      <td width="150"><strong>Estimasi Harga</strong></td>
                      <td width="150"><strong>File</strong></td>
                      <td width="150"><strong>Gambar Penawaran</strong></td>
                      <td width="200"><strong>Keterangan</strong></td>
                      <td width="100"><strong>Aksi</strong></td>
                      </td>
                    </tr>
                  </thead>

                  <tbody>


                    <?php foreach ($dt_quo as $row): ?>
                      <tr>
                        <td><?= $row->id_quo_dt ?></td>
                        <td><?= $row->detailName_quo ?></td>
                        <td><?= $row->quantity ?></td>
                        <td><?= $row->harga ?></td>
                        <td><?= number_format($row->quantity * $row->harga, 0, ',', '.') ?></td>

                        <td><?= $row->status ?></td>


                        <td align="center">
  <?php $status_quo = $row->status_qr_quo; ?>
  <?php if ($status_quo == "Tidak Bisa Estimasi"): ?>
    <a href="#" data-toggle="modal" data-target="#modalStatus<?php echo $row->id_quo_dt; ?>">
      <span class="badge badge-danger">Tidak Bisa Estimasi</span>
    </a>
  <?php elseif ($status_quo == "Bisa Estimasi"): ?>
    <a href="#" data-toggle="modal" data-target="#modalStatus<?php echo $row->id_quo_dt; ?>">
      <span class="badge badge-info">Bisa Estimasi</span>
    </a> 
  <?php endif; ?>
</td>


<td align="<?= $can_see_estimasi ? 'right' : 'center' ?>">
    <span style="font-size:12px;">

    <?php if ($can_see_estimasi): ?>
        <?php if (!empty($grouped_history[$row->id_quo_dt])): ?>
            <?php foreach ($grouped_history[$row->id_quo_dt] as $his): ?>
                <div id="estimasi-<?= $his->id ?>"
                     style="border-bottom:1px solid #eee; padding:3px; display:flex; justify-content:space-between; align-items:center;">

                    <div style="text-align:right;">
                        <strong><?= number_format($his->estimasi_harga) ?></strong><br>
                        <small style="color:#888;">
                            <?= date('d-m-Y H:i', strtotime($his->created_at)) ?>
                        </small>
                    </div>

                    <?php 
                    // Tombol hapus hanya untuk department tertentu
                    if (in_array($user_dept, $allowed_dept_hapus)): ?>
                        <a href="javascript:void(0);"
                           class="btn-hapus-estimasi"
                           data-id="<?= $his->id ?>"
                           style="color:red; text-decoration:none; font-weight:bold; margin-left:6px;">
                            ✖
                        </a>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            -
        <?php endif; ?>
    <?php else: ?>
        -
    <?php endif; ?>

    </span>
</td>


                        <td><font size="2px"> <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                    <?php endif ;?></font>
                        </td>

                        <td width="150">
                            <?php if (!empty($row->files)): ?>
                              <?php foreach ($row->files as $file): ?>
                          <div class="d-flex justify-content-between align-items-center mb-1 p-1 border rounded">
        
                          <div style="font-size:13px; word-break: break-all;"> 📄 <?= !empty($file->nama_asli) ? $file->nama_asli : $file->gambar_penawaran ?>
                          </div>

                          <a target="_blank" href="<?= base_url('img/uploads/gambar_penawaran/'.$file->gambar_penawaran) ?>" style="color:#007bff; font-size:12px; text-decoration:none;"> Lihat </a>
                          </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                              <span class="text-muted">Belum ada</span>
                             <?php endif; ?>
                        </td>
                        
                        <td><?= $row->detailNotes_quo ?></td>
                                        
                       <td>
                           <?php if ($this->session->login['department'] == 'Estimator'OR $this->session->login['department'] == 'IT') : ?>
                            <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $row->id_quo_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat</a> 
                            <?php endif; ?>

                            <?php if ($this->session->login['department'] == 'Engineering' OR $this->session->login['department'] == 'IT') : ?>
                            <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate1<?php echo $row->id_quo_dt ; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update</a> 
                          <?php endif; ?>

                          <?php if ($this->session->login['department'] == 'Marketing' OR $this->session->login['department'] == 'IT') : ?>

                            <a  data-toggle="modal" style="color:white" data-target="#right_modalupdateSales<?php echo $row->id_quo_dt ; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update</a> 
                          <?php endif; ?>
                        </td>

                      </tr>







 <!-- Modal Update Status Sales -->
<div  class="modal modal-right fade" id="right_modalupdateSales<?php echo $row->id_quo_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Status & Harga  <?php echo $row->id_quo_dt; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/quotation/update_status_quo_sales') ?>" enctype="multipart/form-data" id="form_update<?= $row->id_quo_dt ?>" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  
                                </div>
                                <div class="card-body">
                    
                            <div class="form-group col-md-12">
                                <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                                             <input  type="text" maxlength="50"  name="detailName_quo" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName_quo; ?>" readonly class="form-control">
                                </div>  

                            <div class="form-group col-6">
                                <label for="project">Status</label>
                                <select name="status_quo_sales" id="statusQuo" class="form-control" required>
                                <option value="" >PILIH .....</option>
                                <?php foreach ($statusQuo as $sq) : ?>
                                        <option value="<?= $sq->kd_status ?>"
                                        <?= ($row->status_quo_sales == $sq->kd_status) ? 'selected' : '' ?>> <?= $sq->status ?></option>
                                <?php endforeach; ?> </select>
                                </div>         
                               
                            <div class="form-group col-6">
                                <label>Harga Pricelist (Rp)</label>
                                <input type="text" class="form-control harga-mask" placeholder="Masukkan harga" 
                                       value="<?= isset($harga) ? number_format($harga, 0, ',', '.') : '' ?>">
        
                                <input type="hidden" name="harga" class="harga-raw" value="<?= $harga ?? '' ?>">
                            </div>



                               <input type="hidden" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>">
                               <input type="hidden" name="id_quo_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_quo_dt; ?>">                                
                               <input type="hidden" name="no_qt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request_quo; ?>">

                                        <hr>

                         <div class="form-group col-12">
                         <?php if ($this->session->login['department'] == 'Engineering' OR $this->session->login['department'] == 'IT' OR $this->session->login['department'] == 'Marketing'):?>
                                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button> 
                                    <?php endif; ?>
       
                                    </div>
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
</div>
</div>



                    <!-- Modal Ubah Status -->
<div class="modal fade" id="modalStatus<?php echo $row->id_quo_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel<?php echo $row->id_quo_dt; ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?= base_url('user/quotation/update_status') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalLabel<?php echo $row->id_quo_dt; ?>">Ubah Status - ID <?php echo $row->id_quo_dt; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="status_qr_quo">Status Saat Ini:</label>
            <select name="status_qr_quo" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="Bisa Estimasi" <?= $row->status_qr_quo == 'Bisa_Estimasi' ? 'selected' : '' ?>>Bisa Estimasi</option>

            </select>
          </div>

          <!-- Input Tersembunyi -->
          <input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
                               <input type="text" name="id_quo_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_quo_dt; ?>" hidden>
                               <input type="text" name="no_qt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request_quo; ?>" hidden>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $row->id_quo_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Barang <?php echo $row->id_quo_dt; ?></h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/quotation/update_estimasiHarga') ?>" enctype="multipart/form-data" id="from2" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  
                                </div>
                                <div class="card-body">
                    
                            <div class="form-group col-md-12">
                                <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                                             <input  type="text" maxlength="50"  name="detailName_quo" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName_quo; ?>" readonly class="form-control">
                                </div>           

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Keterangan</span></label>
                                            <textarea class="form-control" name="detailNotes_quo"><?php echo $row->detailNotes_quo; ?></textarea>
                                  
                                </div> 

                           <?php if ($can_see_estimasi): ?>
                                <div class="form-group col-md-12">
                                        <label> <span class="badge badge-success">Estimasi Harga</span> </label>
                                         <input type="text" class="form-control format-rupiah" data-target="estimasi_harga_<?= $row->id_quo_dt ?>" 
                                         placeholder="Masukkan estimasi harga">

                                         <input type="hidden" name="estimasi_harga" id="estimasi_harga_<?= $row->id_quo_dt ?>"> </div>
                                <?php endif; ?>
           

                               <input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
                               <input type="text" name="id_quo_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_quo_dt; ?>" hidden>
                               <input type="text" name="no_qt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request_quo; ?>" hidden>

                                        <hr>

                         <div class="form-group col-12">
                         <?php if ($this->session->login['department'] == 'Estimator' OR $this->session->login['department'] == 'IT' OR $this->session->login['department'] == 'Marketing'):?>
                                      <button type="submit" onclick="this.disabled=true; this.form.submit();"class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button> 
                                    <?php endif; ?>
       
                                    </div>
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
                     </div>

              </div>

  
  <!-- Modal Update Gambar Penawaran -->
<div  class="modal modal-right fade" id="right_modalupdate1<?php echo $row->id_quo_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Gambar Penawaran <?php echo $row->id_quo_dt; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/quotation/update_quo_pl') ?>" enctype="multipart/form-data" id="form_update<?= $row->id_quo_dt ?>" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  
                                </div>
                                <div class="card-body">
                    
                            <div class="form-group col-md-12">
                                <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                                             <input  type="text" maxlength="50"  name="detailName_quo" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName_quo; ?>" readonly class="form-control">
                                </div>           

                           
                            <div class="form-group col-md-12">

    <label>
        <span class="badge badge-success">Gambar Penawaran</span>
    </label>

    <!-- Tampilkan semua file yang sudah diupload -->
    <?php if (!empty($row->files)): ?>
        <div class="mb-2">
            <?php foreach ($row->files as $file): ?>
    <div class="d-flex justify-content-between align-items-center mb-1 p-1 border rounded">
        
        <div style="font-size:13px; word-break: break-all;">
            📄 <?= !empty($file->nama_asli) ? $file->nama_asli : $file->gambar_penawaran ?>
        </div>

        <a target="_blank"
           href="<?= base_url('img/uploads/gambar_penawaran/'.$file->gambar_penawaran) ?>"
           class="btn btn-sm btn-primary">
           Lihat
        </a>

<button type="button"
        class="btn btn-sm btn-danger"
        onclick="hapusFile(
            <?= $file->id ?>,
            <?= $hd_quo->id ?>,
            <?= $row->id_quo_dt ?>        )">
    Hapus
</button>


    </div>
<?php endforeach; ?>

        </div>
    <?php endif; ?>

    <!-- Hidden ID supaya relasi nyambung -->
    <input type="hidden" name="id_quo_dt" value="<?= $row->id_quo_dt ?>">

    <!-- Upload file baru -->
    <input type="file"
           name="gambar_penawaran"
           class="form-control">

</div>


                               <input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
                            <!--   <input type="text" name="id_quo_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_quo_dt; ?>" hidden>-->
                               <input type="text" name="no_qt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request_quo; ?>" hidden>

                                        <hr>

                         <div class="form-group col-12">
                         <?php if ($this->session->login['department'] == 'Engineering' OR $this->session->login['department'] == 'IT' OR $this->session->login['department'] == 'Marketing'):?>
                                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button> 
                                    <?php endif; ?>
       
                                    </div>
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
<?php endforeach ?>
                  </tbody>
                </table>


</div>
</div>


<hr>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">

            <!-- HEADER -->
            <tr>
                <td class="text-center bg-light"><strong>JASA</strong></td>
                <td class="text-center bg-light"><strong>HARGA</strong></td>
            </tr>

            <tr>
                <!-- 🔥 KOLOM JASA -->
                <td style="width:50%; vertical-align:top;">

                    <div class="form-group">
                        <label>Biaya Pengiriman</label>
                        <input type="text" id="biaya_kirim" class="form-control format-rupiah" placeholder="0">
                        <input type="hidden" id="biaya_kirim_real">
                    </div>

                    <div class="form-group">
                        <label>Biaya Penanganan</label>
                        <input type="text" id="biaya_penanganan" class="form-control format-rupiah" placeholder="0">
                        <input type="hidden" id="biaya_penanganan_real">
                    </div>

                </td>

                <!-- 🔥 KOLOM HARGA -->
                <td style="width:50%; vertical-align:top;">

                    <table class="table table-sm table-borderless">
                              <?php $subtotal = 0;
                      foreach ($dt_quo as $row) {
                          $subtotal += ($row->quantity * $row->harga);}?>

                        <tr>
                            <td>Subtotal Barang</td>
                            <td class="text-right">
                                Rp <?= number_format($subtotal, 0, ',', '.') ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Diskon</td>
                            <td> <div style="display:flex; gap:8px; align-items:center;">            
                              <!-- Input persen -->
                              <input type="number" id="diskon" class="form-control form-control-sm" 
                                     placeholder="%" style="width:50px;"> <span>%</span>

                              <!-- Nilai rupiah -->
                              <span>Rp</span>
                              <strong id="diskon_rp_text">0</strong>

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Total Netto</td>
                            <td class="text-right">
                                Rp <span id="neto_text">0</span>
                            </td>
                        </tr>

                       
                        <tr>
                            <td>PPN</td>
                            <td> <div style="display:flex; gap:8px; align-items:center;">            
                              <!-- Input persen -->
                              <input type="number" id="ppn" class="form-control form-control-sm" 
                                     placeholder="%" style="width:50px;"> <span>%</span>

                              <!-- Nilai rupiah -->
                              <span>Rp</span>
                              <strong id="ppn_rp_text">0</strong>

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>JASA</td>
                            <td class="text-right"> Rp <span id="jasa_text">0</span>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>GRAND TOTAL</strong></td>
                            <td class="text-right">
                            <strong>Rp <span id="grand_total_text">0</span></strong>
                            </td>
                        </tr>

                    </table>

                </td>
            </tr>

        </table>
    </div>
</div>
<form action="<?= base_url('user/quotation/cetak_pdf') ?>" method="POST" target="_blank">
    
    <input type="hidden" name="id_quo" value="<?= $hd_quo->id ?>">
    <input type="hidden" name="biaya_kirim_pdf" id="biaya_kirim_pdf">
    <input type="hidden" name="biaya_penanganan_pdf" id="biaya_penanganan_pdf">

    <input type="hidden" name="subtotal" id="subtotal_input">
    <input type="hidden" name="diskon_rp" id="diskon_rp_text">
    <input type="hidden" name="ppn" id="ppn_rp_text">
    <input type="hidden" name="jasa" id="jasa_text">
    <input type="hidden" name="grand_total" id="grand_total_text">

    <button type="submit" class="btn btn-danger">
        <i class="fa fa-file-pdf"></i> Cetak PDF
    </button>
</form>

<div class="form-group col-12">
   <div class="bg-light text-right"> 
<form action="<?= base_url('user/quotation/proses_approve_quo') ?>" enctype="multipart/form-data" id="from1" method="POST">

  <input type="text" name="id" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_quo->id; ?>" hidden>
  <input type="text" name="number_1" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_quo->number_1; ?>" hidden>
  <input type="text" name="number_quo" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_quo->number_quo; ?>" hidden>


  <?php   $cek_jabatan  = $emp->divisi.' '.$emp->department;
      $cek_status_pr  = $hd_quo->status_quo; ?>

  <?php if ($cek_jabatan == 'Staff Estimator' || $cek_jabatan == 'Staff IT'): ?>
  <?php if ($cek_status_pr == 1): ?>
    <input type="text" name="status_quo" placeholder="" autocomplete="off" class="form-control" value="2" hidden>
    <input type="text" name="status" placeholder="" autocomplete="off" class="form-control" value="Menyetujui Quotation" hidden>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Setujui</button>
  <?php elseif ($cek_status_pr == 2): ?>
 
 <!--   <a onclick="return confirm('Lanjut ?')" href="<?= base_url('user/quotation/kelengkapan_quo/' . $hd_quo->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Lengkapi Data</a>-->
  <?php endif; ?>
<?php endif; ?>   
 </form>
</div>
 </div>
            </div>
          </div>
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


    <script>
$(document).ready(function(){
 
 $('.delete_checkbox_daily').click(function(){
  if($(this).is(':checked'))
  {
   $(this).closest('tr').addClass('removeRow');
  }
  else
  {
   $(this).closest('tr').removeClass('removeRow');
  }
 });

 $('#delete_all').click(function(){
  var checkbox = $('.delete_checkbox_daily:checked');
  if(checkbox.length > 0)
  {
   var checkbox_value = [];
   $(checkbox).each(function(){
    checkbox_value.push($(this).val());
   });
   $.ajax({
    url:"<?php echo base_url(); ?>user/quotation/delete_detail_quo",
    method:"POST",
    data:{checkbox_value:checkbox_value},
    success:function()
    {
     $('.removeRow').fadeOut(1500);
    }
   })
  }
  else
  {
   alert('Select atleast one records');
  }
 });

});
</script>
 <script>
    document.querySelector('#from1').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Quotation akan dilanjutkan, Setujui!",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            swal({
              title: 'Success!',
              text: 'Quotation Disetujui!',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", "Quotation tidak ada perubahan :)", "error");
          }
        });
    });
  </script>
   <script>
    document.querySelector('#from2').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Data Quotation akan diubah!",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            swal({
              title: 'Success!',
              text: 'Quotation Detail Berhasil diubah!',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", "Data tidak diupdate :)", "error");
          }
        });
    });
  </script>

  

  <script>
function hapusFile(idFile, idHd, idQuoDt, noQt) {

    if(confirm('Yakin hapus file ini?')) {

        fetch("<?= site_url('user/quotation/hapus_file') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "id=" + idFile +
                  "&id_header=" + idHd +
                  "&id_quo_dt=" + idQuoDt 
        })
        .then(() => {
            window.location.href = "<?= site_url('user/quotation/detail_quo/') ?>" + idHd;
        });

    }
}
</script>

<script>
$(document).on('click', '.btn-hapus-estimasi', function() {
    var id = $(this).data('id');

    if (confirm('Yakin ingin menghapus estimasi ini?')) {
        $.ajax({
            url: "<?= base_url('user/quotation/hapus_estimasi') ?>",
            type: "POST",
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#estimasi-' + id).fadeOut(300, function(){ $(this).remove(); });
                } else {
                    alert(response.message || 'Gagal menghapus estimasi.');
                }
            },
            error: function(xhr) {
                alert('AJAX Error');
                console.log(xhr.responseText);
            }
        });
    }
});
</script>
<script>

function formatRupiah(angka){
    return angka.replace(/\D/g,'')
                .replace(/\B(?=(\d{3})+(?!\d))/g,'.');
}

$(document).on("keyup", ".format-rupiah", function(){

    let angka = $(this).val().replace(/\D/g,'');

    $(this).val(formatRupiah(angka));

    let target = $(this).data("target");

    $("#" + target).val(angka);

});

</script>
<script >
  function formatRupiah(angka){
    return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function hitungTotal(){



    let subtotal = <?= $subtotal ?>;

    let diskon = parseFloat($("#diskon").val()) || 0;
    let ppn = parseFloat($("#ppn").val()) || 0;

    let biayaKirim = parseInt($("#biaya_kirim_real").val()) || 0;
    let biayaHandling = parseInt($("#biaya_penanganan_real").val()) || 0;

    //  HITUNG NETO
    let potongan = subtotal * (diskon / 100);
    let neto = subtotal - potongan;
    let nilaiDiskon = subtotal * (diskon / 100);
    $("#diskon_rp_text").text(formatRupiah(Math.round(nilaiDiskon)));

    //  HITUNG PPN
    let nilaiPPN = neto * (ppn / 100);
        $("#ppn_rp_text").text(formatRupiah(Math.round(nilaiPPN)));

    //  HITUNG JASA
    let jasa = biayaKirim + biayaHandling;

    //  GRAND TOTAL
    let grandTotal = neto + nilaiPPN + jasa;

    // ======================
    // TAMPILKAN KE VIEW
    // ======================
    $("#neto_text").text(formatRupiah(Math.round(neto)));
    $("#jasa_text").text(formatRupiah(jasa));
    $("#grand_total_text").text(formatRupiah(Math.round(grandTotal)));
}

//   AUTO HITUNG
$(document).on("keyup change input", "#diskon, #ppn, #biaya_kirim, #biaya_penanganan", function(){
    hitungTotal();
});   

$(document).on("keyup", ".format-rupiah", function(){

    let angka = $(this).val().replace(/\D/g,'');

    $(this).val(angka.replace(/\B(?=(\d{3})+(?!\d))/g,'.'));

    let id = $(this).attr("id") + "_real";

    $("#" + id).val(angka);

    hitungTotal();
});
 // kirim ke input hidden
$("#subtotal_input").val(subtotal);
$("#diskon_input").val(diskon);
$("#diskon_rp_input").val(Math.round(nilaiDiskon));
$("#ppn_input").val(ppn);
$("#jasa_input").val(jasa);
$("#grand_total_input").val(Math.round(grandTotal));
//  JALANKAN AWAL
hitungTotal();
</script>

<script>
$(document).ready(function() {
    // Fungsi untuk sinkronisasi biaya kirim
    $('#biaya_kirim').on('keyup change', function() {
        // Ambil nilai dari input REAL (angka murni)
        var valReal = $('#biaya_kirim_real').val();
        // Set ke hidden input form PDF
        $('#biaya_kirim_pdf').val(valReal);
    });

    // Fungsi untuk sinkronisasi biaya penanganan
    $('#biaya_penanganan').on('keyup change', function() {
        // Ambil nilai dari input REAL (angka murni)
        var valReal = $('#biaya_penanganan_real').val();
        // Set ke hidden input form PDF
        $('#biaya_penanganan_pdf').val(valReal);
    });
});
</script>

<script>
$(document).ready(function() {
    // 1. Fungsi Format Angka
    function formatRupiah(angka) {
        if (!angka) return '';
        let val = angka.toString().replace(/[^0-9]/g, '');
        return val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // 2. Saat Modal Terbuka: Pastikan input yang sudah ada ID-nya langsung terformat
    // 'show.bs.modal' adalah event bawaan Bootstrap saat modal mulai tampil
    $(document).on('shown.bs.modal', '.modal', function () {
        $(this).find('.harga-mask').each(function() {
            let currentVal = $(this).next('.harga-raw').val();
            if (currentVal) {
                $(this).val(formatRupiah(currentVal));
            }
        });
    });

    // 3. Saat User Mengetik di dalam Modal
    $(document).on('input', '.harga-mask', function() {
        let rawValue = $(this).val().replace(/[^0-9]/g, '');
        
        // Masukkan angka bersih ke input hidden (tetangga input ini)
        $(this).siblings('.harga-raw').val(rawValue);

        // Format tampilan dengan titik
        $(this).val(formatRupiah(rawValue));
    });
});
</script>

</body>
</html>