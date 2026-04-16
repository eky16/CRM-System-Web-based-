<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
<script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable({
        scrollX: true,
    });
});
</script>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
        "lengthMenu": [ 5,10, 25, 50, 75, 10
    });
</script> 
</head>
<?php error_reporting(0);  ?>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('user/partials/sidebar.php') ?>



        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('mom') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('user/partials/topbar.php') ?>

                <div class="container-fluid">
                <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="float-right"> 
                
                            <a href="<?= base_url('user/pembelian/tambah') ?>" target="blank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbspTambah</a>
                    
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
                 <?php if($title == "List Payment Waiting Approved"):?>   
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>user/payment/print_p"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
                 <?php if($title == "List Payment Approved"):?>   
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>user/payment/finish_"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
 <?php
// Fungsi untuk mendapatkan URL terakhir
function getLastURL() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

// Panggil fungsi dan simpan URL terakhir ke dalam variabel $lastURL
$lastURL = getLastURL();

// Gunakan parse_url untuk memecah URL menjadi bagian-bagiannya
$parsedURL = parse_url($lastURL);

// Ambil bagian path dari URL
$path = $parsedURL['path'];

// Pisahkan path dengan '/' dan ambil bagian terakhir (booking)
$parts = explode('/', $path);
$akhir_url = end($parts);

// Tampilkan bagian "booking"
 $akhir_url;
?>
   <div class="panel-body">
    <form method="post" action="<?= base_url('mom/lihat_filter') ?>" class="form-horizontal">  
        <div class="panel_controls">                         
    <!--          <div class="form-group">
           </br>

 <div class="col-sm-5">                             
                 <select id="select-state" placeholder="Pilih Pic Atau Kode Leads Project" name="id_lsp" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($all_leads_project as $lsp) : ?>
                                <option value="<?php echo $lsp->id_lsp ?>"
                                 <?php $id_lsp = $_POST['id_lsp']; ?>
                                <?php
                                if (!empty($id_lsp)) {
                                    echo $lsp->id_lsp == $id_lsp ? 'selected' : '';
                                }
                                ?>><?php echo $lsp->id_lsp .' - '.$lsp->nama_pic ?></option>
                                    <?php endforeach; ?>

                        </select>  
            </div>
            </div>
          
        <div class="col-sm-offset-3 col-sm-5">
            <button type="submit" class="btn btn-primary">Cari</button>  
            <a href="<?= base_url('mom/lihat_semua') ?>"> 
            <input type="button" class="btn btn-primary" value="Semua" \></a>                           
        </div> -->

    </div>
    </form>  
</div>  
               <div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header"></div>
            <div class="card-body">
                <form action="" id="form-tambah" method="POST">
                    <div class="form-row">
                        <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                         echo date('Y-m-d H:i:s'); ?>" 
                         class="form-control" required>
                        <div class="form-group col-md-4">
                            <label for="department"><strong>Dari Tanggal</strong></label>
                            <input type="date" placeholder="yyyy-mm-dd" name="tanggal" value="<?php echo $_POST['tanggal']; ?>" autocomplete="off" class="form-control" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="department"><strong>Sampai Tanggal</strong></label>
                            <input type="date" placeholder="yyyy-mm-dd" name="dan_tanggal" value="<?php echo $_POST['dan_tanggal']; ?>" autocomplete="off" class="form-control" required>
                        </div>

                      <!--  <div class="form-group col-md-4">
                            <label for="department"><strong>Jenis Line</strong></label>
                            <label for="department"><strong> &nbsp;</strong></label>
                            <select name="status_line" class="form-control" required>
                            <option value="">PILIH LINE...</option>

                            <option value="Line 1" <?php
                            if (!empty($_POST['status_line'])) {
                                echo $_POST['status_line'] == 'Line 1' ? 'selected' : '';
                            }
                            ?>>Line 1</option>

                            <option value="Line 2" <?php
                            if (!empty($_POST['status_line'])) {
                                echo $_POST['status_line'] == 'Line 2' ? 'selected' : '';
                            }
                            ?>>Line 2</option>

                            <option value="Line 3" <?php
                            if (!empty($_POST['status_line'])) {
                                echo $_POST['status_line'] == 'Line 3' ? 'selected' : '';
                            }
                            ?>>Line 3</option>

                            </select>
                        </div> -->

                        <div class="form-group col-md-4">
                        <label for="department"><strong>Status Produksi</strong></label>
                        <select name="jenis_tanggal" class="form-control" required>
                            <option value="">PILIH STATUS PRODUKSI...</option>

                            <option value="tgl_rencana_cutting" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'tgl_rencana_cutting' ? 'selected' : '';
                            }
                            ?>>Cutting</option>

                            <option value="tgl_rencana_punching" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'tgl_rencana_punching' ? 'selected' : '';
                            }
                            ?>>Punching</option>

                            <option value="tgl_rencana_bending" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'tgl_rencana_bending' ? 'selected' : '';
                            }
                            ?>>Bending</option>

                            <option value="tgl_rencana_welding" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'tgl_rencana_welding' ? 'selected' : '';
                            }
                            ?>>Welding</option>

                            <option value="tgl_rencana_ps" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'tgl_rencana_ps' ? 'selected' : '';
                            }
                            ?>>PS</option>

                            <option value="tgl_rencana_fa" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'tgl_rencana_fa' ? 'selected' : '';
                            }
                            ?>>FA</option>

                            <option value="tgl_rencana_packing" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'tgl_rencana_packing' ? 'selected' : '';
                            }
                            ?>>Packing</option>

                            <option value="transDate" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'transDate' ? 'selected' : '';
                            }
                            ?>>Tanggal Pesan</option>

                            

                            <option value="Semua Data" <?php
                            if (!empty($_POST['jenis_tanggal'])) {
                                echo $_POST['jenis_tanggal'] == 'Semua Data' ? 'selected' : '';
                            }
                            ?>>Semua Data</option>
                            </select>
                                        </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>

                            <?php if (!empty ($_POST['dan_tanggal'])): ?>                     

  <button type="button" class="btn btn-info" data-toggle="dropdown"><i class="fas fa-print"></i>&nbsp;&nbsp;
   Laporan
  </button>
  <div class="dropdown-menu">
  <!--  <a class="dropdown-item" href="<?php echo $url_cetak; ?>"><i class="fa fa-file-pdf" style="color:red;"></i>&nbsp;&nbsp;Export Pdf</a> -->

    <a class="dropdown-item" href="<?php echo $url_cetak_excel; ?>"><i class="fa fa-file-excel-o" style="color:green;"></i>&nbsp;&nbsp;Export Excel</a>
  </div><?php endif ?>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                <hr>
<div class="card-header">

           <div class="float-right"> 

             <?php if($jenis_line == 'Line 1' OR $jenis_line == 'Line 2' OR $jenis_line == 'Line 3'):?>
            <a  href="<?= base_url("user/wo/export_excel_master_sp_line?laporan=$laporan&line=$jenis_line"); ?>" style="color:white"  class="btn btn-info btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Excel</a>
            <?php endif;?>
            <?php if($title == 'Packing' OR $title == 'WH FG'):?>
            <a  href="<?= base_url("user/wo/export_excel_master_sp_line?laporan=$laporan"); ?>" style="color:white"  class="btn btn-info btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Excel</a>
            <?php endif;?>
           <font size="2px">       
            </div>


      <?php if($title == 'Master Schedule Produksi (MSP) Line 1' OR $title == 'Cutting Line 1' OR $title == 'Punching Line 1' OR $title == 'Bending Line 1' OR $title == 'Welding Line 1' OR $title == 'PS Line 1' OR $title == 'FA Line 1'):?>
        <?php endif;?>

        <?php if($title == 'Master Schedule Produksi (MSP) Line 2' OR $title == 'Cutting Line 2' OR $title == 'Punching Line 2' OR $title == 'Bending Line 2' OR $title == 'Welding Line 2' OR $title == 'PS Line 2' OR $title == 'FA Line 2'):?>
        <?php endif;?>

        <?php if($title == 'Master Schedule Produksi (MSP) Line 3' OR $title == 'Cutting Line 3' OR $title == 'Punching Line 3' OR $title == 'Bending Line 3' OR $title == 'Welding Line 3' OR $title == 'PS Line 3' OR $title == 'FA Line 3'):?>
        <?php endif;?>

           <!-- <a  href="<?php echo base_url(); ?>user/wo/packing">
            <strong><?= $title ?></strong></a> -->
  
              <!-- <a  href="<?php echo base_url(); ?>user/wo/list_selesai">
                    <strong>Riwayat Pesanan Barang </strong></a> / <a  href="<?php echo base_url(); ?>user/wo/list_selesai_item">
                    <strong>Riwayat Pesanan Barang</strong></a> -->
            </div>
            </font>
                    
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<div class="card-body">


                        
                                <thead>
                                    <tr>
                                        <td width="1"><font size="2px"><strong>No</strong></font></td>
                                        
                                        <td width="100"><font size="2px"><strong>No. WO</strong></font></td> 
                                        <td width="70"><font size="2px"><strong>Tgl Pesanan</strong></font></td>                               
                                        <td width="70"><font size="2px"><strong>Tgl Kirim</strong></font></td>
                                        <td width="100"><font size="2px"><strong>Customer</strong></font></td>
                                        <td width="200"><font size="2px"><strong>Nama Barang</strong></font></td>
                                        <td width="20"><font size="2px"><strong>Qty</strong></font></td>
                                        <td width="20"><font size="2px"><strong>Cut.</strong></font></td>
                                        <td width="20"><font size="2px"><strong>Punch.</strong></font></td>
                                        <td width="20"><font size="2px"><strong>Bend.</strong></font></td>
                                        <td width="20"><font size="2px"><strong>Weld.</strong></font></td>
                                        <td width="20"><font size="2px"><strong>PS</strong></font></td>
                                        <td width="20"><font size="2px"><strong>FA</strong></font></td>
                                        
                                        <td width="20"><font size="2px"><strong>Pack.</strong></font></td>
                                         
                                        <td width="50"><font size="2px"><strong>Aksi</strong></font></td>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_pr as $row): ?>
                                        <tr>
                                            <td><font size="2px"><?= $no++ ?></font></td>
                                            
                                            <td ><font size="2px"><?= $row->no_wo ?></font></td>
                                            <td ><font size="2px"><?= $row->transDate ?></font></td>
                                            <td ><font size="2px"><?= $row->tanggal_kirim ?></font></td>
                                            <td ><font size="2px"><?= $row->nama_cst ?></font></td>
                                            
                                            <td ><font size="2px"><?= $row->detailName ?></font></td>
                                            
                                            <td><font size="2px"><?= $row->quantity ?></font></td>


                                            <td><strong><a data-toggle="modal" style="color: black" data-target="#modal_cutting<?= $row->id_dt ?>" class="btn btn-light"> <font size="2"> <?php echo !empty($row->tgl_rencana_cutting) ? date("d-M-Y", strtotime($row->tgl_rencana_cutting)) : ''; ?></font> </a></strong>
                                            </td>

                                            <td><strong><a data-toggle="modal" style="color: black" data-target="#modal_punching<?= $row->id_dt ?>" class="btn btn-light"> <font size="2"> <?php echo !empty($row->tgl_rencana_punching) ? date("d-M-Y", strtotime($row->tgl_rencana_punching)) : ''; ?></font> </a></strong>
                                            </td>

                                            <td><strong><a data-toggle="modal" style="color: black" data-target="#modal_bending<?= $row->id_dt ?>" class="btn btn-light"> <font size="2"> <?php echo !empty($row->tgl_rencana_bending) ? date("d-M-Y", strtotime($row->tgl_rencana_bending)) : ''; ?></font> </a></strong>
                                            </td>

                                            <td><strong><a data-toggle="modal" style="color: black" data-target="#modal_welding<?= $row->id_dt ?>" class="btn btn-light"> <font size="2"> <?php echo !empty($row->tgl_rencana_welding) ? date("d-M-Y", strtotime($row->tgl_rencana_welding)) : ''; ?></font> </a></strong>
                                            </td>


                                            <td><strong><a data-toggle="modal" style="color: black" data-target="#modal_ps<?= $row->id_dt ?>" class="btn btn-light"> <font size="2"> <?php echo !empty($row->tgl_rencana_ps) ? date("d-M-Y", strtotime($row->tgl_rencana_ps)) : ''; ?></font> </a></strong>
                                            </td>

                                            <td><strong><a data-toggle="modal" style="color: black" data-target="#modal_fa<?= $row->id_dt ?>" class="btn btn-light"> <font size="2"> <?php echo !empty($row->tgl_rencana_fa) ? date("d-M-Y", strtotime($row->tgl_rencana_fa)) : ''; ?></font> </a></strong>
                                            </td>
                                            
                                            <td><strong><a data-toggle="modal" style="color: black" data-target="#modal_packing<?= $row->id_dt ?>" class="btn btn-light"> <font size="2"> <?php echo !empty($row->tgl_rencana_packing) ? date("d-M-Y", strtotime($row->tgl_rencana_packing)) : ''; ?></font> </a></strong>
                                            </td>

                                            <td><font size="2px">
                                                  <?php if(!empty($row->ketproblem )):?>
     <a  data-toggle="modal" style="color:white" data-target="#detail_barang<?php echo $row->id_dt ; ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a> <!--jika tidak kosong maka button warna biru.-->

<?php endif;?>
                                             <?php if(empty($row->ketproblem )):?>
     <a  data-toggle="modal" style="color:white" data-target="#detail_barang<?php echo $row->id_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a> <!--jika kosong maka button warna hijau..-->

<?php endif;?>
                                            
                                           </font>
                                                </td>
                                        
                                        </tr>
<!-- modal update System --> 

<div  class="modal modal-right fade" id="tambah_stok<?php echo $row->id_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Menjadi Stok , ID <?php echo $row->id_dt; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
      </button>
  </div>
  <form action="<?= base_url('user/wo/ubah_master_schedule_produksi') ?>" enctype="multipart/form-data"  method="POST" role="form" id="update_stok_confirm"> 
<input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
<input type="text" name="id_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_dt; ?>" hidden>
<input type="text" name="no_po" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request; ?>" hidden>

<input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>

  <div class="modal-body">
   <!-- Content Column -->

   <div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

        </div>
        <div class="card-body"><?php $Kode_Barang = $row->itemNo; ?>
            <div class="form-group col-md-12">
                <label for="nama_barang"> <span class="badge badge-success">Status Awal</span></label>
                <input  type="text "  readonly maxlength="50"  name="status_awal" id="status_awal>" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->status_awal; ?>"  class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="nama_barang"> <span class="badge badge-success">Customer</span></label>
                <input  type="text "  readonly maxlength="50"  name="kd_cst" id="nama_cst>" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->nama_cst; ?>"  class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="nama_barang"> <span class="badge badge-success">Kode Barang</span></label>
                <input  type="text "  readonly maxlength="50"  name="itemNo" id="itemNo-<?= $row->id_dt;?>" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->itemNo; ?>"  class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                <input  type="text" maxlength="240"  name="detailName" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName; ?>"  class="form-control" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="nama_barang"><span class="badge badge-success">Warna </span></label>
                <input  type="text" maxlength="240" name="warna" placeholder="Masukkan warna" autocomplete="off" value="<?php echo $row->warna; ?>"  class="form-control" readonly>
            </div>
           <div class="form-group col-md-12">
                    <label for="itemUnitName"> <span class="badge badge-success">Satuan </span></label>
                    <input type="text" name="itemUnitName" value="<?= $row->itemUnitName ?>"  class=" form-control"  autocomplete="off" readonly>
                </div> 
            <div class="form-group col-md-12">
                <label for="nama_barang"> <span class="badge badge-success">Jumlah Permintaan</span></label>
                <input  type="text "    maxlength="50"  name="quantity" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $row->quantity  ; ?>"  class="form-control" readonly>
            </div> 

 <div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Keterangan </span></label>
    <textarea  readonly name="detailNotes" placeholder="Keterangan" autocomplete="off"  class="form-control"><?php echo $row->detailNotes; ?></textarea>
</div>

<div class="form-group col-md-12">
    <label for="status_packing"><span class="badge badge-success">Status Packing </span></label>
  
<select name="status_packing" class="form-control">
  <option value="CKD" <?php if (!empty($row->status_packing)) echo $row->status_packing == 'CKD' ? 'selected' : ''; ?>>CKD</option>
  <option value="Built Up" <?php if (!empty($row->status_packing)) echo $row->status_packing == 'Built Up' ? 'selected' : ''; ?>>Built Up</option>
</select>
</div> 

 
 <div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tgl Kirim </span></label>
    <input  type="text" maxlength="240"  name="" placeholder="Keterangan" autocomplete="off" value="<?php echo $row->tanggal_kirim; ?>"  class="form-control" readonly>
</div>

 <div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tgl Target Selesai </span></label>
    <input  type="text" maxlength="240"  name="" placeholder="Keterangan" autocomplete="off" value="<?php echo $row->tgl_perkiraan; ?>"  class="form-control" readonly>
</div>
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tgl Produksi </span></label>
    <input  type="text" maxlength="240"  name="" placeholder="Keterangan" autocomplete="off" value="<?php echo $row->tgl_produksi; ?>"  class="form-control" readonly>
</div>
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Status Line</span></label>
    <input  type="text" maxlength="240"  name="" placeholder="Keterangan" autocomplete="off" value="<?php echo $row->status_line; ?>"  class="form-control" readonly>
</div>
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">QR Code</span></label>
    <input  type="text" maxlength="240"  name="qr_code" placeholder="masukkan qr" autocomplete="off" value="<?php echo $row->qr_code; ?>"  class="form-control" >

</div>



<input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

<input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
echo date('Y-m-d H:i:s');
?>"  class="form-control" hidden>

<hr>

<div class="form-group col-12">
  <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan </button>
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

<!-- Start modal modal_cutting 
<div  class="modal modal-right fade" id="modal_cutting<?= $row->id_dt ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Tanggal Cutting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/wo/update_tgl_cutting') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                               

                        <div class="col-lg-12 mb-4">

                            
                            <div class="card shadow mb-4">
                                <input  type="text" maxlength="50"  name="id_dt" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->id_dt ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Cutting</label>
                                             <input  type="date" maxlength="50"  name="tgl_rencana_cutting" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->tgl_rencana_cutting ?>"  class="form-control" required>

                                             <input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>
                                </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div> end modal modal_cutting 

 Start modal modal_punching 
<div  class="modal modal-right fade" id="modal_punching<?= $row->id_dt ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Tanggal punching</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/wo/update_tgl_punching') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 

                        <div class="col-lg-12 mb-4">

                            
                            <div class="card shadow mb-4">
                                <input  type="text" maxlength="50"  name="id_dt" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->id_dt ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Punching</label>
                                             <input  type="date" maxlength="50"  name="tgl_rencana_punching" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->tgl_rencana_punching ?>"  class="form-control" required>

                                             <input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>
                                </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                           
                       

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div>  end modal modal_punching 

 Start modal modal_bending 
<div  class="modal modal-right fade" id="modal_bending<?= $row->id_dt ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Tanggal Bending</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/wo/update_tgl_bending') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                               

                        <div class="col-lg-12 mb-4">

                          
                            <div class="card shadow mb-4">
                                <input  type="text" maxlength="50"  name="id_dt" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->id_dt ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Bending</label>
                                             <input  type="date" maxlength="50"  name="tgl_rencana_bending" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->tgl_rencana_bending ?>"  class="form-control" required>

                                             <input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>
                                </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                        
                       

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div>  end modal modal_bending 


 Start modal modal_welding 
<div  class="modal modal-right fade" id="modal_welding<?= $row->id_dt ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Tanggal welding</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/wo/update_tgl_welding') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                

                        <div class="col-lg-12 mb-4">

                            
                            <div class="card shadow mb-4">
                                <input  type="text" maxlength="50"  name="id_dt" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->id_dt ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal welding</label>
                                             <input  type="date" maxlength="50"  name="tgl_rencana_welding" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->tgl_rencana_welding ?>"  class="form-control" required>

                                             <input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>
                                </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            
                       

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div> end modal modal_welding 

Start modal modal_ps 
<div  class="modal modal-right fade" id="modal_ps<?= $row->id_dt ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Tanggal PS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/wo/update_tgl_ps') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                              

                        <div class="col-lg-12 mb-4">

                            
                            <div class="card shadow mb-4">
                                <input  type="text" maxlength="50"  name="id_dt" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->id_dt ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal PS</label>
                                             <input  type="date" maxlength="50"  name="tgl_rencana_ps" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->tgl_rencana_ps ?>"  class="form-control" required>

                                             <input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>
                                </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                         
                       

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div>  end modal modal_ps  

 Start modal modal_fa 
<div  class="modal modal-right fade" id="modal_fa<?= $row->id_dt ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Tanggal FA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/wo/update_tgl_fa') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">

                        <div class="col-lg-12 mb-4">

                            <div class="card shadow mb-4">
                                <input  type="text" maxlength="50"  name="id_dt" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->id_dt ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal PS</label>
                                             <input  type="date" maxlength="50"  name="tgl_rencana_fa" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->tgl_rencana_fa ?>"  class="form-control" required>

                                             <input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>
                                </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                       

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div>  end modal modal_fa  

 Start modal modal_packing 
<div  class="modal modal-right fade" id="modal_packing<?= $row->id_dt ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Tanggal Packing</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/wo/update_tgl_packing') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">

                        <div class="col-lg-12 mb-4">

                            <div class="card shadow mb-4">
                                <input  type="text" maxlength="50"  name="id_dt" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->id_dt ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Packing</label>
                                             <input  type="date" maxlength="50"  name="tgl_rencana_packing" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->tgl_rencana_packing ?>"  class="form-control" required>

                                             <input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>
                                </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                       

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div>  end modal modal_packing  -->

<!-- modal update System --> 

<div  class="modal modal-right fade" id="detail_barang<?php echo $row->id_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Detail Permintaan Barang <?php echo $row->id_dt; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
      </button>
  </div>
  <form action="<?= base_url('user/wo/ubah_master_schedule_produksi') ?>" enctype="multipart/form-data"  method="POST" role="form" id="newModalForm"> 
<input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
<input type="text" name="id_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_dt; ?>" hidden>
<input type="text" name="no_po" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request; ?>" hidden>

<input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>

  <div class="modal-body">
   <!-- Content Column -->

   <div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

        </div>  
         <div class="card-body"><?php $Kode_Barang = $row->itemNo; ?>
            <div class="form-group col-md-12">
                <label for="nama_barang"> <span class="badge badge-success">Status Awal</span></label>
                <input  type="text "  readonly maxlength="50"  name="status_awal" id="status_awal>" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->status_awal; ?>"  class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="nama_barang"> <span class="badge badge-success">Customer</span></label>
                <input  type="text "  readonly maxlength="50"  name="kd_cst" id="nama_cst>" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->nama_cst; ?>"  class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="nama_barang"> <span class="badge badge-success">Kode Barang</span></label>
                <input  type="text "  readonly maxlength="50"  name="itemNo" id="itemNo-<?= $row->id_dt;?>" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->itemNo; ?>"  class="form-control">
            </div>

            <div class="form-group col-md-12">
                <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                <input  type="text" maxlength="240"  name="detailName" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName; ?>"  class="form-control" readonly>
            </div>
            <div class="form-group col-md-12">
                <label for="nama_barang"><span class="badge badge-success">Warna </span></label>
                <input  type="text" maxlength="240" name="warna" placeholder="Masukkan warna" autocomplete="off" value="<?php echo $row->warna; ?>"  class="form-control" readonly>
            </div>
           <div class="form-group col-md-12">
                    <label for="itemUnitName"> <span class="badge badge-success">Satuan </span></label>
                    <input type="text" name="itemUnitName" value="<?= $row->itemUnitName ?>"  class=" form-control"  autocomplete="off" readonly>
                </div> 
            <div class="form-group col-md-12">
                <label for="nama_barang"> <span class="badge badge-success">Jumlah Permintaan</span></label>
                <input  type="text "    maxlength="50"  name="quantity" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $row->quantity  ; ?>"  class="form-control" readonly>
            </div> 

 <div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Keterangan </span></label>
    <textarea  readonly name="detailNotes" placeholder="Keterangan" autocomplete="off"  class="form-control"><?php echo $row->detailNotes; ?></textarea>
</div>

<div class="form-group col-md-12">
    <label for="status_packing"><span class="badge badge-success">Status Packing </span></label>
  
<select name="status_packing" class="form-control">
  <option value="CKD" <?php if (!empty($row->status_packing)) echo $row->status_packing == 'CKD' ? 'selected' : ''; ?>>CKD</option>
  <option value="Built Up" <?php if (!empty($row->status_packing)) echo $row->status_packing == 'Built Up' ? 'selected' : ''; ?>>Built Up</option>
</select>
</div> 
 
 <div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tgl Kirim </span></label>
    <input  type="text" maxlength="240"  name="" placeholder="Tgl Kirim" autocomplete="off" value="<?php echo $row->tanggal_kirim; ?>"  class="form-control" readonly>
</div>

 <div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tgl Target Selesai </span></label>
    <input  type="text" maxlength="240"  name="" placeholder="Tgl Target Selesai " autocomplete="off" value="<?php echo $row->tgl_perkiraan; ?>"  class="form-control" readonly>
</div>
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tgl Produksi </span></label>
    <input  type="date" maxlength="240"  name="tgl_produksi" placeholder="Keterangan" autocomplete="off" value="<?php echo $row->tgl_produksi; ?>"  class="form-control">
</div>

<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Status Line</span></label>
    <input  type="text" maxlength="240"  name="status_line" placeholder="Keterangan" autocomplete="off" value="<?php echo $row->status_line; ?>"  class="form-control" readonly>
</div>

<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Status </span></label>
    <input  type="text" maxlength="240"  name="status_qr" placeholder="Keterangan" autocomplete="off" value="<?php echo $row->status_qr; ?>"  class="form-control" readonly>
</div>

<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">QR Code </span></label>
    <textarea   name="qr_code" placeholder="masukkan qr" autocomplete="off"  class="form-control"><?php echo $row->qr_code; ?></textarea>
</div>
 <div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Gambar Kerja </span></label>
    <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
    <?php endif ;?>
    <input  type="file" maxlength="240"  name="gambar_kerja" placeholder="Upload File" autocomplete="off" value="<?php echo $row->gambar_kerja; ?>"  class="form-control">
</div>

<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Keterangan Problem</span></label>
    <textarea   name="ketproblem" placeholder="Keterangan" autocomplete="off"  class="form-control"><?php echo $row->ketproblem; ?></textarea>
</div>

<?php if ($row->status_qr == 'Stok') :?>
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tanggal Kirim </span></label>
    <input  type="date" maxlength="240"  name="tanggal_kirim" placeholder="tanggal_kirim" autocomplete="off" value="<?php echo $row->tanggal_kirim; ?>"  class="form-control" >

</div> 
<div class="form-group col-md-12">
<label for="nama_barang"><span class="badge badge-success">Status Prosess </span></label>
 <select name="status_qr" class="form-control" >
    <option value="Stok" <?php
    if (!empty($row->status_qr)) {
        echo $row->status_qr == 'Stok' ? 'selected' : '';
    }
    ?>>Stok</option>
    <option value="Ready" <?php 
    if (!empty($row->status_qr)) {
        echo $row->status_qr == 'Ready' ? 'selected' : '';
    }
    ?>>Ready</option>
    </select>
</div>
<?php endif ;?>
<?php if ($row->status_qr != 'Packing') :?>
<div class="form-group col-md-12">
    <input  type="text" maxlength="240"  name="status_qr" placeholder="status_qr" autocomplete="off" value="<?php echo $row->status_qr; ?>"  class="form-control" hidden>

</div> 

<?php endif ;?>
<?php if ($row->status_qr == 'Packing') :?>
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tanggal Kirim </span></label>
    <input  type="date" maxlength="240"  name="tanggal_kirim" placeholder="tanggal_kirim" autocomplete="off" value="<?php echo $row->tanggal_kirim; ?>"  class="form-control" required>

</div> 

<div class="form-group col-md-12">
<label for="nama_barang"><span class="badge badge-success">Status Prosess </span></label>
 <select name="status_qr" class="form-control" >
    <option value="Ready" <?php 
    if (!empty($row->status_qr)) {
        echo $row->status_qr == 'Ready' ? 'selected' : '';
    }
    ?>>Ready</option>
    </select>
</div>
<?php endif ;?>

<input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

<input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
echo date('Y-m-d H:i:s');
?>"  class="form-control" hidden>

<hr>

<div class="form-group col-12">
  <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan </button>
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
<!-- modal update PR  --> 
<div id="show_code<?= $row->id_dt ?>" class="modal fade">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Kode Qr</h4>
        </div>
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">
                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary"><?= $row->qr_code ?></h6>
                                </div>
                            </div>
                        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- end modal Qr Code-->
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>              
                </div>
                </div>
            </div>
<!-- modal update -->


                            <!-- Color System -->
                       

 <!-- end modal -->
            <!-- load footer -->
            <?php $this->load->view('user/partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('partials/js.php') ?>
    <script>
        function hanyaAngka(evt) {
          var charCode = (evt.which) ? evt.which : event.keyCode
           if (charCode > 31 && (charCode < 48 || charCode > 57))
 
            return false;
          return true;
        }
    </script>
<script>
    document.querySelector('#update_stok_confirm').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Qty Forecast akan diubah menjadi stok, Setujui!",
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
              text: 'Forecast Berhasil Diubah Menjadi Stok',
              icon: 'success'
            }).then(function() {
              form.submit();
            });
          } else {
            swal("Cancelled", "PR tidak ada perubahan :)", "error");
          }
        });
    });
  </script>
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>  