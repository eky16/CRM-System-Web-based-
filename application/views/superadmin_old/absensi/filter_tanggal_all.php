<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>

<style type="text/css">
    
table td {
  position: relative;
}

table td input {
  position: absolute;
  display: block;
  top:0;
  left:0;
  margin: 0;
  height: 100%;
  width: 100%;
  border: none;
  padding: 10px;
  box-sizing: border-box;
}


</style>
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
						<h1 class="h3 m-0 text-gray-800"><?= $title ?> </h1>
					</div>
					<div class="float-right "> 
						

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
                    <div class="col-md-4">
                        <div class="card shadow">
                            <div class="card-header"><strong>Filter Tanggal!</strong></div>
                            <div class="card-body">
                                 <form action="<?= base_url('absensi/laporan3') ?>" enctype="multipart/form-data" id="form-tambah" method="POST" >
                                    <div class="form-row">

                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd"  name="tanggal" value="<?php echo $_POST['tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="date" placeholder="yyyy-mm-dd"   name="dan_tanggal" value="<?php echo $_POST['dan_tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>

                    <?php if (!empty ($_POST['tanggal'])): ?>                     
                    <a href="<?php echo $url_cetak; ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Export Excel</a>
                  <!--   <a href="<?php echo $url_cetak; ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->   <?php endif ?>
                                    </div>


                                </form>
                            </div>              
                        </div>
                    </div>
                </div>

				<div class="card shadow">
					
					<div class="card-body">
						<div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Nama</td>
                                        <td>Tanggal</td>
                                        <td>Hari</td>
                                        <td>Cek In</td>
                                        <td>Cek Out</td>
                                        <td>Ket</td>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($absensi as $absensi): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $absensi->nama_karyawan ?></td>
                                            <td><?= $absensi->tanggal ?></td>
                                            <td><?php 
                                $daftar_hari = array(
                                 'Sunday' => 'MINGGU',
                                 'Monday' => 'SENIN',
                                 'Tuesday' => 'SELASA',
                                 'Wednesday' => 'RABU',
                                 'Thursday' => 'KAMIS',
                                 'Friday' => 'JUMAT',
                                 'Saturday' => 'SABTU'
                                );
                                $date="$absensi->tanggal";
                                $namahari = date('l', strtotime($date));
                                echo $daftar_hari[$namahari]; ?></td>
                                            <td><?= $absensi->cek_in ?></td>
                                            <td><?= $absensi->cek_out ?></td>
                                            <td><?= $absensi->jenis ?></td>
                                           
                            
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