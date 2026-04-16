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
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					<button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button>					</div>
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
		 			<div class="col-lg-12 mb-4">
                            <!-- Project Card Example -->
           				<div class="card shadow">
					<div class="card-header"><strong>CASSA DESIGN</strong></div>

					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Tanggal</td>
										<td>Kode</td>
										<td>Proyek</td>
										<td>Jumlah</td>
										<td>Moderator</td>
										<td>Penerima</td>
										<td>Durasi Pekerjaan</td>
										<td>Sisa Durasi</td>
								
									</tr>
								</thead>
								<tbody>
									
										<tr>
											<td width="3"><?= $no++ ?></td>
											<td width="10"><?php echo date('Y-m-d', strtotime($asst->waktu)); ?></td>
											<td width="10"><?= $asst->kode_daily ?></td>
											<td>
												<?php 
												echo $asst->proyek ?></td>
											<td align="center"><?= $asst->jumlah_foto ?>/Hari</td>
											<td><?= $asst->dibuat ?></td>
											<td><?= $asst->nama_karyawan ?></td>
											<td><?= $asst->durasi ?></td>
											<td width="20" align="center">
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
												</td>

			
										</tr>
								</tbody>
							</table>
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
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>