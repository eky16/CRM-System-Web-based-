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
                                <form action="<?= base_url('absensi/insert_holiday') ?>" id="form-tambah" method="POST">
                                    <div class="form-row">
    <input type="text" name="createdtime" hidden placeholder="Masukkan Nama Department" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" required>
                                        <div class="form-group col-md-12">
                                            <label for="department"><strong>Tanggal</strong></label>
                                            <input type="text" placeholder="yyyy-mm-dd" id="datepicker" name="tanggal" value="<?php echo $_POST['tanggal']; ?>" autocomplete="off" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Proses</button>
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                                    </div>

                                </form>
                            </div>              
                        </div>
                    </div>
                </div>

  <?php if (!empty ($_POST['tanggal'])): ?>
				<div class="card shadow">
					
					<div class="card-body">
        <form action="<?= base_url('absensi/update_holiday') ?>" id="form-tambah" method="POST">
						<div class="table-responsive">
							<table class="table table-bordered"  width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="150">Nama</td>
										<td width="40">NIK</td>
										<td>Tanggal</td>
										<td>Datang</td>
										<td>Pulang</td>
										<td width="120">Foto</td>
										<td width="150">Lokasi</td>
                                        <td>Lembur</td>
                                        <td width="150">Keterangan</td>
										<?php if ($this->session->login['role'] == 'admin'): ?>
											<td width="10">Aksi</td>
										<?php endif ?>
									</tr>
								</thead>
								<tbody> <div class="form-group">
                                     
									<?php foreach ($all_absensi as $absn): ?>

										<tr>
 <!--  NAMA -->
<td><?= $absn->nama_karyawan ?></td>
 <!--  EMPLOYEEID -->
<td ><input type="text" name="EmployeeID[]" value="<?= $absn->EmployeeID ?>"  readonly required>                  </td> 

<td align="center"><input type="text" name="tanggal[]" value="<?= $_POST['tanggal']; ?>"  readonly required> </td> 
 <!--  CEK IN -->
<td align="center"> <input style="text-align: center; vertical-align: middle; font-weight:bold;" type="text"  name="cek_in[]" <?php 
                            foreach ($absensi as $atndnce_status) {
                            if (!empty($atndnce_status)) {
                            if ($absn->EmployeeID == $atndnce_status->EmployeeID) {
                            ?>
                            <?php if ($atndnce_status) 
                            
                            $att_in = $atndnce_status->cek_in ?>

                      value="<?php echo $att_in;
                            $posisi = $atndnce_status->in_s;
                            $telat = "0.00";
                                if ($posisi > $telat) {
                                echo   ' - TELAT';
                               // Kode program yang dijalankan jika condition_1 berisi nilai True
                                }else { 
                                $xx = '';
                                echo $xx; // Kode program yang dijalankan jika semua kondisi tidak terpenuhi
                                } ?>" > <?php
                                         }
                                    }
                                }
                            ?> </td>
 <!--  CEK OUT -->
<td align="center"><input  style="text-align: center; vertical-align: middle; font-weight:bold;" type="text"  name="cek_out[]" 
                              <?php
                            foreach ($absensi as $atndnce_status) {
                            if (!empty($atndnce_status)) {
                            if ($absn->EmployeeID == $atndnce_status->EmployeeID) {
                            ?>
                            value="<?php if ($atndnce_status) echo $atndnce_status->cek_out ?>" >
                       <?php
                                         }
                                    }
                                }
                            ?></td>
 <!--  FOTO -->                            
<td align="center">
<?php
                            foreach ($absensi as $atndnce_status) {
                            if (!empty($atndnce_status)) {
                            if ($absn->EmployeeID == $atndnce_status->EmployeeID) {
                            ?>
			 <?php if (!empty($atndnce_status->foto)): ?>
<a target="blank" href="<?= base_url('absensi/img_view/' . $atndnce_status->id) ?>" title="Menuju halaman google">
  Datang
</a>
 <?php else : ?>            
<strong> - </strong>             
<?php endif; ?>   /			 <?php if (!empty($atndnce_status->foto2)): ?>
<a target="blank" href="<?= base_url('absensi/img_view_out/' . $atndnce_status->id) ?>" title="Menuju halaman google">
  Pulang
</a>
<?php endif; ?>
			<?php
                                         }
                                    }
                                }
                            ?></td> 	
 <!--  LOKASI -->
<td align="center">
    <?php
                            foreach ($absensi as $atndnce_status) {
                            if (!empty($atndnce_status)) {
                            if ($absn->EmployeeID == $atndnce_status->EmployeeID) {
                            ?>
                   <?php if (!empty($atndnce_status->lokasi)): ?>
												<a target="blank" href="https://www.google.co.id/maps/place/<?= $atndnce_status->lokasi ?>" class="btn btn-primary btn-sm">Datang </a> <?php endif; ?> 
                       <?php if (!empty($atndnce_status->lokasi_cekout)): ?>
												<a target="blank" href="https://www.google.co.id/maps/place/<?= $atndnce_status->lokasi_cekout ?>" class="btn btn-primary btn-sm">Pulang </a><?php endif; ?>  <?php
                                         }
                                    }
                                }
                            ?> </td>
<td><input type="text" name="overtime[]" value=""  readonly></td>
<td><input type="text" name="kategori_izin[]" readonly  <?php
                            foreach ($absensi as $atndnce_status) {
                            if (!empty($atndnce_status)) {
                            if ($absn->EmployeeID == $atndnce_status->EmployeeID) {
                            ?>
                            value="<?php if ($atndnce_status) echo $atndnce_status->jenis ?>" >
                       <?php
                                         }
                                    }
                                }
                            ?> ></td>
											<?php if ($this->session->login['role'] == 'admin'): ?>
												<td>
													<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('asset/hapus/' . $asst->kode_asset) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												</td>
											<?php endif ?>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
                            <button type="submit"  id="simpan" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Direksi Approve</button>
                            </form>
						</div>
					</div>				
				</div> 
                <?php endif ?>
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