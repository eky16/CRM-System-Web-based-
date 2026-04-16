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

							<a href="<?= base_url('mod_kerja/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
					<div class="card-header"><strong>CASSA DESIGN</strong></div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Tanggal</td>
										<td>Kode</td>
										<td>Task</td>
										<td>Moderator</td>
										<td>Penerima</td>
										<td> Proyek</td>
										<td> Due Date</td>
										<td>Progres</td>
										<td>Lihat</td>
									
											<td>Aksi</td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_dept_info as $mdl): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $mdl->createdtime ?></td>
											<td><?= $mdl->kode_modul ?></td>
											<td><?= $mdl->tugas ?></td>
											<td><?= $mdl->createdby ?></td>
											<td><?= $mdl->nama_karyawan ?></td>
											<td><?= $mdl->nama_proyek ?></td>
											<td><?= $mdl->tempo ?></td>
										<!--	      <td>
                                        <?php if ($mdl->status_modul == 2) : ?>
                                        	<input type="checkbox" checked="checked" disabled="disabled" /> Selesai
                                      <?php elseif($mdl->status_modul == 1) : ?>
										<input type="checkbox"  disabled="disabled" /> Proses
                                       <?php endif; ?></td> -->

                                       	<td align="center">
                                       	<?php 
                                       $persentasi=round($mdl->proses/$mdl->progres * 100,2); 
                                       echo "$persentasi%";
										?>
										</td>



											<td align="center"><a href="<?= base_url('user/mod_kerja/detail/' . $mdl->kode_modul) ?>" class="btn btn-primary btn-sm">Lihat</a></td>
											
												<td>
									 <?php if ($mdl->status_modul == 1) : ?>
													<a href="<?= base_url('user/mod_kerja/proses_modul/' . $mdl->kode_modul) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Terima</a>
											<a href="<?= base_url('user/mod_kerja/ubah/' . $mdl->kode_modul) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Ubah</a>
									 <?php elseif($mdl->status_modul == 3) : ?>				


													<a data-toggle="modal" style="color:white" data-target="#right_modal<?= $mdl->kode_modul ?>" class="btn btn-warning btn-sm"><i class="fa fa-upload"></i> Selesai</a>
												 <?php endif; ?>
											  
												</td>
											
										</tr>

						<div  class="modal modal-right fade" id="right_modal<?= $mdl->kode_modul ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">MODUL KERJA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('mod_kerja/save_laporan') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $mdl->kode_modul ?>, <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Kode Task </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kode_modul" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $mdl->kode_modul ?>"  class="form-control">
                                </div>
                               <div class="form-group col-md-12">
                                            <label for="nama_barang">Nama Proyek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Proyek" autocomplete="off" value="<?= $mdl->nama_proyek ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Tugas Diberikan</label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $mdl->createdtime ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Tugas Diproses</label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $mdl->tgl_proses ?>"  class="form-control">
                                </div>
                                  <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Tugas Selesai</label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $mdl->tgl_selesai ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Disetujui</label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $mdl->user ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tugas Diselesaikan</label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php 
                                       $persentasi=round($mdl->proses/$mdl->progres * 100,2); 
                                       echo "$persentasi%";
										?> (<?= $mdl->proses .'/'. $mdl->progres ?>) "  class="form-control">
                                </div>
 					

							 

                               <input type="text" name="ket" placeholder="Tambah Laporan Proyek" autocomplete="off"  class="form-control" required value="Tugas Telah Selesai" hidden>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>"  hidden>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>

         
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
     <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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