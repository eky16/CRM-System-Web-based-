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
			<div id="content" data-url="<?= base_url('user/mf') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
					<!--	<a href="<?= base_url('user/mf/export_detail/' . $pengeluaran->no_keluar) ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
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
					
					<div class="card-header"><strong><?= $title ?> - <?= $pengeluaran_mf->no_keluar ?></strong></div>
					<div class="card-body">
							<div class="row">
							<div class="col-md-6">
							<table class="table table-borderless">
									<tr>
										<td><strong>No Keluar</strong></td>
										<td>:</td>
										<td><?= $pengeluaran_mf->no_keluar ?></td>
									</tr>
									<tr>
										<td><strong>Nama Admin</strong></td>
										<td>:</td>
										<td><?= $pengeluaran_mf->nama_petugas ?></td>
									</tr>
									<tr>
										<td><strong>Waktu Pengeluaran</strong></td>
										<td>:</td>
										<td><?= $pengeluaran_mf->tgl_keluar ?> - <?= $pengeluaran_mf->jam_keluar ?></td>
									</tr>
								</table> 
							</div>
						</div>
						<hr>
						<style>
    /* CSS untuk tabel */
    .colorful-table {
        border-collapse: collapse;
        width: 100%;
    }

    .colorful-table th,
    .colorful-table td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
    }

    /* CSS untuk warna sel tertentu */
    .color-Plum {
        background-color: Plum;
        color: black; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang merah */
    }

    .color-Brown {
        background-color: Brown;
        color: white; /* Untuk membuat teks berwarna putih agar kontras dengan latar belakang hijau */
    }
</style>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<td width="1" class="color-Brown"><strong>No</strong></td>
											
											<td width="100" class="color-Brown"><strong>Nama Barang</strong></td>
											<td width="100" class="color-Brown"><strong>Jumlah</strong></td>
													
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>TTP A S</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>TTP A D</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>SMPG S</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>SMPG D</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>BLKG S</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>BLKG D</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>RACK</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>BOX</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>CHS.S STAT</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>CHS.S DIN</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>CHS.D DIN</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>TTP CHS S</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>TTP CHS D</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>CNTL S</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>CNTL D</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>PNGMN</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>RELL</strong></td>
											<td width="70" class="color-Brown" style="writing-mode: vertical-lr; transform: rotate(180deg);"><strong>SAMB. RELL</strong></td>
											<td width="70" class="color-Brown"><strong>Keterangan</strong></td>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_detail_keluar_mf as $detail_keluar_mf): ?>
											<tr>
												<td><?= $no++ ?></td>
												
												<td><?= $detail_keluar_mf->nama_barang_mf ?></td>
												<td><?= $detail_keluar_mf->jumlah_mf ?> <?= strtoupper($detail_keluar_mf->Satuan_mf) ?></td>
												<td><?= $detail_keluar_mf->ttpas ?> </td>
												<td><?= $detail_keluar_mf->ttpad ?> </td>
												<td><?= $detail_keluar_mf->smpgs ?> </td>
												<td><?= $detail_keluar_mf->smpgd ?> </td>
												<td><?= $detail_keluar_mf->blkgs ?> </td>
												<td><?= $detail_keluar_mf->blkgd ?> </td>
												<td><?= $detail_keluar_mf->rack ?> </td>
												<td><?= $detail_keluar_mf->box ?> </td>
												<td><?= $detail_keluar_mf->chss_stat ?> </td>
												<td><?= $detail_keluar_mf->chss_din ?> </td>
												<td><?= $detail_keluar_mf->chs_d_din ?> </td>
												<td><?= $detail_keluar_mf->ttpchs_s ?> </td>
												<td><?= $detail_keluar_mf->ttpchs_d ?> </td>
												<td><?= $detail_keluar_mf->cntls ?> </td>
												<td><?= $detail_keluar_mf->cntld ?> </td>
												<td><?= $detail_keluar_mf->pngmn ?> </td>
												<td><?= $detail_keluar_mf->rell ?> </td>
												<td><?= $detail_keluar_mf->samb_rell ?> </td>												
                                              	<td><?= $detail_keluar_mf->ket_keluar_mf ?></td>
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
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>