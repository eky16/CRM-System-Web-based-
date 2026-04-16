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
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $all_leads->nama_project ?></h6>
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
                                    <h6 class="m-0 font-weight-bold text-primary">DAILY PROGRESS FOTO PROJECT</h6>
                                </div>
                                <div class="card-body">
                               	<div class="form-row">
      
<!-- Gallery item -->
<?php foreach ($all_foto as $mdl): ?>
      <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="bg-white rounded shadow-sm"><a target="_blank" href="<?php echo base_url(); ?>img/uploads/<?= $mdl->foto ?>" ><img src="<?php echo base_url(); ?>img/uploads/<?= $mdl->foto ?> ?>" alt="" class="img-fluid card-img-top"></a>
          <div class="p-4">
      
            <p class="small text-muted mb-0"><?= $mdl->ket_daily ?></p>
            <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
             
              <div class="badge badge-danger px-3 rounded-pill font-weight-normal"> <?= $mdl->createdtime ?> </div>
            </div>
          </div>
        </div>
      </div>
<?php endforeach ?>
 <!-- End -->
    </div>



     
			</div></div>

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