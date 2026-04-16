<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

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
				

							<a  data-toggle="modal" style="color:white" data-target="#right_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
					
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
					<div class="card-header"><strong>Laporan Proyek</strong></div>
   <div class="panel-body">
    <form method="post" action="<?= base_url('mom/lihat_filter') ?>" class="form-horizontal">  
        <div class="panel_controls">                         
    <!--          <div class="form-group">
           </br>

 <div class="col-sm-5">                             
                 <select id="select-state" placeholder="Pilih Pic Atau Kode Leads Project" name="id_lsp" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($all_leads_project as $lsp) : ?>
                                <option value="<?php echo $lsp->id_lsp ?>"
                                 <?php $id_lsp = $_POST['id_lsp']; ?>
                                <?php
                                if (!empty($id_lsp)) {
                                    echo $lsp->id_lsp == $id_lsp ? 'selected' : '';
                                }
                                ?>><?php echo $lsp->id_lsp .' - '.$lsp->nama_pic ?></option>
                                    <?php endforeach; ?>

                        </select>  
            </div>
            </div>
          
        <div class="col-sm-offset-3 col-sm-5">
            <button type="submit" class="btn btn-primary">Cari</button>  
            <a href="<?= base_url('mom/lihat_semua') ?>"> 
            <input type="button" class="btn btn-primary" value="Semua" \></a>                           
        </div> -->

    </div>
    </form>  
</div>  
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Kode</td>
										<td>Tanggal</td>
										<td>Nama Project</td>
										<td>Berkas</td>
									<!--	<td>Pdf</td> -->
										<td>Lihat</td>
										
											<td>Aksi</td>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_Mom as $mom): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $mom->kode_lap ?></td>
											<td><?= $mom->tgl_laporan ?></td>
											<td><?= $mom->nama_project ?></td>
										
																<td>
			 <?php if (!empty($mom->berkas)): ?>
<a target="blank" href="<?php echo base_url(); ?>img/uploads/berkas1/<?= $mom->berkas ?>" title="Menuju halaman google">
  Lihat 
</a>
 <?php else : ?>
                
                    <strong> - </strong>
                
<?php endif; ?>
											</td>
                               <!--   <td><a href="<?= base_url('mom/export/'. $mom->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a></td> -->
											<td align="center"><a target="blank" href="<?= base_url('user/mom/detail_laporan/' . $mom->kode_lap) ?>" class="btn btn-primary btn-sm">Lihat</a></td>
											
												<td>

													  <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $mom->kode_lap; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah</a>
													<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('user/mom/hapus_laporan/' . $mom->kode_lap) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												</td>
										
										</tr>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $mom->kode_lap; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Laporan <?php echo $mom->kode_lap; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/mom/save_laporan') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">No </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kode_lap" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $mom->kode_lap; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="tgl_laporan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $mom->tgl_laporan; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Proyek </strong></label>
                            <select id="select-state" placeholder="Nama Project" name="id_lsp" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($proyek as $prk) : ?>
                                <option value="<?php echo $prk->id_lsp ?>"
                                <?php
                                if (!empty($mom->id_lsp)) {
                                    echo $prk->id_lsp == $mom->id_lsp ? 'selected' : '';
                                }
                                ?>><?php echo $prk->nama_project ?></option>
                                    <?php endforeach; ?>

                        </select>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Berkas </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="file" name="berkas" readonly placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php
                        if (!empty($mom->berkas)) {
                            echo $mom->berkas;
                        }
                        ?>"  class="form-control">
                                </div>
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="keterangan_proyek" class="form-control textEditor" ><?php
			                            if (!empty($mom->keterangan_proyek)) {
			                                echo $mom->keterangan_proyek;
			                            }
			                            ?></textarea>
									</div>
                               <input type="text" name="ket" placeholder="Tambah Laporan Proyek" autocomplete="off"  class="form-control" required value="Tambah Laporan Proyek" hidden>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
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
<!-- modal update -->
 
<div  class="modal modal-right fade" id="right_modal<?php echo $cuti->tahun; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Laporan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/mom/save_laporan') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">No </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kode_lap" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $kode_lap ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="date" maxlength="50"  name="tgl_laporan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Proyek </strong></label>
                            <select id="select-state" placeholder="Nama Project" name="id_lsp" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($proyek as $prk) : ?>
                                <option value="<?php echo $prk->id_lsp ?>"
                                 <?php $id_lsp = $_POST['id_lsp']; ?>
                                <?php
                                if (!empty($id_lsp)) {
                                    echo $prk->id_lsp == $id_lsp ? 'selected' : '';
                                }
                                ?>><?php echo $prk->nama_project ?></option>
                                    <?php endforeach; ?>

                        </select>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Berkas </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="file"  name="berkas" readonly placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control">
                                </div>
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="keterangan_proyek" class="form-control textEditor" ><?php
			                            if (!empty($employee_info->diskusi)) {
			                                echo $employee_info->diskusi;
			                            }
			                            ?></textarea>
									</div>
                               <input type="text" name="ket" placeholder="Tambah Laporan Proyek" autocomplete="off"  class="form-control" required value="Tambah Laporan Proyek" hidden>

                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
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

			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>