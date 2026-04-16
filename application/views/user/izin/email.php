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
                       
                        <a  data-toggle="modal" style="color:white" data-target="#izin_tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
                     
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
                    <div class="card-header"><strong>LIST KATEGORI </strong></div>


                    
                        <div class="table-responsive">
                            <table class="table table-bordered"  width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                    <th class="col-sm-1">No</th>
                                    <th >Nama Kategori</th>  
                                    <th class="col-sm-4" align="center">Aksi</th>     
                                </tr>
                            </thead>
                                  <tbody>                                                        
                                <?php foreach ($all_izin_info as $key => $izin) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $izin->jenis  ?></td>
                                        <td align="center">


                            <a  data-toggle="modal" style="color:white" data-target="#person_adm<?php echo $izin->id_izin; ?>" class="btn btn-success btn-sm "><i class="fa fa-edit"></i>&nbsp;&nbsp;Proses</a>
                                        
                                    </td>                                       
                                    </tr>
<!-- modal update -->
    
<div id="person_adm<?php echo $izin->id_izin; ?>" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title"><?php echo $emp->nama_karyawan .' - '.$emp->EmployeeID; ?></h4>
        </div>
<form action="<?= base_url('user/izin/proses_izin') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Form Pengajuan Izin</h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Kode </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kode_izin" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $kode_izin ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Tanggal Pengajuan </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="tgl_pengajuan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label ><strong>Kategori </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" readonly maxlength="50" name="kategori" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $izin->jenis ?>"  class="form-control">
                                </div>
                                <?php if ($izin->id_izin == 8): ?> 
                                <div class="form-group col-md-12">
                                            <label ><strong>Hak Cuti Tahun <?= $emp->tahun ?></strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" readonly maxlength="50" name="kategori" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $emp->jumlah-$emp->cuti .' / '. $emp->jumlah?>"  class="form-control">
                                </div><?php endif; ?>
                                <div class="form-group col-md-12">
                                            <label ><strong>Tanggal </strong></label>
                                             <input type="date" placeholder="yyyy-mm-dd"   name="tanggal" value=""  class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label ><strong>Dan Tanggal </strong></label>
                                             <input type="date" placeholder="yyyy-mm-dd"  name="dan_tanggal" value=""  class="form-control" required>
                                </div>

                            <?php if ($izin->id_izin == 9): ?>     
                                <div class="form-group col-md-12">
                                            <label ><strong>Dari Pukul </strong></label>
                                             <input type="time" placeholder="00:00"  name="waktu" value="00:00"  class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label ><strong>Sampai Pukul </strong></label>
                                             <input type="time" placeholder=""  name="dan_waktu" value="00:00"  class="form-control" required>
                                </div><?php endif; ?>

                            <?php if ($izin->id_izin == 10 OR $izin->id_izin == 11): ?>     
                                <div class="form-group col-md-12">
                                            <label ><strong> Pukul </strong></label>
                                             <input type="time" placeholder="00:00" id="datepicker_2" name="waktu" value="00:00"  class="form-control" required>
                                </div><?php endif; ?>

                          <?php if ($izin->id_izin == 7): ?> 
                                <div class="form-group col-md-12">
                                <label ><strong> Surat Dokter </strong></label>
                                             <input type="file"   name="berkas"   class="form-control" required>
                                </div><?php endif; ?>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Alasan </strong></label>
                                <textarea  name="alasan" class="form-control" required></textarea>
                                </div>

<input type="text" name="ket" placeholder="Masukkan Keterangan" autocomplete="off"  class="form-control" required value="Pengajuan Izin" maxlength="8" hidden>
<input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" hidden name="id_izin" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $izin->id_izin ?>"   class="form-control">
<input type="text" name="updateby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>
<input type="text" id="datepicker" name="updatetime" value="<?php date_default_timezone_set('Asia/Jakarta');
        echo date('Y-m-d H:i:s');
        ?>"  class="form-control" hidden>
<input type="text"  name="EmployeeID" value="<?php echo $emp->EmployeeID; ?>"  class="form-control" hidden>
                   <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                    <?php  
                                    $start_date = new DateTime($emp->tgl_bergabung);
                                    $end_date = new DateTime(date('Y-m-d'));
                                    $interval = $start_date->diff($end_date);
                                    $hasil1 = "$interval->days ";   ?>
  <?php if ($izin->id_izin == 8): ?> 
                    <?php
                if ($hasil1 < 320 ): ?>  
                        <div class="form-group col-12">
                                        <button disabled type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;TERBUKA DALAM
                        <?php
                        $terbuka=320;
                         echo $terbuka-$hasil1 ?> HARI</button>
                            
                    </div>
                <?php else: ?> 
       

                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div> <?php endif; ?>  <?php endif; ?> 
         <?php if ($izin->id_izin != 8): ?> 
        <div class="form-group col-12">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
        </div> <?php endif; ?> 

                                    <hr>
                    </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- selesai modal asset -->
                                    <?php  endforeach; ?>
                                                           
                        </tbody>
                            </table>
                        </div>       

     
                            
                </div>
                </div>
            </div>
<!-- modal update -->
    
<div id="izin_tambah" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">TAMBAH KATEGORI IZIN</h4>
        </div>
<form action="<?= base_url('user/izin/send_mail') ?>" id="form-tambah" method="POST">
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
  
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Email </strong></label>
                                             <input  type="text" maxlength="50" name="to" placeholder="Email"  autocomplete="off" value="NETBEANS978@gmail.com"  class="form-control">
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Subject </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="subject" placeholder="Email"  autocomplete="off" value="tes sub"  class="form-control">
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Message </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="message" placeholder="Email"  autocomplete="off" value="tes message"  class="form-control">
                                </div>
                                <input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Tambah Kategori Izin" maxlength="8" hidden>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- selesai modal asset -->
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