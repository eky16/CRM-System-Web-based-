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
								<form action="<?= base_url('user/barang/proses_ubah/' . $barang->No) ?>" id="form-tambah" method="POST">
									<input type="text" name="No" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?php echo $barang->No ?>" maxlength="8" hidden>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_barang"><strong>Kode Barang</strong></label>
											<input type="text" name="Kode_Barang" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?php echo $barang->Kode_Barang ?>" maxlength="8" >
										</div>

										<div class="form-group col-md-4">
            <label for="type_barang"><strong>Type Barang</strong></label>
            <select name="Type_Barang" class="form-control" required>
                <option value="" selected>Pilih Type Barang</option>
                <option value="BARANG LAIN-LAIN" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'BARANG LAIN-LAIN' ? 'selected' : ''; ?>>BARANG LAIN-LAIN</option>

                <option value="FC" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'FC' ? 'selected' : ''; ?>>FC</option>
                <option value="LC" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'LC' ? 'selected' : ''; ?>>LC</option>
                <option value="SD" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'SD' ? 'selected' : ''; ?>>SD</option>
                <option value="SDG" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'SDG' ? 'selected' : ''; ?>>SDG</option>
                <option value="MF" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'MF' ? 'selected' : ''; ?>>MF</option>
                <option value="DP" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'DP' ? 'selected' : ''; ?>>DP</option>
                <option value="AD-G" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'AD-G' ? 'selected' : ''; ?>>AD-G</option>
                <option value="SC" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'SC' ? 'selected' : ''; ?>>SC</option>
                <option value="SP" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'SP' ? 'selected' : ''; ?>>SP</option>
                <option value="SR" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'SR' ? 'selected' : ''; ?>>SR</option>
                <option value="AD" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'AD' ? 'selected' : ''; ?>>AD</option>
                <option value="PINTU" <?= !empty($barang->Type_Barang) && $barang->Type_Barang == 'PINTU' ? 'selected' : ''; ?>>PINTU</option>
                
            </select>
        </div>



										<div class="form-group col-md-6" hidden>
											<label for="kategori_barang"><strong>Kategori Barang</strong></label>
											<input type="text" name="Kategori_Barang" placeholder="Masukkan Kategori Barang" autocomplete="off"  class="form-control" required value="<?= $barang->Kategori_Barang ?>">
										</div>


										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Barang</strong></label>
											<input type="text" name="Nama_Barang" placeholder="Masukkan Nama Barang" autocomplete="off"  class="form-control" required value="<?= $barang->Nama_Barang ?>">
										</div>

										<div class="form-group col-md-4">
            <label for="Merk_barang"><strong>Merk Barang</strong></label>
            <select name="merk_barang" class="form-control" >
                <option value="" selected>Pilih Type Barang</option>
                <option value="BARANG LAIN-LAIN" <?= !empty($barang->merk_barang) && $barang->merk_barang == 'BARANG LAIN-LAIN' ? 'selected' : ''; ?>>BARANG LAIN-LAIN</option>

                <option value="Alba" <?= !empty($barang->merk_barang) && $barang->merk_barang == 'Alba' ? 'selected' : ''; ?>>Alba</option>
                <option value="Argentum" <?= !empty($barang->merk_barang) && $barang->merk_barang == 'Argentum' ? 'selected' : ''; ?>>Argentum</option>
                <option value="Atlantik" <?= !empty($barang->merk_barang) && $barang->merk_barang == 'Atlantik' ? 'selected' : ''; ?>>Atlantik</option>
                <option value="Zeco" <?= !empty($barang->merk_barang) && $barang->merk_barang == 'Zeco' ? 'selected' : ''; ?>>Zeco</option>
                <option value="Alco" <?= !empty($barang->merk_barang) && $barang->merk_barang == 'Alco' ? 'selected' : ''; ?>>Alco</option>
                <option value="Polos" <?= !empty($barang->merk_barang) && $barang->merk_barang == 'Polos' ? 'selected' : ''; ?>>Polos</option>
                
                
                
            </select>
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

										<?php
                                             $cek_jabatan = trim($emp->divisi . ' ' . $emp->department);

                                             if ($cek_jabatan =='Staff Marketing' || 'Staff PPIC') {
                                                 $readonlyAttribute = ($cek_jabatan == 'Staff Marketing') ? 'readonly' : '';
                                                 ?>
                                        <div class="form-group col-md-6">
                                            <label for="nama_barang"><strong>Stok</strong></label>
                                            <input type="text" name="Stok" placeholder="Jumlah Stok Barang" autocomplete="off" class ="form-control" required value="<?= $barang->Stok ?>" <?= $readonlyAttribute ?>>
                                        </div>
                                             <?php
                                             }
                                             ?>

										
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Zona</strong></label>
											<input type="text" name="Zona" placeholder="Zona" autocomplete="off"  class="form-control"  value="<?= $barang->Zona ?>">
										</div>

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Blok</strong></label>
											<input type="text" name="Blok" placeholder="Blok" autocomplete="off"  class="form-control"  value="<?= $barang->Blok ?>">
										</div>

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Lantai</strong></label>
											<input type="text" name="Lantai" placeholder="Lantai" autocomplete="off"  class="form-control"  value="<?= $barang->Lantai ?>">
										</div>
										<div class="form-group col-md-6"hidden>
											<label for="nama_barang"><strong>0-3 Bulan</strong></label>
											<input type="text" name="nol_tigabulan_qty" placeholder="nol_tigabulan_qty" autocomplete="off"  class="form-control"  value="<?= $barang->nol_tigabulan_qty ?>">
										</div>
										<div class="form-group col-md-6" hidden>
											<label for="nama_barang"><strong>3-6 Bulan</strong></label>
											<input type="text" name="tiga_enambulan_qty" placeholder="tiga_enambulan_qty" autocomplete="off"  class="form-control"  value="<?= $barang->tiga_enambulan_qty ?>">
										</div>
										<div class="form-group col-md-6"hidden>
											<label for="nama_barang"><strong>>6 Bulan</strong></label>
											<input type="text" name="over_6bulan_qty" placeholder="over_6bulan_qty" autocomplete="off"  class="form-control"  value="<?= $barang->over_6bulan_qty ?>">
										</div>
										
										<div class="form-group col-md-6">
                                              <label for="nama_barang"><strong>Keterangan</strong></label>
                                              <textarea name="ket_stok" placeholder="ket.stok" autocomplete="off" class="form-control" ><?= $barang->ket_stok ?></textarea>
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
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
</body>
</html>