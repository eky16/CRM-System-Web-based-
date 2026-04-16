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
					<div class="float-right">
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
                                    <h6 class="m-0 font-weight-bold text-primary">Detail Material Project-  <?= $all_checklist->nama_project ?>					<div class="float-right"> 

                  <a  data-toggle="modal" style="color:white" data-target="#right_modal_ceklist<?= $all_checklist->no ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah </a>
                
                    </div></h6>

                                </div>

                                <div class="card-body">
                                          	<div class="form-row">
                                   

                            		<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Id</strong></font>
											</label>
										</div>
										<div class="form-group col-md-5">:
										<font size="2px">	<?= $all_checklist->id_material ?></font>
										</div>
		
                            		<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Tanggal</strong></font>
											</label>
										</div>
										<div class="form-group col-md-5">:
										<font size="2px">	<?= $all_checklist->tgl_ ?></font>
										</div>
								    <div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Status Approved </strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?php $status_= $all_checklist->status_approved; ?>
									      <?php if ($status_ == 'Y'):?>
                                            <span class="badge badge-success">Y</span>
                                            <?php endif;?>
                                            <?php if ($status_ == 'N'):?>
                                            <span class="badge badge-danger">N</span>
                                            <?php endif;?>
                                            </font>
										</div>

									<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Jenis Material</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px">		<?= $all_checklist->jenis_material ?></font>
										</div>
									<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Kode Spesifikasi</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?= $all_checklist->kode_spesifikasi ?></font>
										</div>
															<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Lokasi Penggunaan</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?= $all_checklist->lokasi_penggunaan ?></font>
										</div>
									<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>CreateBy</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?= $all_checklist->creat_by_mt.' - '.$all_checklist->creat_by_mt ?></font>
										</div>
																	<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>UpdateBy</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?= $all_checklist->last_updateby.' - '.$all_checklist->last_time_update ?></font>
										</div>
								  <br>
						 <div class="table-responsive">
							<table class="table table-bordered" id="" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="100"><font size="2px">Id</font></td>
										<td width="100"><font size="2px">Status</font></td>
										<td width="200"><font size="2px">Jenis Material</font></td>
										<td width="200"><font size="2px">Kode Spesifikasi</font></td>
										<td width="300"><font size="2px">Lokasi Penggunaan</font></td>
										<td width="200" align="center"><font size="2px">Aksi</font></td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_checklist_dt as $mdl): ?>
										<tr>
						<?php if($mdl->status_approved == 'Y'):?>
							<td width="1"><font size="2px"><?php echo $mdl->id_material ?></font></td>
							<td ><font size="2px"><?php echo $mdl->status_approved ?></font></td>
							<td ><font size="2px">	<?php echo $mdl->jenis_matrial ?></font></td>
							<td ><font size="2px"><?php  echo $mdl->kode_spesifikasi ?></font></td>
							<td ><font size="2px">	<?php  echo $mdl->lokasi_penggunaan ?>	</font></td>
							<td align="center"><font size="2px"><?= $mdl->creat_date_mt_log ?><br><?= $mdl->creat_by_mt_log ?></font></td>	
						<?php endif;?>		

						<?php if($mdl->status_approved == 'N'):?>
							<td width="1"><font size="2px" color="red"><?php echo $mdl->id_material ?></font></td>
							<td ><font size="2px" color="red"><?php echo $mdl->status_approved ?></font></td>
							<td ><font size="2px" color="red">	<?php echo $mdl->jenis_matrial ?></font></td>
							<td ><font size="2px" color="red"><?php  echo $mdl->kode_spesifikasi ?></font></td>
							<td ><font size="2px" color="red">	<?php  echo $mdl->lokasi_penggunaan ?>	</font></td>
							<td align="center"><font size="2px" color="red"><?= $mdl->creat_date_mt_log ?><br><?= $mdl->creat_by_mt_log ?></font></td>	
						<?php endif;?>	



										</tr>		<?php endforeach ?>

									
<div  class="modal modal-right fade" id="right_modal_ceklist<?= $all_checklist->no ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Data Material <?= $all_checklist->kode_spesifikasi ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_detail_material') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
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
                    	       <input type=""  name="id_lsp"  value="<?= $all_checklist->id_leadsproyek ?>" hidden>
                    	       <input  type="text"  maxlength="50"  name="tgl_ceklist" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?php date_default_timezone_set('Asia/Jakarta');
                            	echo date('Y-m-d H:i:s');
                            	?>"  class="form-control" hidden>

 <input  type="text" maxlength="50" readonly name="status_approved_lama" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $all_checklist->status_approved ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="jenis_material_lama" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $all_checklist->jenis_material ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="kode_spesifikasi_lama" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $all_checklist->kode_spesifikasi ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="lokasi_penggunaan_lama" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $all_checklist->lokasi_penggunaan ?>"  class="form-control " hidden>



                            	<div class="form-group col-md-12">
                                            <label for="nama_barang">Id </label>
                                            <input  type="text" maxlength="50" readonly name="idd_no" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $all_checklist->no ?>"  class="form-control " hidden>
                                             <input  type="text" maxlength="50" readonly name="id_material" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $all_checklist->id_material ?>"  class="form-control " required>
                                </div>

                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="tgl_" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $all_checklist->tgl_ ?>"  class="form-control" required>
                                </div>
                          <div class="form-group col-12">
                                            <label>Status Approved</label>
                            <select name="status_approved" class="form-control" >
                            <option value="">Pilih ...</option>
                            <option value="Y" <?php
                            if (!empty($all_checklist->status_approved)) {
                                echo $all_checklist->status_approved == 'Y' ? 'selected' : '';
                            }
                            ?>>Y</option>
                            <option value="N" <?php
                            if (!empty($all_checklist->status_approved)) {
                                echo $all_checklist->status_approved == 'N' ? 'selected' : '';
                            }
                            ?>>N</option>
                            </select>
                                </div>
                               <div class="form-group col-md-12">
                                            <label for="nama_barang">Jenis Material </label>
                                             <input  type="text" maxlength="50"  name="jenis_material" placeholder="Jenis Material" autocomplete="off" value="<?= $all_checklist->jenis_material ?>"  class="form-control " required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Kode Spesifikasi </label>
                                             <input  type="text" maxlength="50"  name="kode_spesifikasi" placeholder="Kode Spesifikasi" autocomplete="off" value="<?= $all_checklist->kode_spesifikasi ?>"  class="form-control " required>
                                </div>

										<div class="form-group col-12">
											<label>Lokasi Penggunaan</label>
											<textarea  name="lokasi_penggunaan" class="form-control" ><?= $all_checklist->lokasi_penggunaan ?></textarea>
									</div>
									<div class="form-group col-12" >
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