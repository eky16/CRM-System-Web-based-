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
			<div id="content" data-url="<?= base_url('user/barang') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('user/partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
		
							<a href="<?= base_url('user/barang/export_excel_stok') ?>" class="btn btn-success btn-sm"><i class="fa fa-file-excel"></i>&nbsp;&nbsp;Export Excel</a> 
				
							<a href="<?= base_url('user/barang/tambah_stok') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah Barang</a>
					      
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
										<td width="100">Kode</td>
										<td>Kategori</td>
										<td>Nama Barang</td>
                                        <td>Aksi</td>
									
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_barang as $barang): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $barang->kode_product ?></td>
											<td><?= $barang->kategori ?></td>
											<td><?= $barang->item ?></td>
											
											 
											 
											 
												<td>
													<a href="<?= base_url('user/barang/ubah/' . $barang->No) ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>

													<?php if ($this->session->login['department'] == 'PPIC' OR $this->session->login['department'] == 'IT'):?>
													<a onclick="return confirm('Apakah Anda yakin ingin Hapus data : <?= $barang->Nama_Barang?>?')" href="<?= base_url('user/barang/hapus_stok/' . $barang->No) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
			</div>
			<!-- load footer -->
			<?php $this->load->view('user/partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>

<!--	<script>
$(document).ready(function() {
    var table = $('#dataTable').DataTable();

    // 🔍 Filter zona
    $('#filterZona').on('change', function() {
        var zona = $(this).val();
        if (zona) {
            table.column(8).search('^' + zona + '$', true, false).draw();
        } else {
            table.column(8).search('').draw();
        }
    });
});
</script> -->

<script>
$(document).ready(function() {
    var table = $('#dataTable').DataTable();

    $('#filterZona').on('change', function() {
        var zona = $(this).val();

        // Jika pilih "Semua Zona" atau kosong, tampilkan semua data
        if (zona === '' || zona === 'Semua Zona') {
            table.column(8).search('').draw();
        } else {
            // Filter berdasarkan teks biasa (tanpa regex)
            table.column(8).search(zona, false, false).draw();
        }
    });
});
</script>



	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>