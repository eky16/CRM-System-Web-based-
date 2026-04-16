<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
<style type="text/css">
	@media screen and (max-width: 520px) {
	table {
		width: 100%;
	}
	thead th.column-primary {
		width: 100%;
	}

	thead th:not(.column-primary) {
		display:none;
	}
	
	th[scope="row"] {
		vertical-align: top;
	}
	
	td {
		display: block;
		width: auto;
		text-align: right;
	}
	thead th::before {
		text-transform: uppercase;
		font-weight: bold;
		font-size: 10px;
		font-family: 'Calibri', sans-serif !important;
		content: attr(data-header);
	}
	thead th:first-child span {
		display: none;
	}
	td::before {
		float: left;
		text-transform: uppercase;
		font-weight: bold;
		font-size: 10px;
		font-family: 'Calibri', sans-serif !important;
		content: attr(data-header);
	}
}
</style>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					
							<a href="<?= base_url('user/leads/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
							<a href="<?= base_url('user/leads/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
					
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
									<th  scope="col" >No</th >
										<th  align="center" scope="col" class="column-primary" data-header="Leads">Kode leads</th >
										<th  align="center" scope="col">Nama Project</th >
										<th  align="center" scope="col">Status</th >
										<?php if ( $title == 'Project Retensi'): ?>
											<th  align="center" scope="col">Tanggal Retensi</th >
											<?php endif ?>
										<th  align="center" scope="col">Lihat</th >
									
											<th  align="center" scope="col" class="column-primary">Aksi</th >
		
								
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_leads as $leads): ?>
										<tr>
											<td data-header="No"><?= $no++ ?></td>
											<td data-header="Kode"><?= $leads->id_lsp ?></td>
											<td data-header="Project"><?= $leads->nama_project ?></td>
											<td align="center"  data-header="Status">
												

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

													
												} elseif ($leads->status_project == 'FINISH'){
													
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
											<td align="center"  data-header="View"><a target="_blank" href="<?= base_url('user/leads/detail/' . $leads->id_lsp) ?>" class="btn btn-primary btn-sm">Lihat</a></td>
		<th scope="row">
			<div class="toolbox">
				<a href="<?= base_url('user/leads/ubah/' . $leads->id_lsp) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
			</div>
		</th>
											
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