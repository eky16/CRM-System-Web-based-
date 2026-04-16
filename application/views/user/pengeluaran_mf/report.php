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
			<!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
				<tr>
					<td>No Keluar</td>
					<td>Nama Petugas</td>
					<td>Nama Customer</td>
					<td>Tanggal Keluar</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($all_pengeluaran_mf as $pengeluaran_mf): ?>
					<tr>
						<td><?= $pengeluaran_mf->no_keluar ?></td>
						<td><?= $pengeluaran_mf->nama_petugas ?></td>
						<td><?= $pengeluaran_mf->nama_customer ?></td>
						<td><?= $pengeluaran_mf->tgl_keluar ?> Pukul <?= $pengeluaran_mf->jam_keluar ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</body>
</html>