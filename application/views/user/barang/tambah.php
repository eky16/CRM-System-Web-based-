<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('user/partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('user/partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('user/barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('user/barang') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/barang/proses_tambah_barang') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-3">
											<label for="kode_product"><strong>Kode Barang</strong></label>
											<input type="text" name="kode_product" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= mt_rand(10000000, 99999999) ?>" maxlength="8" >
										</div>

										<div class="form-group col-md-5" >
                                            <label for="kategori"><strong>Kategori Barang </strong></label> 
                                            <select name="kategori" class="form-control" required>
                                                <option value="" selected>Pilih Kategori Barang</option>

                                                <option value="Custom" <?php echo ($row->kategori == 'Custom') ? 'selected' : ''; ?>>Custom</option>

                                                <option value="Original" <?php echo ($row->kategori == 'Original') ? 'selected' : ''; ?>>Original</option>
                                                <option value="Pintu" <?php echo ($row->kategori == 'Pintu') ? 'selected' : ''; ?>>Pintu</option>

                                                
                                            </select>
                                        </div>
                                        
                                     

										<div class="form-group col-md-6">
											<label for="item"><strong>Nama Barang</strong></label>
											<input onkeyup="this.value = this.value.toUpperCase()" type="text" name="item" placeholder="Masukkan Nama Barang" autocomplete="off"  class="form-control" required>
										</div>	
										
									</div>

								<!--		<div class="form-group col-md-6">
											<label for="satuan"><strong>Satuan</strong></label>

											<select name="satuan" id="satuan" class="form-control" required>
													<option value="">--Pilih Satuan--</option>
														<?php foreach ($satuan_name as $row): ?>
															<option value="<?= $row->nm_satuan ?>"><?= $row->nm_satuan ?></option>
														<?php endforeach ?>
													</select>
										</div> -->
	                                    
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
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
</body>
</html>