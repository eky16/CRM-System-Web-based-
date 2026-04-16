<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<style type="text/css">
		body {
			font-family: 'Calibri', sans-serif !important;
		}
		    table {
      font-size: 14px;
    }
	</style>

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
							<?php if ($this->session->login['role'] == 'admin'): ?>
								<a href="<?= base_url('leads/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
								<a href="<?= base_url('leads/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
							<?php endif ?>
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
					<div class="card shadow">
						<div class="card-header"><strong>Daftar leads</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
							<tr>
								<th width="2">No</th >
								
								<th  align="center" scope="col" width="200">Nama Project</th >
								<th  align="center" scope="col" width="100">Jadwal Survey</th >
								<th  align="center" scope="col" width="100">FU 1</th >
								<th  align="center" scope="col" width="100">FU 2</th >
								<th  align="center" scope="col" width="100">FU 3</th >
								<th  align="center" scope="col" width="100">FU 4</th >
								<th  align="center" scope="col" width="100">FU 5</th >
								<th  align="center" scope="col" >Jadwal Submit Design</th >
								
								<th  align="center" scope="col">Jadwal Submit BOQ</th >
								
									<th  align="center" width="50" scope="col" class="column-primary">Status & Aksi</th >
							</tr>
									</thead>
									<tbody>
										<?php 
										$no = 1;
										foreach ($all_leads as $leads): ?>
											<tr> <?php $number = $no++; ?>
											<td data-header="No"><?= $number ?></td>
											<td data-header="Project"><?= $leads->nama_project ?></td>
											<td data-header="No" align="center"><?php if(!empty($leads->jadwal_survey)): ?>
												<strong>  <a  data-toggle="modal" style="color:black" data-target="#modal_jadwal_survey<?= $leads->id ?>" class="btn btn-light"><font size="2">
													<?php echo date("d-M-Y", strtotime($leads->jadwal_survey)); ?></font>
												</a> </strong>
											<?php else : ?>
												<strong>  <a  data-toggle="modal" style="color:white" data-target="#modal_jadwal_survey<?= $leads->id ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> </strong>
											<?php endif; ?></td>
											<td data-header="No" align="center">
											<?php if(!empty($leads->fv1)): ?>
											
												<strong>  <a  data-toggle="modal" style="color:black" data-target="#modal_fv1<?= $leads->id ?>" class="btn btn-light"><font size="2">
													<?php echo date("d-M-Y", strtotime($leads->fv1)); ?></font></a> </strong>
											<?php else : ?>
												<strong>  <a  data-toggle="modal" style="color:white" data-target="#modal_fv1<?= $leads->id ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> </strong>
											<?php endif; ?>
											</td>
											<td data-header="No" align="center">
											<?php if(!empty($leads->fv2)): ?>
											
												<strong>  <a  data-toggle="modal" style="color:black" data-target="#modal_fv2<?= $leads->id ?>" class="btn btn-light"><font size="2">
													<?php echo date("d-M-Y", strtotime($leads->fv2)); ?></font></a> </strong>
											<?php else : ?>
												<strong>  <a  data-toggle="modal" style="color:white" data-target="#modal_fv2<?= $leads->id ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> </strong>
											<?php endif; ?></td>
											<td data-header="No" align="center">											<?php if(!empty($leads->fv3)): ?>
											
												<strong>  <a  data-toggle="modal" style="color:black" data-target="#modal_fv3<?= $leads->id ?>" class="btn btn-light"><font size="2">
													<?php echo date("d-M-Y", strtotime($leads->fv3)); ?></font></a> </strong>
											<?php else : ?>
												<strong>  <a  data-toggle="modal" style="color:white" data-target="#modal_fv3<?= $leads->id ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> </strong>
											<?php endif; ?></td>
											<td data-header="No" align="center">											<?php if(!empty($leads->fv4)): ?>
											
												<strong>  <a  data-toggle="modal" style="color:black" data-target="#modal_fv4<?= $leads->id ?>" class="btn btn-light"><font size="2">
													<?php echo date("d-M-Y", strtotime($leads->fv4)); ?></font></a> </strong>
											<?php else : ?>
												<strong>  <a  data-toggle="modal" style="color:white" data-target="#modal_fv4<?= $leads->id ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> </strong>
											<?php endif; ?></td>
											<td data-header="No" align="center">						<?php if(!empty($leads->fv5)): ?>
												<strong>  <a  data-toggle="modal" style="color:black" data-target="#modal_fv5<?= $leads->id ?>" class="btn btn-light"><font size="2">
													<?php echo date("d-M-Y", strtotime($leads->fv5)); ?></font></a> </strong>
											<?php else : ?>
												<strong>  <a  data-toggle="modal" style="color:white" data-target="#modal_fv5<?= $leads->id ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> </strong>
											<?php endif; ?></td>
											<td align="center" data-header="Status">
											<?php if(!empty($leads->jadwal_design)): ?>
												<strong>  <a  data-toggle="modal" style="color:black" data-target="#modal_jadwal_design<?= $leads->id ?>" class="btn btn-light"><font size="2">
													<?php echo date("d-M-Y", strtotime($leads->jadwal_design)); ?></font></a> </strong>
											<?php else : ?>
												<strong>  <a  data-toggle="modal" style="color:white" data-target="#modal_jadwal_design<?= $leads->id ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> </strong>
											<?php endif; ?>
											
											</td>
											<td  data-header="View" align="center">
											<?php if(!empty($leads->jadwal_boq)): ?>
												<strong>  <a  data-toggle="modal" style="color:black" data-target="#modal_jadwal_boq<?= $leads->id ?>" class="btn btn-light"><font size="2">
													<?php echo date("d-M-Y", strtotime($leads->jadwal_boq)); ?></font></a> </strong>
											<?php else : ?>
												<strong>  <a  data-toggle="modal" style="color:white" data-target="#modal_jadwal_boq<?= $leads->id ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></a> </strong>
											<?php endif; ?></td>
											<?php if ($this->session->login['role'] == 'admin'): ?>
												<th scope="row">

													<div class="toolbox">
														<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">&nbsp;&nbsp;
															Aksi
														</button>
														<div class="dropdown-menu">&nbsp;&nbsp;&nbsp;
												<?php
												if ($leads->status_project == 'TENDER') {
													echo '<a class="btn btn-success btn-sm" style="color:white">TENDER</a>';
												}
												elseif ($leads->status_project == 'PENDING') {

													echo '<a class="btn btn-outline-success btn-sm" style="color:black"> PENDING</a>';
												}
												?>
															<a href="<?= base_url('leads/detail/' . $leads->id_lsp) ?>" target="blank_" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>&nbsp;Lihat</a>&nbsp;
															<a href="<?= base_url('leads/ubah/' . $leads->id_lsp) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</a>&nbsp;
															<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('leads/hapus/' . $leads->id_lsp) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
														</div>
													</div>
												</th>
											<?php endif ?>
										</tr>
<!-- Start modal jadwal boq -->
<div  class="modal modal-right fade" id="modal_jadwal_boq<?= $leads->id ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">JADWAL SUBMIT BOQ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_submit_boq') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $leads->nama_project ?> - <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <input  type="text" maxlength="50"  name="id_lsp" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->id_lsp ?>"  class="form-control" hidden>
                                <input  type="text" maxlength="50"  name="nm_pro" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->nama_project ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="jadwal_boq" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->jadwal_boq ?>"  class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Upload Berkas </label>
                                             <input  type="file" maxlength="50"  name="file" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control" >
                                </div>
                                <?php if(!empty($leads->file_boq)) :?>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Lihat Berkas </label>
                                           <a   target="blank" href="<?php echo base_url(); ?>img/uploads/submit/boq/<?= $leads->file_boq ?>" title="Menuju halaman Baru"> <input style="cursor: pointer;  background: #00AAD4; color: #fff; text-align: center;" type="text" maxlength="50"  name="file" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="Lihat Berkas"  class="form-control" readonly></a>
                                </div>	
                                <?php endif; ?>
								<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="ket_boq" class="form-control" ><?= $leads->ket_boq ?></textarea>
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

</div> <!-- end modal jadwal boq -->
<!-- Start modal jadwal Design -->
<div  class="modal modal-right fade" id="modal_jadwal_design<?= $leads->id ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">JADWAL SUBMIT DESIGN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_submit_design') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $leads->nama_project ?> - <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <input  type="text" maxlength="50"  name="nm_pro" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->nama_project ?>"  class="form-control" hidden>
                                <input  type="text" maxlength="50"  name="id_lsp" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->id_lsp ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="jadwal_design" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->jadwal_design ?>"  class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Upload Berkas </label>
                                             <input  type="file" maxlength="50"  name="file" placeholder="Masukkan Nama Lengkap" autocomplete="off" value=""  class="form-control" >
                                </div>
                                <?php if(!empty($leads->file_design)) :?>
                                 <div class="form-group col-md-12">
                                            <label for="nama_barang">Lihat Berkas </label>
                                           <a   target="blank" href="<?php echo base_url(); ?>img/uploads/submit/design/<?= $leads->file_design ?>" title="Menuju halaman Baru"> <input style="cursor: pointer;  background: #00AAD4; color: #fff; text-align: center;" type="text" maxlength="50"  name="file" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="Lihat Berkas"  class="form-control" readonly></a>
                                </div>	
                                <?php endif; ?>
								<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="ket_design" class="form-control" ><?= $leads->ket_design ?></textarea>
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

</div> <!-- end modal jadwal Design -->
<!-- Start modal jadwal survey -->
<div  class="modal modal-right fade" id="modal_jadwal_survey<?= $leads->id ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">JADWAL SURVEY</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_jadwal_s') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $leads->nama_project ?> - <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                 <input  type="text" maxlength="50"  name="nm_pro" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->nama_project ?>"  class="form-control" hidden>
                                <input  type="text" maxlength="50"  name="id_lsp" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->id_lsp ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="jadwal_survey" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->jadwal_survey ?>"  class="form-control" required>
                                </div>
								<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="ket_survey" class="form-control" ><?= $leads->ket_survey ?></textarea>
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

</div> <!-- end modal jadwal survey -->
<!-- Start modal FV1 -->
<div  class="modal modal-right fade" id="modal_fv1<?= $leads->id ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">FOLLOW UP 1</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_fv1') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $leads->nama_project ?> - <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <input  type="text" maxlength="50"  name="nm_pro" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->nama_project ?>"  class="form-control" hidden>
                                <input  type="text" maxlength="50"  name="id_lsp" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->id_lsp ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="fv1" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->fv1 ?>"  class="form-control" required>
                                </div>
								<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="ket_fv1" class="form-control" ><?= $leads->ket_fv1 ?></textarea>
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

</div> <!-- end modal FV1 -->
<!-- Start modal FV2 -->
<div  class="modal modal-right fade" id="modal_fv2<?= $leads->id ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">FOLLOW UP 2</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_fv2') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $leads->nama_project ?> - <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <input  type="text" maxlength="50"  name="nm_pro" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->nama_project ?>"  class="form-control" hidden>
                                <input  type="text" maxlength="50"  name="id_lsp" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->id_lsp ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="fv2" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->fv2 ?>"  class="form-control" required>
                                </div>
								<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="ket_fv2" class="form-control" ><?= $leads->ket_fv2 ?></textarea>
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

</div> <!-- end modal FV2 -->
<!-- Start modal FV3 -->
<div  class="modal modal-right fade" id="modal_fv3<?= $leads->id ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">FOLLOW UP 3</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_fv3') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $leads->nama_project ?> - <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                <input  type="text" maxlength="50"  name="nm_pro" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->nama_project ?>"  class="form-control" hidden>
                                <input  type="text" maxlength="50"  name="id_lsp" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->id_lsp ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="fv3" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->fv3 ?>"  class="form-control" required>
                                </div>
								<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="ket_fv3" class="form-control" ><?= $leads->ket_fv3 ?></textarea>
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

</div> <!-- end modal FV3 -->
<!-- Start modal FV4 -->
<div  class="modal modal-right fade" id="modal_fv4<?= $leads->id ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">FOLLOW UP 4</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_fv4') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $leads->nama_project ?> - <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                 <input  type="text" maxlength="50"  name="nm_pro" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->nama_project ?>"  class="form-control" hidden>
                                <input  type="text" maxlength="50"  name="id_lsp" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->id_lsp ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="fv4" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->fv4 ?>"  class="form-control" required>
                                </div>
								<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="ket_fv4" class="form-control" ><?= $leads->ket_fv4 ?></textarea>
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

</div> <!-- end modal FV4 -->
<!-- Start modal FV4 -->
<div  class="modal modal-right fade" id="modal_fv5<?= $leads->id ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">FOLLOW UP 5</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('leads/update_fv5') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $leads->nama_project ?> - <?php date_default_timezone_set('Asia/Jakarta');
                                        echo date('Y-m-d ');
                                        ?></h6>
                                </div>
                                 <input  type="text" maxlength="50"  name="nm_pro" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->nama_project ?>"  class="form-control" hidden>
                                <input  type="text" maxlength="50"  name="id_lsp" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->id_lsp ?>"  class="form-control" hidden>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal </label>
                                             <input  type="date" maxlength="50"  name="fv5" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $leads->fv5 ?>"  class="form-control" required>
                                </div>
								<div class="form-group col-12">
											<label>Keterangan</label>
											<textarea  name="ket_fv5" class="form-control" ><?= $leads->ket_fv5 ?></textarea>
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

</div> <!-- end modal FV5 -->
									<?php endforeach ?>
								</tbody>
							</table>
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
</body>
</html>