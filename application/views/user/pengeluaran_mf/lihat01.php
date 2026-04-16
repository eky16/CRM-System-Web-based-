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
			<div id="content" data-url="<?= base_url('user/pengeluaran_mf') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					<!--	<a href="<?= base_url('user/pengeluaran_mf/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->

					<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
						<a href="<?= base_url('user/mf/tambah_mf') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
						<div class="card-header"> <a  href="<?php echo base_url(); ?>user/mf/list_pengeluaran_mf"><strong>Data Pengeluaran </strong></a> /<font color="blue"><strong>All Data Pengeluaran MF</strong></font> / <a  href="<?php echo base_url(); ?>user/mf/laporan_pengeluaran "><strong> Laporan </strong></a></div>

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
										<td class="color-Brown" >No</td>
										<td class="color-Brown" >Tgl Keluar</td>
										<td class="color-Brown" >No Keluar</td>
										<td class="color-Brown" >Customer</td>
										<td class="color-Brown" >Barang</td>
										<td class="color-Brown" >Jumlah</td>
										<td class="color-Brown" width="150">Ket</td>
										
										
										<td class="color-Brown" >Aksi</td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pengeluaran_mf as $pengeluaran_mf): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $pengeluaran_mf->tgl_keluar ?></td>
											<td><?= $pengeluaran_mf->no_keluar_mf ?></td>
											<td><?= $pengeluaran_mf->nama_customer ?></td>
											<td><?= $pengeluaran_mf->nama_barang_mf ?></td>
											<td><?= $pengeluaran_mf->jumlah_mf ?> - <?= $pengeluaran_mf->Satuan_mf ?></td>
											<td><?= $pengeluaran_mf->ket_keluar_mf ?></td>

											
											<td>
												<a href="<?= base_url('user/mf/pengeluaran_detail_mf/' . $pengeluaran_mf->no_keluar_mf) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>

												<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
												<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('user/mf/hapus/' . $pengeluaran_mf->no_keluar_mf) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> 
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