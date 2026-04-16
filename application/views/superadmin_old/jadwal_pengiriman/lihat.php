<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<style type="text/css">
	@media screen and (max-width: 520px) {
	table {
		width: 100%;
	}
	thead th.column-primary {
		width: 100%;
	}

	thead th:not(.column-primary) {
		display:none;
	}
	
	th[scope="row"] {
		vertical-align: top;
	}
	
	td {
		display: block;
		width: auto;
		text-align: right;
	}
	thead th::before {
		text-transform: uppercase;
		font-weight: bold;
		font-size: 10px;
		font-family: 'Calibri', sans-serif !important;
		content: attr(data-header);
	}
	thead th:first-child span {
		display: none;
	}
	td::before {
		float: left;
		text-transform: uppercase;
		font-weight: bold;
		font-size: 10px;
		font-family: 'Calibri', sans-serif !important;
		content: attr(data-header);
	}
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
					<div class="card-header"><strong><?= $title ?> </strong>
					                            <div class="float-right">
							<a href="<?= base_url('jadwal_pengiriman/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Buat Jadwal</a>&nbsp;
						 	<a href="<?= base_url('jadwal_pengiriman/schedule_calendar') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Kalender Pengiriman</a>
							</div></div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th scope="col" width="2">No</th>
										<th align="center" scope="col" class="column-primary" data-header="Leads"><font size="2px>"> Data </font></th>
										<th align="center" scope="col"  data-header="Leads"><font size="2px>">Tanggal</font></th>
										<th align="center" scope="col"  data-header="Leads"><font size="2px>">Nama</font></th>
										<th align="center" scope="col"  data-header="Leads"><font size="2px>">Proyek </font></th>
										
										<th align="center" scope="col" cdata-header="Leads"><font size="2px>">Keterangan</font></th>
										<th align="center" scope="col"  data-header="Leads">Status</th>
										<th align="center" scope="col" >Aksi</th>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($request_pengiriman as $row): ?>
										<tr>
											<td data-header="No"><font size="2px>"><?= $no++ ?></font></td>
											<td data-header="ID" style="vertical-align: middle;"><font size="2px>"><?= $row->id_pengiriman ?></font></td>
											<td data-header="Tanggal"><font size="2px>"><?= $row->tgl_pengiriman ?></br><?= $row->waktu_pengiriman ?></font></td>
											<td data-header="Nama" style="vertical-align: middle;"><font size="2px>"><?= $row->creat_by ?></font></td>
											<td data-header="Proyek" style="vertical-align: middle;"><font size="2px>"><?= $row->nama_project ?></font></td>
											
											<td data-header="Keterangan"><font size="2px>"><?= $row->ket_pengiriman ?></font></td>
											<td data-header="Status" align="center" style="vertical-align: middle;"><font size="2px>">
											<?php  $status_req = $row->status_pengiriman ; ?>	
											<?php if($status_req == '1') : ?>
												<a class="btn btn-outline-warning btn-sm" style="color:black"> Menunggu</a>
											<?php endif ;?>
											<?php if($status_req == '2'): ?>
												<a class="btn btn-outline-success btn-sm" style="color:black"> Success</a>
											<?php endif ;?>	
											<?php if($status_req == '3'): ?>
												<a class="btn btn-outline-danger btn-sm" style="color:black"> Ditolak</a>
											<?php endif ;?>	


											</font></td>

												<td scope="row" data-header="Aksi">

													<div class="toolbox">
														<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">&nbsp;&nbsp;
															Aksi 
														</button>
					<div class="dropdown-menu">&nbsp;&nbsp;&nbsp;

				  	<a target="_blank" href="<?= base_url('jadwal_pengiriman/detail_pengiriman/' . $row->id_pengiriman) ?>" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>&nbsp;Detail</a>&nbsp;
				  						<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('jadwal_pengiriman/hapus/' . $row->id_pengiriman) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus</a>
			



														</div>
					</div>
												</td>
										
										</tr>
<div  class="modal modal-right fade" id="right_modal_apprv<?php echo $row->no_pengiriman ; ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Jadwal Pengiriman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form action="<?= base_url('jadwal_pengiriman/save_apprv') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
      <div class="modal-body">
                                 <!-- Content Column -->

                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"><?= $row->creat_by ?> <?= $row->creat_at ?></h6>
                                </div>
                                <div class="card-body">
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">ID </label>
                                             <input  type="text" maxlength="50"  name="id_apprv" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->id_pengiriman ?>"  class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Tanggal Pengiriman </label>
                                             <input  type="text" maxlength="50"  name="" placeholder="Masukkan Nama Lengkap" autocomplete="off" value="<?= $row->tgl_pengiriman ?> , <?= $row->waktu_pengiriman ?>"  class="form-control" readonly>
                                </div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Proyek </label>
                                             <input  type="text" maxlength="50"  name="" placeholder="" autocomplete="off" value="<?= $row->nama_project ?>"  class="form-control" readonly>
                                </div>
								<div class="form-group col-12">
											<label><u>Keterangan : </u></label>
										</br>
										<?= $row->ket_pengiriman ?>
								</div>
                                <div class="form-group col-md-12">
                                            <label for="nama_barang">Aksi </label>
                                <select name="status_pengiriman" class="form-control" >
                            <option value="">Pilih...</option>
                            <option value="1" <?php
                            if (!empty($row->status_pengiriman)) {
                                echo $row->status_pengiriman == '1' ? 'selected' : '';
                            }
                            ?>>Tunggu</option>
                            <option value="2" <?php
                            if (!empty($row->status_pengiriman)) {
                                echo $row->status_pengiriman == '2' ? 'selected' : '';
                            }
                            ?>>Ya</option>
                            <option value="3" <?php
                            if (!empty($row->status_pengiriman)) {
                                echo $row->status_pengiriman == '3' ? 'selected' : '';
                            }
                            ?>>Tolak</option>
                            </select>
                                </div>
                                <input type="text" name="operator" placeholder="Masukkan Kode Barang" autocomplete="off"  class="form-control" required value="<?= $this->session->login['nama'] ?>" maxlength="8" hidden>

         

                                <hr>

                                <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;PROSES</button>
                            
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

</div> <!-- end modal apprv -->
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