<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('user/leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">


					<button  class="btn btn-secondary btn-sm" onclick="closeWindow()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Close</button>	

					<script>
						function closeWindow() {
							window.close();
						}
					</script>				</div>
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
     	  <?php foreach ($all_paym as $row): ?>
		 			<div class="col-lg-12 mb-4">
                            <!-- Project Card Example -->
                            <div class="card shadow ">
                                <div class="card-header py-4">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $row->no_spk .' - '. $row->nama_project	 ?></h6>
                                </div>
                    
                            </div>
				</div>


</div>
           <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI PAYMENT</h6>
                                </div>
                                <div class="card-body">
                               	<div class="form-row">
                                                                   
                   		<div class="form-group col-md-4">
											<label ><strong>Approved By</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $row->approvalBy ?> - <?= $row->approvalTime ?>
										</div>
                            		<div class="form-group col-md-4">
											<label ><strong>Paid By</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $row->update_payBy ?> - <?= $row->timeupdate_pay ?>
										</div>
		
                            		<div class="form-group col-md-4">
											<label ><strong>ID</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $row->id_payment ?>
										</div>

								    <div class="form-group col-md-4">
											<label ><strong>Pembayaran </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $row->header_payment ?>
										</div>

								        <div class="form-group col-md-4">
											<label ><strong>No Spk</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $row->no_spk ?>
										</div>
								  		<div class="form-group col-md-4">
											<label ><strong>Tanggal Pembayaran</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $row->tgl_payment ?>
										</div>
										<div class="form-group col-md-4">
											<label ><strong>Proyek</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $row->nama_project ?>
										</div>
										<div class="form-group col-md-4">
											<label ><strong>Vendor & No Rek</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $row->nama_vendor ?>
                                            <br>&nbsp;<?= $row->atas_nama_bank ?>
                                            <br>&nbsp;<?= $row->norek_vendor .' - '. $row->nama_bank_vendor ?>
										</div>
										<div class="form-group col-md-4">
											<label ><strong>Potongan Pajak</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
									
										<?php if(!empty($row->total_pajak)):?>
										 <?php
                                             $hasil_rupiah = " " . number_format($row->total_pajak,0,',','.');
                                              echo $hasil_rupiah; ?>
                                         <?php endif;?>
										</div>
										<div class="form-group col-md-4">
											<label ><strong>Total Dibayarkan</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											       <?php
                                             $hasil_rupiah = "Rp " . number_format($row->total_payment,0,',','.');
                                              echo $hasil_rupiah; ?>
										</div>
										<div class="form-group col-md-4">
											<label ><strong>Keterangan</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $row->note_payment ?>
										</div>
									
                                    </div>
                                </div>
                            </div>


                        </div>
<?php endforeach ?>
                


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
</body>
</html>