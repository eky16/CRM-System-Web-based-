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
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
						<div class="float-right ">

							<button  class="btn btn-secondary btn-sm" onclick="window.close()"><i class="fa fa-times"></i> &nbsp;&nbsp;Tutup</button> 
                            
						</div>
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

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Project -  <?= $pengiriman_hd->nama_project ?>					<div class="float-right"> 
  			
  				<?php $div = $this->session->login['divisi'].' '.$this->session->login['department']; ?>
  			<?php if($div == 'Staff IT' OR $div == 'Kadiv Workshop'):?>
                  <a  data-toggle="modal" style="color:white" data-target="#right_modal_ceklist<?= $all_checklist->no ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah </a>
                <?php else: ?>
             	 <a  data-toggle="modal" style="color:white" data-target="#" class="btn btn-danger btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Anda Tidak Berhak Mengubah data ini </a>
            	<?php endif;?>
                    </div></h6>

                                </div>

                                <div class="card-body">
                                          	<div class="form-row">
                                   

                            		<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Id</strong></font>
											</label>
										</div>
										<div class="form-group col-md-5">:
										<font size="2px">	<?= $pengiriman_hd->id_pengiriman ?></font>
										</div>
		
                            		<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Tanggal & Waktu</strong></font>
											</label>
										</div>
										<div class="form-group col-md-5">:
										<font size="2px">	<?= $pengiriman_hd->tgl_pengiriman ?> - <?= $pengiriman_hd->waktu_pengiriman ?></font>
										</div>
								    <div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Status Approved </strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?php $status_= $pengiriman_hd->status_pengiriman; ?>
									      <?php if ($status_ == '2'):?>
                                            <span class="badge badge-success">Ya</span>
                                            <?php endif;?>
                                            <?php if ($status_ == '1'):?>
                                            <span class="badge badge-warning">Menunggu</span>
                                            <?php endif;?>
                                            <?php if ($status_ == '3'):?>
                                            <span class="badge badge-danger">Ditolak</span>
                                            <?php endif;?>
                                            </font>
										</div>

									<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Proyek</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px">		<?= $pengiriman_hd->nama_project ?></font>
										</div>
									<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Keterangan</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?= $pengiriman_hd->ket_pengiriman ?></font>
										</div>
															<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Dibuat</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?= $pengiriman_hd->creat_by ?> - <?= $pengiriman_hd->creat_at ?></font>
										</div>
									<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Disetujui</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?= $pengiriman_hd->apprv_by.' - '.$pengiriman_hd->apprv_time ?></font>
										</div>
								  <br>
						 <div class="table-responsive">
							<table class="table table-bordered" id="" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="50"><font size="2px">Id</font></td>
										<td width="70"><font size="2px">Tanggal</font></td>
										<td width="50"><font size="2px">Waktu</font></td>
										<td width="200"><font size="2px">Proyek</font></td>
										<td width="200"><font size="2px">Keterangan</font></td>
										<td width="200" align="center"><font size="2px">Update By</font></td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($pengiriman_dt as $mdl): ?>
										<tr>

							<td width="1"><font size="2px"><?php echo $mdl->id_pengiriman_log ?></font></td>
							<td ><font size="2px"><?php echo $mdl->tgl_pengiriman ?></font></td>
							<td ><font size="2px">	<?php echo $mdl->waktu_pengiriman ?></font></td>
							<td ><font size="2px">	<?php echo $mdl->nama_project ?></font></td>
							<td ><font size="2px">	<?php echo $mdl->ket_pengiriman ?></font></td>
							<td ><font size="2px"><?php  echo $mdl->update_by ?> </br> <?php  echo $mdl->update_at ?> </font></td>

										</tr>		<?php endforeach ?>

									
<div  class="modal modal-right fade" id="right_modal_ceklist" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Jadwal Pengiriman <?= $pengiriman_hd->id_pengiriman ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('jadwal_pengiriman/update_detail_pengiriman') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Cassa Design </h6>
                                </div>
                                <div class="card-body">

                      	
                                <input type="text" name="user_ceklist" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>
                    	       <input type=""  name="id_lsp"  value="<?= $pengiriman_hd->id_pengiriman ?>" hidden>
                    	       <input  type="text"  maxlength="50"  name="id_pengiriman" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $pengiriman_hd->id_pengiriman ?>"  class="form-control" hidden>

 <input  type="text" maxlength="50" readonly name="project_id_old" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $pengiriman_hd->project_id ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="ket_pengiriman_old" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $pengiriman_hd->ket_pengiriman ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="creat_by" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $pengiriman_hd->creat_by ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="creat_at" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $pengiriman_hd->creat_at ?>"  class="form-control " hidden>

 <input  type="text" maxlength="50" readonly name="tgl_old" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $pengiriman_hd->tgl_pengiriman ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="time_old" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $pengiriman_hd->waktu_pengiriman ?>"  class="form-control " hidden>


                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="tgl_pengiriman" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $pengiriman_hd->tgl_pengiriman ?>"  class="form-control" required>
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Waktu </label>
                                             <input  type="time" maxlength="50"  name="waktu_pengiriman" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $pengiriman_hd->waktu_pengiriman ?>"  class="form-control" required>
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Proyek </label>
                                            <select name="project_id" class="form-control" >                             
                                                <?php foreach ($proyek as $prk) : ?>
                                                    <option value="<?php echo $prk->id_lsp; ?>" 
                                                        <?php
                                                        if (!empty($pengiriman_hd->project_id)) {
                                                            echo $prk->id_lsp == $pengiriman_hd->project_id ? 'selected' : '';
                                                        }
                                                    ?>><?php echo $prk->nama_project ?></option>                            
                                                <?php endforeach; ?>
                                            </select>
                                </div>
                          <div class="form-group col-12">
                                            <label>Status</label>
                            <select name="status_pengiriman" class="form-control" >
                            <option value="">Pilih ...</option>
                            <option value="1" <?php
                            if (!empty($pengiriman_hd->status_pengiriman)) {
                                echo $pengiriman_hd->status_pengiriman == '1' ? 'selected' : '';
                            }
                            ?>>Menunggu</option>
                            <option value="2" <?php
                            if (!empty($pengiriman_hd->status_pengiriman)) {
                                echo $pengiriman_hd->status_pengiriman == '2' ? 'selected' : '';
                            }
                            ?>>Ya</option>
                            <option value="3" <?php
                            if (!empty($pengiriman_hd->status_pengiriman)) {
                                echo $pengiriman_hd->status_pengiriman == '3' ? 'selected' : '';
                            }
                            ?>>Tolak</option>
                            </select>
                                </div>

									<div class="form-group col-12" >
</div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Keterangan </label>
                                          <textarea name="ket_pengiriman" class="form-control"><?= $pengiriman_hd->ket_pengiriman ?> </textarea>
                                            
                                </div>

                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                            
                                    </div>
   
                                    <hr>
                                </div>
                            </div>

                            <!-- Color System -->
                       

                        </div>
        </div></form>
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

</div> <!-- end modal ceklist new -->
								</tbody>
							</table>
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
</body>
</html>