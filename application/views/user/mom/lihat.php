<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php' , $this->data) ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('mom') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
						<?php if ($this->session->login['role'] == 'admin'): ?>

							<a href="<?= base_url('user/mom/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
					<div class="card-header"><strong>Daftar mom</strong></div>
 
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Tanggal</td>
										<td>Kode mom</td>
										
										<td>Nama Project</td>
										<td>Agenda</td>
										<td>Status</td>
										<td>Lanjut MOM</td>
									<!--	<td>Pdf</td> -->
										<td>Lihat</td>
									
											<td>Aksi</td>
								
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_Mom as $mom): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $mom->tanggal ?></td>
											<td><?= $mom->id_mom ?></td>
											
											<td><?= $mom->nama_project ?></td>
											<td><?= $mom->agenda ?></td>
											<td>                                <?php 
                                $attr = array(
                                'target'=>'_blank'
                                ); ?><?php
                               
                                    if ($mom->status == '1') {
                                        echo anchor('user/mom/edit2_mom/'. $mom->id,'<i class="label label-warning">M O M 1</i>',$attr);
                                    } elseif ($mom->status == '2') {

                                        echo anchor('user/mom/edit2_mom/'. $mom->id,'<i class="label label-warning">M O M 2</i>',$attr);

                                       
                                    }
                                   elseif ($mom->status == '3') {

                                        echo anchor('user/mom/edit2_mom/'. $mom->id,'<i class="label label-info"> M O M 3</i>',$attr);

                                       
                                    }
                                     elseif ($mom->status == '4') {

                                        echo anchor('user/mom/edit2_mom/'. $mom->id,'<i class="label label-info"> M O M 4</i>',$attr);

                                       
                                    }elseif ($mom->status == '5') {

                                        echo anchor('user/mom/edit2_mom/'. $mom->id,'<i class="label label-info"> M O M 5</i>',$attr);

                                       
                                    }elseif ($mom->status == '6') {

                                      
                                        echo '<span class="label label-danger"> TIDAK </span>';
                                       
                                    } elseif ($mom->status == '7'){
                                        echo '<span class="label label-success"> GOAL </span>';
                                    }
                                    else {
                                         echo anchor('user/mom/edit2_momnn/' . $mom->leadsproject_id, '<i class="label label-danger">Rejected</i>',$attr);
                                    }
                                    ?>				
                                </td>
                                		<td align="center"><a href="<?= base_url('user/mom/edit2_mom/' . $mom->id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a></td>
                               <!--   <td><a href="<?= base_url('mom/export/'. $mom->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a></td> -->
											<td align="center"><a href="<?= base_url('user/mom/detail/' . $mom->id) ?>" class="btn btn-primary btn-sm">Lihat</a></td>
									
												<td>

													<a href="<?= base_url('user/mom/ubah/' . $mom->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
													<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('user/mom/hapus/' . $mom->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												</td>
							
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