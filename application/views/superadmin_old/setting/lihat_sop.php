<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<script src="<?= base_url('sb-admin') ?>/js/jquery-3.1.0.js"></script> 
	 <script>
    $(document).ready(function() {
        $('#dataTable1').dataTable({
        
             "scrollX": true ,order: [[ 0, 'desc' ], [ 1, 'asc' ]],
             "lengthMenu": [10, 25, 50, 75, 10]
        });        
    });
  </script>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('mom') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
						<?php if ($this->session->login['role'] == 'admin'): ?>

							<a href="<?= base_url('setting/tambah_sop') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
		
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="5">No</td>
										<td width="60">Kode</td>
										<td >Isi</td>
										<td width="60">Status</td>
										<?php if ($this->session->login['role'] == 'admin'): ?>
											<td width="50">Aksi</td>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>
									 <?php
									 $no = 1; foreach ($tampil_sop as $row): ?>  
										<tr>
										<td><?= $no ++ ?></td>
										<td><?= $row->jenis_sop  ?></td>
						    			<td><?= $row->isi_sop  ?></td>
                                        <td><?= $row->status_sop  ?></td>
				
         
											<?php if ($this->session->login['role'] == 'admin'): ?>
												<td>
<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
   Aksi
  </button>
  <div class="dropdown-menu">&nbsp;&nbsp;&nbsp;&nbsp;
 	<a onclick="return confirm('Lanjut Edit?')" href="<?= base_url('setting/ubah_sop/' . $row->id_sop ) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>&nbsp;
 	<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('setting/hapus_sop/' . $row->id_sop  ) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
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