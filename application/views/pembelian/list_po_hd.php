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
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('mom') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                <div class="clearfix">
                    <div class="float-left">
                        <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="float-right"> 
                
                            <a href="<?= base_url('pembelian/tambah') ?>" target="blank" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbspTambah</a>
                    
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
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>payment/print_p"> Cetak Laporan</a></font></strong></div>
                <?php endif;?>
                 <?php if($title == "List Payment Approved"):?>   
                    <div class="card-header"><strong><?= $title ?> /<font color="blue"> <a target="blank_" href="<?php echo base_url(); ?>payment/finish_"> Cetak Laporan</a></font></strong></div>
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
<div class="card-header">
           <div class="float-right"> 

             <?php if($jenis_line == 'Line 1' OR $jenis_line == 'Line 2' OR $jenis_line == 'Line 3'):?>
            <a  href="<?= base_url("wo/export_excel_produksi_line?laporan=$laporan&line=$jenis_line"); ?>" style="color:white"  class="btn btn-info btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Excel</a>
            <?php endif;?>
            <?php if($title == 'Packing' OR $title == 'WH FG'):?>
            <a  href="<?= base_url("wo/export_excel_produksi?laporan=$laporan"); ?>" style="color:white"  class="btn btn-info btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Excel</a>
            <?php endif;?>
           <font size="2px">       
            </div>
      <?php if($title == 'Permintaan Barang - Produksi Line 1' OR $title == 'Cutting Line 1' OR $title == 'Punching Line 1' OR $title == 'Bending Line 1' OR $title == 'Welding Line 1' OR $title == 'PS Line 1' OR $title == 'FA Line 1'):?>
            <a  href="<?php echo base_url(); ?>wo/produksi_line1">
            <strong>Produksi</strong></a> / <a  href="<?php echo base_url(); ?>wo/cutting_line1">
            <strong>Cutting</strong></a> / <a  href="<?php echo base_url(); ?>wo/punching_line1">
            <strong>Punching</strong></a>  / <a  href="<?php echo base_url(); ?>wo/bending_line1">
            <strong>Bending</strong></a>  / <a  href="<?php echo base_url(); ?>wo/welding_line1">
            <strong>Welding</strong></a>  / <a  href="<?php echo base_url(); ?>wo/ps_line1">
            <strong>PS</strong></a>  / <a  href="<?php echo base_url(); ?>wo/fa_line1"><strong>FA</strong></a>  /
        <?php endif;?>

        <?php if($title == 'Permintaan Barang - Produksi Line 2' OR $title == 'Cutting Line 2' OR $title == 'Punching Line 2' OR $title == 'Bending Line 2' OR $title == 'Welding Line 2' OR $title == 'PS Line 2' OR $title == 'FA Line 2'):?>
            <a  href="<?php echo base_url(); ?>wo/produksi_line1">
            <strong>Produksi</strong></a> / <a  href="<?php echo base_url(); ?>wo/cutting_line2">
            <strong>Cutting</strong></a> / <a  href="<?php echo base_url(); ?>wo/punching_line2">
            <strong>Punching</strong></a>  / <a  href="<?php echo base_url(); ?>wo/bending_line2">
            <strong>Bending</strong></a>  / <a  href="<?php echo base_url(); ?>wo/welding_line2">
            <strong>Welding</strong></a>  / <a  href="<?php echo base_url(); ?>wo/ps_line2">
            <strong>PS</strong></a>  / <a  href="<?php echo base_url(); ?>wo/fa_line2"><strong>FA</strong></a>  / 
        <?php endif;?>

        <?php if($title == 'Permintaan Barang - Produksi Line 3' OR $title == 'Cutting Line 3' OR $title == 'Punching Line 3' OR $title == 'Bending Line 3' OR $title == 'Welding Line 3' OR $title == 'PS Line 3' OR $title == 'FA Line 3'):?>
            <a  href="<?php echo base_url(); ?>wo/produksi_line1">
            <strong>Produksi</strong></a> / <a  href="<?php echo base_url(); ?>wo/cutting_line3">
            <strong>Cutting</strong></a> / <a  href="<?php echo base_url(); ?>wo/punching_line3">
            <strong>Punching</strong></a>  / <a  href="<?php echo base_url(); ?>wo/bending_line3">
            <strong>Bending</strong></a>  / <a  href="<?php echo base_url(); ?>wo/welding_line3">
            <strong>Welding</strong></a>  / <a  href="<?php echo base_url(); ?>wo/ps_line3">
            <strong>PS</strong></a>  / <a  href="<?php echo base_url(); ?>wo/fa_line3"><strong>FA</strong></a>  / 
        <?php endif;?>

            <a  href="<?php echo base_url(); ?>wo/packing">
            <strong>Packing</strong></a>  / <a  href="<?php echo base_url(); ?>barang">
            <strong>Stock FG</strong></a>
  
              <!-- <a  href="<?php echo base_url(); ?>wo/list_selesai">
                    <strong>Riwayat Pesanan Barang </strong></a> / <a  href="<?php echo base_url(); ?>wo/list_selesai_item">
                    <strong>Riwayat Pesanan Barang</strong></a> -->
            </div>
            </font>
                    
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td width="1"><font size="2px">No</font></td>
                                        <td width="70"><font size="2px">Tgl Produksi</font></td>
                                         <td width="70"><font size="2px">Tgl Kirim</font></td>
                                        <td width="100"><font size="2px">No. WO</font></td>
                                        <td width="200"><font size="2px">Nama Barang</font></td>
                                        <td width="20"><font size="2px">Qty</font></td>
                                        <td width="20"><font size="2px">QrCode</font></td>
                                        <td width="40"><font size="2px">File</font></td>
                                        <td width="80"><font size="2px">Status</font></td>
                                        <td width="50"><font size="2px">Aksi</font></td>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_pr as $row): ?>
                                        <tr>
                                            <td><font size="1px"><?= $no++ ?></font></td>
                                            <td ><font size="2px"><?= $row->tgl_produksi ?></font></td>
                                            <td ><font size="2px"><?= $row->tanggal_kirim ?></font></td>
                                            <td ><font size="2px"><?= $row->no_wo ?></font></td>
                                            <td ><font size="2px"><?= $row->detailName ?></font></td>
                                            <td><font size="2px"><?= $row->quantity ?></font></td>
                                            <td><font size="2px">
                                                <?php if (!empty($row->qr_code)):?>
                                                    <a  data-toggle="modal" style="color:white" data-target="#show_code<?= $row->id_dt ?>" class="btn badge badge-primary"><i class="fa fa-barcode"></i>&nbsp;&nbsp;QrCode</a>
                                                <?php endif ;?>
                                                </font></td>
                                            <td><font size="2px"> <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                                        <?php endif ;?></font>
                                            </td>
                                            <td align="center"><font size="3px">
                                            <span class="badge badge-info"> <?=  $row->status_qr  ?> </span>
                                            </font>
                                            </td>
                                            <td><font size="2px">
                                                <?php $customer = $row->nama_cst;
                                                        $status_qr = $row->status_qr; ?>
                                            <?php if ($customer != "Forecast" OR $status_qr == "Selesai") : ?>
                                                  <a  data-toggle="modal" style="color:white" data-target="#detail_barang<?php echo $row->id_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                            <?php endif;?>

                                                 <?php if ($customer == "Forecast" And $status_qr == "Packing"  ) : ?>
                                                  <a  data-toggle="modal" style="color:white" data-target="#tambah_stok<?php echo $row->id_dt ; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                            <?php endif;?>

                                            <?php if ($customer == "Forecast" AND $status_qr != "Selesai" AND $status_qr != "Packing") : ?>
                                                  <a  data-toggle="modal" style="color:white" data-target="#detail_barang<?php echo $row->id_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                            <?php endif;?>
                                            <?php if ($row->status_po == 1) : ?>
                                                    <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('pembelian/hapus_pr_hd_dt_hs/' . $row->number_ ) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            <?php endif;?></font>
                                                </td>
                                        
                                        </tr>
<div  class="modal modal-right fade" id="tambah_stok<?php echo $row->id_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Menjadi Stok , ID <?php echo $row->id_dt; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
      </button>
  </div>
  <form action="<?= base_url('wo/ubah_master_forecast_to_stok') ?>" enctype="multipart/form-data"  method="POST" role="form" id="update_stok_confirm"> 
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
                <label for="nama_barang"><span class="badge badge-success">No.WO </span></label>
                <input  type="text" maxlength="240"  name="no_wo" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->no_wo; ?>"  class="form-control" readonly>
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
  <form action="<?= base_url('wo/ubah_proses') ?>" enctype="multipart/form-data"  method="POST" role="form" id="newModalForm"> 
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
    <input  type="text" maxlength="240"  name="tanggal_kirim" placeholder="Keterangan" autocomplete="off" value="<?php echo $row->tanggal_kirim; ?>"  class="form-control" readonly>
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
 <div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Gambar Kerja </span></label>
    <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
    <?php endif ;?>
    <input  type="file" maxlength="240"  name="gambar_kerja" placeholder="Upload File" autocomplete="off" value="<?php echo $row->gambar_kerja; ?>"  class="form-control">
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
            <?php $this->load->view('partials/footer.php') ?>
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