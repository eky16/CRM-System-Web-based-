<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>
	<?php if ($this->session->flashdata('success')) { ?>
<script>
 swal("success!", "Data Berhasil Disimpan", "success");
</script>
     <?php } ?>
<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					<a href="<?= base_url('karyawan/export/'. $emp->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
					<a href="<?= base_url('karyawan/tambah') ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;User Baru </a> 
					<a href="<?= base_url('karyawan/ubah/' . $emp->id) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah</a>
					

					<button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button>					</div>
				</div>
				<hr>
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php elseif($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
     <div class="row">
		 			<div class="col-lg-12 mb-4">
                            <!-- Project Card Example -->
                            <div class="card shadow ">
                                <div class="card-header py-4">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $emp->EmployeeID .' - '. $emp->nama_karyawan	 ?></h6>
                                    <span>Createdby <?= $emp->createdby .' - '. $emp->createdtime	 ?></span> 
                                    <?php if (!empty($emp->updateby)): ?>  ,
                                     <span>Updateby <?= $emp->updateby .' - '. $emp->updatetime	 ?></span>  <?php endif; ?> 
                                </div>
                    
                            </div>
				</div>


</div>
<!-- modal asset -->
<div id="person_adm<?php echo $emp->id ?>" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">Modal Header</h4>
        </div>
<form action="<?= base_url('karyawan/simpan_asset') ?>" id="form-tambah" method="POST">
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>KODE </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kd_transaksi" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $kode_transaksi ?>"  readonly class="form-control">
                                </div>  
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>NIK </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="EmployeeID" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->EmployeeID ?>"  readonly class="form-control">
                                </div>
                              <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" hidden name="userid" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->id ?>"  readonly class="form-control">
                                <input type="text" name="createdby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="createdtime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>
                                  <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Nama Karyawan </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->nama_karyawan ?>" readonly  class="form-control">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Asset</label>
                                        <select id="select-state" placeholder="Pilih Asset" name="kode_asset" class="form-control" required>
			                      

			                 <option value="" >PILIH .....</option>
                            <?php foreach ($all_asset as $asset) : ?>
                                <option value="<?php echo $asset->kode_asset ?>" <?php
                                if (!empty($emp->kode_asset)) {
                                    echo $asset->kode_asset == $emp->kode_asset ? 'selected' : '';
                                }
                                ?>><?php echo $asset->kode_asset .' - '.$asset->nama_asset ?></option>
                                    <?php endforeach; ?>

			                       </select> 
                                        </div>

                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- selesai modal asset -->
<!-- modal doc -->
<div id="person_doc<?php echo $emp->id ?>" class="modal fade">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        
          <h4 class="modal-title">DOKUMENT KARYAWAN</h4>
        </div>
<form action="<?= base_url('karyawan/simpan_berkas') ?>"  enctype="multipart/form-data" id="form-tambah" method="POST">
        <div class="modal-body">
                                 <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design</h6>
                                </div>
                                <div class="card-body">
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>NIK & NAMA </strong></label>
                                             <input onkeyup="this.value = this.value.toUpperCase()" type="text" maxlength="50" readonly name="kd_transaksi" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->EmployeeID .' - '.$emp->nama_karyawan ?>"  readonly class="form-control">
                                </div>  
							<input type="text" maxlength="50" hidden name="EmployeeID" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->EmployeeID ?>"  readonly class="form-control">
							<input type="text" maxlength="50" hidden name="userid" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $emp->id ?>"  readonly class="form-control">
                                <input type="text" name="updateby" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="updatetime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>
                                  <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Cv </strong></label>
                                             <input  type="file"  maxlength="50" name="berkas_cv" placeholder="Cv.Pdf" accept="application/pdf"  value="<?php
                        if (!empty($emp->berkas_cv)) {
                            echo $emp->berkas_cv;
                        }
                        ?>"  id="fileId" class="form-control">   
                  
                                        </div>                     
                                    <div class="form-group col-12">
                                <button id="btn-file-reset-id"  class="btn btn-danger" type="button">Reset file</button>
                                       
                                    </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>KTP </strong></label>
                                             <input  type="file"  maxlength="50" name="berkas_ktp" placeholder="Cv.Pdf" accept="application/pdf"  value="<?php
                        if (!empty($emp->berkas_ktp)) {
                            echo $emp->berkas_ktp;
                        }
                        ?>"  id="fileId1" class="form-control">   
                            
                                </div>                     
                                <div class="form-group col-12">
                                <button id="btn-file-reset-id1"  class="btn btn-danger" type="button">Reset file</button>      
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>KK </strong></label>
                                             <input  type="file"  maxlength="50" name="berkas_kk" placeholder="Cv.Pdf" accept="application/pdf"  value="<?php
                        if (!empty($emp->berkas_kk)) {
                            echo $emp->berkas_kk;
                        }
                        ?>"  id="fileId2" class="form-control">   
                            
                                </div>                     
                                <div class="form-group col-12">
                                <button id="btn-file-reset-id2"  class="btn btn-danger" type="button">Reset file</button>      
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>IJAZAH </strong></label>
                                             <input  type="file"  maxlength="50" name="berkas_ijazah" placeholder="Cv.Pdf" accept="application/pdf"  value="<?php
                        if (!empty($emp->berkas_ijazah)) {
                            echo $emp->berkas_ijazah;
                        }
                        ?>"  id="fileId3" class="form-control">   
                            
                                </div>                     
                                <div class="form-group col-12">
                                <button id="btn-file-reset-id3"  class="btn btn-danger" type="button">Reset file</button>      
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>PERJANJIAN KERJA 1 </strong></label>
                                             <input  type="file"  maxlength="50" name="berkas_perjanjian1" placeholder="Cv.Pdf" accept="application/pdf"  value="<?php
                        if (!empty($emp->berkas_perjanjian1)) {
                            echo $emp->berkas_perjanjian1;
                        }
                        ?>"  id="fileId4" class="form-control">   
                            
                                </div>                     
                                <div class="form-group col-12">
                                <button id="btn-file-reset-id4"  class="btn btn-danger" type="button">Reset file</button>      
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>PERJANJIAN KERJA 2 </strong></label>
                                             <input  type="file"  maxlength="50" name="berkas_perjanjian2" placeholder="Cv.Pdf" accept="application/pdf"  value="<?php
                        if (!empty($emp->berkas_perjanjian2)) {
                            echo $emp->berkas_perjanjian2;
                        }
                        ?>"  id="fileId5" class="form-control">   
                            
                                </div>                     
                                <div class="form-group col-12">
                                <button id="btn-file-reset-id5"  class="btn btn-danger" type="button">Reset file</button>      
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>PERJANJIAN KERJA 3 </strong></label>
                                             <input  type="file"  maxlength="50" name="berkas_perjanjian3" placeholder="Cv.Pdf" accept="application/pdf"  value="<?php
                        if (!empty($emp->berkas_perjanjian3)) {
                            echo $emp->berkas_perjanjian3;
                        }
                        ?>"  id="fileId6" class="form-control">   
                            
                                </div>                     
                                <div class="form-group col-12">
                                <button id="btn-file-reset-id6"  class="btn btn-danger" type="button">Reset file</button>      
                                </div>


                                        <hr>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> <!-- selesai modal doc -->
           <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI USER</h6>
                                </div>
                                <div class="card-body">
                               	<div class="form-row">
                                   
                                  <div class="form-group col-md-4">
											<label ><strong>Foto</strong>
											</label>
										</div>
										<div class="form-group col-md-5">
											
										   <img  src="<?php echo base_url(); ?>img/uploads/foto_karyawan/<?= $emp->foto ?>" style="width:100%;cursor:zoom-in"
  onclick="document.getElementById('modal01').style.display='block'"> 
    <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
    <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
    <div class="w3-modal-content w3-animate-zoom">
      <img src="<?php echo base_url(); ?>img/uploads/foto_karyawan/<?= $emp->foto ?>" style="width:100%">
    </div>
  </div>
										</div>                                   



                            		<div class="form-group col-md-4">
											<label ><strong>Nama Karyawan</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->nama_karyawan ?>
										</div>
                            		<div class="form-group col-md-4">
											<label ><strong>No. KTP</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $emp->nomor_ktp ?>
										</div>
								    <div class="form-group col-md-4">
											<label ><strong>Jenis Kelamin </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $emp->gender ?>
										</div>
								        <div class="form-group col-md-4">
											<label ><strong>Tgl. Lahir</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $emp->ulang_tahun ?>
										</div>
									<div class="form-group col-md-4">
											<label ><strong>Status Kawin</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->status_kawin ?>
										</div>


								    <div class="form-group col-md-4">
											<label ><strong>Email</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->email ?>
										</div>
                                        <div class="form-group col-md-4">
                                            <label ><strong>Email Kantor</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                            <?= $emp->email_kantor ?>
                                        </div>
								    <div class="form-group col-md-4">
											<label ><strong>No Telp 1 </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $emp->no_telp1 ?>
										</div>
								    <div class="form-group col-md-4">
											<label ><strong>No Telp 2 </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											<?= $emp->no_telp2 ?>
										</div>
									<div class="form-group col-md-4">
											<label ><strong>No Telp Darurat </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->no_telp_darurat ?>
										</div>
                                    <div class="form-group col-md-4">
                                            <label ><strong>Hubungan </strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-5">:
                                            <?= $emp->hubungan ?>
                                        </div>
									<div class="form-group col-md-4">
											<label ><strong>Alamat Ktp </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->alamat_ktp ?>
									</div>
									<div class="form-group col-md-4">
											<label ><strong>Alamat Domisili </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->alamat_domisili ?>
									</div>

									
                                    </div>
                                </div>
                            </div>
                          <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DOKUMENT KARYAWAN</h6>
                                </div>
                                <div class="card-body">
                               	<div class="form-row">
                                   
						<?php if (!empty($emp->berkas_cv)): ?>
									<div class="form-group col-md-4">
											<label ><strong>CV </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											 <a href="<?php echo base_url(); ?>img/uploads/doc_karyawan/<?= $emp->berkas_cv ?>" target="_blank" style="text-decoration: underline;">Lihat C V <?= $emp->nama_karyawan ?> </a>
									</div><?php endif; ?> 
						<?php if (!empty($emp->berkas_ktp)): ?>
									<div class="form-group col-md-4">
											<label ><strong>KTP </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											 <a href="<?php echo base_url(); ?>img/uploads/doc_karyawan/<?= $emp->berkas_ktp ?>" target="_blank" style="text-decoration: underline;">Lihat Pdf <?= $emp->nama_karyawan ?> </a>
									</div> <?php endif; ?> 
								<?php if (!empty($emp->berkas_kk)): ?>
									<div class="form-group col-md-4">
											<label ><strong>KK </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											 <a href="<?php echo base_url(); ?>img/uploads/doc_karyawan/<?= $emp->berkas_kk ?>" target="_blank" style="text-decoration: underline;">Lihat Pdf <?= $emp->nama_karyawan ?> </a>
									</div> <?php endif; ?>
									<?php if (!empty($emp->berkas_ijazah)): ?>
									<div class="form-group col-md-4">
											<label ><strong>IJAZAH </strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											 <a href="<?php echo base_url(); ?>img/uploads/doc_karyawan/<?= $emp->berkas_ijazah ?>" target="_blank" style="text-decoration: underline;">Lihat Pdf <?= $emp->nama_karyawan ?> </a>
									</div><?php endif; ?>
									<?php if (!empty($emp->berkas_perjanjian1)): ?>
									<div class="form-group col-md-4">
											<label ><strong>PERJANJIAN KERJA 1</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											 <a href="<?php echo base_url(); ?>img/uploads/doc_karyawan/<?= $emp->berkas_perjanjian1 ?>" target="_blank" style="text-decoration: underline;">Lihat Pdf <?= $emp->nama_karyawan ?> </a>
									</div><?php endif; ?>
									<?php if (!empty($emp->berkas_perjanjian2)): ?>
									<div class="form-group col-md-4">
											<label ><strong>PERJANJIAN KERJA 2</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											 <a href="<?php echo base_url(); ?>img/uploads/doc_karyawan/<?= $emp->berkas_perjanjian2 ?>" target="_blank" style="text-decoration: underline;">Lihat Pdf <?= $emp->nama_karyawan ?> </a>
									</div><?php endif; ?>
							<?php if (!empty($emp->berkas_perjanjian3)): ?>
									<div class="form-group col-md-4">
											<label ><strong>PERJANJIAN KERJA 3</strong>
											</label>
										</div>
										<div class="form-group col-md-5">:
											 <a href="<?php echo base_url(); ?>img/uploads/doc_karyawan/<?= $emp->berkas_perjanjian3 ?>" target="_blank" style="text-decoration: underline;">Lihat Pdf <?= $emp->nama_karyawan ?> </a>
									</div><?php endif; ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI USER</h6>
                                </div>
                                <div class="card-body">
                                  <div class="form-row">
                                   
                            		 <div class="form-group col-md-3">
											<label ><strong>NIK </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->EmployeeID ?>
										</div>
								    <div class="form-group col-md-3">
											<label ><strong>Tgl Bergabung</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
												<?= $emp->tgl_bergabung ?>
										</div>
								    <div class="form-group col-md-3">
											<label ><strong>Status </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->perjanjian_kerja ?>
										</div>
									<?php
                if ($emp->perjanjian_kerja !== "TETAP" ) : ?>		
								    <div class="form-group col-md-3">
											<label ><strong>Akhir Kerja </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->akhir_kerja ?>
										</div>
				<?php endif; ?>
				<?php
                if ($emp->Active == "1" ) : ?>  		
								    <div class="form-group col-md-3">
											<label ><strong>Lama Bekerja </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?php 
                                            $start_date = new DateTime($emp->tgl_bergabung);
                                            $end_date = new DateTime(date('Y-m-d'));
                                            $y = $end_date->diff($start_date)->y;
                                            // bulan
                                            $m = $end_date->diff($start_date)->m;
                                            // hari
                                            $d = $end_date->diff($start_date)->d;
                                            echo " " . $y . " tahun " . $m . " bulan " . $d . " hari";
                                            ?>
										</div>
				<?php endif; ?>
								<?php
                if ($emp->Active == "2" ) : ?>  
                                <div class="form-group col-md-3">
                                            <label ><strong>Tgl Resign </strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                            <?= $emp->resign_date ?>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label ><strong>Alasan </strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                            <?= $emp->alasan_resign ?>
                                        </div>		
								    <div class="form-group col-md-3">
											<label ><strong>Lama Bekerja </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?php 
                                            $start_date = new DateTime($emp->tgl_bergabung);
                                            $end_date = new DateTime($emp->resign_date);
                                            $y = $end_date->diff($start_date)->y;
                                            // bulan
                                            $m = $end_date->diff($start_date)->m;
                                            // hari
                                            $d = $end_date->diff($start_date)->d;
                                            echo " " . $y . " tahun " . $m . " bulan " . $d . " hari";
                                            ?>
										</div>

				<?php endif; ?>
								    <div class="form-group col-md-3">
											<label ><strong>Div/Jab </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->divisi . ' '. $emp->department ?>
										</div>
								    <div class="form-group col-md-3">
											<label ><strong>Atasan </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->supervisorID ?>
										</div>
                                        <div class="form-group col-md-3">
                                            <label ><strong>Jatah Cuti </strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                            <?= $emp->jumlah . ' - '.$emp->tahun ?>
                                        </div>
				
                                    </div>
                                </div>
                            </div>
                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI USER</h6>
                                </div>
                                <div class="card-body">
                                  <div class="form-row">
                                   
                            		
								    <div class="form-group col-md-3">
											<label ><strong>Bank</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
												<?= $emp->bank ?>
										</div>
								    <div class="form-group col-md-3">
											<label ><strong>Atas Nama </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->ats_nama ?>
										</div>
								    <div class="form-group col-md-3">
											<label ><strong>No Rekening </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->no_rek ?>
										</div>

								    <div class="form-group col-md-3">
											<label ><strong>No Bpjs Kesehatan </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->bpjs_kes ?>
										</div>
								    <div class="form-group col-md-3">
											<label ><strong>No Bpjs Tenagakerja </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->bpjs_ket ?>
										</div>
								    <div class="form-group col-md-3">
											<label ><strong>Npwp </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $emp->npwp ?>
										</div>

				
                                    </div>
                                </div>
                            </div>
                               <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI IZIN TAHUN <?= $emp->tahun ?></h6>
                                </div>
                                <div class="card-body">
                                  <div class="form-row">
                                   
                                        
                                    <div class="form-group col-md-3">
                                            <label ><strong>CUTI</strong>
                                            </label>
                                        </div>
                                        <div class="form-group col-md-8">:
                                                <?= $emp->cuti ?> / <u><?= $emp->jumlah ?></u>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">INFORMASI INVENTARIS</h6>
                                </div>
                                <div class="card-body">
                                  <div class="form-row">
                                   
                            	<?php foreach ($asst as $asst): ?>
								    <div class="form-group col-md-3">
											<label ><strong>Kode Asset</strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
												<?= $asst->kode_asset ?>
										</div>
								    <div class="form-group col-md-3">
											<label ><strong> Nama Asset </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $asst->nama_asset ?>
										</div>
								 
								    <div class="form-group col-md-3">
											<label ><strong> Keterangan </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $asst->keterangan_asset ?>
										</div> 
									<div class="form-group col-md-3">
											<label ><strong> Status Asset </strong>
											</label>
										</div>
										<div class="form-group col-md-8">:
											<?= $asst->status ?>
										</div><?php endforeach ?>

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
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<!-- start modal ADMINISTRASI-->


</body>
</html>