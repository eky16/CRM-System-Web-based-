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
			<div id="content" data-url="<?= base_url('user/pengeluaran') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					<!--	<a href="<?= base_url('user/pengeluaran/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->

					<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
						<a href="<?= base_url('user/barang/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>

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
						<div class="card-header"><font color="blue"><strong>Data Pengeluaran</strong></font> / <a  href="<?php echo base_url(); ?>user/barang/list_pengeluaran_all "><strong>All Data Pengeluaran </strong></a> / <a  href="<?php echo base_url(); ?>user/barang/laporan_pengeluaran "><strong> Laporan </strong></a></div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>No Keluar</td>
										<td>Nama</td>
										<td>Customer</td>
										<td>Tanggal Keluar</td>

										<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
										<td>Aksi</td>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pengeluaran as $pengeluaran): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $pengeluaran->no_keluar ?></td>
											<td><?= $pengeluaran->nama_petugas ?></td>
											<td><?= $pengeluaran->nama_customer ?></td>
											<td><?= $pengeluaran->tgl_keluar ?> <?= $pengeluaran->jam_keluar ?></td>

											<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
											<td>
												<a href="<?= base_url('user/barang/pengeluaran_detail/' . $pengeluaran->no_keluar) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
												<a onclick="return confirm('Apakah Anda yakin ingin Hapus data Pengeluaran : <?= $pengeluaran->no_keluar?>?')" href="<?= base_url('user/barang/hapus/' . $pengeluaran->no_keluar) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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