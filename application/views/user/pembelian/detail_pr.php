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
					<div class="card-header"><strong><?= $title ?> - <?= $hd_pr->created_po ?>, <?= $hd_pr->createdtime_po ?></strong>
					      <div class="float-right">
				<a href="<?= base_url('user/wo/export_pesanan_permintaan01/'. $hd_pr->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Cetak Pdf </a>
				
					<a href="<?= base_url('user/wo/list_permintaan') ?>" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;&nbsp;List Permintaan </a>

					<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
					<a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $hd_pr->id ; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ganti Customer</a> 
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
										<td><?= $hd_pr->number_pr ?></td>
									</tr>
										<tr>
										<td><strong>No Pesanan </strong></td>
										<td width="5">:</td>
										<td><?= $hd_pr->no_permintaan ?></td>
									</tr>
									<tr>
										<td><strong>Tanggal</strong></td>
										<td>:</td>
										<td><?= $hd_pr->transDate ?></td>
									</tr>
									<tr>
										<td><strong>Customer</strong></td>
										<td>:</td>
										<td><?= $hd_pr->customer ?></td>
									</tr>
									<tr>
										<td><strong>Sales</strong></td>
										<td>:</td>
										<td><?= $hd_pr->sales ?></td>
									</tr>
									<tr>
										<td><strong>Status</strong></td>
										<td>:</td>
										<td>     <?php $status_pr = $hd_pr->status_po  ?>
                                            <?php if ($status_pr == 1):?>
                                              <span class="badge badge-warning">Menunggu Proses PPIC</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 2):?>
                                            <span class="badge badge-info">PROSES </span>
                                            <?php endif;?>
                                          
                                            <?php if ($status_pr == "Selesai"):?>
                                              <span  class="badge badge-success">PR Selesai Diproses </span>
                                            <?php endif;?></td>

									</tr>
									<?php if (!empty($hd_pr->vendorNo)):?>
									<tr>
										<td><strong>Pemasok</strong></td>
										<td>:</td>
										<td><?= $hd_pr->vendorNo ?></td>
									</tr><?php endif ;?>
								</table></div>
							</div>
							
							<div class="col-md-7">
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
									<?php foreach ($his_pr as $row): ?>
											<tr>
												<td><font size="2"><?= $row->actiontime ?></font></td>
												<td><font size="2"><?= $row->status ?></font> </td>
												<td><font size="2"><?= $row->action_by ?></font> </td>
											</tr>
									<?php endforeach ?>
									</tbody>
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
											
										
											<td width="90"><strong>No WO</strong></td>
											<td width="10"><strong>Id</strong></td>
											<td width="350"><strong>Nama Barang</strong></td>
											<td width="80"><strong>Jumlah</strong></td>
											<td width="200"><strong>QrCode</strong></td>
											<td width="150"><strong>Status</strong></td>
											<td width="150"><strong>Pack</strong></td>
											<td width="200"><strong>Keterangan</strong></td>
											<!--
											<td width="150"><strong>Harga</strong></td>
								
											<td width="150"><strong>Total Harga</strong></td> -->
											
											<td width="100"><strong>Aksi</strong></td>
											</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($dt_pr as $row): ?>
											<tr>
												
												
													<td>
														<?php if($row->status_proses_pr != " "):?>
													<?= $row->no_wo ?>
													<?php endif;?>
														
													</td>

												<td><?= $row->id_dt ?></td>
												<td><?= $row->detailName ?></td>
												<td align="center"><?= $row->quantity ?>-<?= $row->itemUnitName ?></td>
												<td><?= $row->qr_code ?></td>
												
												<td align="center">  <?php $status_pr = $row->status_qr  ?>
												<?php if ($status_pr == "Subcon" and $row->number_po != ""):?>
													<span class="badge badge-primary"> Subcon </span>
												<?php endif;?>
												<?php if ($status_pr == "Stok" and $row->number_po != ""):?>
													<span class="badge badge-primary"> Stok </span>
												<?php endif;?>
												<?php if ($status_pr == "Forecast" and $row->number_po != ""):?>
													<span class="badge badge-primary"> Forecast </span>
												<?php endif;?>
												<?php if ($status_pr == "Produksi" and $row->number_po != ""):?>
													<span class="badge badge-warning"> Menunggu Produksi </span>
												<?php endif;?>
												<?php if ($status_pr == "Cutting"):?>
													<span class="badge badge-info"> CUTTING </span>
												<?php endif;?>
												<?php if ($status_pr == "Punching"):?>
													<span class="badge badge-info">PUNCHING </span>
												<?php endif;?>
												<?php if ($status_pr == "Bending"):?>
													<span class="badge badge-info">BENDING </span>
												<?php endif;?>
												<?php if ($status_pr == "Welding"):?>
													<span class="badge badge-info">WELDING </span>
												<?php endif;?>
												<?php if ($status_pr == "PS"):?>
													<span class="badge badge-info">PS </span>
												<?php endif;?>
												<?php if ($status_pr == "FA"):?>
													<span class="badge badge-info">FA </span>
												<?php endif;?>
												<?php if ($status_pr == "Packing"):?>
													<span class="badge badge-info">PACKING </span>
													<?php endif;?>
													<?php if ($status_pr == "WH FG"):?>
													<span class="badge badge-primary">WH FG </span>
													<?php endif;?>
													<?php if ($status_pr == "Selesai"):?>
													<span class="badge badge-success">SELESAI </span>
													<?php endif;?>
													<?php if ($status_pr == "Batal"):?>
													<span class="badge badge-dark">BATAL </span>
													<?php endif;?>

													<!-- jika barang Ready DAN tanggal kirim kosong tampilkan status Ready -->
													<?php if ($status_pr == "Ready" and $row->tanggal_kirim == ""):?>
													<span class="badge badge-primary">Ready </span>
													<?php endif;?> 
													<!-- jika barang Ready DAN tanggal kirim tidak kosong tampilkan status Siap Dikirim -->
													<?php if ($status_pr == "Ready" and $row->tanggal_kirim != ""):?>
													<span class="badge badge-primary">Siap Dikirim </span>
													<?php endif;?>  


												</td>
												<td><?= $row->status_packing ?></td>
												<td><?= $row->detailNotes ?></td>
								
											<!--	<td>
													<?php if(!empty($row->unitPrice)):?>
													<?php
                                                 $hasil_rupiah = "Rp " . number_format($row->unitPrice,0,',','.');
                                                  echo $hasil_rupiah; ?> <?php endif;?>
												</td>
												<td><?= $row->itemDiscPercent ?></td> 
												<td> 
													<?php if(!empty($row->unitPrice)):?>
													<?php 
													
													if (!empty($row->itemDiscPercent)) {
														$disc = $row->itemDiscPercent;
													}else{
														$disc = 0;
													}
												$harga = $row->unitPrice * $row->quantity;
												
												$hasilnya_disc = $harga * $disc / 100 ;
												$total_harga = $harga - $hasilnya_disc;
												
												$hasil_rupiah = "Rp " . number_format($total_harga,0,',','.');
                                                  echo $hasil_rupiah;
												?><?php endif;?>
													
												</td>-->
												
												<td><a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $row->id_dt ; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Lihat</a> </td>
											</tr>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $row->id_dt; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Barang <?php echo $row->id_dt; ?></h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/wo/ubah_pr_dt') ?>" enctype="multipart/form-data" id="from2" method="POST">
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
                                             <input  type="text" maxlength="50"  name="detailName" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $row->detailName; ?>" class="form-control">
                                </div>

                            <div class="form-group col-md-12">
                              	<label for="nama_barang"><span class="badge badge-success">Customer </span></label>
                   
                              	<select name="kd_cst" class="form-control" >                             
                              		<?php foreach ($customer as $cst) : ?>
                              			<option value="<?php echo $cst->kode_cst; ?>" 
                              				<?php
                              				if (!empty($hd_pr->kd_cst)) {
                              					echo $cst->kode_cst == $hd_pr->kd_cst ? 'selected' : '';
                              				}
                              			?>><?php echo $cst->nama_cst ?></option>                            
                              		<?php endforeach; ?>
                              	</select>
                              </div>     

                             <?php
                                             $cek_jabatan = trim($emp->divisi . ' ' . $emp->department);

                                             if ($cek_jabatan =='Staff Marketing' || 'Staff PPIC' || 'Manager Produksi') {
                                                 $readonlyAttribute = ($cek_jabatan == 'Manager Produksi') ? 'readonly' : '';
                                                 ?>
                            <div class="form-group col-md-12">
                                <label for="nama_barang"><span class="badge badge-success">Warna </span></label>
                                   <input  type="text" maxlength="50"  name="warna" placeholder="Warna" autocomplete="off" value="<?php echo $row->warna; ?>"  class="form-control" value="<?= $row->warna ?>" <?= $readonlyAttribute ?>>
                            </div>
                                <?php
                                             }
                                             ?>


                                    <?php
                                             $cek_jabatan = trim($emp->divisi . ' ' . $emp->department);

                                             if ($cek_jabatan =='Staff Marketing' || 'Staff PPIC' || 'Manager Produksi') {
                                                 $readonlyAttribute = ($cek_jabatan == 'Manager Produksi') ? 'readonly' : '';
                                                 ?>                                   
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Jumlah</span></label>
                                             <input  type="number" maxlength="50"  name="quantity" placeholder="Masukkan Jumlah" autocomplete="off" value="<?php echo $row->quantity; ?>"  class="form-control" value="<?= $row->quantity ?>" <?= $readonlyAttribute ?>>
                                </div>
                                <?php
                                             }
                                             ?>            

                                <div class="form-group col-md-12">
                                    <label for="nama_barang"><span class="badge badge-success">Pack</span></label>
                                    <input class="form-control" name="status_packing" value="<?php echo $row->status_packing; ?>" readonly>
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Keterangan</span></label>
                                            <textarea class="form-control" name="detailNotes"><?php echo $row->detailNotes; ?></textarea>
                                  
                                </div> 


                               <input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_hd; ?>" hidden>
                               <input type="text" name="id_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->id_dt; ?>" hidden>
                               <input type="text" name="no_po" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $row->number_request; ?>" hidden>

                                        <hr>

      									 <div class="form-group col-12">
                         <?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT' OR $this->session->login['department'] == 'Marketing'):?>
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
								</table> </div>

							</div>
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $hd_pr->id; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-small" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ganti Customer / Sales </h5> 
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/wo/ubah_pr_customer') ?>" enctype="multipart/form-data" id="from2" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  
                                </div>
                                <div class="card-body">
                             <div class="form-group col-md-12">
                               <label for="nama_barang"><span class="badge badge-success">ID </span></label>
                                             <input  type="text" maxlength="50" readonly name="" placeholder="Nomor Permintaan" autocomplete="off" value="<?php echo $hd_pr->number_pr; ?>"  class="form-control">
                              </div>   
                              <div class="form-group col-md-12">
                              	<label for="nama_barang"><span class="badge badge-success">Customer </span></label>
                   
                              	<select name="kd_cst" class="form-control" >                             
                              		<?php foreach ($customer as $cst) : ?>
                              			<option value="<?php echo $cst->kode_cst; ?>" 
                              				<?php
                              				if (!empty($hd_pr->kd_cst)) {
                              					echo $cst->kode_cst == $hd_pr->kd_cst ? 'selected' : '';
                              				}
                              			?>><?php echo $cst->nama_cst ?></option>                            
                              		<?php endforeach; ?>
                              	</select>
                              </div>                     
                              <div class="form-group col-md-12">
                              	<label for="nama_barang"><span class="badge badge-success">Sales </span></label>
                              	<select name="kd_sales" class="form-control" >                             
                             		<?php foreach ($sls as $sales) : ?>
                              			<option value="<?php echo $sales->kode_sales; ?>" 
                              				<?php
                              				if (!empty($hd_pr->kd_sales)) {
                              					echo $sales->kode_sales == $hd_pr->kd_sales ? 'selected' : '';
                              				}
                              			?>><?php echo $sales->nama_sales ?></option>                            
                              		<?php endforeach; ?>
                              	</select>
                              </div> 

                               <input type="text" name="id_header" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->id; ?>" hidden>
                               <input type="text" name="id_dt" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_pr; ?>" hidden>
                               <input type="text" name="no_pr" placeholder="Id HD" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_pr; ?>" hidden>

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
</div>
</div>
<div class="form-group col-12">
	 <div class="bg-light text-right"> 
<form action="<?= base_url('user/wo/proses_approve_pr') ?>" enctype="multipart/form-data" id="from1" method="POST">

	<input type="text" name="id" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->id; ?>" hidden>
	<input type="text" name="number_" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_; ?>" hidden>
	<input type="text" name="number_pr" placeholder="" autocomplete="off"  class="form-control"  value="<?php echo $hd_pr->number_pr; ?>" hidden>


	<?php  	$cek_jabatan 	= $emp->divisi.' '.$emp->department;
			$cek_status_pr 	= $hd_pr->status_po; ?>

	<?php if ($cek_jabatan == 'Staff PPIC' || $cek_jabatan == 'Staff IT'): ?>
  <?php if ($cek_status_pr == 1): ?>
    <input type="text" name="status_po" placeholder="" autocomplete="off" class="form-control" value="2" hidden>
    <input type="text" name="status" placeholder="" autocomplete="off" class="form-control" value="Menyetujui Permintaan Barang" hidden>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Setujui</button>
  <?php elseif ($cek_status_pr == 2): ?>
    <a onclick="return confirm('Lanjut ?')" href="<?= base_url('user/wo/kelengkapan_pr/' . $hd_pr->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Lengkapi Data</a>
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
    url:"<?php echo base_url(); ?>user/wo/delete_detail_pr",
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