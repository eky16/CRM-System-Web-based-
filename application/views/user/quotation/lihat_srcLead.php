<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
	<style type="text/css">
		body {
			font-family: 'Calibri', sans-serif !important;
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
					

								<a href="<?= base_url('user/quotation/tambah_srcLead') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
						
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
						<div class="card-header"><strong>Daftar Customer</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th width="5">No</th >
											<th  align="center" scope="col" class="column-primary" data-header="Leads">Id Source Lead</th >
											<th  align="center" scope="col">Source Lead</th >
											<th  align="center" scope="col">Status</th >
											<th  align="center" scope="col">Lihat</th >
										
												<th  align="center" width="50" scope="col" class="column-primary">Aksi</th >
										
										</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										foreach ($srcLead as $srcLead): ?>
											<tr> <?php $number = $no++; ?>
											<td data-header="No"><?= $number ?></td>
											<td data-header="Kode"><?= $srcLead->slug ?></td>
											<td data-header="Project"><?= $srcLead->source ?></td>
											<td align="center" data-header="Status">
												<?php
												if ($srcLead->status == 'aktif') {
													echo '<a class="btn btn-success btn-sm" style="color:white">AKTIF</a>';
												} 
												else {
													echo '<a class="btn btn-danger btn-sm" style="color:white">NON - AKTIF</a>';
												}
												?>
											</td>

											<td  data-header="View"  align="center"><a target="_blank" href="<?= base_url('user/qoutation/detail/' . $srcLead->id) ?>" class="btn btn-primary btn-sm">Lihat</a></td>
											
												<th scope="row">
													
													<div class="toolbox">
														<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">&nbsp;&nbsp;
															Aksi
														</button>
														<div class="dropdown-menu">&nbsp;&nbsp;&nbsp;
															<a href="<?= base_url('user/quotation/ubah_srcLead/' . $srcLead->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>&nbsp;
															
								 <?php if ($this->session->login['department'] == 'IT'):?>
															<a onclick="return confirm('Apakah Anda yakin ingin Hapus data : <?= $srcLead->source?>?')" href="<?= base_url('user/quotation/hapus_srcLead/' . $srcLead->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
															  <?php endif; ?>
														</div>
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