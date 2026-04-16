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
						<a href="<?= base_url('user/penerimaan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('user/penerimaan/proses_tambah') ?>" id="form-tambah" method="POST">
									<h5>Data Admin</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-2">
											<label>No. Terima</label>
											<input type="text" name="no_terima" value="TR<?= time() ?>"  class="form-control">
										</div>
										<div class="form-group col-3">
											<label>NIK</label>
											<input type="text" name="kode_petugas" value="<?= $this->session->login['kode'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-3">
											<label>Nama</label>
											<input type="text" name="nama_petugas" value="<?= $this->session->login['nama'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-2">
											<label>Tanggal Terima</label>
											<input type="text" name="tgl_terima" value="<?= date('Y-m-d') ?>" readonly class="form-control">
										</div>
										<div class="form-group col-2">
											<label>Jam</label>
											<input type="text" name="jam_terima" value="<?= date('H:i:s') ?>" readonly class="form-control">
										</div>
									</div>
									<div class="row">

										<div class="col-md-12">
											<h5>Data Barang</h5>
											<hr>
											<div class="form-row">
												<div class="form-group col-6">
													<label for="nama_barang">Nama Barang</label>
				
											<input type="text" name="nama_barang" id="nama_barang" class=" form-control" list="nama_barang1" autocomplete="off"> 
											<datalist id="nama_barang1">
											<option value="">Pilih Barang</option>
														<?php foreach ($all_barang as $barang): ?>
														<option value="<?= $barang->Nama_Barang ?>"></option>
														<?php endforeach ?>
    										</datalist>	
												</div>
												<div class="form-group col-3">
													<label>Kode Barang</label>
													<input type="text" name="kode_barang" value="" readonly class="form-control">
												</div>
												<div class="form-group col-3">
                                                    <label>Jumlah</label>
                                                    <input type="number" id="jumlah" name="jumlah" value="" class="form-control" min='1' oninput="updateQty()">
                                                </div>
                                                <div class="form-group col-3" hidden>
                                                    <label>Qty</label>
                                                    <input type="number" id="min_jumlah" name="min_jumlah" value="" class="form-control" min='1' readonly>
                                                </div>
												<div class="form-group col-3">
													<label>Satuan</label>
													<input type="text" name="satuan" value="" class="form-control"  readonly>
												</div>
												<div class="form-group col-3">
													<label>Zona</label>
													<input type="text" name="zona" value="" class="form-control"  >
												</div>
												<div class="form-group col-3">
													<label>Lantai</label>
													<input type="text" name="lantai" value="" class="form-control"  >
												</div>
												<div class="form-group col-3">
													<label>Blok</label>
													<input type="text" name="blok" value="" class="form-control"  >
												</div>
												<div class="form-group col-6">
													<label>Keterangan</label>
													<textarea class="form-control" name="ket_penerimaan"> </textarea>
												</div>
												<div class="form-group col-1">
													<label for="">&nbsp;</label>
													<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="keranjang">
										<h5>Detail Penerimaan</h5>
										<hr>
										<table class="table table-bordered" id="keranjang">
											<thead>
												<tr>
													<td width="25%">Nama Barang</td>
													<td width="15%">Kode Barang</td>
													<td width="15%">Jumlah</td>
													<td width="15%" hidden>Qty</td>
													<td width="10%">Satuan</td>
													<td width="10%">Zona</td>
													<td width="10%">Lantai</td>
													<td width="10%">Blok</td>
													<td width="20%">Keterangan</td>
													<td width="5%">Aksi</td>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
											<tfoot>
												<tr>
													<td colspan="7" align="center">
														<input type="hidden" name="max_hidden" value="">
														<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
													</td>
												</tr>
											</tfoot>
										</table>
									</div>
								</form>
							</div>				
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- load footer -->
			
		</div>
	</div>
	<?php $this->load->view('user/partials/js.php') ?>

	<script>
		$(document).ready(function(){
			$('tfoot').hide()

			$(document).keypress(function(event){
		    	if (event.which == '13') {
		      		event.preventDefault();
			   	}
			})

			$('#nama_supplier').on('change', function(){
				$(this).prop('disabled', true)
				$('#reset').prop('disabled', false)
				$('input[name="nama_supplier"]').val($(this).val())
			})

			$(document).on('click', '#reset', function(){
				$('#nama_supplier').val('')
				$('#nama_supplier').prop('disabled', false)
				$(this).prop('disabled', true)
				$('input[name="nama_supplier"]').val('')
			})

			$('#nama_barang').on('change', function(){

				if($(this).val() == '') reset()
				else {
					$.ajax({
						url : "<?php echo site_url('user/penerimaan/get_all_barang');?>",
						type: 'POST',
						dataType: 'json',
						data: {nama_barang: $(this).val()},
						success: function(data){
							$('input[name="kode_barang"]').val(data.Kode_Barang)
							$('input[name="jumlah"]').val(1)
							$('input[name="min_jumlah"]').val(1)
							$('input[name="satuan"]').val(data.Satuan)
							$('input[name="max_hidden"]').val(data.stok)
							$('input[name="jumlah"]').prop('readonly', false)
							$('input[name="min_jumlah"]').prop('readonly', false)
							$('input[name="zona"]').prop('readonly', false)
							$('input[name="lantai"]').prop('readonly', false)
							$('input[name="blok"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							
							$('input[name="jumlah"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val())
							})
						}
					})
				}
			})

			$(document).on('click', '#tambah', function(e){
				
				const data_keranjang = {
					nama_barang: $('input[name="nama_barang"]').val(),
					kode_barang: $('input[name="kode_barang"]').val(),
					jumlah: $('input[name="jumlah"]').val(),
					min_jumlah: $('input[name="min_jumlah"]').val(),
					satuan: $('input[name="satuan"]').val(),
					zona: $('input[name="zona"]').val(),
					lantai: $('input[name="lantai"]').val(),
					blok: $('input[name="blok"]').val(),
					hrg_brg: $('input[name="hrg_brg"]').val(),
					ket_penerimaan: $('textarea[name="ket_penerimaan"]').val(),
				}

				$.ajax({
					url: "<?php echo site_url('user/penerimaan/keranjang_barang');?>",
					type: 'POST',
					data: data_keranjang,
					success: function(data){
						if($('input[name="nama_barang"]').val() == data_keranjang.nama_barang) $('option[value="' + data_keranjang.nama_barang + '"]').hide()
						reset()

						$('table#keranjang tbody').append(data)
						$('tfoot').show()

						$('#total').html('<strong>' + hitung_total() + '</strong>')
						$('input[name="total_hidden"]').val(hitung_total())
					}
				})
			})


			$(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()

				$('option[value="' + $(this).data('nama-barang') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="kode_barang"]').prop('disabled', true)
				$('select[name="nama_barang"]').prop('disabled', true)
				$('input[name="satuan"]').prop('disabled', true)
				$('input[name="jumlah"]').prop('disabled', true)
				$('input[name="min_jumlah"]').prop('disabled', true)
			})

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}

			function reset(){
				$('#nama_barang').val('')
				$('textarea[name="ket_penerimaan"]').val('')
				$('input[name="hrg_brg"]').val('')
				$('input[name="kode_barang"]').val('')
				$('input[name="jumlah"]').val('')
				$('input[name="min_jumlah"]').val('')
				$('input[name="satuan"]').val('')
				$('input[name="zona"]').val('')
				$('input[name="lantai"]').val('')
				$('input[name="blok"]').val('')
				$('input[name="jumlah"]').prop('readonly', true)
				$('input[name="min_jumlah"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
	<script>
    function updateQty() {
        var jumlah = document.getElementById("jumlah").value;
        document.getElementById("min_jumlah").value = jumlah;
    }
</script>
</body>
</html>