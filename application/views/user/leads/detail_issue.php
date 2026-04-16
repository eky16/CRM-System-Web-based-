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
			<div id="content" data-url="<?= base_url('user/leads') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">


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

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Detail Issue Project</h6>
                                </div>
                                <div class="card-body">
                                          	<div class="form-row">
                                   

                            		<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Kode</strong></font>
											</label>
										</div>
										<div class="form-group col-md-5">:
										<font size="2px">	<?= $issue_hd->kode_issue ?></font>
										</div>
		
                            		<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Proyek</strong></font>
											</label>
										</div>
										<div class="form-group col-md-5">:
										<font size="2px">	<?= $issue_hd->id_lsp_issue ?></font>
										</div>
								    <div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Judul Issue </strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px">		<?= $issue_hd->judul_issue ?></font>
										</div>
								        <div class="form-group col-md-4">
										<font size="2px">	<label ><strong>Keterangan</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px">		<?= $issue_hd->ket_issu ?></font>
										</div>
									<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Moderator</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
									<font size="2px">		<?= $issue_hd->created_issue ?></font>
										</div>

									<div class="form-group col-md-4">
									<font size="2px">		<label ><strong>Tanggal</strong></font>
											</label>
										</div>
										<div class="form-group col-md-8">:
										<font size="2px">	<?= $issue_hd->created_time_issue ?> </font>
										</div>
								  <br>
						 <div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1"><font size="2px">No</font></td>
										<td width="300"><font size="2px">Issue</font></td>
										<td width="300"><font size="2px">Problem Solve</font></td>
										<td width="30" align="center"><font size="2px">Aksi</font></td>
										
									</tr>
								</thead>
								<tbody>
									<?php foreach ($issue_dt as $mdl): ?>
										<tr>
									<td width="1"><font size="2px"><?= $no++ ?></font></td>
								<td ><font size="2px"><?php echo $mdl->issue ?></font></td>
												<td ><font size="2px"><?php 
											echo $mdl->proglem_solved; ?>	</font></td>
											<td align="center"><font size="2px">
												<a  data-toggle="modal" style="color:white" data-target="#right_modal<?php echo $mdl->id_sub_issue; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
											<!--	<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('user/leads/hapus_issue_dt/' . $mdl->id_sub_issue) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
											</font></td>	
<!-- modal update -->
 
<div  class="modal modal-right fade" id="right_modal<?php echo $mdl->id_sub_issue; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Detail Issue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('user/leads/save_problemsolve') ?>" id="form-tambah" method="POST">
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
                                            <label for="nama_barang"><strong>Issue </strong></label>
                                        	<textarea  name="issue" class="form-control" ><?= $mdl->issue ?></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang"><strong>Problem Solve </strong></label>
                                          	<textarea  name="proglem_solved" class="form-control textEditor" >
												<?= $mdl->proglem_solved ?></textarea>

                                           
                                </div>
                                <input type="text" name="id_sub_issue" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $mdl->id_sub_issue ?>" maxlength="8" hidden>
                               <input type="text" name="kode_issue" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $mdl->kode_issue ?>" maxlength="8" hidden>

                                <input type="text" name="created_issue_dt" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

                                <input type="text" id="datepicker" name="updatetime" value="<?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d H:i:s');
                                        ?>"  class="form-control" hidden>

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
  
      <div class="modal-footer modal-footer-fixed">
       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
										</tr>

									<?php endforeach ?>

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