<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<?php error_reporting(0); ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('penerimaan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					<!--	<a href="<?= base_url('penerimaan/export_detail/' . $penerimaan->no_terima) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
						<button  class="btn btn-secondary btn-sm" onclick="history.back()"><i class="fa fa-reply"></i> &nbsp;&nbsp;Kembali</button>	
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
					<div class="card-header"><strong><?= $title ?> - <?= $penerimaan->no_terima ?></strong></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<table class="table table-borderless">
									<tr>
										<td><strong>No Penerimaan</strong></td>
										<td>:</td>
										<td><?= $penerimaan->no_terima ?></td>
									</tr>
									<tr>
										<td><strong>Nama </strong></td>
										<td>:</td>
										<td><?= $penerimaan->nama_petugas ?></td>
									</tr>
									<tr>
										<td><strong>Waktu Penerimaan</strong></td>
										<td>:</td>
										<td><?= $penerimaan->tgl_terima ?> - <?= $penerimaan->jam_terima ?></td>
									</tr>
									<tr>
										<td><strong>Supplier</strong></td>
										<td>:</td>
										<td><?= $penerimaan->Nama ?></td>
									</tr>
								</table>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<td><strong>No</strong></td>
											<td><strong>Nama Barang</strong></td>
											<td><strong>Jumlah</strong></td>
											<td><strong>Harga Satuan</strong></td>
											<td><strong>Harga Total</strong></td>
											<td><strong>Keterangan</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_detail_terima as $detail_terima): ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $detail_terima->nama_barang ?></td>
												<td><?= $detail_terima->jumlah ?> <?= strtoupper($detail_terima->satuan) ?></td>
												<td><?php
                                             $hasil_rupiah = number_format($detail_terima->harga_satuan,0,',','.');
                                              echo $hasil_rupiah; ?></td>
												<td><?php
                                             $hasil_rupiah = number_format($detail_terima->harga_total,0,',','.');
                                              echo $hasil_rupiah; ?></td>
												<td><?= $detail_terima->ket_penerimaan ?></td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
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
</body>
</html>