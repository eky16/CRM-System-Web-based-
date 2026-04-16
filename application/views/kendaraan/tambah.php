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
			<div id="content" data-url="<?= base_url('customer') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>
				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('kendaraan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('kendaraan/proses_tambah') ?>"  id="from1" name="form" method="POST">
							
								

									<div class="form-row">

										

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama kendaraan</strong></label>
											<input type="text" name="nama_kendaraan" placeholder="Masukkan Nama kendaraan" autocomplete="off" id="id-nama" maxlength="50"  class="form-control" >
										</div>

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nomor kendaraan</strong></label>
											<input type="text" name="nomor_kendaraan" placeholder="Masukkan No kendaraan" autocomplete="off" maxlength="50"  class="form-control" >
										</div>
						
									<hr>

									<div class="form-group col-6" >
										<label>Status </label>
										<select name="status_kendaraan" class="form-control" required>
											<option value="">Pilih...</option>
											<option value="aktif" <?php
											if (!empty($kendaraan_id->status_kendaraan)) {
												echo $kendaraan_id->status_kendaraan == 'aktif' ? 'selected' : '';
											}
										?>>AKTIF</option>
										<option value="nonaktif" <?php
										if (!empty($kendaraan_id->status_kendaraan)) {
											echo $kendaraan_id->status_kendaraan == 'nonaktif' ? 'selected' : '';
										}
									?>>NON - AKTIF</option>
								</select>
							</div>
									</div>
						
									<div class="form-row">
						
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

                                    <script>
                                        document.querySelector('#from1').addEventListener('submit', function(e) { 
                                            var form = this;
                                            var input = $('#from1').serialize();
                                            e.preventDefault();

                                            swal({
                                                title: "Are you sure?",
                                                text: "Customer Akan Disimpan",
                                                icon: "warning",
                                                buttons: [
                                                    'No, cancel it!',
                                                    'Yes, I am sure!'
                                                    ],
                                                dangerMode: true,
                                            }).then(function(isConfirm) {
                                                if (isConfirm) {
                                                    swal({
                                                        title: 'Success!',
                                                        text: 'Customer Berhasil Disimpan, Sukses!',
                                                        icon: 'success'

                                                    }).then(function(data) {
                                                        window.setTimeout(function() { document.form.submit(); }, 1000);        
                                                    })
                                                }  else {
                                                    swal("Cancelled", "Customer tidak ada perubahan :)", "error");
                                                }
                                            });
                                        });


                                    </script> <!-- selesai modal asset -->
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>