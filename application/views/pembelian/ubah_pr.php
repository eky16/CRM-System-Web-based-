<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/head.php') ?>
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
        <?php if ($this->session->flashdata('error_stok')) { ?>
<script>
 swal("Gagal!", "Stok Tidak Cukup!", "error");
</script>
     <?php } ?>
        <?php if ($this->session->flashdata('error')) { ?>
<script>
 swal("Gagal!", "Jenis Pembelian Item Tidak Boleh Kosong!", "error");
</script>
     <?php } ?>
        <?php if ($this->session->flashdata('error_update')) { ?>
<script>
 swal("Gagal!", "Harga Tidak Boleh melebihi Sisa Anggaran!", "error");
</script>
     <?php } ?>
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('pembelian') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

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
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"><strong>List Permintaan Barang</strong>
                                <div class="float-right">
                                        


                  <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Data </a> 
                              <!--      <a href="<?= base_url('pembelian/list_permintaan_get?id='.$hd_pr->id.'&no_pr='.$hd_pr->number_pr) ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Ambil Data  </a> -->
                                </div></div>

                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th width="5%"><button type="button"  name="delete_all" id="delete_all" class="btn btn-danger btn-xs"><font size="2px"><i class="fa fa-trash"></i></font></button></th>
                                                    <th width="5">No</th >
                                                    <th width="200" align="center" scope="col" class="column-primary" data-header="Leads">Nama Barang</th >
                                                    <th  align="center" scope="col" width="20">Jumlah</th >
                                                    <th  align="center" scope="col" width="30">Status</th >
                                                    <th  align="center" scope="col" width="100">QRCode</th >
                                                    <th  align="center" scope="col" width="30">File</th >
                                                    <th  align="center" scope="col" width="50">Proses</th >
                                                    <th  align="center" scope="col" width="50">Aksi</th >

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $no = 1;
                                                foreach ($dt_pr_all as $row): ?>
                                                    <tr> <?php $number = $no++; ?>

                                                    <td align="center"><input type="checkbox" class="delete_checkbox_daily" value="<?php echo $row->id_dt ; ?>" /></td>
                                                    <td data-header="No"><?= $number ?></td>
                                                    <td data-header="Kode"><?= $row->detailName ?></td>
                                                    <td data-header="Project"><?= $row->quantity ?>-<?= $row->itemUnitName ?></td>
                                                    <td data-header="Project"><?= $row->status_qr ?></td>
                                                    <td data-header="Project"><?= $row->qr_code ?></td>
                                                    <td data-header="Project">
                                                         <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                                        <?php endif ;?>
                                                    </td>
                                                  <td align="center" >
                                                    <?php  $cek_status = $row->status_proses_pr ?>
                                                    <?php if($cek_status == 3): ?>
                                                        <?= "SELESAI"  ?>
                                                    <?php endif;?>
                                                    <?php if($cek_status == 2): ?>
                                                        <?= "PROSES"  ?>
                                                    <?php endif;?>
                                                    <?php if($cek_status == " "): ?>
                                                        <?= "TIDAK"  ?>
                                                    <?php endif;?>
                                                     <?php if($cek_status == ""): ?>
                                                        <?= "TIDAK"  ?>
                                                    <?php endif;?>
                                                </td>

                                                <td  align="center">
                                             <?php if($cek_status != 3): ?> 
                                                    <a  data-toggle="modal" style="color:white" data-target="#update_nonRAP<?php echo $row->id_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Ubah</a>
                                          <?php endif;?>
      
                                                <?php if($cek_status == 3): ?>  
                                                   <button class="btn btn-success btn-sm" disabled> SELESAI</button>
                                               <?php endif;?>
                                           </td>

                                       </tr>
<!-- modal update System --> 

<div  class="modal modal-right fade" id="update_nonRAP<?php echo $row->id_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"> Update Permintaan Barang <?php echo $row->id_dt; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
      </button>
  </div>
  <form action="<?= base_url('wo/ubah_pr_dt_prosesto_po') ?>" enctype="multipart/form-data"  method="POST" role="form" id="newModalForm"> 
<input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
<input type="text" name="id_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_dt; ?>" hidden>
<input type="text" name="no_po" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request; ?>" hidden>
<input type="text" name="nama_customer" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->customer; ?>" hidden>
                                              <div class="modal-body">
                                               <!-- Content Column -->

                                               <div class="col-lg-12 mb-4">

                                                <!-- Project Card Example -->
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">

                                                    </div>
                                                    <div class="card-body"><?php $Kode_Barang = $row->itemNo; ?>
                                                        <div class="form-group col-md-12" id=customer-<?= $row->id_dt; ?>>
                                                            <label for="nama_barang"><span class="badge badge-success">Customer </span></label>
                                                            <input  type="text" readonly maxlength="240"  name="customer" placeholder="" autocomplete="off" value="<?php echo $row->nama_cst; ?>"  class="form-control" >
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"> <span class="badge badge-success">Kode Barang</span></label>
                                                            <input  type="text "  readonly maxlength="50"  name="itemNo" id="itemNo-<?= $row->id_dt;?>" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->itemNo; ?>"  class="form-control">
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                                                            <input  type="text" maxlength="240"  name="detailName" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName; ?>"  class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Warna </span></label>
                                                            <input  type="text" maxlength="240" name="warna" placeholder="Masukkan warna" autocomplete="off" value="<?php echo $row->warna; ?>"  class="form-control">
                                                        </div>
                                                         <div class="form-group col-md-12">
                                                                <label for="itemUnitName"> <span class="badge badge-success">Satuan </span></label>
                                                                <input type="text" name="itemUnitName" value="<?= $row->itemUnitName ?>"  class=" form-control"  autocomplete="off">
                                                            </div> 
                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"> <span class="badge badge-success">Jumlah Permintaan</span></label>
                                                            <input  type="text "    maxlength="50"  name="quantity" placeholder="Masukkan Nama department" autocomplete="off" value="<?php echo $row->quantity  ; ?>"  class="form-control">
                                                        </div>

 <div class="form-group col-md-12">
    <label for="status_packing"><span class="badge badge-success">Status Packing </span></label>
  
<select name="status_packing" class="form-control">
  <option value="CKD" <?php if (!empty($row->status_packing)) echo $row->status_packing == 'CKD' ? 'selected' : ''; ?>>CKD</option>
  <option value="Built Up" <?php if (!empty($row->status_packing)) echo $row->status_packing == 'Built Up' ? 'selected' : ''; ?>>Built Up</option>
</select>
</div> 

<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Pilih Status Produksi </span></label>

<select name="status_qr" id="combo_status-<?= $row->id_dt; ?>" class="form-control">
  <option value="Stok" <?php if (!empty($row->Stok)) echo $row->Stok == 'Stok' ? 'selected' : ''; ?>>Stok</option>
  <option value="Subcon" <?php if (!empty($row->Subcon)) echo $row->Subcon == 'Subcon' ? 'selected' : ''; ?>>Subcon</option>
  <option value="Forecast" <?php if (!empty($row->status_qr)) echo $row->status_qr == 'Forecast' ? 'selected' : ''; ?>>Forecast</option>
  <option value="Produksi" <?php if (!empty($row->status_qr)) echo $row->status_qr == 'Produksi' ? 'selected' : ''; ?>>Produksi</option>
</select>
</div> 

<div class="form-group col-md-12" id=produksi-<?= $row->id_dt; ?>>
    <label for="line"><span class="badge badge-success">Status Line </span></label>
          
<select name="status_line">
  <option value="Line 1" <?php if (!empty($row->status_line)) echo $row->status_line == 'Line 1' ? 'selected' : ''; ?>>Line 1</option>
  <option value="Line 2" <?php if (!empty($row->status_line)) echo $row->status_line == 'Line 2' ? 'selected' : ''; ?>>Line 2</option>
  <option value="Line 3" <?php if (!empty($row->status_line)) echo $row->status_line == 'Line 3' ? 'selected' : ''; ?>>Line 3</option>
</select>
</div>

   <div class="form-group col-md-12" id=stok-<?= $row->id_dt; ?>>
    <label for="Stok"> <span class="badge badge-info">Stok</span></label>
    <input  type="text "  id="Stok-<?= $row->id_dt;?>"  maxlength="50"  name="Stok" placeholder="Tidak Ada Stok" autocomplete="off" value=""  class="form-control" readonly>
</div> 

<div class="form-group col-md-12" id=blok-<?= $row->id_dt; ?>>
    <label for="Stok"> <span class="badge badge-info">Blok</span></label>
    <input  type="text "  id="Blok-<?= $row->id_dt;?>"  maxlength="50"  name="Blok" placeholder="Blok" autocomplete="off" value=""  class="form-control" readonly>
</div> 

<div class="form-group col-md-12" id=lantai-<?= $row->id_dt; ?>>
    <label for="Stok"> <span class="badge badge-info">Lantai</span></label>
    <input  type="text "  id="Lantai-<?= $row->id_dt;?>"  maxlength="50" name="Lantai" placeholder="Lantai" autocomplete="off" value=""  class="form-control" readonly>
</div> 

<div class="form-group col-md-12" id=baris-<?= $row->id_dt; ?>>
    <label for="Stok"> <span class="badge badge-info">Baris</span></label>
    <input  type="text "  id="Baris-<?= $row->id_dt;?>"  maxlength="50"  name="Baris" placeholder="Baris" autocomplete="off" value=""  class="form-control" readonly>
</div> 


<div class="form-group col-md-12" id=stok_forecast-<?= $row->id_dt; ?>>
    <label for="Stok"> <span class="badge badge-info">Stok Forecast </span></label>
    <input  type="text "  id="Stok_Forecast-<?= $row->id_dt;?>"  maxlength="50"  name="Stok_Forecast" placeholder="Tidak Ada Stok" autocomplete="off" value="0"  class="form-control" readonly>
</div> 
<div class="form-group col-md-12" id=line_forecast-<?= $row->id_dt; ?>>
    <label for="Stok"> <span class="badge badge-info">Line</span></label>
    <input  type="text "  id="Line_Forecast-<?= $row->id_dt;?>"  maxlength="50"  name="status_line" placeholder="Tidak Ada Data" autocomplete="off" value=""  class="form-control" >
</div> 
<div class="form-group col-md-12" id=Qr_Code-<?= $row->id_dt; ?>>
    <label for="Stok"> <span class="badge badge-info">Qr Code</span></label>
    <input  type="text "  id="qr_code-<?= $row->id_dt;?>"  maxlength="50"  name="qr_code" placeholder="Tidak Ada Data" autocomplete="off" value=""  class="form-control" >
</div>
<div class="form-group col-md-12" id=NO_WO-<?= $row->id_dt; ?>>
    <label for="Stok"> <span class="badge badge-info">No.WO</span></label>
    <input  type="text "  id="no_wo-<?= $row->id_dt;?>"  maxlength="50"  name="" placeholder="Tidak Ada Data" autocomplete="off" value=""  class="form-control" >
</div>
<div class="form-group col-md-12" id="Tgl_Produksi-<?= $row->id_dt; ?>">
    <label for="Stok"> <span class="badge badge-info">Tgl Produksi</span></label>
    <input type="text" id="tgl_produksi-<?= $row->id_dt; ?>" name="" placeholder="Tidak Ada Data" autocomplete="off" value="" class="form-control">
</div>
<div class="form-group col-md-12" id=id_barang_forecast-<?= $row->id_dt; ?>>
  
    <input  type="text "  id="id_Barang_forecast-<?= $row->id_dt;?>"  maxlength="50"  name="id_barang_forecast" placeholder="Tidak Ada Data" autocomplete="off" value=""  class="form-control" hidden>
</div> 




<script>
    //jika status yang di pilih adalah stok maka tampilkan kolom stok
  $(document).ready(function() {
    $("select[id=combo_status-<?= $row->id_dt; ?>]").on("change", function() {
      const selectedValue = $(this).val();
      const stokDiv = $("div[id=stok-<?= $row->id_dt; ?>]");
      const stokDiv1 = $("div[id=blok-<?= $row->id_dt; ?>]");
      const stokDiv2 = $("div[id=lantai-<?= $row->id_dt; ?>]");
      const stokDiv3 = $("div[id=baris-<?= $row->id_dt; ?>]");

      if (selectedValue === "Stok") { 
        stokDiv.show().find('input, textarea').prop('readonly', true).prop('disabled', false);
        stokDiv1.show().find('input, textarea').prop('readonly', true).prop('disabled', false);
        stokDiv2.show().find('input, textarea').prop('readonly', true).prop('disabled', false);
        stokDiv3.show().find('input, textarea').prop('readonly', true).prop('disabled', false);
      } else {
        stokDiv.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
        stokDiv1.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
        stokDiv2.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
        stokDiv3.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
      }
    });

    $("select[id=combo_status-<?= $row->id_dt; ?>]").trigger("change");
  });
</script>
<script>
    //jika status yang di pilih adalah status Forecast dan customer bukan Forecast maka tampilkan stok forecast, status line dan id barang dan qrcode, NO.WO, tgl produksi
  $(document).ready(function() {
    $("select[id=combo_status-<?= $row->id_dt; ?>]").on("change", function() {
      const selectedValue = $(this).val();
      const customer = '<?= $row->nama_cst; ?>';
      const stokDiv = $("div[id=stok_forecast-<?= $row->id_dt; ?>]");
      const stokDiv1 = $("div[id=line_forecast-<?= $row->id_dt; ?>]");
      const stokDiv2 = $("div[id=id_barang_forecast-<?= $row->id_dt; ?>]");
      const stokDiv3 = $("div[id=Qr_Code-<?= $row->id_dt; ?>]");
      const stokDiv4 = $("div[id=Tgl_Produksi-<?= $row->id_dt; ?>]");
      const stokDiv5 = $("div[id=NO_WO-<?= $row->id_dt; ?>]");

      if (selectedValue === "Forecast" && customer !== "Forecast") {
        stokDiv.show().find('input, textarea').prop('readonly', true).prop('disabled', false);
        stokDiv1.show().find('input, textarea').prop('readonly', false).prop('disabled', false);
        stokDiv2.show().find('input, textarea').prop('readonly', true).prop('disabled', false);
        stokDiv3.show().find('input, textarea').prop('readonly', false).prop('disabled', false);
        stokDiv4.show().find('input, textarea').prop('readonly', false).prop('disabled', true);
        stokDiv5.show().find('input, textarea').prop('readonly', false).prop('disabled', true);

      } else {
        stokDiv.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
        stokDiv1.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
        stokDiv2.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
        stokDiv3.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
        stokDiv4.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
        stokDiv5.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);

      }
    });

    $("select[id=combo_status-<?= $row->id_dt; ?>]").trigger("change");
  });
</script>
<script>
    //jika status yang di pilih adalah produksi atau status forecast dan customer adalah forecast maka tampilkan kolom status line untuk di pilih
  $(document).ready(function() {
    $("select[id=combo_status-<?= $row->id_dt; ?>]").on("change", function() {
      const selectedValue = $(this).val();
      const customer = '<?= $row->nama_cst; ?>';
      const stokDiv = $("div[id=produksi-<?= $row->id_dt; ?>]");
     

      if ((selectedValue === "Produksi" ) || (selectedValue === "Forecast" && customer === "Forecast")) {
        stokDiv.show().find('input, textarea').prop('readonly', true).prop('disabled', false);
       
      } else {
        stokDiv.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
      
      }
    });

    $("select[id=combo_status-<?= $row->id_dt; ?>]").trigger("change");
  });
</script>
<script>
    //jika status yang di pilih adalah produksi atau status forecast dan customer adalah forecast maka tampilkan kolom qr code untuk di input
  $(document).ready(function() {
    $("select[id=combo_status-<?= $row->id_dt; ?>]").on("change", function() {
      const selectedValue = $(this).val();
      const customer = '<?= $row->nama_cst; ?>';
      const stokDiv = $("div[id=qr_st_prod-<?= $row->id_dt; ?>]");
     

      if ((selectedValue === "Produksi" || selectedValue === "Stok" || selectedValue === "Subcon") || (selectedValue === "Forecast" && customer === "Forecast")) {
        stokDiv.show().find('input, textarea').prop('readonly', false).prop('disabled', false);
       
      } else {
        stokDiv.hide().find('input, textarea').prop('readonly', true).prop('disabled', true);
      
      }
    });

    $("select[id=combo_status-<?= $row->id_dt; ?>]").trigger("change");
  });
</script>
      <script type="text/javascript">
        tampil_data(); 
        function tampil_data(){

           var id = "<?= $row->itemNo;?>";
           $.ajax({
            url : "<?php echo site_url('wo/get_stok_barang_forecast');?>",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                        $('#Stok_Forecast-<?= $row->id_dt;?>').val(data.quantity)
                        $('#Line_Forecast-<?= $row->id_dt;?>').val(data.status_line)
                        $('#id_Barang_forecast-<?= $row->id_dt;?>').val(data.id_dt)
                        $('#qr_code-<?= $row->id_dt;?>').val(data.qr_code)
                        $('#tgl_produksi-<?= $row->id_dt;?>').val(data.tgl_produksi)
                        $('#tgl_produksi2-<?= $row->id_dt;?>').val(data.tgl_produksi)
                        $('#no_wo-<?= $row->id_dt;?>').val(data.no_wo)
                        $('#no_wo2-<?= $row->id_dt;?>').val(data.no_wo)

                        }
               });
       }

   </script>
      <script type="text/javascript">
        tampil_data(); 
        function tampil_data(){

           var id = "<?= $row->itemNo;?>";
           $.ajax({
            url : "<?php echo site_url('wo/get_stok_barang');?>",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){
                        $('#Stok-<?= $row->id_dt;?>').val(data.Stok)
                        $('#Blok-<?= $row->id_dt;?>').val(data.Blok)
                        $('#Lantai-<?= $row->id_dt;?>').val(data.Lantai)
                        $('#Baris-<?= $row->id_dt;?>').val(data.Baris)
                        }
               });
       }

   </script>
                                                         <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Keterangan </span></label>
                                                            <textarea   name="detailNotes" placeholder="Keterangan" autocomplete="off"  class="form-control"><?php echo $row->detailNotes; ?></textarea>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">No. WO </span></label>
                                                            <textarea   name="no_wo" id="no_wo2-<?= $row->id_dt;?>" placeholder="No.WO" autocomplete="off"  class="form-control"><?php echo $row->no_wo; ?></textarea>
                                                        </div>
                                                        <div class="form-group col-md-12" id=qr_st_prod-<?= $row->id_dt; ?>>
                                                            <label for="nama_barang"><span class="badge badge-success">QR Code </span></label>
                                                            <textarea  type="text" maxlength="240"  name="qr_code" placeholder="masukkan qr" autocomplete="off" value="<?php echo $row->qr_code; ?>"  class="form-control">
                                                             </textarea>
                                                        </div> 
                                                         <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Gambar Kerja </span></label>
                                                            <?php if (!empty($row->gambar_kerja)):?><a target="_blank" href="<?php echo base_url(); ?>img/uploads/gambar_kerja/<?= $row->gambar_kerja ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat</span></a>
                                                        <?php endif ;?>
                                                            <input  type="file" maxlength="240"  name="gambar_kerja" placeholder="Upload File" autocomplete="off" value="<?php echo $row->gambar_kerja; ?>"  class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Tanggal Kirim</span></label>
                                                            <input  type="date" maxlength="240"  name="tanggal_kirim" placeholder="masukkan qr" autocomplete="off" value="<?php echo $row->tanggal_kirim; ?>"  class="form-control">
                                                          </div>
                                                         <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Selesai Produksi </span></label>
                                                            <input  type="date" maxlength="240"  name="tgl_perkiraan" placeholder="masukkan qr" autocomplete="off" value="<?php echo $row->tgl_perkiraan; ?>"  class="form-control">

                                                        </div> 

                                                      
                                                        <div class="form-group col-md-12">
                                                            <label for="nama_barang"><span class="badge badge-success">Rencana Produksi </span></label>
                                                            <input  type="date" maxlength="240"  name="tgl_produksi" id="tgl_produksi2-<?= $row->id_dt;?>"placeholder="masukkan qr" autocomplete="off" value="<?php echo $row->tgl_produksi; ?>"  class="form-control">

                                                        </div>
                                                        

                                                        
                                                            

<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Status Prosess </span></label>

                         <select name="status_proses_pr" class="form-control" >
                            <option value=" " <?php
                            if (!empty($row->status_proses_pr)) {
                                echo $row->status_proses_pr == '' ? 'selected' : '';
                            }
                            ?>>TIDAK</option>
                            <option value="2" <?php 
                            if (!empty($row->status_proses_pr)) {
                                echo $row->status_proses_pr == '2' ? 'selected' : '';
                            }
                            ?>>YA</option>
                            </select>
</div>


<input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

<input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
echo date('Y-m-d H:i:s');
?>"  class="form-control" hidden>

<hr>

<div class="form-group col-12">
<?php if ($row->status_proses_pr != 2) : ?>
  <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
<?php endif;?>
<?php if ($row->status_proses_pr == 2 AND $row->status_qr != 'Stok') : ?>
  <button type="submit"  class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
<?php endif;?>
<?php if ($row->status_proses_pr == 2 AND $row->status_qr == 'Stok') : ?>
  <button type="submit" disabled class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Sudah Diproses </button>
<?php endif;?>
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
<?php endforeach ?>

</script>
</tbody>

</table>
</div>
<!-- modal tambah item -->
<div  class="modal modal-right fade" id="right_modalupdate" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title"> Tambah Permintaan Barang </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> 
      </button>
  </div>
  <form action="<?= base_url('wo/tambah_item_new_po') ?>" enctype="multipart/form-data" id="from2" method="POST">
      <div class="modal-body">
        

         <div class="col-lg-12 mb-4">

           
            <div class="card shadow mb-4">
                <div class="card-header py-3">

                </div>
                <div class="card-body">

                    <div class="form-group col-md-12">
                        <label for="nama_barang"><span class="badge badge-success">Nama Barang </span></label>
                        <input type="text" name="detailName" maxlength="240" id="nama_barang2" class=" form-control" list="nama_barang1" autocomplete="off">
                        <datalist id="nama_barang1">
                            <option value="">Pilih Barang</option>
                            <?php foreach ($all_barang as $barang): ?>
                                <option value="<?= $barang->Nama_Barang ?>"></option>
                            <?php endforeach ?>
                        </datalist>
                    </div>
                    <input type="text" name="kd_cst"  autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->kd_cst; ?>" hidden>
                    <div class="form-group col-md-12">
                        <label for="nama_barang"> <span class="badge badge-success">Kode Barang</span></label>
                        <input  type="text "  readonly maxlength="50"  id="itemNo" name="itemNo" placeholder="Kode Barang" autocomplete="off" value=""  class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="nama_barang"> <span class="badge badge-success">Jumlah</span></label>
                        <input  type="text " readonly   maxlength="50"  name="quantity" placeholder="Masukkan Jumlah Barang" autocomplete="off" value=""  class="form-control">
                        </div> 
                        <div class="form-group col-md-12">
                            <label for="nama_barang"> <span class="badge badge-success">Satuan</span></label>
                            <input type="text" name="itemUnitName" readonly  id="sub_category" class=" form-control" list="category3" autocomplete="off" >
                            <datalist id="category3">
                                <option value="">No Selected</option>
                                <?php foreach ($satuan as $row): ?>
                                    <option value="<?= $row->nm_satuan ?>"></option>
                                <?php endforeach ?>
                            </datalist>
                        </div> 

    <script>
        $(document).ready(function(){
            $('tfoot').hide()

            $(document).keypress(function(event){
                if (event.which == '13') {
                    event.preventDefault();
                }
            })

            $('#nama_barang2').on('change', function(){

                if($(this).val() == '') reset()
                else { 
                    //const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
                    //var url_get_all_barang = '<?php echo base_url()?>pembelian/get_all_barang',
                    $.ajax({
                        url: '<?php echo base_url()?>pembelian/get_all_barang',
                        type: 'POST',
                        dataType: 'json',
                        data: {Nama_Barang: $(this).val()},
                        success: function(data){
                            $('input[name="itemNo"]').val(data.Kode_Barang)
                            $('input[name="quantity"]').val(1)
                            //$('input[name="proyek"]').val(1)
                            $('input[name="itemUnitName"]').val(data.Satuan)
                            //$('input[name="max_hidden"]').val(data.stok)
                            $('input[name="quantity"]').prop('readonly', false)
                            $('input[name="itemUnitName"]').prop('readonly', false)
                            $('button#tambah').prop('disabled', false)

                            $('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
                            
                            $('input[name="jumlah"]').on('keydown keyup change blur', function(){
                                $('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
                            })
                        }
                    })
                }
            })
        })
    </script>
                    <div class="form-group col-md-12">
                        <label for="nama_barang"><span class="badge badge-success">Warna Barang </span></label>
                        <input  type="text" maxlength="240"  name="warna" placeholder="Warna Barang" autocomplete="off" value="" list="warna_barang" autocomplete="off"  class="form-control">
                    <datalist id="warna_barang" >
                        <option value="">No Selected</option>
                          <?php foreach ($warna as $row): ?>
                        <option value="<?= $row->nama_warna ?>"></option>
                    <?php endforeach ?>
                    </datalist>
                    
                    

                    </div>
                    <div class="form-group col-md-12">
                        <label for="nama_barang"><span class="badge badge-success">Keterangan </span></label>
                        <textarea   name="detailNotes" placeholder="detailNotes" autocomplete="off"  class="form-control"></textarea>
                    </div>
                    <input  type="text" maxlength="240"  name="status_proses_pr" placeholder="Warna Barang" autocomplete="off" value=" "  autocomplete="off"  class="form-control" hidden>

                    <input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->id;?>" hidden>
                    <input type="text" name="id_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_pr;?>" hidden>

                    <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                    <input type="text" id="datepicker" name="timeupdate_pay" value="<?php date_default_timezone_set('Asia/Jakarta');
                    echo date('Y-m-d H:i:s');
                ?>"  class="form-control" hidden>

                <hr>

                <div class="form-group col-12">

                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
 
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
<!-- end modal tambah item -->
</div>
</div>
</div></br>
<div class="col-lg-6 mb-4">
  <form action="<?= base_url('wo/save_pr_sattle') ?>" id="form" method="POST" enctype="multipart/form-data" name="formcek2">
    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Alba Unggul</h6>
        </div>
        <div class="card-body">
            <div class="form-group col-12">
                <input type="text" readonly name="id" value="<?= $hd_pr->id ?>"  class="form-control" hidden>
                <label>Tanggal Permintaan</label>
                <input type="date"  name="transDate" value="<?= $hd_pr->transDate ?>"  readonly class="form-control">
            </div>
            <div class="form-group col-12">
                <label>ID</label>
                <input type="text" readonly name="number_pr" value="<?= $hd_pr->number_pr ?>"  class="form-control">
            </div>

            <div class="form-group col-12">
                <label>Customer</label>
                <input type="text" readonly name="" value="<?= $hd_pr->customer ?>"  class="form-control">
                <input type="text" readonly hidden name="kd_cst" value="<?= $hd_pr->kd_cst ?>"  class="form-control">
            </div>
            <div class="form-group col-12">
                <label>Sales</label>
                <input type="text" readonly name="" value="<?= $hd_pr->sales ?>"  class="form-control">
                <input type="text" readonly  name="kd_sales" value="<?= $hd_pr->kd_sales ?>"  class="form-control" hidden>
            </div>



    </div>
</div>
</div> <!-- Panel 1 System -->

<?php $txt = sprintf("%04s", $generate_kode_wo);
//$kodeTransaksi_po = 'PO.'.date('Y').'.'.date('m').'.'.$txt;
$kodeTransaksi_csa = 'PP'.'/'.date('Y').'/'.date('m').'/'.$txt;
?>
<?php $txt = sprintf("%04s", $generate_kode_stok);
//$kodeTransaksi_po = 'PO.'.date('Y').'.'.date('m').'.'.$txt;
$kodeTransaksi_stok = 'S'.'/'.date('Y').'/'.date('m').'/'.$txt;
?>
<div class="col-lg-6 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Alba Unggul</h6>
        </div>
        <div class="card-body">

            <div class="form-group col-12" >
                <label>No. Permintaan</label>  
                <input type="text"   name="no_permintaan" readonly value="<?= $hd_pr->no_permintaan ?>"  class="form-control">
            </div>
            <div class="form-group col-12">
                <label>Tanggal</label>
                <input type="date" name="transDate" value="<?= date('Y-m-d')?>"  class="form-control">
            </div>
            <div class="form-group col-12">
                <label>Nomor Proses</label>
                <select id="combo_jenis" name="jenis_pembayaran" class="form-control" required>

                    <option value="WO">WO</option>
                    <option value="Stok">Stok</option>
                 <!--  <option value="SPK CSA">SPK CSA</option>
                    <option value="SPK MSA">SPK MSA</option> -->
                </select>
            </div>
            <div class="form-group col-12" id=wo>
                <label>No. Proses</label>  
                <input type="text"   name="number_" value="<?= $kodeTransaksi_csa ?>"  class="form-control">
                <!--    <input type="text" readonly  name="typeAutoNumber" value="16"  class="form-control" hidden> -->
            </div>
            <div class="form-group col-12" id=stok>
                <label>No. Stok</label>  
                <input type="text"   name="number_" value="<?= $kodeTransaksi_stok ?>"  class="form-control">
                <!--    <input type="text" readonly  name="typeAutoNumber" value="16"  class="form-control" hidden> -->
            </div>
<script>
    $(document).ready(function(){ 

      $("select[id=combo_jenis]").on("change", function() { 
        if ($(this).val() === "WO") { 
            $("div[id=wo]").show().find('input, textarea').prop('disabled', false);
            $("div[id=stok]").hide().find('input, textarea').prop('disabled', true);
        } 
        if ( $(this).val() === "Stok") { 
            $("div[id=wo]").hide().find('input, textarea').prop('disabled', true);
            $("div[id=stok]").show().find('input, textarea').prop('disabled', false);
        } 
    }); 
      $("select[id=combo_jenis]").trigger("change");


  });
</script> 

</div>
</div>
                        
<?php foreach ( $dt_pr as $row): ?>
   <input type="text" readonly  name="detailName[]" value="<?= $row->detailName ?>"  class="form-control" hidden>
   <?php $kode_barang =  $row->itemNo ?>    
   <input type="text" readonly  name="itemNo[]" value="<?= $kode_barang ?>"  class="form-control" hidden>
   <input type="text" onkeypress="return hanyaAngka(event)" name="quantity[]" value="<?= $row->quantity ?>"  class="form-control" hidden>
   <input type="text" name="itemUnitName[]" value="<?= $row->itemUnitName ?>" class=" form-control" hidden>
   <input type="text" placeholder="warna" name="warna[]" value="<?= $row->warna ?>"  class="form-control" hidden>
   <input type="text"  placeholder="Harga satuan" name="status_proses_pr[]" value="3"  class="form-control" hidden>
   <input type="text"  name="detailNotes[]" value="<?= $row->detailNotes ?>"  class="form-control" hidden>
   <input type="text"  name="id_dt[]" value="<?= $row->id_dt ?>"  class="form-control" hidden>
   <input type="text"  placeholder="Gambar Kerja" name="gambar_kerja[]" value="<?= $row->gambar_kerja ?>"  class="form-control" hidden>
    <input type="text"  placeholder="qr_code" name="qr_code[]" value="<?= $row->qr_code ?>"  class="form-control" hidden>
<?php endforeach ?>                     
</div> <!-- Panel 2 System -->



<hr>
<div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-body">

            <?php if(!empty($dt_pr)):?>


                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Kosongkan Inputan</button>
            <?php else:?>
               <button type="submit" disabled class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Tidak ada data yang perlu di proses</button>

           <?php endif;?>

       </div>
   </div>
</div> <!-- Panel 1 System -->
</div>
</div>  </form> 
<!-- load footer -->
<?php $this->load->view('partials/footer.php') ?>
</div>
</div>
<script>


    document.querySelector('#form').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();



      swal({
          title: "Sudah Yakin ?",
          text: "Data Akan Disimpan!",
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
              text: 'Data Berhasil Disimpan!',
              icon: 'success'
          }).then(function() {
              form.submit();
          });
      } else {
        swal("Cancelled", "Data tidak ada perubahan :)", "error");
    }
})
  
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

<script> 
    function validateForm2() {

        if (document.forms["formcek2"]["pemasok"].value == "") {
            alert("Pemasok Tidak Boleh Kosong");
            document.forms["formcek2"]["pemasok"].focus();
            return false;
        }
        if (document.forms["formcek2"]["departmentName"].value == "") {
            alert("Department Tidak Boleh Kosong");
            document.forms["formcek2"]["departmentName"].focus();
            return false;
        }
        if (document.forms["formcek2"]["branchName"].value == "") {
            alert("Cabang Tidak Boleh Kosong");
            document.forms["formcek2"]["branchName"].focus();
            return false;
        }

    }
</script>
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
                url:"<?php echo base_url(); ?>pembelian/delete_detail_pr",
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


<?php $this->load->view('partials/js.php') ?>

</body>
</html>