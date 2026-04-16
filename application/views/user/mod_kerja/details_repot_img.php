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
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
   	<?php if($asst->status == 2): ?>
							<a  data-toggle="modal" style="color:white" data-target="#right_modal" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Upload Foto</a>
<?php endif; ?>
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
     <div class="row">

<div  class="modal modal-right fade" id="right_modal" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Laporan Progress</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/reimburs/save_laporan_daily') ?>" enctype="multipart/form-data" method="POST">
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
 <!-- untuk notifikasi ke pembuat -->
<input type="text" maxlength="50" hidden name="link" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $asst->kode_daily ?>"  class="form-control">
<input type="text" maxlength="50" hidden name="kepada" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $asst->dibuat ?>"  class="form-control">
<input type="text" maxlength="50" hidden name="dari" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $this->session->login['nama'] ?>"  class="form-control">
<input type="text" maxlength="50" hidden name="creat_at" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control">
<input type="text" maxlength="50" hidden name="noted" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="Upload Img ,<?= $asst->proyek ?>"  class="form-control">
 <!-- untuk notifikasi ke pembuat -->
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Kode </label>
                                             <input type="text" maxlength="50" readonly name="kode_daily[]" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $asst->kode_daily ?>"  class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="tgl_upload[]" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control">
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Berkas </strong></label>
                                       <input type="file" name="berkas[]"  placeholder="foto reimburs" autocomplete="off" value=""  class="form-control" >
                                </div>
										<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="keterangan[]" class="form-control " ></textarea>
									</div>
									<div class="form-group col-12">
						<div id="newRow"></div>
                    <button id="addRow" type="button" class="btn btn-info">Tambah Foto</button>
						</div>
                   

                                <input type="text" name="createdby[]" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text"  name="createdtime[]" value="<?php date_default_timezone_set('Asia/Jakarta');
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
  <script type="text/javascript">
        // add row


        $("#addRow").click(function () {
            var html = '';
         
            html += '<input type="text" hidden name="kode_daily[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $asst->kode_daily ?>"  class="form-control" required>'; 
            html += '<input type="text" hidden name="tgl_upload[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d');
                                        ?>"  class="form-control" required>';
            html += '<input type="text" hidden name="createdtime[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>';
            html += '<input type="text" hidden name="createdby[]" readonly placeholder="Masukkan Nama Department" autocomplete="off" value="<?= $this->session->login['nama'] ?>"  class="form-control" required>';                                 
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
     
            html += '</div>';

            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="file" name="berkas[]"  placeholder="Masukkan Nominal" autocomplete="off" value=""  class="form-control" required>';
                        html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';
   
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '	<textarea  name="keterangan[]" class="form-control " ></textarea>';

            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>                      

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
		 			<div class="col-lg-6 mb-4">
                            <!-- Project Card Example -->
           				<div class="card shadow">
					<div class="card-header"><strong>CASSA DESIGN</strong></div>

					<div class="card-body">
	   <div class="form-row">
	   	  																<div class="form-group col-md-4">
                                            <label ><strong>Tanggal</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                           <?php echo date('Y-m-d', strtotime($asst->waktu)); ?>
                                        </div>
                                      		<div class="form-group col-md-4">
                                            <label ><strong>Kode</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                          <?= $asst->kode_daily ?>
                                        </div>
                           							<div class="form-group col-md-4">
                                            <label ><strong>Proyek</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                          <?= $asst->proyek ?>
                                        </div>
                                         <div class="form-group col-md-4">
                                            <label ><strong>Jumlah</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                        <?= $asst->jumlah_foto ?>/Hari
                                        </div>
	   </div>
					</div>				
				</div>
				</div>
		 			<div class="col-lg-6 mb-4">
                            <!-- Project Card Example -->
           				<div class="card shadow">
					<div class="card-header"><strong>CASSA DESIGN</strong></div>

					<div class="card-body">
	   <div class="form-row">
	   	  																<div class="form-group col-md-4">
                                            <label ><strong>Moderator</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                          <?= $asst->dibuat ?>
                                        </div>
                                      		<div class="form-group col-md-4">
                                            <label ><strong>Penerima</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                          <?= $asst->nama_karyawan ?>
                                        </div>
                           							<div class="form-group col-md-4">
                                            <label ><strong>Durasi Pekerjaan</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                          <?= $asst->durasi ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label ><strong>Sisa Durasi</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                     <?php 
                                            $start_date = new DateTime($asst->durasi);
                                            $end_date = new DateTime(date('Y-m-d'));
                                            $y = $end_date->diff($start_date)->y;
                                            // bulan
                                            $m = $end_date->diff($start_date)->m;
                                            // hari
                                            $d = $end_date->diff($start_date)->d;
                                           
                                            ?>	
                          <?php if($asst->status == 1 OR  $asst->status == 2): ?>      	
								<?php if($start_date > $end_date OR $start_date == $end_date): ?>
								<span class="badge badge-secondary"><?php  echo "  " . $m . " bulan " . $d . " hari"; ?></span>	
								<?php else: ?>
									<span class="badge badge-danger">Expired</span>
								<?php endif;?>
							<?php else: ?>
								<span class="badge badge-success">Finish</span>	<?php endif;?>
                                        </div>
	   </div>
					</div>				
				</div>
				</div>
</div>
                       <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header"><strong>Filter Laporan Foto..</strong></div>
                            <div class="card-body">
                                 <form action="" enctype="multipart/form-data" id="form-tambah" method="POST" >
                                    <div class="form-row">

                                        <div class="form-group col-md-3">
                                            <label for="department"><strong>Dari Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd"  name="tanggal" value="<?php echo $_POST['tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="department"><strong>Sampai Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd"   name="dan_tanggal" value="<?php echo $_POST['dan_tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>
                                        <?php if (!empty($_POST['tanggal'])): ?>
																				<span class="badge badge-info"><?= $count_foto ?> Image Found</span>
                                        <?php endif; ?>

 
                                    </div>


                                </form>
                            </div>              
                        </div>
                    </div>
                </div>    
           <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">LAPORAN FOTO </h6>
                                </div>
                                <div class="card-body">
                               	<div class="form-row">
	<?php foreach ($laporan_foto as $emp): ?>
       <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="bg-white rounded shadow-sm"><a target="_blank" href="<?php echo base_url(); ?>img/uploads/<?= $emp->foto ?>">   <img  src="<?php echo base_url(); ?>img/uploads/<?= $emp->foto ?>" style="width:100%;height:150px;cursor:-webkit-grab; cursor: grab;" ></a>
          <div class="p-4">
      
            <p class="small text-muted mb-0"><?= $emp->ket_daily ?></p>
            <div class="d-flex align-items-center justify-content-between rounded-pill bg-light px-3 py-2 mt-4">
          <div class="badge badge-danger px-3 rounded-pill font-weight-normal"> <?= $emp->createdtime ?> </div>
            </div>
          </div>
        </div>
      </div>
<?php endforeach; ?>

</div>
                                    </div>
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