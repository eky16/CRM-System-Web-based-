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
			<div id="content" data-url="<?= base_url('barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('barang/proses_ubah/' . $barang->No) ?>" id="form-tambah" method="POST">
									<input type="text" name="No" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?php echo $barang->No ?>" maxlength="8" hidden>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_barang"><strong>Kode Barang</strong></label>
											<input type="text" name="Kode_Barang" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?php echo $barang->Kode_Barang ?>" maxlength="8" >
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Barang</strong></label>
											<input type="text" name="Nama_Barang" placeholder="Masukkan Nama Barang" autocomplete="off"  class="form-control" required value="<?= $barang->Nama_Barang ?>">
										</div>

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Warna</strong></label>
											<input type="text" name="Warna_barang" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $barang->Warna_barang ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Minimum</strong></label>
											<input type="text" name="Min" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $barang->Min ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Maximum</strong></label>
											<input type="text" name="Max" placeholder="Maximum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $barang->Max ?>">
										</div>
											<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Satuan</strong></label>
											<input type="text" name="Satuan" placeholder="Masukkan Nama Barang" autocomplete="off"  class="form-control" required value="<?= $barang->Satuan ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Stok</strong></label>
											<input type="text" name="Stok" placeholder="Jumlah Stok Barang" autocomplete="off"  class="form-control" required value="<?= $barang->Stok ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Blok</strong></label>
											<input type="text" name="Blok" placeholder="Blok" autocomplete="off"  class="form-control" required value="<?= $barang->Zona ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Lantai</strong></label>
											<input type="text" name="Lantai" placeholder="Lantai" autocomplete="off"  class="form-control" required value="<?= $barang->Lantai ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Baris</strong></label>
											<input type="text" name="Baris" placeholder="Baris" autocomplete="off"  class="form-control" required value="<?= $barang->Baris ?>">
										</div>
												<div class="form-group col-md-6">
											<label for="nama_barang"><strong></strong></label>
											<button type="submit" class="btn btn-primary form-control"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										</div>
									</div>
				
									<hr>
									<div class="form-group">
								
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