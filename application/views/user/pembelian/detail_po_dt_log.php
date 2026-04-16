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
			<div id="content" data-url="<?= base_url('leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

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
                                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $hd_pr->number_; ?>					
                     <!--          <div class="float-right"> 
  			
  				<?php $div = $this->session->login['divisi'].' '.$this->session->login['department']; ?>
  			<?php if($div == 'Staff IT' OR $div == 'Kadiv Workshop'):?>
                  <a  data-toggle="modal" style="color:white" data-target="#right_modal_ceklist<?= $all_checklist->no ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Ubah </a>
                <?php else: ?>
             	 <a  data-toggle="modal" style="color:white" data-target="#" class="btn btn-danger btn-sm"><i class="fa fa-edit"></i>&nbsp;&nbsp;Anda Tidak Berhak Mengubah data ini </a>
            	<?php endif;?>
                    </div></h6> -->

                                </div>

                                <div class="card-body">
                                          	<div class="form-row">
                                   

                            		<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>No Pesanan</strong></font>
											</label>
										</div>
										<div class="form-group col-md-5">:
										<font size="2px">	<?= $hd_pr->number_ ?></font>
										</div>
		
                            		<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Tanggal</strong></font>
											</label>
										</div>
										<div class="form-group col-md-5">:
										<font size="2px">	<?= $hd_pr->transDate ?></font>
										</div>
								    <div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Proyek </strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?php if (!empty($hd_pr->nama_project)):?><?= $hd_pr->nama_project ?><?php endif ;?>
                                            </font>
										</div>

									<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Status</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px">   <?php $status_pr = $hd_pr->status_po  ?>
                                            <?php if ($status_pr == 1):?>
                                              <span class="badge badge-warning">PR- Menunggu Approval PM </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 2):?>
                                              <span class="badge badge-info">PR- Menunggu Approval Estimator </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 3):?>
                                            <span class="badge badge-info">Purchasing Mencari Supplier </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 4):?>
                                            <span class="badge badge-info">PR Settle -Menunggu Approval Estimator </span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 5):?>
                                            <span class="badge badge-primary">PR Settle- Menunggu Approval Direksi</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 6):?>
                                            <span class="badge badge-primary">Menunggu Barang dikirim dari supplier</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 7):?>
                                            <span class="badge badge-success">Barang sudah diterima</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 8):?>
                                            <span class="badge badge-danger">Barang direject</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 9):?>
                                            <span class="badge badge-secondary">Klaim, Barang Tidak Sesuai</span>
                                            <?php endif;?>
                                            <?php if ($status_pr == 10):?>
                                            <span class="badge badge-info">Proses Pengiriman Ulang </span>
                                            <?php endif;?>
                                         <?php if ($status_pr == 11):?>
                                            <span class="badge badge-warning">PR Settle -Menunggu Approval PM  </span>
                                            <?php endif;?></font>
										</div>
									<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Deskripsi</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?php if (!empty($hd_pr->description)):?><?= $hd_pr->description ?><?php endif ;?></font>
										</div>
															<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Pajak</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><div class="form-check-inline">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input"   <?php if($hd_pr->taxable == 'true'){echo 'checked';}?> disabled>Kena Pajak
  </label>
</div>
<div class="form-check-inline">
  <label class="form-check-label">
    <input type="checkbox" class="form-check-input"    <?php if($hd_pr->taxable == 'false'){echo 'checked';}?> disabled>Tidak Kena Pajak
  </label>
</div></font>
										</div>
									<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Pemasok</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?php if (!empty($hd_pr->Nama)):?><?= $hd_pr->Nama ?><?php endif ;?></font>
										</div>
														<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Tanggal Kirim</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?php if (!empty($hd_pr->shipDate)):?><?= $hd_pr->shipDate ?><?php endif ;?></font>
										</div>
														<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Alamat Kirim</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?php if (!empty($hd_pr->toAddress)):?><?= $hd_pr->toAddress ?><?php endif ;?></font>
										</div>
														<div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Berkas</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px"><?php if (!empty($hd_pr->berkas_pdf)):?><a target="blank" href="<?php echo base_url(); ?>img/uploads/berkas_pembelian/<?= $hd_pr->berkas_pdf ?>" title="Menuju halaman google"><span class="badge badge-primary">Lihat Berkas</span></a>
                                           <?php endif ;?></font>
										</div>
											
								  <br>
						 <div class="table-responsive">
							<table class="table table-bordered" id="" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="30"><font size="2px">Branch</font></td>
										<td width="150"><font size="2px">Proyek</font></td>
										<td width="80"><font size="2px">Disc</font></td>
										<td width="50"><font size="2px">Pajak</font></td>
										<td width="200" ><font size="2px">Pemasok</font></td>
										<td width="100" align="center"><font size="2px">Update</font></td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($hs_header as $mdl): ?>
										<tr>

							<td ><font size="2px"><?php echo $mdl->branchName ?></font></td>
							<td ><font size="2px">	<?php echo $mdl->project_name ?></font></td>
							<td ><font size="2px">	
							<?php  $hasil_rupiah = "Rp " . number_format($mdl->cashDiscount,0,',','.');
                                   echo $hasil_rupiah;?>
							</font></td>
							<td ><font size="2px">	<?php echo $mdl->taxable ?></font></td>
							<td ><font size="2px"><?php  echo $mdl->Nama ?></font></td>
							<td ><font size="2px">	<?php echo $mdl->updateTime_po ?></font></td>

										</tr>		<?php endforeach ?>

									
<div  class="modal modal-right fade" id="right_modal_ceklist" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Jadwal Pengiriman <?= $hd_pr->id_pengiriman ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/jadwal_pengiriman/update_detail_pengiriman') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
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
                    	       <input type=""  name="id_lsp"  value="<?= $hd_pr->id_pengiriman ?>" hidden>
                    	       <input  type="text"  maxlength="50"  name="id_pengiriman" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $hd_pr->id_pengiriman ?>"  class="form-control" hidden>

 <input  type="text" maxlength="50" readonly name="project_id_old" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $hd_pr->project_id ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="ket_pengiriman_old" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $hd_pr->ket_pengiriman ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="creat_by" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $hd_pr->creat_by ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="creat_at" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $hd_pr->creat_at ?>"  class="form-control " hidden>

 <input  type="text" maxlength="50" readonly name="tgl_old" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $hd_pr->tgl_pengiriman ?>"  class="form-control " hidden>
 <input  type="text" maxlength="50" readonly name="time_old" placeholder="Masukkan Nama Lokasi" autocomplete="off" value="<?= $hd_pr->waktu_pengiriman ?>"  class="form-control " hidden>


                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="tgl_pengiriman" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $hd_pr->tgl_pengiriman ?>"  class="form-control" required>
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Waktu </label>
                                             <input  type="time" maxlength="50"  name="waktu_pengiriman" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $hd_pr->waktu_pengiriman ?>"  class="form-control" required>
                                </div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Proyek </label>
                                            <select name="project_id" class="form-control" >                             
                                                <?php foreach ($proyek as $prk) : ?>
                                                    <option value="<?php echo $prk->id_lsp; ?>" 
                                                        <?php
                                                        if (!empty($hd_pr->project_id)) {
                                                            echo $prk->id_lsp == $hd_pr->project_id ? 'selected' : '';
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
                            if (!empty($hd_pr->status_pengiriman)) {
                                echo $hd_pr->status_pengiriman == '1' ? 'selected' : '';
                            }
                            ?>>Menunggu</option>
                            <option value="2" <?php
                            if (!empty($hd_pr->status_pengiriman)) {
                                echo $hd_pr->status_pengiriman == '2' ? 'selected' : '';
                            }
                            ?>>Ya</option>
                            <option value="3" <?php
                            if (!empty($hd_pr->status_pengiriman)) {
                                echo $hd_pr->status_pengiriman == '3' ? 'selected' : '';
                            }
                            ?>>Tolak</option>
                            </select>
                                </div>

									<div class="form-group col-12" >
</div>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Keterangan </label>
                                          <textarea name="ket_pengiriman" class="form-control"><?= $hd_pr->ket_pengiriman ?> </textarea>
                                            
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
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>