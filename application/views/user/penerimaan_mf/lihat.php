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
			<div id="content" data-url="<?= base_url('user/penerimaan_mf') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					<!--	<a href="<?= base_url('user/penerimaan_mf/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
					<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
						<a href="<?= base_url('user/penerimaan_mf/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
					<div class="card-header"><font color="blue"><strong>Data Penerimaan</strong></font>/ <a  href="<?php echo base_url(); ?>user/penerimaan_mf/data_penerimaan_mf "><strong> All Data Penerimaan MF </strong></a> / <a  href="<?php echo base_url(); ?>user/penerimaan_mf/laporan_penerimaan_mf "><strong> Laporan </strong></a></div> 

					<style>
    /* CSS untuk tabel */
    .colorful-table {
        border-collapse: collapse;
        width: 100%;
    }

    .colorful-table th,
    .colorful-table td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
    }

    /* CSS untuk warna sel tertentu */
    .color-Plum {
        background-color: Plum;
        color: black; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang merah */
    }

    .color-Brown {
        background-color: Brown;
        color: white; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang hijau */
    }
</style>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td class="color-Brown" width="1">No</td>
										<td class="color-Brown" >No Terima</td>
										<td class="color-Brown" >Admin</td>
										<td class="color-Brown" >Tanggal Terima</td>
										<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
										<td class="color-Brown" >Aksi</td>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_penerimaan_mf as $penerimaan_mf): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $penerimaan_mf->no_terima ?></td>
											<td><?= $penerimaan_mf->nama_petugas ?></td>
											<td><?= $penerimaan_mf->tgl_terima ?> <?= $penerimaan_mf->jam_terima ?></td>

											<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
											<td>
												<a href="<?= base_url('user/penerimaan_mf/detail/' . $penerimaan_mf->no_terima) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
												<a onclick="return confirm('Apakah Anda yakin ingin Hapus data Penerimaan : <?= $penerimaan_mf->no_terima?>?')" href="<?= base_url('user/penerimaan_mf/hapus/' . $penerimaan_mf->no_terima) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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