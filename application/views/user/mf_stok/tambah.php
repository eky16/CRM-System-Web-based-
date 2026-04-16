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
			<div id="content" data-url="<?= base_url('user/mf') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('user/mf') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/mf/proses_tambah_mf') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-3">
											<label for="Kode_mf"><strong>Kode Barang</strong></label>
											<input type="text" name="Kode_mf" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= mt_rand(10000000, 99999999) ?>" maxlength="8" >
										</div>

									
                                        
                                        
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>Nama Barang</strong></label>
											<input onkeyup="this.value = this.value.toUpperCase()" type="text" name="Nama_mf" placeholder="Masukkan Nama Barang" autocomplete="off"  class="form-control" required>
										</div>
										
									</div>

									<div class="form-row">
										<div class="form-group col-md-6" >
                                            <label for="Kategori_mf"><strong>Kategori Barang </strong></label> 
                                            <select name="Kategori_mf" class="form-control" required>
                                                <option value="" selected>Pilih Kategori Barang</option>

                                                <option value="Barang Jadi" <?php echo ($row->Kategori_Barang == 'Barang Jadi') ? 'selected' : ''; ?>>Barang Jadi</option>

                                                <option value="Bahan Baku" <?php echo ($row->Kategori_Barang == 'Bahan Baku') ? 'selected' : ''; ?>>Bahan Baku</option>

                                                <option value="Bahan Pembantu" <?php echo ($row->Kategori_Barang == 'Bahan Pembantu') ? 'selected' : ''; ?>>Bahan Pembantu</option>
                                                <option value="Komponen" <?php echo ($row->Kategori_Barang == 'Komponen') ? 'selected' : ''; ?>>Komponen</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
											<label for="Warna_mf"><strong>Warna</strong></label>
											<input type="text" name="Warna_mf" placeholder="Masukkan Warna" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="Stok_mf"><strong>Stock</strong></label>
											<input type="number" name="Stok_mf" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="ttp_a_s"><strong>TTP A S</strong></label>
											<input type="number" name="ttp_a_s" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="ttp_a_d"><strong>TTP A D</strong></label>
											<input type="number" name="ttp_a_d" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="smpg_s"><strong>SMPG S</strong></label>
											<input type="number" name="smpg_s" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="smpg_d"><strong>SMPG D</strong></label>
											<input type="number" name="smpg_d" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="blkg_s"><strong>BLKG S</strong></label>
											<input type="number" name="blkg_s" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="blkg_d"><strong>BLKG D</strong></label>
											<input type="number" name="blkg_d" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="rack"><strong>RACK</strong></label>
											<input type="number" name="rack" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="box"><strong>BOX</strong></label>
											<input type="number" name="box" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="chs_s_stat"><strong>CHS.S STAT</strong></label>
											<input type="number" name="chs_s_stat" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="chs_s_din"><strong>CHS.S DIN</strong></label>
											<input type="number" name="chs_s_din" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="chs_d_din"><strong>CHS.D DIN</strong></label>
											<input type="number" name="chs_d_din" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="ttp_chs_s"><strong>TTP CHS S</strong></label>
											<input type="number" name="ttp_chs_s" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="ttp_chs_d"><strong>TTP CHS D</strong></label>
											<input type="number" name="ttp_chs_d" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="cntl_s"><strong>CNTL S</strong></label>
											<input type="number" name="cntl_s" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="cntl_d"><strong>CNTL D</strong></label>
											<input type="number" name="cntl_d" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="pngmn"><strong>PNGMN</strong></label>
											<input type="number" name="pngmn" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="rell"><strong>RELL</strong></label>
											<input type="number" name="rell" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="samb_rell"><strong>SAMB. RELL</strong></label>
											<input type="number" name="samb_rell" placeholder="Masukkan Stok" autocomplete="off" value="0" class="form-control" required>
										</div>

										<div class="form-group col-md-6">
											<label for="Satuan_mf"><strong>Satuan</strong></label>

											<select name="Satuan_mf" id="Satuan_mf" class="form-control" required>
													<option value="">--Pilih Satuan--</option>
														<?php foreach ($satuan_name as $row): ?>
															<option value="<?= $row->nm_satuan ?>"><?= $row->nm_satuan ?></option>
														<?php endforeach ?>
													</select>
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
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
</body>
</html>