<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('user/partials/head.php') ?>

     <!-- Muat jQuery terlebih dahulu -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
  

<script type="text/javascript">
    $(document).ready(function () {
    $('#example').DataTable({
        scrollX: true,
    });
});
</script>
<script>
        $(document).ready(function(){
            // Menginisialisasi DataTables pada tabel dengan ID 'tabel-data'
            $('#tabel-data').DataTable({
                "lengthMenu": [5, 10, 25, 50, 75, 100] 
            });
        });
    </script>


</head>
<?php error_reporting(0);  ?>

</head>

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
<?php
// Simpan data filter ke session jika form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['tanggal'] = $this->input->post('tanggal');
    $_SESSION['dan_tanggal'] = $this->input->post('dan_tanggal');
    $_SESSION['jenis_tanggal'] = $this->input->post('jenis_tanggal');
}
?>
 <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"></div>
                            <div class="card-body">
<form action="" id="form-tambah" method="POST">
    <div class="form-row">

       

        <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
            echo date('Y-m-d H:i:s');
        ?>" class="form-control" required>

        <div class="form-group col-md-4">
            <label for="department"><strong>Dari Tanggal</strong></label>
            <input type="date" placeholder="yyyy-mm-dd" name="tanggal" value="<?php echo isset($_SESSION['tanggal']) ? $_SESSION['tanggal'] : ''; ?>" autocomplete="off" class="form-control" required>
        </div>

        <div class="form-group col-md-4">
            <label for="department"><strong>Sampai Tanggal</strong></label>
            <input type="date" placeholder="yyyy-mm-dd" name="dan_tanggal" value="<?php echo isset($_SESSION['dan_tanggal']) ? $_SESSION['dan_tanggal'] : ''; ?>" autocomplete="off" class="form-control" required>
        </div>

        <div class="form-group col-md-4">
            <label for="department"><strong> &nbsp;</strong></label>
            <select name="jenis_tanggal" class="form-control" required>
                <option value="">PILIH ...</option>

                <option value="transDate" <?php echo (isset($_SESSION['jenis_tanggal']) && $_SESSION['jenis_tanggal'] == 'transDate') ? 'selected' : ''; ?>>Tanggal Pesan</option>

                <option value="tanggal_kirim" <?php echo (isset($_SESSION['jenis_tanggal']) && $_SESSION['jenis_tanggal'] == 'tanggal_kirim') ? 'selected' : ''; ?>>Tanggal Kirim</option>
                <!--<option value="Semua Data" <?php // echo (isset($_SESSION['jenis_tanggal']) && $_SESSION['jenis_tanggal'] == 'Semua Data') ? 'selected' : ''; ?>>Data Bulan Aktif</option> -->
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>
        </div>
    </div>
</form>
 </div>              
                        </div>
                    </div>
                </div>

<div class="card-header">
           <div class="float-right"> 

            
            <a  href="<?= base_url("user/wo/export_excel_master_wo"); ?>" style="color:white"  class="btn btn-info btn-sm"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Excel</a>

           <font size="3px">       
            </div>
                   
              <!-- <a  href="<?php echo base_url(); ?>user/wo/list_selesai">
                    <strong>Riwayat Pesanan Barang </strong></a> / <a  href="<?php echo base_url(); ?>user/wo/list_selesai_item">
                    <strong>Riwayat Pesanan Barang</strong></a> -->
            </div>
            </font>
                    <style>
    /* CSS untuk tabel */
    .colorful-table {
        border-collapse: collapse;
        width: 100%;
    }

    .colorful-table th,
    .colorful-table td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
    }

    /* CSS untuk warna sel tertentu */
    .color-Plum {
        background-color: Plum;
        color: black; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang merah */
    }

    .color-Brown {
        background-color: Brown;
        color: white; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang hijau */
    }
</style>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td class="color-Brown" width="1"><font size="2px"><strong>No</strong></font></td>
                                        <!--<td class="color-Brown" width="1"><font size="2px"><strong>No. Permintaan</strong></font></td>-->
                                        <td class="color-Brown" width="100"><font size="2px"><strong>No. WO</strong></font></td>
                                        <td class="color-Brown" width="70"><font size="2px"><strong>Tgl Pesanan</strong></font></td>
                                        <td class="color-Brown" width="70"><font size="2px"><strong>Customer</strong></font></td>
                                        <td class="color-Brown" width="200"><font size="2px"><strong>Nama Barang</strong></font></td>
                                        <td class="color-Brown" width="200"><font size="2px"><strong> Packing</strong></font></td>
                                        <td class="color-Brown" width="20"><font size="2px"><strong>Qty</strong></font></td>
                                        <td class="color-Brown" width="20"><font size="2px"><strong>Warna</strong></font></td>
                                        <td class="color-Brown" width="70"><font size="2px"><strong>Tgl Kirim</strong></font></td>
                                        <td class="color-Brown" width="70"><font size="2px"><strong>Part List</strong></font></td>
                                        <td class="color-Brown" width="70"><font size="2px"><strong>Gambar Kerja</strong></font></td>
                                        <td class="color-Brown" width="50"><font size="2px"><strong>Status</strong></font></td>
                                        <td class="color-Brown" width="50"><font size="2px"><strong>Ket. Problem</strong></font></td>
                                        <td class="color-Brown" width="50"><font size="2px"><strong>Aksi</strong></font></td>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_pr as $row): ?>
                                        <tr>
                                            <td ><font size="2px"><?= $no++ ?></font></td>
                                           <!--<td ><font size="2px"><?= $row->no_permintaan ?></font></td>-->
                                            <td ><font size="2px"><?= $row->no_wo ?></font></td>
                                            <td ><font size="2px"><?= $row->transDate ?></font></td> 
                                            <td ><font size="2px"><?= $row->nama_cst ?></font></td>
                                            <td ><font size="2px"><?= $row->detailName ?></font></td>
                                            <td ><font size="2px"><?= $row->status_packing ?></font></td>
                                            <td ><font size="2px"><?= $row->quantity ?></font></td>
                                            <td ><font size="2px"><?= $row->warna ?></font></td>
                                            <td ><font size="2px"><?= $row->tanggal_kirim ?></font></td>

                                            <!-- <td><font size="2px"> <?php if (!empty($row->gambar_pemasangan)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_pemasangan/<?= $row->gambar_pemasangan ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                                        <?php endif ;?></font>
                                            </td> -->

                                            <td><font size="2px"> <?php if (!empty($row->part_list)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/part_list/<?= $row->part_list ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                                        <?php endif ;?></font>
                                            </td>

                                            <td><font size="2px"> <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                                        <?php endif ;?></font>
                                            </td>

                                            <td align="center"><font size="2px">
                                            <span class="badge badge-info"> <?=  $row->status_qr  ?> - <?=  $row->status_line  ?> </span>
                                            </font></td>

                                            <td ><font size="2px"><?= $row->ketproblem ?></font></td>

    

                                            <td><font size="2px">
                                                
                                             <?php if(!empty($row->ketproblem )):?>
                                              <a  data-toggle="modal" style="color:white" data-target="#detail_barang<?php echo $row->id_dt ; ?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a> <!-- jika tidak kosong maka button warna kuning..-->
                                              <?php endif;?>

                                             <?php if(empty($row->ketproblem )):?>
                                            <a  data-toggle="modal" style="color:white" data-target="#detail_barang<?php echo $row->id_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a> <!--jika kosong maka button warna hijau..-->
                                              
                                               <?php endif; ?> 


                                           <?php
                                             $cek_jabatan = trim($emp->divisi . ' ' . $emp->department);
                                             //var_dump($emp->divisi);
                                             //var_dump($emp->department);
                                             if ($cek_jabatan == 'Staff PPIC') {
                                                 ?>
                                            <a onclick="return confirm('Apakah Anda yakin ingin Hapus data Work Order : <?= $row->no_wo ?>?')" href="<?= base_url('user/wo/hapus_master_wo/' . $row->id_dt ) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            </font>
                                                </td>
                                                <?php
                                                  }
                                                  ?>
                                                 
                                    
                                        </tr>

                                                                             
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
  <form action="<?= base_url('user/wo/ubah_master_wo') ?>" enctype="multipart/form-data"  method="POST" role="form" id="newModalForm"> 
<input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
<input type="text" name="id_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_dt; ?>" hidden>
<input type="text" name="no_po" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request; ?>" hidden>

<input type="text" name="url" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $akhir_url; ?>" hidden>

<!-- Tambahkan input hidden untuk mempertahankan nilai filter tanggal -->
  <input type="text" name="tanggal" value="<?php echo isset($_POST['tanggal']) ? $_POST['tanggal'] : ''; ?>" hidden>
  <input type="text" name="dan_tanggal" value="<?php echo isset($_POST['dan_tanggal']) ? $_POST['dan_tanggal'] : ''; ?>" hidden>
  <input type="text" name="jenis_tanggal" value="<?php echo isset($_POST['jenis_tanggal']) ? $_POST['jenis_tanggal'] : ''; ?>" hidden>


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

            <?php
$cek_jabatan = trim($emp->divisi . ' ' . $emp->department);

// Tentukan apakah input seharusnya readonly atau tidak
$readonlyAttribute = ($cek_jabatan != 'Staff PPIC') ? 'readonly' : '';

if (in_array($cek_jabatan, ['Staff PPIC', 'Manager Produksi', 'Kabag Engineering', 'Staff Produksi'])) {
?>
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Warna</span></label>
    <?php
    // Menampilkan input dengan atau tanpa readonly sesuai jabatan dan status produksi
    echo '<input type="text" maxlength="50" name="warna" placeholder="Masukkan Jumlah Permintaan" autocomplete="off" value="' . $row->warna . '" class="form-control" ' . $readonlyAttribute . '>';
    ?>
</div>
<?php
}
?> 



            <div class="form-group col-md-12">
                    <label for="itemUnitName"> <span class="badge badge-success">Satuan </span></label>
                    <input type="text" name="itemUnitName" value="<?= $row->itemUnitName ?>"  class=" form-control"  autocomplete="off" readonly>
                </div> 



                <div class="form-group col-md-12">
                        <label for="itemUnitName"> <span class="badge badge-success">Jumlah Permintaan </span></label>
                        <input type="text" name="quantity" placeholder="Jumlah Permintaan" autocomplete="off" value="<?= $row->quantity ?>" class="form-control" <?= $readonlyAttribute ?>>
                    </div>


            <?php
                $cek_jabatan = trim($emp->divisi . ' ' . $emp->department);

                if ($cek_jabatan == 'Staff PPIC' || $cek_jabatan == 'Manager Produksi' || $cek_jabatan == 'Kabag Engineering' || $cek_jabatan == 'Staff Produksi') {
                    $readonlyAttribute = ($cek_jabatan == 'Manager Produksi' || $cek_jabatan == 'Staff Produksi') ? 'readonly' : '';
                ?>
                    <div class="form-group col-md-12">
                        <label for="nama_barang"><span class="badge badge-success">No. WO</span></label>
                        <input type="text" maxlength="240" name="no_wo" placeholder="Masukkan No. WO" autocomplete="off" value="<?= $row->no_wo ?>" class="form-control" <?= $readonlyAttribute ?>>
                    </div>
                <?php
                }
                ?>      

            <div class="form-group col-md-12">
                <label for="nama_barang"><span class="badge badge-success">Keterangan </span></label>
                <textarea name="detailNotes" placeholder="Keterangan" autocomplete="off"  class="form-control"><?php echo $row->detailNotes; ?></textarea>
            </div>


            <div class="form-group col-md-12">
                <label for="status_packing"><span class="badge badge-success">Status Packing </span></label> 
                <select name="status_packing" class="form-control">
                <option value="" selected>Pilih status packing</option>
                <option value="CKD" <?php if (!empty($row->status_packing)) echo $row->status_packing == 'CKD' ? 'selected' : ''; ?>>CKD</option>
                <option value="Built Up" <?php if (!empty($row->status_packing)) echo $row->status_packing == 'Built Up' ? 'selected' : ''; ?>>Built Up</option>
            </select></div>

 
            <div class="form-group col-md-12">
              <label for="nama_barang"><span class="badge badge-success">Tgl Kirim</span></label>
              <input  type="date" maxlength="240"  name="tanggal_kirim" placeholder="Tanggal Kirim" autocomplete="off" value="<?php echo $row->tanggal_kirim; ?>"  class="form-control">
            </div>

 <!--StartTglRencanaSelesai <div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tgl Selesai</span></label>
    <input  type="date" maxlength="240"  name="tgl_perkiraan" placeholder="Tanggal Selesai" autocomplete="off" value="<?php echo $row->tgl_perkiraan; ?>"  class="form-control">
  </div> EndTglRencanaSelesai-->
 
            <div class="form-group col-md-12">
                <label for="nama_barang"><span class="badge badge-success">Tgl Produksi </span></label>
                <input  type="date" maxlength="240"  name="tgl_produksi" placeholder="Keterangan" autocomplete="off" value="<?php echo $row->tgl_produksi; ?>"  class="form-control">
            </div>


            <div class="form-group col-md-12" id=produksi-<?= $row->id_dt; ?>>
                <label for="nama_barang"><span class="badge badge-success">Status Line </span></label>
          
            <select name="status_line">
              <option value="Line 1" <?php if (!empty($row->status_line)) echo $row->status_line == 'Line 1' ? 'selected' : ''; ?>>Line 1</option>
              <option value="Line 2" <?php if (!empty($row->status_line)) echo $row->status_line == 'Line 2' ? 'selected' : ''; ?>>Line 2</option>
              <option value="Line 3" <?php if (!empty($row->status_line)) echo $row->status_line == 'Line 3' ? 'selected' : ''; ?>>Line 3</option>
            </select>
            </div>


            
            <div class="form-group col-md-12">
                <label for="nama_barang"><span class="badge badge-success">QR Code </span></label>
                <textarea name="qr_code" placeholder="Masukkan QR Code" autocomplete="off" class="form-control" <?php echo $readonlyAttribute; ?>><?php echo $row->qr_code; ?></textarea>
            </div>
 

            <div class="form-group col-md-12">
    <label for="nama_barang">
        <span class="badge badge-success">Gambar Kerja </span>
    </label>

    <?php if (!empty($row->gambar_kerja)): ?>
        <div id="file-wrapper-<?= $row->id_dt ?>">
            <!-- Tombol lihat -->
            <a target="_blank" 
               href="<?= base_url('img/uploads/gambar_kerja/' . $row->gambar_kerja) ?>" 
               class="badge badge-primary">Lihat</a>

            <!-- Tombol hapus pakai AJAX -->
            <button type="button" 
        class="badge badge-danger btn-hapus-file" 
        data-id="<?= $row->id_dt ?>" 
        data-tipe="gambar_kerja">
    Hapus Gambar Kerja
</button>
        </div>
    <?php endif; ?>

    <!-- Upload baru -->
    <input type="file" maxlength="240" name="gambar_kerja" class="form-control">
</div>

            <div class="form-group col-md-12">
    <label for="nama_barang">
        <span class="badge badge-success">Part List </span>
    </label>

    <?php if (!empty($row->part_list)): ?>
        <div id="file-wrapper-<?= $row->id_dt ?>">
            <!-- Tombol lihat -->
            <a target="_blank" 
               href="<?= base_url('img/uploads/part_list/' . $row->part_list) ?>" 
               class="badge badge-primary">Lihat</a>

            <!-- Tombol hapus pakai AJAX -->
            <button type="button" 
        class="badge badge-danger btn-hapus-file" 
        data-id="<?= $row->id_dt ?>" 
        data-tipe="part_list">
    Hapus Part List
</button>
        </div>
    <?php endif; ?>

    <!-- Upload baru -->
    <input type="file" maxlength="240" name="part_list" class="form-control">
</div>
            


            <div class="form-group col-md-12">
                <label for="nama_barang"><span class="badge badge-success">Ket. Problem</span></label>
                <textarea   name="ketproblem" placeholder="Keterangan" autocomplete="off"  class="form-control"><?php echo $row->ketproblem; ?></textarea>
            </div>

                <?php
                $cek_jabatan = trim($emp->divisi . ' ' . $emp->department);

                if ($cek_jabatan == 'Staff PPIC' || $cek_jabatan == 'Manager Produksi' || $cek_jabatan == 'Kabag Engineering') {
                $readonlyAttribute = ($cek_jabatan == 'Manager Produksi' || $cek_jabatan == 'Kabag Engineering') ? 'disabled' : '';
                ?>

                <div class="form-group col-md-12">
                    
                        <label for="nama_barang"><span class="badge badge-success">Pembatalan </span></label>
                        <select name="status_pembatalan" class="form-control" <?= $readonlyAttribute ?>>
                            <option value="">PILIH .....</option>
                            <option value="Batal" <?php echo (!empty($row->status_qr) && $row->status_qr == 'Batal') ? 'selected' : ''; ?>>Batal</option>
                        </select>
                    
                </div>

                <?php
                }
                ?>

<?php if ($row->status_qr == 'Stok') :?>

<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tgl Kirim </span></label>
    <input  type="date" maxlength="240"  name="tanggal_kirim" placeholder="masukkan qr" autocomplete="off" value="<?php echo $row->tanggal_kirim; ?>"  class="form-control" >

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


                <?php
                $cek_jabatan = trim($emp->divisi . ' ' . $emp->department);

                if ($cek_jabatan == 'Staff PPIC' || $cek_jabatan == 'Manager Produksi' || $cek_jabatan == 'Kabag Engineering') {
                $readonlyAttribute = ($cek_jabatan == 'Manager Produksi' || $cek_jabatan == 'Kabag Engineering') ? 'disabled' : '';
                ?>
                  <div class="form-group col-md-12">
                  <label for="nama_barang"><span class="badge badge-success">Status Prosess </span></label>
                   <select name="status_qr" class="form-control" <?= $readonlyAttribute ?>>
                      <option value="Ready" <?php 
                      if (!empty($row->status_qr)) {
                        echo $row->status_qr == 'Ready' ? 'selected' : '';
                    }
                      ?>>Ready</option>
                      </select>
                  </div>
                  <?php
                               }
                               ?>
                  <?php endif ;?>


<input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

<input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
echo date('Y-m-d H:i:s');
?>"  class="form-control" hidden>

<hr>

<?php if (trim($emp->divisi . ' ' . $emp->department) == 'Staff PPIC' || trim($emp->divisi . ' ' . $emp->department) == 'Kabag Engineering' || trim($emp->divisi . ' ' . $emp->department) == 'Staff Produksi'): ?>
    <div class="form-group col-12">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
    </div>
<?php endif; ?>

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
$(document).on('click', '.btn-hapus-file', function(e) {
    e.preventDefault();

    let id_dt = $(this).data('id');
    let tipe  = $(this).data('tipe');
    let wrapper = $("#file-wrapper-" + id_dt);

    if (confirm("Yakin hapus " + tipe.replace("_"," ") + " ini?")) {
        $.ajax({
            url: "<?= site_url('user/wo/delete_file_ajax') ?>",
            type: "POST",
            data: { id_dt: id_dt, tipe: tipe },
            dataType: "json",
            success: function(res) {
                alert(res.message);
                if (res.status === "success") {
                    wrapper.remove(); 
                }
            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan: " + error);
            }
        });
    }
});
</script>

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