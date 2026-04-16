<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<?php if ($this->session->login['role'] == 'admin'): ?>
					<a href="<?= base_url('asset/export/'. $asst-> 	id_asset) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
					<a href="<?= base_url('asset/tambah') ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Karyawan Baru </a> 
					<a href="<?= base_url('asset/ubah/' . $asst-> 	id_asset) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i>&nbsp;&nbsp;Ubah</a>
						<?php endif ?>

					<button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button>					</div>
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
		 			<div class="col-lg-12 mb-4">
                            <!-- Project Card Example -->
                            <div class="card shadow ">
                                <div class="card-header py-4">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $asst->kode_asset .' - '. $asst->nama_asset	 ?></h6>
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
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI ASSET</h6>
                                </div>
                                <div class="card-body">
                               	<div class="form-row">
                                   
                                  <div class="form-group col-md-4">
											<label ><strong>Foto</strong>
											</label>
										</div>
										<div class="form-group col-md-5">
											
								
	<img  src="<?php echo base_url(); ?>img/uploads/foto_asset/<?= $asst->gambar_asset ?>" style="width:100%;cursor:zoom-in"
  onclick="document.getElementById('modal01').style.display='block'">
    <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
    <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
    <div class="w3-modal-content w3-animate-zoom">
      <img src="<?php echo base_url(); ?>img/uploads/foto_asset/<?= $asst->gambar_asset ?>" style="width:100%">
    </div>
  </div>
										</div>                                   
 
                            		<div class="form-group col-md-4">
											<label ><strong>Nama Asset</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $asst->nama_asset ?>
										</div>
                            		<div class="form-group col-md-4">
											<label ><strong>Status</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $asst->status ?>
										</div>
								    <div class="form-group col-md-4">
											<label ><strong>Keterangan </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $asst->keterangan_asset ?>
										</div>
								        <div class="form-group col-md-4">
											<label ><strong>Createdby</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $asst->createdby ?>
										</div>
									<div class="form-group col-md-4">
											<label ><strong>createdtime</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $asst->createdtime ?>
										</div>


								  
									
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
</body>
</html>