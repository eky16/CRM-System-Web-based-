<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"><strong>Filter Tanggal Pembayaran</strong></div>
                            <div class="card-body">
                                <form action="" id="form-tambah" method="POST">
                                    <div class="form-row">
    <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>
                                        <div class="form-group col-md-3">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd"  name="tanggal" value="<?php echo $_POST['tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="department"><strong>Pilih</strong></label>
                                  <select name="header_payment" class="form-control" required>
                            <option value="">PILIH ...</option>

                            <option value="CAHAYA SELARAS AGUNG,PT" <?php
                            if (!empty($_POST['header_payment'])) {
                                echo $_POST['header_payment'] == 'CAHAYA SELARAS AGUNG,PT' ? 'selected' : '';
                            }
                            ?>>CAHAYA SELARAS AGUNG,PT</option>
                            <option value="VIA BCA 1988" <?php
                            if (!empty($_POST['header_payment'])) {
                                echo $_POST['header_payment'] == 'VIA BCA 1988' ? 'selected' : '';
                            }
                            ?>>VIA BCA 1988</option>

                            <option value="VIA BCA 3701" <?php
                            if (!empty($_POST['header_payment'])) {
                                echo $_POST['header_payment'] == 'VIA BCA 3701' ? 'selected' : '';
                            }
                            ?>>VIA BCA 3701</option>
                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>
                    <?php if (!empty ($_POST['header_payment'])): ?>                     
                    <a href="<?php echo $url_cetak; ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a><?php endif ?>
                                        <?php if (!empty ($_POST['header_payment'])): ?>                     
                    <a href="<?php echo $url_cetak_excel; ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Export Excel</a><?php endif ?>
                                    </div>

                                </form>
                            </div>              
                        </div>
                    </div>
                </div>
				<div class="card shadow">
					<div class="card-header"><strong><?= $title ?></strong></div>
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
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTabl0e" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1">No</td>
										<td>No Spk</td>
										<td width="80">Tanggal</td>
										<td>Project</td>
                                        <td>Vendor</td>
                                        <td width="140">Jumlah</td>
                                        <td width="60">Status</td>
									<!--	<td>Pdf</td> -->
							
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_paym as $pay): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $pay->no_spk ?></td>
											<td><?= $pay->tgl_payment ?></td>
											<td><?= $pay->nama_project ?></td>
                                            <td><?= $pay->nama_vendor ?>
                                               <br><?= $pay->norek_vendor .' - '. $pay->nama_bank_vendor ?></td>
                                             <td>
                                                  <?php
                                             $hasil_rupiah = "Rp " . number_format($pay->total_payment,0,',','.');
                                              echo $hasil_rupiah; ?>
                                             </td>
                                            <td><?php
                                            if ($pay->status_approval == 1) {
                                              echo '<span class="badge badge-secondary">Waiting</span>';
                                            }
                                             if ($pay->status_approval == 2) {
                                              echo '<span class="badge badge-warning">Pending</span>';
                                            }
                                          if ($pay->status_approval == 3) {
                                              echo '<span class="badge badge-primary">Approved</span>';
                                            }
                                            if ($pay->status_approval == 4) {
                                              echo '<span class="badge badge-success">Paid</span>';
                                            }
                                              ?></td>

		
										
										</tr>
                        
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $pay->id_payment; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Payment <?php echo $pay->id_payment; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('payment/update_payment') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
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
                          <?php if($pay->status_approval == 3): ?>          
                            <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-success">Approve By </span></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $pay->approvalBy; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"> <span class="badge badge-success">Approve Time</span></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $pay->approvalTime; ?>"  class="form-control">
                                </div> <?php endif; ?>
                          <?php if($pay->status_approval == 2): ?>          
                            <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-warning">Approve By </span> </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $pay->approvalBy; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><span class="badge badge-warning">Approve Time</span></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $pay->approvalTime; ?>"  class="form-control">
                                </div> <?php endif; ?>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang">ID </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="id_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $pay->id_payment; ?>"  class="form-control">
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
                                             <input  type="text"   name="no_spk" placeholder="Masukkan No SPK" autocomplete="off" value="<?php echo $pay->no_spk; ?>"  class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Pembayaran</label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="tgl_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $pay->tgl_payment; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Proyek </strong></label>
                            <select id="select-state" placeholder="" name="project_payment" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($proyek as $prk) : ?>
                                <option value="<?php echo $prk->id_lsp ?>"
                                <?php
                                if (!empty($pay->project_payment)) {
                                    echo $prk->id_lsp == $pay->project_payment ? 'selected' : '';
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
                                            <label for="nama_barang">Jumlah </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="almount" placeholder="Masukkan Jumlah" autocomplete="off" value="<?php echo $pay->almount ?>"  class="form-control" required>
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Potongan pajak </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="total_pajak" placeholder="Masukkan Jumlah" autocomplete="off" value="<?php echo $pay->total_pajak ?>"  class="form-control" required>
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Jumlah Dibayarkan </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="total_payment" placeholder="Masukkan Jumlah" autocomplete="off" value="<?php echo $pay->total_payment ?>"  class="form-control" required>
                                </div>
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="note_payment" class="form-control " ><?php
			                            if (!empty($pay->note_payment)) {
			                                echo $pay->note_payment;
			                            }
			                            ?></textarea>
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
									<?php endforeach ?>
								</tbody>
                                <?php foreach ($count as $pay): ?>
                                                <tr>
                                            <td colspan="5" align="center">TOTAL</td>
                                          
                                            <td colspan="3"> <?php
                                             $hasil_rupiah = "Rp " . number_format($pay->total_almount,0,',','.');
                                              echo $hasil_rupiah; ?></td>
                               
                                           
                                         
                                         
                                                                              
                                        </tr>
                                    <?php endforeach ?>
							</table>
						</div>
					</div>				
				</div>
				</div>
			</div>
<!-- modal update -->
 
<div  class="modal modal-right fade" id="right_modal" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('payment/save_laporan') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-2">
                                            
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kod_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php  $code =  random_string('numeric', 4);
                                            echo 'P'.''.$code ?>"  class="form-control">
                                </div> 
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Metode Pembayaran </label>
                   <select name="header_payment" class="form-control" required>
                            <option value="">PILIH ...</option>

                            <option value="CAHAYA SELARAS AGUNG,PT" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'CAHAYA SELARAS AGUNG,PT' ? 'selected' : '';
                            }
                            ?>>CAHAYA SELARAS AGUNG,PT</option>
                            <option value="VIA BCA 1988" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'VIA BCA 1988' ? 'selected' : '';
                            }
                            ?>>VIA BCA 1988</option>

                            <option value="VIA BCA 3701" <?php
                            if (!empty($employee_info->Gender)) {
                                echo $employee_info->Gender == 'VIA BCA 3701' ? 'selected' : '';
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
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="tgl_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Proyek </strong></label>
                            <select  placeholder="Nama Project" name="project_payment" class="form-control" required>
                            <option value="" >PILIH .....</option>
                            <?php foreach ($proyek as $prk) : ?>
                                <option value="<?php echo $prk->id_lsp ?>"
                                 <?php $id_lsp = $_POST['id_lsp']; ?>
                                <?php
                                if (!empty($id_lsp)) {
                                    echo $prk->id_lsp == $id_lsp ? 'selected' : '';
                                }
                                ?>><?php echo $prk->nama_project ?></option>
                                    <?php endforeach; ?>

                        </select>
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Vendor & No Rek</strong></label>
                            <select  placeholder="Vendor" name="vendor" class="form-control" required>
                            <option value="" >PILIH .....</option>
                            <?php foreach ($vendor as $vn) : ?>
                                <option value="<?php echo $vn->id_ven ?>"
                                 <?php $id_ven = $_POST['id_ven']; ?>
                                <?php
                                if (!empty($id_ven)) {
                                    echo $vn->id_ven == $id_ven ? 'selected' : '';
                                }
                                ?>><?php echo $vn->nama_vendor .' - '.$vn->norek_vendor  ?></option>
                                    <?php endforeach; ?>

                        </select>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Almount </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="almount" placeholder="Masukkan Jumlah" autocomplete="off" value=""  class="form-control" required>
                                </div>
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="note_payment" class="form-control " ><?php
			                            if (!empty($employee_info->diskusi)) {
			                                echo $employee_info->diskusi;
			                            }
			                            ?></textarea>
									</div>
                               <input type="text" name="ket" placeholder="Tambah Laporan Proyek" autocomplete="off"  class="form-control" required value="Tambah Laporan Proyek" hidden>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdTime_payment" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>

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
</div>

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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>