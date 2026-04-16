<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	   <style type="text/css">
body {
  font-family: sans-serif;

}

.file-upload {
  background-color: #A9A9A9;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #A9A9A9;
  border: none;
  padding: 7px;
  border-radius: 4px;
  border-bottom: 4px solid #A9A9A9;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #adade2;
  color: #636367;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
} 
.file-upload-input1 {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}
.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #636367;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #eff0f5;
  border: 4px dashed #3336ff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #aaabc2;
  padding: 10px 0;
}

.file-upload-image {
 width: 70%;
  height: auto;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 50%;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 200;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}

label.cameraButton {
  display: inline-block;
  margin: 1em 0;

  /* Styles to make it look like a button */
  padding: 0.5em;
  border: 2px solid #666;
  border-color: #EEE #CCC #CCC #EEE;
  background-color: #DDD;
}

/* Look like a clicked/depressed button */
label.cameraButton:active {
  border-color: #CCC #EEE #EEE #CCC;
}

/* This is the part that actually hides the 'Choose file' text box for camera inputs */
label.cameraButton input[accept*="camera"] {
  display: none;
}

}
.besar {
    line-height: 40px;
}
    </style>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('mom/lihat_semua') ?>">
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
								<form action="<?= base_url('setting/save_sop') ?>" id="form-tambah" method="POST" enctype="multipart/form-data">

								<div class="form-row">
	
											<div class="form-group col-md-3">
											<label ><strong>User</strong></label>
											<input type="text" name="createdby_sop" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>"  readonly>
										</div>
										<div class="form-group col-md-3">
											<label ><strong>Tanggal Dibuat</strong></label>
											<input type="text" name="createdtime_sop" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?php date_default_timezone_set('Asia/Jakarta');
		                                echo date('Y-m-d H:i:s');
		                                ?>"  readonly>
										</div>
										<div class="form-group col-md-3">
											<label ><strong>Jenis Sop</strong></label>
											<input type="text" name="jenis_sop" placeholder="" autocomplete="off"  class="form-control" required value=""  >
										</div>
										<div class="form-group col-3">
										<label>Status</label>
                            <select name="status_sop" class="form-control" required>
                            <option value="1" <?php
                            if (!empty($employee_info->status_sop)) {
                                echo $employee_info->status_sop == '1' ? 'selected' : '';
                            }
                            ?>>Aktif</option>
                            <option value="2" <?php
                            if (!empty($employee_info->status_sop)) {
                                echo $employee_info->status_sop == '2' ? 'selected' : '';
                            }
                            ?>>Non-Aktif</option>
                            </select>
											</div>
									</div>

									<div class="form-row">


										<div class="form-group col-12">
											<label>Isi</label>
											<textarea  name="isi_sop" class="form-control textEditor" ><?php
			                            if (!empty($employee_info->isi_sop)) {
			                                echo $employee_info->isi_sop;
			                            }
			                            ?></textarea>
									</div>
										
								
									</div>
									
						
									<div class="form-row">
						
									<hr>
									<div class="form-group">
										<button onclick="myFunction()" type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
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
			<script>
function myFunction() {
  confirm("Lanjut Proses Simpan ?");
}
</script>
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>