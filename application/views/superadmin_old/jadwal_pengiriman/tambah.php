<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('user/barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('jadwal_pengiriman') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('jadwal_pengiriman/proses_tambah_jadwal') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										
											<?php  $codek =  random_string('numeric', 5);
                                    $code = $codek ; ?>
		
									<input type="text" name="id_pengiriman" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?php 
                                        $kodeTransaksi_pr = 'SCH'.$code;
                                        echo $kodeTransaksi_pr;  ?>" maxlength="5" hidden>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Tanggal</strong></label>
											<input  type="date" name="tgl_pengiriman" placeholder="Masukkan Nama Barang" autocomplete="off"  class="form-control" required>
										</div>
																				<div class="form-group col-md-6">
											<label for="stok"><strong>Waktu</strong></label>
											<input type="time" name="waktu_pengiriman" placeholder="Masukkan Stok" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">

										<div class="form-group col-md-12">
											<label for="satuan"><strong>Proyek</strong></label>
											<select name="project_id" id="project" class="form-control" required>
														 <option value="" >PILIH .....</option>
										            <?php foreach ($proyek as $prk) : ?>
										                    <option value="<?php echo $prk->id_lsp ?>"
										          ><?php echo $prk->nama_project ?></option>
										            <?php endforeach; ?>
											</select>

										</div>	
									</div>
									<div class="form-row">

										<div class="form-group col-md-12">
											<label for="satuan"><strong>Keterangan</strong></label>
											<textarea class="form-control" name="ket_pengiriman" required> </textarea>

										</div>	
									</div>
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
									</div>
								</form>
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
</body>
</html>