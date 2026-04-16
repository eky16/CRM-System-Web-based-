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
			<div id="content" data-url="<?= base_url('user/customer') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>
				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('user/customer') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/customer/proses_tambah') ?>"  id="from1" name="form" method="POST">

								<div class="form-row">
										<div class="form-group col-md-3">
											<label for="kode_barang"><strong>Kode Customer</strong></label>
											<input type="text" name="kode_cst" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?php  $decode =  random_string('numeric', 5);
                                            $code = "P".$decode; echo $code; ?>"  maxlength="8" readonly>
										</div>

										<div class="form-group col-md-3">
											<label ><strong>User</strong></label>
											<input type="text" name="creatby_cst" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" readonly>
										</div>
										
										<div class="form-group col-6">
										<label>Date Create</label>
										<input type="text" readonly name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
		                                echo date('Y-m-d  H:i:s');
		                                ?>"  class="form-control">
											</div>
									</div>
							
								

									<div class="form-row">

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Customer</strong></label>
											<input type="text" name="nama_cst" placeholder="Masukkan Nama Customer" autocomplete="off" id="id-nama" maxlength="50"  class="form-control" >
										</div>

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Email</strong></label>
											<input type="text" name="email_cst" placeholder="Masukkan Email" autocomplete="off" maxlength="50"  class="form-control" >
										</div>
										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Tlp</strong></label>
											<input type="tel" name="no_tlp_cst" placeholder="Masukkan No Tlp" autocomplete="off" maxlength="50"  class="form-control"         oninput="this.value = this.value.replace(/[^0-9+]/g, '').slice(0, this.maxLength);"
>
										</div>

										<div class="form-group col-6">
													<label for="wilayah"><strong>Kota/Kabupaten</strong></label>
											<input type="text" name="nama_wilayah" id="wilayah" class=" form-control" list="wilayah1" autocomplete="off"> 
											<datalist id="wilayah1" >
											<option value="">Pilih Kota/Kabupaten</option>
														<?php foreach ($wilayah as $row): ?>
														<option value="<?= $row->nama ?>"></option>
														<?php endforeach ?>
    										</datalist>
													
												</div>

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Perusahaan</strong></label>
											<input type="text" name="nama_perusahaan" placeholder="Masukkan Nama Perusahaan" autocomplete="off" id="id-nama" maxlength="50"  class="form-control" >
										</div>

										<div class="form-group col-6">
													<label for="wilayah"><strong>Sumber Lead</strong></label>
											<input type="text" name="sumber_lead1" id="lead" class=" form-control" list="lead1" autocomplete="off" required> 
											<datalist id="lead1" >
											<option value="">Pilih Sumber Lead</option>
														<?php foreach ($lead as $row): ?>
														<option value="<?= $row->source ?>"></option>
														<?php endforeach ?>
    										</datalist>
													
												</div>

									<!--	<div class="form-group col-6">
											<label>Alamat Project</label>
										<textarea  name="alamat_cst" class="form-control" ><?php
			                            if (!empty($employee_info->alamat_project)) {
			                                echo $employee_info->alamat_project;
			                            }
			                            ?></textarea>
										</div> -->
									<hr>

									<div class="form-group col-6" >
										<label>Status </label>
										<select name="status_cst" class="form-control" required>
											<option value="">Pilih...</option>
											<option value="aktif" <?php
											if (!empty($customer_id->status_cst)) {
												echo $customer_id->status_cst == 'aktif' ? 'selected' : '';
											}
										?>>AKTIF</option>
										<option value="nonaktif" <?php
										if (!empty($customer_id->status_cst)) {
											echo $customer_id->status_cst == 'nonaktif' ? 'selected' : '';
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
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
</body>
</html>