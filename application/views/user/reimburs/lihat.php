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
 						<a  data-toggle="modal" style="color:white" data-target="#izin_tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
					<div class="card-header"><strong>LIST KATEGORI </strong></div>


					
						<div class="table-responsive">
							<table class="table table-bordered"  width="100%" cellspacing="0">
								 <thead>
                                <tr>
                                    <th class="col-sm-1">No</th>
                                    <th >Nama Kategori</th>  
                                    <th class="col-sm-2" align="center">Aksi</th>     
                                </tr>
                            </thead>
								  <tbody>                                                        
                                <?php foreach ($all_izin_info as $key => $izin) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $izin->jenis .' - '.$izin->id_izin ?></td>
                                        <td align="center">

                                        <a  data-toggle="modal" style="color:white" data-target="#person_adm<?php echo $izin->id_izin; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah</a>
										
										<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('izin/hapus/' . $izin->kode_kategori) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                                       
                                    </tr>
<!-- modal update -->
	
<div id="person_adm<?php echo $izin->id_izin; ?>" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">LIST KATEGORI IZIN</h4>
        </div>
<form action="<?= base_url('izin/proses_ubah') ?>" id="form-tambah" method="POST">
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Kode </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="kode_kategori" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $izin->kode_kategori ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Kategori </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="jenis" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $izin->jenis ?>"  class="form-control">
                                </div>
                               <input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Update Kategori Izin" maxlength="8" hidden>
                              <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" hidden name="id_izin" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $izin->id_izin ?>"   class="form-control">
                                <input type="text" name="updateby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="updatetime" value="<?php date_default_timezone_set('Asia/Jakarta');
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
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- selesai modal asset -->
                                    <?php  endforeach; ?>
                                                           
                        </tbody>
							</table>
						</div>       

     
							
				</div>
				</div>
			</div>
<!-- modal update -->
	
<div id="izin_tambah" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">TAMBAH KATEGORI IZIN</h4>
        </div>
<form action="<?= base_url('izin/proses_tambah') ?>" id="form-tambah" method="POST">
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Kode </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="kode_kategori" placeholder="Masukkan Nama Lengkap" readonly autocomplete="off" value="<?= $kode_kategori ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Kategori </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="jenis" placeholder="Masukkan Nama Lengkap"  autocomplete="off" value=""  class="form-control">
                                </div>
                                <input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Tambah Kategori Izin" maxlength="8" hidden>

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
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- selesai modal asset -->
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