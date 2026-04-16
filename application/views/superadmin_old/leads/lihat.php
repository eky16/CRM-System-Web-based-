<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<style type="text/css">
		body {
			font-family: 'Calibri', sans-serif !important;
		}

	</style>
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
								<a href="<?= base_url('leads/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
								<a href="<?= base_url('leads/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
						<div class="card-header"><strong>Daftar leads</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th >No</th >
											<th  align="center" scope="col" class="column-primary" data-header="Leads">Kode leads</th >
											<th  align="center" scope="col">Nama Project</th >
											<th  align="center" scope="col">Status</th >
											<?php if ( $title == 'Project Retensi'): ?>
											<th  align="center" scope="col">Tanggal Retensi</th >
											<?php endif ?>
											<th  align="center" scope="col">Lihat</th >
											<?php if ($this->session->login['role'] == 'admin'): ?>
												<th  align="center" width="50" scope="col" class="column-primary">Aksi</th >
											<?php endif ?>
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										foreach ($all_leads as $leads): ?>
											<tr> <?php $number = $no++; ?>
											<td data-header="No"><?= $number ?></td>
											<td data-header="Kode"><?= $leads->id_lsp ?></td>
											<td data-header="Project"><?= $leads->nama_project ?></td>
											<td align="center" data-header="Status">
												<?php
												if ($leads->status_project == 'TENDER') {
													echo '<a class="btn btn-success btn-sm" style="color:white">TENDER</a>';
												} elseif ($leads->status_project == 'ON GOING') {

													echo '<a class="btn btn-primary btn-sm" style="color:white">ON GOING</a>';
													
												}
												elseif ($leads->status_project == 'PENDING') {

													echo '<a class="btn btn-outline-success btn-sm" style="color:black"> PENDING</a>';

													
												}elseif ($leads->status_project == 'RETENSI') {

													echo '<a class="btn btn-outline-warning btn-sm" style="color:black"> RETENSI</a>';

													
												}  elseif ($leads->status_project == 'FINISH'){
													
													echo '<a class="btn btn-warning btn-sm" style="color:white">FINISH</a>';
												}
												else {
													
													echo '<a class="btn btn-danger btn-sm" style="color:white">LOOSE</a>';
												}
												?>
											</td>
											<?php if ( $title == 'Project Retensi'): ?>
											<td data-header="tanggal_retensi"><?= $leads->tanggal_retensi ?></td>
											<?php endif ?>
											<td  data-header="View"  align="center"><a target="_blank" href="<?= base_url('leads/detail/' . $leads->id_lsp) ?>" class="btn btn-primary btn-sm">Lihat</a></td>
											<?php if ($this->session->login['role'] == 'admin'): ?>
												<th scope="row">

													<div class="toolbox">
														<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">&nbsp;&nbsp;
															Aksi
														</button>
														<div class="dropdown-menu">&nbsp;&nbsp;&nbsp;
															<a href="<?= base_url('leads/ubah/' . $leads->id_lsp) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>&nbsp;
															<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('leads/hapus/' . $leads->id_lsp) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
														</div>
													</div>
												</th>
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