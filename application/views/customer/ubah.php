<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<style type="text/css">
		#hidden_div { 
    display: none;
}
	</style>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('customer_id') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">

					<button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('customer/proses_ubah/' . $customer_id->id_cst) ?>" id="form-tambah" method="POST">
								<div class="form-row">
										<div class="form-group col-md-3">
											<label for="kode_barang"><strong> Id Customer </strong></label>
											<input type="text" name="id_cst" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?= $customer_id->kode_cst ?>" maxlength="8" readonly>
											<input type="text" name="id_cst" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?= $customer_id->id_cst ?>" maxlength="8" hidden>
										</div>
											<div class="form-group col-md-3">
											<label ><strong>User</strong></label>
											<input type="text" name="creatby_cst" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $customer_id->creatby_cst ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-6">
										<label>Date Create</label>
										<input type="text" readonly name="creattime_cst" value="<?= $customer_id->creattime_cst ?>"  class="form-control">
											</div>
							       <input type="hidden" name="updateby" value="<?php echo  $this->session->login['nama'] ?>">
                             		<input type="hidden" name="updatetime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d  H:i:s');
                                ?>">
									</div>

									<div class="form-row">

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Nama Customer</strong></label>
											<input type="text" name="nama_cst" placeholder="Masukkan Nama Project" autocomplete="off" maxlength="50"  class="form-control" value="<?= $customer_id->nama_cst ?>" required>
										</div>

										<div class="form-group col-6">
											<label>Alamat Customer</label>
										<textarea  name="alamat_cst" class="form-control" ><?= $customer_id->alamat_cst ?></textarea>
										</div>

									<div class="form-group col-6" >
											<label>Telp Customer</label>
											<input  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
											    type = "number"
											    maxlength = "15" name="no_tlp_cst" placeholder="Masukkan No Tlp Kantor"  value="<?= $customer_id->no_tlp_cst ?>"  class="form-control">
										</div>
										<div class="form-group col-6" >
											<label>Status Customer</label>
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
								
					<input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Ubah customer_id Project" maxlength="8" hidden>
                    <input type="hidden" name="user" value="<?php echo  $this->session->login['nama'] ?>">
                    <input type="hidden" name="waktu" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d  H:i:s'); ?>"> 						
									<div class="form-row">
						
									<hr>
									<div class="form-group  ">
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
<script type="text/javascript">
    function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == "LOOSE" ? 'block' : 'none' ;
   
}
</script>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>