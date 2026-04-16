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
								<form action="<?= base_url('mom/save_mom') ?>" id="form-tambah" method="POST">

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
 										<input type="text" name="lokasi" placeholder="Masukkan Lokasi" autocomplete="off" value=" "  class="form-control">
										</div>
										<div class="form-group col-6">
											<label>Participants</label>
											<input type="text" name="partisipasi" placeholder="Masukkan partisipasi" autocomplete="off" value=" "  class="form-control">
										</div>
											<div class="form-group col-6">
											<label>Agenda</label>
											<input type="text" name="agenda" placeholder="Masukkan Agenda" autocomplete="off" value=" "  class="form-control">
										</div>
									</div>

									<div class="form-row">


										<div class="form-group col-12">
											<label>Discussion</label>
											<textarea  name="diskusi" class="form-control textEditor" >
											</textarea>
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
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
</body>
</html>