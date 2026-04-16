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
			<div id="content" data-url="<?= base_url('user/penerimaan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					<!--	<a href="<?= base_url('user/penerimaan/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
					<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
						<a href="<?= base_url('user/penerimaan/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
						<?php endif; ?>

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
					<div class="card-header"><font color="blue"><strong>Data Penerimaan</strong></font>/ <a  href="<?php echo base_url(); ?>user/penerimaan/data_penerimaan "><strong> All Data Penerimaan </strong></a> / <a  href="<?php echo base_url(); ?>user/penerimaan/laporan_penerimaan "><strong> Laporan </strong></a></div> 
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1">No</td>
										<td>No Terima</td>
										<td>Admin</td>
										<td>Tanggal Terima</td>
										<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
										<td>Aksi</td>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_penerimaan as $penerimaan): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $penerimaan->no_terima ?></td>
											<td><?= $penerimaan->nama_petugas ?></td>
											<td><?= $penerimaan->tgl_terima ?> <?= $penerimaan->jam_terima ?></td>

											<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
											<td>
												<a href="<?= base_url('user/penerimaan/detail/' . $penerimaan->no_terima) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
												<a onclick="return confirm('Apakah Anda yakin ingin Hapus data Penerimaan : <?= $penerimaan->no_terima?>?')" href="<?= base_url('user/penerimaan/hapus/' . $penerimaan->no_terima) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
											<?php endif; ?>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
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
</body>
</html>