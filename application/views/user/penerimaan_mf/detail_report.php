<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title ?></h3>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<table class="table table-borderless">
				<tr>
					<td><strong>No Terima</strong></td>
					<td>:</td>
					<td><?= $penerimaan_mf->no_terima ?></td>
				</tr>
				<tr>
					<td><strong>Nama Petugas</strong></td>
					<td>:</td>
					<td><?= $penerimaan_mf->nama_petugas ?></td>
				</tr>
				<tr>
					<td><strong>Nama Supplier</strong></td>
					<td>:</td>
					<td><?= $penerimaan_mf->nama_supplier ?></td>
				</tr>
				<tr>
					<td><strong>Waktu Terima</strong></td>
					<td>:</td>
					<td><?= $penerimaan_mf->tgl_terima ?> - <?= $penerimaan_mf->jam_terima ?></td>
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
					</tr>
				</thead>
				<tbody>
					<?php foreach ($all_detail_terima_mf as $detail_terima_mf): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $detail_terima_mf->nama_barang ?></td>
							<td><?= $detail_terima_mf->jumlah ?> <?= strtolower($detail_terima_mf->satuan) ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>