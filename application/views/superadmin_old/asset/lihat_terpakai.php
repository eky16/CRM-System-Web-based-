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
			<div id="content" data-url="<?= base_url('asst') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
						<?php if ($this->session->login['role'] == 'admin'): ?>

							<a href="<?= base_url('asset/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
						<?php endif ?>
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
					<div class="card-header"><strong>DATA asset CASSA DESIGN</strong></div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Kode</td>
										<td>Nama Asset</td>
										<td>Keterangan</td>
										<td>Status</td>
										<td>Karyawan</td>
										<td>foto</td>
										<td>Lihat</td>
										<?php if ($this->session->login['role'] == 'admin'): ?>
											<td>Aksi</td>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_asset as $asst): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $asst->kode_asset ?></td>
											<td><?= $asst->nama_asset ?></td>
											<td><?= $asst->keterangan_asset ?></td>
											<td><?= $asst->status ?></td>
											<td><?= $asst->nama_karyawan ?></td>
											<td>
			 <?php if (!empty($asst->gambar_asset)): ?>
<a target="blank" href="<?php echo base_url(); ?>img/uploads/foto_asset/<?= $asst->gambar_asset ?>" title="Menuju halaman google">
  Lihat 
</a>
 <?php else : ?>
                
                    <strong> - </strong>
                
<?php endif; ?>
											</td>
											<td align="center"><a href="<?= base_url('asset/detail/' . $asst->id_asset) ?>" class="btn btn-primary btn-sm">Lihat</a></td>
											<?php if ($this->session->login['role'] == 'admin'): ?>
												<td>
<div class="toolbox">
<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">&nbsp;&nbsp;
   Aksi
  </button>
  <div class="dropdown-menu">&nbsp;&nbsp;&nbsp;
  <a href="<?= base_url('asset/ubah/' . $asst->id_asset) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>&nbsp;
   <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('asset/hapus/' . $asst->kode_asset) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
  </div>
</div>
												
												</td>
											<?php endif ?>
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
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>