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
			<div id="content" data-url="<?= base_url('user/quotation') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>
				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('user/quotation/list_segment') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/quotation/proses_tambah_status_quo') ?>"  id="from1" name="form" method="POST">

								<div class="form-row">
										<div class="form-group col-md-3">
											<label for="kode_barang"><strong>Kode Source Lead</strong></label>
											<input type="text" name="kd_status" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?php  $decode =  random_string('numeric', 5);
                                            $code = "SQ".$decode; echo $code; ?>"  maxlength="8" readonly>
										</div>

										<div class="form-group col-md-3">
											<label ><strong>User</strong></label>
											<input type="text" name="creatby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" readonly>
										</div>
										
										<div class="form-group col-6">
										<label>Date Create</label>
										<input type="text" readonly name="creattime" value="<?php date_default_timezone_set('Asia/Jakarta');
		                                echo date('Y-m-d  H:i:s');
		                                ?>"  class="form-control">
											</div>
									</div>
							
									<div class="form-row">

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Status Quotation</strong></label>
											<input type="text" name="status" placeholder="Masukkan Nama Source Lead" autocomplete="off" id="id-nama" maxlength="50"  class="form-control" >
										</div>
										

									<hr>

									
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
                                                text: "Source Lead Akan Disimpan",
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
                                                        text: 'Source Lead Berhasil Disimpan, Sukses!',
                                                        icon: 'success'

                                                    }).then(function(data) {
                                                        window.setTimeout(function() { document.form.submit(); }, 1000);        
                                                    })
                                                }  else {
                                                    swal("Cancelled", "Source Lead tidak ada perubahan :)", "error");
                                                }
                                            });
                                        });


                                    </script> <!-- selesai modal asset -->
			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
</body>
</html>