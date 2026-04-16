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
			<div id="content" data-url="<?= base_url('barang') ?>">
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
								<form action="<?= base_url('mom/update_mom') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">

								<div class="form-row">
										<div class="form-group col-md-3">
											<label for="kode_barang"><strong>KODE M O M</strong></label>
											<input type="text" name="id_mom" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?= $leads->id_mom ?>" maxlength="8" readonly>
										</div>

											<div class="form-group col-md-3">
											<label ><strong>User</strong></label>
											<input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-3">
										<label>Tanggal</label>

										<input type="text" id="datepicker"  name="tanggal" value="<?php  
										   echo date ('Y-m-d', strtotime("$leads->tanggal")); ?>"  class="form-control">
											</div>

										<div class="form-group col-3">
										<label>Status M O M</label>
										 <select id="select-state" placeholder="Status" name="status" class="form-control" required>
			                      

			                 <option value="" >PILIH .....</option>
                            <?php foreach ($all_status_mom as $status) : ?>
                                <option value="<?php echo $status->id_status ?>" <?php
                                if (!empty($leads->status)) {
                                    echo $status->id_status == $leads->status ? 'selected' : '';
                                }
                                ?>><?php echo $status->keterangan ?></option>
                                    <?php endforeach; ?>

			                       </select> 
										</div>
	<input type="hidden"  name="id" placeholder="Masukkan Kode " autocomplete="off"  class="form-control" required value="<?= $leads->id ?>" maxlength="8" >
	<input type="hidden" name="updateby" value="<?php echo  $this->session->login['nama'] ?>">
	<input type="hidden" name="updatetime" value="<?php date_default_timezone_set('Asia/Jakarta');
		echo date('Y-m-d  H:i:s');
		?>">
	<input type="hidden" name="entrytime" value="<?php date_default_timezone_set('Asia/Jakarta');
		echo date('Y-m-d  H:i:s');
		?>">
									</div>
									<div class="form-row">

										<div class="form-group col-md-6">
											<label for="nama_barang"><strong>Leads Project</strong></label>
											 <select id="select-state" placeholder="Pilih Pic Atau Kode Leads Project" name="id_lsp" class="form-control">
                            <option value="" >PILIH .....</option>
                            <?php foreach ($all_leads_project as $lsp) : ?>
                            <option value="<?php echo $lsp->id_lsp ?>"
                            	<?php
                                if (!empty($leads->id_lsp)) {
                                    echo $lsp->id_lsp == $leads->id_lsp ? 'selected' : '';
                                }
                                ?>>
                            <?php echo $lsp->id_lsp .' - '.$lsp->nama_pic ?></option> 
                            <?php endforeach; ?>
                        	</select> 
										</div>
										<div class="form-group col-6">
											<label>Lokasi</label>
 										<input type="text" name="lokasi" placeholder="Masukkan Lokasi" autocomplete="off" value="<?= $leads->lokasi ?>"  class="form-control">
										</div>
										<div class="form-group col-6">
											<label>Participants</label>
											<input type="text" name="partisipasi" placeholder="Masukkan partisipasi" autocomplete="off" value="<?= $leads->partisipasi ?>"  class="form-control">
										</div>
											<div class="form-group col-6">
											<label>Agenda</label>
											<input type="text" name="agenda" placeholder="Masukkan Agenda" autocomplete="off" value="<?= $leads->agenda ?>"  class="form-control">
										</div>
									</div>

									<div class="form-row">


										<div class="form-group col-12">
											<label>Discussion</label>
											<textarea  name="diskusi" class="form-control textEditor" >
												<?= $leads->diskusi ?></textarea>
									</div>
						                               <div class="form-group col-md-6">
                                             <label for="nama_barang"><strong>FOTO </strong></label>
  <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
      
  <div class="image-upload-wrap">
    <input class="file-upload-input" type='file' name="berkas" onchange="readURL(this);" accept="image/*" />
    	 <?php if (!empty($leads->berkas)): ?>
 <img  src="<?php echo base_url(); ?>img/uploads/foto_karyawan/<?= $leads->berkas ?>"  alt="" class="file-upload-image" /><?php endif; ?>
  </div>
  <div class="file-upload-content">
    <img class="file-upload-image" src="#" alt="your image" />
    <div class="image-title-wrap">
      <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
    </div>
  </div>
   </div>
</div>

					<input type="text" name="ket" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="Ubah M O M" maxlength="8" hidden>
                    <input type="hidden" name="user" value="<?php echo  $this->session->login['nama'] ?>">
                    <input type="hidden" name="waktu" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d  H:i:s'); ?>"> 
						
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
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>