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
					<div class="card-header"><strong>DATA IZIN  </strong></div>


					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable"  width="100%" cellspacing="0">
								 <thead>
                                <tr>
                                    <th class="col-sm-1">No</th>
                                    <th class="col-sm-2">Kode</th>
                                    <th class="col-sm-2">Tgl Pengajuan</th>
                                    <th >Nama</th> 
                                    <th >Atasan</th>
                                    <th >Jenis</th> 
                        
                                    <th class="col-sm-2" align="center">Aksi</th>     
                                </tr>
                            </thead>
								  <tbody>                                                        
                                <?php foreach ($atasan as $key => $izin) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $izin->kode_izin ?></td>
                                        <td><?php echo $izin->tgl_pengajuan ?></td>
                                         <td><?php echo $izin->nama_karyawan ?></td>
                                        <td><?php echo $izin->supervisorID ?></td>
                                         <td><?php echo $izin->kategori ?></td>
                      
                                        <td align="center">

                                        <a  data-toggle="modal" style="color:white" data-target="#person_adm<?php echo $izin->kode_izin; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Detail</a>
										
										<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('izin/hapus/' . $izin->kode_izin) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                                       
                                    </tr>
<!-- modal update -->
	
<div id="person_adm<?php echo $izin->kode_izin; ?>" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">DETAIL IZIN</h4>

        </div>
<form action="<?= base_url('izin/proses_approve') ?>" id="form-tambah" method="POST">
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $izin->nama_karyawan ?> - <?= $izin->EmployeeID ?> 

                                    <?php if ($izin->status == 1 ) : ?>
                                    <a  data-toggle="modal" style="color:white"  class="btn btn-warning btn-sm"><i class="fa fa-circle"></i>&nbsp;&nbsp;Persetujuan Atasan</a> <?php endif; ?>
                                     <?php if ($izin->status == 2 ) : ?>
                                    <a  data-toggle="modal" style="color:white"  class="btn btn-info btn-sm"><i class="fa fa-circle"></i>&nbsp;&nbsp;Persetujuan Hrd</a><?php endif; ?> 
                                    <?php if ($izin->status == 3 ) : ?>
                                    <a  data-toggle="modal" style="color:white"  class="btn btn-success btn-sm"><i class="fa fa-circle"></i>&nbsp;&nbsp;Disetujui</a><?php endif; ?> 
                                    <?php if ($izin->status == 4 ) : ?>
                                    <a  data-toggle="modal" style="color:white"  class="btn btn-danger btn-sm"><i class="fa fa-circle"></i>&nbsp;&nbsp;Ditolak</a><?php endif; ?> 
                                </h6>

                                </div>
                                <div class="card-body">
                        <?php if (!empty($izin->atasan_mengetahui) AND empty($izin->hrd_menyetujui)  AND $izin->status == 4 ): ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Atasan Menolak </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="kode_kategori" placeholder="Masukkan Nama Lengkap" readonly autocomplete="off" value="<?= $izin->atasan_mengetahui .' - '.$izin->atasan_waktu  ?>"  class="form-control">
                                </div><?php endif; ?>

  
                                     
                        <?php if (!empty($izin->atasan_mengetahui) AND $izin->status != 4 ): ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Atasan Mengetahui </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="kode_kategori" placeholder="Masukkan Nama Lengkap" readonly autocomplete="off" value="<?= $izin->atasan_mengetahui .' - '.$izin->atasan_waktu  ?>"  class="form-control">
                                </div><?php endif; ?>


                        <?php if (!empty($izin->hrd_menyetujui) AND $izin->status != 4 ): ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Hrd Menyetujui </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="kode_kategori" placeholder="Masukkan Nama Lengkap" readonly autocomplete="off" value="<?= $izin->hrd_menyetujui .' - '.$izin->hrd_waktu  ?>"  class="form-control">
                                </div><?php endif; ?>

                        <?php if (!empty($izin->hrd_menyetujui) AND $izin->status == 4 ): ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Hrd Menolak </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="kode_kategori" placeholder="Masukkan Nama Lengkap" readonly autocomplete="off" value="<?= $izin->hrd_menyetujui .' - '.$izin->hrd_waktu  ?>"  class="form-control">
                                </div><?php endif; ?>
<input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="nama_karyawan" placeholder="Masukkan Nama Lengkap" hidden autocomplete="off" value="<?= $izin->nama_karyawan ?>"  class="form-control">
<input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="EmployeeID" placeholder="Masukkan EmployeeID" hidden autocomplete="off" value="<?= $izin->EmployeeID ?>"  class="form-control">
<input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="tanggal" placeholder="Masukkan Nama Lengkap" hidden autocomplete="off" value="<?= $izin->tanggal ?>"  class="form-control">
<input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="dan_tanggal" placeholder="Masukkan Nama Lengkap" hidden autocomplete="off" value="<?= $izin->dan_tanggal ?>"  class="form-control">
<input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="dan_waktu" placeholder="Masukkan Nama Lengkap" hidden autocomplete="off" value="<?= $izin->dan_waktu ?>"  class="form-control">
<input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="waktu" placeholder="Masukkan Nama Lengkap" hidden autocomplete="off" value="<?= $izin->waktu ?>"  class="form-control">
<input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="id_izin" placeholder="Masukkan Nama Lengkap" hidden autocomplete="off" value="<?= $izin->id_izin ?>"  class="form-control">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Kode </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="kode_izin" placeholder="Masukkan Nama Lengkap" readonly autocomplete="off" value="<?= $izin->kode_izin ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Tgl Pengajuan </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="tgl_pengajuan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $izin->tgl_pengajuan ?>" readonly class="form-control">
                                </div>
 
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Jenis </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="kategori" placeholder="Masukkan Nama Lengkap" readonly autocomplete="off" value="<?= $izin->kategori ?>"  class="form-control">
                                </div> 

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Tanggal </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $izin->tanggal .' & ' .$izin->dan_tanggal ?>" readonly class="form-control">
                                </div>
                        
                               <?php if (!empty($izin->waktu)): ?>  
                         <div class="form-group col-md-8">
                            <label for="nama_barang"><strong> Pukul </strong></label>
                                             <div id="inputFormRow">
                        <div class="input-group mb-12">
                        <div class="input-group-append">
                               <input type="text" readonly name="" value="<?= $izin->waktu ?>" class="form-control m-input" autocomplete="off">
                            </div>
                            <input type="text"  readonly name="buntut_nik" class="form-control m-input" placeholder="" value="- <?= $izin->dan_waktu ?>" autocomplete="off" required >
                        </div>
                    </div>
                                </div> <?php endif; ?> 
                         
                     <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Alasan </strong></label>
                                   <textarea  name="alasan" class="form-control" readonly><?= $izin->alasan  ?></textarea>
                                </div>
                     <?php if (!empty($izin->berkas)): ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Berkas </strong></label>
                                             <a href="<?php echo base_url(); ?>img/uploads/doc_izin/<?= $izin->berkas ?>" target="_blank" style="text-decoration: underline;"> Lihat <?= $izin->berkas ?> </a>
                                </div> </div><?php endif; ?> 

    <?php if ($izin->status == 2  and $this->session->login['akses'] == 'superadmin') : ?>
                            <div class="form-group col-12">
                                            <label><strong>Aksi</strong></label>
                            <select name="status" class="form-control" required>
                            <option value="">Pilih ...</option>
                            <option value="3" <?php
                            if (!empty($employee_info->status)) {
                                echo $employee_info->status == '3' ? 'selected' : '';
                            }
                            ?>>Menyetujui</option>
                            <option value="4" <?php
                            if (!empty($employee_info->status)) {
                                echo $employee_info->status == '4' ? 'selected' : '';
                            }
                            ?>>Tolak</option>
                            </select>

                                </div>
                        <input type="text" id="datepicker" name="atasan_mengetahui" value="<?= $izin->atasan_mengetahui ?>"  class="form-control" hidden>    
                        <input type="text" id="datepicker" name="atasan_waktu" value="<?= $izin->atasan_waktu ?>"  class="form-control" hidden>

                        <input type="text" id="datepicker" name="hrd_menyetujui" value="<?php echo  $this->session->login['nama'] ?>"  class="form-control" hidden>    
                        <input type="text" id="datepicker" name="hrd_waktu" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>
                        <input type="text" id="datepicker" name="waktu_log" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>
                            <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>
                            
                            </div><?php endif; ?> 
        <?php if ($izin->status == 1  and $this->session->login['akses'] !== 'superadmin') : ?>
                            <div class="form-group col-12">
                                            <label><strong>Aksi</strong></label>
                            <select name="status" class="form-control" required>
                            <option value="">Pilih ...</option>
                            <option value="2" <?php
                            if (!empty($employee_info->status)) {
                                echo $employee_info->status == '2' ? 'selected' : '';
                            }
                            ?>>Mengetahui</option>
                            <option value="4" <?php
                            if (!empty($employee_info->status)) {
                                echo $employee_info->status == '4' ? 'selected' : '';
                            }
                            ?>>Tolak</option>
                            </select>

                                </div>

                        <input type="text" id="datepicker" name="atasan_mengetahui" value="<?php echo  $this->session->login['nama'] ?>"  class="form-control" hidden>    
                        <input type="text" id="datepicker" name="atasan_waktu" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>
                        <input type="text" id="datepicker" name="waktu_log" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>
                            
                                    </div><?php endif; ?> 
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
						</div> </div>      

     
							
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