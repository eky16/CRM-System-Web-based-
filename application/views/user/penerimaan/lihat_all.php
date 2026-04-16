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
			<div id="content" data-url="<?= base_url('user/penerimaan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					<!--	<a href="<?= base_url('user/penerimaan/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->

					    <?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
						<a href="<?= base_url('user/penerimaan/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
						<?php endif; ?>
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
					<div class="card-header"><a  href="<?php echo base_url(); ?>user/penerimaan "><strong>Data Penerimaan</strong></a> / <font color="blue"><strong> All Data Penerimaan </strong></font>/ <a  href="<?php echo base_url(); ?>user/penerimaan/laporan_penerimaan "><strong> Laporan </strong></a></div> 
					<div class="card-body">
						<div class="table-responsive">

							<div class="form-group">
    <label for="filterZona"><strong>Filter Zona:</strong></label>
    <select id="filterZona" class="form-control" style="width:200px; display:inline-block; margin-left:10px;">
        <option value="">Semua Zona</option>
        <option value="A">Zona A</option>
        <option value="B">Zona B</option>
        <option value="C">Zona C</option>
        <option value="D">Zona D</option>
        <option value="E">Zona E</option>
        <option value="F">Zona F</option>
        <option value="G">Zona G</option>
        <option value="H">Zona H</option>
        <option value="Semua Zona">Semua Zona</option>
    </select>
</div>

							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1">No</td>
										<td width="100">No Terima</td>
										<td>Nama Barang</td>
										<td width="60">Qty Masuk</td>
										<td width="60">Qty Sisa</td>
										<td width="60">Zona-Lantai-Blok</td>
										<td width="130">Tanggal Terima</td>
										<td width="130" hidden>Tanggal Terima</td>

										<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
										<td width="60">Aksi</td>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_penerimaan as $penerimaan): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $penerimaan->no_terima ?></td>
											<td><?= $penerimaan->nama_barang ?></td>
											<td><?= $penerimaan->jumlah ?> - <?= $penerimaan->satuan ?></td>
											<td><?= $penerimaan->min_jumlah ?> - <?= $penerimaan->satuan ?></td>
											<td><?= $penerimaan->zona ?> - <?= $penerimaan->lantai ?> - <?= $penerimaan->blok ?></td>
											<td><?= $penerimaan->tgl_terima ?> <?= $penerimaan->jam_terima ?></td>

											<td hidden>
                                                <strong>
                                            <a data-toggle="modal" style="color: black" data-target="#modal_tgl_penerimaan<?= $penerimaan->id ?>" class="btn btn-light">
                                                        <font size="2">
                                            <?php
                                            if (!empty($penerimaan->tgl_terima) && !empty($penerimaan->jam_terima)) {
                                            echo date("Y-m-d H:i:s", strtotime($penerimaan->tgl_terima . ' ' . $penerimaan->jam_terima));
                                            } else {
                                            echo '';
                                                            }
                                                            ?>
                                                        </font>
                                                    </a>
                                                </strong>
                                            </td>

											<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
											<td>
												<a href="<?= base_url('user/penerimaan/detail/' . $penerimaan->no_terima) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
												<a onclick="return confirm('Apakah Anda yakin ingin Hapus data Penerimaan : <?= $penerimaan->no_terima?>?')" href="<?= base_url('user/penerimaan/hapus/' . $penerimaan->no_terima) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
											<?php endif; ?>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>				
				</div>
				</div>
				<!-- Start modal modal_cutting -->
<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>

<div class="modal modal-right fade" id="modal_tgl_penerimaan<?= $penerimaan->id ?>" tabindex="-1" role="dialog" aria-labelledby="right_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Tanggal Terima</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('user/penerimaan/update_tgl_cutting_act') ?>" enctype="multipart/form-data" id="form-tambah" method="POST">
        <div class="modal-body">
          <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
              <input type="text" maxlength="50" name="id" value="<?= $penerimaan->id ?>" class="form-control" hidden>
              <div class="card-body">
                <div class="form-group col-md-12">
                  <label for="tanggal_terima">Tanggal Terima</label>
                  <input type="date" name="tgl_terima" value="<?= !empty($penerimaan->tgl_terima) ? date('Y-m-d', strtotime($penerimaan->tgl_terima)) : '' ?>" class="form-control">
                  <input type="text" name="url" value="<?= $akhir_url; ?>" class="form-control" hidden>
                </div>
                <div class="form-group col-12">
                  <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                </div>
                <hr>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer modal-footer-fixed">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>
<!-- end modal modal_cutting --> 
			</div>

			


			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
    $('a[data-toggle="modal"]').on('click', function(e) {
        var target = $(this).data('target');
        $(target).modal('show');
    });
});
</script>

<script>
$(document).ready(function() {
    var table = $('#dataTable').DataTable();

    $('#filterZona').on('change', function() {
        var zona = $(this).val();

        if (zona === '' || zona === 'Semua Zona') {
            table.column(8).search('').draw();
        } else {
            // Ambil huruf zona saja (misalnya dari "Zona A" jadi "A")
            var zonaHuruf = zona.replace(/Zona\s*/i, '').trim();
            
            // Regex untuk mencocokkan "A" di awal kolom (misalnya "A - 4 - 5", "A1", "A - 10", dll)
            var regex = '^\\s*' + zonaHuruf + '\\b';
            
            table.column(8).search(regex, true, false).draw();
        }
    });
});
</script>



</body>
</html>