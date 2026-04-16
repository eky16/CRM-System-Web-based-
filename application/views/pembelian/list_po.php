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
                        <a  data-toggle="modal" style="color:white" data-target="#readme" class="btn btn-danger btn-sm"><i class="fa fa-book"></i>&nbsp;&nbsp;Read Me !!!</a>

                   <?php if ($title == "List Pesanan Pembelian") :?>       
                    </div><font color="blue"><strong>List Pesanan Pembelian</strong></font>  / <a  href="<?php echo base_url(); ?>pembelian/list_pengiriman"><strong>Pengiriman</strong></a> / <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><strong>Komplain</strong></a> / <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><strong>Riwayat Pesanan Pembelian</strong></a></div>
                      <?php endif; ?>
                    <?php if ($title == "Proses Pengiriman") :?>  
                    </div><a  href="<?php echo base_url(); ?>pembelian/list_pesanan_pembelian"><strong> List Pesanan Pembelian</strong></a> / <font color="blue"><strong>Pengiriman</strong></font> / <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><strong>Komplain</strong></a> / <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><strong>Riwayat Pesanan Pembelian</strong></a></div>
                     <?php endif; ?>
                    <?php if ($title == "Klaim Pesanan Pembelian") :?>  
                    </div><a  href="<?php echo base_url(); ?>pembelian/list_pesanan_pembelian"><strong> List Pesanan Pembelian</strong></a> /  <a  href="<?php echo base_url(); ?>pembelian/list_pengiriman"><strong>Pengiriman</strong></a>/ <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><font color="blue"><strong>Komplain</strong></font></a>  / <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><strong>Riwayat Pesanan Pembelian</strong></a></div>
                     <?php endif; ?>
                    <?php if ($title == "Riwayat Pesanan Pembelian") :?>  
                    </div><a  href="<?php echo base_url(); ?>pembelian/list_pesanan_pembelian"><strong> List Pesanan Pembelian</strong></a> /  <a  href="<?php echo base_url(); ?>pembelian/list_pengiriman"><strong>Pengiriman</strong></a>/ <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><strong>Komplain</strong> </a>/ <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><font color="blue"><strong>Riwayat Pesanan Pembelian ( PO )</strong></font> </a>/ <a  href="<?php echo base_url(); ?>pembelian/list_selesai_spk"><strong>Riwayat Pesanan Pembelian ( SPK )</strong></a></div>
                     <?php endif; ?>
                    <?php if ($title == "Riwayat Pesanan Pembelian Spk") :?>  
                    </div><a  href="<?php echo base_url(); ?>pembelian/list_pesanan_pembelian"><strong> List Pesanan Pembelian</strong></a> /  <a  href="<?php echo base_url(); ?>pembelian/list_pengiriman"><strong>Pengiriman</strong></a>/ <a  href="<?php echo base_url(); ?>pembelian/list_klaim"><strong>Komplain</strong> </a>/ <a  href="<?php echo base_url(); ?>pembelian/list_selesai"><strong>Riwayat Pesanan Pembelian ( PO )</strong></a>/ <a  href="<?php echo base_url(); ?>pembelian/list_selesai_spk"><font color="blue"><strong>Riwayat Pesanan Pembelian ( SPK )</strong></a></font>   </div>
                     <?php endif; ?>
					<div class="card-body">

						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px">No</font></td>
										<td><font size="2px">Id</font></td>
										<td width="50"><font size="2px">Tanggal Kirim</font></td>
										<td width="200"><font size="2px">Customer</font></td>
                                        <td width="150"><font size="2px">Sales</font></td>
                                        <td ><font size="2px">Status</font></td>
										<td width="100"><font size="2px">Aksi</font></td>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pr as $row): ?>
										<tr>
											<td><font size="1px"><?= $no++ ?></font></td>
											<td><font size="2px"><?= $row->number_ ?></font>
                                            </td>
											<td ><font size="2px"><?= $row->shipDate ?></font></td>
											<td><font size="2px"><?= $row->nama_cst ?></font></td>
                                            <td><font size="2px"><?= $row->nama_sales ?></font></td>
                                            <td><font size="2px">
                                            <?php $status_pr = $row->status_po  ?>
                                            <?php if ($status_pr == 1):?>
                                              <span class="badge badge-warning">PR- Menunggu Approval PM </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 2):?>
                                              <span class="badge badge-info">PR- Menunggu Approval Estimator </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 3):?>
                                            <span class="badge badge-info">Purchasing Mencari Supplier </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 4):?>
                                            <span class="badge badge-info">PR Settle -Menunggu Approval Estimator</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 5):?>
                                            <span class="badge badge-primary">PR Settle- Menunggu Approval Direksi</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 6):?>
                                            <span class="badge badge-primary">Menunggu Barang dikirim dari supplier</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 7):?>
                                            <span class="badge badge-success">Barang sudah diterima</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 8):?>
                                            <span class="badge badge-danger">Barang direject</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 9):?>
                                            <span class="badge badge-secondary">Klaim, Barang Tidak Sesuai</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 10):?>
                                            <span class="badge badge-info">Proses Pengiriman Ulang </span>
                                            <?php endif;?>

                                           
                                            </font></td>

											<td><font size="2px">
                                                    <a  href="<?= base_url('pembelian/detail_po_dt_penerimaan/' . $row->id ) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detail</a>
												
											
                                                <!--    <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('pembelian/hapus_pr/' . $row->id ) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> --></font>
												</td>
										
										</tr>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $row->id_payment; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Payment <?php echo $row->id_payment; ?></h5>
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
          <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="id_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $pay->id_payment; ?>"  class="form-control" hidden>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">ID </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $pay->id_payment.' , '. $pay->createdBy_payment.' - '. $pay->createdTime_payment; ?>"  class="form-control">
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
                                            <label for="nama_barang">Almount </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="almount" placeholder="Masukkan Jumlah" autocomplete="off" value="<?php echo $pay->almount ?>"  class="form-control" required>
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Potongan Pajak </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="total_pajak" placeholder="" autocomplete="off" value="<?php echo $pay->total_pajak ?>"  class="form-control" required>
                                </div>
                                                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Total Dibayarkan </label>
                                             <input onkeypress="return hanyaAngka(event)"  type="text" maxlength="50"  name="total_payment" placeholder="" autocomplete="off" value="<?php echo $pay->total_payment ?>"  class="form-control" required>
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
                                            <label for="nama_barang">Tanggal Pembayaran</label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="tgl_payment" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control" required>
                                </div>   
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">No Spk </label>
                                             <input  type="text"   name="no_spk" placeholder="Masukkan No SPK" autocomplete="off" value=""  class="form-control" required>
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
<div id="readme" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">ALUR PESANAN PEMBELIAN</h4>
        </div>
 <form method="post" action="<?= base_url('mod_kerja/save_berkas_user') ?>" enctype="multipart/form-data" class="form-horizontal" id="form-tambah">  
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
<!-- start isi -->
<p class="MsoNormal" style="text-align: center;" align="center"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 14.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">ALUR PESANAN PEMBELIAN ( PURCHASE ORDER )</span></strong></p>
<p class="MsoListParagraphCxSpFirst" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">1.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Pesanan Pembelian yang telah dibuat oleh purchasing harus melalui 2 persetujuan sebelum data tsb masuk kedalam system accurate.</span></p>
<p class="MsoListParagraphCxSpMiddle" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l2 level2 lfo2;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">1.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Estimator.</span></p>
<p class="MsoListParagraphCxSpMiddle" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l2 level2 lfo2;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">2.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Direksi.</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">2.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Pada tahap persetujuan direksi , data yang disetujui akan masuk ke dalam system Accurate online .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">3.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Setelah disetujui direksi , maka pesanan pembelian akan masuk pada tahap pengiriman barang oleh supplier .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">4.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Pada tahap ini user yang meminta/yang menerima barang bisa mengecek kesesuain permintaan dengan barang yang dikirim oleh supplier .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level2 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">a.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Upload Gambar .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level2 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">b.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Pilih Status Barang Sesuai atau Tidak.</span></p>
<p class="MsoListParagraphCxSpLast" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l0 level2 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">c.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Kemudian Catatan jika diperlukan .</span></p>
<p class="MsoNormal" style="margin-left: 54.0pt;"><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Jika Barang tidak sesuai .</span></p>
<p class="MsoListParagraphCxSpFirst" style="margin-left: 72.0pt; mso-add-space: auto; text-indent: -18.0pt; mso-list: l1 level1 lfo3;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">a.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Jika barang yang dikirim tidak sesuai , maka status pesanan pembelian akan otomatis berubah menjadi proses klaim . pada tahap ini purchasing telah menerima notifikasi by system dan akan menjadwalkan ulang pengiriman barang yang tidak sesuai <span style="mso-spacerun: yes;">&nbsp;</span>( data transaksi akan masuk pada menu komplain).</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">5.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">( Untuk Purchasing ) klik menu complain kemudian klik detail , lihat data barang yang tidak sesuai pada table detail . kemudian proses penjadwalan ulang .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">6.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Setelah dijadwalkan ulang maka data tsb akan masuk pada menu pengiriman .</span></p>
<p class="MsoListParagraphCxSpMiddle" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">7.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Setelah barang diterima maka cek satu persatu ( tahap 4 ) jika semua barang sesuai maka pilih tombol <em style="mso-bidi-font-style: normal;">selesaikan pesanan</em> untuk mengakhiri proses transaksi tsb.</span></p>
<p class="MsoListParagraphCxSpLast" style="text-indent: -18.0pt; mso-list: l0 level1 lfo1;"><!-- [if !supportLists]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; mso-bidi-font-family: Calibri; mso-bidi-theme-font: minor-latin;"><span style="mso-list: Ignore;">8.<span style="font: 7.0pt 'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><!--[endif]--><span style="font-size: 12.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%;">Untuk melihat Riwayat transaksi tsb , ada pada menu Riwayat Pesanan Pembelian .</span></p>
<!-- end isi -->
                                </div>

   
                                        <hr>
   
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
  </div> <!-- end modal -->

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