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
			<div id="content" data-url="<?= base_url('barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
		
							<a href="<?= base_url('barang/export_excel_stok') ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Export Excel</a> 
							<a href="<?= base_url('barang/tambah_stok') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Barang</a>
					
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
					<div class="card-header"><strong>Daftar Barang</strong></div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td width="1">No</td>
										<td width="150">Kode</td>
										<td>Nama Barang</td>
										<td width="30">Warna</td>
										<td width="30">Min</td>
										<td width="30">Max</td>										
										<td width="40">Stok</td>
										<td width="40">Blok</td>
										<td width="40">Lantai</td>
										<td width="40">Baris</td>
										<td>Aksi</td>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_barang as $barang): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $barang->Kode_Barang ?></td>
											<td><?= $barang->Nama_Barang ?></td>
											<td><?= $barang->Warna_barang ?></td>
											<td><?= $barang->Min?></td>
										    <td><?= $barang->Max?></td>
											<td><?php 
											if(empty($barang->Stok)){
												echo 0;
											}else{
												//cek jumlah stok jika stok kurang dari min atau stok lebih dari max maka tampilkan warna merah
												if ($barang->Stok < $barang->Min OR $barang->Stok > $barang->Max){
													echo '<span style="color: red;">' . $barang->Stok . ' ' .$barang->Satuan . '</span>';
												}else
												// jika bukan
												{
													echo $barang->Stok . ' ' .$barang->Satuan;
												}
											}
											 ?></td>
											 <td><?= $barang->Blok?></td>
											 <td><?= $barang->Lantai?></td>
											 <td><?= $barang->Baris?></td>
												<td>
													<a href="<?= base_url('barang/ubah/' . $barang->No) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
													<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('barang/hapus_stok/' . $barang->No) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
												</td>
										   
										</tr>
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