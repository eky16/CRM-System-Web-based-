<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
</head>
<?php error_reporting(0);  ?>
<body id="page-top">


	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('asst') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right"> 
                         <a href="<?= base_url('user/reimburs/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
				   <button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button> 
					
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
					<div class="card-header"><strong>LIST REIMBURSEMENT  </strong></div>


					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered"   width="100%" cellspacing="0">
								 <thead>
                                <tr>
                                    <th class="col-sm-1">No</th>
                                    <th class="col-sm-2">Kode</th>
                                    <th class="col-sm-2">Karyawan</th>
                                    <th class="col-sm-2">Nama Project</th>
                                    <th >Nominal</th> 
                                    <th >Status</th> 

                        
                                    <th class="col-sm-2" align="center">Aksi</th>     
                                </tr>
                            </thead>
								  <tbody>                                                        
                               <?php  foreach ($all_department_info as $akey => $v_department_info) : ?>                                                       
                                <?php foreach ($v_department_info as $key => $v_department) : ?>

                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $v_department->kode_reimbus ?></td>
                                        <td><?php echo $v_department->user_reimbus ?></td>
                                        <td><?php echo $v_department->kategori_reimburs ?></td>
                                        <td><?php
                                             $hasil_rupiah = "Rp " . number_format($v_department->nominal,2,',','.');
                                              echo $hasil_rupiah; ?></td>
                                        <td><?php echo $v_department->status_cek ?></td>
                      
                                        <td align="center">

                                        <a  data-toggle="modal" style="color:white" data-target="#right_modalupdate<?php echo $v_department->id_sub; ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i>&nbsp;&nbsp;Detail</a>
									</td>                                       
                                    </tr>
<!-- modal update -->	

<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalupdate<?php echo $v_department->id_sub; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Reimbursement : <?php echo $v_department->kategori_reimburs; ?></h5>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Created. <?php echo $v_department->createddate_reimbus; ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Jenis </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kode_lap" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->kategori_reimburs; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nama proyek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="tgl_laporan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->name_project; ?>"  class="form-control">
                                </div>

<?php if($v_department->kategori_reimburs == "BENSIN (Kendaraan Pribadi)" ): ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Kilometer Awal </label>
                                          <a target="blank" href="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_reimburs ?>">   <img  src="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_reimburs ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Kilometer Akhir </label>
                               <a target="blank" href="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_km_after ?>">   <img  src="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_km_after ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Total Kilometer </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="tgl_laporan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->total_km; ?>"  class="form-control">
                                </div> <?php endif; ?>

<?php if($v_department->kategori_reimburs != "BENSIN (Kendaraan Pribadi)" ): ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Foto </label>
                                         <a target="blank" href="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_reimburs ?>">   <img  src="<?php echo base_url(); ?>img/uploads/reimburs/<?= $v_department->foto_reimburs ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>

                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nominal </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="tgl_laporan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php
                                             $hasil_rupiah = "Rp " . number_format($v_department->nominal,2,',','.');
                                              echo $hasil_rupiah; ?>"  class="form-control">
                                </div>
                                              <?php if(!empty($v_department->nominal_tf)):?>
                  <div class="form-group col-md-12">
                                            <label for="nama_barang"><font color="red">Nominal Transfer </font></label>
                                             <input  type="text" maxlength="50" readonly  name="nominal_tf" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php
                                             $hasil_rupiah = "Rp " . number_format($v_department->nominal_tf,2,',','.');
                                              echo $hasil_rupiah; ?>"  class="form-control">
                                </div>
                                  <div class="form-group col-md-12">
                                            <label for="nama_barang"><font color="red">Catatan *</font></label>
                                        <textarea readonly name="keterangan_proyek" class="form-control" ><?php
                                        if (!empty($v_department->catatan)) {
                                            echo $v_department->catatan;
                                        }
                                        ?></textarea>
                                </div>
                        <?php endif; ?> <?php endif; ?>
                                
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea readonly name="keterangan_proyek" class="form-control" ><?php
			                            if (!empty($v_department->keterangan)) {
			                                echo $v_department->keterangan;
			                            }
			                            ?></textarea>
									</div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Status </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="tgl_laporan" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->status_cek ?>"  class="form-control">
                                </div>

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
                                   <?php  endforeach; ?>   <?php endforeach; ?>
                                                           
                        </tbody>
							</table>
                      <table class="table table-bordered"   width="100%" cellspacing="0">
                                 <thead>
                                <tr>
                                     <?php foreach ($hitung_reimbus as $key => $total) : ?>
                                    <th class="col-sm-1">Total Yang Harus Transfer  </th>
                                    <th class="col-sm-2"><?php
                                             $hasil_rupiah = "Rp " . number_format($total->total_reimburs,2,',','.');
                                              echo $hasil_rupiah; ?></th>
                                               <th class="col-sm-1" align="center">
         <?php if($total->status_reimbus == 3 OR $total->status_reimbus == 4) : ?>

                <a  data-toggle="modal" style="color:white" data-target="#right_modalpay<?php echo $total->kode_reimbus; ?>" class="btn btn-info btn-sm"><i class="fa fa-check-circle" style="font-size:15px;color:green"></i>&nbsp;<i class="fa fa-credit-card"></i>&nbsp;&nbsp;Telah Di Transfer</a>
        <?php else: ?>                                      
            <a  data-toggle="modal" style="color:white" data-target=" ?>" class="btn btn-warning btn-sm"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Sedang Diproses</a>
               <?php endif; ?>     

        </th>
<!-- modal update System -->
<div  class="modal modal-right fade" id="right_modalpay<?php echo $total->kode_reimbus; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Bukti Transfer : <?php echo $total->kode_reimbus; ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('reimburs/save_proses_transfer') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $total->user_reimbus; ?>. <?php echo $total->createddate_reimbus; ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">ID </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kode_reimbus" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $total->kode_reimbus; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nama Karyawan </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $total->user_reimbus; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Bank & No Rek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $total->bank.' - '.$total->no_rek; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Nama proyek </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->name_project; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Total Harus Dibayar  </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php
                                             $hasil_rupiah = "Rp " . number_format($total->total_reimburs,2,',','.');
                                              echo $hasil_rupiah; ?>"  class="form-control">
                                </div>
                     <?php if($total->status_reimbus == 2) : ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Bukti Transfer </label>
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
      <input type="hidden" name="old_path" value="<?php
                                if (!empty($employee_info->photo_a_path)) {
                                    echo $employee_info->photo_a_path;
                                }
                                ?>">
  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name="berkas" onchange="readURL(this);" accept="image/*" />
    <div class="drag-text">
      <h3>Drag and drop a file or select add Image</h3>
    </div>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
</div>
  <?php else: ?> 

                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Bukti Transfer </label>
                                          <a target="blank" href="<?php echo base_url(); ?>img/uploads/<?= $total->bukti_bayar ?>">   <img  src="<?php echo base_url(); ?>img/uploads/<?= $total->bukti_bayar ?>" style="width:100%;cursor:-webkit-grab; cursor: grab;" ></a>
                                </div>
                                
     <?php endif; ?>
      <?php if($total->status_reimbus == 3 OR $total->status_reimbus == 4) : ?>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">TransferBy </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->user_bayar; ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tgl Transfer </label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php echo $v_department->tgl_bayar; ?>"  class="form-control">
                                </div>

         <?php endif; ?>
                                

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

                                        <hr>
            <?php if($total->status_reimbus == 2) : ?>
           <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                    </div>
        <?php else: ?>                                      
          <div class="form-group">
                                        <button disabled type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Sudah Ditransfer</button>
                                    </div>
               <?php endif; ?>                     
                              
                       
   
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
                                    <?php  endforeach; ?>
                                </tr>
                            </thead>
                                 </table>
						</div> </div>      

     
							
				</div>
				</div>
			</div>

			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>