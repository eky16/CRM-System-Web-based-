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
                                    <form action="<?= base_url('user/mf/proses_ubah_mf/' . $komponen->no_mf) ?>" id="form-tambah" method="POST">
                                        <input type="text" name="no_mf" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?php echo $komponen->no_mf  ?>" maxlength="8" hidden>
                                        <div class="form-row">

										<div class="form-group col-md-6">
											<label for="Kode_mf"><strong>Kode Barang</strong></label>
											<input type="text" name="kode_mf" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?php echo $komponen->kode_mf ?>" maxlength="8" >
										</div>

										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>Nama Barang</strong></label>
											<input type="text" name="nama_mf" placeholder="Masukkan Nama Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->nama_mf ?>">
										</div>

										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>Warna</strong></label>
											<input type="text" name="warna_mf" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->warna_mf ?>">
										</div>
										<div class="form-group col-md-6">
                                            <label for="Nama_mf"><strong>Stok</strong></label>
                                            <input type="number" name="stok_mf" placeholder="Jumlah Stok Barang" autocomplete="off" class ="form-control" required value="<?= $komponen->stok_mf ?>" <?= $readonlyAttribute ?>>
                                        </div>

										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>TTP A S</strong></label>
											<input type="number" name="TTP_A_S" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->TTP_A_S ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>TTP A D</strong></label>
											<input type="number" name="TTP_A_D" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->TTP_A_D ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>SMPG S</strong></label>
											<input type="number" name="SMPG_S" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->SMPG_S ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>SMPG D</strong></label>
											<input type="number" name="SMPG_D" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->SMPG_D ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>BLKG S</strong></label>
											<input type="number" name="BLKG_S" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->BLKG_S ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>BLKG D</strong></label>
											<input type="number" name="BLKG_D" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->BLKG_D ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>RACK</strong></label>
											<input type="number" name="RACK" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->RACK ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>BOX</strong></label>
											<input type="number" name="BOX" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->BOX ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>CHS.S STAT</strong></label>
											<input type="number" name="CHS_S_STAT" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->CHS_S_STAT ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>CHS.S DIN</strong></label>
											<input type="number" name="CHS_S_DIN" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->CHS_S_DIN ?>">
										</div>

										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>CHS.D DIN</strong></label>
											<input type="number" name="CHS_D_DIN" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->CHS_D_DIN ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>TTP CHS S</strong></label>
											<input type="number" name="TTP_CHS_S" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->TTP_CHS_S ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>TTP CHS D</strong></label>
											<input type="number" name="TTP_CHS_D" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->TTP_CHS_D ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>CNTL S</strong></label>
											<input type="number" name="CNTL_S" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->CNTL_S ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>CNTL D</strong></label>
											<input type="number" name="CNTL_D" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->CNTL_D ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>PNGMN</strong></label>
											<input type="number" name="PNGMN" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" PNGMN value="<?= $komponen->PNGMN ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>RELL</strong></label>
											<input type="text" name="RELL" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->RELL ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong>SAMB. RELL</strong></label>
											<input type="text" name="SAMB_RELL" placeholder="Minimum Stok Barang" autocomplete="off"  class="form-control" required value="<?= $komponen->SAMB_RELL ?>">
										</div>

										<?php
                                             $cek_jabatan = trim($emp->divisi . ' ' . $emp->department);

                                             if ($cek_jabatan =='Staff Marketing' || 'Staff PPIC') {
                                                 $readonlyAttribute = ($cek_jabatan == 'Staff Marketing') ? 'readonly' : '';
                                                 ?>
                                        
                                             <?php
                                             }
                                             ?>

										
										
										<div class="form-group col-md-6">
                                              <label for="nama_barang"><strong>Keterangan</strong></label>
                                              <textarea name="ket_stok" placeholder="ket.stok" autocomplete="off" class="form-control" ><?= $komponen->ket_stok ?></textarea>
                                          </div>

                                      
										<div class="form-group col-md-6">
											<label for="Nama_mf"><strong></strong></label>
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