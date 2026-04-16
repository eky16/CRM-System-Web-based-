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
	<div id="wrapper">
		<!-- load sidebar -->
		

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('pengeluaran') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

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
					<div class="card-header"><strong><?= $title ?> - <?= $hd_pr->dibuat ?>, <?= $hd_pr->tgl_dibuat ?></strong>
					      <div class="float-right">
			<!--	<a href="<?= base_url('wo/export_pesanan_permintaan01/'. $hd_pr->id_pengiriman ) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Cetak Pdf </a> -->
					<a href="<?= base_url('wo/selesai') ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;&nbsp;Riwayat Pengiriman </a>
					
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
										<td><?= $hd_pr->kode_pengiriman ?></td>
									</tr>
										<tr>
										<td><strong>No Kendaraan </strong></td>
										<td width="5">:</td>
										<td><?= $hd_pr->no_kendaraan ?></td>
									</tr>
									<tr>
										<td><strong>Tanggal Kirim</strong></td>
										<td>:</td>
										<td><?= $hd_pr->tgl_kiriman ?></td>
									</tr>
									<tr>
										<td><strong>Supir</strong></td>
										<td>:</td>
										<td><?= $hd_pr->nama_supir ?></td>
									</tr>
									<tr>
										<td><strong>Kenek</strong></td>
										<td>:</td>
										<td><?= $hd_pr->nama_kenek ?></td>
									</tr>
								</table></div>
							</div>
							
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											
										
											<td width="100"><strong>Wo</strong></td>
											<td width="200"><strong>Customer</strong></td>
											<td width="250"><strong>Nama Barang</strong></td>
											<td width="80"><strong>Jumlah</strong></td>
											<td width="150"><strong>Warna</strong></td>
											<td width="200"><strong>Catatan pengiriman</strong></td>
											
											<td width="100"><strong>Aksi</strong></td>
											</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($dt_pr as $row): ?>
											<tr>
												
												<td><?= $row->number_po ?></td>
												<td><?= $row->nama_cst ?></td>
												<td><?= $row->detailName ?></td>
												<td align="center"><?= $row->quantity ?>-<?= $row->itemUnitName ?></td>
												<td><?= $row->warna ?></td>
												
												<td><?= $row->catatan_kiriman ?></td>
								
												
												<td><a  data-toggle="modal" style="color:white" data-target="#detail_barang<?php echo $row->id_dt  ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat</a> </td>
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
  <form action="<?= base_url('wo/ubah_proses') ?>" enctype="multipart/form-data"  method="POST" role="form" id="newModalForm"> 

  <div class="modal-body">
   <!-- Content Column -->

   <div class="col-lg-12 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">

        </div>
        <div class="card-body"><?php $Kode_Barang = $row->itemNo; ?>
                <div class="form-group col-md-12">
                <label for="nama_barang"> <span class="badge badge-success">No Permintaan</span></label>
                <input  type="text "  readonly maxlength="50"  name="status_awal" id="status_awal>" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->number_request; ?>"  class="form-control">
            </div>
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
                <input  type="text" maxlength="240" name="warna" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->warna; ?>"  class="form-control" readonly>
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
    <label for="nama_barang"><span class="badge badge-success">Keterangan </span></label>
    <input  type="text" maxlength="240"  name="tgl_perkiraan" placeholder="masukkan qr" autocomplete="off" value="<?php echo $row->tgl_perkiraan; ?>"  class="form-control" readonly>
</div>
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">QR Code </span></label>
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
<?php if ($row->status_qr != 'WH FG') :?>
<div class="form-group col-md-12">
    <input  type="text" maxlength="240"  name="status_qr" placeholder="status_qr" autocomplete="off" value="<?php echo $row->status_qr; ?>"  class="form-control" hidden>

</div> 

<?php endif ;?>
<?php if ($row->status_qr == 'WH FG') :?>
<div class="form-group col-md-12">
    <label for="nama_barang"><span class="badge badge-success">Tanggal Kirim </span></label>
    <input  type="date" maxlength="240"  name="tanggal_kirim" placeholder="tanggal_kirim" autocomplete="off" value="<?php echo $row->tanggal_kirim; ?>"  class="form-control" >

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
										<?php endforeach ?>
									</tbody>
								</table> </div>

							</div>

						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
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
    url:"<?php echo base_url(); ?>wo/delete_detail_pr",
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
          text: "Permintaan Barang akan dilanjutkan, Setujui!",
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
              text: 'Permintaan Barang Disetujui!',
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
   <script>
    document.querySelector('#from2').addEventListener('submit', function(e) {
      var form = this;
      
      e.preventDefault();
      
      swal({
          title: "Are you sure?",
          text: "Data PR akan diubah!",
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
              text: 'PR Detail Berhasil diubah!',
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
</body>
</html>